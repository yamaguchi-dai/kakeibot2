@extends('app')
@section('title', '新規登録')
@push('scripts')
@endpush
@push('css')
@endpush
@section('content')
<form method="post" action="/AccountCreate">
    {{ csrf_field() }}
    <input type="hidden" name="line_id" value="{{$line_id}}">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title center">アカウント新規登録</span>
                    <div class="row">
                        <div class="input-field col s12">
                            <input placeholder="ログインID" name="login_id" value="{{old('login_id')}}"type="text" class="validate">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input placeholder="パスワード" name="password" type="password" class="validate">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input placeholder="パスワード(確認用)" name="check_password" type="password" class="validate">
                        </div>
                    </div>
                    <button type="submit">送信</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
