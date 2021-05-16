<?php

namespace App\Controller;

use Twig\Environment as TwigEnvironment;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class IndexController
{

    /**
     * Default IndexController
     *
     * @param Request $request
     * @param Response $response
     * @param TwigEnvironment $twig
     * @return Response
     */
    public function index(
        Request $request,
        Response $response,
        TwigEnvironment $twig
    ) {
        return $response->getBody()->write(
            $twig->render('index.html.twig')
        );
    }
}
