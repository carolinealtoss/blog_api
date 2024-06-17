<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use App\Docs\Swagger\UserComponents;

class UserController extends Controller
{
    /**
    * @OA\GET(
    *   path="/api/user",
    *   summary="Get all users",
    *   tags={"User"},
    *   @OA\Response(
    *       response=200,
    *       description="Ok",
    *       @OA\MediaType(
    *           mediaType="application/json",
    *       )
    *   ),
    * )
    */
    public function index()
    {
        $users = User::all();
        return response()->json($users, Response::HTTP_OK);
    }

    /**
    * @OA\POST(
    *   path="/api/user",
    *   summary="Create a new user",
    *   tags={"User"},
    *   @OA\RequestBody(
    *       @OA\MediaType(
    *           mediaType="application/json",
    *           @OA\Schema(
    *               @OA\Property(
    *                   property="name",
    *                   type="string"
    *                 ),
    *               @OA\Property(
    *                   property="username",
    *                   type="string"
    *                ),
    *               @OA\Property(
    *                   property="email",
    *                   type="email"
    *                ),
    *               @OA\Property(
    *                   property="password",
    *                   type="string"
    *                ),
    *               example={
    *                   "name": "Anabela Smith",
    *                   "username": "anabelasmith",
    *                   "email": "anabelasmith@email.com",
    *                   "password": "password-1234"
    *               }
    *             )
    *         )
    *     ),
    *   @OA\Response(
    *       response=200,
    *       description="Ok",
    *       @OA\MediaType(
    *           mediaType="application/json",
    *       )
    *   ),
    *   @OA\Response(
    *       response=404,
    *       description="User not found"
    *   )
    * )
    */
    public function store(Request $request)
    {
        $validator = User::validate($request->all());

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json($user, Response::HTTP_CREATED);
    }

    /**
    * @OA\GET(
    *   path="/api/user/{user_id}",
    *   summary="Get a specific user",
    *   tags={"User"},
    *   @OA\Parameter(
    *       name="user_id",
    *       in="path",
    *       required=true,
    *       @OA\Schema(
    *           type="integer"
    *       )
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Ok",
    *       @OA\MediaType(
    *           mediaType="application/json",
    *       )
    *   ),
    *   @OA\Response(
    *       response=404,
    *       description="User not found"
    *   )
    * )
    */
    public function show(User $user)
    {
       if (!$user) {
            return response()->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
       }

       return response()->json($user, Response::HTTP_OK);
    }

    /**
    * @OA\PUT(
    *   path="/api/user/{user_id}",
    *   summary="Update a specific user",
    *   tags={"User"},
    *   @OA\Parameter(
    *       name="user_id",
    *       in="path",
    *       required=true,
    *       @OA\Schema(type="integer")
    *   ),
    *   @OA\RequestBody(
    *      @OA\JsonContent(
    *         required={"name","username", "email", "password"},
    *         @OA\Property(
    *             property="name",
    *             type="string",
    *             example="Anabela Flore"
    *         ),
    *         @OA\Property(
    *             property="username",
    *             type="string",
    *             example="anabelaflore"
    *         ),
    *         @OA\Property(
    *             property="email",
    *             type="string",
    *             format="email",
    *             example="anabela@mail.com"
    *         ),
    *         @OA\Property(
    *             property="password",
    *             type="string",
    *             format="password",
    *             example="Password-AnabelaFlore1234"
    *         ),
    *      ),
    *   ),
    *   @OA\Response(
    *     response=200,
    *     description="Ok",
    *   ),
    *   @OA\Response(
    *     response=404,
    *     description="User not found"
    *   )
    * )
    */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        $data = $request->all();

        // Remove o campo 'password' da validação se ele não for enviado na requisição
        if (!$request->has('password')) {
            unset($data['password']);
        }

        $validator = $user->validate($data);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $validated = $validator->validated();

        // Se a senha estiver presente, hash a senha
        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return response()->json($user, Response::HTTP_OK); // Retornar HTTP 200 OK para atualização bem-sucedida
    }

    /**
    * @OA\DELETE(
    *      path="/api/user/{user_id}",
    *      summary="Delete a specific user",
    *      tags={"User"},
    *      @OA\Parameter(
    *          name="user_id",
    *          in="path",
    *          required=true,
    *          @OA\Schema(type="integer")
    *      ),
    *      @OA\Response(
    *          response=204,
    *          description="User deleted"
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="User not found"
    *      )
    *  )
    */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted sucessfully'], Response::HTTP_OK);
    }
}
