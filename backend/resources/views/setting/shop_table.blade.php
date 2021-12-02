@extends('layouts.setting')

@section('content')
<section>

  <!-- @if($tables->count() == 0)
  <div class="b-none-category">
    <p class="m-text">テーブルがありません。</p>
  </div>
  @endif -->

  {{ Form::open(['route'=> 'table.edit'])}}
  {{ Form::token() }}
  <div class="table-form">
    <div class="category-table table-responsive">
      <table class="table b-category-table">
        <thead>
          <tr class="b-category-head">
            <th class="e-sort" style="width:5%;"></th>
            <th class="e-name" style="width:30%;">テーブル名</th>
            <th class="e-people" style="width:30%;">最大人数</th>
            <th class="e-display" style="width:5%;">表示</th>
            <th class="e-display" style="width:7%;"></th>
          </tr>
        </thead>
        <tbody>

          @foreach($tables as $item)
          <tr class="b-category-body">
            {{ Form::hidden("item_id[$item->id]", $item->id, ['class'=>'category_id']) }}
            <td class="e-sort">三</td>

            <td class="e-name">
              {{ Form::text("name_$item->id", $item->table_name, ['class' => 'form-control','placeholder' =>"テーブル名"]) }}
              @error("name_$item->id")
              <div class="text-danger small">{{ $message }}</div>
              @enderror
            </td>

            <td class="e-people">
              {{ Form::number("people_$item->id", $item->max_people, ['class' => 'form-control','placeholder' =>"最大人数"]) }}
              @error("people_$item->id")
              <div class="text-danger small">{{ $message }}</div>
              @enderror
            </td>
          
            <td class="e-display">
              <label class="switchArea">
                {{ Form::checkbox("display_$item->id", true, $item->is_display, ['class' => 'form-control']) }}

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
      <a class="btn btn-primary m-add" data-toggle="modal" data-target="#exampleModal">＋テーブルを追加</a>
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
          <form method="POST" action="{{ route('table.create')}}" enctype="multipart/form-data">
            @csrf


            <div class="form-group">
              <label for="item-name">テーブル名</label>
              <input type="text" class="form-control" id="item-name" name="name">
            </div>

            <div class="form-group">
              <label for="item-people">最大人数</label>
              <input type="number" class="form-control" id="item-people" name="people">
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