	<!--//content-inner-->
			<!--/sidebar-menu-->
				<div class="sidebar-menu">
					<header class="logo">
					<a href="javascript:void(0)" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="javascript:void(0)"> <span id="logo"> <h1>Admin</h1></span> 
					<!--<img id="logo" src="" alt="Logo"/>--> 
				  </a> 
				</header>
			<div style="border-top:1px solid rgba(69, 74, 84, 0.7)"></div>
			<!--/down-->
							<div class="down">	
									  <a href="index.html">SPA</a>
									<ul>
									<li><a class="tooltips" href="index.html"><span>Profile</span><i class="lnr lnr-user"></i></a></li>
										<li><a class="tooltips" href="index.html"><span>Settings</span><i class="lnr lnr-cog"></i></a></li>
										<li><a class="tooltips" href="index.html"><span>Log out</span><i class="lnr lnr-power-switch"></i></a></li>
										</ul>
									</div>
							   <!--//down-->
                           <div class="menu">
									<ul id="menu" >
										<li><a href="{{url('admin/admintrangchu')}}"><i class="fas fa-home"></i> <span>Trang Chủ</span></a></li>
										 <li id="menu-academico" ><a href="javascript:void(0)"><i class="fas fa-boxes"></i> <span> Danh Mục</span> <span class="fa fa-angle-right" style="float: right"></span></a>
											   <ul id="menu-academico-sub" >
												<li id="menu-academico-avaliacoes" ><a href="{{url('admin/danhmuc/hinhthucthanhtoan')}}">Hình thức thanh toán</a></li>
												<li id="menu-academico-boletim" ><a href="{{url('admin/danhmuc/hinhthucvanchuyen')}}">Hình thức vận chuyển</a></li>
												<li id="menu-academico-avaliacoes" ><a href="{{url('admin/danhmuc/nhomsanpham')}}">Nhóm sản phẩm</a></li>
												<!-- <li id="menu-academico-avaliacoes" ><a href="{{url('admin/danhmuc/thuoctinhsanpham')}}">Thuộc tính sản phẩm</a></li> -->
												<li id="menu-academico-avaliacoes" ><a href="{{url('admin/danhmuc/sanpham')}}">Sản phẩm</a></li>
												<li id="menu-academico-avaliacoes" ><a href="{{url('admin/danhmuc/danhmucdichvu')}}">Danh mục dịch vụ</a></li>
												<li id="menu-academico-avaliacoes" ><a href="{{url('admin/danhmuc/dichvu')}}">Dịch vụ</a></li>
												<li id="menu-academico-avaliacoes" ><a href="{{url('admin/danhmuc/slider')}}">Slider</a></li>
											  </ul>
										</li>
										<li id="menu-academico" ><a href="javascript:void(0)"><i class="fas fa-cogs"></i> <span> Cài Đặt</span> <span class="fa fa-angle-right" style="float: right"></span></a>
											   <ul id="menu-academico-sub" >
												<li id="menu-academico-avaliacoes" ><a href="{{url('admin/caidat/goidaily')}}">Gói đại lý</a></li>
												<li id="menu-academico-avaliacoes" ><a href="{{url('admin/caidat/hethong')}}">Hệ thống</a></li>
												<li id="menu-academico-avaliacoes" ><a href="{{url('admin/caidat/caidathoahongdsdl')}}">Cấu hình % hoa hồng doanh số đại lý</a></li>
												<li id="menu-academico-avaliacoes" ><a href="{{url('admin/caidat/caidathoahongtongdl')}}">Cấu hình % hoa hồng tổng đại lý</a></li>
												<li id="menu-academico-avaliacoes" ><a href="{{url('admin/caidat/dichvu')}}">Thông tin Sunsahen</a></li>
											  </ul>
										</li>
										<li id="menu-academico" ><a href="javascript:void(0)"><i class="fas fa-tasks"></i> <span> Quản lý</span> <span class="fa fa-angle-right" style="float: right"></span></a>
											   <ul id="menu-academico-sub" >
											   	<li id="menu-academico-avaliacoes" ><a href="{{url('admin/quanly/nguoidung')}}">Người dùng</a></li>
												<li id="menu-academico-avaliacoes" ><a href="{{url('admin/quanly/khachhang')}}">Khách hàng</a></li>
												<li id="menu-academico-avaliacoes" ><a href="{{url('admin/quanly/goidailykhachhang')}}">Gói đại lý</a></li>
												<li id="menu-academico-avaliacoes" ><a href="{{url('admin/quanly/donhang')}}">Đơn hàng</a></li>
												
											  </ul>
										</li>

										<li id="menu-academico" ><a href="javascript:void(0)"><i class="far fa-blanket"></i> <span>Báo Cáo & Thống Kê</span> <span class="fa fa-angle-right" style="float: right"></span></a>
											   <ul id="menu-academico-sub" >
												<li id="menu-academico-avaliacoes" ><a href="{{url('admin/thongke/baocaothongke')}}">Doanh số thống kế</a></li>
											  </ul>
										</li>


										<li id="menu-academico" ><a href="javascript:void(0)"><i class="fas fa-newspaper"></i> <span> Tin tức</span> <span class="fa fa-angle-right" style="float: right"></span></a>
											   <ul id="menu-academico-sub" >
												<li id="menu-academico-avaliacoes" ><a href="{{url('admin/tintuc/quanlychude')}}">Quản lý chủ đề</a></li>
												<li id="menu-academico-avaliacoes" ><a href="{{url('admin/tintuc/quanlytin')}}">Quản lý tin</a></li>
											  </ul>
										</li>


										<li id="menu-academico" ><a href="javascript:void(0)"><i class="fa fa-table"></i> <span> Hoa hồng</span> <span class="fa fa-angle-right" style="float: right"></span></a>
											   <ul id="menu-academico-sub" >
												<!-- <li id="menu-academico-avaliacoes" ><a href="{{url('admin/hoahong/hoahonglieutrinh')}}">Hoa hồng liệu trình</a></li>
												<li id="menu-academico-avaliacoes" ><a href="{{url('admin/hoahong/hoahongtongdailylieutrinh')}}">Hoa hồng tổng đại lý liệu trình</a></li> -->
												<li id="menu-academico-avaliacoes" ><a href="{{url('admin/hoahong/hoahongdoanhsodaily')}}">Hoa hồng doanh số đại lý</a></li>
												<li id="menu-academico-avaliacoes" ><a href="{{url('admin/hoahong/hoahongtongdaily')}}">Hoa hồng tổng đại lý</a></li>
											  </ul>
										</li>
										<li id="menu-comunicacao" ><a href="{{url('admin/capnhatHoaHonh/capnhat-hoahong')}}"><i class="fas fa-user-edit"></i> <span>Cập nhật đơn hàng</span></a>
										</li>
										
										<li id="menu-comunicacao" ><a href="dangxuat"><i class="fas fa-sign-out-alt"></i> <span>Đăng Xuất</span></a>
										</li>
										<li id="menu-comunicacao" ><a href="#"><i class="fas fa-arrow-alt-circle-left"></i> <span>Trở về home</span></a>
										</li>
								  </ul>
								</div>
							  </div>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>

