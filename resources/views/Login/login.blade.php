@extends('app')
@section('title', 'ログイン')
@push('scripts')
@endpush
@section('content')
<form method="post" action="/login">
    {{ csrf_field() }}
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title center">ログイン</span>
                    <div class="row">
                        <div class="input-field col s12">
                            <input placeholder="ログインID" name="user_id" value="{{old('user_id')}}"type="text" class="validate">
                            <!--<label for="first_name">First Name</label>-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input placeholder="パスワード" name="password" type="password" class="validate">
                            <!--<label for="first_name">First Name</label>-->
                        </div>
                    </div>
                    <button type="submit">送信</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection