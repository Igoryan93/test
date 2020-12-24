<?php
namespace App\Controllers;
use App\Database;
use App\exceptions\AccountIsTemporarilyBlocked;
use App\exceptions\BalanceNotEnoughMoneyException;
use App\QueryBuilder;
use App\QueryTest;
use League\Plates\Engine;
use SimpleMail;
use Faker\Factory;

class HomeController {
    private $auth, $db;

    public function __construct(Database $db) {
        $this->db = $db->connect();
        $this->templates = new Engine('../app/views');
        $this->query = new QueryBuilder($this->db);
        $this->auth = new \Delight\Auth\Auth($this->db);
    }

    public function index() {
        d($this->auth);
        $posts = $this->query->getAll('posts');
        echo $this->templates->render('home', ['posts' => $posts]);
    }

    public function insert() {
        for($i=1; $i<=30; $i++) {
            $this->query->insert('posts', [
                'title' => Factory::create()->name($gender = null|'male'|'female'),
                'text' => Factory::create()->realText($maxNbChars = 100, $indexSize = 2),
                'image' => Factory::create()->imageUrl(300, 300, 'cats')
            ]);
        }
    }

    public function about() {
        try {
            $userId = $this->auth->register('test2@test.com', '123', 'test-name', function ($selector, $token) {
                echo 'Send ' . $selector . ' and ' . $token . ' to the user (e.g. via email)';
            });

            echo 'We have signed up a new user with the ID ' . $userId;
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            die('Invalid email address');
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            die('Invalid password');
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            die('User already exists');
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        }
    }

    public function email_verification() {
        try {
            $this->auth->confirmEmail('M8H7xMBrRZh4yY0H', 'nPq_MCfQcvVxBXqN');

            echo 'Email address has been verified';
        }
        catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
            die('Invalid token');
        }
        catch (\Delight\Auth\TokenExpiredException $e) {
            die('Token expired');
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            die('Email address already exists');
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        }
    }

    public function login() {
        try {
            $this->auth->login('test2@test.com', '123');

            echo 'User is logged in';
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            die('Wrong email address');
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            die('Wrong password');
        }
        catch (\Delight\Auth\EmailNotVerifiedException $e) {
            die('Email not verified');
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        }
    }

    public function logOut() {
        try {
            $this->auth->logOutEverywhere();
        }
        catch (\Delight\Auth\NotLoggedInException $e) {
            die('Not logged in');
        }
    }

    public function withDraw($param = 1) {
        $count = 10;

        if($param > $count) {
            throw new BalanceNotEnoughMoneyException('Your not enough money');

        } else if($param == 0) {
            throw new AccountIsTemporarilyBlocked('Account is temporarily blocked');
        }

    }

    public function sendEmail() {
        var_dump(SimpleMail::make()
            ->setTo('lost.autumn72@yandex.ru', 'Igoryan')
            ->setFrom('d428d8213e-120e74@inbox.mailtrap.io', 'Igor')
            ->setSubject('Подтверждение почты')
            ->setMessage('Пройдте по ссылка для подтверждения <a href="#">тут</a> о регистрации')
            ->setHtml()
            ->send());
    }


}