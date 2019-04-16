<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Slider;
use App\Catalogy;
use App\Catalogyservice;
use App\Customer;
use App\Package;
use App\Province;
use App\District;
use App\Commune;
Use Cart;

class TaiKhoanController extends Controller
{
	function __construct()
	{
		$data_slider = Slider::all();
		view()->share('data_slider',$data_slider);
    	//data chuyền menu san pham
    	$data_menu_catalogy = Catalogy::all();
    	view()->share('data_menu_catalogy',$data_menu_catalogy);
    	// data menu dich vu
    	$data_menu_catalogyservice = Catalogyservice::all();
    	view()->share('data_menu_catalogyservice',$data_menu_catalogyservice);
       
        
	}
    
    // đổi mật khẩu
    public function doimatkhau($id)
    {
        $code_customer_user = Auth::user()->customer_code;
        $find_customer = Customer::where('customer_code', $code_customer_user)->first(); // lấy id parent 

        return view('TaiKhoan.doimatkhau', ['find_customer'=>$find_customer]);
    }
    public function postdoimatkhau(Request $request, $id)
    {
        $matkhaumoi =  Hash::make($request->customer_passwordnew);
        $user = \App\User::find($id);
        $iduser = $user->id;
        // $passUser = $user->password;
        // $ff = $request->matkhaucu;
        // $catchuoimatkhaucu = substr($matkhaucu, 0, 6);
        // $catchuoimatkhaumoi = substr($passUser, 0, 6);
        //echo $iduser; echo '<br>';
        if(\App\User::where('id', $iduser)->update(['password'=>$matkhaumoi]))
        {
            return redirect('dangnhap');
        }
        else
        {
            return redirect()->back();
        }
        // if($matkhaucu == $passUser)
        //     echo "có";
        // else
        //     echo 'k';
        
    }
    // lấy llink
    public function getlink($taikhoan)
    {
        
        $find_customer = Customer::where('customer_account_name', $taikhoan)->first();
       // $idcustomer = $find_customer->customer_id;
        //echo $find_customer;
        return view('dangkytaikhoan', ['find_customer'=>$find_customer]);

    }
    //ví cá nhân
    public function getvicanhan($id)
    {
        $customer_code = Auth::user()->customer_code;
        $find = \App\Customer::where('customer_code', $customer_code)->first();
        $idCustomer = $find->customer_id;
        
        $finddl = \App\HoaHongDL::where('customer_id', $idCustomer)->first();

        $data_Order_address = \App\Order_address::all();
        $data_Order_detail = \App\Order_detail::all();
       
        $find_customer = Customer::all();
        $product = \App\Product::all();

        $data_Order = \App\Order::where('customer_id', $id)->get();
      
        return view('TaiKhoan.vicanhan',['finddl'=>$finddl, 'data_Order_address'=>$data_Order_address, 'data_Order_detail'=>$data_Order_detail, 'find_customer'=>$find_customer, 'product'=>$product, 'data_Order'=>$data_Order ]);
    }
    // xem chi tiết các đơn hag từ order đại lý mua 
    public function getxemchitetorderdaily($id)
    {
        $data_Order = \App\Order::where('customer_id', $id)->get();
        $data_Order_detail = \App\Order_detail::all();
        $dataProduct = \App\Product::all();
        return view('TaiKhoan.chitietdonhangtrutuDL', ['data_Order'=>$data_Order, 'data_Order_detail'=>$data_Order_detail, 'dataProduct'=>$dataProduct]);
    }
    
