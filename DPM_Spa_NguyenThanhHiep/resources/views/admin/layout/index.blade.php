     
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Spa admin</title>
<base href="{{asset('')}}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Augment Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="trangAdmin/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="trangAdmin/css/style.css" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="trangAdmin/css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'>
<!-- lined-icons -->

<link rel="stylesheet" href="trangAdmin/css/icon-font.min.css" type='text/css' />
<link rel="stylesheet" href="css/font-awesome.min.css" type='text/css' />
<link rel="stylesheet" href="css/fonts.css" type='text/css' />
<link rel="stylesheet" href="css/dataTables.bootstrap4.min.css" type='text/css' />
<link rel="stylesheet" href="css/bootstrap-datepicker.min.css" type='text/css' />

<link rel="stylesheet" href="hierarchy/css/hierarchy-view.css">
<link rel="stylesheet" href="hierarchy/css/main.css">


<!-- //lined-icons -->
<script src="trangAdmin/js/jquery-1.10.2.min.js"></script>
<!-- <script src="trangAdmin/js/amcharts.js"></script>	
<script src="trangAdmin/js/serial.js"></script>	
<script src="trangAdmin/js/light.js"></script>	
<script src="trangAdmin/js/radar.js"></script>	 -->
<!-- <link href="trangAdmin/css/barChart.css" rel='stylesheet' type='text/css' />
<link href="trangAdmin/css/fabochart.css" rel='stylesheet' type='text/css' /> -->
<!--clock init-->
<!-- <script src="trangAdmin/js/css3clock.js"></script> -->
<!--Easy Pie Chart-->
<!--skycons-icons-->
<!-- <script src="trangAdmin/js/skycons.js"></script> -->

<!-- <script src="trangAdmin/js/jquery.easydropdown.js"></script> -->

</head> 
<body>
   <div class="page-container">
   <!--/content-inner-->
		<div class="left-content">
		   <div class="inner-content">
			<!-- header-starts -->
				@include('admin.layout.menu_top')

				<div class="outter-wp">
					@yield('content')
				</div>
				@include('admin.layout.menu_left')
			</div>
		</div>
	</div>



<!--js -->


<!-- 
<link rel="stylesheet" href="trangAdmin/css/vroom.css">
<script type="text/javascript" src="trangAdmin/js/vroom.js"></script> -->
<!-- <script type="text/javascript" src="trangAdmin/js/TweenLite.min.js"></script>
<script type="text/javascript" src="trangAdmin/js/CSSPlugin.min.js"></script> -->

@yield('script')
<!-- <script src="trangAdmin/js/jquery.nicescroll.js"></script> -->
<!-- <script src="trangAdmin/js/scripts.js"></script>
<script type="text/javascript" src="trangAdmin/js/myscrip.js"></script> -->

 <script src="trangAdmin/js/bootstrap.min.js"></script>
 <script type="text/javascript">
    $("div.alert").delay(1500).slideUp();
</script>

<!-- <script src="js/jquery-3.3.1.slim.min.js" type="text/javascript"></script> -->
<!-- <script src="js/popper.min.js" type="text/javascript"></script> -->
<!-- <script src="js/bootstrap.min.js" type="text/javascript"></script> -->
<script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="js/dataTables.bootstrap4.min.js" type="text/javascript"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$("#DataList").DataTable({
				"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tất cả"]],
				"iDisplayLength": 25,
				"oLanguage": {
					"sLengthMenu": "Hiện _MENU_ dòng",
					"oPaginate": {
						"sFirst": "<i class='fa fa-step-backward' aria-hidden='true'></i>",
						"sLast": "<i class='fa fa-step-forward' aria-hidden='true'></i>",
						"sNext": "<i class='fa fa-chevron-right' aria-hidden='true'></i>",
						"sPrevious": "<i class='fa fa-chevron-left' aria-hidden='true'></i>"
					},
					"sEmptyTable": "Không có dữ liệu",
					"sSearch": "Tìm kiếm:",
					"sZeroRecords": "Không có dữ liệu",
					"sInfo": "Hiện từ _START_ đến _END_ của _TOTAL_ dòng",
					"sInfoEmpty" : "Không tìm thấy",
					"sInfoFiltered": " (tổng số _MAX_ dòng)"
				}
			});
			
			$("#DataList").wrap('<div class="table-responsive"></div>');
			$("#DataList_wrapper").removeClass("container-fluid");
		});
	</script>
<script type="text/javascript">
    function xacnhanxoa(msg) {
        if(window.confirm(msg))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
</script>




<!-- <script type="text/javascript">
	$(document).ready(function() {
	$("#DataList").DataTable({
		"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tất cả"]],
		"iDisplayLength": 25,
		"oLanguage": {
			"sLengthMenu": "Hiện _MENU_ dòng",
			"oPaginate": {
				"sFirst": "<i class='fal fa-step-backward'></i>",
				"sLast": "<i class='fal fa-step-forward'></i>",
				"sNext": "<i class='fal fa-chevron-right'></i>",
				"sPrevious": "<i class='fal fa-chevron-left'></i>"
			},
			"sEmptyTable": "Không có dữ liệu",
			"sSearch": "Tìm kiếm:",
			"sZeroRecords": "Không có dữ liệu",
			"sInfo": "Hiện từ _START_ đến _END_ của _TOTAL_ dòng",
			"sInfoEmpty" : "Không tìm thấy",
			"sInfoFiltered": " (tổng số _MAX_ dòng)"
		}
	});
	
	$("#DataList").wrap('<div class="table-responsive"></div>');
	$("#DataList_wrapper").removeClass("container-fluid");
});
</script> -->
<!-- <script type="text/javascript" src="js/ckfinder/ckfinder.js"></script>
<script type="text/javascript">
	function BrowseServer()
	    {
	        var finder = new CKFinder();
	        finder.basePath = '../';
	        finder.selectActionFunction = function(fileUrl) {
	            document.getElementById('hinhlogo').value = fileUrl.substring(fileUrl.lastIndexOf('/') + 1);
	        };
	        finder.popup();
	    }
</script> -->
<!-- CKeditor-->
<script src="js/ckeditor/ckeditor.js"></script>
<script>
	CKEDITOR.replace( 'editor1',
	{
		filebrowserBrowseUrl : 'js/ckfinder/ckfinder.html',
			filebrowserImageBrowseUrl : 'js/ckfinder/ckfinder.html?type=Images',
			filebrowserFlashBrowseUrl : 'js/ckfinder/ckfinder.html?type=Flash',
			filebrowserUploadUrl : 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
			filebrowserImageUploadUrl : 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
			filebrowserFlashUploadUrl : 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
	});
</script>
<!-- <script>
    $(".datetime").datetimepicker();
</script> -->
<script type="text/javascript">
        function xacnhanxoa(msg) {
            if(window.confirm(msg))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    </script>

	
</body>
</html>