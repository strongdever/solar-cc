@auth
<div class="p_manager_nav_wrapper">
  <ul class="p_manager_nav">
    <li>
      <a href="{{ route('myproducts') }}">オフィス機器管理</a>
    </li>
    <li>
      <a href="{{ route('messages') }}">メッセージ</a>
    </li>
    <li>
      <a href="{{ route('transactions') }}">取引履歴</a>
    </li>
    <li>
      <a href="{{ route('watchlists') }}">お気に入り</a>
    </li>
    <li>
      <a href="{{ url('profile/' . Auth::user()->name) }}">プロフィール</a>
    </li>
  </ul>
</div>
@endauth