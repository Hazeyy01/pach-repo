<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Homepage</title>
	@include('section.header')
</head>
<body>
	<!-- <div class="row g-0">
		<img style="height: 50px"  alt="">
		<a class="btn btn-primary my-2" style="border: solid 3px #1a6565; !important; display: inline-block; width: 50%" href="/parent">Parent</a>
		<a class="btn btn-primary my-2" style="border: solid 3px #1a6565; !important; display: inline-block; width: 50%" href="/officer">Admin</a>
	</div> -->
	<nav class="navbar p-0" style="background-color: #1a6565">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">
				<img src="/image/INDEX_PAGE" width="100" class="d-inline-block align-text-top">
			</a>
			<div class="d-flex" role="search">
				<a class="btn btn-primary my-2 me-2" href="/parent">Parent</a>
				<a class="btn btn-primary my-2" href="/officer">Admin</a>
    	</div>
		</div>
	</nav>
	<div class="row g-0" style="background-color: #FCF0D4">
		<div class="col-lg-9 col-12 p-5">
			<h2>Welcome to Parenting Awareness and Child Health Monitoring System !</h2>
			<br>
			<h4 style="text-align: justify;">Welcome to Parenting Awarenes and Child Healht Monitoring System, your all-in-one parenting companion! Navigate the joys and challenges of parenthood with our cutting-edge system. Empowering you with valuable parenting content and a robust child health monitoring tool, we help you stay informed about essential milestones and seamlessly track your little one's development. PACH system is here to nurture the health and well-being of your precious one. Let'sembark on this incredible journey together!</h4>
		</div>
		<div class="col-lg-3 col-12">
			<img src="/image/INDEX_WP" width="300">
		</div>
	</div>
	<div class="row p-4">
		<div class="col-lg-12 px-4 pb-4 border" id="tip_place"></div>
	</div>
	<script>
		@include('section.footer')
    function onPageLoad() {
			onGetTableData();
		}

			function onGetTableData() {
		$.ajax({
			type: 'GET',
			url: '/tips'
		}).then(function(dataList) {
			let categoryArray = [];
			if (dataList.tips) {
				for (let tip of dataList.tips) {
					if (!categoryArray.includes(tip.tip_category)) {
						categoryArray.push(tip.tip_category);
					}
				}

				for (let category of categoryArray) {
					let h4 = $('<h4>').addClass('mt-4').css('font-weight', '900').text(category);
					let hr = $('<hr>').addClass('border-2 border-top border-dark');

					$('#tip_place').append(h4).append(hr);
					let div_row = $('<div>').addClass('row g-3');

					for (let tip of dataList.tips) {
						let h5 = $('<h5>').addClass('card-title').append(tip.tip_title);
						let h6 = $('<h6>').addClass('card-title').append(tip.tip_sub_category);
						let p = $('<p>').addClass('card-text').append(tip.tip_content);
						let div_card_body = $('<div>').addClass('card-body p-3').append(h5);

						let div_card = $('<div>').addClass('card').css('cursor','pointer').click(function() { window.location.href=`/tip/page/${tip.tip_id}` });

						if (tip.tip_image_file) {
							let img = $('<img>').addClass('card-img-top').attr('src', `data:image/png;base64,${tip.tip_image_file}`);
							// img.click(function() { window.open(`/storage/images/${tip.tip_image_name}`, '_blank'); });
							div_card.append(img);
						}
						div_card.append(div_card_body);

						if (tip.tip_video_url) {
							let videoBtn = $('<a>').css('width', '100%').addClass('btn btn-primary').text('Watch Video').attr('href', `${tip.tip_video_url}`).attr('target', '_blank');
							let div_card_footer = $('<div>').addClass('card-footer p-2').append(videoBtn);
							// div_card.append(div_card_footer);
						}

						let div_col = $('<div>').addClass('col-12 col-lg-4').append(div_card);
						if (category === tip.tip_category) {
							div_row.append(div_col)
						}
					}

					$('#tip_place').append(div_row);
				}
			}
		});
	}
</script>

</body>
</html>