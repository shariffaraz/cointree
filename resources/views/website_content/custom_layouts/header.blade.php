<div class="header" style="padding:unset; background-color: #000000;">
  <a href="#default" class="logo"></a>
  <div style="float: right;">
    @if(Auth::check())
      <a style="color: #f19434;" href="javascript:void(0)">Hi! {!! Session::get('full_name') !!}</a>
      <a style="color: #f19434;" href="{{ url('/logout') }}">LOGOUT</a>
    @else
      <a style="color: #f19434;" href="{{ url('/member/login') }}">LOGIN</a>
    @endif
  </div>
</div>
<div class="header" style="
  width: 100%;
  transform: scale(.999);
  box-shadow: 0px 1px 22px 2px #000000;">
  <a href="#default" class="logo"><img src="{{url('images/cointree_logo.png')}}"></a>
  <div class="header-right">
    <a class="{{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
    <a class="{{ request()->is('about_us') ? 'active' : '' }}" href="{{ url('/about_us') }}">About Us</a>
    <a class="{{ request()->is('mining_pool') ? 'active' : '' }}" href="{{ url('/mining_pool') }}">Mining Pool</a>
    <a class="{{ request()->is('opportunity') ? 'active' : '' }}" href="{{ url('/opportunity') }}">Opportunity</a>
    <a class="{{ request()->is('contact_us') ? 'active' : '' }}" href="{{ url('/contact_us') }}">Contact Us</a>
    <a class="menue_signup" href="{{ url('/sign_up') }}">Sign Up</a>
  </div>
</div>
