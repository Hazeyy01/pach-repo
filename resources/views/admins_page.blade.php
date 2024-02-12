<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Page</title>
	@include('section.header')
</head>
<body>
	<div id="loader_id" class="loading d-none"></div>
	@include('section.sidemenu')
	<div class="content">
		@include('section.topmenu')
		<div class="border-bottom">
			<div class="page-title p-2">
				Admin
			</div>
		</div>
		<div class="p-2">
			<div class="card w-100">
				<div class="card-header">
					Admin List
				</div>
				<ul class="list-group list-group-flush overflow-auto">
					<li class="list-group-item p-3">
						<table id="datatable" class="table table-striped compact" style="width:100%">
							<thead>
								<tr>
									<th>Name</th>
									<th>Email</th>
									<th>Status</th>
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
				url: '/admins'
			}).then(function(dataList) {
				for (let admin of dataList.admins) {
          let select = $('<select>').addClass('form-select').change(function() { onChange(event, admin.admin_id); });
					let option_1 = $('<option>', { value: '0', text : 'NOT APPROVE' });
					select.append(option_1);
					let option_2 = $('<option>', { value: '1', text : 'APPROVE' });
					select.append(option_2);
					let option_3 = $('<option>', { value: '2', text : 'PENDING APPROVAL' }).hide();
					select.append(option_3);

          select.val(admin.admin_approval_status);

					if (admin.admin_approval_status !== 0 && admin.admin_id != sessionStorage.getItem('user_id')) {
						$('#datatable > tbody:last').append($('<tr>')
							.append($('<td>').append(admin.admin_name))
							.append($('<td>').append(admin.admin_email))
							.append($('<td>').append(select))
						);
					}
				}

				$('#datatable').dataTable(@include('section.datatable_option'));
			});
		}

    function onChange(evt, admin_id) {
			$('#loader_id').removeClass('d-none');
      let formData = new FormData();
      formData.append('officer_id', admin_id);
      formData.append('officer_approval_status', evt.target.value);

      $.ajax({
        url: '/admin/update',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(res) {
          if (res.officer) {
            onGetTableData();
            $('#loader_id').addClass('d-none');
						$('#popupModal').modal('show');
						$('#popupModalBody').html('Successfully Update Status');
          }
        },
        error: function(err) {
          console.log(err);
        }
      });
    }
	</script>
</body>
</html>