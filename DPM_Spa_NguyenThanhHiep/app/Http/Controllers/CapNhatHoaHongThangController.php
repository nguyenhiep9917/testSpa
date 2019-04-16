<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CapNhatHoaHongThangController extends Controller
{
    //
    public function capnhatHoaHong()
    {
        $dataDL = \App\HoaHongDL::all();
        $customer = \App\Customer::all();
        
    	// $Tongdonhang = \App\Tongdonhang::all();
    	// $dataCustomer = \App\Customer::all();
    	// foreach ($dataCustomer as $value) {
    	// 	foreach ($Tongdonhang as $val) {
    	// 		if($val->id_customer == $value->customer_id)
    	// 		{
    	// 			\App\Tongdonhang::where('id_customer', $val->id_customer)->update(['tongtientrongvi' => $request->address, 'trongtienmuadonhang' => $request->customer_province_id, 'thangcapnhat' => $request->customer_district_id,  'namcapnhat' => $request->custoner_commune_id, 'soluongsp']);

    	// 		}
    	// 	}
    	// 	echo $value->customer_id; echo '<br>';
    	// }
        return view('admin.CapNhatHoaHong.capnhathoahongThang', ['dataDL'=>$dataDL, 'customer'=>$customer ]);
    }
    public function getCapNhatCapCon($id)
    {
        session()->put('capnhat', '1');
        // echo session('capnhat');
        $idCustomerPranent = $id;
        
        $nameDLCha = \App\Customer::where('customer_id', $id)->first();
        $nameDL = $nameDLCha->customer_username;
        $CustomerCon = \App\Customer::where('customer_parent', $id)->get();
        $Customer = \App\Customer::all();

        return view('admin.CapNhatHoaHong.capnhattheocap', ['CustomerCon'=>$CustomerCon, 'Customer'=>$Customer, 'idCustomerPranent'=>$idCustomerPranent, 'nameDL'=>$nameDL ]);
    }
    public function CapNhatTheoTungCap($idcha, $idcon, $tongdoanhthu, $bac)
    {
        

        $hoahongdaily_percentf1 = \App\Setting::where('key', "hoahongdaily_percentf1")->first();
        $hoahongdaily_percentf2 = \App\Setting::where('key', "hoahongdaily_percentf2")->first();
        $hoahongdaily_percentf3 = \App\Setting::where('key', "hoahongdaily_percentf3")->first();
        $hoahongdaily_percentf4 = \App\Setting::where('key', "hoahongdaily_percentf4")->first();
        $hoahongdaily_percentf5 = \App\Setting::where('key', "hoahongdaily_percentf5")->first();

        // phần trăm hoa hồng

        $percentf1 = $hoahongdaily_percentf1->content/100;
        $percentf2 = $hoahongdaily_percentf2->content/100;
        $percentf3 = $hoahongdaily_percentf3->content/100;
        $percentf4 = $hoahongdaily_percentf4->content/100;
        $percentf5 = $hoahongdaily_percentf5->content/100;

        // cập nhật hoa hồng doanh số đại lý
        $Datacha = \App\Customer::where('customer_id', $idcha)->first();
        $Datahoahong = \App\HoaHongDL::where('customer_id', $idcha)->first();
// bậc 1

        if($bac == 1)
        {
            $hoahongF1 = $tongdoanhthu * $percentf1;
            // lấy hoa hong f1 r cong tiep nếu có 

            $doanhsohientai = $Datahoahong->hoahongdoanhsodaily_doanhsof1; // doanh số F4 trong CSDL
            $TongDoanhSo = $doanhsohientai + $tongdoanhthu;



            $hoahonghienco = $Datahoahong->hoahongdoanhsodaily_hoahongtrenf1;
            $hoahonghiencoCapNhat = $hoahonghienco + $hoahongF1;
            
            \App\HoaHongDL::where('customer_id', $idcha)->update([
                'hoahongdoanhsodaily_percentf1'=>$percentf1, 
                'hoahongdoanhsodaily_doanhsof1'=>$TongDoanhSo,
                'hoahongdoanhsodaily_hoahongtrenf1'=>$hoahonghiencoCapNhat

            ]);

            // cập naht65 trang thay đã được cap nhật từ hoa hong nen otder này sẽ tắt để tính cho các order tháng sao cap nhật tiếp 

            $orderCuaDaiLy = \App\Order::where('customer_id', $idcon)
                                    ->where('doneupdata', 0)
                                    ->where('paymenttype_id', '<', 8)
                                    ->get();
            foreach ($orderCuaDaiLy as $value) {
                echo $value->order_totalvalue;
                \App\Order::where('customer_id', $idcon)->update(['doneupdata'=>1]);
            }
            /// lấy du lieu hoa hong cong lai cap nhật 
            $hoahong1 = $Datahoahong->hoahongdoanhsodaily_hoahongtrenf1;
            $tonghoahong = $Datahoahong->hoahongdoanhsodaily_TongHoaHong;
            


            $tongconghoahongCuaCha = $tonghoahong + $hoahongF1;
           // $hoahongphantram = $tongdoanhthu * $percentf1;
           // $congthemhoahongg = $hoahong1 + $hoahongF1;
           // cập nhật tổng hoa hồng
             \App\HoaHongDL::where('customer_id', $idcha)->update([
                'hoahongdoanhsodaily_TongHoaHong'=>$tongconghoahongCuaCha
            ]);

       //      echo '<br>';
       // echo $hoahongF1;
       //  echo '<br>';
       //  echo $percentf1;
       //  echo '<br>';
       //  echo $tongdoanhthu;
       //  echo '<br>sdfsd';
       //  echo $hoahonghienco;
       //  echo '<br>';
       //  echo $hoahonghiencoCapNhat;
       //  echo '<br> dsds';
       //  echo $tongconghoahongCuaCha;
       //  echo '<br>';
       //  echo $tonghoahong;

             return redirect()->back();

        }
// bậc 2
        if($bac == 2)
        {
            $hoahongF2 = $tongdoanhthu * $percentf2;
            // lấy hoa hong f1 r cong tiep nếu có 

            $doanhsohientai = $Datahoahong->hoahongdoanhsodaily_doanhsof2; // doanh số F4 trong CSDL
            $TongDoanhSo = $doanhsohientai + $tongdoanhthu;

            $hoahonghienco = $Datahoahong->hoahongdoanhsodaily_hoahongtrenf2;
            $hoahonghiencoCapNhat = $hoahonghienco + $hoahongF2;
            
            \App\HoaHongDL::where('customer_id', $idcha)->update([
                'hoahongdoanhsodaily_percentf2'=>$percentf2, 
                'hoahongdoanhsodaily_doanhsof2'=>$TongDoanhSo,
                'hoahongdoanhsodaily_hoahongtrenf2'=>$hoahonghiencoCapNhat

            ]);



             // cập naht65 trang thay đã được cap nhật từ hoa hong nen otder này sẽ tắt để tính cho các order tháng sao cap nhật tiếp 

            $orderCuaDaiLy = \App\Order::where('customer_id', $idcon)
                                    ->where('doneupdata', 0)
                                    ->where('paymenttype_id', '<', 8)
                                    ->get();
            foreach ($orderCuaDaiLy as $value) {
                echo $value->order_totalvalue;
                \App\Order::where('customer_id', $idcon)->update(['doneupdata'=>1]);
            }

            /// lấy du lieu hoa hong cong lai cap nhật 
            $tonghoahong = $Datahoahong->hoahongdoanhsodaily_TongHoaHong;
            $tongconghoahongCuaCha = $tonghoahong + $hoahongF2;

            // $hoahong2 = $Datahoahong->hoahongdoanhsodaily_hoahongtrenf2;
            // $hoahongphantram = $tongdoanhthu * $percentf2;
            // $congthemhoahongg = $hoahong2 + $hoahongphantram;
          //  cập nhật tổng hoa hồng
             \App\HoaHongDL::where('customer_id', $idcha)->update([
                'hoahongdoanhsodaily_TongHoaHong'=>$tongconghoahongCuaCha
            ]);




    
         return redirect()->back();
        }
// bậc 3
        if($bac == 3)
        {
            // hoa hồng f3
            $hoahongF3 = $tongdoanhthu*$percentf3;

            $doanhsohientai = $Datahoahong->hoahongdoanhsodaily_doanhsof3; // doanh số F4 trong CSDL
            $TongDoanhSo = $doanhsohientai + $tongdoanhthu;


            // lấy hoa hong f1 r cong tiep nếu có 
            $hoahonghienco = $Datahoahong->hoahongdoanhsodaily_hoahongtrenf3;
            $hoahonghiencoCapNhat = $hoahonghienco + $hoahongF3;
            
            \App\HoaHongDL::where('customer_id', $idcha)->update([
                'hoahongdoanhsodaily_percentf3'=>$percentf3, 
                'hoahongdoanhsodaily_doanhsof3'=>$TongDoanhSo,
                'hoahongdoanhsodaily_hoahongtrenf3'=>$hoahonghiencoCapNhat

            ]);

             // cập naht65 trang thay đã được cap nhật từ hoa hong nen otder này sẽ tắt để tính cho các order tháng sao cap nhật tiếp 

            $orderCuaDaiLy = \App\Order::where('customer_id', $idcon)
                                    ->where('doneupdata', 0)
                                    ->where('paymenttype_id', '<', 8)
                                    ->get();
            foreach ($orderCuaDaiLy as $value) {
                echo $value->order_totalvalue;
                \App\Order::where('customer_id', $idcon)->update(['doneupdata'=>1]);
            }
            /// lấy du lieu hoa hong cong lai cap nhật 
            $tonghoahong = $Datahoahong->hoahongdoanhsodaily_TongHoaHong;
            $tongconghoahongCuaCha = $tonghoahong + $hoahongF3;
           // $hoahongphantram = $tongdoanhthu * $percentf3;
            // $congthemhoahongg = $hoahong3 + $hoahongF3;
            // // cập nhật tổng hoa hồng
             \App\HoaHongDL::where('customer_id', $idcha)->update([
                'hoahongdoanhsodaily_TongHoaHong'=>$tongconghoahongCuaCha
            ]);

            return redirect()->back();
        }

// bậc 4
        if($bac == 4)
        {
            // hoa hồng f3
            $hoahongF4 = $tongdoanhthu*$percentf4;
            $doanhsohientai = $Datahoahong->hoahongdoanhsodaily_doanhsof4; // doanh số F4 trong CSDL
            $TongDoanhSo = $doanhsohientai + $tongdoanhthu;

            // lấy hoa hong f1 r cong tiep nếu có 
            $hoahonghienco = $Datahoahong->hoahongdoanhsodaily_hoahongtrenf4;
            $hoahonghiencoCapNhat = $hoahonghienco + $hoahongF4;
           
            \App\HoaHongDL::where('customer_id', $idcha)->update([
                'hoahongdoanhsodaily_percentf4'=>$percentf4, 
                'hoahongdoanhsodaily_doanhsof4'=>$TongDoanhSo,
                'hoahongdoanhsodaily_hoahongtrenf4'=>$hoahonghiencoCapNhat

            ]);

             // cập naht65 trang thay đã được cap nhật từ hoa hong nen otder này sẽ tắt để tính cho các order tháng sao cap nhật tiếp 

            $orderCuaDaiLy = \App\Order::where('customer_id', $idcon)
                                    ->where('doneupdata', 0)
                                    ->where('paymenttype_id', '<', 8)
                                    ->get();
            foreach ($orderCuaDaiLy as $value) {
                echo $value->order_totalvalue;
                \App\Order::where('customer_id', $idcon)->update(['doneupdata'=>1]);
            }
            /// lấy du lieu hoa hong cong lai cap nhật 
            $tonghoahong = $Datahoahong->hoahongdoanhsodaily_TongHoaHong;
            $tongconghoahongCuaCha = $tonghoahong + $hoahongF4;
           // $hoahongphantram = $tongdoanhthu * $percentf3;
            // $congthemhoahongg = $hoahong3 + $hoahongF3;
            // // cập nhật tổng hoa hồng
             \App\HoaHongDL::where('customer_id', $idcha)->update([
                'hoahongdoanhsodaily_TongHoaHong'=>$tongconghoahongCuaCha
            ]);
            return redirect()->back();
        }
// bậc 5
        if($bac == 5)
        {

            // hoa hồng f3
            $hoahongF5 = $tongdoanhthu*$percentf5;
            $doanhsohientai = $Datahoahong->hoahongdoanhsodaily_doanhsof5; // doanh số F4 trong CSDL
            $TongDoanhSo = $doanhsohientai + $tongdoanhthu;

            // lấy hoa hong f1 r cong tiep nếu có 
            $hoahonghienco = $Datahoahong->hoahongdoanhsodaily_hoahongtrenf5;
            $hoahonghiencoCapNhat = $hoahonghienco + $hoahongF5;
           
            \App\HoaHongDL::where('customer_id', $idcha)->update([
                'hoahongdoanhsodaily_percentf5'=>$percentf5, 
                'hoahongdoanhsodaily_doanhsof5'=>$TongDoanhSo,
                'hoahongdoanhsodaily_hoahongtrenf5'=>$hoahonghiencoCapNhat

            ]);

             // cập naht65 trang thay đã được cap nhật từ hoa hong nen otder này sẽ tắt để tính cho các order tháng sao cap nhật tiếp 

             $orderCuaDaiLy = \App\Order::where('customer_id', $idcon)
                                    ->where('doneupdata', 0)
                                    ->where('paymenttype_id', '<', 8)
                                    ->get();
            foreach ($orderCuaDaiLy as $value) {
                echo $value->order_totalvalue;
                \App\Order::where('customer_id', $idcon)->update(['doneupdata'=>1]);
            }
            /// lấy du lieu hoa hong cong lai cap nhật 
            $tonghoahong = $Datahoahong->hoahongdoanhsodaily_TongHoaHong;
            $tongconghoahongCuaCha = $tonghoahong + $hoahongF5;
           
             \App\HoaHongDL::where('customer_id', $idcha)->update([
                'hoahongdoanhsodaily_TongHoaHong'=>$tongconghoahongCuaCha
            ]);
            
            return redirect()->back();
        }

    }
}
