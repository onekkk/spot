@extends('layouts.app')


@section('head')
<link rel="stylesheet" type="text/css" href="css/bookmark_list.css">
<script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>

@endsection



@section('content')
<div class="container">
<div class="col-md-12">
    <div class="row" id="container">
        <h2 id="sub_title" class="col-md-12">お気に入り</h2>
        @foreach ($bookmarks as $bookmark)
            <div class="item_wrap col-md-3 col-sm-6">
            <div class="item">
                <a href="./item_detail?id={{$bookmark->id}}" title="" >
                    <img src="{{$bookmark->img_path}}" alt="">
                    <h3>{{$bookmark->name}}</h3>
                    <p class="author">作成者　{{$bookmark->author_name}}</p>
                </a>
            </div>
            </div>
        @endforeach
        </div>

        <div class="col-md-12" id="page" >
            {{$bookmarks->links()}}
        </div>        
</div>
</div>
@endsection

@section('script')


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
@endsection
