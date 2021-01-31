<?php 

$routesTable = [

    "" => [
        "method" => "post|get",
        "target" => "homeController@index",
        "middleware" => "chinaBlocker"
    ],

    "login/admin" => [
        "method" => "post",
        "target" => "loginController@admin",
        "middleware" => "hasToken"
    ],

    "login" => [
        "method" => "get|post",
        "target" => "loginController@index",
        "middleware" => "hasSession"
    ],

    "articles/show" => [
        "method" => "get",
        "target" => "articelsController@index",
        "middleware" => ""
    ]
    ];