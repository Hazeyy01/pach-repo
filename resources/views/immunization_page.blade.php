<!DOCTYPE html>
<html lang="en">
<head>
	<title>Immunization Page</title>
	@include('section.header')
</head>
<body>
	<div id="loader_id" class="loading d-none"></div>
	@include('section.sidemenu')
	<div class="content">
		@include('section.topmenu')
		<div class="border-bottom">
			<div class="page-title p-2">
				Immunization
			</div>
		</div>
		<div class="p-2">
			<div class="card w-100 mb-2">
				<div class="card-header">
					Mandatory Vaccine List
				</div>
				<ul class="list-group list-group-flush overflow-auto">
					<li class="list-group-item p-2 text-secondary">Vaksin mandatori : Sila tandakan kotak di bawah untuk mengemaskini senarai vaksin yang telah diambil oleh anak anda.</li>
					<li class="list-group-item p-2">
						<table id="table"></table>
					</li>
				</ul>
			</div>
			<div class="card w-100">
				<div class="card-header">
					Other Vaccine List
				</div>
				<ul class="list-group list-group-flush overflow-auto">
					<li class="list-group-item p-0">
						<div class="border-end p-1" style="display: inline-block">
							<button class="btn btn-primary" onclick="onShowModal('firstModalId'); onSetChildrenId(0)">
								<i class="fa fa-plus" aria-hidden="true"></i> | Add
							</button>
						</div>
						<div style="display: inline-block" class="text-secondary">Lain-lain vaksin: Sila tekan icon tambah "+" untuk kemaskini maklumat pengambilan vaksin yang tidak tersenarai di jadual diatas.</div>
					</li>
					<li class="list-group-item p-2">
						<table id="datatable" class="table table-striped compact" style="width:100%">
							<thead>
								<tr>
									<th>Vaccine</th>
									<th>Date Taken</th>
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
  <div class="modal fade" id="firstModalId" data-bs-backdrop="static" data-bs-keyboard="false">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form id="firstFormId" method="post" enctype="multipart/form-data" novalidate>
					<div class="modal-body">
						<input class="d-none" type="text" id="child_immunization_id" name="child_immunization_id">
						<input class="d-none" type="text" id="children_id" name="children_id">
						<input class="d-none" type="text" id="child_immunization_type" name="child_immunization_type" value="OTHER">
						<div class="row pb-2">
							<div class="col-lg-6 col-12">
								<label for="vaccine_name" class="form-label">Vaccine</label>
								<input onkeyup="setInputUppercase(event)" type="text" class="form-control form-control-sm" id="vaccine_name" name="vaccine_name" required />
								<div class="d-none invalid-feedback">
										Please provide vaccine.
								</div>
							</div>
							<div class="col-lg-6 col-12">
								<label for="child_immunization_date" class="form-label">Date taken</label>
								<input type="date" class="form-control form-control-sm" id="child_immunization_date" name="child_immunization_date" required />
								<div class="d-none invalid-feedback">
										Please provide date.
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" onclick="onResetForm('firstFormId'); onHideModal('firstModalId')" class="btn btn-sm btn-secondary">Cancel</button>
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
					<input class="d-none" type="text" id="url_id" name="url_id">
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
      onGetVaccines();
      onGetChildImmunizations();
    }

    function onSetChildrenId(index) {
      $('#children_id').val(window.location.pathname.split("/").pop())[index];
    }

    function onGetVaccines() {
			$('#table').empty();

      $.ajax({
				type: 'GET',
				url: '/child_immunization_vaccine/' + window.location.pathname.split("/").pop()
			}).then(function(dataList) {
				let sortedChildrenVaccines = dataList.childrenVaccines.sort((a, b) => parseInt(a.vaccine.vaccine_id) - parseInt(b.vaccine.vaccine_id));
				let ageArray = [];
				for (let childrenVaccine of sortedChildrenVaccines) {
					if (!ageArray.includes(childrenVaccine.vaccine.vaccine_age)) {
						ageArray.push(childrenVaccine.vaccine.vaccine_age);
					}
        }

				let tr = $('<tr>');
				tr.append($('<th>').text('Vaccine'));
				for (let age of ageArray) {
					tr.append($('<th>').text(age));
				}
				$('#table').append(tr);

				for (let childrenVaccine of sortedChildrenVaccines) {
					let tr = $('<tr>');
					tr.append($('<td>').text(childrenVaccine.vaccine.vaccine_name));
					for (let age of ageArray) {
						if (age === childrenVaccine.vaccine.vaccine_age) {
							let checkbox = $('<input>', { type: 'checkbox'}).addClass('form-check-input').css('transform', 'scale(1.5)').change(function() { onCheck(event, childrenVaccine.vaccine.vaccine_id, childrenVaccine.immunization ? childrenVaccine.immunization.child_immunization_id : ''); });

							if (childrenVaccine.immunization) {
								checkbox.prop('checked', true);
							} else {
								checkbox.prop('checked', false);
							}

							tr.append($('<td>').css('text-align', 'center').append(checkbox));
						} else {
							tr.append($('<td>').text(''));
						}
					}
					$('#table').append(tr);
				}
      });
    }

    function onGetChildImmunizations() {
      $('#datatable').DataTable().clear().destroy();

			$.ajax({
				type: 'GET',
				url: '/child_immunizations/' + window.location.pathname.split("/").pop()
			}).then(function(dataList) {
        if (dataList.childrenVaccines.length) {
          for (let childrenVaccine of dataList.childrenVaccines) {
            let updateBtn = $('<btn>').addClass('btn btn-sm btn-warning m-1').click(function() { onGetChildImmunization(childrenVaccine.immunization.child_immunization_id); }).append('Edit');
            let deleteBtn = $('<btn>').addClass('btn btn-sm btn-danger m-1').click(function() { onPromptDelete('child_immunization', childrenVaccine.immunization.child_immunization_id); }).append('Delete');

						if (childrenVaccine.immunization.child_immunization_type === 'OTHER') {
							$('#datatable > tbody:last').append($('<tr>')
								.append($('<td>').append(childrenVaccine.immunization.vaccine_name))
								.append($('<td>').append(onFormatDate(childrenVaccine.immunization.child_immunization_date)))
								.append($('<td>').append(updateBtn).append(deleteBtn))
							);
						}
          }
        }

				$('#datatable').dataTable(@include('section.datatable_option'));
			});
    }

    function onGetChildImmunization(id) {
			$.ajax({
				type: 'GET',
				url: '/child_immunization/' + id
			}).then(function(data) {
				onShowModal('firstModalId');
				onSetForm('firstFormId', data.childImmunization);
			});
    }

    $('#firstFormId').on('submit', function(event) {
			event.preventDefault();
			let formValidityStatus = checkFormValidity("firstFormId");

			let formData = new FormData();
			if ($('#child_immunization_id').val()) {
				formData.append('child_immunization_id', $('#child_immunization_id').val());
			}
			formData.append('child_immunization_date', $('#child_immunization_date').val());
			formData.append('child_immunization_type', $('#child_immunization_type').val());
			formData.append('vaccine_name', $('#vaccine_name').val());
			formData.append('children_id', $('#children_id').val());

			if (formValidityStatus) {
				$.ajax({
					url: $('#child_immunization_id').val() ? '/child_immunization/update' : '/child_immunization',
					method: 'POST',
					contentType: 'multipart/form-data',
					cache: false,
					contentType: false,
					processData: false,
					data: formData,
					success: function(res) {
						if (res) {
							$('#firstFormId').trigger('reset');
							onHideModal('firstModalId');
							$('#popupModal').modal('show');
							$('#popupModalBody').html('Successfully Save Other Vaccine Information');
							onGetChildImmunizations();
						}
					},
					error: function(err) {
						console.log(err);
					}
				});
			}
		});

		function onPromptDelete(deleteURL, deleteId) {
			$('#url_id').val(deleteURL);
			$('#delete_id').val(deleteId);
			onShowModal('deleteModalId');
		}

		function onDeleteData() {
			$.ajax({
				type: 'DELETE',
				url: `/${$('#url_id').val()}/${$('#delete_id').val()}`
			}).then(function(data) {
				if (data.status) {
					onHideModal('deleteModalId');
					$('#popupModal').modal('show');
					$('#popupModalBody').html('Successfully Delete Information');
					onGetChildImmunizations();
				} else {
					onHideModal('deleteModalId');
				}
			});
		}

		function onCheck(evt, vaccineId, childImmunizationId) {
			$('#loader_id').removeClass('d-none');
			if (evt.target.checked) {
				// insert
				onInsertChildImmunization(vaccineId);
			} else {
				// delete
				onDeleteChildImmunization(childImmunizationId);
			}
		}

		function onInsertChildImmunization(vaccineId) {
			let currentDate = new Date();
			let formData = new FormData();
			formData.append('child_immunization_date', `${currentDate.getFullYear()}-${+currentDate.getMonth() + 1}-${currentDate.getDate()}`);
			formData.append('child_immunization_type', 'MANDATORY');
			formData.append('vaccine_id', vaccineId);
			formData.append('children_id', window.location.pathname.split("/").pop());

			$.ajax({
				url: $('#child_immunization_id').val() ? '/child_immunization/update' : '/child_immunization',
				method: 'POST',
				contentType: 'multipart/form-data',
				cache: false,
				contentType: false,
				processData: false,
				data: formData,
				success: function(res) {
					if (res) {
						onGetVaccines();
						$('#loader_id').addClass('d-none');
						$('#popupModal').modal('show');
						$('#popupModalBody').html('Successfully Save Vaccination Information');
					}
				},
				error: function(err) {
					console.log(err);
				}
			});
		}

		function onDeleteChildImmunization(childImmunizationId) {
			$.ajax({
				type: 'DELETE',
				url: `/child_immunization/${childImmunizationId}`
			}).then(function(data) {
				if (data.status) {
					onGetVaccines();
					$('#loader_id').addClass('d-none');
					$('#popupModal').modal('show');
					$('#popupModalBody').html('Successfully Remove Vaccination Information');
				}
			});
		}
  </script>
</body>
</html>