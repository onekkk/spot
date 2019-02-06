@extends('layouts.app')


@section('head')
<link rel="stylesheet" type="text/css" href="css/item_detail.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>

<script>
    var markerData = @json($spots);
</script>
@endsection



@section('content')
<div class="container">
<div class="row" id="container">
    <div class="col-md-10 col-sm-10 mx-auto">
        <!-- <h2>アイテムの詳細</h2> -->

        <div id="content">
        <div class="row">
            <p class="col-md-4 col-sm-4">アイテムの作成者：</p>
            <a href="./user_detail?author={{$item['author_id']}}" class="col-md-8 col-sm-8 description">{{$item['author_name']}}</a>
        </div>
        <div class="row">
            <p class="col-md-4 col-sm-4">アイテムの名前：</p>
            <p class="col-md-8 col-sm-8 description">{{$item['name']}}@if ($is_auth) <button id="bookmark_btn" class="btn btn-success">@if($bookmark_is)お気に入り済み@elseお気に入り@endif</button> @endif</p>
        </div>
                        
        <div class="row">
            <p class="col-md-4 col-sm-4">アイテムの説明：</p>
            <p class="col-md-8  col-sm-8 description">{{$item['body']}}</p>
        </div>

        <div class="row">
            <p class="col-md-4 col-sm-4">アイテムの写真：</p>
            <img src="{{$item['img_path']}}" alt="">
        </div>

        <div id="map" style="width:450px; height:320px;"></div>

        @foreach ($spots as $spot)
            <div class="spot" id="spot_{{$loop->index}}">
                <div class="row">
                    <p class="col-md-4 col-sm-4">おすすめスポットの名前：</p>
                    <p class="col-md-8 col-sm-8 description">{{$spot['name']}}</p>
                </div>
                <div class="row">
                    <p class="col-md-4 col-sm-4">おすすめスポットの説明：</p>
                    <p class="col-md-8 col-sm-8 description">{{$spot['body']}}</p>
                </div>
                @if ($spot['img_path'] != NULL)
                    <div class="row">
                        <p class="col-md-4 col-sm-4">アイテムの写真：</p>
                        <img src="{{$spot['img_path']}}" alt="">
                    </div>
                @endif
                <input type="button" value="地図を表示" class="btn btn-outline-info" onclick="map_id_set({{$loop->index}});">
                @if ($loop->first)
                    <div id="map_detail" style="width:450px; height:320px;"></div>
                @endif
            </div>

        @endforeach
        
    </div>


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

    $(function(){
        var bookmark = @if ($bookmark_is) true @else false @endif;
            // Ajax button click
            $('#bookmark_btn').on('click',function(){

                $.ajax({
                    url:'./bookmark',
                    type:'POST',
                    data:{
                        'user':{{$auth_id}},
                        'item_id':{{$item['id']}},
                        'bookmark_is':bookmark,
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

                if(bookmark){
                    $('#bookmark_btn').text("お気に入り");
                    bookmark = false;
                }else{
                    $('#bookmark_btn').text("お気に入り済み");
                    bookmark = true;
                }

            });
        });

</script>
<script type="text/javascript" src="js/display_map.js"></script>
<script async defe
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBSEHZrMXeXRx-z0heZfwOpt4A31YtSgZE&callback=initMap">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
@endsection
