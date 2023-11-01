<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * Mostrar listado de Usuarios
     * @OA\Get (
     *     path="/v1/users",
     *     tags={"USERS"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de todos los Usuarios",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="boolean",
     *                 property="status",
     *                 example="true"
     *             ),
     *             @OA\Property(
     *                 type="array",
     *                 property="data",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="fullname",
     *                         type="string",
     *                         example="John Doe"
     *                     ),
     *                     @OA\Property(
     *                         property="birthday",
     *                         type="date",
     *                         example="1981-04-01"
     *                     ),
     *                     @OA\Property(
     *                         property="phone",
     *                         type="string",
     *                         example="3351425869"
     *                     ),
     *                     @OA\Property(
     *                         property="address",
     *                         type="string",
     *                         example="Urb. Virgen del Carmen, Conjunto Residencial La Floresta"
     *                     ),
     *                     @OA\Property(
     *                         property="country",
     *                         type="string",
     *                         example="Venezuela"
     *                     ),
     *                     @OA\Property(
     *                         property="city",
     *                         type="string",
     *                         example="Puerto La Cruz"
     *                     ),
     *                     @OA\Property(
     *                         property="email",
     *                         type="email",
     *                         example="john.doe43@example.com"
     *                     ),
     *                     @OA\Property(
     *                         property="username",
     *                         type="string",
     *                         example="jdoe43"
     *                     ),
     *                     @OA\Property(
     *                         property="status",
     *                         type="boolean",
     *                         example=1
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         example="2023-02-23T00:09:16.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         example="2023-02-23T12:33:45.000000Z"
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Lista Vacía",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="boolean",
     *                 property="status",
     *                 example="true"
     *             ),
     *             @OA\Property(
     *                 type="string",
     *                 property="data",
     *                 example=null
     *             ),
     *         )
     *     )
     * )
     */    
    public function index()
    {
        $users = User::all();

       return  new JsonResponse([
                        'status' => true,
                        'data' => $users,
                    ], isset($users) ? 200 : 204);
            
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Lista de reglas de validacion para los campos
        $rules = [
            'fullname' => ['required', 'string', 'max:100'],
            'birthday' => ['required', 'date'],
            'country' => ['required', 'string', 'max:60'],
            'city' => ['required', 'string', 'max:60'],
            'address' => ['nullable', 'string', 'max:100'],
            'phone' => ['nullable', 'numeric', 'max:14'],
            'email' => ['required', 'string', 'email', 'max:80', 'unique:users'],
            'username' => ['required', 'string', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        //Metodo validador de los campos que se encuentran en la solicitud
        $validator = $this->validator($request->input(), $rules);

        //Si el metodo validador falla, retorna una respuesta Json con los errores
        if ($validator->fails()) {
            return new JsonResponse([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        //Metodo para crear el registro del usuario
        $user = $this->create($request->input());

        return new JsonResponse([
            'status' => true,
            'message' => __('User has been created successfully'),
            'access_token' => $user->createToken(config('app.short_name'))->plainTextToken
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    protected function validator(array $data, array $rules)
    {
        return Validator::make($data, $rules);
    }

    protected function create(array $data)
    {
        return User::create([
            'fullname' => $data['fullname'],
            'birthday' => $data['birthday'],
            'country' => $data['country'],
            'city' => $data['city'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
