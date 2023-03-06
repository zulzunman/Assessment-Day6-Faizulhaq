<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

$router->group(['prefix' => 'penjualan'], function () use ($router) {
    $router->get('/', function () {
        return response()->json([
            [
                "id" => "1",
                "nomor" => "SALE/001",
                "customer" => "joko"
            ],
            [
                "id" => "2",
                "nomor" => "SALE/002",
                "customer" => "agus"
            ],
            [
                "id" => "3",
                "nomor" => "SALE/003",
                "customer" => "bayu"
            ],
        ]);
    });
    $router->get('/{id}', function ($id) {
        return response()->json(['msg' => [
            [
                "id" => "1",
                "nomor" => "SALE/001",
                "customer" => "joko",
                "tolal" => 2000000,
                "alamat" => "Bandung"
            ]
        ]]);
    });
    $router->post('/', function(){
        return response()->json([
            'msg' => "berhasil",
            'id' => 4
        ]);
    });
    $router->put('/{id}', function (Request $request, $id) {
        $nomor = $request->input('nomor');
        return response()->json(['msg' => [
            [
                "id" => $id,
                "nomor" => $nomor,
                "customer" => "joko",
                "tolal" => 2000000,
                "alamat" => "Bandung"
            ]
        ]]);
    });
    $router->delete('/{id}', function ($id) {
        return response()->json(['msg' => "berhasil delete"]);
    });
    $router->get('/{id}/confirm', function (Request $request, $id) {
        $user = $request->user();
        if($user == null){
            return response()->json(['error' => 'Unauthorized'], 401, ['X-Header-One' => 'Header Value']);
        }
        return response()->json(['msg' => "berhasil confirm"]);
    });
    
    $router->get('/{id}/send-email', function (Request $request, $id) {
        $user = $request->user();
        Mail::raw('This is the email body.', function ($message){
            $message->to('zulzunn@gmail.com')
                ->subject('Lumen email bor');
        });
        if($user == null){
            return response()->json(['error' => 'Unauthorized'], 401, ['X-Header-One' => 'Header Value']);
        }
        return response()->json(['msg' => "berhasil confirm"]);
    });
});