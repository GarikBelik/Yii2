Тестовое задание:

Создать страницы регистрации, входа и выхода для сайта.
Внешний вид не важен, главное чтоб было юзабельно.
Фронт на AngularJs Single Page Applications (SPAs)

Бэк на Yii2
БД на выбор


Фронт отделен от бэкэнда. Взаимодействие с бэком через API.

Требуемые элементы:
1. Регистрация
2. login
3. logout

Регистрация включает заполнение анкеты:
1. Номер телефона* (уникальный, используется в качестве логина)
2. Пароль* (минимум 6 символов, цифры/буквы)
3. Фамилия* (кириллица, ввод с заглавной буквы, может присутствовать 1 дефис)
4. Имя* (кириллица, ввод с заглавной буквы, может присутствовать 1 дефис)
5. Отчество (кириллица, ввод с заглавной буквы, может присутствовать 1 дефис)
6. Пол
7. Дата рождения (проверять формат)
(* - обязательные поля )

После прохождения регистрации автоматический логин.


P.S.
Таблицы создал через migrate. В качестве сервера использовал OS.