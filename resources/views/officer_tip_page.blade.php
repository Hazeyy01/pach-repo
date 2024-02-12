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
			<div class="border-end" style="display: inline-block">
				<button class="btn btn-primary m-2" onclick="onShowModal('modalId');onSetId()">
				<i class="fa fa-plus" aria-hidden="true"></i> | Add
				</button>
			</div>
			<div class="page-title px-2" style="display: inline-block">
				Tip
			</div>
		</div>
		<div class="p-2 border-bottom text-secondary">
			"Please press the '+' icon to add information or advice."</div>
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
									<th>Image</th>
									<th>Video</th>
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
	<div class="modal fade" id="modalDisplayId" data-bs-backdrop="static" data-bs-keyboard="false">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<form id="formDisplayId" method="post" enctype="multipart/form-data" novalidate>
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
						<button type="button" onclick="onResetForm('formDisplayId'); onHideModal('modalDisplayId')" class="btn btn-sm btn-secondary">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modalId" data-bs-backdrop="static" data-bs-keyboard="false">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<form id="formId" method="post" enctype="multipart/form-data" novalidate>
					<div class="modal-body">
						<input class="d-none" type="text" id="tip_id" name="tip_id">
						<input class="d-none" type="text" id="admin_id" name="admin_id">

						<div class="row pb-2">
							<div class="col-lg-4 col-12">
								<label for="tip_title" class="form-label">Title</label>
								<input type="text" class="form-control form-control-sm" id="tip_title" name="tip_title" required />
								<div class="d-none invalid-feedback">
										Please provide title.
								</div>
							</div>
							<div class="col-lg-4 col-12">
								<label for="tip_category" class="form-label">Category</label>
								<input type="text" class="form-control form-control-sm" id="tip_category" name="tip_category" required />
								<div class="d-none invalid-feedback">
										Please provide category.
								</div>
							</div>
							<div class="col-lg-4 col-12">
								<label for="tip_sub_category" class="form-label">Sub Category</label>
								<input type="text" class="form-control form-control-sm" id="tip_sub_category" name="tip_sub_category" required />
								<div class="d-none invalid-feedback">
										Please provide sub category.
								</div>
							</div>
						</div>
						<div class="row pb-2">
							<div class="col-12">
								<label for="tip_content" class="form-label">Content</label>
								<textarea class="form-control" id="tip_content" name="tip_content" rows="5" required></textarea>
								<div class="d-none invalid-feedback">
										Please provide content.
								</div>
							</div>
						</div>
						<div class="row pb-2">
							<div class="col-lg-6 col-12">
								<label for="tip_video_url" class="form-label">Video URL</label>
								<input type="text" class="form-control form-control-sm" id="tip_video_url" name="tip_video_url" />
							</div>
							<div class="col-lg-6 col-12">
								<label for="tip_picture" class="form-label">Picture</label>
								<input type="file" class="form-control form-control-sm" id="tip_picture" name="tip_picture" />
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" onclick="onResetForm('formId'); onHideModal('modalId')" class="btn btn-sm btn-secondary">Cancel</button>
						<button type="submit" class="btn btn-sm btn-success">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="deleteModalId" data-bs-backdrop="static" data-bs-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					Are you sure you want to delete?
					<input class="d-none" type="text" id="delete_id" name="delete_id">
				</div>
				<div class="modal-footer">
					<button type="button" onclick="onHideModal('deleteModalId')" class="btn btn-sm btn-success">Cancel</button>
					<button type="button" onclick="onDeleteData()" class="btn btn-sm btn-danger">Delete</button>
				</div>
			</div>
		</div>
	</div>
	<script>
		@include('section.footer')
    function onPageLoad() {
			onGetTableData();
		}

		$('#formId').on('submit', function(event) {
			event.preventDefault();
			let formValidityStatus = checkFormValidity("formId");

			if (formValidityStatus) {
				let formData = new FormData();
				formData.append('tip_id', $('#formId #tip_id').val());
				formData.append('tip_title', $('#formId #tip_title').val());
				formData.append('tip_category', $('#formId #tip_category').val());
				formData.append('tip_sub_category', $('#formId #tip_sub_category').val());
				formData.append('tip_content', $('#formId #tip_content').val());
				formData.append('tip_video_url', $('#formId #tip_video_url').val());
				formData.append('tip_picture', $('#formId #tip_picture').prop('files')[0]);
				formData.append('admin_id', $('#formId #admin_id').val());


				$.ajax({
					url: $('#formId #tip_id').val() ? '/tip/update' : '/tip',
					type: 'POST',
					contentType: 'multipart/form-data',
					cache: false,
					contentType: false,
					processData: false,
					data: formData,
					success: function(res) {
						if (res) {
							$('#formId').trigger('reset');
							onHideModal('modalId');
							$('#popupModal').modal('show');
							$('#popupModalBody').html('Successfully Save Information');
							onGetTableData();
						}
					},
					error: function(err) {
						console.log(err);
					}
				});
			}
		});

		function onGetTableData() {
			$('#datatable').DataTable().clear().destroy();

			$.ajax({
				type: 'GET',
				url: '/tips'
			}).then(function(dataList) {
				for (let tip of dataList.tips) {
					let viewBtn = $('<btn>').addClass('btn btn-sm btn-info m-1').click(function() { onDisplayFormData(tip.tip_id); }).append('View');
					let updateBtn = $('<btn>').addClass('btn btn-sm btn-warning m-1').click(function() { onGetFormData(tip.tip_id); }).append('Edit');
					let deleteBtn = $('<btn>').addClass('btn btn-sm btn-danger m-1').click(function() { onPromptDelete(tip.tip_id); }).append('Delete');

					let videoBtn = $('<a>').attr('href', `${tip.tip_video_url}`).attr('target', '_blank').append('VIDEO');
					let imageBtn = $('<a>').attr('href', `/tip/image/${tip.tip_id}`).attr('target', '_blank').append('IMAGE');

					$('#datatable > tbody:last').append($('<tr>')
						.append($('<td>').append(tip.tip_title))
						.append($('<td>').append(tip.tip_category))
						.append($('<td>').append(tip.tip_sub_category))
						.append($('<td>').append((tip.tip_image_file) ? imageBtn : ''))
						.append($('<td>').append((tip.tip_video_url) ? videoBtn : ''))
						.append($('<td>').append(viewBtn).append(updateBtn).append(deleteBtn))
					);
				}

				$('#datatable').dataTable(@include('section.datatable_option'));
			});
		}

		function onDisplayFormData(id) {
			$('#video_id').addClass('d-none');
			$('#image_id').addClass('d-none');

			$.ajax({
				type: 'GET',
				url: '/tip/' + id
			}).then(function(data) {
				onShowModal('modalDisplayId');
				onSetForm('formDisplayId', data.tip);
				if (data.tip.tip_video_url) {
					let video_id = data.tip.tip_video_url.split('watch?v=').pop();
					$('#video_id').removeClass('d-none').attr('src', `https://www.youtube.com/embed/${video_id}`);
				}
				if (data.tip.tip_image_file) {
					// $('#image_id').removeClass('d-none').attr('src', `{{ url('storage/images/${data.tip.tip_image_name}') }}`);
					$('#image_id').removeClass('d-none').attr('src', `data:image/png;base64,${data.tip.tip_image_file}`);
				}
			});
		}

		function onGetFormData(updateId) {
			$.ajax({
				type: 'GET',
				url: '/tip/' + updateId
			}).then(function(data) {
				onShowModal('modalId');
				onSetForm('formId', data.tip);
				$('#admin_id').val(sessionStorage.getItem('user_id'))

			});
		}

		function onPromptDelete(deleteId) {
			$('#delete_id').val(deleteId);
			onShowModal('deleteModalId');
		}

		function onDeleteData() {
			$.ajax({
				type: 'DELETE',
				url: '/tip/' + $('#delete_id').val()
			}).then(function(data) {
				if (data.status) {
					onHideModal('deleteModalId');
					$('#popupModal').modal('show');
					$('#popupModalBody').html('Successfully Delete Information');
					onGetTableData();
				} else {
					onHideModal('deleteModalId');
				}
			});
		}

		function onSetId(){
			$('#admin_id').val(sessionStorage.getItem('user_id'))

		}
	</script>
</body>
</html>