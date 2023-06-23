<?php


class HomeController extends AppController
{
    public function __construct()
    {
        $this->init();
    }
    public function init()
    {
        session_start();
        if (isset($_SESSION['user'])) {
            // private page
            $data['title'] = 'PRIVATE HOMEPAGE';
            $data['user'] = '<h2>HELLO, <i>' . $_SESSION['user'] . '</i></h2>';
            $user = new UsersModel();
            $data['mainContent'] = $user->displayData();
            echo $this->render(APP_PATH . VIEWS . 'layoutAuth.html', $data);
        } else {
            // include APP_PATH.VIEWS . 'layout.php';
            $data['title'] = 'HOMEPAGE';
            // $data['mainContent'] = '<h2>HOME SPECIFIC CONTENT</h2>';
            // $data['mainContent'] = $this->render(APP_PATH . VIEWS . 'list.html', array());
            $data['mainContent'] = $this->render(APP_PATH . VIEWS . 'list.html', array());
            echo $this->render(APP_PATH . VIEWS . 'layout.html', $data);
        }
    }
}
