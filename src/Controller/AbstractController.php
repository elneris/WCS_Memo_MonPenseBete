<?php

namespace App\Controller;

use App\Security\Authentication;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

abstract class AbstractController
{
    protected $twig;

    protected $authenticator;

    public function __construct()
    {
        $loader = new FilesystemLoader(APP_VIEW_PATH);
        $this->authenticator = new Authentication();
        $this->twig = new Environment(
            $loader,
            [
                'cache' => !APP_DEV,
                'debug' => APP_DEV,
            ]
        );
        $this->twig->addExtension(new DebugExtension());
        $this->twig->addGlobal('session', $_SESSION);
        $this->twig->addGlobal('server', $_SERVER);
        $this->twig->addGlobal('post', $_POST);
    }
}