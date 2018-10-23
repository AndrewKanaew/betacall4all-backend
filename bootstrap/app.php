<?php

    require_once __DIR__ . "/../vendor/autoload.php";

    $app = new \Slim\App([
        "settings" => [
            "displayErrorDetails" => true,
            "soap" => [
                "url" => "https://is.topdelivery.ru/api/soap/c/2.0/index.php?WSDL",
                "httpLogin" => "tdsoap",
                "httpPassword" => "fc7a00f11c1bfa9f5b69e0be9117738e",
                "queryLogin" => "Kobotovcall",
                "queryPassword" => "MaIAcLss",
            ],
            "db" => [

            ]
        ]
    ]);

    $container = $app->getContainer();

    $container["soap"] = function ($container) {
        $client = new SoapClient($container->get("settings")["soap"]["url"], [
            "login" => $container->get("settings")["soap"]["httpLogin"],
            "password" => $container->get("settings")["soap"]["httpPassword"],
        ]);

        return $client;
    };

    $container["CronController"] = function ($container) {
        return new \App\Controllers\CronController($container);
    };

    require_once __DIR__ . "/../app/routes.php";