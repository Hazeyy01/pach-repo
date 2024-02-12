$('#sidebar_btn').click(function() {
  let sidebarContainer = $('.sidebar-container');
  let content = $('.content');
  let sidebarBtnIcon = $('#sidebar_btn_icon');

  if ($(window).width() > 499) {
    if (sidebarContainer.hasClass('lg-sidebar-open-width')) {
			$('#sidebar_btn_icon').addClass('fa fa-bars');
      sidebarContainer.toggleClass('lg-sidebar-open-width lg-sidebar-close-width');
      content.toggleClass('lg-content-open-width lg-content-close-width');
      $('.sidebar a span').hide();
			$('.sidebar h6').hide();
			$('.sidebar .img').hide();
    } else if (sidebarContainer.hasClass('lg-sidebar-close-width')) {
			$('#sidebar_btn_icon').addClass('fa fa-times');
      sidebarContainer.toggleClass('lg-sidebar-close-width lg-sidebar-open-width');
      content.toggleClass('lg-content-close-width lg-content-open-width');
      $('.sidebar a span').show();
			$('.sidebar h6').show();
			$('.sidebar .img').show();
    }
  } else {
    if (sidebarContainer.hasClass('sm-sidebar-open-width')) {
			$('#sidebar_btn_icon').addClass('fa fa-bars');
      sidebarContainer.toggleClass('sm-sidebar-open-width sm-sidebar-close-width');
      content.toggleClass('sm-content-open-width sm-content-close-width');
      $('.sidebar a span').hide();
			$('.sidebar h6').hide();
			$('.sidebar .img').hide();
    } else if (sidebarContainer.hasClass('sm-sidebar-close-width')) {
			$('#sidebar_btn_icon').addClass('fa fa-times');
      sidebarContainer.toggleClass('sm-sidebar-close-width sm-sidebar-open-width');
      content.toggleClass('sm-content-close-width sm-content-open-width');
      $('.sidebar a span').show();
			$('.sidebar h6').show();
			$('.sidebar .img').show();
    }
  }
});