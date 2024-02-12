<!DOCTYPE html>
<html lang="en">
<head>
	<title>Tip Page</title>
	@include('section.header')
</head>
<body>
	@include('section.sidemenu')
	<div class="content">
		@include('section.topmenu')
		<div class="border-bottom">
			<div class="page-title p-2">
				Tip
			</div>
		</div>
		<div class="p-2">
			<div class="card w-100">
				<div class="card-header">
					Tip List
				</div>
				<ul class="list-group list-group-flush overflow-auto">
					<li class="list-group-item p-3">
						<table id="datatable" class="table table-striped compact" style="width:100%">
							<thead>
								<tr>
									<th>Title</th>
									<th>Category</th>
									<th>Sub Category</th>
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
	<div class="modal fade" id="modalId" data-bs-backdrop="static" data-bs-keyboard="false">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<form id="formId" method="post" enctype="multipart/form-data" novalidate>
					<div class="modal-body">
						<input class="d-none" type="text" id="tip_id" name="tip_id">
						<div class="row pb-2">
							<div class="col-lg-4 col-12">
								<label for="tip_title" class="form-label">Title</label>
								<input type="text" class="form-control form-control-sm" id="tip_title" name="tip_title" disabled />
							</div>
							<div class="col-lg-4 col-12">
								<label for="tip_category" class="form-label">Category</label>
								<input type="text" class="form-control form-control-sm" id="tip_category" name="tip_category" disabled />
							</div>
							<div class="col-lg-4 col-12">
								<label for="tip_sub_category" class="form-label">Sub Category</label>
								<input type="text" class="form-control form-control-sm" id="tip_sub_category" name="tip_sub_category" disabled />
							</div>
						</div>
						<div class="row pb-2">
							<div class="col-12">
								<label for="tip_content" class="form-label">Content</label>
								<textarea class="form-control" id="tip_content" name="tip_content" rows="5" disabled></textarea>
							</div>
						</div>
						<hr class="border-2 border-top border-dark"/>
						<iframe id="video_id" class="d-none" style="width: 100%; height: auto; aspect-ratio: 16 / 9;"></iframe>
						<img id="image_id" class="d-none" style="width: 100%; height: auto;" alt="tip image" title="tip_image" />
					</div>
					<div class="modal-footer">
						<button type="button" onclick="onResetForm('formId'); onHideModal('modalId')" class="btn btn-sm btn-secondary">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script>
		@include('section.footer')
    function onPageLoad() {
			onGetTableData();
		}

		function onGetTableData() {
			$('#datatable').DataTable().clear().destroy();

			$.ajax({
				type: 'GET',
				url: '/tips'
			}).then(function(dataList) {
				for (let tip of dataList.tips) {
					let viewBtn = $('<btn>').addClass('btn btn-sm btn-info m-1').click(function() { onGetFormData(tip.tip_id); }).append('View');

					$('#datatable > tbody:last').append($('<tr>')
						.append($('<td>').append(tip.tip_title))
						.append($('<td>').append(tip.tip_category))
						.append($('<td>').append(tip.tip_sub_category))
						.append($('<td>').append(viewBtn))
					);
				}

				$('#datatable').dataTable(@include('section.datatable_option'));
			});
		}

		function onGetFormData(updateId) {
			$('#video_id').addClass('d-none');
			$('#image_id').addClass('d-none');

			$.ajax({
				type: 'GET',
				url: '/tip/' + updateId
			}).then(function(data) {
				onShowModal('modalId');
				onSetForm('formId', data.tip);
				if (data.tip.tip_video_url) {
					let video_id = data.tip.tip_video_url.split('watch?v=').pop();
					$('#video_id').removeClass('d-none').attr('src', `https://www.youtube.com/embed/${video_id}`);
				}
				if (data.tip.tip_image_name) {
					$('#image_id').removeClass('d-none').attr('src', `{{ url('storage/images/${data.tip.tip_image_name}') }}`);
				}
			});
		}
	</script>
</body>
</html>