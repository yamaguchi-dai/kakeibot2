@extends('app')
@section('title', '登録完了')
@push('scripts')
@endpush
@push('css')
@endpush
@section('content')
<div class="row">
    <div class="col s12">
        <div class="card">
            <div class="card-content">
                <span class="card-title center">登録完了</span>
                <h5>登録完了しました。下記IDでログインしてください</h5>
                <div class="row">
                    <div class="input-field col s12">
                        <input value="{{$login_id}}"type="text" readonly class="validate">
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
