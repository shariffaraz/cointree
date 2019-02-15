@extends('website_content.custom_layouts.app')
@section('content')
@section('css')
@endsection
<section class="header1 cid-qZSRdIZaZn mbr-parallax-background" id="header1-9">
    <div class="mbr-overlay" style="opacity: 0.6; background-color: rgb(255, 255, 255);">
    </div>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="mbr-white col-md-10">
                <h1 class="mbr-section-title align-center mbr-bold pb-3 mbr-fonts-style display-1">
                    Login</h1>

                <p class="mbr-text align-center pb-3 mbr-fonts-style display-5">
                    Home / Login</p>

            </div>
        </div>
    </div>

</section>
<br>
<div class="container">
	<h3>Member Login</h3>
	@include('custom_layouts.flash_messages')
	<form class="member_login_form" method="POST" action="{{ url('member/authentication') }}">
	  <div class="form-group row">
	    <label for="first_name" class="col-sm-2 col-form-label">User Name</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="user_name" name="user_name" placeholder="User Name">
	      {!! csrf_field() !!}
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="last_name" class="col-sm-2 col-form-label">Password</label>
	    <div class="col-sm-10">
	      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
	    </div>
	  </div>
	  <div class="form-group row">
	    <div class="col-sm-10">
	      <a href="javascript:void(0)" class="btn btn-primary form_submit_btn">Login</a>
	      {!! GeneralFunctions::getLoadingGif() !!}
	    </div>
	  </div>
	  <div class="form-group row">
	    <div class="col-sm-10">
	      <a href="{{url('forget/password')}}">forget password ?</a>
	    </div>
	  </div>
	</form>
	<hr>
	<h3>Lead/Free Members. Enter Email for Access</h3>
	<form class="membership_form" method="POST" action="{{ url('member/login') }}">
	  <div class="form-group row">
	    <label for="first_name" class="col-sm-2 col-form-label">Email</label>
	    <div class="col-sm-10">
	      <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Email">
	      {!! csrf_field() !!}
	    </div>
	  </div>
	  <div class="form-group row">
	    <div class="col-sm-10">
	      <a href="javascript:void(0)" class="btn btn-primary">Login</a>
	    </div>
	  </div>
	   <div class="form-group row">
	    <div class="col-sm-10">
	      <p>Note : If you have not purchased ......</p>
	    </div>
	  </div>
	</form>
</div>
@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click', '.form_submit_btn', function(){
			$('.loading_gif').show();
			var list = '';
			var form = $('form').serialize();
			$.ajax({
				url: "{{ url('/members/login/validate/info') }}",
				type: 'POST',
				data: form,
				success: function(result){
					if(result.status == 'success'){
						$('.member_login_form').submit()[0];
					}
					else{
						var errorArray = result.msg_data;
                        errorArray.forEach(function(e){
                            list = list +'<li>'+e+'</li>';
                        });

                        $('#msg-list').html(list);
                        $('.msg-box').addClass("alert-danger").show();
					}
					$("html, .container").animate({ scrollTop: 0 }, 600);
		        	$('.loading_gif').hide();
		    	}
			});
		});
	});
</script>
@endsection
@endsection
