@extends('layouts.main')

@section('content')
<section class="top-menu">
  <a href="{{ route('hall')}}" class="btn btn btn-primary"><span>ホール<span><div>席案内します</div></a>
  <a href="" class="btn btn-secondary">オーダー</a>
  <a href="" class="btn btn-secondary">キッチン</a>
  <a href="" class="btn btn-secondary">会計</a>
  <a href="{{ route('config') }}" class="btn btn-primary">商品編集</a>
  <a></a>
  <a></a>
  <a></a>
  <a></a>
</section>

@endsection

@section('script')
@endsection
