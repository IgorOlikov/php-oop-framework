PHP MVC OOP Framework частично собранный из готовых компонентов

Включает в себя.
1) Сервис внедрения зависимостей через Container.
2) Router: request,response, middlewares
3) Middleware: Как цепочка промежуточного ПО до выполнения самого экшена контроллера, проверки сессии,условия аунетнтификации.
4) Консольное приложение(отдельное): выполняющее команды - миграции БД.
5) Кастомные миграции БД.
6) Шаблонизатор Twig.
7) Doctrine Dbal.
8) Сессии и флеш сообщения.
9) Event-Service-Provider - регистрация событий и слушателей.
10) Service-provider - регистрация самих провайдеров.

Функционал веб приложения.
1) Регистрация, Вход и Выход с Сессией и валидацией полей
2) Добавление постов 

Как запустить.
Из корневой папки выполнить команды:
1) Скачать надстройку над docker-compose - приложение Lando
2) wget https://files.lando.dev/installer/lando-x64-stable.deb
   sudo dpkg -i lando-x64-stable.deb
3) lando build
4) lando composer update
5) lando php console migrate
