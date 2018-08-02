@extends('website_content.custom_layouts.app')
@section('content')
@section('css')
@endsection
	<div class="page_heading">
	  	<div class="page-heading-title">
	  		<h3>Sign Up</h3>
	  		<p>Home / Sign Up</p>
	  	</div>
  	</div>
  	<br>
	<div class="container">
		@include('custom_layouts.flash_messages')
		<form class="membership_form" method="POST" action="{{ url('save/membership_details/') }}">
		  <div class="form-group row">
		    <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
		      {!! csrf_field() !!}
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="user_name" class="col-sm-2 col-form-label">Username</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="user_name" name="user_name" placeholder="User Name">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="user_email" class="col-sm-2 col-form-label">Email</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="user_email" name="user_email" placeholder="User Email">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="password" class="col-sm-2 col-form-label">Password</label>
		    <div class="col-sm-10">
		      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="confirm_password" class="col-sm-2 col-form-label">Re-type Password</label>
		    <div class="col-sm-10">
		      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re Type Password">
		    </div>
		  </div>
		  <div class="form-group row">
		    <div class="col-sm-10">
		      <a href="javascript:void(0)" class="btn btn-primary form_submit_btn">Submit Request</a>
		      {!! GeneralFunctions::getLoadingGif() !!}
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
				url: "{{ url('/membership/validate/info') }}",
				type: 'POST',
				data: form,
				success: function(result){
					if(result.status == 'success'){
						$('.membership_form').submit()[0];
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
