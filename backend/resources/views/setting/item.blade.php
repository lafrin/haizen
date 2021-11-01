@extends('layouts.header')

@section('content')
<section>

  <div class="b-category-add">
    <a class="c-btn m-item" href="{{route('menu_cat')}}">⇒かてごり画面</a>
    <a class="c-btn m-add">＋カテゴリー追加</a>
  </div>

  <div class="table-responsive">
    <table class="table b-category-table">
      <thead>
        <tr class="b-category-head">
          <th class="e-order" style="width:10%;">順番</th>
          <th class="e-name" style="width:35%;">カテゴリー名</th>
          <th class="e-short" style="width:35%;">商品名</th>
          <th class="e-price" style="width:10%;">価格</th>
          <th class="e-image" style="width:10%;">画像</th>
          <th class="e-display" style="width:10%;">表示</th>
          <th class="e-trash" style="width:10%;">削除</th>
        </tr>
      </thead>
      <tbody>
        @foreach($categories as $cat)
        <tr class="b-category-body">
          <td class="e-color"><div style="background:#{{ $cat->color }}"></div></td>
          <td class="e-name"><input value="{{ $cat->name }}"></td>
          <td class="e-short"><input value="{{ $cat->short_name }}"></td>
          <td class="e-display">
            <label class="switchArea">
              <input type="checkbox" {{ $cat->display===1 ? 'checked' : '' }}>
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

  <!-- <div class="aaa">aaa</div> -->
  <div class="b-category-save">
    <div class="c-btn m-save">保存</div>
  </div>

  <!-- モーダル -->
  <div class="category-modal"></div>
</section>

@endsection

@section('script')
<script type="module">
$(function(){

  // 予約詳細モーダル起動
  $('.m-add').on('click', function() {
    axios.get("{{ route('menu_item.edit')}}")
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

