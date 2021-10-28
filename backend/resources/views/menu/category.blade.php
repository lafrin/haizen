@extends('layouts.header')

@section('content')
<section>

  <div class="b-category-add">
    <a class="c-btn m-item" href="{{route('menu_item')}}">⇒商品画面</a>
    <a class="c-btn m-add">＋カテゴリー追加</a>
  </div>

  <form action="{{route('menu_cat.edit')}}" method="POST">
    @csrf
    <div class="table-responsive">
      <table class="table b-category-table">
        <thead>
          <tr class="b-category-head">
            <th class="e-color" style="width:10%;">色</th>
            <th class="e-name" style="width:35%;">カテゴリー名</th>
            <th class="e-short" style="width:35%;">カテゴリー（略称）</th>
            <th class="e-display" style="width:10%;">表示</th>
            <th class="e-display" style="width:10%;">削除</th>
          </tr>
        </thead>
        <tbody>
          @foreach($categories as $cat)
          <tr class="b-category-body">
            <td class="e-color">
              <div style="background:{{ $cat->color }}"><input type="hidden" value="{{ $cat->color }}" name="category[color][]"></div>
            </td>
            <td class="e-name"><input value="{{ $cat->name }}" name="category[name][]"></td>
            <td class="e-short"><input value="{{ $cat->short_name }}" name="category[short_name][]"></td>
            <td class="e-display">
              <label class="switchArea">
                <input type="checkbox" value="{{ $cat->display===1 ? 1 : 0 }}"  name="category[display][]">
                <div class="e-border"></div>
                <span></span>
                <div id="swImg"></div>
              </label>
            </td>
            <td class="e-trash"><i class="fas fa-trash trash"></i></td>
          </tr>
          @endforeach
          
        </tbody>
      </table>
    </div>

    <div class="b-category-save">
      <button class="btn btn-prymary c-btn m-save" type="submit">保存</button>
    </div>
  </form>
  <!-- モーダル -->
  <div class="category-modal"></div>
</section>

@endsection

@section('script')
<script type="module">
$(function(){

  // 予約詳細モーダル起動
  $('.m-add').on('click', function() {
    axios.get("{{ route('menu_cat.create_modal')}}")
    .then(function(res) {
        $('.category-modal').html(res.data).find('.modal').modal().trigger('launch');
    })
    .catch(function(error){
      console.log("error");
    });
  });
})
</script>
@endsection
