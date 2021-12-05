@extends('layouts.main')

@section('content')
<section>

  
  <div class="b-table-header">
    <?php foreach( config('const.HALL.NUM') as $key => $row ): ?>
      <div class="e-table-box">
        <div class="e-color m-{{ $row['en'] }}"></div>
        <div class="e-text">{{ $row['jp'] }}</div> 
      </div>
    <?php endforeach ?>

  </div>
  
  <div class="b-tables-status">
    @foreach($tables as $key => $row)
      <button class="e-table-box m-{{ config( 'const.HALL.NUM.'.$row->status )['en'] }}"
      data-toggle="modal" data-target="#exampleModal" data-id="{{ $row->id }}"> 
        <div class="e-number">{{ $row->table_name }}</div>
        <div class="e-status">
          @if( $row->status == config( 'const.HALL.EN_NUM.cleaning' ))
            {{ config( 'const.HALL.NUM.'.$row->status )['jp'] }}
          @else
            {{ $row->max_people }}名席
          @endif
      </div>
      </button>
    @endforeach
  </div>


  <!-- モーダル -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><span class="e-modal-title"></span>番テーブル</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- <form method="POST" action="{{ route('item.create')}}" enctype="multipart/form-data"> -->
            <!-- @csrf -->

            <div class="b-modal-menu b-modal-enable">
              <button class="e-button btn m-button-people">人数入力</button>
              <a class="e-button btn m-button-cleaning">清掃中に変更</a>
            </div>

            <div class="b-modal-menu b-modal-use">
              <a class="e-button btn">オーダー</a>
              <button class="e-button btn m-button-bill">お会計</button>
              <a class="e-button btn">注文履歴</a>
              <a class="e-button btn">テーブル変更</a>
            </div>

            <div class="b-modal-menu b-modal-cleaning">
              <a class="e-button btn m-button-clean">清掃済み</a>
            </div>

            <div class="b-modal-menu b-modal-disable">
              <button class="e-button btn m-button-disable">使用可能に変更</button>
            </div>

            <!-- 人数入力 -->
            <div class="b-input-people">
              <div class="e-title">人数を入力</div>
              <div class="e-people-box form-group">
                <input type="number" class="form-control e-people" value="0">人
              </div>
              <div class="e-buttons">
                <button class="btn btn-danger e-button m-minus">-</button>
                <button class="btn btn-primary e-button m-plus">+</button>
              </div>
              <button class="btn btn-primary e-submit m-people">案内する</button>
            </div>

            <!-- 清算 -->
            <div class="b-input-bill">
              <div class="e-title">清算しますか？</div>
              <button class="btn btn-primary e-submit m-bill">清算する</button>
            </div>

            <!-- 清掃中に変更 -->
            <div class="b-input-cleaning">
              <div class="e-title">清掃中に変更しますか？</div>
              <button class="btn btn-primary e-submit m-cleaning">変更する</button>
            </div>

            <!-- 清掃済みに変更 -->
            <div class="b-input-clean">
              <div class="e-title">清掃済みに変更しますか？</div>
              <button class="btn btn-primary e-submit m-clean">変更する</button>
            </div>

            <!-- 使用不可 -->
            <div class="b-input-disable">
              <div class="e-title">使用可能にしますか？</div>
              <button class="btn btn-primary e-submit m-disable">可能にする</button>
            </div>

          <!-- </form> -->
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

    ////////////////////////////////
    // モーダル開く
    $('.m-enable').on('click', function(){
      hideModalMenu($(this).data('id'));
      $('.b-modal-enable').show();
    })
    $('.m-use').on('click', function(){
      hideModalMenu($(this).data('id'));
      $('.b-modal-use').show();
    })
    $('.m-cleaning').on('click', function(){
      hideModalMenu($(this).data('id'));
      $('.b-modal-cleaning').show();
    })
    $('.m-disable').on('click', function(){
      hideModalMenu($(this).data('id'));
      $('.b-modal-disable').show();
    })

    function hideModalMenu(id){
      console.log(id);
      $('.b-modal-enable').hide();
      $('.b-modal-use').hide();
      $('.b-modal-cleaning').hide();
      $('.b-modal-disable').hide();

      $('.b-input-people').hide();
      $('.b-input-cleaning').hide();
      $('.b-input-clean').hide();
      $('.b-input-bill').hide();
      $('.b-input-disable').hide();
      $('.e-modal-title').text( id ); 
    }

    ////////////////////////////////
    // 人数入力モーダル
    $('.m-button-people').on('click', function(){
      $('.b-modal-menu').hide();
      $('.b-input-people').show();
    })

    $('.m-minus').on('click', function(){
      let people = $('.e-people');
      let count = 0;
      if( Number(people.val()) > 0 ){
        count = Number(people.val()) -1
      }
      people.val( count );
    })

    $('.m-plus').on('click', function(){
      let people = $('.e-people');
      people.val( Number(people.val()) +1 );
    })

    ////////////////////////////////
    // 清掃中モーダル
    $('.m-button-cleaning').on('click', function(){
      $('.b-modal-menu').hide();
      $('.b-input-cleaning').show();
    })
    
    ////////////////////////////////
    // 清掃モーダル
    $('.m-button-clean').on('click', function(){
      $('.b-modal-menu').hide();
      $('.b-input-clean').show();
    })

    ////////////////////////////////
    // 清算モーダル
    $('.m-button-bill').on('click', function(){
      $('.b-modal-menu').hide();
      $('.b-input-bill').show();
    })

    ////////////////////////////////
    // 使用不可モーダル
    $('.m-button-disable').on('click', function(){
      $('.b-modal-menu').hide();
      $('.b-input-disable').show();
    })
    
  })//function-end
</script>
@endsection