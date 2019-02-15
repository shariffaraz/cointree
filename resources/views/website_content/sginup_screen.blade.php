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
	                    Sign Up</h1>

	                <p class="mbr-text align-center pb-3 mbr-fonts-style display-5">
	                    Home / Sign Up</p>

	            </div>
	        </div>
	    </div>

	</section>
  	<br>
	<div class="container">
		@include('custom_layouts.flash_messages')
		<form class="sponsar_form" method="POST" action="{{ url('send/sponsar_details/') }}">
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
			$.ajax({
				url: "{{ url('/sponsar/needed/validate/info') }}",
				type: 'POST',
				data: form,
				success: function(result){
					if(result.status == 'success'){
						$('.sponsar_form').submit()[0];
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
