<?php
namespace Mattsmithdev;

class MainController
{
    function home()
    {
        $tpageTitle = 'home';
        $homePageStyle = "current_page";
        require_once __DIR__ . '/../templates/index.php';
    }

    function about()
    {
        $pageTitle = 'about';
        $aboutPageStyle = "current_page";
        require_once __DIR__ . '/../templates/about.php';
    }


    function contact()
    {
        $pageTitle = 'contact';
        $contactPageStyle = 'current_page';
        require_once __DIR__ . '/../templates/contact.php';
    }


    function listMovies()
    {
        $movieRepository = new \Mattsmithdev\MovieRepository();
        $movies = $movieRepository->getAll();

        $pageTitle = 'list';
        $listPageStyle = 'current_page';
        require_once __DIR__ . '/../templates/list.php';
    }


    function sitemap()
    {
        $pageTitle = 'sitemap';
        $sitemapPageStyle = 'current_page';
        require_once __DIR__ . '/../templates/sitemap.php';
    }
}

