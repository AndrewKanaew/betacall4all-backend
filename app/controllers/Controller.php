<?php

namespace App\controllers;


class Controller
{
    /**
     * @var $container;
     */

    protected $container;

    /**
     * Controller constructor.
     * @param $container
     */

    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * @param $protected
     * @return mixed|null
     */

    public function __get($protected)
    {
        if ($this->container->{$protected}) {
            return $this->container->{$protected};
        } else {
            return null;
        }
    }
}