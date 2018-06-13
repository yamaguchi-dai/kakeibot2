@extends('app')
@section('title', '支出一覧')
@push('scripts')
<script src="/js/payment.js?{{now()}}"></script>
@endpush
@push('css')
<link href="/css/payment.css" type="text/css" rel="stylesheet" >
@endpush
@section('content')
    <div class="row">
        <h5 class="center-align">
            支払い登録画面
        </h5>
    </div>
<form method="post" action="/payment">
    {{ csrf_field() }}

    <input id="mode" type="hidden" name="mode" value="regist">
    <div class="row">
        <div class="input-field col s6">
            <select name="category_id">
                @foreach ($category_list as $c)
                <option value="{{$c->id}}">{{$c->name}}</option>
                @endforeach
            </select>
            <label>カテゴリ</label>
        </div>
        <div class="input-field col s6">
            <input id="price" name="price" type="text" class="validate">
            <label for="price">金額</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s8">
            <input id="comment" name="comment" type="text" class="validate">
            <label for="comment">メモ</label>
        </div>
        <div class="input-field col s3 offset-s1">
            <button class="btn"type="submit">登録</button>
        </div>
    </div>

</form>
<table>
    <thead>
    <tr>
        <td>年月日</td>
        <td>カテゴリ名称</td>
        <td>金額</td>
        <td>メモ</td>
    </tr>
    </thead>
    <tbody>
    @foreach ($res as $tmp)
    <tr id="{{$tmp->id}}">
        <td class="created_at Ymd">{{$tmp->created_at}}</td>
        <td class="category_name">{{$tmp->category->name}}</td>
        <td><span class="price number">{{$tmp->price}}</span>円</td>
        <td class="comment">{{$tmp->comment}}</td>
    </tr>
    @endforeach
    </tbody>
</table>    


<!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>支払い編集</h4>
        <input id="m_category_name" disabled>
        <input id="m_price" name="m_price">
        <input id="m_comment" name="m_comment">
    </div>
    <div class="modal-footer">
        <button id='update' class="modal-action modal-close waves-effect waves-green btn-flat">更新</button>
    </div>
</div>

@endsection
