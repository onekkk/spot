@extends('layouts.auth')

@section('css')
<link rel="stylesheet" type="text/css" href="css/user_sign_up.css">
@endsection

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form action="{{ route('register') }}" method="post">
                    {{ csrf_field() }}
                    <h2>新規登録</h2>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
                        <label for="name" class="col-md-12 control-label">ユーザー名</label>

                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row">
                            <label for="email" class="col-md-12 control-label">メールアドレス</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} row">
                            <label for="password" class="col-md-12 control-label">パスワード</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-12 control-label">パスワード確認</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="mx-auto col-md-offset-4">
                                <button type="submit" class="btn btn-primary mx-auto" id="submit_bt">
                                    登録
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



