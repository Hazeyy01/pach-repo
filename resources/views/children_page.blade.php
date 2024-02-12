<!DOCTYPE html>
<html lang="en">
<head>
	<title>Child Page</title>
	@include('section.header')
</head>
<body>
	<h1>Childrens</h1>
	@include('section.sidemenu')
	<button onclick="onShowModal('firstModalId'); onSetChildrenId(0)">Add Immunization</button>
  <table id="firstDatatable" class="table table-striped compact" style="width:100%">
		<thead>
			<tr>
				<th>Vaccine</th>
				<th>Batch</th>
				<th>Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
	<button onclick="onShowModal('secondModalId'); onSetChildrenId(1)">Add Growth</button>
  <table id="secondDatatable" class="table table-striped compact" style="width:100%">
		<thead>
			<tr>
				<th>Weight</th>
				<th>Height</th>
				<th>Head</th>
				<th>BMI</th>
				<th>Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
  <table id="thirdDatatable" class="table table-striped compact" style="width:100%">
		<thead>
			<tr>
				<th>Name</th>
				<th>Category</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
  <div class="modal fade" id="firstModalId" data-bs-backdrop="static" data-bs-keyboard="false">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form id="firstFormId" method="post" enctype="multipart/form-data" novalidate>
					<div class="modal-body">
						<input class="d-none" type="text" id="child_immunization_id" name="child_immunization_id">
						<input style="display: none" type="text" class="children_id" id="children_id" name="children_id">
						<input type="date" id="child_immunization_date" name="child_immunization_date">
						<input type="text" id="child_immunization_batch" name="child_immunization_batch">
						<select id="vaccine_id" name="vaccine_id"></select>
					</div>
					<div class="modal-footer">
						<button type="button" onclick="onResetForm('firstFormId'); onHideModal('firstModalId')" class="btn btn-sm btn-secondary">Cancel</button>
						<button type="submit" class="btn btn-sm btn-success">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
  <div class="modal fade" id="secondModalId" data-bs-backdrop="static" data-bs-keyboard="false">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form id="secondFormId" method="post" enctype="multipart/form-data" novalidate>
					<div class="modal-body">
						<input class="d-none" type="text" id="growth_id" name="growth_id">
						<input style="display: none" type="text" class="children_id d-none" id="children_id" name="children_id">
						<input type="number" step=".01" id="growth_weight" name="growth_weight">
						<input type="number" step=".01" id="growth_height" name="growth_height">
						<input type="number" step=".01" id="growth_head_circumference" name="growth_head_circumference">
						<input class="d-none" type="number" step=".01" id="growth_bmi" name="growth_bmi">
						<input type="date" id="growth_date_taken" name="growth_date_taken">
					</div>
					<div class="modal-footer">
						<button type="button" onclick="onResetForm('secondFormId'); onHideModal('secondModalId')" class="btn btn-sm btn-secondary">Cancel</button>
						<button type="submit" class="btn btn-sm btn-success">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="deleteModalId" data-bs-backdrop="static" data-bs-keyboard="false">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-body">
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
			onGetChildGrowths();
			onGetMilestones();
    }

    function onSetChildrenId(index) {
      $('.children_id').val(window.location.pathname.split("/").pop())[index];
    }

    function onGetVaccines() {
      $.ajax({
				type: 'GET',
				url: '/vaccines'
			}).then(function(dataList) {
        $('#vaccine_id').append($('<option>').val('').html('SILA PILIH'));
        for(let vaccine of dataList.vaccines) {
          $('#vaccine_id').append($('<option>').val(vaccine.vaccine_id).html(vaccine.vaccine_name));
        }
      });
    }

    function onGetChildImmunizations() {
      $('#firstDatatable').DataTable().clear().destroy();

			$.ajax({
				type: 'GET',
				url: '/child_immunizations/' + window.location.pathname.split("/").pop()
			}).then(function(dataList) {
        if (dataList.childrenVaccines.length) {
          for (let childrenVaccine of dataList.childrenVaccines) {
            let updateBtn = $('<btn>').addClass('btn btn-sm btn-warning m-1').click(function() { onGetChildImmunization(childrenVaccine.immunization.child_immunization_id); }).append('Edit');
            let deleteBtn = $('<btn>').addClass('btn btn-sm btn-danger m-1').click(function() { onPromptDelete('child_immunization', childrenVaccine.immunization.child_immunization_id); }).append('Delete');

            $('#firstDatatable > tbody:last').append($('<tr>')
              .append($('<td>').append(childrenVaccine.vaccine.vaccine_name))
              .append($('<td>').append(childrenVaccine.immunization.child_immunization_batch))
              .append($('<td>').append(childrenVaccine.immunization.child_immunization_date))
              .append($('<td>').append(updateBtn).append(deleteBtn))
            );
          }
        }

				$('#firstDatatable').dataTable(@include('section.datatable_option'));
			});
    }

    function onGetChildGrowths() {
      $('#secondDatatable').DataTable().clear().destroy();

			$.ajax({
				type: 'GET',
				url: '/child_growths/' + window.location.pathname.split("/").pop()
			}).then(function(dataList) {
        if (dataList.childGrowths.length) {
          for (let childGrowth of dataList.childGrowths) {
            let updateBtn = $('<btn>').addClass('btn btn-sm btn-warning m-1').click(function() { onGetChildGrowth(childGrowth.growth_id); }).append('Edit');
            let deleteBtn = $('<btn>').addClass('btn btn-sm btn-danger m-1').click(function() { onPromptDelete('child_growth', childGrowth.growth_id); }).append('Delete');

            $('#secondDatatable > tbody:last').append($('<tr>')
              .append($('<td>').append(childGrowth.growth_weight))
              .append($('<td>').append(childGrowth.growth_height))
              .append($('<td>').append(childGrowth.growth_head_circumference))
              .append($('<td>').append(childGrowth.growth_bmi))
              .append($('<td>').append(childGrowth.growth_date_taken))
              .append($('<td>').append(updateBtn).append(deleteBtn))
            );
          }
        }

				$('#secondDatatable').dataTable(@include('section.datatable_option'));
			});
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

    function onGetChildImmunization(id) {
			$.ajax({
				type: 'GET',
				url: '/child_immunization/' + id
			}).then(function(data) {
				onShowModal('firstModalId');
				onSetForm('firstFormId', data.childImmunization);
			});
    }

    function onGetChildGrowth(id) {
			$.ajax({
				type: 'GET',
				url: '/child_growth/' + id
			}).then(function(data) {
				onShowModal('secondModalId');
				onSetForm('secondFormId', data.childGrowth);
			});
    }

    $('#firstFormId').on('submit', function(event) {
			event.preventDefault();

			$.ajax({
				url: '/child_immunization',
				method: $('#child_immunization_id').val() ? 'PUT' : 'POST',
				data: $('#firstFormId').serialize(),
				success: function(res) {
					if (res) {
						$('#firstFormId').trigger('reset');
						onHideModal('firstModalId');
						onGetChildImmunizations();
					}
				},
				error: function(err) {
					console.log(err);
				}
			});
		});

    $('#secondFormId').on('submit', function(event) {
			event.preventDefault();
			$('#growth_bmi').val(onCalculateBMI($('#growth_weight').val(), $('#growth_height').val()));

			$.ajax({
				url: '/child_growth',
				method: $('#growth_id').val() ? 'PUT' : 'POST',
				data: $('#secondFormId').serialize(),
				success: function(res) {
					if (res) {
						$('#secondFormId').trigger('reset');
						onHideModal('secondModalId');
						onGetChildGrowths();
					}
				},
				error: function(err) {
					console.log(err);
				}
			});
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
					onGetChildImmunizations();
					onGetChildGrowths();
				} else {
					onHideModal('deleteModalId');
				}
			});
		}
  </script>
</body>
</html>