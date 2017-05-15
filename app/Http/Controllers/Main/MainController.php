<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redis;

use App\Http\Models\RedisinfosModel;

class MainController extends Controller
{
    public function __construct(){

    }
       
    public function index(){

        $uid = session('login_user');

        $username = RedisinfosModel::getUsername($uid);
        $username = ucfirst($username);

        $items = Redis::lrange("uid:$uid",0,-1);

        $data = RedisinfosModel::getData($items);       
 
        return view('main.welcome',['data'=>$data,'name'=>$username]);

       
    }

    // 上传数据
    public function up(Request $request){
        
        $data = $request->all();
        $title = $data['title'];
        $content = $data['content'];
        $time = date('Y-m-d H:i:s',time());
        $data = [
            'title'=>$title,
            'time'=>$time,
            'content'=>$content
        ];

        $uid = session('login_user');
        $index = RedisinfosModel::leastItem($uid);            
        $index ++;
        $key = "$uid:item:$index";       
        //装填新数据
        Redis::lpush("uid:$uid",$key);
        Redis::hmset($key,$data);

        return redirect('/main');
    }

   
    //删除blog
    public function del(Request $request){

        $res = $request->all();
        $owner = substr($res['id'],0,1);
        $uid = session('login_user');
        if($owner==$uid){
            Redis::del($res['id']);
            Redis::lrem("uid:$owner",0,$res['id']);
            return 'ok';
        }return 'error';
    }


    function test(){
        
        return view('welcome');

    }



}

