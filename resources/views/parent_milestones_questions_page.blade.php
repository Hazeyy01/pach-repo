<!DOCTYPE html>
<html lang="en">
<head>
	<title>Question Page</title>
	@include('section.header')
</head>
<body>
	<div id="loader_id" class="loading d-none"></div>
	@include('section.sidemenu')
	<div class="content">
		@include('section.topmenu')
		<div class="border-bottom">
			<div class="page-title p-2">
				Development Question
			</div>
		</div>
		<div class="p-2 border-bottom text-secondary">"Please choose 'YES' or 'NO' to answer to the following questions."</div>
		<div class="p-2">
			<div class="card w-100">
				<div class="card-header">
					Question List
				</div>
				<ul class="list-group list-group-flush overflow-auto">
					<li class="list-group-item p-2">
						<table id="datatable" class="table table-striped compact" style="width:100%">
							<thead>
								<tr>
									<th>Text</th>
									<th></th>
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
			onGetTableData();
		}

		function onGetTableData() {
			$('#datatable').DataTable().clear().destroy();

			$.ajax({
				type: 'GET',
				url: `/milestones/questions/${window.location.pathname.split("/").at(-2)}/${window.location.pathname.split("/").at(-1)}`
			}).then(function(dataList) {
				for (let questionstatus of dataList.questionstatuslist) {
					let select = $('<select>').addClass('form-select').change(function() { onChange(event, questionstatus); });
					let option_0 = $('<option>', { value: '', text : '' }).hide();
					select.append(option_0);
					let option_1 = $('<option>', { value: 'YA', text : 'YES' });
					select.append(option_1);
					let option_2 = $('<option>', { value: 'TIDAK', text : 'NO' });
					select.append(option_2);

					if (questionstatus.childdevelopment) {
						select.val(questionstatus.childdevelopment.development_answer_value);
					}

					$('#datatable > tbody:last').append($('<tr>')
						.append($('<td>').append(questionstatus.question.question_text))
						.append($('<td>').append(select))
					);
				}

				$('#datatable').dataTable(@include('section.datatable_option'));
			});
		}

		function onChange(evt, questionstatus) {
			$('#loader_id').removeClass('d-none');
			if (questionstatus.childdevelopment) {
				// update
				let formData = new FormData();
				formData.append('development_id', questionstatus.childdevelopment.development_id);
				formData.append('development_answer_value', evt.target.value);

				$.ajax({
					url: '/child_development/update',
					method: 'POST',
					data: formData,
					processData: false,
					contentType: false,
					success: function(res) {
						if (res.childdevelopment) {
							onGetTableData();
							$('#loader_id').addClass('d-none');
							$('#popupModal').modal('show');
							$('#popupModalBody').html('Successfully Save Information');
						}
					},
					error: function(err) {
						console.log(err);
					}
				});
			} else {
				// insert
				let formData = new FormData();
				formData.append('development_answer_value', evt.target.value);
				formData.append('children_id', window.location.pathname.split("/").at(-1));
				formData.append('milestone_id', window.location.pathname.split("/").at(-2));
				formData.append('question_id', questionstatus.question.question_id);

				$.ajax({
					url: '/child_development',
					method: 'POST',
					data: formData,
					processData: false,
					contentType: false,
					success: function(res) {
						if (res.childdevelopment) {
							onGetTableData();
							$('#loader_id').addClass('d-none');
							$('#popupModal').modal('show');
							$('#popupModalBody').html('Successfully Save Information');
						}
					},
					error: function(err) {
						console.log(err);
					}
				});
			}
		}
	</script>
</body>
</html>