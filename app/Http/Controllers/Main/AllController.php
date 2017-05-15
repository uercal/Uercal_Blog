<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Http\Requests;

use Illuminate\Support\Facades\Redis;

use App\Http\Models\RedisinfosModel;

class AllController extends Controller
{
    public function __construct(){

    }


    public function index(){

        $uid = session('login_user');
        $username = \App\Http\Models\UsersModel::find($uid);
        $username = ucfirst($username);

        $data = RedisinfosModel::getAllBlogsInfos();
        
        return view('main.all',['data'=>$data]);        

    }










}
