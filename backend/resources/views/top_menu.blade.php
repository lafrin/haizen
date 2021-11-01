@extends('layouts.main')

@section('content')
<section class="top-menu">
  <a href="#" class="btn btn-primary"><span>席案内<span><div>席案内します</div></a>
  <a href="#" class="btn btn-primary">オーダー</a>
  <a href="#" class="btn btn-primary">キッチン</a>
  <a href="#" class="btn btn-primary">会計</a>
  <a href="{{ route('config') }}" class="btn btn-primary">商品編集</a>
  <a></a>
</section>

@endsection

@section('script')
@endsection
