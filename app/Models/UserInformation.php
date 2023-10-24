<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    use HasFactory;

    protected $table = 'users_information';

    protected $fillable = [
        'fullname',
        'phone',
        'address',
        'country',
        'city',
        'user_id'
    ];
}
