<div id="header">
        <div class="header-content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                    <label style="margin-left: 30px; margin-top: 5px;"><i class="fas fa-phone-volume fa-lg" style="color: blue"></i> &nbsp;0367254112</label> &nbsp;<label>&nbsp;&nbsp;&nbsp;<i class="fas fa-envelope fa-lg" style="color: #82cde3"></i>&nbsp; spalx@gmail.com.vn</label>
                    </div>
                    <div class="col-sm-8">
                        <div class="box-header">
                            <ul>
                                @if(Auth::user())
                                    <li class="check_ringt"><a href="dangxuat"><i class="fas fa-sign-out-alt fa-lg"></i>Đăng xuất</a></li>
                                    <li class="check_ringt dropdown acounts">
                                        <!-- <a href="#"><i class="fa fa-user fa-lg"></i>{{Auth::user()->name}}</a> -->
                                        <a class="nav-link dropdown-toggle tk " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-lg"></i>{{Auth::user()->name}}</a>
                                        <div class="dropdown-menu">
                                          <a class="dropdown-item" href="{{url('taikhoan/taikhoan_page ')}}"><span><i class="fas fa-question-circle fa-lg"></i>Thông tin cá nhân</span></a> <br>
                                          @if(Auth::user()->user_status == 2)
                                          <a class="dropdown-item" href="{{url('admin/admintrangchu ')}}"><span><i class="fas fa-user-cog fa-lg"></i>Admin</span></a>
                                          @endif
                                        </div>
                                    </li>
                                @else
                                    <li class="check_ringt"><a href="{{url('dangky')}}">Đăng kí</a></li>
                                    <li class="check_ringt"><a href="{{url('dangnhap')}}">Đăng nhập</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="header-body">
            <div class="container beta-relative">
                <div class="pull-left">
                    <a href="#" id="logos">
                        <img src="image/logo/MNeQ_FIy_logo_spa_new.jpg" width="230px" height="50px" >
                    </a>
                </div>
                <div class="pull-right beta-components space-left ov" style="width: 675px;">
                    <div class="space10">&nbsp;</div>
                    <div class="beta-comp" style="width: 500px">
                        <form role="search" method="get" id="searchform" action="timkiem" style="width: 500px;">
                            <input type="text" value="" class="form-control" name="sesch" id="s" placeholder="Nhập từ khóa..." style="width: 500px" />
                            <div class="searchs">
                                <button type="submit" style="background-color: #c3f5bf; width: 30px; height: 35px; margin: 0 auto; "><i class="fas fa-search fa-lg" ></i></button>
                            </div>
                           <!--  <button class="fa fa-search" type="submit" id="searchsubmit" style="width: 500px"></button> -->
                        </form>
                    </div>

                    <div class="beta-comp" style="float: right;">
                        <div class="cart">
                            <div class="beta-select"><i class="fa fa-shopping-cart"></i> 
                                @if(Cart::content())
                                    Giỏ hàng có {{count(Cart::content())}} sp
                                @else
                                    Giỏ hàng (Trống)
                                @endif
                                <i class="fa fa-chevron-down"></i></div>
                            <div class="beta-dropdown cart-body">
                                @if(Cart::content())
                                @foreach(Cart::content() as $value)
                                <div class="cart-item">
                                    <div class="media">
                                        <a class="pull-left" href="#"><img src="assets/dest/images/products/cart/1.png" alt=""></a>
                                        <div class="media-body">
                                            <span class="cart-item-title">Tên sản phẩm: {{$value->name}}</span>
                                            <span class="cart-item-options">Số lượng: {{$value->qty}}</span>
                                            <span class="cart-item-amount">Giá: <span>
                                                <?php
                                                if(Auth::user())
                                                {
                                                    $codeUser = Auth::user()->customer_code;
                                                    $finCustomer = \App\Customer::where('customer_code', $codeUser)->first();
                                                    if($finCustomer->package_id > 0)
                                                    {
                                                      echo number_format($value->price*100/70, 0 ,',','.'); echo '&nbsp;vnđ'; echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Giảm (-30%)';
                                                    }
                                                    else {
                                                      echo number_format($value->price, 0 ,',','.');echo '&nbsp;vnđ';
                                                    }
                                                }
                                                    
                                                ?>
                                            </span></span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                                

                                <div class="cart-caption">
                                    <div class="cart-total text-right">Tổng tiền: <?php echo (Cart::total()); echo ('&nbsp;vnđ')?><span class="cart-total-value"></span></div>
                                    <div class="clearfix"></div>

                                    <div class="center">
                                        <div class="space10">&nbsp;</div>
                                        <a href="{{url('gio-hang')}}" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .cart -->
                    </div>
                </div>
                <div class="clearfix"></div>
            </div> <!-- .container -->
        </div> <!-- .header-body -->
       <!--  <div class="header-bottom" style="background-color: #0277b8; height: 40px;">
            <div class="container">
                <a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
                <div class="visible-xs clearfix"></div>
                <nav class="main-menu">
                    <ul class="l-inline ov">
                        <li><a href="{{url('/')}}">Trang chủ</a></li>
                        
                        <li><a href="javascript:void(0)">Sản phẩm</a>
                            <ul class="sub-menu">
                                @foreach($data_menu_catalogy as $value)
                                <li><a href="loaisanpham/{{$value->id}}">{{$value->catalogy_name}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">Dịch vụ</a>
                            <ul class="sub-menu">
                                @foreach($data_menu_catalogyservice as $value)
                                <li><a href="product_type.html">{{$value->catalogyservice_name}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li>
                            <a href="{{url('package/goidaily')}}">Gói đại lý</a>
                        </li>
                        
                        <style type="text/css">
                            .right{
                                margin-left: 600px;
                                margin-top: -20px;
                            }
                            .tk{
                                color: #f90;
                                font-weight: bold;
                            }
                        </style>
                    </ul>
                    <div class="clearfix"></div>
                </nav>
            </div> 
        </div> .header-bottom -->
    </div>
    <style type="text/css">
        .header-body {
            padding: 0px 0 0px;
        }
        .container_header{
            height: 20px;
        }
        #header{
            background-color: #eaf7c2;
        }
        .dropdown-menu{
            border-radius: 10px;
        }
        .dropdown-menu a{
            color: blue;
            font-weight: bold;
            font-size: 13px;
        }
        .box-header ul li {
            background-color: #c6ffea;
            display: inline-table;
            height: 28px;
            width: 180px;
            line-height: 28px;
            font-size: 18px;
            border-radius: 18px;
            margin: 10px;
            margin-bottom: -4px;
        }
        .searchs{
            margin-top: -36px;
            width: 30px;
            float: right;
            height: 30px;
            border: none;
        }
    </style>