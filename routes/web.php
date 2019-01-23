<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(["prefix" => "/todo"], function($todo){
    
   $todo->get('/item[/{todoitem}]', ["as" => "todo.list", "uses" => 'TodoController@index']);
   $todo->post('/item', ["as" => "todo.new", "uses" => 'TodoController@store']);
   $todo->put('/item/{todoitem}', ["as" => "todo.update", "uses" => 'TodoController@update']);
   $todo->delete('/item/{todoitem}', ["as" => "todo.delete", "uses" => 'TodoController@softDelete']);
   
   $todo->get('/status[/{status}]', ["as" => "status.list", "uses" => 'StatusController@index']);
   $todo->post('/status', ["as" => "status.new", "uses" => 'StatusController@store']);
   $todo->put('/status/{status}', ["as" => "status.update", "uses" => 'StatusController@update']);
   $todo->delete('/status/{status}', ["as" => "status.delete", "uses" => 'StatusController@softDelete']);
});
