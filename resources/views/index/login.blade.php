<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <title>Index</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
    <link rel="stylesheet" href="{{asset('/public/css/2.css')}}">
    <link rel="stylesheet" href="{{asset('/public/css/main.css')}}">
    <script src="{{asset('/public/js/jquery.js')}}"></script>
    <script src="{{asset('/public/js/layer/layer.js')}}"></script>
    <script src="{{asset('/public/js/vue.min.js')}}"></script>
    <script src="{{asset('/public/js/vue-resource.min.js')}}"></script>
    <style>
    .warn{
        width:630px;text-align:center;
    }
    </style>
</head>

<body>
    <div _v-76c787ff="" id="app">
        <div class="ivu-row-flex ivu-row-flex-middle ivu-row-flex-center">
            <div class="ivu-col ivu-col-span-8">
                <h1 class="title"><img src="{{asset('/public/images/2.png')}}" width="200" height="60" style="position:relative;top:70px;"></h1>
                <form class="ivu-form ivu-form-label-right" id="form">
                    <div class="ivu-form-item ivu-form-item-required">
                        <label class="ivu-form-item-label">用户名</label>
                        <!--v-if-->
                        <div class="ivu-form-item-content">
                            <div class="ivu-input-wrapper ivu-input-type ivu-input-group">
                                <div class="ivu-input-group-prepend"><i slot="prepend" class="ivu-icon ivu-icon-ios-person-outline"></i>
                                    <!--v-component-->
                                </div>
                                <!--v-if-->
                                <i class="ivu-icon ivu-icon-load-c ivu-load-loop fade-transition ivu-input-icon ivu-input-icon-validate"></i>
                                <!--v-if-->

                                <input class="ivu-input" type="text" name="username" v-model="username" placeholder="请输入用户名">

                                <!--v-if-->
                                <!--fragment-end-->
                                <!--v-if-->

                            </div>
                            <!--v-component-->
                            <!--v-if-->
                        </div>
                    </div>                

                    <div class="ivu-form-item ivu-form-item-required">
                        <label class="ivu-form-item-label">密码</label>
                        <!--v-if-->
                        <div class="ivu-form-item-content">
                            <div class="ivu-input-wrapper ivu-input-type ivu-input-group">
                                <!--fragment-start-->
                                <div class="ivu-input-group-prepend"><i slot="prepend" class="ivu-icon ivu-icon-ios-locked-outline"></i>
                                    <!--v-component-->
                                </div>
                                <!--v-if-->
                                <i class="ivu-icon ivu-icon-load-c ivu-load-loop fade-transition ivu-input-icon ivu-input-icon-validate"></i>
                                <!--v-if-->

                                <input class="ivu-input" type="password" v-model="password" placeholder="请输入密码">
                                <!--v-if-->
                                <!--fragment-end-->
                                <!--v-if-->
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                            </div>
                            <!--v-component-->
                            <!--v-if-->
                        </div>
                    </div>
                              
                    <span style="color:red;" class="">@{{warn}}</span>
                                     
                    <div class="ivu-form-item" @click="sub">
                        <!--v-if-->
                        <div class="ivu-form-item-content" id="sub">
                            <button class="ivu-btn ivu-btn-ghost ivu-btn-long" type="button">
                                <span>登录</span><!--v-if-->
                            </button>                                                   
                        </div>
                    </div>
                    
                    <!--v-component-->

                    <div class="ivu-form-item">
                        <!--v-if-->
                        <div class="ivu-form-item-content">
                            <a href="{{url('/regist')}}">还没有账号？点击注册</a>
                            <!--v-if-->
                        </div>
                    </div>
                    <!--v-component-->
                </form>
                <!--v-component-->
            </div>
            <!--v-component-->
        </div>
        <!--v-component-->
        <!--v-end-->
        <!--v-component-->
    </div>
</body>
<script>

$(function(){
    $('#form')[0].reset();
});

    new Vue({
        el:'#app',
        data:{
            username:'',
            password:'',
            warn:''          
        },
        methods:{
            sub:function(){
                if(this.username==''||this.password==''){
                    this.warn='用户名或密码不能为空'
                }else{
                    this.$http.post('',{username:this.username,password:this.password,_token:'{{csrf_token()}}'}).then(function(response){
                        if(response.data=='ok'){
                            window.location.href="{{url('/main')}}";
                        }else{this.warn = response.data}
                    },function(response){
                        console.log(response);
                    });
                }
            }
        }          
    })
</script>
</html>