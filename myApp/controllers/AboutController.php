<?php


class AboutController extends AppController
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
            $data['title'] = 'PRIVATE ABOUT';
            $data['mainContent'] = '<h2>HELLO, <i>' . $_SESSION['user'] . '</i></h2>';
            echo $this->render(APP_PATH . VIEWS . 'aboutAuth.html', $data);
        } else {
            // include APP_PATH.VIEWS . 'layout.php';
            $data['title'] = 'ABOUT';

            // $data['mainContent'] = '<h2>HOME SPECIFIC CONTENT</h2>';
            $data['mainContent'] = $this->render(APP_PATH . VIEWS . 'list.html', array());
            echo $this->render(APP_PATH . VIEWS . 'about.html', $data);
        }
    }
}
