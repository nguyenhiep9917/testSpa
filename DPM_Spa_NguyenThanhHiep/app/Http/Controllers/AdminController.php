<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getTrangChu()
    {
    	$data_Order_detail = \App\HoaHongDL::orderBy('hoahongdoanhsodaily_tong', 'DESC')->paginate(6);
        $order = \App\Order::all();
        $orderPayments = \App\Order::where('payment_status', 1)->get();
        $customer = \App\Customer::all();
        $dataDL = \App\HoaHongDL::all();
        $customerPackage0 = \App\Customer::where('package_id', 0)->get();
        $customerPackage1 = \App\Customer::where('package_id', 1)->get();
        $customerPackage2 = \App\Customer::where('package_id', 2)->get();
    	return view('admin.trangchu', ['data_Order_detail'=>$data_Order_detail, 'order'=>$order, 'customer'=>$customer, 'dataDL'=>$dataDL, 'orderPayments'=>$orderPayments, 'customerPackage0'=>$customerPackage0, 'customerPackage1'=>$customerPackage1, 'customerPackage2'=>$customerPackage2 ]);
    }
}
