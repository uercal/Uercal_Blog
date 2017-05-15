<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redis;

use App\Http\Models\RedisinfosModel;

use App\Http\Requests\MessageRequest;


class DetailController extends Controller
{
     // 详情
    public function detail($id){                   
        $re_uid = substr($id,0,1);       
        //展示
        $model = \App\Http\Models\UsersModel::find($re_uid);
        $username = $model['username'];  
        $data = Redis::hgetall($id);
        //加载评论
        $comments = RedisinfosModel::loadComments($id);
        if($data){                
            return view('main.detail',['data'=>$data,'name'=>$username,'comments'=>$comments]);
        }
        return view('errors.503');       
    }


    // 留言
    public function leaveMessage($id,MessageRequest $request){
        //获取当前时间
        $time = date('Y-m-d H:i:s',time());       
        //获取评论内容
        $res = $request->all();        
        $comments = $res['message'];
        //获取评论用户
        $uid = session('login_user');
        $model = \App\Http\Models\UsersModel::find($uid);
        //组装数据
        $data = ['comments'=>$comments,'time'=>$time,'name'=>$model['username']];
        //获取新索引
        $commentId = RedisinfosModel::upNewCommentsIndex($id);
        // return $commentId;
        //插入数据
        $result = Redis::hmset($commentId,$data);
        if($result){
            return 'ok';
        }
        return 'error';
    }


}
