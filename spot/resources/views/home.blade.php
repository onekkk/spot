@extends('layouts.app')


@section('head')
@endsection

@section('serach')
<form action="" method="get">
    <div class="input-group" id="serach_bar">
        <input type="text" class="form-control" id="serach_bar_field" name="search_text" placeholder="キーワードを入力" value="{{$search_text}}">
        <div class="input-group-append">
            <input class="btn btn-primary inp_bt" type="submit" name="serach" value="検索">
        </div>
    </div>
</form>
@endsection


@section('content')
<div class="container">
<div  id="container" class="col-md-12 ">
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

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
@endsection
