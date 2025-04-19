<?php

namespace Support\Traits\Models;


use Illuminate\Database\Eloquent\Model;

trait HasSlug {

    protected static function bootHasSlug(): void {
        static::creating(function (Model $item) {
            $item->makeSlug();
        });
    }

    protected function makeSlug(): void {
        $slug = $this->slugUnique(
            str($this->{$this->slugFrom()})
                ->slug()
                ->value()
        );

        $this->{$this->slugColumn()} = $this->{$this->slugColumn()} ?? $slug;
    }

    protected function slugColumn(): string {
        return 'slug';
    }

    protected function slugFrom(): string {
        return 'title';
    }

    private function slugUnique(string $slug): string {
        $originalSlug = $slug;
        $i = 0;

        while ($this->isSlugExists($slug)) {
            $i++;
            $slug = $originalSlug.'-'.$i;
        }
        return $slug;
    }

    private function isSlugExists(string $slug): bool {

        $query = $this->newQuery()
            ->where(self::slugColumn(), $slug)
            ->where($this->getKeyName(), '!=', $this->getKey());

        return $query->exists();
    }
}
