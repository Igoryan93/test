<?php

if( !session_id() ) @session_start();


require_once "../vendor/autoload.php";

use League\Plates\Engine;

use \Tamtamchik\SimpleFlash\Flash;


$templates = new Engine('../app/views/');

echo $templates->render('about', ['name' => $user['username']]);




flash()->info(['Info message', 'Second Info message']); /* Запись типа и текста сообщения */
flash()->success(['Success message']);
flash()->warning(['Warning message']);
flash()->error(['Error message']);


echo flash()->display(); /* Вывод всех записанных сообщений */

