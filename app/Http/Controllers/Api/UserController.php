<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    
    /**
     *  Retorna a lista de usuários
     * @return JsonResponse Retorna os usuários
     */
    public function index(): JsonResponse {
        return response()->json([
            'status' => true,
            'users' => 'Lista de usuários'
        ], 200);
    }
}
