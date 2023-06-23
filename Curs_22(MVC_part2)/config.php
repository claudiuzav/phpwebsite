<?php

//! definim constantele globale ale proiectului
//* const x = 30; // valabilitate LOCALA
 
define('APP_PATH', 'myApp/'); //! valabilitate GLOBALA
define('CONTROLLERS', 'controllers/');
define('MODELS', 'models/');
define('VIEWS', 'views/');

spl_autoload_register(function ($className) {

    //* cauta clasa in functie de TIPUL fisierului

    $relPath = '';
    $class = strtolower($className);
    if (str_contains($class, 'controller')) {
        $relPath = CONTROLLERS;
    }
    if (str_contains($class, 'model')) {
        $relPath = MODELS;
    }
    if (str_contains($class, 'views')) {
        $relPath = VIEWS;
    }

    $fileName = APP_PATH . $relPath . $className . '.php';
    if ($fileName == '') {
        die('<h1>INVALID PATH</h1>');
    }
    if (file_exists($fileName)) {
        require_once $fileName;
    } else {
        die("<h3>Class $className NOT FOUND!</h3>");
    }
});
