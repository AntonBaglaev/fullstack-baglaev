#  Installation

- php artisan shop:install
- make .env and .env.testing from .env.example !!!IMPORTANT


npm install @tailwindcss/line-clamp
npm install postcss


`php artisan make:model Brand -mf` - модель, миграция, фабрика для брендов

`php artisan make:model Category -mf` - модель, миграция, фабрика для категорий

`php artisan make:model Product -mf` - модель, миграция, фабрика для продуктов

`php artisan migrate:fresh --seed`  - запускаем миграции

`php artisan shop:refresh` - удаление дирректории с изображениями перед миграцией и заполнением сидеров

Если при запуске миграции ругается на телеграм api закоментить все модули tg. В данный момент все закомичено

Оччистка кэша конфигурации Laravel
```
php artisan config:clear
php artisan view:clear
php artisan cache:clear
```
App + 
