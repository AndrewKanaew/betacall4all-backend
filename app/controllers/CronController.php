<?php

namespace App\Controllers;


use App\Models\Order;
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
     * @return mixed
     */

    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $countAdd = 0;
        $countSkip = 0;
        $orders = $this->soap->getCallOrders([
            "auth" => [
                "login" => $this->container->get("settings")["soap"]["queryLogin"],
                "password" => $this->container->get("settings")["soap"]["queryPassword"]
            ]
        ])->orderInfo;

        foreach ($orders as $item) {

            if (Order::where('topdelivery_id', $item->orderIdentity->orderId)->count() === 0) {
                $countAdd++;
                $order = new Order();

                $order->topdelivery_id = $item->orderIdentity->orderId;
                $order->data = json_encode($item);
                $order->status = 0;
                $order->member_id = null;

                $order->save();

            } else {
                $countSkip++;
            };

        }

        return $response->withJson([
            "message" => "Добавленно " . $countAdd . " записей. Пропущенно " . $countSkip . " записей."
        ]);


    }

}