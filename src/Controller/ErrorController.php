<?php


namespace App\Controller;

class ErrorController extends AbstractController
{
    public function pageNotFound()
    {
        return $this->twig->render('Home/404.html.twig');
    }
}
