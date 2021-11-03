@extends('layouts.setting')

@section('content')
<section>

  @if($categories->count() == 0)
  <p>
    カテゴリーがありません。<br>
    カテゴリー設定から入力してください。
  </p>
  @else

  {{ Form::open(['route'=> 'item.edit'])}}
  {{ Form::token() }}
  <div class="table-form">
    <div class="category-table table-responsive">
      <table class="table b-category-table">
        <thead>
          <tr class="b-category-head">
            <th class="e-sort" style="width:5%;"></th>
            <th class="e-name" style="width:30%;">カテゴリー名</th>
            <th class="e-short" style="width:30%;">商品名</th>
            <th class="e-short" style="width:13%;">価格</th>
            <th class="e-short" style="width:10%;">画像</th>
            <th class="e-display" style="width:5%;">表示</th>
            <th class="e-display" style="width:7%;"></th>
          </tr>
        </thead>
        <tbody>

          @foreach($items as $item)
          <tr class="b-category-body">
            {{ Form::hidden("item_id[$item->id]", $item->id, ['class'=>'category_id']) }}
            <td class="e-sort">三</td>
            <td class="e-category">
              {{ Form::select("category_id_$item->id", $cat_list, $item->id,['class' =>
              'form-control']) }}
            </td>
            <td class="e-name">{{ Form::text("name_$item->id", $item->name, ['class' => 'form-control','placeholder' =>
              "商品名"]) }}
              @error("name_$item->id")
              <div class="text-danger small">{{ $message }}</div>
              @enderror
            </td>
            <td class="e-price">{{ Form::text("price_$item->id", $item->price, ['class' => 'form-control', 'min' =>
              0])}}
              @error("price_$item->id")
              <div class="text-danger small">{{ $message }}</div>
              @endif
            </td>
            <td>
              <img src="{{ $item->image_path ? $item->image_path : '/img/no_image.jpg'}}" alt=""
                style="width: 100%;  object-fit:cover;" class="">
            </td>
            <td class="e-display">
              <label class="switchArea">
                <!-- checkboxは0の時に送信されないのでon、off用に2つ作っている -->
                {{ Form::checkbox("display_$item->id", true, $item->display, ['class' => 'form-control'])
                }}

                <div class="e-border"></div>
                <span></span>
                <div id="swImg"></div>
              </label>
            </td>
            <td class="e-trash"><a class="delete-btn" data-id="{{$item->id}}" href="#"><i
                  class="fas fa-trash trash"></i></a></td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>

    <div class="b-category-save">
      <a class="btn btn-primary m-add" data-toggle="modal" data-target="#exampleModal">＋商品を追加</a>
      <button class="btn btn-success m-save" type="submit">保存</button>
    </div>
  </div>
  {{ Form::close() }}


  <!-- モーダル -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{$title}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('item.create')}}" enctype="multipart/form-data">
            @csrf



            <div class="form-group">
              <label for="item-cateogry">カテゴリー名</label>
              <select class="form-control" id="item-cateogry" name="category_id">
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="item-name">商品名</label>
              <input type="text" class="form-control" id="item-name" name="name">
            </div>
            <div class="form-group">
              <label for="item-price">価格</label>
              <input type="number" class="form-control" id="item-price" name="price">
            </div>
            <div class="form-group">
              <label for="item_image">画像</label>
              <input type="file" class="form-control image" id="item_image" name="images">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
              <button class="btn btn-primary" type="submit">登録</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
  @endif
</section>

@endsection

@section('script')
<script type="module">
  $(function(){

    //トースト表示
    @if (session('flash_msg'))
      toastr.info("{{session('flash_msg')}}");
    @endif


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
        url: "{{ route('item.delete')}}",
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