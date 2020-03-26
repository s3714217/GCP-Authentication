<?php

//ref : Google php-docs-samples-master github
switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
    case '/':
        require 'login.php';
        break;
    case '/main.php':
        require 'main.php';
        break;
    case '/name.php':
        require 'name.php';
        break;
    case '/password.php':
        require 'password.php';
        break;
    default:
        http_response_code(404);
        exit('Not Found');
}
