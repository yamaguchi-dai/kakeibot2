@extends('app')
@section('title', 'ホーム')
@push('scripts')
@endpush
@push('css')
 <link href="/css/home.css" type="text/css" rel="stylesheet" >
@endpush
@section('content')

<div class="row">
    <div class="col s12 m6">
        <div class="card">
            <div class="card-content">
                <span class="card-title">今月利用金額</span>
                <div class="row">
                    
                     <div class="col s6">
                         <p>予算:<span class="number">{{$budget_sum}}</span>円</p>
                        <p>予算対比率:{{$budget_percent}}%</p>
                    </div>
                    <div  class="col s6">
                        <h4 class="right"><span class='number'>{{$this_month_sum}}</span>円</h4>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col s12 m6">
        <div class="card">
            <div class="card-content">
                <span class="card-title">前月比</span>
                <div class="row">
                    <div class="col s6">
                        <p >前月:<span class='number'>{{$last_month_sum}}</span>円</p>
                    </div>
                    <div  class="col s6">
                        <h4 class="right">{{$last_month_percent}}%</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection