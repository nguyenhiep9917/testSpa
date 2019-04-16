<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
 // function () {
 //    return view('home'

// Route::get('/','HomeController');
// });
// phần Frontend
Route::get('/', 'HomeController@getdata_TrangChu');
Route::get('loaisanpham/{id}', 'HomeController@getloaisp');
// trang tin tức
Route::get('tin-tuc', 'HomeController@gettintuc');
// trang slash sale
Route::get('slash-sale', 'HomeController@getslashsale');
// bản dồ
Route::get('smap', 'HomeController@getsmap');

// xem them nhieu san pham home page
Route::get('xem-them-producr', 'HomeController@getxemthemProduct');
// xem cá danh muc sản phẩm
Route::get('xem-them-catalogy', 'HomeController@getxemthemCatalogy');
// xem các dai lý
Route::get('xem-them-packge', 'HomeController@getxemthemPackage');
// xem them dich  vụ
Route::get('xem-them-dichvu', 'HomeController@getxemthemdichvu');
// tìm kiếm sản phẩm
Route::get('timkiem', 'HomeController@gettimkiem');
// xem chi tiết sản phẩm
Route::get('xemc-chi-tiet-san-pham/{id}', 'HomeController@getxemchitietsanpham');





//login/admin
Route::get('dangnhap','UserController@getdangnhap');
Route::post('dangnhap','UserController@postdangnhap');
Route::get('dangxuat', 'UserController@getdangxuat');
// register
Route::get('dangky','UserController@getdangky');
Route::post('dangky','UserController@postdangky');
Route::get('xacnhan/{comfirm}', 'UserController@getxacnhan');
// show các gói đại lý
//lấy link giới thiệu
Route::get('thanh-vien/{taikhoan}', 'TaiKhoanController@getlink');
//
// cập nhật thông tin khi lần đầu vào trang cá nhan đối với thành viên dl thường trở len
Route::get('cap-nhat-thong-tin', 'TaiKhoanController@getconfrimthongtinupdata');
// mua hàng
Route::get('mua-hang/{id}/{tensanpham}/{gia}',['as'=>'muahang', 'uses'=>'HomeController@muahang']);
Route::get('gio-hang', ['as'=>'giohang', 'uses'=>'HomeController@giohang']);
Route::get('xoa-san-pham/{id}', ['as'=>'xoasanpham', 'uses'=>'HomeController@getxoasanpham']);
Route::get('cap-nhat/{id}/{qty}', ['as'=>'capnhat', 'uses'=>'HomeController@getcapnhat']);
Route::get('dathang/{id}', 'HomeController@getdathang');
Route::post('dathang/{id}', 'HomeController@postdathang');
Route::group(['prefix'=>'ajax_loadaddress_dathang'], function(){
		Route::get('huyen/{idTinh}', 'HomeController@getHuyen');
		Route::get('xa/{idHuyen}', 'HomeController@getXa');
	});
//khách hàng
Route::group(['prefix'=>'taikhoan', 'middleware'=>'TaiKhoanLogin'], function(){
	Route::get('vi_ca_nhan/{id}', 'TaiKhoanController@getvicanhan');
	Route::get('doimatkhau/{id}', 'TaiKhoanController@doimatkhau');
	Route::post('doimatkhau/{id}', 'TaiKhoanController@postdoimatkhau');
	
	Route::get('taikhoan_page', 'TaiKhoanController@gettaikhoan');
	Route::get('updatathongtin-taikhoan', 'TaiKhoanController@getUpdataTaiKhoan');
	Route::post('updatathongtin-taikhoan/{id}', 'TaiKhoanController@postUpdataTaiKhoan');

	Route::get('danhsachdiachi-taikhoan', 'TaiKhoanController@getdsDiaChi');
	Route::get('donhang-taikhoan/{id}', 'TaiKhoanController@getDonHang');
	Route::get('cayhethong-taikhoan', 'TaiKhoanController@getCayHeThong');
	// doanh số hoa hồng page thông tin tài khoản
	Route::get('doanhsocanhan-taikhoan', 'TaiKhoanController@getDoanhSoTaiKhoan');
	Route::get('hoahonglieutrinh-taikhoan', 'TaiKhoanController@getHoaHongLieuTrinh');
	
	// xác nhận package
	Route::get('xacnhan_package_normal/{id}', 'TaiKhoanController@getxacnhan_package_normal');
	Route::post('xacnhan_package_normal/{id}', 'TaiKhoanController@postxacnhan_package_normal');
	//
	Route::get('xacnhan_package_vip/{id}', 'TaiKhoanController@getxacnhan_package_vip');
	Route::post('xacnhan_package_vip/{id}', 'TaiKhoanController@postxacnhan_package_vip');

	// cập nhật thông tin khách hàng và chờ xác nhận admin
	Route::get('xacnhanthongtin_package', 'TaiKhoanController@getThongTinXacNhan');
	Route::post('xacnhanthongtin_package', 'TaiKhoanController@postThongTinXacNhan');
	//
	Route::group(['prefix'=>'ajax_loadaddress'], function(){
		Route::get('huyen/{idTinh}', 'TaiKhoanController@getHuyen');
		Route::get('xa/{idHuyen}', 'TaiKhoanController@getXa');
	});

	// xem chi tiết các order thanh toán  từ ví dl 
	Route::get('ordervidailys/{id}', 'TaiKhoanController@getxemchitetorderdaily');

});
Route::group(['prefix'=>'package'], function(){
	Route::get('goidaily', 'GoiDaiLyController@getgoidaily');
	Route::get('mua-package/{id}/{goipackage}', 'GoiDaiLyController@muagoipackage');
	Route::get('gio-hang-Package', ['as'=>'giohangPackage', 'uses'=>'GoiDaiLyController@giohangGoiPackage']);
	Route::get('xoa-package/{rowId}', ['as'=>'xoaPackage', 'uses'=>'GoiDaiLyController@Xoapackage']);
	Route::get('dathangPackage/{id}', 'GoiDaiLyController@getdathangPackage');
	Route::post('dathangPackage/{id}', 'GoiDaiLyController@postdathangPackage');
});

