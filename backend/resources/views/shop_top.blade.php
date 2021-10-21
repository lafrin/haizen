@extends('layouts.header')

@section('content')
<section class="top-menu">
  <a href="#"><span>席案内</span></a>
  <a href="#">オーダー</a>
  <a>キッチン</a>
  <a>会計</a>
  <a href="{{ route('menu_cat') }}">商品編集</a>
  <a>dm</a>
</section>

@endsection

@section('script')
@endsection
