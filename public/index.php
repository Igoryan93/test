<?php
require_once "../vendor/autoload.php";


if($_SERVER['REQUEST_URI'] === '/homepage') {
    require "../app/Controllers/homepage.php";
}
