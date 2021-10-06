@extends('layouts.header')

@section('content')
<section>

  <div class="b-category-add">
    <div class="e-btn m-add">＋カテゴリー追加</div>
  </div>

  <div class="b-border"></div>

  <table class="b-category-table">
    <thead>
      <tr class="b-category-head">
        <td class="e-color" style="width:10%;">色</td>
        <td class="e-name" style="width:40%;">カテゴリー名</td>
        <td class="e-short" style="width:40%;">カテゴリー（略称）</td>
        <td class="e-display" style="width:10%;">表示</td>
      </tr>
    </thead>
    <tbody>
      <tr class="b-category-body">
        <td class="e-color"><div></div></td>
        <td class="e-name"><input value=""></td>
        <td class="e-short"><input></td>
        <td class="e-display">
          <label class="switchArea">
            <input type="checkbox">
            <div class="e-border"></div>
            <span></span>
            <div id="swImg"></div>
          </label>

        </td>
      </tr>
    </tbody>
  </table>

</section>

@endsection

@section('script')
@endsection
