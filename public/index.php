<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Mattsmithdev\MainController;
use Mattsmithdev\AdminController;

// get action GET parameter (if it exists)
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

// based on value (if any) of 'action' decide which template to output
$mainController = new MainController();
$adminController = new AdminController();
switch ($action){
    case 'about':
        $mainController->about();
        break;
    case 'contact':
        $mainController->contact();
        break;
    case 'list':
        $mainController->listMovies();
        break;
    case 'sitemap':
        $mainController->sitemap();
        break;


    // ------ admin section --------
    case 'newMovieForm':
        $adminController->newMovieForm();
        break;

    case 'createNewMovie':
        $adminController->createNewMovie();
        break;

    case 'index':
    default:
        // default is home page ('index' action)
        $mainController->home();
}