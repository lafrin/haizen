<style>
  .b-side-menu {}
</style>
<div class="b-side-menu">

  <ul>
    <li class="{{ request()->is('setting/config') ? 'side-active' : ''}}">
      <a href="{{ route('config') }}">基本設定</a>
    </li>
    <li class="{{ request()->is('setting/category') ? 'side-active' : ''}}">
      <a href=" {{ route('category') }}">カテゴリー設定</a>
    </li>
    <li class="{{ request()->is('setting/item') ? 'side-active' : ''}}">
      <a href=" {{ route('item') }}">商品設定</a>
    </li>
  </ul>
</div>