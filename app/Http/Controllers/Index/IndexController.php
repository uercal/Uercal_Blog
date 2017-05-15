<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Http\Models\UsersModel;

use Illuminate\Support\Facades\Redis;

use Symfony\Component\HttpFoundation\Session\Session;

class IndexController extends Controller
{

    public function index(){      
        return view('index.index');
    }

    public function login(Request $request){
        if($request->isMethod('get')){
            return view('index.login');
        }else{
            $data = $request->all();
            unset($data['_token']);
            
            $username = $data['username'];
            $password = $data['password'];

            $model = UsersModel::where('username',$username)->first();
            if($model){
                $result = 'code error!';//默认密码错误
                $salt = $model['salt'];
                $hashword = md5($password.$salt);
                if($hashword==$model['hashword']){
                    $result = 'ok';//密码正确
                    $request->session()->put('login_user', $model['id']);//写入session[ use 帮主函数]
                    //Redis::set('login_user',$model['id']);//登录状态存入Redis
                    };
                return $result;
            }else{
                return 'user not exist!';
            }
        }

    }


    public function regist(Request $request){        
        if($request->isMethod('get')){
            return view('index.regist');
        }else{
            //获取数据，组装数据
            $data = $request->all();
            $username = $data['username'];
            $password = $data['password'];
            $salt = mt_rand();
            $hashword = md5($password.$salt);
            //查重
            $result = UsersModel::where('username',$username)->first();
            if($result){
                return 'user exist!';
            }else{
                //插入数据
                $data = [
                'username'=>$username,
                'salt'=>$salt,
                'hashword'=>$hashword
                ];                
                $result = UsersModel::create($data);
                return 'ok';
            }        
        }
    }

    public function test(){
        
        return view('welcome');
        





    }



}
