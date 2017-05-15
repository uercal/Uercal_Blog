<html>
<head>
    <title>Main</title>
    <link href="{{asset('/public/css/bootstrap.css')}}" rel="stylesheet">  
    <link href="{{asset('/public/layui/css/layui.css')}}" rel="stylesheet">              
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
        <h1 style="width:400px;">All's Blogs</h1>
        <img class="menu" src="{{asset('/public/images/logout.png')}}" onclick="logout()">
        <img class="menu" src="{{asset('/public/images/back.png')}}" onclick="back()">      
        <hr>
        <ul>
        @foreach($data as $vol)
            <blockquote>
            <p class="lead"><a href="{{url('/detail')}}/{{$vol['itemid']}}">{{ucfirst($vol['title'])}}</a></p>                             
            <footer>
                <cite title="Source Title">{{$vol['time']}}</cite>                
            </footer>       
            </blockquote>
        @endforeach
        @if($data==[])
            <img style="float:left;margin-left:340px;" src="{{asset('/public/images/nodata.png')}}">
        @endif
        </ul>
        <hr>            
    </div>    
</body>
<script src="{{asset('/public/js/jquery.js')}}"></script>   

<script>
function logout(){
    window.location.href="{{url('/logout')}}";
}

function back(){
    history.back(-1);
}

</script>
</html>

