<br>
<br>
<br>
<br>
<nav class="navbar navbar-expand-sm navbar-light" style="background-color:unset;">
  <ul class="navbar-nav">
    <li class="nav-item {{ Route::current()->getName() == 'dashboard'  ? 'active' : '' }}" style="{{ Route::current()->getName() == 'dashboard' ? 'border-bottom: 5px solid #f19434;' : '' }}">
      <a class="nav-link" href="{{ url('users/dashboard') }}">Welcome</a>
    </li>
    <li class="nav-item {{ Route::current()->getName() == 'my_account' ? 'active' : '' }}" style="{{ Route::current()->getName() == 'my_account' ? 'border-bottom: 5px solid #f19434;' : '' }}">
      <a class="nav-link" href="{{ url('users/my_account') }}">My Account</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ Route::current()->getName() == 'how_to_buy_bitcoin' ? 'active' : '' }}" style="{{ Route::current()->getName() == 'how_to_buy_bitcoin' ? 'border-bottom: 5px solid #f19434;' : '' }}" href="{{ url('users/how_to_buy_bitcoin') }}">How To Buy Bitcoin</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ Route::current()->getName() == 'faq' ? 'active' : '' }}" style="{{ Route::current()->getName() == 'faq' ? 'border-bottom: 5px solid #f19434;' : '' }}" href="{{ url('users/faq') }}">FAQ</a>
    </li>
    <li class="nav-item {{ Route::current()->getName() == 'members_details'  ? 'active' : '' }}" style="{{ Route::current()->getName() == 'members_details' ? 'border-bottom: 5px solid #f19434;' : '' }}">
      <a class="nav-link" href="{{ url('users/members_details') }}">Members Detail</a>
    </li>
  </ul>
</nav>
