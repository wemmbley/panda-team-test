<?php
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    // ------------------------------------------------------------------------------------
    // Auth routes
    // ------------------------------------------------------------------------------------
    $r->addRoute('GET', '/', 'HomeController@index');
    $r->addRoute('GET', '/auth/login', 'AuthController@webLogin');
    $r->addRoute('GET', '/auth/register', 'AuthController@webRegister');
    $r->addRoute('GET', '/auth/logout', 'AuthController@logout');

    $r->addRoute('POST', '/auth/login', 'AuthController@login');
    $r->addRoute('POST', '/auth/register', 'AuthController@register');


    // ------------------------------------------------------------------------------------
    // Poll routes
    // ------------------------------------------------------------------------------------
    $r->addRoute('GET', '/poll/create', 'PollController@webCreate');
    $r->addRoute('POST', '/poll/create', 'PollController@store');
    $r->addRoute('POST', '/poll/update', 'PollController@update');
    $r->addRoute('GET', '/poll/delete/{id:\d+}', 'PollController@delete');
    $r->addRoute('GET', '/poll/{id:\d+}', 'PollController@single');
});