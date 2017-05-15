<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('/public/css/3.css')}}">
    <link rel="stylesheet" href="{{asset('/public/css/main.css')}}">    
    <link rel="" type="" href="">
    <script src="{{asset('/public/js/jquery.js')}}"></script>    
    <script src="{{asset('/public/js/layer/layer.js')}}"></script>
    <script src="{{asset('/public/js/vue.min.js')}}"></script>
    <script src="{{asset('/public/js/vue-resource.min.js')}}"></script>
</head>
<body>
    <div _v-76c787ff="" id="app">
        <div class="ivu-row-flex ivu-row-flex-middle ivu-row-flex-center" id="app">
            <div class="ivu-col ivu-col-span-8">
            <h1 class="title">
            <img src="{{asset('/public/images/2.png')}}" width="200" height="60" style="position:relative;top:80px;"></h1>
            <form class="ivu-form ivu-form-label-right">                
				<div class="ivu-form-item">
                    <label class="ivu-form-item-label">用户名</label><!--v-if-->
                    <div class="ivu-form-item-content">
                        <div class="ivu-input-wrapper ivu-input-type ivu-input-group">
                            <div class="ivu-input-group-prepend"><i slot="prepend" class="ivu-icon ivu-icon-ios-person-outline"></i><!--v-component--></div><!--v-if-->
                            <i class="ivu-icon ivu-icon-load-c ivu-load-loop fade-transition ivu-input-icon ivu-input-icon-validate"></i><!--v-if-->        
                            <input class="ivu-input" type="text" placeholder="请输入用户名" name="username" v-model="username">            
                        </div><!--v-component-->
                    </div>
                </div><!--v-component-->

				<div class="ivu-form-item">
                    <label class="ivu-form-item-label">密码</label><!--v-if-->
                    <div class="ivu-form-item-content">
                        <div class="ivu-input-wrapper ivu-input-type ivu-input-group">
                            <div class="ivu-input-group-prepend"><i slot="prepend" class="ivu-icon ivu-icon-ios-locked-outline"></i><!--v-component--></div><!--v-if-->
                            <i class="ivu-icon ivu-icon-load-c ivu-load-loop fade-transition ivu-input-icon ivu-input-icon-validate"></i><!--v-if-->                        
                            <input class="ivu-input" type="password" placeholder="请输入密码" name="password" v-model="pass">
                        </div><!--v-component-->
                    </div>
                </div><!--v-component-->

				<div class="ivu-form-item">
                    <label class="ivu-form-item-label">再次确认</label><!--v-if-->
                    <div class="ivu-form-item-content">
                        <div class="ivu-input-wrapper ivu-input-type ivu-input-group">
                            <div class="ivu-input-group-prepend"><i slot="prepend" class="ivu-icon ivu-icon-ios-locked-outline"></i><!--v-component--></div><!--v-if-->
                            <i class="ivu-icon ivu-icon-load-c ivu-load-loop fade-transition ivu-input-icon ivu-input-icon-validate"></i><!--v-if-->                        
                            <input class="ivu-input" type="password" placeholder="请再输入一次密码" name="password2" v-model="pass1">                                            
                        </div>                        
                    </div>
                </div>
                <div style="margin-bottom:10px;margin-top:5px;">            
                <span style="color:red;">@{{warn}}</span>
                </div>
				<div class="ivu-form-item">
                    <div class="ivu-form-item-content" @click="reg">
                        <button class="ivu-btn ivu-btn-ghost ivu-btn-long" type="button">                    
                        <span>注册</span>
                        </button>                    
                    </div>
                </div>

		        <div class="ivu-form-item">    
                    <div class="ivu-form-item-content">
                        <a href="{{url('/login')}}">有账号？点击登录</a>                    
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
<script>
 new Vue({
        el:'#app',
        data:{
            username:'',
            pass:'',
            pass1:''
        },
        computed:{
            warn:
                function(){
                    if(this.pass==this.pass1&&this.username!=''&&this.pass!=''){
                        return ''
                    }else if(this.pass!=this.pass1){
                        return '两次密码不匹配!'
                    }else{
                        return '用户名密码不能为空'
                    }
                }                 
        },
        methods:{
            reg:function(){
                if(this.warn==''){
                    this.$http.post('',{username:this.username,password:this.pass,_token:'{{csrf_token()}}'}).then(function(response){
                        if(response.data=='ok'){                            
                            layer.msg('注册成功!',{
                            icon:1,
                            time:1500
                            },function(){
                                window.location.href="{{url('/login')}}";
                            });
                        }else{
                            layer.msg('用户名已存在!',{
                            icon:2,
                            time:1000
                            },function(){
                                window.location.reload();
                            });
                        }
                    });
                }
                
            }
        }
    });
</script>
</html>


