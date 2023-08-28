<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
    }

    public function login(Request $request)
    {
        $data = $request->all();

        if(!$token = auth('api')->attempt($data)){
            return response()->json(['error' => 'Sem utorização'], 401);
        }

        return $this->createNewToken($token);
    }

    public function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth('api')->user(),
        ]); 
    }

    public function profile(){
        return response()->json(auth()->user());
    }

    public function logout(){
        auth()->logout();
        return response()->json([
            'message' => 'Usuario deslogado com sucesso',
        ],201);
    }
}
