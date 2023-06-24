<?php

// seteaza cofigurarile aplicatiei web
require_once 'config.php';

// acceseaza controlerul aplicatiei
new AppController;


$someUser = new UsersModel();