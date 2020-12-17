<?php

namespace App;
use PDO;

class Database {
     public function connect() {
         return new PDO("mysql:host=localhost; dbname=registration2; charset=utf8", "root", "root");
     }
}