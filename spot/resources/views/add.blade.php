@extends('layouts.app')

@section('head')
<link rel="stylesheet" type="text/css" href="css/add.css">
<script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
@endsection



@section('content')
	<div class="col-md-12">
		@if (count($errors)>0)
			<div class="col-md-7 mx-auto alert alert-danger" role="alert">
  				<strong>正しく入力されていない項目があります。</strong>
			</div>
		@endif
			<form action="" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<label>アイテムの名前：<input type="text" name="item_name" id="name" value="{{ old('item_name') }}">
				</label><br>
				@if ($errors->has('name'))
					<span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    <br>
				@endif
				<label>アイテムの説明：<textarea name="item_body" id="" cols="30" rows="3">{{ old('item_body') }}</textarea>
				</label><br />
				@if ($errors->has('body'))
					<span class="help-block">
                        <strong>{{ $errors->first('body') }}</strong>
                    </span>
                    <br>
				@endif

				<label>アイテムの画像：<input type="file" name="item_img" class="" accept=".jpg,.gif,.png,image/gif,image/jpeg,image/png">
				</label><br>
				@if ($errors->has('img'))
					<span class="help-block">
                        <strong>{{ $errors->first('img') }}</strong>
                    </span>
				@endif
				<p>※アイテムの画像は必ずアップロードしてください</p>
				    
				<div class="spot" id="spot_1">
					<h3>１つ目</h3>
					<label>おすすめスポットの名前：<input type="text" name="spot_name_1" id="name" value="{{ old('spot_name_1') }}"></label><br>
					@if ($errors->has('0.name'))
						<span class="help-block">
	                        <strong>{{ $errors->first('0.name') }}</strong>
	                    </span>
	                    <br>
					@endif
					<label>おすすめスポットの説明：<textarea name="spot_body_1" id="" cols="30" rows="3">{{old('spot_body_1') }}</textarea></label><br>
					@if ($errors->has('0.body'))
						<span class="help-block">
	                        <strong>{{ $errors->first('0.body') }}</strong>
	                    </span>
	                    <br>
					@endif
					<label>おすすめスポットの画像：<input type="file" name="spot_img_1" class="" accept=".jpg,.gif,.png,image/gif,image/jpeg,image/png"></label><br>
					@if ($errors->has('0.img'))
						<span class="help-block">
	                        <strong>{{ $errors->first('0.img') }}</strong>
	                    </span>
	                    <br>
					@endif
					<label>おすすめスポットの緯度：<input type="text" name="spot_lat_1" id="google_map_lat_1" value="{{old('spot_lat_1') }}"></label><br>
					@if ($errors->has('0.lat'))
						<span class="help-block">
	                        <strong>{{ $errors->first('0.lat') }}</strong>
	                    </span>
	                    <br>
					@endif
					<label>おすすめスポットの経度：<input type="text" name="spot_lng_1" id="google_map_lng_1" value="{{old('spot_lng_1') }}"></label><br>
					@if ($errors->has('0.lng'))
						<span class="help-block">
	                        <strong>{{ $errors->first('0.lng') }}</strong>
	                    </span>
	                    <br>
					@endif
					<input type="button" value="地図を表示" class="btn btn-outline-info" onclick="map_id_set(1);">
				</div>
				<div id="wrap_map">
				    <input type="text" id="address" value="東京スカイツリー">
				    <input type="button" id="btn" value="検索" class="btn-secondary">
					<div id="map" style="">
					</div>
				</div>
				<div class="spot" id="spot_2">
					<h3>２つ目</h3>
					    <label>おすすめスポットの名前：<input type="text" name="spot_name_2" id="spot_name_2" value="{{ old('spot_name_2') }}"></label><br>
						@if ($errors->has('1.name'))
							<span class="help-block">
		                        <strong>{{ $errors->first('1.name') }}</strong>
		                    </span>
	                    <br>
						@endif
					    <label>おすすめスポットの説明：<textarea name="spot_body_2" id="" cols="30" rows="3">{{ old('spot_body_2') }}</textarea></label><br>
					    @if ($errors->has('1.body'))
							<span class="help-block">
		                        <strong>{{ $errors->first('1.body') }}</strong>
		                    </span>
	                    <br>
						@endif
					    <label>おすすめスポットの画像：<input type="file" name="spot_img_2" class="" accept=".jpg,.gif,.png,image/gif,image/jpeg,image/png"></label><br>
					    @if ($errors->has('1.img'))
							<span class="help-block">
		                        <strong>{{ $errors->first('1.img') }}</strong>
		                    </span>
	                    <br>
						@endif
					    <label>おすすめスポットの緯度：<input type="text" name="spot_lat_2" id="google_map_lat_2" value="{{ old('spot_lat_2') }}"></label><br>
					    @if ($errors->has('1.lat'))
							<span class="help-block">
		                        <strong>{{ $errors->first('1.lat') }}</strong>
		                    </span>
	                    <br>
						@endif
					    <label>おすすめスポットの経度：<input type="text" name="spot_lng_2" id="google_map_lng_2" value="{{ old('spot_lng_2') }}"></label><br>
					    @if ($errors->has('1.lng'))
							<span class="help-block">
		                        <strong>{{ $errors->first('1.lng') }}</strong>
		                    </span>
	                    <br>
						@endif
					    <input type="button" value="地図を表示" class="btn btn-outline-info" onclick="map_id_set(2);">
					</div>
					<div class="spot" id="spot_3">
				    	<h3>3つ目</h3>
					    <label>おすすめスポットの名前：<input type="text" name="spot_name_3" id="name" value="{{ old('spot_name_3') }}"></label><br>
					    @if ($errors->has('2.name'))
							<span class="help-block">
		                        <strong>{{ $errors->first('1.lng') }}</strong>
		                    </span>
	                    <br>
						@endif
					    <label>おすすめスポットの説明：<textarea name="spot_body_3" id="" cols="30" rows="3">{{ old('spot_body_3') }}</textarea></label><br>
					    @if ($errors->has('2.body'))
							<span class="help-block">
		                        <strong>{{ $errors->first('2.body') }}</strong>
		                    </span>
	                    <br>
						@endif
					    <label>おすすめスポットの画像：<input type="file" name="spot_img_3" class="" accept=".jpg,.gif,.png,image/gif,image/jpeg,image/png"></label><br>
					    @if ($errors->has('2.img'))
							<span class="help-block">
		                        <strong>{{ $errors->first('1.img') }}</strong>
		                    </span>
	                    <br>
						@endif
					    <label>おすすめスポットの緯度：<input type="text" name="spot_lat_3" id="google_map_lat_3" value="{{ old('spot_lat_3') }}"></label><br>
					    @if ($errors->has('2.lat'))
							<span class="help-block">
		                        <strong>{{ $errors->first('1.lat') }}</strong>
		                    </span>
	                    <br>
						@endif
					    <label>おすすめスポットの経度：<input type="text" name="spot_lng_3" id="google_map_lng_3" value="{{ old('spot_lng_3') }}"></label><br>
					    @if ($errors->has('2.lng'))
							<span class="help-block">
		                        <strong>{{ $errors->first('1.lng') }}</strong>
		                    </span>
	                    <br>
						@endif
					    <input type="button" value="地図を表示" class="btn btn-outline-info" onclick="map_id_set(3);">
					</div>

				    <label id="spot_append"><input type="button" value="スポットを追加" class="btn btn-outline-warning" onclick="spot_add();">      ※１０個まで追加できます</label><br>
					<input type="hidden" value="3" id="count" name="count">
				    <input type="submit" value="スポットを登録" name="add" class="float-right btn btn-success">
				</form>

			</div>
		</div>
		
	</div>

