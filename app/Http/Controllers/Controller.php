<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
* @OA\Info(
*             title="Users CRUD, Login & Logout API For Testing", 
*             version="0.1b",
*             description="API CRUD de usuarios, Login & Logout para Pruebas "
* )
*
* @OA\Server(url="http://localhost/api-auth-tablar/public/api")
*/
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
