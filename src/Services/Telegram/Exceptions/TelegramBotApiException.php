<?php

namespace Services\Telegram\Exceptions;


use Exception;
use Illuminate\Http\Request;

final class TelegramBotApiException extends Exception {

    public function render(Request $request) {
        return response()->json([]);
    }

}
