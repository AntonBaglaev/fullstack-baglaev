<?php

namespace Support\Logging\Telegram;


//final class TelegramLoggerHandler extends AbstractProcessingHandler {
//
//    protected int $chatId;
//    protected string $token;
//
//    public function __construct(array $config) {
//        $level = Logger::toMonologLevel($config['level']);
//        parent::__construct($level);
//
//        $this->chatId = (int) $config['chat_id'];
//        $this->token = $config['token'];
//    }
//
//    protected function write(LogRecord $record): void{
//
//        $data = $record->toArray();
//
//        TelegramBotApi::sendMessage(
//            $this->token,
//            $this->chatId,
//            $data['message']);
//    }
//}
