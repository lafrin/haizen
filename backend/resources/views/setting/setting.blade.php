
@extends('layouts.setting')

@section('content')
<section>
  <div class="" style="display:flex">
    <div class="side-menu" style="">
      <div style="">  
        @include('parts.side_menu')
      </div>
    </div>

    <div class="" style="width:calc(100% - 200px);">
      @if(\Request::route()->named('config*'))
        @include('setting/config')
      @elseif(\Request::route()->named('category*'))
        @include('setting/category')
      @endif
        
    </div>
  </div>

</section>

@endsection

@section('script')
<script type="module">
  $(function(){


  })//function-end
</script>
@endsection
