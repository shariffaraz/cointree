@extends('website_content.custom_layouts.app')
@section('content')
@section('css')
@endsection
	<div class="container">
		@include('custom_layouts.flash_messages')
		<h1>Sign Up</h1>
		<form class="contact_us_form" method="POST" action="{{ url('send/contact_us/details') }}">
		  <div class="form-group row">
		    <label for="inputEmail3" class="col-sm-2 col-form-label">Sponsor Needed</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="sponsar_username" name="sponsar_username" placeholder="Sponsar Username">
		      {!! csrf_field() !!}
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
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click', '.form_submit_btn', function(){
			$('.loading_gif').show();
			var list = '';
			var form = $('form').serialize();
			if (grecaptcha.getResponse() == ""){
			    alert("You can't proceed!");
			    $('.loading_gif').hide();
			} else {
				$.ajax({
					url: "{{ url('/sponsar/needed/validate/info') }}",
					type: 'POST',
					data: form,
					success: function(result){
						if(result.status == 'success'){
							$('.contact_us_form').submit()[0];
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
			}
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
