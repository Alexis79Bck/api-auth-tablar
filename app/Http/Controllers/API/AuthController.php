<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function register(Request $request) 
    {
        //Lista de reglas de validacion para los campos
        $rules = [
            'fullname' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'username' => ['required', 'string', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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

        //Metodo para crear el registro del usuario
        $user = $this->create($request->input());

        return new JsonResponse([
            'status' => true,
            'message' => __('User has been created successfully'),
            'access_token' => $user->createToken(config('app.short_name'))->plainTextToken
        ], 200);
        
    }

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

        if (!Auth::attempt($request->only($loginType, $loginPassword))) {
            return new JsonResponse([
                'status' => false,
                'errors' => [__('Unauthorized User')]
            ], 401);
        }
        
        $user = User::where($loginType, request()->input($loginType))->first();

        return new JsonResponse([
            'status' => true,
            'data' => $user->only('id','fullname','email','username'),
            'message' => __('User logged in successfully'),
            'access_token' => $user->createToken(config('app.short_name'))->plainTextToken
        ], 200);
       
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

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
            'fullname' => $data['fullname'],
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
