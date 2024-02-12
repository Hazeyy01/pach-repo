<!DOCTYPE html>
<html lang="en">
<head>
	<title>Development Page</title>
	@include('section.header')
</head>
<body>
	@include('section.sidemenu')
	<div class="content">
		@include('section.topmenu')
		<div class="border-bottom">
			<div class="page-title p-2">
				Development Milestones
			</div>
		</div>
		<div class="p-2 border-bottom text-secondary">"Kindly press the 'Question' button to view inquiries pertaining to child development."</div>
		<div class="p-2">
			<div class="card w-100">
				<div class="card-header">
					Milestone List
				</div>
				<ul class="list-group list-group-flush overflow-auto">
					<li class="list-group-item p-2">
						<table id="thirdDatatable" class="table table-striped compact" style="width:100%">
							<thead>
								<tr>
									<th>Milestone</th>
									<th>Category</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<script>
		@include('section.footer')
    function onPageLoad() {
			onGetMilestones();
    }

		function onGetMilestones() {
			$('#thirdDatatable').DataTable().clear().destroy();

			$.ajax({
				type: 'GET',
				url: '/milestones'
			}).then(function(dataList) {
				for (let milestone of dataList.milestones) {
					let questionBtn = $('<btn>').addClass('btn btn-sm btn-info m-1').click(function() { onRedirectData(milestone.milestone_id); }).append('Question');

					$('#thirdDatatable > tbody:last').append($('<tr>')
						.append($('<td>').append(milestone.milestone_name))
						.append($('<td>').append(milestone.milestone_category))
						.append($('<td>').append(questionBtn))
					);
				}

				$('#thirdDatatable').dataTable(@include('section.datatable_option'));
			});
		}

		function onRedirectData(id) {
			window.location.href = `/parent/dashboard/milestones/questions/${id}/${window.location.pathname.split("/").pop()}`;
		}
  </script>
</body>
</html>