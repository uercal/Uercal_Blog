<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    //
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id','username','password','salt','hashword'];//must be array
    
}
