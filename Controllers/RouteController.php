<?php


class RouteController
{

    public function index()
    {
        $twig = Config::$twig;
        $strSubfolderRoute=Config::$strSubfolderRoute;
        echo $twig->render('home.php' , ['strSubfolderRoute' => $strSubfolderRoute]);
    }

    public function register()
    {
        $twig = Config::$twig;
        $strSubfolderRoute=Config::$strSubfolderRoute;
        echo $twig->render('register.php',['strSubfolderRoute' => $strSubfolderRoute]);
    }

    public function getToken()
    {

        $twig = Config::$twig;
        $strSubfolderRoute=Config::$strSubfolderRoute;
        echo $twig->render('token.php',['strSubfolderRoute' => $strSubfolderRoute]);
    }
}