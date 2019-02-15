@extends('website_content.custom_layouts.app')
@section('content')
@section('css')
@endsection

<div class="container">
	@include('members_portal_pages.member_portal_menu')
	<h1 style="text-align: center;">Members Detail Page</h1>
	<div class="content">
		<div class="chart" id="OrganiseChart-simple">
		</div>
	</div>
</div>
@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		var getMemberDetails = <?php echo json_encode($record[0]) ?>;
		console.log(getMemberDetails);
		var simple_chart_config = {
			chart: {
				container: "#OrganiseChart-simple"
			},

			nodeStructure: getMemberDetails,
		};

		// var simple_chart_config = {
		// 	chart: {
		// 		container: "#OrganiseChart-simple"
		// 	},

		// 	nodeStructure: {
		// 		text: { name: "Parent node" },
		// 		children: [
		// 			{
		// 				text: { name: "First child" }
		// 			},
		// 			{
		// 				text: { name: "Second child" }
		// 			}
		// 		]
		// 	}
		// };
		new Treant( simple_chart_config );
	});
</script>
@endsection
@endsection
