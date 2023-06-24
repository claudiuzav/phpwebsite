<?php
// echo "aecac";
class DeleteController extends AppController
{
    public function __construct()
    {
        $this->init();
    }
    public function init()
    {
        $newUser = new UsersModel();
        $id = $_GET['ID'];
        $deleted = $newUser->delProducts($id);
        if ($deleted) {
            header("Refresh: 1; url= home");
        } else {
            echo "ID is not set.";
        }
    }
}
