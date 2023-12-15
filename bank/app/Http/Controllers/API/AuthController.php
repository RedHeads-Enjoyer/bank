<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class AuthController extends Controller
{
    // Конструктор класса
    public function __constructor() {
        $this->middleware('auth:api')->except('login');
    }

    // Метод входа
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        if ($token = auth('api')->attempt($credentials)) {
            setcookie('token',      $token, time() + 3600 * 24, '/');
            setcookie('login_time', date("Y-m-d H:i:s"), time() + 3600 * 24, '/');
            setcookie('ip', $_SERVER['REMOTE_ADDR'], time() + 3600 * 24, '/');
            return $this->respondWithToken($token);
        }
        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    // Вывод ответа с токеном и дополнительной информацией
    private function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'type' => 'Bearer',
            'expired in '=> Config::get('jwt.ttl') * 60
        ]);
    }

    // Выход
    public function logout(){
        auth('api')->logout();
        return response()->json(['data' => 'Successfully logged out']);
    }

    // Обнолвение токена
    public function refresh(){
        return $this->respondWithToken(auth('api')->refresh());
    }

    // Получение пользователя
    public function user(){
        return response()->json(auth('api')->user());
    }


}
