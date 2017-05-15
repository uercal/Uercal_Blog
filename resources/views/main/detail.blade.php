<html>
<meta name="csrf-token" content="{{ csrf_token() }}">
<head>
    <title>{{$data['title']}}__{{$name}}</title>
    <link href="{{asset('/public/css/bootstrap.css')}}" rel="stylesheet">   
    <link href="{{asset('/public/css/sweetalert.css')}}" rel="stylesheet">
</head>
<style>  
.content p {
    font-family: 'fontNameRegular';
    font-size:200%;   
}

h2 {
    font-family: 'fontNameRegular';
    font-size:200%;   
}

h3 {
    font-family: 'fontNameRegular';
    font-size:200%;   
}

@font-face {
    font-family: 'fontNameRegular';
    src: url("{{asset('/public/ttf/3.woff2')}}") format('woff2'),
         url("{{asset('/public/ttf/3.woff')}}") format('woff');
    font-weight: normal;
    font-style: normal;
}

h1{font-family: fontNameRegular}
</style>  
<body>
    <div class="container">
        <h1><p class="text-center">{{$data['title']}}.</p></h1>
        <div style="position:absolute;right:400px;top:50px;cursor:hand;" onclick='javascript:history.go(-1)'>
            <img src="{{asset('/public/images/back.png')}}">
        </div>
        <hr>
            <div class="content">
                <?php
                    print($data['content']);
                ?>
            </div>
            <p class="text-right">Created at <strong>{{$data['time']}}</strong>.</p>
        <hr>                             
    </div>
    <div class="container">
        <h2>Comments:</h2>
    </div>
    <br>
    <div class="container">
    @foreach($comments as $vol)
        <blockquote v-for="comments in data">
            <p>{{$vol['comments']}}</p>
            <p class="text-right">
            Posted by : <strong>{{$vol['name']}}</strong> &nbsp;&nbsp;
            <cite title="Source Title">{{$vol['time']}}</cite>
            </p>
        </blockquote>
    @endforeach
    @if($comments == [])
        <img style="float:left;margin-left:340px;" src="{{asset('/public/images/nodata.png')}}">
    @else
        <hr>
    @endif
    
    </div>
    
    <div class="container">
        
        <h3>Leave message</h3>
        <br>
        <textarea class="form-control" rows="3" style="resize:none;" id="message"></textarea>     
        <br>
        <a href="javascript:;" style="float:right;" id="sub"><img src="{{asset('/public/images/comfirm.png')}}"></a>
     
    </div>
    <br>
    <br>
    <br>
    <br>
</body>
<script src="{{asset('/public/js/jquery.js')}}"></script>
<script src="{{asset('/public/js/sweetalert.min.js')}}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#sub').on('click',function(){
        if($('#message').val()==''){
            swal({
                title: "Warnning!",
                text: "Message Required!",
                timer: 1000,
                showConfirmButton: false
            });
        }else{
            var data = $('#message').val();
            swal({
                title: "Ajax request example",
                text: "Submit to run ajax request",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                },
                function(){
                    $.post("{{URL::current()}}",{message:data},function(data){
                        console.log(data);
                        if(data=='ok'){
                            window.location.reload();
                            swal('done!');
                        }else{                           
                            swal('error!');
                        }
                    }).error(function(){              
                        swal('error!');
                    })
                });
            }
        });
        
</script>
</html>
