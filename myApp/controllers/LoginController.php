<?php

class LoginController extends AppController
{
    public function __construct()
    {
        $this->init();
    }
    public function init()
    {
        $uName = $_POST['userName'];
        $uPass = $_POST['userPass'];
        // se recomanda filtrarea dateleor de intrare - filter_var, ... html special

        $user = new UsersModel;

        if ($user->isAuth($uName, $uPass)) {

            // dau acces
            session_start();
            $_SESSION['user'] = $uName;
            $data['title'] = 'Private Page';
            header("Location: home");
            exit;
            // echo $this->render(APP_PATH . VIEWS . 'layoutAuth.html', $data);
        } else {

            // nu are acces
            echo '<h1>You are NOT logged In!</h1>';
            header("Refresh: 1; url= home");
            exit;
        }
    }
}
