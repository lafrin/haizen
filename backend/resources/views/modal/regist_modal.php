<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{$title}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('menu_cat.create')}}">
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
          <label for="category-short">カテゴリー（略称）</label>
          <input type="text" class="form-control" id="category-short" name="category_short">
        </div>
      
        <div class="modal-body">
          <p>Modal body text goes here.</p>
          @include('modal.item_modal')
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
          <button class="btn btn-primary" type="submit" name="submit">登録</button>
        </div>

      </form>
    </div>
  </div>
</div>