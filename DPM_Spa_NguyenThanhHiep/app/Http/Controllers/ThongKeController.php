<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ThongKeController extends Controller
{
    //
    public function getbaocao()
    {
    	return view('admin.thongke.doanhso');
    }
    public function traketquabaocao(Request $request)
    {
        $timestamp = strtotime($request->startday);
        $timestamps = strtotime($request->endday);
         $data_Order = \App\Order::all();
         

        $data_Order_address = \App\Order_address::all();
        $data_Order_detail = \App\Order_detail::all();
        $find_customer = \App\Customer::all();
        $product = \App\Product::all();
         return view('admin.thongke.ketquathongke',['timestamp'=>$timestamp, 'timestamps'=>$timestamps, 'data_Order'=>$data_Order, 'data_Order_address'=>$data_Order_address, 'data_Order_detail'=>$data_Order_detail, 'find_customer'=>$find_customer, 'product'=>$product ]);

    }
}
