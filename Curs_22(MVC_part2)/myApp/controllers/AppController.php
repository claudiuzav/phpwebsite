<?php

class AppController extends Controller
{
    protected $routes = [
        'home' => 'HomeController',
        'about' => 'AboutController',
        'contact' => 'ContactController',
        'login' => 'LoginController',
        'logout' => 'logoutController',
        'signup' => 'SignupController',
        'delete' => 'DeleteController',
    ];

    public function __construct()
    {
        // echo __FILE__;
        $this->init();
    }

    public function init()
    {
        // partea de routing (navigare)
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 'home';
        }
        if (array_key_exists($page, $this->routes)) {
            $className = $this->routes[$page];
        } else {
            $className = $this->routes['home'];
        }
        new $className;
    }
}