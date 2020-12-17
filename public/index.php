<?php
require_once "../vendor/autoload.php";

use League\Plates\Engine;

$templates = new Engine('../app/views/');

echo $templates->render('about', ['name' => $user['username']]);

