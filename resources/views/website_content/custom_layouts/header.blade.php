<div class="header" style="padding:unset; background-color: #000000;">
  <a href="#default" class="logo"></a>
  <div style="float: right;">
    @if(Auth::check())
      <a style="color: #f19434;" href="{{ url('/users/dashboard') }}">Hi! {!! Session::get('full_name') !!}</a>
      <a style="color: #f19434;" href="{{ url('/logout') }}">LOGOUT</a>
    @else
      <a style="color: #f19434;" href="{{ url('/member/login') }}">LOGIN</a>
    @endif
  </div>
</div>
<!-- <div class="header" style="
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
</div> -->

<section class="menu cid-qZMNvmbc7a" once="menu" id="menu1-6" >
    <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-toggleable-sm">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        <div class="menu-logo">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="{{url('/')}}">
                         <img src="{{ url('assets/images/cointree-logo-122x43.png') }}" alt="Mobirise" title="" style="height: 3.8rem;">
                    </a>
                </span>
                
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
                <li class="nav-item"><a class="{{ request()->is('/') ? 'active' : 'nav-link link text-black display-4' }}" href="{{ url('/') }}">Home</a></li>
                <li class="nav-item"><a class="{{ request()->is('about_us') ? 'active' : 'nav-link link text-black display-4' }}" href="{{ url('/about_us') }}">About Us</a></li>
                <li class="nav-item"><a class="{{ request()->is('mining_pool') ? 'active' : 'nav-link link text-black display-4' }}" href="{{ url('/mining_pool') }}">Mining Pool</a></li>
                <li class="nav-item"><a class="{{ request()->is('opportunity') ? 'active' : 'nav-link link text-black display-4' }}" href="{{ url('/opportunity') }}">Opportunity</a></li>
                <li class="nav-item"><a class="{{ request()->is('contact_us') ? 'active' : 'nav-link link text-black display-4' }}" href="{{ url('/contact_us') }}">Contact Us</a></li>
            </ul>
            <div class="navbar-buttons mbr-section-btn"><a class="btn btn-sm btn-primary display-4" href="{{ url('/sign_up') }}">Signup<br>
                    </a></div>
        </div>
    </nav>
</section>
