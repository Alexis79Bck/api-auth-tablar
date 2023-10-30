<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
* @OA\Info(
*             title="Login & Logout API For Testing", 
*             version="0.1b",
*             description="URI's para Login y Logout API"
* )
*
* @OA\Server(url="http://localhost/api-auth-tablar/public/api")
*/

class AuthController extends Controller
{

    /**
     * Login del Usuario
     * @OA\Post (
     *     path="/v1/auth/login",
     *     operationId="login",
     *     tags={"Auth"}, 
     *      @OA\RequestBody(
     *         description="Datos del Login",
     *         required=true,         
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="usernameOrEmail",
     *                     description="Nombre de Usuario o Correo Electrónico",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                    property="password",
     *                    description="Contraseña",
     *                    type="string"
     *                ),
     *                required={"usernameOrEmail", "password"}
     *             )
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Inicio de sesión exitosa",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Usuario no autorizado",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Credenciales Incorrecta",
     *     ),
     * )
     * 
     * Retorna la información del usuario y el token de acceso correspondiente.
     */
    public function login(Request $request): JsonResponse
    {
        
        //Asignar las llaves de la solicitud a variables establecidas
        list($loginUser, $loginPassword) = array_keys($request->input());
        
        //Lista de reglas de validacion para los campos
        $rules = [            
            $loginUser => ['required', 'string', 'max:100'],
            $loginPassword => ['required', 'string', 'min:8'],
        ];

        //Metodo validador de los campos que se encuentran en la solicitud
        $validator = $this->validator($request->input(), $rules);
        
        //Si el metodo validador falla, returna una respuesta Json con los errores
        if ($validator->fails()){
            return new JsonResponse([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        //Metodo que retorna el tipo de login: Username o Email
        $loginType = $this->selectLoginType(request()->input($loginUser));

        request()->merge([
            $loginType => request()->input($loginUser)
        ]);

        //Valida si el usuario es autorizado
        if (!Auth::attempt($request->only($loginType, $loginPassword))) {
            return new JsonResponse([
                'status' => false,
                'errors' => [__('Unauthorized User')]
            ], 401);
        }
        
        //Obtiene la data del usuario
        $user = User::where($loginType, request()->input($loginType))->first();

        //Retorna la respuesta exitosa con la información del usuario y su token de acceso.
        return new JsonResponse([
            'status' => true,
            'data' => $user,
            'message' => __('User logged in successfully'),
            'access_token' => $user->createToken(config('app.short_name'))->plainTextToken
        ], 200);
       
    }

    /**
     * Logout del Usuario
     * @OA\Get (
     *     path="/v1/auth/logout",
     *     operationId="logout",
     *     tags={"Auth"}, 
     *     @OA\Response(
     *         response=200,
     *         description="Cierre de sesión exitosa",
     *     ),
     * )
     * 
     * Cierre de sesión del usuario.
     */
    public function logout(Request $request)
    {
        Auth::logout();
 
        //Invalida la session una vez que el usuario haya cerrado la sesión
        $request->session()->invalidate();
    
        //regenera el token para su acceso
        $request->session()->regenerateToken();

        return new JsonResponse([
            'status' => true, 
            'message' => __('User logged out successfully'), 
        ], 200);
    }

    protected function validator(array $data, array $rules)
    {
        return Validator::make($data, $rules); 
    }

    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function selectLoginType(string $loginText)
    {
        return filter_var($loginText, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    }

   
}
