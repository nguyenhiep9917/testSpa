<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Slider;
use App\Catalogy;
use App\Catalogyservice;
use App\Product;
Use Cart;
use App\Price;
use App\Province;
use App\District;
use App\Commune;
use App\Customer;
use App\Order_address;
use App\Order_detail;
use App\User;
use App\Email;

class HomeController extends Controller
{
	function __construct()
	{
		$data_slider = Slider::all();
		view()->share('data_slider',$data_slider);
    	//data chuyền menu san pham
    	$data_menu_catalogy = Catalogy::orderBy('id', 'desc')->paginate(6);
    	view()->share('data_menu_catalogy',$data_menu_catalogy);
    	// data menu dich vu
    	$data_menu_catalogyservice = Catalogyservice::all();
    	view()->share('data_menu_catalogyservice',$data_menu_catalogyservice);
	}
    // lấy slider
    public function getdata_TrangChu()
    {
    	$data_product = Product::orderBy('id', 'desc')->paginate(16);
        $customoer = Customer::where('package_id', '>', 1)->paginate(6);
        // dich vụ
        $catalogyservice = \App\Catalogyservice::all();
        $services = \App\Services::orderBy('id', 'desc')->paginate(8);
    	return view('home', ['data_product'=>$data_product, 'customoer'=>$customoer, 'catalogyservice'=>$catalogyservice, 'services'=>$services]);
    }
    // tin tức show
    public function gettintuc()
    {
        $data = \App\Cmsnews::join('Cmssubject','Cmssubject.cmssubject_id','Cmsnews.cmssubject_id')
          ->where('Cmsnews.cmsnews_status', 1)
          ->get();
        return view('tintucs', ['data'=>$data]);
    }
    // show SALSE SALE
    public function getslashsale()
    {
        $data_productsale = Product::where('percent_review', '>', 0);
        return view('flashsale', ['data_productsale'=>$data_productsale]);
    }
    // smap 
    public function getsmap()
    {
        return view('smap');
    }
    // get laoi sp theo id menu
    public function getloaisp($id)
    {
        $data_product = Product::where('catalogy_id', $id)->paginate(18);
        return view('loaisanpham', ['data_product'=>$data_product]);
    }
    // xem thêm danh sách nhieu san pham 
    public function getxemthemProduct()
    {
        $data_product = Product::orderBy('product_createdate', 'desc')->paginate(16);
        return view('xemthemsanpham', ['data_product'=>$data_product]);
    }
    // xem them danh SÁCH danh mục 
    public function getxemthemCatalogy()
    {
         $data_Catalogy = Catalogy::orderBy('id', 'desc')->paginate(16);
        return view('xemthemdanhmuc',['data_Catalogy'=>$data_Catalogy]);
    }
    // xem them danh sách dai lý
    public function getxemthemPackage()
    {
        $package = Customer::where('package_id', '>', 1)->paginate(10);
        return view('xemthemgoidaily', ['package'=>$package]);
    }
    // xem them dich vụ
    public function getxemthemdichvu()
    {
        $services = \App\Services::orderBy('id', 'desc')->paginate(12);
        return view('xemthemdichvu', ['services'=>$services]);
    }
    // tìm kiếm 
    public function gettimkiem(Request $request)
    {
        $dataseach = $request->sesch;
        $data = \App\Product::join('catalogy','catalogy.id','product.catalogy_id')
          ->where('product.product_name', 'like', '%' . $dataseach . '%')
          ->get();
         
        return view('timkiem', ['dataseach'=>$dataseach, 'data'=>$data ]);

    }
    //
     //xem chi tiết sản phẩm
    public function getxemchitietsanpham($id)
    {
        $data = \App\Product::find($id);
        echo $data;
    }
    // mua hàng 
    public function muahang($id, $tensanpham, $gia)
    {
        $user = Auth::User();
        $Customer_code = $user->customer_code;
        $Customer = Customer::where('customer_code', $Customer_code)->first();
        $package = $Customer->package_id;

        $productBuy = Product::where('id', $id)->first();
        //$productPrice = Price::where('product_id', $id)->first();
        if($package > 1)
        {
            $arr = array(
                'id' => $id, 
                'name' => $productBuy->product_name, 
                'qty' => 1, 
                'price'=> $gia*70/100, 
                'options'=>array('img' => $productBuy->image)
            );
        }
        else {
            $arr = array(
            'id' => $id, 
            'name' => $productBuy->product_name, 
            'qty' => 1, 
            'price'=> $gia, 
            'options'=>array('img' => $productBuy->image)
            );
        }
        $row = Cart::add($arr);
        Cart::setTax($row->rowId, 0);
        $content = Cart::content();
        
        return redirect('/');
    }
    public function giohang()
    {
        Cart::tax(0,0,0);
        $content = Cart::content();
        $totals = Cart::total();
        return view('giohang', ['content' => $content, 'totals' => $totals]);
    }
    public function getxoasanpham($id)
    {
        Cart::remove($id);
        return redirect()->route('giohang');
    }
    public function getcapnhat($rowid, $qty)
    {
        if(Request::ajax())
        {
            echo "oke";
        }
    }
    //đặt hàng 
    public function getdathang($id)
    {
        $data_province = Province::all();
        $data_district = District::all();
        $data_commune = Commune::all();
        $shiptype = \App\Shiptype::all();
        $paymenttype = \App\Paymenttype::all();
        $user = Auth::User();
        $Customer_code = $user->customer_code;
        $Customer = Customer::where('customer_code', $Customer_code)->first();
        return view('dathang', ['data_province'=>$data_province, 'data_district'=>$data_district, 'data_commune'=>$data_commune, 'Customer'=>$Customer, 'shiptype'=>$shiptype, 'paymenttype'=>$paymenttype]);
    }
    public function postdathang(Request $request, $id)
    {
        $cart = Cart::content();
        $user = Auth::User();
        $iduser = $user->id;
        $totals=Cart::total(0, ',', '');
        $Customer_code = $user->customer_code;
        $Customer = Customer::where('customer_code', $Customer_code)->first();
        $id_customer = $Customer->customer_id;
        

        $payment = $request->paymenttype_name;
        $code_payments = \App\Paymenttype::where('id',$payment)->first();
        $code_payment = $code_payments->paymenttype_code;

        //
        
        //

       /// nếu như kh là thanh vien đã có hoa hong dl thì thêm orderchitiet
        if(\App\HoaHongDL::where('customer_id',$id_customer)->first())
        {
            $hoahongdoanhsodaily = \App\HoaHongDL::where('customer_id',$id_customer)->first();
            $hoahongdoanhsodaily_tong = $hoahongdoanhsodaily->hoahongdoanhsodaily_tong;
            if($code_payment == "PAYMENT_WALLET") // nếu như đai lí chọn trừ tiền từ ví thì trừ và tạo order mới và cập nhật trạng thái đã thanh toan rồi
            {
                if($Customer->package_id > 1)
                {
                    
                    // Customer::where('customer_id',$id_customer)
                    // ->update([
                    //     'customer_address' => $request->address, 
                    //     'customer_province_id' => $request->customer_province_id, 
                    //     'customer_district_id' => $request->customer_district_id,  
                    //     'custoner_commune_id' => $request->custoner_commune_id
                    // ]);
                   

                    if($hoahongdoanhsodaily_tong < $totals)
                    {
                        return redirect()->back()->with('ThongBaotienvi','Số tiền trong ví của bạn không đủ thanh toán đơn hàng này.');
                    }
                    else {
                        $capnhathoahongdoanhsodaily_tong = $hoahongdoanhsodaily_tong - $totals;
                        //echo $capnhathoahongdoanhsodaily_tong;
                        if($capnhathoahongdoanhsodaily_tong > 0)
                        {
                            \App\HoaHongDL::where('customer_id',$id_customer)->update(['hoahongdoanhsodaily_tong' => $capnhathoahongdoanhsodaily_tong]);
                            // $Order = \App\Order::where('customer_id',$id_customer)->first();
                            // $id_Order = $Order->order_id;
                            
                            $order = new \App\Order(); // sao khì trừ tiền từ ví thì tạo mới order và cập nhật trang thái đã thanh toán và trờ giao hàng.
                            $order->customer_id = $Customer->customer_id;
                            $order->order_totalvalue = $totals;
                            $order->order_totalvalueship = $totals;
                            $order->price_shipping = 0;
                            $order->order_createdate = date('Y-m-d');
                            $order->confirm_status = 0;
                            $order->ship_status = $request->shiptype_name;
                            $order->confirm_date = date('Y-m-d');
                            $order->customer_referralcode = $Customer->customer_code;
                            $order->paymenttype_id = $request->paymenttype_name;
                            $order->payment_status = 1;
                            if($order->save())
                            {
                                $email = new Email();
                                $body = view('email_template.xacnhanemail_dathang');
                                $data = [
                                    'email' => $request->email,
                                    'subject' => 'Xác nhận đơn hàng',
                                    'body' => $body
                                ];
                                $email->send( $data);
                            }
                            $id0rdernew =  $order->order_id;
                            // lưu mới orderaddress
                            $order_address = new Order_address();
                            $order_address->order_id = $id0rdernew;
                            $order_address->shipping_id = $order->ship_status;
                            $order_address->address = $request->address;
                            $order_address->province = $request->customer_province_id;
                            $order_address->district = $request->customer_district_id;
                            $order_address->commune = $request->custoner_commune_id;
                            $order_address->full_name = $request->full_name;
                            $order_address->email = $request->email;
                            $order_address->phone = $request->phone;
                            $order_address->note = $request->note;
                            $order_address->user_id = Auth::User()->id;
                            $order_address->note = $request->note;
                            $order_address->save();
                            //
                            foreach($cart as $value) // luu thông tin sản pham vào order_detail
                            {
                                $order_detail = new Order_detail();
                                $order_detail->order_id = $id0rdernew;
                                $order_detail->product_id = $value->id;
                                $order_detail->detail_unitprice = $value->price;
                                $order_detail->detail_quantily = $value->qty;
                                $order_detail->detail_value = $value->price * $value->qty;
                                $order_detail->option ="";
                                $order_detail->payment =$payment;
                                $order_detail->user_id = $iduser;
                                $order_detail->save();
                            }
                        }
                        foreach($cart as $value)
                        {
                            Cart::remove($value->rowId);
                        }
                        return redirect()->back()->with('ThongBaodonhang','Đơn hàng đã được ghi nhận.');
                    }
                    //cập nhật giá trừ từ ví cá nhân.

                }
            }
            else {
                
                $order = new \App\Order(); // đối với đại lý k trừ tiền từ ví thì tạo order binh thường như khách thướng và than htoan1 ngoài.
                $order->customer_id = $Customer->customer_id;
                $order->order_totalvalue = $totals;
                $order->order_totalvalueship = $totals;
                $order->price_shipping = 0;
                $order->order_createdate = date('Y-m-d');
                $order->confirm_status = 0;
                $order->ship_status = $request->shiptype_name;
                $order->confirm_date = date('Y-m-d');
                $order->customer_referralcode = $Customer->customer_code;
                $order->paymenttype_id = $request->paymenttype_name;
                $order->payment_status = 0;
                
                if($order->save())
                {
                    $email = new Email();
                    $body = view('email_template.xacnhanemail_dathang');
                    $data = [
                        'email' => $request->email,
                        'subject' => 'Xác nhận đơn hàng',
                        'body' => $body
                    ];
                    $email->send( $data);
                }
                $id_ordernew =  $order->order_id;
                // lưu mới orderaddress
                $order_address = new Order_address();
                $order_address->order_id = $id_ordernew;
                $order_address->shipping_id = $order->ship_status;
                $order_address->address = $request->address;
                $order_address->province = $request->customer_province_id;
                $order_address->district = $request->customer_district_id;
                $order_address->commune = $request->custoner_commune_id;
                $order_address->full_name = $request->full_name;
                $order_address->email = $request->email;
                $order_address->phone = $request->phone;
                $order_address->note = $request->note;
                $order_address->user_id = Auth::User()->id;
                $order_address->note = $request->note;
                $order_address->save();
                //
                foreach($cart as $value)
                {
                    $order_detail = new Order_detail();
                    $order_detail->order_id = $id_ordernew;
                    $order_detail->product_id = $value->id;
                    $order_detail->detail_unitprice = $value->price;
                    $order_detail->detail_quantily = $value->qty;
                    $order_detail->detail_value = $value->price * $value->qty;
                    $order_detail->option ="";
                    $order_detail->payment =$payment;
                    $order_detail->user_id = $iduser;
                    $order_detail->save();
                }
                 foreach($cart as $value)
                {
                    Cart::remove($value->rowId);
                }
                return redirect()->back()->with('ThongBaodonhang','Đơn hàng đã được ghi nhận.');
            }
        }
        // đối với khách hàng thường
        else {

          //  $idCustomer = $Order->customer_id;

            if(\App\Order::where('customer_id',$id_customer)->first())
            {
                $order = new \App\Order(); // đối với khách hàng binh thường thì toa order than toan binh thường
                $order->customer_id = $Customer->customer_id;
                $order->order_totalvalue = $totals;
                $order->order_totalvalueship = $totals;
                $order->price_shipping = 0;
                $order->order_createdate = date('Y-m-d');
                $order->confirm_status = 0;
                $order->ship_status = $request->shiptype_name;
                $order->confirm_date = date('Y-m-d');
                $order->customer_referralcode = $Customer->customer_code;
                $order->paymenttype_id = $request->paymenttype_name;
                $order->payment_status = 0;
                
                if($order->save())
                {
                    $email = new Email();
                    $body = view('email_template.xacnhanemail_dathang');
                    $data = [
                        'email' => $request->email,
                        'subject' => 'Xác nhận đơn hàng',
                        'body' => $body
                    ];
                    $email->send( $data);
                }
                $id_ordernewkhthuongdacothongtintutruocvacodatabenOrderaddress =  $order->order_id;
                // lưu mới orderaddress
                $order_address = new Order_address();
                $order_address->order_id = $id_ordernewkhthuongdacothongtintutruocvacodatabenOrderaddress;
                $order_address->shipping_id = $order->ship_status;
                $order_address->address = $request->address;
                $order_address->province = $request->customer_province_id;
                $order_address->district = $request->customer_district_id;
                $order_address->commune = $request->custoner_commune_id;
                $order_address->full_name = $request->full_name;
                $order_address->email = $request->email;
                $order_address->phone = $request->phone;
                $order_address->note = $request->note;
                $order_address->user_id = Auth::User()->id;
                $order_address->note = $request->note;
                $order_address->save();
                //
                foreach($cart as $value)
                {
                    $order_detail = new Order_detail();
                    $order_detail->order_id = $id_ordernewkhthuongdacothongtintutruocvacodatabenOrderaddress;
                    $order_detail->product_id = $value->id;
                    $order_detail->detail_unitprice = $value->price;
                    $order_detail->detail_quantily = $value->qty;
                    $order_detail->detail_value = $value->price * $value->qty;
                    $order_detail->option ="";
                    $order_detail->payment =$payment;
                    $order_detail->user_id = $iduser;
                    $order_detail->save();
                }

                Order_address::where('user_id',$iduser)->update(['updatedate' =>  date('Y-m-d H:i:s')]); 
                // nêu như phát triển tạo bản them dia chỉ mới cap nhật địa chỉ giao hàng mới
                foreach($cart as $value)
                {
                    Cart::remove($value->rowId);
                }
                return redirect()->back()->with('ThongBaodonhang','Đơn hàng đã được ghi nhận.');
            }
            else {
                $order = new \App\Order(); // đối với khách hàng binh thường thì toa order than toan binh thường
                $order->customer_id = $Customer->customer_id;
                $order->order_totalvalue = $totals;
                $order->order_totalvalueship = $totals;
                $order->price_shipping = 0;
                $order->order_createdate = date('Y-m-d');
                $order->confirm_status = 0;
                $order->ship_status = $request->shiptype_name;
                $order->confirm_date = date('Y-m-d');
                $order->customer_referralcode = $Customer->customer_code;
                $order->paymenttype_id = $request->paymenttype_name;
                $order->payment_status = 0;
                if($order->save())
                {
                    $email = new Email();
                    $body = view('email_template.xacnhanemail_dathang');
                    $data = [
                        'email' => $request->email,
                        'subject' => 'Xác nhận đơn hàng',
                        'body' => $body
                    ];
                    $email->send( $data);
                }
                $id_ordernewkhthuongOrderaddress =  $order->order_id;
                //tao order_address
                $order_address = new Order_address();
                $order_address->order_id = $id_ordernewkhthuongOrderaddress;
                $order_address->shipping_id = $order->ship_status;
                $order_address->address = $request->address;
                $order_address->province = $request->customer_province_id;
                $order_address->district = $request->customer_district_id;
                $order_address->commune = $request->custoner_commune_id;
                $order_address->full_name = $request->full_name;
                $order_address->email = $request->email;
                $order_address->phone = $request->phone;
                $order_address->note = $request->note;
                $order_address->user_id = Auth::User()->id;
                $order_address->note = $request->note;
                $order_address->save();
                // tạo order_detail
                foreach($cart as $value)
                {
                    $order_detail = new Order_detail();
                    $order_detail->order_id = $id_ordernewkhthuongOrderaddress;
                    $order_detail->product_id = $value->id;
                    $order_detail->detail_unitprice = $value->price;
                    $order_detail->detail_quantily = $value->qty;
                    $order_detail->detail_value = $value->price * $value->qty;
                    $order_detail->option ="";
                    $order_detail->payment =$payment;
                    $order_detail->user_id = $iduser;
                    $order_detail->save();
                }
            }

            Order_address::where('user_id',$iduser)->update(['updatedate' =>  date('Y-m-d H:i:s')]);
                foreach($cart as $value)
                {
                    Cart::remove($value->rowId);
                }
            return redirect()->back()->with('ThongBaodonhang','Đơn hàng đã được ghi nhận.');
        }


        // if($Customer->package_id > 1)
        // {
        //     $id_customer = $Customer->customer_id;
        //     Customer::where('customer_id',$id_customer)->update(['customer_address' => $request->address, 'customer_province_id' => $request->customer_province_id, 'customer_district_id' => $request->customer_district_id,  'custoner_commune_id' => $request->custoner_commune_id]);
        //      $iduser_Order_detail = \App\Order_detail::where('user_id',$iduser)->first(); // cập nhật giá trừ từ ví cá nhân.
        //     if(isset($iduser_Order_detail))
        //       {
        //         $id_user = $iduser_Order_detail->user_id;
        //         $detail_value = $iduser_Order_detail->detail_value;
        //         // trừ tiền ví cá nhận ki mua sản phẩm 
        //         $totals=Cart::total(0, ',', '');
        //         $Detail_value = number_format($detail_value, 0, ',', '');
        //         $capnhatvicanhan = $Detail_value-$totals;
                
        //         if($capnhatvicanhan > 0)
        //         {
        //             // $iduser_Order_detail->detail_value = $capnhatvicanhan;
        //             // $iduser_Order_detail->save();
        //             Order_detail::where('user_id',$id_user)->update(['detail_value' => $capnhatvicanhan]);
        //         }
        //       }
               
        //     $allDataOrder_address = Order_address::where('user_id', $iduser)->first(); // lưu mả order vào oerder_detail
        //     if($allDataOrder_address)
        //     {
        //         foreach($cart as $value)
        //         {
        //             $order_detail = new Order_detail();
        //             $order_detail->order_id = $allDataOrder_address->order_id;
        //             $order_detail->product_id = $value->id;
        //             $order_detail->detail_unitprice = $value->price;
        //             $order_detail->detail_quantily = $value->qty;
        //             $order_detail->detail_value = $value->price * $value->qty;
        //             $order_detail->option ="";
        //             $order_detail->save();
        //         }

        //         $email = new Email();
        //         $body = view('email_template.xacnhanemail_dathang', ['Customer' => $Customer]);
        //         $data = [
        //             'email' => $allDataOrder_address->email,
        //             'subject' => 'Thông báo xác nhận đơn hàng',
        //             'body' => $body
        //         ];
        //         $email->send( $data);
        //         foreach($cart as $value)
        //         {
        //             Cart::remove($value->rowId);
        //         }

        //     }
        //     else
        //     {
        //         $order_address = new Order_address();
        //         $order_address->order_id = "B"."_".str_random(3);
        //         $order_address->shipping_id = $request->shiptype_name;
        //         $order_address->address = $request->address;
        //         $order_address->province = $request->customer_province_id;
        //         $order_address->district = $request->customer_district_id;
        //         $order_address->commune = $request->custoner_commune_id;
        //         $order_address->full_name = $request->full_name;
        //         $order_address->email = $request->email;
        //         $order_address->phone = $request->phone;
        //         $order_address->note = $request->note;
        //         $order_address->user_id = Auth::User()->id;
        //         $order_address->note = $request->note;
        //         $order_address->save();

        //         if ($order_address->save()){
        //             // send mail
        //             $email = new Email();
        //             $body = view('email_template.xacnhanemail_dathang', ['Customer' => $Customer]);
        //             $data = [
        //                 'email' => $order_address->email,
        //                 'subject' => 'Thông báo xác nhận đơn hàng',
        //                 'body' => $body
        //             ];
        //             $email->send( $data);
        //         }
        //         foreach($cart as $value)
        //         {
        //             $order_detail = new Order_detail();
        //             $order_detail->order_id = $order_address->order_id;
        //             $order_detail->product_id = $value->id;
        //             $order_detail->detail_unitprice = $value->price;
        //             $order_detail->detail_quantily = $value->qty;
        //             $order_detail->detail_value = $value->price * $value->qty;
        //             $order_detail->option ="";
        //             $order_detail->staus = 0;
        //             $order_detail->save();
        //         }
                
               

        //         foreach($cart as $value)
        //         {
        //             Cart::remove($value->rowId);
        //         }
            
        //      }
        // }
        // else
        // {

        //    //  $users = \App\Order_detail::groupBy('product_id')
        //    //      ->sum('detail_unitprice');
        //    // echo  $users;
        // }



       
        

       
        // Order_address::where('user_id',$iduser)->update(['updatedate' =>  date('Y-m-d H:i:s')]);
        // return redirect()->back()->with('ThongBaothanhtoan','Đặt hàng thành công, hóa đơn của bạn đang được xác nhận.');
    }



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
