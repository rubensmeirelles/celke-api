<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){

            //Recuperar os dados do usuário logado
            $user = Auth::user();

            //Criar o token
            $token = $request->user()->createToken('api-token')->plainTextToken;

            return response()->json([
                'status' => true,
                'token' => $token,
                'user' => $user,
                'message' => 'Logado'
            ], 201);

        } else {
            return response()->json([
                'status' => false,
                'message' => 'Login ou senha inválidos'
            ], 404);
        }

    }

    public function logout(): JsonResponse{

        try{

            $authUserId = Auth::check() ? Auth::id() : '';

            if(!$authUserId){
                return response()->json([
                    'status' => false,
                    'message' => 'Usuário não está logado'
                ], 400);
            }

            //Recuperar os dados do usuário logado
            $user = User::where('id', $authUserId)->first();

            //Excluir o token do usuário
            $user->tokens()->delete();

            return response()->json([
                'status' => true,
                'message' => 'Deslogado com sucesso.'
            ], 200);

        } catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Não deslogado'
            ], 400);
        }

    }
}
