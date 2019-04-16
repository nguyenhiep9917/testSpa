<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Slider;
use App\Catalogy;
use App\Catalogyservice;
use App\Customer;
use App\User;
use App\Email;

class UserController extends Controller
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
	//đăng nhập
    public function getdangnhap()
    {
    	return view('dangnhap');
    }
    public function postdangnhap(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required',
                'password'  => 'required | max:20 | min:6'
            ],
            [
                'email.required' => 'bạn chưa nhập Tên tài khoản',
                'password.required'  => 'bạn chưa nhập mật khẩu !',
                'password.min'  => 'mật khẩu ít nhất là 6 ký tự',
                'password.max'  => 'mật khẩu nhiều nhất 20 ký tự '
            ]);
        if(Auth::attempt([
                'email' => $request->email,
                'password' => $request->password]
                ))
        {
            $user = Auth::User();
            $Customer_code = $user->customer_code;
            $Customer = Customer::where('customer_code', $Customer_code)->first();
            if($user->user_status == 2)
                return redirect('/admin/admintrangchu');
            if($Customer->customer_status == 1)
                return redirect('/');
            else
                return redirect('/');
        }
        else
        {
            return redirect('/dangnhap')-> with('thongbaologin', 'Đăng nhập không thành công hoặc thông tin tài khoản chưa được xác nhận qua email!');
        }
    }
        
    //đăng ký
    public function getdangky()
    {
    	return view('dangkytaikhoan');
    }
    public function postdangky(RegisterRequest $request)
    {
        // lưu id nguoi giới thieu làm cha của ng dk mới vào
        $taikhoangioithieu = $request->customer_parent;
        
        $find_customer = Customer::where('customer_account_name', $taikhoangioithieu)->first();
        

        //
        $customer = new Customer();
        $link = md5(rand(0, 99999) . time());
        $link_comfirm = url('/') . '/xacnhan/' . $link;
        
        $customer->customer_comfirm = $link;
        $customer->customer_account_name = $request->customer_account_name;
        $customer->customer_email = $request->customer_email;
        $customer->customer_username = $request->customer_account_name;
        $customer->customer_identity_card = $request->customer_identity_card;
        $customer->customer_dateofbirth = $request->customer_dateofbirth;
        $customer->customer_status = 0;
        $customer->customer_name = $request->customer_username;
        $customer->customer_sex = $request->customer_sex;
        
        $customer->customer_phone = $request->customer_phone;
        $customer->customer_password = Hash::make($request->customer_password);
        if($request->customer_parent != "")
        {
            $id_customerParent = $find_customer->customer_id;

            // $customer->customer_parent = $id_customer;
            $Customer_Parent = \App\Customer::where('customer_id', $id_customerParent)->first();
            
            if($Customer_Parent->package_id == 0)
            {
                \App\Customer::where('customer_id', $id_customerParent)->update(['customer_parent'=>0, 'package_id'=> 1]);
                // tao mới cái doanhsooahong cho id cha luôn
                

                 // nếu là khach hàng giới thiệu thì tạo doanh số hoa hồng lưu r cập nhật gói khi xác nhận mua gói dl
                $date = getdate(); 
                $HoaHongDoanhSoDaiLy = new \App\HoaHongDL();
                $HoaHongDoanhSoDaiLy->customer_id = $id_customerParent;
                $HoaHongDoanhSoDaiLy->hoahongdoanhsodaily_month = $date['mon'];
                $HoaHongDoanhSoDaiLy->hoahongdoanhsodaily_year = $date['year'];
                $HoaHongDoanhSoDaiLy->save();
                
                $HoaHongTongDaiLy = new \App\Hoahongtonghethong();
                $HoaHongTongDaiLy->customer_id = $id_customerParent;
                $HoaHongTongDaiLy->hoahongtonghethong_month = $date['mon'];
                $HoaHongTongDaiLy->hoahongtonghethong_year = $date['year'];
                $HoaHongTongDaiLy->save();

                /// như vậy kết luận khi khách hàng thường giới thiệu link cho kh mới thì cả hải sẽ 2 sẽ dc cập nhật lên gói thường và hiện thì trong cây hoa hồng và dc tính hoa hồng và dc tao mới bản hoa hồng daonh so dl

                
            }
            
            $customer->package_id = 1;

            // nếu như có ng giời thiệu thì mật định là gói miễn phí id cha lưu vào 
           $customer->customer_parent = $id_customerParent;

        }
        else
        {
            $customer->package_id = 0;
        }
        $customer->customer_code = "KH"."_".str_random(3);
        
        $customer->save();
            
        if($request->customer_parent != "")
        {
             // nếu là khach hàng giới thiệu thì tạo doanh số hoa hồng lưu r cập nhật gói khi xác nhận mua gói dl
            $date = getdate(); 
            $HoaHongDoanhSoDaiLy = new \App\HoaHongDL();
            $HoaHongDoanhSoDaiLy->customer_id = $customer->customer_id;
            $HoaHongDoanhSoDaiLy->hoahongdoanhsodaily_month = $date['mon'];
            $HoaHongDoanhSoDaiLy->hoahongdoanhsodaily_year = $date['year'];
            //
            $HoaHongDoanhSoDaiLy->save();
            
            $HoaHongTongDaiLy = new \App\Hoahongtonghethong();
            $HoaHongTongDaiLy->customer_id =  $customer->customer_id;
            $HoaHongTongDaiLy->hoahongtonghethong_month = $date['mon'];
            $HoaHongTongDaiLy->hoahongtonghethong_year = $date['year'];
            $HoaHongTongDaiLy->save();

        }
        $User = new User();
        
        $User->name = $customer->customer_username;
        $User->email = $customer->customer_email;
        $User->password = $customer->customer_password;
        $User->user_phone = $customer->customer_phone;
        $User->customer_code = $customer->customer_code;
        $User->TaiKhoan = $request->customer_account_name;

        if ($User->save()){
            // send mail
            $email = new Email();
            $body = view('email_template.xacnhanemail', ['link' =>  $link_comfirm, 'customer' => $customer]);
            $data = [
                'email' => $customer->customer_email,
                'subject' => 'Xac nhan tai khoan',
                'body' => $body
            ];
            $email->send( $data);
        }

        $token = $request->input('g-recaptcha-response');
        if($token)
        {
            return view('dangnhap')->with('thongbaoxacnhanemail', 'Chào bạn vui lòng xác nhận tài khoản qua eamil để đăng nhập.');
        }
        else
        {
            return redirect('/');
        }
    }
    // đăng xuất
    public function getdangxuat()
    {
        Auth::logout();
        return redirect('/');
    }
   
    //xac nhan
    public function getxacnhan(Request $request)
    {
       if ($request->comfirm){
            $customer_comfirm = $request->comfirm;
            $customer = Customer::where('customer_comfirm' , '=' , $customer_comfirm)->first();
            
            if ($customer){
                $customer->customer_status = 1;
                $customer->save();
            }
            // $code_kh = $customer->customer_code;
            // $user = User::find($code_kh);
            // $user->user_status = 1;
            // $user->save();
       }
        return redirect('/');
    }
}
