
@extends('layouts.header')

@section('content')
<section>
  <div class="b-category-add">
    <a class="c-btn m-item" href="{{route('menu_item')}}">⇒商品画面</a>
    <a class="c-btn m-add">＋カテゴリー追加</a>
  </div>

  {{ Form::open(['route'=> 'menu_cat.edit']) }}
    {{ Form::token() }}
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
            {{ Form::hidden("category[id][]", $cat->id) }}
            <td class="e-color">
              {{ Form::text("category[color][]", $cat->color,['class' => 'form-control, picker']) }}
            </td>
            <td class="e-name">{{ Form::text("category[name][]", $cat->name, ['class' => 'form-control']) }}</td>
            <td class="e-short">{{ Form::text("category[short_name][]", $cat->short_name, ['class' => 'form-control']) }}</td>
            <td class="e-display">
              <label class="switchArea">
                <!-- checkboxは0の時に送信されないのでon、off用に2つ作っている -->
                <input type="hidden" name="category[display][{{$loop->index}}][]" value="0">
                {{ Form::checkbox("category[display][$loop->index][]", true, $cat->display, ['class' => 'form-control']) }}

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
  {{ Form::close() }}
  <!-- モーダル -->
  <div class="category-modal"></div>
</section>

@endsection

@section('script')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.css"></script>
<script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.js"></script>
<script type="module">
  $(function(){
    @if (session('flash_msg'))
      toastr.info('保存しました');
    @endif
    
    $(".picker").spectrum({
      preferredFormat: "hex"
      // showPaletteOnly: true,
      // togglePaletteOnly: true,
      // togglePaletteMoreText: 'more',
      // togglePaletteLessText: 'less',
      // color: 'blanchedalmond',
      // palette: [
      //     ["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
      //     ["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
      //     ["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
      //     ["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
      //     ["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
      //     ["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
      //     ["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
      //     ["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
      // ]
    });

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

  })//function-end
</script>
@endsection
