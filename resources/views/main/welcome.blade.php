<html>
<head>
    <title>Main</title>
    <link href="{{asset('/public/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('/public/layui/css/layui.css')}}" rel="stylesheet">
    <link href="{{asset('/public/css/sweetalert.css')}}" rel="stylesheet">
                    
</head>
<style>
.lead {
    font-family: 'fontNameRegular';
    font-size:200%;   
}
h1{
    font-family: 'fontNameRegular';
    font-size:500%;  
}
strong{
    font-family: 'fontNameRegular';
    font-size:400%; 
}
label{
    font-family: 'fontNameRegular';
    font-size:150%; 
}
@font-face {
    font-family: 'fontNameRegular';
    src: url("{{asset('/public/ttf/3.woff2')}}") format('woff2'),
        url("{{asset('/public/ttf/3.woff')}}") format('woff');
    font-weight: normal;
    font-style: normal;
}
.menu{
    float:right;
    margin-right:10px;
    cursor:hand;
}
.lead{    
    margin-left:10px;
}

</style>
<body>      
    <div class="container">
        <h1 style="width:auto;">{{$name}}'s Blogs</h1>
        <img class="menu" src="{{asset('/public/images/logout.png')}}" onclick="logout()">
        <img class="menu" src="{{asset('/public/images/all.png')}}" onclick="seeAll()">             
        <hr>
        <ul>
        @foreach($data as $vol)
            <blockquote>
            <p class="lead"><a href="{{url('/detail')}}/{{$vol['key']}}">{{ucfirst($vol['data']['title'])}}</a></p>                             
            <footer>
                <cite title="Source Title">{{$vol['data']['time']}}</cite>
                <a href="javascript:;" class="del" item="{{$vol['key']}}"><img src="{{asset('/public/images/del.png')}}"></a>
            </footer>       
            </blockquote>
        @endforeach
        @if($data==[])
            <img style="float:left;margin-left:340px;" src="{{asset('/public/images/nodata.png')}}">
        @endif
        </ul>
        <hr>            
    </div>
    <div class="container">
        <p class="text-center"><strong>Create New Blog.</strong></p>
        <form class="form-horizontal" action="{{url('/main')}}" method="post" onsubmit="return check()" id="form">
            <div class="form-group">
                <label class="col-sm-1 control-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="title" placeholder="Title" id="title">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-1 control-label">Content</label>
                <div class="col-sm-10">
                    <textarea id="demo" name="content" style="display: none;"></textarea>
                </div>
            </div>   
            <a id="sub" href="javascript:;" style="float:right;margin-right:100px;"><img src="{{asset('/public/images/comfirm.png')}}"></a>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
        </form>              
    </div>      
</body>
<script src="{{asset('/public/js/jquery.js')}}"></script>                    
<script src="{{asset('/public/layui/layui.js')}}"></script>
<script src="{{asset('/public/js/sweetalert.min.js')}}"></script>

<script>
$(function(){
    $('#sub').on('click',function(){
        $('#form').submit();
    })
})

layui.use('layedit', function(){
var layedit = layui.layedit;
layedit.build('demo'); //建立编辑器
});

function check(){
    var title = $('#title').val();
    var demo = $('#demo').val();
    if(title==''||demo==''){
        alert('不能为空');
        return false;
    }return true;
}

function logout(){
    window.location.href="{{url('/logout')}}";
}

function seeAll(){
    window.location.href="{{url('/allBlogs')}}";
}

$('.del').on('click',function(){
    //当前点击删除的id
    var item = $(this).attr('item');                
    swal({ 
        title: "Question", 
        text: "Are you sure delete this data?", 
        type: "info", 
        showCancelButton: true, 
        closeOnConfirm: false, 
        showLoaderOnConfirm: true, 
        },
        function(){ 
            $.get("{{url('/del')}}",{id:item},function(data){
                if(data=='ok'){
                    window.location.reload();
                    swal('done!');
                }else{
                    swal('error!');
                }
                
            });
    });
    
})
</script>
</html>

