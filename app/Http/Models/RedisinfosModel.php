<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Redis;

class RedisinfosModel extends Model
{   

    //BLOGS:
    //获取该用户最新的索引
    public static function leastItem($uid){
        
        if(Redis::llen("uid:$uid")==0){
            return 0;
        }else{
            return substr(Redis::lrange("uid:$uid",0,0)[0],-1,1);
        }
       
    }

    //根据list key值在set 中获取data  以及  key
    public static function getData($items){
        if ($items) {
            foreach ($items as $key => $value) {
                $data[$key] = ['data'=>Redis::hgetall($value),'key'=>$value];
                $data[$key]['data']['content'] = mb_substr(strip_tags($data[$key]['data']['content']),0,10,'utf-8').'.......';
            }           
            return $data;
        }
        return [];
    }

    //根据id获取用户名
    public static function getUsername($uid){
        $model = \App\Http\Models\UsersModel::find($uid);
        if($model){
            return $model['username'];
        }else{
            return null;
        }
    }


    //CommentS:
    // 加载评论
    public static function loadComments($id){
        $item = $id;
        $comment = "comment:$item";
        $indexs = Redis::lrange($comment,0,-1);
        if($indexs){
            $count = count($indexs);
            foreach ($indexs as $key => $value) {
                $comments[$key] = Redis::hgetall($value);
            }
            return $comments;
        }else{
            return [];
        }
    }

    public static function upNewCommentsIndex($id){
        $maxIndex = Redis::lrange("comment:$id",0,0);        
        if(count($maxIndex)!=0){
            $maxIndex = $maxIndex[0];
            $maxIndex = substr($maxIndex,-1,1);
            $maxIndex++;
            Redis::lpush("comment:$id","$id:comment:$maxIndex");
            return "$id:comment:$maxIndex";
        }else{
            Redis::lpush("comment:$id","$id:comment:1");
            return "$id:comment:1";
        }        
    }



    //ALL:
    //获取所有blogs索引以及标题，作者，时间，粗略内容
    public static function getAllBlogsInfos(){
        $blogsIndex = Redis::keys('?:item:?');

        foreach ($blogsIndex as $key => $value) {            
            $data[$key] = Redis::hgetall($value);
            $data[$key]['itemid'] = $value;
            $data[$key]['username'] = self::getUsername($value);
            $data[$key]['content'] = mb_substr(strip_tags($data[$key]['content']),0,10,'utf-8').'.......';
        }
        return $data;
    }

    
}
