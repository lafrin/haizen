@extends('layouts.setting')

@section('content')
<section>


  {{ Form::open(['route'=> 'category.edit'])}}
  {{ Form::token() }}
  <div class="table-form">
    <div class="category-table table-responsive">
      <table class="table b-category-table">
        <thead>
          <tr class="b-category-head">
            <th class="e-sort" style="width:5%;"></th>
            <th class="e-color" style="width:10%;">色</th>
            <th class="e-name" style="width:30%;">カテゴリー名</th>
            <th class="e-short" style="width:30%;">カテゴリー（略称）</th>
            <th class="e-display" style="width:10%;">表示</th>
            <th class="e-display" style="width:10%;"></th>
          </tr>
        </thead>
        <tbody>

          @foreach($categories as $cat)
          <tr class="b-category-body">
            {{ Form::hidden("category[id][]", $cat->id, ['class'=>'category_id']) }}
            <td class="e-sort">三</td>
            <td class="e-color">
              {{ Form::text("category[color][]", $cat->color,['class' => 'form-control, picker']) }}
            </td>
            <td class="e-name">{{ Form::text("category[name][]", $cat->name, ['class' => 'form-control']) }}</td>
            <td class="e-short">{{ Form::text("category[short_name][]", $cat->short_name, ['class' => 'form-control'])
              }}</td>
            <td class="e-display">
              <label class="switchArea">
                {{ Form::checkbox("category[display][$loop->index][]", true, $cat->is_display, ['class' => 'form-control'])
                }}

                <div class="e-border"></div>
                <span></span>
                <div id="swImg"></div>
              </label>
            </td>
            <td class="e-trash"><a class="delete-btn" data-id="{{$cat->id}}" href="#"><i
                  class="fas fa-trash trash"></i></a></td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>

    <div class="b-category-save">
      <a class="btn btn-primary m-add">＋カテゴリー追加</a>
      <button class="btn btn-success m-save" type="submit">保存</button>
    </div>
  </div>
  {{ Form::close() }}


  <!-- モーダル -->
  <div class="category-modal"></div>

</section>

@endsection

@section('script')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.css">
</script>
<script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.js"></script>
<script type="module">
  $(function(){

    //トースト表示
    @if (session('flash_msg'))
      toastr.info("{{session('flash_msg')}}");
    @endif
    
    //カラーピッカー
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
      axios.get("{{ route('category.create_modal')}}")
      .then(function(res) {
          $('.category-modal').html(res.data).find('.modal').modal().trigger('launch');
      })
      .catch(function(error){
        console.log("error");
      });
    });

    //削除
    $('.delete-btn').on('click',function(){

      const row = $(this).parents('.b-category-body');
      const cat_id =  row.find('.category_id').val();
      const name = row.find('.e-name').find('input').val(); 

      if( !confirm(name + 'を削除しますか？') ){
        return;
      }

      axios({
        method: 'post',
        url: "{{ route('category.delete')}}",
        data: 'category_id='+cat_id
        }).then(res => {
            toastr.info(name + "を削除しました" );
            row.remove();
        }).catch(err => {
            console.log(err.response.data);
            
        });
    });

  })//function-end
</script>
@endsection