@extends('website_content.custom_layouts.app')
@section('content')
@section('css')
@endsection

<div class="container">
	@include('members_portal_pages.member_portal_menu')
	@include('custom_layouts.flash_messages')

	@if(Auth::user()->varification_status == 0)
	<div class="unverified_content" style="text-align: center;">
		<h1>Email Verification Required</h1>
		<br>
		The Email address - <u>{{Auth::user()->email}}</u> - Has NOT been Verified
		<p>Please, Click below to verify .....</p>

		<form class="verify_code" method="POST" action="{{ url('/users/verify/email_address') }}">
			<div class="form-group row">
			    <label for="verification_code" class="col-sm-2 col-form-label">Verification Code</label>
			    <div class="col-sm-5">
			      <input type="number" class="form-control" id="verification_code" name="verification_code" placeholder="Verification Code">
			      {!! csrf_field() !!}
			    </div>
		  	</div>
		  	<div class="form-group row">
			    <div class="col-sm-3">
			    	<a href="javascript:void(0)" class="btn btn-danger resend_verifiction_code">Send Code</a>
			    	<a href="javascript:void(0)" class="btn btn-success form_submit_btn">Verify Email</a>
			    	{!! GeneralFunctions::getLoadingGif() !!}
			    </div>
		  	</div>
		</form>
	</div>
	@else
	<div class="verified_content">
		<h1 style="text-align: center;">WELCOME TO COINTREE NETWORK</h1>
		<div class="video_banner">
			Video Banner
		</div>
	</div>
	<h3>Etc......</h3>
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
				url: "{{ url('/users/verify_code/validate/info') }}",
				type: 'POST',
				data: form,
				success: function(result){
					if(result.status == 'success'){
						$('.verify_code').submit()[0];
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
