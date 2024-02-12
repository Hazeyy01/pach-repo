<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge"><meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<!-- google font link -->
<!-- reference: https://fonts.google.com/ -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500;1,600;1,900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Gravitas+One&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<style>
	/* custom bootstrap */
	:root {
		.btn-primary {
			background-color: #49d0d0;
			border-color: #49d0d0;
			color: #000;
		}
		.btn-primary:active {
			background-color: #49d0d0;
			border-color: #49d0d0;
			color: #000;
		}
		.btn-warning {
			background-color: #85e0e0;
			border-color: #85e0e0;
			color: #000;
		}
		.btn-warning:active {
			background-color: #85e0e0;
			border-color: #85e0e0;
			color: #000;
		}
	}
	html * {
		font-family: 'Poppins', sans-serif;
	}
	body {
		margin: 0 !important;
	}
	.lg-sidebar-open-width {
		width: 250px;
	}
	.lg-sidebar-close-width {
		width: 50px;
	}
	.lg-content-open-width {
		margin-left: 250px;
	}
	.lg-content-close-width {
		margin-left: 50px;
	}
	.sm-sidebar-open-width {
		width: 100%;
	}
	.sm-sidebar-close-width {
		width: 50px;
	}
	.sm-content-open-width {
		margin-left: 0px;
	}
	.sm-content-close-width {
		margin-left: 50px;
	}
	.sidebar-container {
		height: 100%;
		position: fixed;
		background: #20002c;
		background: -webkit-linear-gradient(to top, #cbb4d4, #20002c);
		background: linear-gradient(to top, #cbb4d4, #20002c);
	}
	.sidebar {
		position: absolute;
		width: 100%;
		height: 100%;
		background-color: rgba(0, 0, 0, 0.2);
	}
	.sidebar div {
		display: block;
		margin-bottom: 10px;
	}
	.sidebar div button {
		font-size: 0.8em;
		text-decoration: none;
		color: #ffffff;
		background-color: rgba(255, 255, 255, 0.1);
		padding: 10px;
		margin-left: 6px;
		margin-top: 6px;
		border-radius: 5px;
		border: none;
	}
	.sidebar a {
		font-size: 0.8em;
		text-decoration: none;
		color: #ffffff;
		background-color: rgba(255, 255, 255, 0.1);
		margin: 6px;
		padding: 10px;
		border-radius: 5px;
	}
	.sidebar a:not(.sidebar :nth-child(1)) {
		display: block;
	}
	.sidebar a.active {
		background-color: rgba(0, 0, 0, 0.4);
	}
	.sidebar-container {
		height: 100%;
		position: fixed;
		background: #49d0d0; /* Change to your desired shade of blue */
		z-index: 1000;
	}
	table {
		border-top: solid 1px #ced4da;
		border-left: solid 1px #ced4da;
		border-right: solid 1px #ced4da;
		font-size: 0.8em;
	}
	tr {
		vertical-align: middle;
	}
	table#table {
		border-collapse: collapse;
		width: 100%;
		font-size: 0.8em;
	}
	table#table th {
		padding: 10px;
		border: solid 1px #ced4da;
	}
	table#table td {
		padding: 10px;
		border: solid 1px #ced4da;
	}
	textarea {
		resize: none
	}
	.form-label {
		font-size: 0.8em !important;
		color: grey !important;
		margin-bottom: 0px !important;
	}
	input[type="search"]::-webkit-search-decoration,
	input[type="search"]::-webkit-search-cancel-button,
	input[type="search"]::-webkit-search-results-button,
	input[type="search"]::-webkit-search-results-decoration {
		-webkit-appearance:none;
	}
	.page-title {
		font-size: 1.5em !important;
		font-weight: 900;
		vertical-align: middle;
	}
	/* https://codepen.io/devilooper/pen/gOPYMjr */
	.loading {
		position: fixed;
		z-index: 999;
		height: 2em;
		width: 2em;
		overflow: show;
		margin: auto;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
	}
	.loading:before {
		content: '';
		display: block;
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));
		background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
	}
	.loading:not(:required) {
		font: 0/0 a;
		color: transparent;
		text-shadow: none;
		background-color: transparent;
		border: 0;
	}
	.loading:not(:required):after {
		content: '';
		display: block;
		font-size: 10px;
		width: 1em;
		height: 1em;
		margin-top: -0.5em;
		-webkit-animation: spinner 150ms infinite linear;
		-moz-animation: spinner 150ms infinite linear;
		-ms-animation: spinner 150ms infinite linear;
		-o-animation: spinner 150ms infinite linear;
		animation: spinner 150ms infinite linear;
		border-radius: 0.5em;
		-webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
		box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
	}
	@-webkit-keyframes spinner {
		0% {
			-webkit-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-ms-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}
		100% {
			-webkit-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-ms-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
	}
	@-moz-keyframes spinner {
		0% {
			-webkit-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-ms-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}
		100% {
			-webkit-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-ms-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
	}
	@-o-keyframes spinner {
		0% {
			-webkit-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-ms-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}
		100% {
			-webkit-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-ms-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
	}
	@keyframes spinner {
		0% {
			-webkit-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-ms-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}
		100% {
			-webkit-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-ms-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
	}
</style>
<script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(function() {
		onPageLoad();

		if ($(window).width() > 499) {
			$('.sidebar-container').addClass('lg-sidebar-open-width');
			$('.content').addClass('lg-content-open-width');
			$('#sidebar_btn_icon').addClass('fa fa-times');
		} else {
			$('.sidebar-container').addClass('sm-sidebar-close-width');
			$('.content').addClass('sm-content-close-width');
			$('.sidebar a span').hide();
			$('.sidebar h6').hide();
			$('.sidebar .img').hide();
			$('#sidebar_btn_icon').addClass('fa fa-bars');
		}

		let currentUrl = window.location.href;
		let currentPath = currentUrl.replace('http://127.0.0.1:8000', '');

		$('.sidebar a').each(function() {
			if ($(this).attr('href') === currentPath) {
				$(this).addClass("active");
			}
		});

		switch(sessionStorage.getItem('user_type')) {
			case 'PARENT':
				$('h6.parent-menu').removeClass('d-none');
				$('a.parent-menu').each(function () {
					$(this).removeClass('d-none');
				});
			break;
			case 'ADMIN':
				$('h6.admin-menu').removeClass('d-none');
				$('a.admin-menu').each(function () {
					$(this).removeClass('d-none');
				});
			break;
			case 'SUPERADMIN':
				$('h6.superadmin-menu').removeClass('d-none');
				$('a.superadmin-menu').each(function () {
					$(this).removeClass('d-none');
				});
			break;
		}
	});

	function onLogout() {
		// switch(sessionStorage.getItem('user_type')) {
		// 	case 'PARENT':
		// 		window.location.href = '/parent';
		// 		break;
		// 	case 'OFFICER':
		// 		window.location.href = '/officer';
		// 		break;
		// }
		window.location.href = '/';
		sessionStorage.clear();
	}

	function onCalculateAge(birthDateString) {
		let birthDate = new Date(birthDateString);
		let birthDateYear = birthDate.getFullYear();
		let birthDateMonth = birthDate.getMonth();

		let currentDate = new Date();
		let currentDateYear = currentDate.getFullYear();
		let currentDateMonth = currentDate.getMonth();

		let ageYear = currentDateYear - birthDateYear;
		let monthYear = currentDateMonth - birthDateMonth;
		let ageMonth = (ageYear * 12) + monthYear;

		return `${ageMonth} Month`;
	}

	function onGetAge(currentDateString, birthDateString) {
		let birthDate = new Date(birthDateString);
		let birthDateYear = birthDate.getFullYear();
		let birthDateMonth = birthDate.getMonth();

		let currentDate = new Date(currentDateString);
		let currentDateYear = currentDate.getFullYear();
		let currentDateMonth = currentDate.getMonth();

		let ageYear = currentDateYear - birthDateYear;
		let monthYear = currentDateMonth - birthDateMonth;
		let ageMonth = (ageYear * 12) + monthYear;

		return `${ageMonth} Month`;
	}

	function dynamicSort(property) {
    let sortOrder = 1;
    if(property[0] === "-") {
			sortOrder = -1;
			property = property.substr(1);
    }

    return function (a,b) {
			let result = (a[property] < b[property]) ? -1 : (a[property] > b[property]) ? 1 : 0;
			return result * sortOrder;
    }
	}

	function onCalculateBMI(weight, height) {
		let weightKG = weight;
		let heightM = height / 100;
		let BMI = 0;

		if (weightKG && heightM) {
			BMI = weightKG / (heightM * heightM);
		}

		return BMI;
	}

	function checkFormValidity(formId) {
		let formValidityStatus = true;

		$("form#" + formId + " :input").each(function(){
			if ($(this).is("input") || $(this).is("textarea") || $(this).is("select")) {
				if ($(this).prop('required') && !$(this).val()) {
					formValidityStatus = false;
					$(this).addClass('is-invalid');
					if ($(this).next().hasClass('invalid-feedback')) {
						$(this).next().removeClass('d-none');
					} else {
						$(this).parent().next().removeClass('d-none');
					}
				} else if ($(this).prop('required') && $(this).val()) {
					$(this).removeClass('is-invalid');
					if ($(this).next().hasClass('invalid-feedback')) {
						$(this).next().addClass('d-none');
					} else {
						$(this).parent().next().addClass('d-none');
					}
				}
			}
		});

		return formValidityStatus;
	}

	function onSetForm(formId, formObject) {
		$("form#" + formId + " :input").each(function(){
			if ($(this).is("input")) {
				if ($(this).attr('type') !== 'file') {
					if ($(this).attr('type') === 'date') {
						if (formObject[$(this).attr("name")]) {
							let jsDateTime = new Date(formObject[$(this).attr("name")]);
							let jsDateTimeOffset = new Date(jsDateTime.setMinutes(jsDateTime.getMinutes() - jsDateTime.getTimezoneOffset()));
							let birthDate = jsDateTimeOffset.toISOString().split('T')[0];
							$(this).val(birthDate);
						}
					} else {
						$(this).val(formObject[$(this).attr("name")]);
					}
				}
			} else if ($(this).is("textarea") || $(this).is("select")) {
				$(this).val(formObject[$(this).attr("name")]);
			}
		});
	}

	function setInputUppercase(event) {
		event.target.value = event.target.value.toUpperCase();
	}

	function onResetForm(formId) {
		$("form#" + formId + " :input").each(function(){
			if ($(this).is("input") || $(this).is("textarea") || $(this).is("select")) {
				$(this).val('');
				if ($(this).prop('required')) {
					$(this).removeClass('is-invalid');
					if ($(this).next().hasClass('invalid-feedback')) {
						$(this).next().addClass('d-none');
					} else {
						$(this).parent().next().addClass('d-none');
					}
				}
			}
		});
	}

	function onFormatDate(dateString) {
		let date = new Date(dateString);
		return `${String(date.getDate()).padStart(2, '0')}-${String(date.getMonth() + 1).padStart(2, '0')}-${date.getFullYear()}`;
	}

	function onShowModal(modalId) {
		$(`#${modalId}`).modal('show');
	}

	function onHideModal(modalId) {
		$(`#${modalId}`).modal('hide');
	}
</script>