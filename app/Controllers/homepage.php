<?php
use App\QueryBuilder;
use App\Database;


$database = new Database(); /* Экземпляр класса с соединение с БД */
$queryBuilder = new QueryBuilder($database->connect()); /* Вызов QueryBuilder и передача ему соединение с БД */

/* Выбрать одного пользователя из таблицы users */
/* $user = $queryBuilder->getOne('users', ['username' => 'Ivanov Ivan']); */


/* Выбрать всех пользователей из таблицы users */
$user = $queryBuilder->getAll('users');



/* Добавление пользователя с определенными полями в таблицу users */
$queryBuilder->insert('users', [
    'email'    => 'testemail@gmail.com',
    'username' => 'Test',
    'password' => password_hash('Test123', PASSWORD_DEFAULT),
    'text'     => 'More More Texts',
    'group_id' => '1',
    'date'     => date('d/m/Y')
]);



/* Обновление определенных полей в таблице users на новые по id пользователя */
$id = 45; /* id пользователя в таблице */
$queryBuilder->update('users', $id, [
    'email'    => 'newtestemail@gmail.com',
    'username' => 'New Test',
    'password' => password_hash('Test123', PASSWORD_DEFAULT),
    'text'     => 'More More Texts',
    'group_id' => '2',
]);



/* Удаление пользователя с определенным id из таблицы users */
$id = 45; /* id пользователя в таблице */
$queryBuilder->delete('users', $id);


