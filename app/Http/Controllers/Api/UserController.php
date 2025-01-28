<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{


    /**
     *  Retorna a lista de usuários
     * @return JsonResponse Retorna os usuários
     */
    public function index(): JsonResponse {
        //Recuperar os usuários do banco de dados
        $users = User::get();

        //Retornar os dados em formato de objeto e status 200
        return response()->json([
            'status' => true,
            'users' => $users
        ], 200);
    }
}
