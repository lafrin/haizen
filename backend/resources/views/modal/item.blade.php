<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{$title}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('menu_item.create')}}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="category-name">色</label>
            <div></div>
          </div>
          <div class="form-group">
            <label for="category-name">カテゴリー名</label>
            <input type="text" class="form-control" id="category-name" name="category_name">
          </div>
          <div class="form-group">
            <label for="category-short">価格</label>
            <input type="text" class="form-control" id="category-short" name="price">
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

<script>
  $(function(){

  })

</script>