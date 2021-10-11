<?php

namespace App\Controllers;

class HomeController extends Controller
{
    public function index($request, $response)
    {
        $greeting = "Hello world!";

        return $this->view->render($response, "home.twig", [
            'greeting' => $greeting,
        ]);
    }
}