@endsection

@section('script')

<script>

var total_count = 3;
function spot_add(){

    if(total_count <= 10){
        total_count++;
        var spot_id = "#spot_" + total_count;
        $('#spot_append').before('<div class="spot" id="spot_' + total_count + '">');
        $(spot_id).append('<h3>' + total_count + 'つ目</h3>');
        $(spot_id).append('<label>おすすめスポットの名前：<input type="text" name="spot_name_' + total_count +'" id="spot_name_' + total_count +'"></label><br>');
        $(spot_id).append('<label>おすすめスポットの説明：<textarea name=" spot_body_' + total_count + '" id="spot_body_' + total_count + '" cols="30" rows="3"></textarea></label><br>');
        $(spot_id).append('<label>おすすめスポットの画像：<input type="file" name="spot_img_' + total_count + '" class="" accept=".jpg,.gif,.png,image/gif,image/jpeg,image/png"></label><br>');
        $(spot_id).append('<label>おすすめスポットの緯度：<input type="text" name="spot_lat_' + total_count  +'" id="google_map_lat_' + total_count + '" value=""></label><br>');
        $(spot_id).append('<label>おすすめスポットの経度：<input type="text" name="spot_lng_' + total_count  + '" id="google_map_lng_' + total_count + '" value=""></label><br>');
        $(spot_id).append('<input type="button" value="地図を表示" class="btn btn-outline-info" onclick="map_id_set(' + total_count + ');">');
    }
	if(total_count == 4){
		 $('#spot_append').after('<label id="spot_del" class="col-md-12"><input type="button" value="スポットを削除" class="btn btn-outline-secondary" id="del_btn" onclick="spot_del();"></label>');
	}

    if(total_count >= 10){
        $('#spot_append').remove();
    }
	document.getElementById("count").value = total_count;
}