//admin
Route::group(['prefix'=>'admin', 'middleware'=>'AdminLogin'], function(){
	Route::get('admintrangchu','AdminController@getTrangChu');

	Route::group(['prefix'=>'capnhatHoaHonh'], function()
	{
		Route::get('capnhat-hoahong', 'CapNhatHoaHongThangController@capnhatHoaHong');
		Route::get('cap-nhat/{id}', 'CapNhatHoaHongThangController@getCapNhatCapCon');
		Route::get('cap-nhat-theo-tung-cap-con/{idcha}/{idcon}/{tongdoanhthu}/{bac}', 'CapNhatHoaHongThangController@CapNhatTheoTungCap');

	});
	

	Route::group(['prefix'=>'danhmuc'], function(){
		//hình thức thanh toán
		Route::get('hinhthucthanhtoan','DanhMucController@getDanhSachHinhThucThanhToan');
		Route::post('hinhthucthanhtoan/them','DanhMucController@posthinhthucthanhtoan_Them');
		Route::get('hinhthucthanhtoan/sua/{id}','DanhMucController@gethinhthucthanhtoan_Sua');
		Route::post('hinhthucthanhtoan/sua/{id}','DanhMucController@posthinhthucthanhtoan_Sua');
		Route::get('hinhthucthanhtoan/xoa/{id}', 'DanhMucController@gethinhthucthanhtoan_Xoa');
		//hình thức vận chuyển
		Route::get('hinhthucvanchuyen','DanhMucController@getDanhSachHinhThucVanChuyen');
		Route::post('hinhthucvanchuyen/them','DanhMucController@gethinhthucvanchuyen_Them');
		Route::get('hinhthucvanchuyen/sua/{id}','DanhMucController@gethinhthucvanchuyen_Sua');
		Route::post('hinhthucvanchuyen/sua/{id}','DanhMucController@posthinhthucvanchuyen_Sua');
		Route::get('hinhthucvanchuyen/xoa/{id}','DanhMucController@gethinhthucvanchuyen_Xoa');
		//nhóm sản phẩm
		Route::get('nhomsanpham','DanhMucController@getnhomsanpham');
		Route::get('nhomsanpham/them', 'DanhMucController@getnhomsanpham_Them');
		Route::post('nhomsanpham/them', 'DanhMucController@postnhomsanpham_Them');
		Route::get('nhomsanpham/sua/{id}', 'DanhMucController@getnhomsanpham_Sua');
		Route::post('nhomsanpham/sua/{id}', 'DanhMucController@postnhomsanpham_Sua');
		Route::get('nhomsanpham/xoa/{id}', 'DanhMucController@getnhomsanpham_Xoa');
		// xuất excel sản phẩm
		Route::get('xuatExcel-sanpham', 'ExcelController@Excel')->name('xuatExcel.excel');
		// xuất excel dịch vụ
		Route::get('xuatExcel-dichvu', 'ExcelController@ExcelDichVu')->name('xuatExcel.excelDichVu');
		Route::get('thuoctinhsanpham','DanhMucController@getthuoctinhsanpham');
		//còn thiếu

		//Sản phẩm
		Route::get('sanpham','DanhMucController@getsanpham');
		Route::get('sanpham/them', 'DanhMucController@getsanpham_Them');
		Route::post('sanpham/them', 'DanhMucController@postsanpham_Them');
		Route::get('sanpham/sua/{id}', 'DanhMucController@getsanpham_Sua');
		Route::post('sanpham/sua/{id}', 'DanhMucController@postsanpham_Sua');
		Route::get('sanpham/xoa/{id}', 'DanhMucController@getsanpham_Xoa');
		// danh mục dịch vụ
		Route::get('danhmucdichvu','DanhMucController@getdanhmucdichvu');
		Route::get('danhmucdichvu/them','DanhMucController@getdanhmucdichvu_Them');
		Route::post('danhmucdichvu/them','DanhMucController@postdanhmucdichvu_Them');
		Route::get('danhmucdichvu/sua/{id}', 'DanhMucController@getdanhmucdichvu_Sua');
		Route::post('danhmucdichvu/sua/{id}', 'DanhMucController@postdanhmucdichvu_Sua');
		Route::get('danhmucdichvu/xoa/{id}', 'DanhMucController@getdanhmucdichvu_Xoa');
		// dịch vụ
		Route::get('dichvu','DanhMucController@getdichvu');
		Route::get('dichvu/them', 'DanhMucController@getdichvu_Them');
		Route::post('dichvu/them', 'DanhMucController@postdichvu_Them');
		Route::get('dichvu/sua/{id}', 'DanhMucController@getdichvu_Sua');
		Route::post('dichvu/sua/{id}', 'DanhMucController@postdichvu_Sua');
		Route::get('dichvu/xoa/{id}', 'DanhMucController@getdichvu_Xoa');


		//Slider
		Route::get('slider','DanhMucController@getslider');
		Route::get('slider/them', 'DanhMucController@getslider_Them');
		Route::post('slider/them', 'DanhMucController@postslider_Them');
		Route::get('slider/sua/{id}', 'DanhMucController@getslider_Sua');
		Route::post('slider/sua/{id}', 'DanhMucController@postslider_Sua');
		Route::get('slider/xoa/{id}', 'DanhMucController@getslider_Xoa');
		
	});
	Route::group(['prefix'=>'caidat'],function(){
		
		// Gói đại lý
		Route::get('goidaily','CaiDatController@getgoidaily');
		Route::post('goidaily','CaiDatController@postgoidaily');
		// Hệ thống 
		Route::get('hethong', 'CaiDatController@gethethong');
		Route::POST('updatahethong/{key}', 'CaiDatController@updataHeThong');
		Route::get('xoalogo/{key}', 'CaiDatController@xoalogo');
		Route::get('xoalogokhuyenmai/{key}', 'CaiDatController@xoalogoKM');
		// Cài đặt hoa hồng doanh số đại lý

		Route::get('caidathoahongdsdl', 'CaiDatController@getcaidatdoanhsodaily');
		Route::post('caidathoahongdsdl/{id}', 'CaiDatController@postcaidatdoanhsodaily');

		Route::get('caidathoahongtongdl', 'CaiDatController@getcaidattongdaily');
		

	});
	Route::group(['prefix'=>'hoahong'],function(){
		//
		Route::get('goidaily','HoaHongController@getgoidaily');






		//
		Route::get('hoahonglieutrinh', 'HoaHongController@gethoahonglieutrinh');
		Route::get('hoahongtongdailylieutrinh', 'HoaHongController@gethoahongtongdailylieutrinh');

		//

		Route::get('hoahongdoanhsodaily', 'HoaHongController@gethoahongdoanhsodaily');

		// xem thong tin cap con và xét hoa hong
		Route::get('xem-chi-tiet-cap-con/{id}', 'HoaHongController@getxemcapcon');

		// còn thiếu phần cập nhật hoa hồng cho từng đại lý con 
		

		
		
		//xem theo danh sách
		Route::get('xem-danh-sach-hoa-hong-doanh-so-dai-ly', 'HoaHongController@getdanhsachhoahongdanhsachdaili')->name('xemdanhsach.doanhsoDL');

		
		Route::get('hoahongtongdaily', 'HoaHongController@gethoahongtongdaily');

	});
	Route::group(['prefix'=>'quanly'], function(){
		// nguoi dùng
		Route::get('nguoidung', 'QuanLyController@getnguoidung');
		Route::get('nguoidung/them', 'QuanLyController@getthemnguoidung');
		Route::post('nguoidung/them', 'QuanLyController@postthemnguoidung');
		Route::get('nguoidung/sua/{id}', 'QuanLyController@gettSuaNguoiDung');
		Route::post('nguoidung/sua/{id}', 'QuanLyController@postSuaNguoiDung');
		Route::get('nguoidung/xoa/{id}', 'QuanLyController@gettXoaNguoiDung');
		// khách hàng
		Route::get('khachhang','QuanLyController@getkhachhang');
		// link xam thông tin khách hàng
		Route::get('thongtin-khachhang/{id}', 'QuanLyController@getThongTinKhachHang');
		Route::get('khachhang/them', 'QuanLyController@getkhachhang_Them');
		// tự động đang nhap vào kiem tra thong tin khách hàng.
		Route::get('xem-thong-tin-khach-hang/{id}', 'QuanLyController@Xemthongtinkhachhang');
		// cap nhat thong tin khach hàng luon 
		Route::post('xem-thong-tin-khach-hang/{id}', 'QuanLyController@postXemthongtinkhachhang');

		// xác nhận admin gói đại lý đồng thời tạo mới hoa hồng trong bàn hoa hồng doanh số đại lý.
		Route::get('AdminXacNhanPackage/{id}', 'QuanLyController@adminxacnhan');
		
		
		// đại lý
		Route::get('goidailykhachhang','QuanLyController@getgoidailykhachhang');





		// xem chi tiết
		Route::get('xem-thong-tin-chi-tiet/{id}', 'QuanLyController@getxemthongtindaily');
		// giử emai yeu cầu xác nhận thong tin của đại lý
		Route::post('yeucauxnthongtin/{id}', 'QuanLyController@getXacNhanThongTinDL');
		// cap nhat thong tin đại lý từ trang quan ly 
		Route::get('capnhathongtindaily/{id}', 'QuanLyController@getcapnhathongtindaily');
		Route::post('capnhathongtindaily/{id}', 'QuanLyController@postcapnhathongtindaily');
		///





		
		// xác nhận kh mua gói dai lý
		Route::get('xacnhanmuagoidaily/{id}', 'QuanLyController@getxacnhanmuagoidaily');

		// đơn hàng
		Route::get('donhang','QuanLyController@getdonhang');
		Route::get('xacnhandonhang/{id}/{key}', 'QuanLyController@xacnhandonhang');
		Route::get('xacnhanthanhtoan/{id}/{key}', 'QuanLyController@xacnhanthanhtoan');
		//

		Route::get('danhsoxacnhan','QuanLyController@getdanhsoxacnhan');
		Route::get('lieutrinhkhachhang','QuanLyController@getlieutrinhkhachhang');
		Route::get('quanlyvidaily','QuanLyController@getquanlyvidaily');
		Route::get('quanlyvikhachhang', 'QuanLyController@getquanlyvikhachhang');
		Route::get('quanlyvihoahongkhachhang','QuanLyController@getquanlyvihoahongkhachhang');


		// xuất ecel don hàng
		Route::get('xuatExcel-order', 'ExcelController@ExcelOrder')->name('xuatExcel.excelOrder');





		Route::get('huyen/{idTinh}', 'TaiKhoanController@getHuyen');
		Route::get('xa/{idHuyen}', 'TaiKhoanController@getXa');
	
	});
	Route::group(['prefix'=>'thongke'], function(){
		Route::get('baocaothongke', 'ThongKeController@getbaocao');
		Route::get('ketquabaocao', 'ThongKeController@traketquabaocao');
	});
	Route::group(['prefix'=>'tintuc'], function(){
		Route::get('quanlychude','TinTucController@getchude');
		Route::get('quanlychude/them','TinTucController@getthemchude');
		Route::post('quanlychude/them','TinTucController@postthemchude');
		Route::get('quanlychude/sua/{id}','TinTucController@getchudesua');
		Route::post('quanlychude/sua/{id}','TinTucController@postchudesua');
		Route::get('quanlychude/xoa/{id}','TinTucController@xoadesua');


		Route::get('quanlytin', 'TinTucController@getquanlytin');
		Route::get('quanlytin/them', 'TinTucController@getthemquanlytin');
		Route::post('quanlytin/them', 'TinTucController@postthemquanlytin');

		Route::get('suatintuc/{id}','TinTucController@getsuatintuc');
		Route::post('suatintuc/{id}', 'TinTucController@postquanlytinsua');
		Route::get('xoatintuc/{id}', 'TinTucController@xoatintuc');
	});
	Route::group(['prefix'=>'taikhoan'], function(){
		Route::get('thongtintaikhoan','TaiKhoanController@getthongtintaikhoan');
	});
	// Ajax
	Route::group(['prefix'=>'ajax'], function(){
		Route::get('huyen/{idTinh}', 'AjaxController@getHuyen');
		Route::get('xa/{idHuyen}', 'AjaxController@getXa');
	});
});






