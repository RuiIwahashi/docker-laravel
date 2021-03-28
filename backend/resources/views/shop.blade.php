@extends('layouts.app')

@section('content')
<div class="container-fluid">
   <div class="">
       <div class="mx-auto" style="max-width:1200px">
       <form action="search" method="get">
       @csrf
           <input type="text" name="search" value="">
           <input type="submit" value="検索">
       </form>
       <form action="sort" method="get" id="sort_form">
           <select name="sort_id" onchange="submit(this.form)">
               <option value="" hidden>並び替え</option>
               @foreach($sort_lists as $sort_list)
                   <option value="{{$sort_list->id}}">{{$sort_list->name}}</option>
               @endforeach
           </select>
           <input type="submit" value="sort" style="display:none;">
       </form>
       <h1 style="color:#555555; text-align:center; font-size:1.2em; padding:24px 0px; font-weight:bold;">商品一覧</h1>
           <div class="">
               表示件数{{ $count ?? '' }}
               <div class="d-flex flex-row flex-wrap">
                    @foreach($stocks as $stock)
                        <div class="col-xs-6 col-sm-4 col-md-4 ">
                            <div class="mycart_box">
                                {{$stock->name}} <br>
                                {{$stock->fee}}円<br>
                                <img src="/image/{{$stock->imgpath}}" alt="" class="incart" >
                                <br>
                                {{$stock->detail}} <br>
                                在庫: {{$stock->inventory}} <br>
                                <form action="mycart" method="post">
                                    @csrf
                                    <input type="hidden" name="stock_id" value="{{ $stock->id }}">
                                    <input type="submit" value="カートに入れる">
                                </form>
                            </div>
                            <a class="text-center" href="/">商品一覧へ</a>
                        </div>
                    @endforeach
               </div>
               <div class="text-center" style="width: 200px;margin: 20px auto;">
               {{ $stocks->appends(request()->input())->links() }}
               </div>
           </div>
       </div>
   </div>
</div>
@endsection