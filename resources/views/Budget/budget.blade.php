@extends('app')
@section('title', '予算登録')
@push('scripts')
<script src="/js/budget.js?date={{now()}}"></script>
@endpush
@push('css')
<link href="/css/budget.css" type="text/css" rel="stylesheet" >
@endpush
@section('content')

<div class="row">
    <h5 class="center-align">
        予算登録画面
    </h5>
</div>
<div class="row">
    <div class="col s6 m8 offset-m2 budget-sum-price no-br">
        予算合計金額<span style="font-size:150%">{{$budget_sum_price}}</span>円
    </div>
    <div class="col s3 offset-s3 m1 offset-m1">
        <div>
            <a id='add_budget' class="waves-effect waves-light btn">追加</a>
        </div>
    </div>
</div>
<div class="col s12">
    <div class="table_area">
        <table>
            @foreach ($budget_list as $budget)
            <tr id="{{$budget->id}}">
                <td class="category_name">{{$budget->category->name}}</td>
                <td class="right"><span class="price">{{$budget->price}}</span>円</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>


<!-- Modal Structure -->
<div id="modal1" class="modal">
    <form method="post" action="/budget">
        {{ csrf_field() }}
        <div class="modal-content">
            <h5 id='modal_head'>予算登録</h5>
            <input name='name'>
            <input name="price">
        </div>
        <div class="modal-footer">
            <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat">登録</button>
        </div>
    </form>
</div>

<div id="update_modal" class="modal">
    <form method="post" action="/budget/update">
        {{ csrf_field() }}
        <input type="hidden" name="mode" value="update">
        <div class="modal-content">
            <h5 id='modal_head'>予算更新</h5>
            <input id='update_name' name='name'>
            <input id='update_price' name="price">
        </div>
        <div class="modal-footer">
            <button id="update" type="button" class="modal-action modal-close waves-effect waves-green btn-flat">登録</button>
        </div>
    </form>
</div>

@endsection
