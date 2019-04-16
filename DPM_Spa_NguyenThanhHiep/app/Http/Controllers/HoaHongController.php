<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HoaHongController extends Controller
{
    // public function gethoahongtongdaily()
    // {
    // 	return view('admin.hoahong.hoahongtongdaily');
    // }
    // hoa hồng liệu trình
    public function gethoahonglieutrinh()
    {
    	return view('admin.hoahong.LieuTrinh.hoahonglieutrinh');
    }
    //
    public function gethoahongtongdailylieutrinh()
    {
        return view('admin.hoahong.LieuTrinh.hoahonglieutrinh');
    }
    //
    public function gethoahongdoanhsodaily()
    {
        $htmHoaHongDoanhSoDaiLy = '';
        $childrens = \App\Customer::where("customer_parent", 0)->get();
        if ($childrens->count() > 0){
            foreach ($childrens as $customer) {
                $hoahong = new  \App\HoaHongDoanhSoDaiLy;
                $htmHoaHongDoanhSoDaiLy .= $hoahong->cayHeThong($customer);
            }
        }

        // tính hoa hồng.  // tính hoa hồng doanh số dại lý // cập nhật theo tháng. 
        $date = getdate(); 
        //echo $date['mday'];
        //$date['mday']
        // if($date['mday'] == 15)
        // {
        //     echo "sd";
        // }
        // else {
            
        // }

        return view('admin.hoahong.DaiLy.hoahongdoanhsodaily', ['htmlCayHeThongHoaHong' => $htmHoaHongDoanhSoDaiLy ]);
    }
    //
    // xem danh sach hoa hồng dai lý
    public function getdanhsachhoahongdanhsachdaili()
    {
        $dataDL = \App\HoaHongDL::all();
        $order = \App\Order::all();
        $customer = \App\Customer::all();
        
        return view('admin.hoahong.DaiLy.danhsachdoanhsodaily', ['dataDL'=>$dataDL, 'order'=>$order, 'customer'=>$customer]);
    }

    // xem thông tin các cap con 
    public function getxemcapcon($id)
    {
        $CustomerCon = \App\Customer::where('customer_parent', $id)->get();
        $Customer = \App\Customer::all();
        return view('admin.hoahong.DaiLy.doanhsoHHDL.xemchitietcapcon', ['CustomerCon'=>$CustomerCon, 'Customer'=>$Customer ]);
    }

















    public function gethoahongtongdaily()
    {
        $htmHoaHongDoanhSoDaiLy = '';
        $childrens = \App\Customer::where("customer_parent", 0)->get();
        if ($childrens->count() > 0){
            foreach ($childrens as $customer) {
                $hoahong = new  \App\HoaHongDoanhSoDaiLy;
                $htmHoaHongDoanhSoDaiLy .= $hoahong->cayHeThong($customer);
            }
        }

        return view('admin.hoahong.DaiLy.hoahongtongdaily', ['htmlCayHeThongHoaHong' => $htmHoaHongDoanhSoDaiLy ]);
    }


    // public function getcay()
    // {
    // 	return view('admin.hoahong.view_master');
    // }
}
