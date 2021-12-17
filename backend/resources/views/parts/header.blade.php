<header>
  <a class="back" href="{{route('menu')}}"><i class="fas fa-reply"></i></a> 
  <div class="title">HAIZEN</div>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" name="logout">
      @csrf
      <a class="logout" href="javascript:document.logout.submit()">ログアウト</a>
  </form>
</header>