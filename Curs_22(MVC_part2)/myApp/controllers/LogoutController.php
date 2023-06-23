<?php

class LogoutController extends AppController
{
    public function __construct()
    {
        $this->init();
    }
    public function init()
    {
        session_start();
        session_destroy();
        header("location: home");
        exit;
    }
}
