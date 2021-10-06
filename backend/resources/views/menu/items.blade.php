@extends('layouts.header')

@section('content')
<section>

  <div class="b-category-add">
    <div class="c-btn m-item">⇒商品画面</div>
    <div class="c-btn m-add">＋カテゴリー追加</div>
  </div>

  <div class="table-responsive">
    <table class="table b-category-table">
      <thead>
        <tr class="b-category-head">
          <th class="e-color" style="width:10%;">順番</th>
          <th class="e-name" style="width:35%;">カテゴリー名</th>
          <th class="e-short" style="width:35%;">商品名</th>
          <th class="e-display" style="width:10%;">価格</th>
          <th class="e-display" style="width:10%;">画像</th>
          <th class="e-display" style="width:10%;">表示</th>
          <th class="e-display" style="width:10%;">削除</th>
        </tr>
      </thead>
      <tbody>
        <tr class="b-category-body">
          <td class="e-color"><div></div></td>
          <td class="e-name"><input></td>
          <td class="e-short"><input></td>
          <td class="e-display">
            <label class="switchArea">
              <input type="checkbox">
              <div class="e-border"></div>
              <span></span>
              <div id="swImg"></div>
            </label>
          </td>
          <td class="e-trash"><i class="fas fa-trash trash"></i></td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- <div class="aaa">aaa</div> -->
  <div class="b-category-save">
    <div class="c-btn m-save">保存</div>
  </div>

</section>

@endsection

@section('script')
@endsection
