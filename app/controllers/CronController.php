<?php

namespace App\Controllers;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class CronController
 * @package App\Controllers
 */

class CronController extends Controller
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */

    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $orders = $this->soap->getCallOrders([
            "auth" => [
                "login" => $this->container->get("settings")["soap"]["queryLogin"],
                "password" => $this->container->get("settings")["soap"]["queryPassword"]
            ]
        ]);

        var_dump($orders);
    }

}