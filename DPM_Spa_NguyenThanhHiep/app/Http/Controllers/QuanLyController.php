<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Province;
use App\District;
use App\Commune;
use App\Customer;
use App\Package;
Use Cart;
use App\Email;

class QuanLyController extends Controller
{
    // quản lý người dùng 
    public function getnguoidung()
    {
        $data = \App\User::all();
        $customer = Customer::all();
        foreach ($data as $value) {
            foreach ($customer as $val) {
                if($value->customer_code == $val->customer_code )
                    $star = $val->customer_status;
            }
        }
        //echo $star;
        return view('admin.quanly.nguoidung.nguoidungs', ['data'=>$data, 'star'=>$star]);
    }
    //thêm người dùng
    public function getthemnguoidung()
    {
        return view('admin.quanly.nguoidung.themnguoidung');
    }
    public function postthemnguoidung(Request $request)
    {
        $nguoidung = new \App\User();
        $nguoidung->name = $request->name;
        $nguoidung->TaiKhoan = $request->TaiKhoan;
        $nguoidung->email = $request->email;
        $nguoidung->password = Hash::make($request->password);
        $nguoidung->user_phone = $request->user_phone;
        $nguoidung->save();
        return redirect()->back()->with(['flash_lever'=>"success", 'flash_message'=>'Thêm người dùng thành công!']);
    }
    // sửa người dùng
    public function gettSuaNguoiDung($id)
    {
        $dataUser = \App\User::find($id);
        return view('admin/quanly/nguoidung/suanguoidung', ['dataUser'=>$dataUser]);
    }
    public function postSuaNguoiDung(Request $request, $id)
    {
        $nguoidung = \App\User::find($id);
        $nguoidung->name = $request->name;
        $nguoidung->TaiKhoan = $request->TaiKhoan;
        $nguoidung->email = $request->email;
        $nguoidung->password = Hash::make($request->password);
        $nguoidung->user_phone = $request->user_phone;
        $nguoidung->save();
        return redirect()->back()->with(['flash_lever'=>"success", 'flash_message'=>'Cập nhật thông tin người dùng thành công!']);
    }
    public function gettXoaNguoiDung(Request $request, $id)
    {
        $nguoidung = \App\User::find($id);
        $nguoidung->delete();
        return redirect()->back()->with(['flash_lever'=>"success", 'flash_message'=>'Xóa thông tin người dùng thành công!']);
    }
    // quản lý khách hàng
    public function getkhachhang()
    {
        $dataCustomer = Customer::orderBy('customer_id', 'desc')->get();

    	return view('admin.quanly.khachhang.khachhang',['dataCustomer'=>$dataCustomer]);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('autologin/{id}');
    }
    // tự động login vào keim tra thông tin khách hàng.
    public function Xemthongtinkhachhang($id)
    {
        $data_province = Province::all();
        $data_district = District::all();
        $data_commune = Commune::all();
        $dataCustomer = \App\Customer::find($id);
        return view('admin.quanly.khachhang.xemthongtinkhachhang', ['dataCustomer'=>$dataCustomer,'data_province'=>$data_province, 'data_district'=>$data_district, 'data_commune'=>$data_commune ]);
    }
    // cập nhật thong tin khách hàng nếu như vao xem chi tiết thong 6tin mà thong tin thieu thì tữ động cập nhật
    public function postXemthongtinkhachhang(Request $request, $id)
    {
        $Customer = \App\Customer::find($id);
        Customer::where('customer_id',$id)->update([
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










    // thêm khách hàng
    public function getkhachhang_Them()
    {
        $data_province = Province::all();
        $data_district = District::all();
        $data_commune = Commune::all();

        return view('admin.quanly.khachhang.themkhachhang', ['data_province'=>$data_province, 'data_district'=>$data_district, 'data_commune'=>$data_commune   ]);
    }


    // quản lý đại lý
    public function getgoidailykhachhang()
    {
        $dataDL = \App\HoaHongDL::all();
        $order = \App\Order::all();
        $customer = \App\Customer::all();
    	return view('admin.quanly.DaiLy.goidailykhachhang', ['dataDL'=>$dataDL, 'order'=>$order, 'customer'=>$customer]);
    }
    

    // xác nhận mua gói đại lý
    public function getxacnhanmuagoidaily($id)
    {
        $dataDSDL = \App\HoaHongDL::where('customer_id', $id)->first();
        $dataorder = \App\Order::where('customer_id', $id)->first();
        $datacustomer = \App\Customer::where('customer_id', $id)->first();

        $data = date('Y-m-d');
        if(isset($dataDSDL))
        {
            \App\HoaHongDL::where('customer_id', $id)->update(['hoahongdoanhsodaily_tong'=>$dataorder->order_totalvalue, 'hoahongdoanhsodaily_createdate'=>$data]);
            \App\Customer::where('customer_id', $id)->update(['package_id'=>$dataorder->order_package]);
            \App\Order::where('customer_id', $id)->update(['payment_status'=>1, 'confirm_status'=>1, 'confirm_date'=>$data, 'order_package'=>$dataDSDL->hoahongdoanhsodaily_id]);
        }
        else {
            echo 'Đại lý không tồn tại.';
        }

        return redirect()->back()->with(['flash_lever'=>"success",'flash_message'=>'Xác nhận thành công!']);
    }
    // xem thông tin chi tiết gói đại lý
    public function getxemthongtindaily($id)
    {
        $Customer = \App\Customer::find($id);
        $data_province = Province::all();
        $data_district = District::all();
        $data_commune = Commune::all();
        return view('admin.quanly.DaiLy.xemthongtindaily', ['Customer'=>$Customer, 'data_province'=>$data_province, 'data_district'=>$data_district, 'data_commune'=>$data_commune ]);
    }
    // giu yêu cầu xác nhận thông tin 
    public function getXacNhanThongTinDL($id)
    {
        $Customer = \App\Customer::find($id);
        $email = new Email();
        $body = view('email_template.yeucaunhapthongtin');
        $data = [
            'email' => $Customer->customer_email,
            'subject' => 'Yêu cầu xác nhận thông tin',
            'body' => $body
        ];
        $email->send( $data);
        return redirect()->back()->with(['flash_lever'=>"success",'flash_message'=>'Giử yêu cầu thành công!']);
    }
    // cập nhật thông tin dai lý
    public function getcapnhathongtindaily($id)
    {
        $Customer = \App\Customer::find($id);
         $data_province = Province::all();
        $data_district = District::all();
        $data_commune = Commune::all();
        return view('admin.quanly.DaiLy.capnhatthongtindaily', ['Customer'=>$Customer,  'data_province'=>$data_province, 'data_district'=>$data_district, 'data_commune'=>$data_commune]);
    }
    public function postcapnhathongtindaily(Request $request, $id)
    {
        $Customer = \App\Customer::find($id);
        Customer::where('customer_id',$id)->update([
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
        return redirect()->back()->with(['flash_lever'=>"success",'flash_message'=>'Cập nhật thành công!']);
    }

    // xác nhận từ admin 
    public function adminxacnhan($id)
    {   

        $xacnhan_package = \App\Order::where('order_id', $id)->update(['confirm_status' => 1, 'confirm_date'=>date('Y-m-d H:i:s')]);

        // $xacnhan_package = \App\Order_detail::where('detail_id', $id)->update(['option' => 1, 'time_xacnhan'=>date('Y-m-d H:i:s')]);
        // // lấy email send thông báo 
        // $order_detail = \App\Order_detail::where('detail_id', $id)->first();
        // $idUser = $order_detail->user_id;
        // $giapackage = $order_detail->detail_unitprice;

        // $Order_detail = \App\Order_address::where('user_id', $idUser)->first();
        // $emailsend = $Order_detail->email;
        // // lấy id customer luu vào bản hoa hồng doanh số dai lý
        // $user = \App\User::find($idUser);
        // $codeCustomer = $user->customer_code;
        // $Customer = \App\Customer::where('customer_code', $codeCustomer)->first();
        // $customer_id = $Customer->customer_id;
        // //cập nhật lai package bản customer
        // if($giapackage == 5000000)
        // {
        //     \App\Customer::where('customer_code', $codeCustomer)->update(['package_id' => 2]);
        //     \App\Order::where('customer_id', $customer_id)->update(['order_package' => 2]);
        //     \App\HoaHongDL::where('customer_id', $customer_id)->update(['hoahongdoanhsodaily_tong' => 5000000]);
        // }
        // if($giapackage == 25000000)
        // {
        //     \App\Customer::where('customer_code', $codeCustomer)->update(['package_id' => 3]);
        //     \App\Order::where('customer_id', $customer_id)->update(['order_package' => 2]);
        //     \App\HoaHongDL::where('customer_id', $customer_id)->update(['hoahongdoanhsodaily_tong' => 25000000]);
        // }
        
        // if($xacnhan_package)
        // {
        //     $email = new Email();
        //     $body = view('email_template.mailThongbaoxacnhanPackage');
        //     $data = [
        //         'email' => $emailsend,
        //         'subject' => 'Thông báo xác nhận đơn hàng',
        //         'body' => $body
        //     ];
        //     $email->send( $data);
        // }



        return redirect()->back();
    }




    // quản lý đơn hàng
    public function getdonhang()
    {
        $data_Order_address = \App\Order_address::all();
        $data_Order_detail = \App\Order_detail::all();
        $data_Order = \App\Order::all();
        $find_customer = Customer::all();
        $product = \App\Product::all();
        //echo $data_Order_detail;
        //echo $iduser;
    	return view('admin.quanly.DonHang.donhang', ['data_Order_address'=>$data_Order_address, 'data_Order_detail'=>$data_Order_detail, 'find_customer'=>$find_customer, 'product'=>$product, 'data_Order'=>$data_Order ]);
    }
    // xác nhận đơn hàng 
    public function xacnhandonhang($id, $key)
    {
        \App\Order::where('order_id',$id)->update(['confirm_status' => $key]);
        return redirect()->back();
    }
    // thanh toán xác nhận
    public function xacnhanthanhtoan($id, $key)
    {
        $date = time();
        \App\Order::where('order_id',$id)->update(['payment_status' => $key, 'payment_date'=>$date, 'confirm_status' => 3 ]);
       // cập nhật thanh toan ben don97 hàng chi tiết
       $dataorder_detail = \App\Order_detail::where('order_id',$id)->get();
       foreach ($dataorder_detail as $value) {
           \App\Order_detail::where('order_id',$value->order_id)->update(['payment_start' => $key]);
       }
       
        return redirect()->back();
    }
    public function getdanhsoxacnhan()
    {
    	return view('admin.quanly.danhsoxacnhan');
    }
    public function getlieutrinhkhachhang()
    {
    	return view('admin.quanly.datlieulieutrinhkhachhang');
    }
    public function getquanlyvidaily()
    {
    	return view('admin.quanly.quanlyvidaily');
    }
    public function getquanlyvikhachhang()
    {
    	return view('admin.quanly.quanlyvikhachhang');
    }
    public function getquanlyvihoahongkhachhang()
    {
    	return view('admin.quanly.quanlyvihoahongkhachhang');
    }


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
