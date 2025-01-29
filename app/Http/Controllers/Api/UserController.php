<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller
{


    /**
     *  Retorna a lista de usuários
     * @return JsonResponse Retorna os usuários
     */
    public function index(): JsonResponse
    {
        //Recuperar os usuários do banco de dados
        //$users = User::get();

        //Recuperar registros com paginação
        $users = User::orderBy('id', 'DESC')->paginate(40);

        //Retornar os dados em formato de objeto e status 200
        return response()->json([
            'status' => true,
            'users' => $users,
            'message' => 'Usuário cadastrado com sucesso!'
        ], 200);
    }

    public function show(User $user): JsonResponse
    {
        //Retornar os dados em formato de objeto e status 200
        return response()->json([
            'status' => true,
            'users' => $user
        ], 200);
    }

    public function store(UserRequest $request): JsonResponse
    {

        DB::beginTransaction();

        try{

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            //Operação concluída com sucesso!
            DB::commit();

            //Retornar os dados em formato de objeto e status 201
            return response()->json([
                'status' => true,
                'user' => $user
            ], 201);
        } catch(Exception $e) {
            //Operação não realizada!
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Usuário não cadastrado!'
            ], 400);
        }
    }

    public function update(UserRequest $request, User $user): JsonResponse
    {
        // Iniciar a transação
        DB::beginTransaction();

        try{

                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);

                //Operação concluída com sucesso!
                DB::commit();

            //Retornar os dados em formato de objeto e status 201
            return response()->json([
                'status' => true,
                'users' => $user,
                'message' => 'Usuário editado com sucesso!'
            ], 200);

        } catch(Exception $e) {
            //Operação não realizada!
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Usuário não editado!'
            ], 400);
        }
    }

    public function destroy(User $user): JsonResponse
    {
        try{

            //Excluir o registro
            $user->delete();

            //Retornar os dados em formato de objeto e status 201
            return response()->json([
                'status' => true,
                'users' => $user,
                'message' => 'Usuário excluído com sucesso!'
            ], 200);

        } catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Usuário não excluído!'
            ], 400);
        }
    }

    public function updatePassword(UserPasswordRequest $request, User $user): JsonResponse
    {

        // Iniciar a transação
        DB::beginTransaction();
        try{

                $user->update([
                    'password' => $request->password,
                ]);

                //Operação concluída com sucesso!
                DB::commit();

            //Retornar os dados em formato de objeto e status 201
            return response()->json([
                'status' => true,
                'users' => $user,
                'message' => 'Senha editada com sucesso!'
            ], 200);

        } catch(Exception $e) {
            //Operação não realizada!
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Senha não editada!'
            ], 400);
        }
    }
}
