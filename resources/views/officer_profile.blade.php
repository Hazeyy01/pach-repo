<!DOCTYPE html>
<html lang="en">
<head>
	<title>Profile Page</title>
	@include('section.header')
</head>
<body>
	@include('section.sidemenu')
	<div class="content">
		@include('section.topmenu')
		<div class="border-bottom">
			<div class="page-title p-2">
				Profile
			</div>
		</div>
    <div class="row g-0">
      <div class="col-lg-4 col-12 p-2">
        <div class="card w-100">
          <div class="card-header">
            Profile Information
          </div>
          <div class="card-body p-2">
            <form id="formId" method="post" enctype="multipart/form-data" novalidate>
						  <input class="d-none" type="text" id="officer_id" name="officer_id">
              <label for="officer_name" class="form-label">Full name</label>
              <input onkeyup="setInputUppercase(event)" type="text" class="form-control form-control-sm" id="officer_name" name="officer_name" required />
              <div class="d-none invalid-feedback">
                Please provide full name.
              </div>
              <label for="officer_email" class="form-label">Email address</label>
              <input type="email" class="form-control form-control-sm" id="officer_email" name="officer_email" required />
              <div class="d-none invalid-feedback">
                Please provide email.
              </div>
              <label for="officer_password" class="form-label">Password</label>
              <input type="password" class="form-control form-control-sm" id="officer_password" name="officer_password" required />
              <div class="d-none invalid-feedback">
                Please provide password.
              </div>
              <div class="mt-2 float-end">
                <button type="button" onclick="onGetProfile()" class="btn btn-sm btn-secondary">Reset</button>
                <button type="submit" class="btn btn-sm btn-success">Update</button>
              </div>
            </form>
          </div>
        </div>
        <div class="card w-100 mt-2">
          <div class="card-header">
            Delete Profile
          </div>
          <div class="card-body p-2">
            <div class="float-end">
              <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModalId" class="btn btn-sm btn-danger">Confirm</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8 col-12"></div>
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
      onGetProfile();
		}

    function onGetProfile() {
      $.ajax({
				type: 'GET',
				url: '/officer/' + sessionStorage.getItem('user_id')
			}).then(function(data) {
				onSetForm('formId', data.officer);
			});
    }

    $('#formId').on('submit', function(event) {
      event.preventDefault();
      let formValidityStatus = checkFormValidity("formId");

      if (formValidityStatus) {
        $.ajax({
          url: '/officer',
          method: 'PUT',
          data: $('#formId').serialize(),
          success: function(res) {
            if (res) {
              onGetProfile();
							$('#popupModal').modal('show');
							$('#popupModalBody').html('Successfully Save Information');
            }
          },
          error: function(err) {
            console.log(err);
          }
        });
      }
    });

    function onDeleteData() {
			$.ajax({
				type: 'DELETE',
				url: '/officer/' + sessionStorage.getItem('user_id')
			}).then(function(data) {
				if (data.status) {
          onLogout();
				}
			});
		}
	</script>
</body>
</html>