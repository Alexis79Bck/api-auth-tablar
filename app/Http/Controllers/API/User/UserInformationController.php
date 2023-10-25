<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller; 
use App\Models\UserInformation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserInformationController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Lista de reglas de validacion para los campos
        $rules = [
            'fullname' => ['required', 'string', 'max:100'],                
            'address' => ['nullable', 'string', 'max:100'],
            'country' => ['required', 'string', 'max:60'],
            'city' => ['required', 'string', 'max:60'],
            'phone' => ['nullable', 'numeric', 'max:14'], 
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
        return UserInformation::create([
            'fullname' => $data['fullname'],                
            'address' => $data['address'],
            'country' => $data['country'],
            'city' => $data['city'],
            'phone' => $data['phone']
        ]);
    }
}
