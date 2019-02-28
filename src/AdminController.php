<?php
namespace Mattsmithdev;

class AdminController
{
    function newMovieForm()
    {
        $pageTitle = 'new movie';
        require_once __DIR__ . '/../templates/newMovieForm.php';
    }

    function createNewMovie()
    {
        $title = filter_input(INPUT_GET, 'title');
        $price = filter_input(INPUT_GET, 'price');

        $isValid = true;
        $errors = [];
        if(empty($title)) {
            $isValid = false;
            $errors[] = '- missing or empty title';
        }

        if(empty($price)){
            $isValid = false;
            $errors[] = '- missing or empty price';
        } elseif(empty($price)){
            $isValid = false;
            $errors[] = '- price was not a number';
        }



        if($isValid){
            $this->insertMovie($title, $price);
        } else {
            $pageTitle = 'error';
            require_once __DIR__ . '/../templates/error.php';
        }


    }

    private function insertMovie($title, $price)
    {
        $movie = new Movie();
        $movie->setTitle($title);
        $movie->setPrice($price);

        $movieRepository = new MovieRepository();
        $success = $movieRepository->create($movie);

        if($success){
            // now list all movies
            $mainController = new MainController();
            $mainController->listMovies();
        } else {
            $errors = [];
            $errors[] = "there was an error trying to create movie with title = '$title' and price = '$price'";
            $pageTitle = 'error';
            require_once __DIR__ . '/../templates/error.php';
        }
    }
}

