<?php


class ContactController extends AppController
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
            echo $this->render(APP_PATH . VIEWS . 'contactAuth.html');
        } else {
            // include APP_PATH.VIEWS . 'layout.php';
            $data['title'] = 'CONTACT';
            // $data['mainContent'] = '<h2>HOME SPECIFIC CONTENT</h2>';
            echo $this->render(APP_PATH . VIEWS . 'contact.html', $data);
        }
    }
}
