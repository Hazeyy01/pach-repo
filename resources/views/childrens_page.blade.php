<!DOCTYPE html>
<html lang="en">
<head>
	<title>Children Page</title>
	@include('section.header')
</head>
<body>
	@include('section.sidemenu')
	<div class="content">
		@include('section.topmenu')
		<div class="border-bottom">
			<div class="border-end" style="display: inline-block">
				<button class="btn btn-primary m-2" onclick="onShowModal('modalId'); onSetParentId()">
				<i class="fa fa-plus" aria-hidden="true"></i> | Add
				</button>
			</div>
			<div class="page-title px-2" style="display: inline-block">
				Children
			</div>
		</div>
		<div class="p-2 border-bottom text-secondary">You can Click "+" above to add your children profile</div>
		<div class="p-2">
			<div class="card w-100">
				<div class="card-header">
					Children List
				</div>
				<ul class="list-group list-group-flush overflow-auto">
					<li class="list-group-item p-3">
						<div class="row g-3" id="card_content"></div>
						<!--
						<table id="datatable" class="table table-striped compact">
							<thead>
								<tr>
									<th>Full name</th>
									<th>Gender</th>
									<th>Age</th>
									<th>Birth Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
						-->
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
						<input class="d-none" type="text" id="children_id" name="children_id">
						<input class="d-none" type="text" id="parent_id" name="parent_id">
						<div class="row pb-2">
							<div class="col-lg-6 col-12">
								<label for="children_name" class="form-label">Full name</label>
								<input onkeyup="setInputUppercase(event)" type="text" class="form-control form-control-sm" id="children_name" name="children_name" required />
								<div class="d-none invalid-feedback">
										Please provide full name.
								</div>
							</div>
							<div class="col-lg-6 col-12">
								<label for="children_birthdate" class="form-label">Birth date</label>
								<input type="date" class="form-control form-control-sm" id="children_birthdate" name="children_birthdate" required />
								<div class="d-none invalid-feedback">
										Please provide birth date.
								</div>
							</div>
						</div>
						<div class="row pb-2">
							<div class="col-lg-6 col-12">
								<label for="children_gender" class="form-label">Gender</label>
								<select class="form-select" id="children_gender" name="children_gender" required>
    							<option selected disabled hidden value="">PLEASE CHOOSE</option>
									<option value="MALE">MALE</option>
									<option value="FEMALE">FEMALE</option>
								</select>
								<div class="d-none invalid-feedback">
										Please provide gender.
								</div>
							</div>
							<div class="col-lg-6 col-12"></div>
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

		function onSetParentId() {
			$('#parent_id').val(sessionStorage.getItem('user_id'));
		}

		$('#formId').on('submit', function(event) {
			event.preventDefault();
			let formValidityStatus = checkFormValidity("formId");

			if (formValidityStatus) {
				$.ajax({
					url: '/children',
					method: $('#children_id').val() ? 'PUT' : 'POST',
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
			// $('#datatable').DataTable().clear().destroy();

			$.ajax({
				type: 'GET',
				url: '/childrens/' + sessionStorage.getItem('user_id')
			}).then(function(dataList) {
				$('#card_content').empty();

				for (let children of dataList.childrens) {
					let li_1_1 = $('<li>').css("font-size", "0.9em").append(children.children_gender);
					let li_1_2 = $('<li>').css("font-size", "0.9em").append(onCalculateAge(children.children_birthdate));
					let li_1_3 = $('<li>').css("font-size", "0.9em").append(onFormatDate(children.children_birthdate));
					let ul = $('<ul>').append(li_1_1).append(li_1_2).append(li_1_3);
					let h5 = $('<h5>').addClass('card-title').append(children.children_name);
					let div_card_body = $('<div>').addClass('card-body').append(h5).append(ul);

					let a_2_1 = $('<a>').attr('href', `/parent/dashboard/immunizations/page/${children.children_id}`).css('text-decoration', 'none').text('Vaccine');
					let li_2_1 = $('<li>').addClass('list-group-item').append(a_2_1);
					let a_2_2 = $('<a>').attr('href', `/parent/dashboard/growths/page/${children.children_id}`).css('text-decoration', 'none').text('Growth');
					let li_2_2 = $('<li>').addClass('list-group-item').append(a_2_2);
					let a_2_3 = $('<a>').attr('href', `/parent/dashboard/developments/page/${children.children_id}`).css('text-decoration', 'none').text('Milestone');
					let li_2_3 = $('<li>').addClass('list-group-item').append(a_2_3);

					let btn_1 = $('<button>').css('display', 'inline-block').css('width', '50%').addClass('btn border border-white border-2 btn-warning').text('Update').click(function() { onGetFormData(children.children_id); });
					let btn_2 = $('<button>').css('display', 'inline-block').css('width', '50%').addClass('btn border border-white border-2 btn-danger').text('Delete').click(function() { onPromptDelete(children.children_id); });
					let li_2_4 = $('<li>').css('font-size', '0').addClass('list-group-item p-1').append(btn_1).append(btn_2);

					let ul_1 = $('<ul>').addClass('list-group list-group-flush').append(li_2_1).append(li_2_2).append(li_2_3).append(li_2_4);

					let div_card = $('<div>').addClass('card').append(div_card_body).append(ul_1);
					let div_col = $('<div>').addClass('col-12 col-lg-4').append(div_card);

					$('#card_content').append(div_col);
				}

				// for (let children of dataList.childrens) {
				// 	let updateBtn = $('<btn>').addClass('btn btn-sm btn-warning m-1').click(function() { onGetFormData(children.children_id); }).append('Edit');
				// 	let deleteBtn = $('<btn>').addClass('btn btn-sm btn-danger m-1').click(function() { onPromptDelete(children.children_id); }).append('Delete');

				// 	let immunizationBtn = $('<btn>').addClass('btn btn-sm btn-info m-1').click(function() { onRedirectData(``) }).append('Info');
				// 	let growthBtn = $('<btn>').addClass('btn btn-sm btn-info m-1').click(function() { onRedirectData(``) }).append('Info');
				// 	let developmentBtn = $('<btn>').addClass('btn btn-sm btn-info m-1').click(function() { onRedirectData(``) }).append('Info');

				// 	$('#datatable > tbody:last').append($('<tr>')
				// 		.append($('<td>').append(children.children_name))
				// 		.append($('<td>').append(children.children_gender))
				// 		.append($('<td>').append(onCalculateAge(children.children_birthdate)))
				// 		.append($('<td>').append(children.children_birthdate))
				// 		.append($('<td>').append(immunizationBtn).append(growthBtn).append(developmentBtn).append(deleteBtn).append(updateBtn))
				// 	);
				// }

				$('#datatable').dataTable(@include('section.datatable_option'));
			});
		}

		function onGetFormData(updateId) {
			$.ajax({
				type: 'GET',
				url: '/children/' + updateId
			}).then(function(data) {
				onShowModal('modalId');
				onSetForm('formId', data.children);
			});
		}

		function onPromptDelete(deleteId) {
			$('#delete_id').val(deleteId);
			onShowModal('deleteModalId');
		}

		function onDeleteData() {
			$.ajax({
				type: 'DELETE',
				url: '/children/' + $('#delete_id').val()
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

		function onRedirectData(link) {
			window.location.href = link;
		}
	</script>
</body>
</html>