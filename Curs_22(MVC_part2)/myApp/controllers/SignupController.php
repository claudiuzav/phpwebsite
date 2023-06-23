<?php

class SignupController extends AppController
{
    public function __construct()
    {
        $this->init();
    }
    //     public function init()
    //     {
    //         $uName = $_POST['signUpName'];
    //         $uPass = $_POST['signUpPass1'];
    //         // se recomanda filtrarea dateleor de intrare - filter_var, ... html special
    //         $user = new UsersModel;

    //         if ($user->addUser($uName, $uPass)) {

    //             // dau acces
    //             session_start();
    //             $_SESSION['user'] = $uName;
    //             $data['title'] = 'Private Page';
    //             header("Location: home");
    //             exit;
    //             // echo $this->render(APP_PATH . VIEWS . 'layoutAuth.html', $data);
    //         } else {

    //             // nu are acces
    //             echo '<h1>You are NOT logged In!</h1>';
    //             header("Refresh: 1; url= home");
    //             exit;
    //         }
    //     }
    // }

    public function init()
    {
        if (isset($_POST['signUpName']) && isset($_POST['signUpPass1'])) {
            $uName = $_POST['signUpName'];
            $uPass = $_POST['signUpPass1'];

            // Validate input values
            if (!empty($uName) && !empty($uPass)) {
                $user = new UsersModel;

                if ($user->addUser($uName, $uPass)) {
                    // User added successfully

                    // Grant access
                    session_start();
                    $_SESSION['user'] = $uName;
                    $data['title'] = 'Private Page';
                    header("Location: home");
                    exit;
                } else {
                    // Failed to add user
                    echo '<h1>You are NOT logged in!</h1>';
                    header("Refresh: 1; url= home");
                    exit;
                }
            } else {
                // Empty input fields
                echo '<h1>Please fill in all the required fields!</h1>';
                header("Refresh: 1; url= home");
                exit;
            }
        }
    }
}
