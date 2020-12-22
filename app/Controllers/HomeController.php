<?php
namespace App\Controllers;
use App\Database;
use App\QueryBuilder;
use League\Plates\Engine;


class HomeController {

    public function __construct() {
        $this->templates = new Engine('../app/views');
        $this->db = new Database();
        $this->query = new QueryBuilder($this->db->connect());

    }

    public function index() {
        $posts = $this->query->getAll('users');
        echo $this->templates->render('home', ['posts' => $posts]);
    }

    public function about($id) {
        $userId = $this->query->getOne('users', ['id', '=', $id['id']]);
        echo $this->templates->render('about', ['id' => $userId]);

    }


}