@extends('website_content.custom_layouts.app')
@section('content')
@section('css')
@endsection

<div class="container">
	@include('members_portal_pages.member_portal_menu')

	@if(Auth::user()->varification_status == 0)
		<div class="alert alert-warning">
		  <strong>Warning!</strong> Please Verify Email Address First before using account dertails.
		</div>
	@else
	<div class="verified_content">
		<h1 style="text-align: center;">How to Upgrade your Account</h1>
		<h3>STEP 1 : Signup for the .....</h3>
		<h3>STEP 2 : After you purchase .....</h3>
		<a href="{{ url('/users/upgrade_my_account') }}" class="btn btn-success">Upgrade my Account</a>
	</div>
	@endif
</div>

@endsection
