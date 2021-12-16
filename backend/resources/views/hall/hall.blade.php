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

  @if( $tables->isEmpty() )
    <div>テーブルが登録されていません。</div>
  @endif

  <div class="b-tables-status">
    @foreach($tables as $key => $table)
      <button class="e-table-box m-{{ config( 'const.HALL.NUM.'.$table->status )['en'] }}"
      data-toggle="modal" data-target="#hallModal" data-id="{{ $table->id }}" data-table="{{ $table->table_name }}"> 
        <div class="e-number">{{ $table->table_name }}</div>
        <div class="e-status">
          
          @if( $table->status == config( 'const.HALL.EN.enable' )['num'])
            {{ $table->max_people }}名席
          @elseif( $table->status == config( 'const.HALL.EN.cleaning' )['num'])
            {{ config( 'const.HALL.NUM.'.$table->status )['jp'] }}
          @elseif( $table->status == config( 'const.HALL.EN.disable' )['num'])
            使用不可
          @elseif( $table->status == config( 'const.HALL.EN.use' )['num'])
            {{ $table->people }}名
          @endif
        </div>
      </button>
    @endforeach
  </div>


  <!-- モーダル -->
  <div class="modal fade" id="hallModal" tabindex="-1" role="dialog" aria-labelledby="hallModalLabel"
  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><span class="e-modal-table-name"></span>テーブル</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- <form method="POST" action="{{ route('item.create')}}" enctype="multipart/form-data"> -->
            <!-- @csrf -->

            <input class="e-modal-table-number" type="text" value="aiu">

            <div class="b-modal-menu b-modal-enable">
              <button class="e-button btn m-button-people">案内人数を入力</button>
              <a class="e-button btn m-button-disable">使用不可に変更</a>
            </div>

            <div class="b-modal-menu b-modal-use">
              <a class="e-button btn">×　オーダー</a>
              <button class="e-button btn m-button-bill">×　お会計</button>
              <a class="e-button btn">×　注文履歴</a>
              <a class="e-button btn">×　テーブル変更</a>
            </div>

            <div class="b-modal-menu b-modal-cleaning">
              <button class="e-button btn m-button-enable">使用可能に変更</button>
            </div>

            <div class="b-modal-menu b-modal-disable">
              <button class="e-button btn m-button-enable">使用可能に変更</button>
            </div>

            <!-- 人数入力 -->
            <div class="b-input-people">
              <div class="e-title">人数を入力</div>
              <div class="e-people-box form-group">
                <span>　</span><input type="number" class="form-control e-people" value="0">人
              </div>
              <div class="e-buttons">
                <button class="btn btn-danger e-button m-minus">-</button>
                <button class="btn btn-primary e-button m-plus">+</button>
              </div>
              <button class="btn btn-primary e-submit m-people">案内する</button>
            </div>

            <div class="b-input-bill">
              <div class="e-title">清算に変更しますか？</div>
              <button class="btn btn-primary e-submit m-bill">清算する</button>
            </div>

            <div class="b-input-cleaning">
              <div class="e-title">清掃中に変更しますか？</div>
              <button class="btn btn-primary e-submit m-cleaning">変更する</button>
            </div>

            <!-- <div class="b-input-cleaned">
              <div class="e-title">清掃済みに変更しますか？</div>
              <button class="btn btn-primary e-submit m-cleaned">変更する</button>
            </div> -->

            <div class="b-input-enable">
              <div class="e-title">使用不可に変更しますか？</div>
              <button class="btn btn-primary e-submit m-disable">不可にする</button>
            </div>

            <div class="b-input-disable">
              <div class="e-title">使用可能に変更しますか？</div>
              <button class="btn btn-primary e-submit m-enable">可能にする</button>
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

    ////////////////////////////////
    // モーダル開く
    $(document).on('click', '.e-table-box.m-enable', function(){
      hideModalMenu($(this));
      $('.b-modal-enable').show();
    })
    $(document).on('click', '.e-table-box.m-use', function(){
      hideModalMenu($(this));
      $('.b-modal-use').show();
    })
    $(document).on('click', '.e-table-box.m-cleaning', function(){
      hideModalMenu($(this));
      $('.b-modal-cleaning').show();
    })
    $(document).on('click', '.e-table-box.m-disable', function(){
      hideModalMenu($(this));
      $('.b-modal-disable').show();
    })
    function hideModalMenu( content ){
      let id = content.data('id');
      let name = content.data('table');
      $('.b-modal-enable').hide();
      $('.b-modal-use').hide();
      $('.b-modal-cleaning').hide();
      $('.b-modal-disable').hide();

      $('.b-input-people').hide();
      $('.b-input-enable').hide();
      $('.b-input-cleaning').hide();
      // $('.b-input-cleaned').hide();
      $('.b-input-bill').hide();
      $('.b-input-disable').hide();

      $('.e-modal-table-number').val( id ); 
      $('.e-modal-table-name').text( name ); 
    }

    ////////////////////////////////
    // 清掃済みボタン
    // $('.m-button-cleaned').on('click', function(){
    //   $('.b-modal-menu').hide();
    //   $('.b-input-enable').show();
    // })
    
    ////////////////////////////////
    // 清掃中ボタン
    $('.m-button-cleaning').on('click', function(){
      $('.b-modal-menu').hide();
      $('.b-input-enable').show();
    })

    ////////////////////////////////
    // 会計モーダル
    $('.m-button-bill').on('click', function(){
      $('.b-modal-menu').hide();
      $('.b-input-bill').show();
    })

    ////////////////////////////////
    // 使用可ボタン
    $('.m-button-enable').on('click', function(){
      $('.b-modal-menu').hide();
      $('.b-input-disable').show();
    })

    ////////////////////////////////
    // 使用不可ボタン
    $('.m-button-disable').on('click', function(){
      $('.b-modal-menu').hide();
      $('.b-input-enable').show();
    })

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

    //人数入力の決定
    $('.e-submit.m-people').on('click', function(){
      changeTableStatus('use');
    })

    //使用可能に変更
    $('.e-submit.m-enable').on('click', function(){
      changeTableStatus('enable');
    })

    //使用不可に変更
    $('.e-submit.m-disable').on('click', function(){
      changeTableStatus('disable');
    })

    //変更をサーバーへ投げる
    function changeTableStatus( action ){
      const table = getTableInfomation()
      axios.post(
        "{{ route('hall.update_enable') }}",
        { id: table.id, people: table.people, name: table.name, action: action}
      ).then(function(res) {
        console.log(res.data);
        // toastr.info( res.data );
        $('#hallModal').modal('hide');
        changeTableClass(action, res.data);
      }).catch(err => {
        console.log(err.response.data);
        toastr.error( res.data );
      });
    }

    function changeTableClass( action, tableInfo ){
      const table = getTableInfomation();
      let data = $('.e-table-box[data-id="' + tableInfo.id + '"]');
      data.removeClass('m-enable');
      data.removeClass('m-disable');
      data.removeClass('m-cleaning');
      data.removeClass('m-use');
      data.addClass( 'm-' + action );
      data.find('.e-status').text(tableInfo.state);
    }

    //モーダルから情報収集
    function getTableInfomation(){
      let id = $('.e-modal-table-number').val();
      let people = $('.e-people-box .e-people').val();
      let name = $('.e-modal-table-name').text();
      return {'id':id, 'people':people, 'name':name }
    }

  })//function-end

</script>
@endsection