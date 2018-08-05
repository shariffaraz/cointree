@extends('website_content.custom_layouts.app')
@section('content')
@section('css')
@endsection

<div class="container">
	@include('members_portal_pages.member_portal_menu')
	@include('custom_layouts.flash_messages')

	@if(Auth::user()->varification_status == 0)
		<div class="alert alert-warning">
		  <strong>Warning!</strong> Please Verify Email Address First before using account dertails.
		</div>
	@else
	<div class="verified_content">
		<h1 style="text-align: center;">Personal Information</h1>
		<form class="myaccount_form" method="POST" action="{{ url('/users/user_details/update/record') }}">
		  <div class="form-group row">
		    <label for="user_name" class="col-sm-2 col-form-label">Username</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="user_name" name="user_name" placeholder="User Name" value="{{$user_details['username']}}">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{$user_details['contact_details']['first_name']}}">
		      {!! csrf_field() !!}
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{$user_details['contact_details']['last_name']}}">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="user_email" class="col-sm-2 col-form-label">Email</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="user_email" name="user_email" placeholder="User Email" value="{{$user_details['email']}}">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="phone_number" class="col-sm-2 col-form-label">Phone Number</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number" value="{{$user_details['contact_details']['phone_number']}}">
		    </div>
		  </div>
		  <hr>
		  <h3 style="text-align: center;">Change Password</h3>
		  <div class="form-group row">
		    <label for="old_password" class="col-sm-2 col-form-label">Old Password</label>
		    <div class="col-sm-10">
		      <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old Password">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="new_password" class="col-sm-2 col-form-label">New Password</label>
		    <div class="col-sm-10">
		      <input type="password" class="form-control" id="password" name="password" placeholder="New Password">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="verify_password" class="col-sm-2 col-form-label">Verify Password</label>
		    <div class="col-sm-10">
		      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Verify Password">
		    </div>
		  </div>
		  <hr>
		  <h3 style="text-align: center;">Social Websites</h3>
		  <div class="form-group row">
		    <label for="fb_page" class="col-sm-2 col-form-label">Facebook Page URL</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="fb_page" name="fb_page" placeholder="Facebook Page URL" value="{{$user_details['contact_details']['fb_url']}}">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="tw_page" class="col-sm-2 col-form-label">Twitter Page URL</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="tw_page" name="tw_page" placeholder="Twitter Page URL" value="{{$user_details['contact_details']['tw_url']}}">
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="skype_usr" class="col-sm-2 col-form-label">Skype Username</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="skype_usr" name="skype_usr" placeholder="Skype Username" value="{{$user_details['contact_details']['skype_usr']}}">
		    </div>
		  </div>
		  <hr>
		  <h3 style="text-align: center;">My Rank</h3>
		  <div style="text-align: center;">
		  	<p>Your Current Rank {!! $user_details['contact_details']['my_rank'] == 0 ? 'MINER' : 'EXPERT' !!}</p>
		  	<p>View full detail of your rank here <a href="#">click here</a></p>
		  </div>
		  <hr>
		  <h3 style="text-align: center;">Google Authentication</h3>
		  <div class="form-group row">
		    <div class="col-sm-10">
		      <a href="javascript:void(0)" class="btn btn-primary form_submit_btn">Submit Request</a>
		      {!! GeneralFunctions::getLoadingGif() !!}
		    </div>
		  </div>
		</form>
	</div>
	@endif
</div>

@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click', '.form_submit_btn', function(){
			$('.loading_gif').show();
			var list = '';
			var form = $('form').serialize();
			$.ajax({
				url: "{{ url('/users/user_details/validate/info') }}",
				type: 'POST',
				data: form,
				success: function(result){
					if(result.status == 'success'){
						$('.myaccount_form').submit()[0];
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
		    }});
		});
		/**
			TODO:
			- Send Ajax Request for Validation
			- If Validation is valid and no error occure submit the form
		 */

	});
</script>
@endsection
@endsection
