<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Slider;
use App\Catalogy;
use App\Catalogyservice;
use App\Customer;
use App\Package;
Use Cart;
use App\Order;

class GoiDaiLyController extends Controller
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
    // show all dai ly
    public function getgoidaily()
    {
        if(Auth::user()){
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
    	return view('goiDaiLy', ['find_customer'=>$find_customer, 'data_package_free'=>$data_package_free, 'data_package_normal'=>$data_package_normal, 'data_package_vip'=>$data_package_vip, 'content'=>$content, 'totals'=>$totals, 'iduser_Order_detail'=>$iduser_Order_detail]);
        }
        else{
            return redirect('dangnhap');
        }
    }
    // mua gói đại lý
    public function muagoipackage($id)
    {
        //echo $id;
        $PackageBuy = Package::where('id', $id)->first();
        $arr = array(
            'id' => $id, 
            'name' => $PackageBuy->package_name, 
            'qty' => 1, 
            'price'=> $PackageBuy->package_price
        );

        $row = Cart::add($arr);
        Cart::setTax($row->rowId, 0);
        $content = Cart::content();
        // print_r($content);
        // die();
        return redirect()->route('giohangPackage');
    }
    public function giohangGoiPackage()
    {
        Cart::tax(0,0,0);
        $content = Cart::content();
        $totals = Cart::total();
        return view('TaiKhoan.XacNhan_Package.goihang_package_normal', ['content' => $content, 'totals' => $totals]);
    }
    public function Xoapackage($rowId)
    {
        Cart::remove($rowId);
        return redirect()->route('giohangPackage');
    }

    // dat mua gói package
    public function getdathangPackage(Request $request, $id)
    {
        // $this->validate($request,
        //     [
        //         'full_name' => 'required'
        //         // 'email' => 'required',
        //         // 'customer_dateofbirth' => 'required',
        //         // 'phone' => 'required',
        //         // 'address' => 'required',
        //         // 'customer_province_id' => 'required',
        //         // 'customer_district_id' => 'required',
        //         // 'custoner_commune_id' => 'required'

        //     ],
        //     [
        //         'full_name.required' => 'Tên không được bỏ trống !',
        //         'email.required' => 'Tên không được bỏ trống !',
        //         'customer_dateofbirth.required' => 'Tên không được bỏ trống !',
        //         'phone.required' => 'Tên không được bỏ trống !',
        //         'address.required' => 'Tên không được bỏ trống !',
        //         'customer_province_id.required' => 'Tên không được bỏ trống !',
        //         'customer_district_id.required' => 'Tên không được bỏ trống !',
        //         'custoner_commune_id.required' => 'Tên không được bỏ trống !'
        //     ]);
        $data_province = \App\Province::all();
        $data_district = \App\District::all();
        $data_commune = \App\Commune::all();
        $shiptype = \App\Shiptype::all();
        $user = Auth::User();
        $Customer_code = $user->customer_code;
        $Customer = Customer::where('customer_code', $Customer_code)->first();
        return view('TaiKhoan.XacNhan_Package.datmuaPackage', ['data_province'=>$data_province, 'data_district'=>$data_district, 'data_commune'=>$data_commune, 'Customer'=>$Customer, 'shiptype'=>$shiptype]);
    }
    public function postdathangPackage(Request $request, $id)
    {
        $user = Auth::User();
        $userid = $user->id;
        $cart = Cart::content()->first();
        $totals=Cart::total(0, ',', '');
        $codeCustomer = $user->customer_code;
        $findCustumer = \App\Customer::where('customer_code', $codeCustomer)->first();
        $id_customer = $findCustumer->customer_id;
        $id_customer_parent = $findCustumer->customer_parent;
        $data = date('Y-m-d');
        $ghichu = $request->note;

        // if($findCustumer)
        // {
        //     $updata = Order::where('customer_id', $id_customer)->update(['order_totalvalue' => $totals, 'order_totalvalueship' => $totals, 'ship_status' => 0, 'ship_date'=>  $data, 'ship_content'=>$ghichu]);
        // }

        if($findCustumer->package_id > 0)
        {
            $oder = new Order();
            $oder->customer_id = $id_customer;
            $oder->order_totalvalue = $totals;
            $oder->order_totalvalueship = $totals;
            $oder->price_shipping = 0;
            $oder->confirm_status = 0;
            $oder->payment_status = 0;
            $oder->order_createdate = $data;
            $oder->confirm_status = 0;
            $oder->confirm_date = $data;
            $oder->customer_referralcode = $findCustumer->customer_code;
            if($totals == 5000000)
            {
                $oder->order_package = 2;
            }
            if($totals == 25000000)
            {
                $oder->order_package = 3;
            }

            $oder->save();
            //
            $order_address = new \App\Order_address();
            $order_address->order_id = $oder->order_id;
            $order_address->shipping_id = 0;
            $order_address->address = $request->address;
            $order_address->province = $request->customer_province_id;
            $order_address->district = $request->customer_district_id;
            $order_address->commune = $request->custoner_commune_id;
            $order_address->full_name = $request->full_name;
            $order_address->email = $request->email;
            $order_address->phone = $request->phone;
            $order_address->note = $request->note;
            $order_address->status = 0;
            $order_address->user_id = $userid;
            $order_address->note = $request->note;
            $order_address->save();
            
        }
        if ($findCustumer->package_id == 0)
        {
            // $date = getdate(); 
            // $HoaHongDoanhSoDaiLy = new \App\HoaHongDL();
            // $HoaHongDoanhSoDaiLy->customer_id = $id_customer;
            // $HoaHongDoanhSoDaiLy->hoahongdoanhsodaily_month = $date['mon'];
            // $HoaHongDoanhSoDaiLy->hoahongdoanhsodaily_year = $date['year'];
            // $HoaHongDoanhSoDaiLy -> save();
            // khi xac nhan updata lai cusotmerparent lai ben ban customer


            $oder = new Order();
            $oder->customer_id = $id_customer;
            $oder->order_totalvalue = $totals;
            $oder->order_totalvalueship = $totals;
            $oder->price_shipping = 0;
            $oder->confirm_status = 0;
            $oder->payment_status = 0;
            $oder->order_createdate = $data;
            $oder->confirm_status = 0;
            $oder->confirm_date = $data;
            $oder->customer_referralcode = $findCustumer->customer_code;
            if($totals == 5000000)
            {
                $oder->order_package = 2;
            }
            if($totals == 25000000)
            {
                $oder->order_package = 3;
            }

            $oder->save();
            //
            $order_address = new \App\Order_address();
            $order_address->order_id = $oder->order_id;
            $order_address->shipping_id = 0;
            $order_address->address = $request->address;
            $order_address->province = $request->customer_province_id;
            $order_address->district = $request->customer_district_id;
            $order_address->commune = $request->custoner_commune_id;
            $order_address->full_name = $request->full_name;
            $order_address->email = $request->email;
            $order_address->phone = $request->phone;
            $order_address->note = $request->note;
            $order_address->status = 0;
            $order_address->user_id = $userid;
            $order_address->note = $request->note;
            $order_address->save();
        }

        if(isset($cart))
        {
            Cart::remove($cart->rowId);
        }
        return redirect()->back()->with('ThongBao','Đặt hàng thành công, Thông tin mua gói đã được chấp nhận đang được xác nhận.');

            







        // // if($findCustumer->package_id == 0)
        // // {
        // //     if(Order::where('customer_id', $id_customer)->first())
        // //     {
        // //         $order = Order::where('customer_id', $id_customer)->first();
        // //         $order_totalvalue = $order->order_totalvalue;
        // //         $capnhattong = $order_totalvalue + $totals;
        // //         Order::where('customer_id', $id_customer)->update(['order_totalvalue' => $capnhattong, 'order_totalvalueship' => $capnhattong, 'ship_status' => 0, 'ship_date'=>  $data, 'ship_content'=>$ghichu]);
        // //         if($totals == 5000000)
        // //         {
        // //             Order::where('customer_id', $id_customer)->update(['order_package' => 2]);
        // //             \App\Customer::where('customer_id', $id_customer)->update(['package_id' => 2]);
        // //         }
        // //         if($totals == 25000000)
        // //         {
        // //             Order::where('customer_id', $id_customer)->update(['order_package' => 3]);
        // //             \App\Customer::where('customer_id', $id_customer)->update(['package_id' => 3]);
        // //         }
        // //         // tạo bản doanh so dai lý 
        // //         $date = getdate(); 
        // //         $HoaHongDoanhSoDaiLy = new \App\HoaHongDL();
        // //         $HoaHongDoanhSoDaiLy->customer_id = $id_customer;
        // //         $HoaHongDoanhSoDaiLy->hoahongdoanhsodaily_month = $date['mon'];
        // //         $HoaHongDoanhSoDaiLy->hoahongdoanhsodaily_year = $date['year'];
        // //         $HoaHongDoanhSoDaiLy->hoahongdoanhsodaily_tong = $capnhattong;
        // //         //
        // //         $HoaHongDoanhSoDaiLy->save();
        // //         // LƯU them ban order chi tiết 
        // //         $order_detail = new \App\Order_detail();
        // //         $order_detail->order_id = $order->order_id;
        // //         $order_detail->product_id = $cart->id;
        // //         $order_detail->detail_unitprice = $cart->price;
        // //         $order_detail->detail_quantily = $cart->qty;
        // //         $order_detail->detail_value =$cart->price * $cart->qty;
        // //         $order_detail->option =0;
        // //         $order_detail->user_id = $userid;
        // //         $order_detail->save();
        // //         // cập nhật lại trang thái customer_parent
        // //         \App\Customer::where('customer_id', $id_customer)->update(['customer_parent' => 0]);
        // //         /// sao này phát triễn chuyễn cha con là phát triễn chỗ này.
        // //     }
        // //     else 
        // //     {
        // //         $oder = new Order();
        // //         $oder->customer_id = $findCustumer->customer_id;
        // //         $oder->order_totalvalue = $totals;
        // //         $oder->order_totalvalueship = $totals;
        // //         $oder->price_shipping = 0;
        // //         $oder->order_createdate = $data;
        // //         $oder->confirm_status = 0;
        // //         $oder->confirm_date = $data;
        // //         $oder->customer_referralcode = $findCustumer->customer_code;
        // //         $oder->order_package = 1;
        // //         $oder->save();
        // //         //
        // //         $date = getdate(); 
        // //         $HoaHongDoanhSoDaiLy = new \App\HoaHongDL();
        // //         $HoaHongDoanhSoDaiLy->customer_id = $id_customer;
        // //         $HoaHongDoanhSoDaiLy->hoahongdoanhsodaily_month = $date['mon'];
        // //         $HoaHongDoanhSoDaiLy->hoahongdoanhsodaily_year = $date['year'];
        // //         if($totals == 5000000)
        // //         {
        // //             $HoaHongDoanhSoDaiLy->hoahongdoanhsodaily_tong = 5000000;
        // //         }
        // //         if($totals == 25000000)
        // //         {
        // //             $HoaHongDoanhSoDaiLy->hoahongdoanhsodaily_tong = 25000000;
        // //         }
        // //         //
        // //         $HoaHongDoanhSoDaiLy->save();
        // //     }
        // // }
        // // else {

        // //     $data_order = Order::where('customer_id', $id_customer)->first();

        // //     $order_address = new \App\Order_address();
        // //     $order_address->order_id = $data_order->order_id;
        // //     $order_address->shipping_id = 0;
        // //     $order_address->address = $request->address;
        // //     $order_address->province = $request->customer_province_id;
        // //     $order_address->district = $request->customer_district_id;
        // //     $order_address->commune = $request->custoner_commune_id;
        // //     $order_address->full_name = $request->full_name;
        // //     $order_address->email = $request->email;
        // //     $order_address->phone = $request->phone;
        // //     $order_address->note = $request->note;
        // //     $order_address->status = 0;
        // //     $order_address->user_id = $userid;
        // //     $order_address->note = $request->note;
        // //     $order_address->save();
            

        // //     $order_detail = new \App\Order_detail();
        // //     $order_detail->order_id = $data_order->order_id;
        // //     $order_detail->product_id = $cart->id;
        // //     $order_detail->detail_unitprice = $cart->price;
        // //     $order_detail->detail_quantily = $cart->qty;
        // //     $order_detail->detail_value =$cart->price * $cart->qty;
        // //     $order_detail->option =0;
        // //     $order_detail->user_id = $userid;
        // //     $order_detail->save();
        // // }
        

        
        // //$order_detail->package = $userid;
        
        // if(isset($cart))
        // {
        //     Cart::remove($cart->rowId);
        // }
        // return redirect()->back()->with('ThongBao','Đặt hàng thành công, Thông tin mua gói đã được chấp nhận đang được xác nhận.');
    }
}
