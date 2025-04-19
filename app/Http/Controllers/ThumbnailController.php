<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ThumbnailController extends Controller
{
    public function __invoke(
        string $dir,
        string $method,
        string $size,
        string $file
    ): BinaryFileResponse
    {
        // Проверка допустимых размеров
        abort_if(
            !in_array($size, config('thumbnail.allowed_sizes', [])),
            403,
            'Size not allowed'
        );

        $storage = Storage::disk('images');

        // Нормализация пути
        $realPath = $this->normalizePath("$dir/$file");
        $newDirPath = $this->normalizePath("$dir/$method/$size");
        $resultPath = $this->normalizePath("$newDirPath/$file");

        // Проверка существования исходного файла
        if (!$storage->exists($realPath)) {
            \Log::error('Image not found', [
                'requested' => $realPath,
                'storage_path' => $storage->path($realPath),
                'available' => $storage->files($dir)
            ]);
            abort(404, "Original image not found: {$realPath}");
        }

        // Проверка прав доступа
        $fullPath = $storage->path($realPath);
        if (!is_readable($fullPath)) {
            \Log::error('Image not readable', [
                'path' => $fullPath,
                'permissions' => substr(sprintf('%o', fileperms($fullPath)), -4)
            ]);
            abort(500, "Image is not readable");
        }

        // Создание директории для результата
        if (!$storage->exists($newDirPath)) {
            $storage->makeDirectory($newDirPath, 0755, true);
        }

        // Генерация thumbnail
        if (!$storage->exists($resultPath)) {
            try {
                $image = Image::make($fullPath);
                [$w, $h] = explode('x', $size);
                $image->{$method}($w, $h);
                $image->save($storage->path($resultPath));
            } catch (\Exception $e) {
                \Log::error('Image processing failed', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                abort(500, "Image processing error");
            }
        }

        return response()->file($storage->path($resultPath));
    }

    private function normalizePath(string $path): string
    {
        return trim(str_replace('\\', '/', $path), '/');
    }
}
