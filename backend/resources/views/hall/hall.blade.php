@extends('layouts.main')

@section('content')
<section>

  
  <div class="b-table-header">
    <?php foreach( $categories as $key => $row ): ?>
      <div class="e-table-box">
        <div class="e-color m-{{$key}}"></div>
        <div class="e-text">{{$row}}</div> 
      </div>
    <?php endforeach ?>

  </div>
  
  <div class="b-tables-status">
    <?php foreach( range(1,8) as $row ): ?>
      <div class="e-table-box m-possible">
        <div class="e-number">{{$row}}</div>
        <div class="e-status">4mei</div>
      </div>
    <?php endforeach ?>
  </div>


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