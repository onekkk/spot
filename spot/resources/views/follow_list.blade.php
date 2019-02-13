@extends('layouts.app')


@section('head')
<link rel="stylesheet" type="text/css" href="css/follow_up_list.css">
<script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection



@section('content')
<div class="col-md-12">
    <div class="row">
        <h2 class="col-md-12">フォローリスト</h2>
        @foreach ($follows as $follow)
            <div class="col-md-12 follow_item">
                <div class="follow_wrap">
                    <a href="./user_detail?author={{$follow->follower}}" class=" description">{{$follow->name}}</a>
                    <input type="button" class="btn btn-outline-primary" id="f_{{$loop->index}}" value="フォローをはずす" onClick="follow_click({{$follow->follower}}, {{$loop->index}});">
                    <input type="hidden" value="true" id="b_{{$loop->index}}">
                </div>
            </div>
        @endforeach
      </div>        
</div>
@endsection

@section('script')
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function follow_click(follower, index){

        $(function(){
            var f_b = "#b_" + index;
            var follow = $(f_b).val() == "true" ? true : false;
            // Ajax button click

            $.ajax({
                url:'/follow',
                type:'POST',
                data:{
                    'follow': {{$auth_id}},
                    'follower': follower,
                    'follow_is':follow,
                }
            })
            // Ajaxリクエストが成功した時発動
            .done( (data) => {
                $('.result').html(data);
                console.log(data);
                //console.log(follow);
                console.log('ok');
            })
            // Ajaxリクエストが失敗した時発動
            .fail( (data) => {
                $('.result').html(data);
                console.log(data);
                console.log('error');
            })
            // Ajaxリクエストが成功・失敗どちらでも発動
            .always( (data) => {
            
            });

            var btn_id = "#f_" + index;
            console.log(btn_id);
            if(follow){
                $(btn_id).val("フォローする");
                $(f_b).val("false");
            }else{
                $(btn_id).val("フォローをはずす");
                $(f_b).val("true");
            }
        });
    }

</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
@endsection
