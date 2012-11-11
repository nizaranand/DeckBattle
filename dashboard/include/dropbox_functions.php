<?php
// Register a simple autoload function
spl_autoload_register(function($class){
    $class = str_replace('\\', '/', $class);
    require_once('dashboard/services/dropbox/' . $class . '.php');
});

// Set your consumer key, secret and callback URL
$key      = 'd996418kclovvy0';
$secret   = 'qheyeqidsgptlhb';

// Check whether to use HTTPS and set the callback URL
$protocol = (!empty($_SERVER['HTTPS'])) ? 'https' : 'http';
$callback = $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

// Instantiate the Encrypter and storage objects
$encrypter = new \Dropbox\OAuth\Storage\Encrypter('XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX');

?>