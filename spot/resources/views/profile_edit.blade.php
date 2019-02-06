@extends('layouts.app')

@section('head')
<link rel="stylesheet" type="text/css" href="css/profile_edit.css">
<script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>

@endsection

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form action="" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <h2>プロフィールの更新</h2>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
                        <label for="name" class="col-md-12 control-label">ユーザー名</label>

                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control" name="name" value="{{ $user_name }}" autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                        <div class="form-group{{ $errors->has('img') ? ' has-error' : '' }} row">
                            <label for="img" class="col-md-12 control-label">アイコン画像</label>

                            
                            <div class="col-md-12">
                                <label class="drop_img col-md-12" id="drag-drop-area">
                                    <p>ここに画像をドロップしてください</p>
                                    <input type="file" name="img" class="btn btn-primary"  id="fileInput" accept=".jpg,.gif,.png,image/gif,image/jpeg,image/png" style="display:none;">
                                </label>
                                <div id="icon_img_wrap">
                                    <p>プレビュー</p>
                                    <div class="mx-auto" id="icon_img">
                                        <img src="" alt="" id="preview" class="mx-auto" width="300px" onerror="this.style.display='none'">
                                    </div>
                                </div>

                                @if ($errors->has('img'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('img') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="mx-auto col-md-offset-4">
                                <button type="submit" class="btn btn-primary mx-auto" id="submit_bt">
                                    更新
                                </button>
                            </div>
                        </div>

                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    var fileArea = document.getElementById('drag-drop-area');
var fileInput = document.getElementById('fileInput');
console.log(fileArea);
console.log('aaa');



fileArea.addEventListener('dragover', function(evt){
  evt.preventDefault();
  fileArea.classList.add('dragover');
});

fileArea.addEventListener('dragleave', function(evt){
    evt.preventDefault();
    fileArea.classList.remove('dragover');
});
fileArea.addEventListener('drop', function(evt){
    evt.preventDefault();
    fileArea.classList.remove('dragenter');
    var files = evt.dataTransfer.files;
    fileInput.files = files;
});

$('#fileInput').on('change', function (e) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $("#preview").attr('src', e.target.result);
    }
    reader.readAsDataURL(e.target.files[0]);
    $('#preview').css("display", 'block');
});
    
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

@endsection


