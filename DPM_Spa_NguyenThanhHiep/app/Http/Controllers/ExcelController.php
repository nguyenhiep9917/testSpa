<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use DB;
class ExcelController extends Controller
{
    // xuất excel sản phẩm
    public function Excel()
    {
    	$product_data = DB::table('product')->get()->toArray();
    	$product_array[] =array('ID', 'Tên sản phẩm', 'Mô tả ngắn', 'Mô tả', 'Loại', 'Ngày thêm', 'Ngày cập nhật', 'Trạng thái', 'ID người dùng thêm', 'Link', 'Lượt xem', 'Đánh giá', 'Hình ảnh', 'Giá', 'Giá khuyến mãi');
    	foreach ($product_data as $product) {
    		$product_array[] = array(
    			'ID' => $product->catalogy_id,
    			'Tên sản phẩm' => $product->product_name,
    			'Mô tả ngắn' => $product->product_short_desciption,
    			'Mô tả' => $product->product_desciption,
    			'Loại' => $product->product_type,
    			'Ngày thêm' => $product->product_createdate,
    			'Ngày cập nhật' => $product->product_updatedate,
    			'Trạng thái' => $product->product_status,
    			'ID người dùng thêm' => $product->user_id,
    			'Link' => $product->plug_url,
    			'Lượt xem' => $product->total_view,
    			'Đánh giá' => $product->percent_review,
    			'Hình ảnh' => $product->image,
    			'Giá' => $product->price_value,
    			'Giá khuyến mãi' => $product->price_special
    		);
    	}
    	Excel::create('Product data', function($excel) use ($product_array){
    		$excel->setTitle('Product data');
    		$excel->sheet('Product data', function($sheet) use ($product_array){
    			$sheet->fromArray($product_array, null, 'A1', false, false);
    		});
    	})->download('xlsx');
    }
    // xuất excel dịch vụ 
    public function ExcelDichVu()
    {
    	$sevice_data = DB::table('services')->get()->toArray();
    	$sevice_array[] =array('ID', 'Tên dịch vụ', 'Mô tả ngắn', 'Mô tả', 'Hình ảnh', 'Trạng thái mới', 'Tổng thời gian', 'Giá thường', 'Giá khuyến mãi', 'Ngày bất đầu', 'Ngày kết thúc', 'Ngày tạo', 'Ngày cập nhật', 'ID người tạo', 'Trạng thái', 'Link', 'Tổng lượt xem', 'Đánh giá', 'Danh mục' );
    	foreach ($sevice_data as $sevice) {
    		$sevice_array[] = array(
    			'ID' => $sevice->id,
    			'Tên dịch vụ' => $sevice->service_name,
    			'Mô tả ngắn' => $sevice->service_shortdescription,
    			'Mô tả' => $sevice->service_longdescription,
    			'Hình ảnh' => $sevice->service_images,
    			'Trạng thái mới' => $sevice->service_isnew,
    			'Tổng thời gian' => $sevice->total_times,
    			'Giá thường' => $sevice->service_normalprice,
    			'Giá khuyến mãi' => $sevice->service_specialprice,
    			'Ngày bất đầu' => $sevice->service_datesellfrom,
    			'Ngày kết thúc' => $sevice->service_datesellto,
    			'Ngày tạo' => $sevice->service_creadate,
    			'Ngày cập nhật' => $sevice->service_updatedate,
    			'ID người tạo' => $sevice->user_id,
    			'Trạng thái' => $sevice->service_status,
    			'Link' => $sevice->plug_url,
    			'Tổng lượt xem' => $sevice->total_view,
    			'Đánh giá' => $sevice->percent_review,
    			'Danh mục' => $sevice->service_id
    		);
    	}
    	Excel::create('Sevice data', function($excel) use ($sevice_array){
    		$excel->setTitle('Sevice data');
    		$excel->sheet('Sevice data', function($sheet) use ($sevice_array){
    			$sheet->fromArray($sevice_array, null, 'A1', false, false);
    		});
    	})->download('xlsx');
    }
    // xuất excel don hàng
    public function ExcelOrder()
    {
    	$data_Order_address = DB::table('order_address')->get()->toArray();
        $data_Order_detail =  DB::table('order_detail')->get()->toArray();
        $data_Order = DB::table('order')->get()->toArray();
        $find_customer = DB::table('customer')->get()->toArray();
        $product = DB::table('product')->get()->toArray();
        $order_array[] =array('ID', 'Tên khách hàng', 'Số điện thoại', 'Ngày mua', 'Tổng tiền');
    	foreach ($data_Order as $order) {
    		foreach($find_customer as $valcustomer)
    			{
    				if($order->customer_id == $valcustomer->customer_id)
    				{
    					$tenkh = $valcustomer->customer_username;
    				}
    			}

    		foreach($find_customer as $valcustomer)
    			{
    				if($order->customer_id == $valcustomer->customer_id)
    				{
    					$sdt = $valcustomer->customer_phone;
    				}
    			}

    		// foreach($data_Order_detail as $val)
    		// 	{
    		// 		if($order->order_id == $val->order_id)
    		// 		{
    		// 			foreach($product as $vlProduct)
    		// 			{
    		// 				if($val->product_id == $vlProduct->id)
    		// 				{
    		// 					$sanpham = count($vlProduct);
    		// 				}
    		// 			}
    		// 		}
    		// 	}


    		$order_array[] = array(
    			'ID' => $order->order_id,
    			'Tên khách hàng' => $tenkh,
    			'Số điện thoại' => $sdt,
    			//'Sản phẩm' => $sanpham,
    			'Ngày mua' => $order->order_createdate,
    			'Tổng tiền' => $order->order_totalvalue
    		);
    	}
    	Excel::create('order data', function($excel) use ($order_array){
    		$excel->setTitle('order data');
    		$excel->sheet('order data', function($sheet) use ($order_array){
    			$sheet->fromArray($order_array, null, 'A1', false, false);
    		});
    	})->download('xlsx');
    }
    
}