    public function gettaikhoan()
    {
        $code_customer_user = Auth::user()->customer_code;
        $iduser = Auth::user()->id;
        $iduser_Order_detail = \App\Order_detail::where('user_id',$iduser)->first(); // lấy id ss để bật tắc nâng cắp
        $all_customer = Customer::all();
        $find_customer = Customer::where('customer_code', $code_customer_user)->first();
        $data_package_free = Package::where('package_key', 'FREE')->first();
        $data_package_normal = Package::where('package_key', 'NORMAL')->first();
        $data_package_vip = Package::where('package_key', 'VIP')->first();
        $content = Cart::content();
        $totals = Cart::total();
        url('/').'/thanh-vien/';
        return view('TaiKhoan.taikhoan', ['find_customer'=>$find_customer, 'data_package_free'=>$data_package_free, 'data_package_normal'=>$data_package_normal, 'data_package_vip'=>$data_package_vip, 'content'=>$content, 'totals'=>$totals, 'iduser_Order_detail'=>$iduser_Order_detail]);
    }
    public function getUpdataTaiKhoan()
    {
        $code_customer_user = Auth::user()->customer_code;
        $find_customer = Customer::where('customer_code', $code_customer_user)->first(); // lấy id parent 

        $data_province = Province::all();
        $data_district = District::all();
        $data_commune = Commune::all();
        $shiptype = \App\Shiptype::all();
        $user = Auth::User();
        $Customer_code = $user->customer_code;
        $Customer = Customer::where('customer_code', $Customer_code)->first();
        return view('TaiKhoan.updatathongtin', ['data_province'=>$data_province, 'data_district'=>$data_district, 'data_commune'=>$data_commune, 'Customer'=>$Customer, 'shiptype'=>$shiptype, 'find_customer'=>$find_customer]);
    }
    // cập nhật thong 6tin xác nhận
    public function getconfrimthongtinupdata()
    {
        $user = Auth::User();
        $Customer_code = $user->customer_code;
        $Customer = Customer::where('customer_code', $Customer_code)->first();

        $data_province = Province::all();
        $data_district = District::all();
        $data_commune = Commune::all();
        return view('xacnhanthongtin', ['data_province'=>$data_province, 'data_district'=>$data_district, 'data_commune'=>$data_commune, 'Customer'=>$Customer]);
    }
    public function postUpdataTaiKhoan(Request $request, $id)
    {
        $user = Auth::User();
        $Customer_code = $user->customer_code;
        $Customer = Customer::where('customer_code', $Customer_code)->first();
        $idCustomer = $Customer->customer_id;
        Customer::where('customer_id',$idCustomer)->update([
            'customer_dateofbirth' => $request->customer_dateofbirth,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'customer_name_spa' => $request->customer_name_spa,
            'customer_address' => $request->address,
            'customer_province_id' => $request->customer_province_id,
            'customer_district_id' => $request->customer_district_id,
            'custoner_commune_id' => $request->custoner_commune_id,
            'customer_type_verify' => $request->customer_type_verify,
            'customer_identity_card' => $request->customer_identity_card,
            'customer_account_number' => $request->customer_account_number,
            'customer_account_type' => $request->customer_account_type,
            'customer_account_name' => $request->customer_account_name,
            'customer_account_branch' => $request->customer_account_branch,
            'customer_sex' => $request->sex
        ]);
        if($request -> hasFile('customer_image_face_before'))
        {
            $file = $request -> file('customer_image_face_before');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('TaiKhoan/updatathongtin') -> with('loi','bạn có thể chọn hình ảnh đuôi jpg, png, jepg !');
            }
            $name = $file -> getClientOriginalName();
            $hinh = str_random(3)."_".$name;
            while (file_exists("image/image_CMND/".$hinh)) {
                $hinh = str_random(3)."_".$name;
            }
            //echo $hinh;
            //luu hình 
            $file -> move("image/image_CMND",$hinh);
            $Customer ->customer_image_face_before = $hinh;
        }
        if($request -> hasFile('customer_image_face_after'))
        {
            $file = $request -> file('customer_image_face_after');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('TaiKhoan/updatathongtin') -> with('loi','bạn có thể chọn hình ảnh đuôi jpg, png, jepg !');
            }
            $name = $file -> getClientOriginalName();
            $hinh = str_random(3)."_".$name;
            while (file_exists("image/image_CMND/".$hinh)) {
                $hinh = str_random(3)."_".$name;
            }
            //echo $hinh;
            //luu hình 
            $file -> move("image/image_CMND",$hinh);
            $Customer ->customer_image_face_after = $hinh;
        }
        if($request -> hasFile('customer_logo'))
        {
            $file = $request -> file('customer_logo');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('TaiKhoan/updatathongtin') -> with('loi','bạn có thể chọn hình ảnh đuôi jpg, png, jepg !');
            }
            $name = $file -> getClientOriginalName();
            $hinh = str_random(3)."_".$name;
            while (file_exists("image/logo/".$hinh)) {
                $hinh = str_random(3)."_".$name;
            }
            //echo $hinh;
            //luu hình 
            $file -> move("image/logo",$hinh);
            $Customer ->customer_logo = $hinh;
        }
        $Customer -> save();
         return redirect()->back()->with('ThongBao','Cập nhật thông tin thành công.');
    }
    //
    public function getdsDiaChi()
    {
        $code_customer_user = Auth::user()->customer_code;
        $find_customer = Customer::where('customer_code', $code_customer_user)->first(); // lấy id parent
    	return view('TaiKhoan.danhsachDiachi', ['find_customer'=>$find_customer ]);
    }
    //đơn hàng
    public function getDonHang($id)
    {
        $code_customer_user = Auth::user()->customer_code;
        $all_customer = Customer::all();
        $find_customer = Customer::where('customer_code', $code_customer_user)->first(); // show package bên ví cá nhan
        $data_Order_detail = \App\Order_detail::where('user_id', $id)->first();
        $id_customer = $find_customer->customer_id;

        $data_Order = \App\Order::where('customer_id', $id_customer)->get();
        $data_Order_detail = \App\Order_detail::all();
        $dataProduct = \App\Product::all();
        return view('TaiKhoan.donhang_taikhoan',['find_customer'=>$find_customer, 'data_Order_detail'=>$data_Order_detail, 
            'data_Order'=>$data_Order, 'data_Order_detail'=>$data_Order_detail, 'dataProduct'=>$dataProduct ]);
    }
    // cây hệ thống
    public function getCayHeThong()
    {
        $code_customer_user = Auth::user()->customer_code;
        $find_customer = Customer::where('customer_code', $code_customer_user)->first(); // lấy id parent
        //

        $htmHoaHong_TaiKhoan = '';
        $user = Auth::User();
        $Customer_code = $user->customer_code;
        $Customer = Customer::where('customer_code', $Customer_code)->first();
        $customer_id = $Customer->customer_id;
        
        $childrens = \App\Customer::where("customer_id", $customer_id)->get();
        if ($childrens->count() > 0){
            foreach ($childrens as $customer) {
                $hoahong = new  \App\HoaHongCaNhan;
                $htmHoaHong_TaiKhoan .= $hoahong->cayHeThong($customer);
            }
        }
        
        // if ($childrens->count() > 0){
        //     foreach ($childrens as $customer) {
        //         $hoahong = new  \App\HoaHongDoanhSoDaiLy;
        //         $htmHoaHong_TaiKhoan .= $hoahong->cayHeThong($customer);
        //     }
        // }
    	return view('TaiKhoan.cayhethong_taikhoan', ['htmHoaHong_TaiKhoan'=>$htmHoaHong_TaiKhoan, 'find_customer'=>$find_customer ]);
    }
    // doanh số cá nhan
    public function getDoanhSoTaiKhoan()
    {
    	return view('TaiKhoan.danhsocanhan');
    }
    // hoa hồng liệu trình
    public function getHoaHongLieuTrinh()
    {
    	return view('TaiKhoan.hoahonglieutrinh');
    }


    // xác nhận gói và lưu thông tin vào khách hàng
   
    public function getxacnhan_package_normal($id)
    {
        $code_customer_user = Auth::user()->customer_code;
        $all_customer = Customer::all();
        $find_customer = Customer::where('customer_code', $code_customer_user)->first();
        return view('TaiKhoan.XacNhan_Package.xacnhan_package_normal', ['find_customer'=>$find_customer]);
    }
    //
    public function postxacnhan_package_normal($id)
    {
        $Customer_updata_package_normal = Customer::find($id);
        $Customer_updata_package_normal->package_id = 5;
        $Customer_updata_package_normal->save();
        return redirect('/taikhoan/taikhoan_page')-> with('thongbaochoxacnhan_package_normal', 'Yêu cầu mua gói đại lý thường được chấp nhận bạn sẽ nhận được phản hồi của admin sớm nhất.');
    }
    public function getxacnhan_package_vip($id)
    {
        $code_customer_user = Auth::user()->customer_code;
        $all_customer = Customer::all();
        $find_customer = Customer::where('customer_code', $code_customer_user)->first();
        return view('TaiKhoan.XacNhan_Package.xacnhan_package_Vip', ['find_customer'=>$find_customer]);
    }
    public function postxacnhan_package_vip($id)
    {
        $Customer_updata_package_Vip = Customer::find($id);
        $Customer_updata_package_Vip->package_id = 25;  
        $Customer_updata_package_Vip->save();
        return redirect('/taikhoan/taikhoan_page')-> with('thongbaochoxacnhan_package_vip', 'Yêu cầu mua gói đại lý Vip được chấp nhận bạn sẽ nhận được phản hồi của admin sớm nhất.');
    }
    // cập nhật thông tin  khách hàng và cập nhật gói xac nhận của admin
    public function getThongTinXacNhan()
    {
        $code_customer_user = Auth::user()->customer_code;
        $all_customer = Customer::all();
        $find_customer = Customer::where('customer_code', $code_customer_user)->first();
        //địa chỉ
        $data_province = Province::all();
        $data_district = District::all();
        $data_commune = Commune::all();
        return view('TaiKhoan.XacNhan_Package.themThongTinXacNhan', ['find_customer'=>$find_customer, 'data_province'=>$data_province, 'data_district'=>$data_district, 'data_commune'=>$data_commune]);
    }
    // public function postThongTinXacNhan($)
    // {
        
    // }
    
    // load address
     public function getHuyen($idTinh)
    {
        $data_district = District::Where('province_id', $idTinh)->get();
        foreach ($data_district as $value)
        {
            echo "<option value='".$value->district_id."'>".$value->district_name."</option>";
        }
    }
    // get Xã
    public function getXa($idHuyen)
    {
        $data_commune = Commune::Where('district_id', $idHuyen)->get();
        foreach ($data_commune as $value)
        {
            echo "<option value='".$value->commune_id."'>".$value->commune_name."</option>";
        }
    }
}
