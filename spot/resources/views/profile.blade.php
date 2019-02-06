@extends('layouts.app')


@section('head')
<link rel="stylesheet" type="text/css" href="css/profile.css">
<script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection



@section('content')
<div class="container">
<div class="row" id="container">
    <div class="col-md-12">
        <div id="user_info">
            <div class="row">
                <div class="col-md-5 col-sm-5">
                    <!-- <div id="user_info_img"></div> -->
                    <div class="row">
                        <div class="col-md-5 col-sm-5">
                            @if ($auth_path == null)
                                <div id="user_info_unknown_img">
                                    <img src="storage/img/users/unknown.jpg">
                                </div>
                            @else
                                <div id="user_info_img">    
                                    <img src="{{$auth_path}}">
                                </div>
                            @endif
                        </div>
                        <div class="col-md-7 col-sm-7">
                            <div id="user_info_right">
                                <p class="col-md-12" id="user_name" description>{{$user_name}}</p>
                                <a href="./profile_edit" title="" class="btn btn-primary" id="user_setting_bt">設定</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- <a href="/user_detail_edit?author=" id="user_settings">ユーザーの設定</a> -->
                <!--
                <p class="col-md-5 body_left">ユーザーの紹介文：</p>
                <p class="col-md-7" description>{$user_body}</p>
                -->
            </div>
        </div>
        <h2 id="spot_title">スポット一覧</h2>
        <div class="row">
        @foreach ($spots as $spot)
            <div class="item_wrap col-md-3 col-sm-6">
            <div class="item">
                <a href="./item_detail?id={{$spot->id}}" title="" >
                    <img src="{{$spot->img_path}}" alt="">
                    <h3>{{$spot->name}}</h3>
                    <p class="author">作成者　{{$spot->author_name}}</p>
                </a>
            </div>
            </div>
        @endforeach
        </div>
        <div class="mx-auto col-md-3 col-sm-3" id="page" >
            {{$spots->links()}}
        </div>
        
        
    </div>
</div>
</div>
@endsection

@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
@endsection
