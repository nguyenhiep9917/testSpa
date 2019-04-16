<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống Spa </title>
    <base href="{{asset('')}}">
    <link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" title="style" href="css/home.css">
    <link rel="stylesheet" title="style" href="css/css_trangchu.css">
    <link href="trangAdmin/css/font-awesome.css" rel="stylesheet"> 
   <!--  <link rel="stylesheet" title="style" href="css/css_home.css"> -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="source/assets/dest/css/font-awesome.min.css">
    <link rel="stylesheet" href="source/assets/dest/vendors/colorbox/example3/colorbox.css">
    <link rel="stylesheet" href="source/assets/dest/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="source/assets/dest/rs-plugin/css/responsive.css">
    <link rel="stylesheet" title="style" href="source/assets/dest/css/style.css">
    <link rel="stylesheet" href="source/assets/dest/css/animate.css">
    <link rel="stylesheet" title="style" href="source/assets/dest/css/huong-style.css">
    <!-- <link rel="stylesheet" title="style" href="css/login.css"> -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="stylesheet" href="css/font-awesome.min.css" type='text/css' />

    <link rel="stylesheet" href="hierarchy/css/hierarchy-view.css">
    <link rel="stylesheet" href="hierarchy/css/main.css">
    
<link rel="stylesheet" href="css/fonts.css" type='text/css' />
</head>
<body>
    @include('header')
    <!-- .container -->
    @yield('content')
     <!-- #footer -->
    @include('footer')
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
        $(function () {
            $('#form').submit(function(event){
                var verified = grecaptcha.getResponse();
                if(verified.length === 0)
                {
                    event.preventDefault();
                }
            });
        });
    </script>
    @yield('script')
    <script type="text/javascript">
    $(function (){
        $('[data-toggle="popover"]').popover({'html':true});
    });
</script>
    <!-- include js files -->
    <script src="source/assets/dest/js/jquery.js"></script>
    <script src="source/assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="source/assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
    <script src="source/assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
    <script src="source/assets/dest/vendors/animo/Animo.js"></script>
    <script src="source/assets/dest/vendors/dug/dug.js"></script>
    <script src="source/assets/dest/js/scripts.min.js"></script>
    <script src="source/assets/dest/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script src="source/assets/dest/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script src="source/assets/dest/js/waypoints.min.js"></script>
    <script src="source/assets/dest/js/wow.min.js"></script>
    <!--customjs-->

    <script src="source/assets/dest/js/custom2.js"></script>
    <script>
    $(document).ready(function($) {    
        $(window).scroll(function(){
            if($(this).scrollTop()>150){
            $(".header-bottom").addClass('fixNav')
            }else{
                $(".header-bottom").removeClass('fixNav')
            }}
        )
    })
    </script>
    <!-- <script>
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script> -->
</body>
</html>
