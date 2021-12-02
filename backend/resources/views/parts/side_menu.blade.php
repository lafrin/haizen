
<ul class="ul b-side-menu list-group">
  <li class="{{ request()->is('setting/config') ? 'active' : ''}}">
    <a href="{{ route('config') }}"><i class="fas fa-user-cog"></i>基本設定</a>
  </li>
  <li class="{{ request()->is('setting/category') ? 'active' : ''}}">
    <a href=" {{ route('category') }}"><i class="fas fa-cubes"></i>カテゴリー設定</a>
  </li>
  <li class="{{ request()->is('setting/item') ? 'active' : ''}}">
    <a href=" {{ route('item') }}"><i class="fas fa-cube"></i>商品設定</a>
  </li>
  <li class="{{ request()->is('setting/table') ? 'active' : ''}}">
    <a href=" {{ route('table') }}"><i class="fas fa-cube"></i>テーブル設定</a>
  </li>
</ul>