function spot_del(){
	var spot_id = "#spot_" + total_count;
	$(spot_id).remove();
	total_count--;
	if(total_count == 3){
                $('#del_btn').remove();
        }

	if(total_count == 9){
		$('#spot_del').before('<label id="spot_append"><input type="button" value="スポットを追加" class="btn btn-outline-warning" onclick="spot_add();">      ※１０個まで追加できます</label><br>');
	}

	document.getElementById("count").value = total_count;
}

function add_script(num){
	count = num - 3;
	for(var i = 0; i < count; i++){
		spot_add();
	}
}

add_script({{old('count')}});

@if (old('count') >= 4)
var spot_value = [
	@if ( old('count') >= 4) {name:"{{old('spot_name_4')}}" , body:"{{old('spot_body_4')}}" , lat:"{{old('spot_lat_4')}}" , lng:"{{old('spot_lng_4')}}",

	 },@endif
	@if ( old('count') >= 5) {name:"{{old('spot_name_5')}}" , body:"{{old('spot_body_5')}}" , lat:"{{old('spot_lat_5')}}" , lng:"{{old('spot_lng_5')}}" },@endif
	@if ( old('count') >= 6) {name:"{{old('spot_name_6')}}" , body:"{{old('spot_body_6')}}" , lat:"{{old('spot_lat_6')}}" , lng:"{{old('spot_lng_6')}}" },@endif
	@if ( old('count') >= 7) {name:"{{old('spot_name_7')}}" , body:"{{old('spot_body_7')}}" , lat:"{{old('spot_lat_7')}}" , lng:"{{old('spot_lng_7')}}" },@endif
	@if ( old('count') >= 8) {name:"{{old('spot_name_8')}}" , body:"{{old('spot_body_8')}}" , lat:"{{old('spot_lat_8')}}" , lng:"{{old('spot_lng_8')}}" },@endif
	@if ( old('count') >= 9) {name:"{{old('spot_name_9')}}" , body:"{{old('spot_body_9')}}" , lat:"{{old('spot_lat_9')}}" , lng:"{{old('spot_lng_9')}}" },@endif
	@if ( old('count') >= 10) {name:"{{old('spot_name_10')}}" , body:"{{old('spot_body_10')}}" , lat:"{{old('spot_lat_10')}}" , lng:"{{old('spot_lng_10')}}" },@endif
];
@endif

if(total_count >= 4){
	for(var i = 0; i < total_count-3; i++){
        document.getElementById('spot_name_' +(i + 4)).value = spot_value[i]['name'];
        document.getElementById('spot_body_' + (i + 4)).value = spot_value[i]['body'];
		if(!isNaN(parseFloat(spot_value[i]['lat']))){
			document.getElementById('google_map_lat_' + (i + 4)).value = parseFloat(spot_value[i]['lat']);
		}

		if(!isNaN(parseFloat(spot_value[i]['lng']))){
        	document.getElementById('google_map_lng_' + (i + 4)).value = parseFloat(spot_value[i]['lng']);
        } 	
	}
}



@for ($i = 3; $i < old('count'); $i++)
	@if ($errors->has($i.'.name'))
		$("#spot_name_{{$i+1}}").after('<br><span class="help-block"><strong>{{ $errors->first("$i.name") }}</strong></span>');
	@endif
	@if ($errors->has($i.'.body'))
		$("#spot_body_{{$i+1}}").after('<br><span class="help-block"><strong>{{ $errors->first("$i.body") }}</strong></span>');
	@endif
	@if ($errors->has($i.'.lat'))
		$("#google_map_lat_{{$i+1}}").after('<br><span class="help-block"><strong>{{ $errors->first("$i.lat") }}</strong></span>');
	@endif
	@if ($errors->has($i.'.lng'))
		$("#google_map_lng_{{$i+1}}").after('<br><span class="help-block"><strong>{{ $errors->first("$i.lng") }}</strong></span>');
	@endif
@endfor

</script>


<script type="text/javascript" src="js/map.js"></script>				    
<script async defer
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBSEHZrMXeXRx-z0heZfwOpt4A31YtSgZE&callback=initMap">
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

@endsection