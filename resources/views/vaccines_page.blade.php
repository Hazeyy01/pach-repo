<!DOCTYPE html>
<html lang="en">
<head>
	<title>Vaccine Page</title>
	@include('section.header')
</head>
<body>
	@include('section.sidemenu')
	<div class="content">
		@include('section.topmenu')
		<div class="border-bottom">
			<div class="border-end" style="display: inline-block">
				<button class="btn btn-primary m-2" onclick="onShowModal('modalId')">
				<i class="fa fa-plus" aria-hidden="true"></i> | Add
				</button>
			</div>
			<div class="page-title px-2" style="display: inline-block">
				Vaccine
			</div>
		</div>
		<div class="p-2 border-bottom text-secondary">"Kindly click the '+' icon to input new vaccine details."</div>
		<div class="p-2">
			<div class="card w-100">
				<div class="card-header">
					Vaccine List
				</div>
				<ul class="list-group list-group-flush overflow-auto">
					<li class="list-group-item p-3">
						<table id="datatable" class="table table-striped compact" style="width:100%">
							<thead>
								<tr>
									<th>Name</th>
									<th>Age Taken</th>
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
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form id="formId" method="post" enctype="multipart/form-data" novalidate>
					<div class="modal-body">
						<input class="d-none" type="text" id="vaccine_id" name="vaccine_id">
						<div class="row pb-2">
							<div class="col-lg-6 col-12">
								<label for="vaccine_name" class="form-label">Vaccine</label>
								<input onkeyup="setInputUppercase(event)" type="text" class="form-control form-control-sm" id="vaccine_name" name="vaccine_name" required />
								<div class="d-none invalid-feedback">
										Please provide name.
								</div>
							</div>
							<div class="col-lg-6 col-12">
								<label for="vaccine_age" class="form-label">Age Taken</label>
								<input onkeyup="setInputUppercase(event)" type="text" class="form-control form-control-sm" id="vaccine_age" name="vaccine_age" required />
								<div class="d-none invalid-feedback">
										Please provide age.
								</div>
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
				$.ajax({
					url: '/vaccine',
					method: $('#vaccine_id').val() ? 'PUT' : 'POST',
					data: $('#formId').serialize(),
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
				url: '/vaccines'
			}).then(function(dataList) {
				for (let vaccine of dataList.vaccines) {
					let updateBtn = $('<btn>').addClass('btn btn-sm btn-warning m-1').click(function() { onGetFormData(vaccine.vaccine_id); }).append('Edit');
					let deleteBtn = $('<btn>').addClass('btn btn-sm btn-danger m-1').click(function() { onPromptDelete(vaccine.vaccine_id); }).append('Delete');

					$('#datatable > tbody:last').append($('<tr>')
						.append($('<td>').append(vaccine.vaccine_name))
						.append($('<td>').append(vaccine.vaccine_age))
						.append($('<td>').append(updateBtn).append(deleteBtn))
					);
				}

				$('#datatable').dataTable(@include('section.datatable_option'));
			});
		}

		function onGetFormData(updateId) {
			$.ajax({
				type: 'GET',
				url: '/vaccine/' + updateId
			}).then(function(data) {
				onShowModal('modalId');
				onSetForm('formId', data.vaccine);
			});
		}

		function onPromptDelete(deleteId) {
			$('#delete_id').val(deleteId);
			onShowModal('deleteModalId');
		}

		function onDeleteData() {
			$.ajax({
				type: 'DELETE',
				url: '/vaccine/' + $('#delete_id').val()
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
	</script>
</body>
</html>