<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	@include('section.header')
</head>
<body>
  <div class="row">
    <div class="col-lg-6 col-12 p-5">
      <img id="image_id" class="d-none rounded-3" style="width: 100%; height: auto;" alt="tip image" title="tip_image" />
    </div>
    <div class="col-lg-6 col-12 align-self-center">
      <h2 class="mt-3" style="font-family: 'Gravitas One', serif;" id="title_id"></h2>
      <h4 id="category_id"></h4>
      <h6 id="sub_category_id"></h6>
    </div>
    <!-- <div class="col-3"></div>
    <div class="col-6">
      <div class="w-100 p-4">
        <div class="border border-black">
          <b><h1 class="border-bottom border-black p-2 mb-0" style="text-align: center" id="title_id"></h1></b>
          <img id="image_id" class="d-none" style="width: 100%; height: auto;" alt="tip image" title="tip_image" />
          <div class="border-black px-4 pt-4">
            <h3 id="category_id"></h3>
            <h5 id="sub_category_id"></h5>
          </div>
          <div class="p-4" id="content_id"></div>
          <iframe id="video_id" class="d-none" style="width: 100%; height: auto; aspect-ratio: 16 / 9;"></iframe>
        </div>


        <h4 id="category_id"></h4>
        <h6 id="sub_category_id"></h6>
      </div>
    </div>
    <div class="col-3"></div> -->
  </div>
  <div class="px-5">
    <div id="content_id"></div>
  </div>
  <div class="p-5">
    <iframe id="video_id" class="d-none" style="width: 100%; height: auto; aspect-ratio: 16 / 9;"></iframe>
  </div>
  <script>
    function onPageLoad() {
      $.ajax({
        type: 'GET',
        url: '/tip/' + window.location.pathname.split("/").pop()
      }).then(function(data) {
        $('#title_id').text(data.tip.tip_title);
        $('#category_id').text(data.tip.tip_category);
        $('#sub_category_id').text(data.tip.tip_sub_category);
        $('#content_id').text(data.tip.tip_content);
        if (data.tip.tip_video_url) {
          let video_id = data.tip.tip_video_url.split('watch?v=').pop();
          $('#video_id').removeClass('d-none').attr('src', `https://www.youtube.com/embed/${video_id}`);
        }
        if (data.tip.tip_image_file) {
          $('#image_id').removeClass('d-none').attr('src', `data:image/png;base64,${data.tip.tip_image_file}`);
        }
      });
    }
  </script>
</body>
</html>