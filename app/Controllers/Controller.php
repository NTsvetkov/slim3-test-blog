<?php

namespace App\Controllers;

class Controller
{
    protected $container;
    protected $em;

    public function __construct($container)
    {
        $this->container = $container;
        $this->em = $container->get('em');
    }

    public function __get($property)
    {
        if ($this->container->{$property}) {
            return $this->container->{$property};
        }
    }
}