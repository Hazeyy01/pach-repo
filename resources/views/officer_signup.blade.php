<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin</title>
	@include('section.header')
  <style>
    .form-style {
      width: 100%;
      margin: auto;
      max-width: 330px;
      padding: 1rem;
    }

    .form-style .form-floating:focus-within {
      z-index: 2;
    }

    .form-style input[type="email"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }

    .form-style input[type="text"] {
      margin-bottom: -1px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }

    .form-style input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
  </style>
</head>
<body>
  <div class="row mt-5 g-0">
    <div class="col-12 col-lg-4"></div>
    <div class="col-12 col-lg-4 my-2">
    <nav>
      <div class="nav nav-tabs" id="nav-tab">
        <button class="nav-link w-50 active" id="nav-signin-tab" data-bs-toggle="tab" data-bs-target="#nav-signin" type="button" role="tab" aria-controls="nav-signin" aria-selected="true">Sign In</button>
        <button class="nav-link w-50" id="nav-signup-tab" data-bs-toggle="tab" data-bs-target="#nav-signup" type="button" role="tab" aria-controls="nav-signup" aria-selected="false">Sign Up</button>
      </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active border-start border-bottom border-end" id="nav-signin" role="tabpanel" aria-labelledby="nav-signin-tab" tabindex="0">
        <form class="form-style" id="officerLoginForm" method="post" enctype="multipart/form-data">
          <h1 class="h3 my-4 fw-normal">Admin sign in</h1>
          <div class="d-none alert" id="signin_alert_id"></div>
          <div class="form-floating">
            <input placeholder="" type="email" class="form-control" id="signinEmail" name="officer_email" required>
            <label for="signinEmail">Email address</label>
          </div>
          <div class="form-floating">
            <input placeholder="" type="password" class="form-control" id="signinPassword" name="officer_password" required>
            <label for="signinPassword">Password</label>
          </div>
          <button class="btn btn-primary w-100 my-4 py-2" type="submit">Sign in</button>
        </form>
      </div>
      <div class="tab-pane fade border-start border-bottom border-end" id="nav-signup" role="tabpanel" aria-labelledby="nav-signup-tab" tabindex="0">
        <form class="form-style" id="insertFormId" method="post" enctype="multipart/form-data">
          <h1 class="h3 my-4 fw-normal">Admin sign up</h1>
          <div class="d-none alert" id="signup_alert_id"></div>
          <div class="form-floating">
            <input placeholder="" type="email" class="form-control" id="signupEmail" name="officer_email" required>
            <label for="signupEmail">Email address</label>
          </div>
          <div class="form-floating">
            <input placeholder="" type="text" class="form-control" id="signupText" name="officer_name" required>
            <label for="signupText">Full name</label>
          </div>
          <div class="form-floating">
            <input placeholder="" type="password" class="form-control" id="signupPassword" name="officer_password" required>
            <label for="signupPassword">Password</label>
          </div>
          <button class="btn btn-primary w-100 my-4 py-2" type="submit">Sign in</button>
        </form>
      </div>
    </div>
    </div>
    <div class="col-12 col-lg-4"></div>
  </div>
  <script>
    function onPageLoad() {}

    $('#insertFormId').on('submit', function(event) {
      event.preventDefault();

      $.ajax({
        url: '/officer',
        method: 'POST',
        data: $('#insertFormId').serialize(),
        success: function(res) {
          if (res) {
            $('#insertFormId').trigger('reset');
            $('#signup_alert_id').removeClass('d-none');
            $('#signup_alert_id').addClass('alert-success');
            $('#signup_alert_id').text('');
            $('#signup_alert_id').append('Success signing up.');
          }
        },
        error: function(err) {
          $('#signup_alert_id').removeClass('d-none');
          $('#signup_alert_id').addClass('alert-danger');
          $('#signup_alert_id').text('');
          $('#signup_alert_id').append('Fail signing up.');
        }
      });
    });

    $('#officerLoginForm').on('submit', function(event) {
      event.preventDefault();

      $.ajax({
        url: '/officer/signin',
        method: 'POST',
        data: $('#officerLoginForm').serialize(),
        success:function(res) {
          if (res.response.response_status) {
            sessionStorage.setItem('user_id', res.response.user_id);
            sessionStorage.setItem('user_type', res.response.user_type);
            switch(res.response.user_type) {
              case 'ADMIN':
                window.location.href = '/officer/dashboard/vaccines/page';
              break;
              case 'SUPERADMIN':
                window.location.href = '/officer/dashboard/admins/page';
              break;
            }
          } else {
            $('#signin_alert_id').removeClass('d-none');
            $('#signin_alert_id').addClass('alert-danger');
            $('#signin_alert_id').text('');
            $('#signin_alert_id').append(res.response.response_message);
          }
        },
        error: function(err) {
          console.log(err);
        }
      });
    });
  </script>
</body>
</html>