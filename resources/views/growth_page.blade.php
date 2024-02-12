<!DOCTYPE html>
<html lang="en">
<head>
	<title>Growth Page</title>
	@include('section.header')
</head>
<body>
	@include('section.sidemenu')
	<div class="content">
		@include('section.topmenu')
		<div class="border-bottom">
			<div class="border-end" style="display: inline-block">
				<button class="btn btn-primary m-2" onclick="onSetChildren()">
				<i class="fa fa-plus" aria-hidden="true"></i> | Add
				</button>
			</div>
			<div class="page-title px-2" style="display: inline-block">
				Growth
			</div>
		</div>
		<div class="p-2 border-bottom text-secondary">"Kindly press the 'plus' icon to update information regarding your child's growth."</div>
		<div class="w-100 p-2">
			<div class="card">
				<div class="card-header">
					Growth List
				</div>
				<ul class="list-group list-group-flush overflow-auto">
					<li class="list-group-item p-2">
						<table id="secondDatatable" class="table table-striped compact" style="width:100%">
							<thead>
								<tr>
									<th>Weight</th>
									<th>Height</th>
									<th>Head Circumference</th>
									<th>BMI</th>
									<th>Date Taken</th>
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
		<div class="row g-0">
			<div class="col-lg-6 col-12 ps-2 pe-2">
				<div class="card w-100">
					<div class="card-header">
						Children Height Chart
					</div>
					<ul class="list-group list-group-flush overflow-auto">
						<l id="height_chart_parent_id" class="list-group-item p-4">
							<div id="height_chart_id"></div>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-6 col-12 pe-2">
				<div class="card w-100">
					<div class="card-header">
						Children Weight Chart
					</div>
					<ul class="list-group list-group-flush overflow-auto">
						<l id="weight_chart_parent_id" class="list-group-item p-4">
							<div id="weight_chart_id"></div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="p-2">
			<div class="card w-100 mb-2">
				<div class="card-header">
					Children BMI Chart
				</div>
				<ul class="list-group list-group-flush overflow-auto">
					<l id="bmi_chart_parent_id" class="list-group-item p-4">
						<div id="bmi_chart_id"></div>
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
						<input class="d-none" type="text" id="growth_id" name="growth_id">
						<input class="d-none" type="number" id="growth_bmi" name="growth_bmi">
						<input class="d-none" type="text" id="growth_age_taken" name="growth_age_taken">
						<input class="d-none" type="text" id="children_id" name="children_id">
						<input class="d-none" type="text" id="children_birthdate" name="children_birthdate">
						<div class="row pb-2">
							<div class="col-lg-6 col-12">
								<label for="growth_weight" class="form-label">Weight</label>
								<div class="input-group input-group-sm">
									<input type="number" step=".01" id="growth_weight" name="growth_weight" class="form-control" required>
									<span class="input-group-text" id="basic-addon2">kg</span>
								</div>
								<div class="text-danger small mt-1 input-alert d-none" role="alert">
									Please provide weight.
								</div>
							</div>
							<div class="col-lg-6 col-12">
								<label for="growth_height" class="form-label">Height</label>
								<div class="input-group input-group-sm">
									<input type="number" step=".01" id="growth_height" name="growth_height" class="form-control" required>
									<span class="input-group-text" id="basic-addon2">cm</span>
								</div>
								<div class="text-danger small mt-1 input-alert d-none" role="alert">
									Please provide height.
								</div>
							</div>
						</div>
						<div class="row pb-2">
							<div class="col-lg-6 col-12">
								<label for="growth_head_circumference" class="form-label">Head Circumference</label>
								<div class="input-group input-group-sm">
									<input type="number" step=".01" id="growth_head_circumference" name="growth_head_circumference" class="form-control" required>
									<span class="input-group-text" id="basic-addon2">cm</span>
								</div>
								<div class="text-danger small mt-1 input-alert d-none" role="alert">
									Please provide head circumference.
								</div>
							</div>
							<div class="col-lg-6 col-12">
								<label for="growth_date_taken" class="form-label">Date taken</label>
								<input type="date" class="form-control form-control-sm" id="growth_date_taken" name="growth_date_taken" required />
								<div class="d-none invalid-feedback">
									Please provide date.
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
			onGetChildGrowths();
    }

		function onSetChildren() {
			$.ajax({
				type: 'GET',
				url: '/children/' + window.location.pathname.split("/").pop()
			}).then(function(data) {
				onShowModal('modalId');
      	$('#children_id').val(data.children.children_id);
      	$('#children_birthdate').val(data.children.children_birthdate);
			});
		}

    function onGetChildGrowths() {
      $('#secondDatatable').DataTable().clear().destroy();

			$.ajax({
				type: 'GET',
				url: '/child_growths/' + window.location.pathname.split("/").pop()
			}).then(function(dataList) {
				let sortedGrowths = dataList.childGrowths.sort(dynamicSort("growth_age_taken"));
				onDrawHeightChart(sortedGrowths);
				onDrawWeightChart(sortedGrowths);
				onDrawBMIChart(sortedGrowths);

        if (sortedGrowths.length) {
          for (let childGrowth of sortedGrowths) {
            let updateBtn = $('<btn>').addClass('btn btn-sm btn-warning m-1').click(function() { onGetChildGrowth(childGrowth.growth_id); }).append('Edit');
            let deleteBtn = $('<btn>').addClass('btn btn-sm btn-danger m-1').click(function() { onPromptDelete('child_growth', childGrowth.growth_id); }).append('Delete');

            $('#secondDatatable > tbody:last').append($('<tr>')
              .append($('<td>').append(childGrowth.growth_weight + ' kg'))
              .append($('<td>').append(childGrowth.growth_height + ' cm'))
              .append($('<td>').append(childGrowth.growth_head_circumference + ' cm'))
              .append($('<td>').append(childGrowth.growth_bmi))
              .append($('<td>').append(onFormatDate(childGrowth.growth_date_taken)))
              .append($('<td>').append(childGrowth.growth_age_taken))
              .append($('<td>').append(updateBtn).append(deleteBtn))
            );
          }
        }

				$('#secondDatatable').dataTable(@include('section.datatable_option'));
			});
    }

    function onGetChildGrowth(id) {
			$.ajax({
				type: 'GET',
				url: '/child_growth/' + id
			}).then(function(data) {
				onSetForm('formId', data.childGrowth);
				onSetChildren();
			});
    }

    $('#formId').on('submit', function(event) {
			event.preventDefault();
			let formValidityStatus = checkFormValidity("formId");

			if (formValidityStatus) {
				$('#growth_bmi').val(onCalculateBMI($('#growth_weight').val(), $('#growth_height').val()));
				$('#growth_age_taken').val(onGetAge($('#growth_date_taken').val(), $('#children_birthdate').val()));

				$.ajax({
					url: '/child_growth',
					method: $('#growth_id').val() ? 'PUT' : 'POST',
					data: $('#formId').serialize(),
					success: function(res) {
						if (res) {
							$('#formId').trigger('reset');
							onHideModal('modalId');
							$('#popupModal').modal('show');
							$('#popupModalBody').html('Successfully Save Information');
							onGetChildGrowths();
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
					onGetChildGrowths();
				} else {
					onHideModal('deleteModalId');
				}
			});
		}

		function onDrawHeightChart(growths) {
			google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

			let growthArrays = [];
			for (let growth of growths) {
				let growthArray = [growth.growth_age_taken, +growth.growth_height];
				growthArrays.push(growthArray);
			}

      function drawChart () {
				$("height_chart_parent_id").empty();

        let data = new google.visualization.DataTable();
        data.addColumn('string', 'Age');
        data.addColumn('number', 'Height (cm)');

        data.addRows(growthArrays);

				let chartwidth = $('#height_chart_parent_id').width() - 10;

        let options = {
					width: chartwidth,
          height: 260,
          hAxis: {title: 'Age'},
          vAxis: {title: 'Height (cm)'},
					legend: {position: 'none'}
        };

        let chart = new google.charts.Line(document.getElementById('height_chart_id'));

        chart.draw(data, google.charts.Line.convertOptions(options));
      }
		}

		function onDrawWeightChart(growths) {
			google.charts.load('current', {'packages':['line']});
			google.charts.setOnLoadCallback(drawChart);

			let growthArrays = [];
			for (let growth of growths) {
				let growthArray = [growth.growth_age_taken, +growth.growth_weight];
				growthArrays.push(growthArray);
			}

			function drawChart () {
				$("weight_chart_parent_id").empty();

				let data = new google.visualization.DataTable();
				data.addColumn('string', 'Age');
				data.addColumn('number', 'Weight (kg)');

				data.addRows(growthArrays);

				let chartwidth = $('#weight_chart_parent_id').width() - 10;

				let options = {
					width: chartwidth,
					height: 260,
					hAxis: {title: 'Age'},
					vAxis: {title: 'Weight (kg)'},
					legend: {position: 'none'}
				};

				let chart = new google.charts.Line(document.getElementById('weight_chart_id'));

				chart.draw(data, google.charts.Line.convertOptions(options));
			}
		}

		function onDrawBMIChart(growths) {
			google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

			let growthArrays = [];
			let labelArray = ['Age', 'BMI (kg/m2)'];
			growthArrays.push(labelArray);
			for (let growth of growths) {
				let growthArray = [growth.growth_age_taken, +growth.growth_bmi];
				growthArrays.push(growthArray);
			}

      function drawStuff() {
        let data = new google.visualization.arrayToDataTable(growthArrays);

				let chartwidth = $('#bmi_chart_parent_id').width();
        let options = {
					width: chartwidth,
          height: 260,
          legend: { position: 'none' },
					axes: {
            x: {
              0: { side: 'bottom', label: 'Age'}
            },
            y: {
              0: { side: 'left', label: 'BMI (kg/m2)'}
            }
          },
          bar: { groupWidth: "90%" }
        };

        let chart = new google.charts.Bar(document.getElementById('bmi_chart_id'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      };
		}
  </script>
</body>
</html>