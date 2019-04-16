<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Price;
use App\Product;
use  App\Package;
use App\Setting;

class CaiDatController extends Controller
{
	// danh sách giá bán
    public function getgiaban()
    {
    	$list_data = Price::orderBy('id','asc')->get();
    	$data_product = Product::all();
    	return view('admin.caidat.GiaBan.giaban',['list_data'=>$list_data, 'data_product'=>$data_product]);
    }
    // sửa giá bán
    public function getgiaban_Sua($id)
    {
    	$data_edit = Price::find($id);
    	$data_product_edit = Product::all();
    	return view('admin.caidat.GiaBan.suagiaban',['data_edit'=>$data_edit, 'data_product_edit'=>$data_product_edit]);
    }
    //
    public function postgiaban_Sua(Request $request, $id)
    {
    	$data_edit = Price::find($id);
		$data_idproduct = $data_edit->product_id;
		$data_price_agency = $data_edit->price_agency;

    	$data_edit->product_id = $data_idproduct;
		$data_edit->price_agency = $data_price_agency;
    	$data_edit->price_value = $request->price_value;
    	$data_edit->price_special = $request->price_special;
    	$data_edit->price_applydate = $request->price_applydate;
    	$data_edit->save();
    	return redirect('admin/caidat/giaban')->with(['flash_lever'=>"success",'flash_message'=>'Cập nhật thành công!']);
    }
    // delete giá bán đồng thời xóa luôn sản tất cả sản phẩm có giá đó
    public function getgiaban_Xoa($id)
    {
    	$data_delete = Price::find($id);
    	$id_product_price = $data_delete->product_id;
    	$data_delete->delete();

    	$data_product = Product::where('id',$id_product_price);
    	$data_product->delete();
    	return redirect('admin/caidat/giaban')->with(['flash_lever'=>"success",'flash_message'=>'Xóa thành công!']);
    }
    // list Package
    public function getgoidaily()
    {
    	$data_Package_FREE = Package::where('package_key','FREE')->first();
    	$data_Package_NORMAL = Package::where('package_key','NORMAL')->first();
    	$data_Package_VIP = Package::where('package_key','VIP')->first();
    	return view('admin.caidat.GoiDaiLy.goidaily', ['data_Package_FREE'=>$data_Package_FREE, 'data_Package_NORMAL'=>$data_Package_NORMAL, 'data_Package_VIP'=>$data_Package_VIP]);
    }
    // cập nhật Package
    public function postgoidaily(Request $request)
    {
    	$id = 1;
    	$data_Package_FREE_edit = Package::find($id);
    	$data_Package_FREE_edit->package_key = $data_Package_FREE_edit->package_key;
    	$data_Package_FREE_edit->plug_url = $data_Package_FREE_edit->plug_url;

    	$data_Package_FREE_edit->package_name = $request->package_name_free;
    	$data_Package_FREE_edit->package_description = $request->package_description_free;
    	$data_Package_FREE_edit->package_description_short = $request->package_description_short_free;
    	$data_Package_FREE_edit->package_price = $request->package_price_free;
    	$data_Package_FREE_edit->package_updatedate = date('Y-m-d H:i:s');
    	$data_Package_FREE_edit->save();
    	
    	$id_NORMAL = 2;
    	$data_Package_NORMAL_edit = Package::find($id_NORMAL);
    	$data_Package_NORMAL_edit->package_key = $data_Package_NORMAL_edit->package_key;
    	$data_Package_NORMAL_edit->plug_url = $data_Package_NORMAL_edit->plug_url;

    	$data_Package_NORMAL_edit->package_name = $request->package_name_normal;
    	$data_Package_NORMAL_edit->package_description = $request->package_description_normal;
    	$data_Package_NORMAL_edit->package_description_short = $request->package_description_short_normal;
    	$data_Package_NORMAL_edit->package_price = $request->package_price_normal;
    	$data_Package_NORMAL_edit->package_updatedate = date('Y-m-d H:i:s');
    	$data_Package_NORMAL_edit->save();

    	$id_VIP = 3;
    	$data_Package_VIP_edit = Package::find($id_VIP);
    	$data_Package_VIP_edit->package_key = $data_Package_VIP_edit->package_key;
    	$data_Package_VIP_edit->plug_url = $data_Package_VIP_edit->plug_url;

    	$data_Package_VIP_edit->package_name = $request->package_name_vip;
    	$data_Package_VIP_edit->package_description = $request->package_description_vip;
    	$data_Package_VIP_edit->package_description_short = $request->package_description_short_vip;
    	$data_Package_VIP_edit->package_price = $request->package_price_vip;
    	$data_Package_VIP_edit->package_updatedate = date('Y-m-d H:i:s');
    	$data_Package_VIP_edit->save();

    	return redirect('admin/caidat/goidaily')->with(['flash_lever'=>"success",'flash_message'=>'Cập nhật thành công!']);
    }
    //
    // hệ thống
    public function gethethong()
    {
        $email = Setting::where('key', "email")->first();
        $title = Setting::where('key', "title")->first();
        $logo = Setting::where('key', "logo")->first();
        $gioithieu = Setting::where('key', "gioithieu")->first();
        $logokhuyenmai = Setting::where('key', "logokhuyenmai")->first();
        $tieudekhuyenmai = Setting::where('key', "tieudekhuyenmai")->first();
        $noidungkhuyenmai = Setting::where('key', "noidungkhuyenmai")->first();
        $phone = Setting::where('key', "phone")->first();
        $tongdai = Setting::where('key', "tongdai")->first();
        $gioilamviec = Setting::where('key', "gioilamviec")->first();
        $thoigianlamviec = Setting::where('key', "thoigianlamviec")->first();
        $linkfacaebook = Setting::where('key', "linkfacaebook")->first();
        $diachi = Setting::where('key', "diachi")->first();
        $keymap = Setting::where('key', "keymap")->first();
        $maping = Setting::where('key', "maping")->first();
    	return view('admin.caidat.HeThong.hethong', ['email'=>$email, 'title'=>$title, 'logo'=>$logo, 'gioithieu'=>$gioithieu, 'logokhuyenmai'=>$logokhuyenmai, 'tieudekhuyenmai'=>$tieudekhuyenmai, 'noidungkhuyenmai'=>$noidungkhuyenmai, 'phone'=>$phone, 'tongdai'=>$tongdai, 'gioilamviec'=>$gioilamviec, 'thoigianlamviec'=>$thoigianlamviec, 'linkfacaebook'=>$linkfacaebook, 'diachi'=>$diachi, 'keymap'=>$keymap, 'maping'=>$maping ]);
    }
    public function updataHeThong(Request $request, $key)
    {
        Setting::where('key', "email")->update(['content'=> $request->email]);
        Setting::where('key', "title")->update(['content'=> $request->title]);
        Setting::where('key', "gioithieu")->update(['content'=> $request->gioithieu]);
        Setting::where('key', "tieudekhuyenmai")->update(['content'=> $request->tieudekhuyenmai]);
        Setting::where('key', "noidungkhuyenmai")->update(['content'=> $request->noidungkhuyenmai]);
        Setting::where('key', "phone")->update(['content'=> $request->phone]);
        Setting::where('key', "tongdai")->update(['content'=> $request->tongdai]);
        Setting::where('key', "gioilamviec")->update(['content'=> $request->gioilamviec]);
        Setting::where('key', "thoigianlamviec")->update(['content'=> $request->thoigianlamviec]);
        Setting::where('key', "linkfacaebook")->update(['content'=> $request->linkfacaebook]);
        Setting::where('key', "diachi")->update(['content'=> $request->diachi]);
        Setting::where('key', "keymap")->update(['content'=> $request->keymap]);
        Setting::where('key', "maping")->update(['content'=> $request->maping]);
        // lưu logo
        
        if($request->hasFile('logo'))
        {
            $file = $request -> file('logo');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/caidat/HeThong/hethong') -> with('loi','bạn có thể chọn hình ảnh đuôi jpg, png, jepg !');
            }
            $name = $file -> getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while (file_exists("image/logo/".$hinh)) {
                $hinh = str_random(4)."_".$name;
            }
            //echo $hinh;
            //luu hình 
            $file -> move("image/logo",$hinh);
            Setting::where('key', "logo")->update(['content'=> $hinh]);
        }
        
        // logo khuyến mãi
        if($request->hasFile('logokhuyenmai'))
        {
            $file = $request -> file('logokhuyenmai');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/caidat/HeThong/hethong') -> with('loi','bạn có thể chọn hình ảnh đuôi jpg, png, jepg !');
            }
            $name = $file -> getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while (file_exists("image/logo/".$hinh)) {
                $hinh = str_random(4)."_".$name;
            }
            //echo $hinh;
            //luu hình 
            $file -> move("image/logo",$hinh);
            Setting::where('key', "logokhuyenmai")->update(['content'=> $hinh]);
        }
        
        return redirect()->back();
    }
    public function xoalogo($key)
    {
        Setting::where('key', $key)->update(['content'=> ""]);
        return redirect()->back();
    }
    public function xoalogoKM($key)
    {
        Setting::where('key', $key)->update(['content'=> ""]);
        return redirect()->back();
    }

    // Cấu hình ví
    public function getcaidatdoanhsodaily()
    {
        $hoahongdaily_percentf1 = Setting::where('key', "hoahongdaily_percentf1")->first();
        $hoahongdaily_percentf2 = Setting::where('key', "hoahongdaily_percentf2")->first();
        $hoahongdaily_percentf3 = Setting::where('key', "hoahongdaily_percentf3")->first();
        $hoahongdaily_percentf4 = Setting::where('key', "hoahongdaily_percentf4")->first();
        $hoahongdaily_percentf5 = Setting::where('key', "hoahongdaily_percentf5")->first();
        
        $hoahongdaily_doanhsocanhandkmienphi = Setting::where('key', "hoahongdaily_doanhsocanhandkmienphi")->first();
        $doanhsocanhandkthuong = Setting::where('key', "doanhsocanhandkthuong")->first();
        $hoahongdaily_doanhsocanhandkVIP = Setting::where('key', "hoahongdaily_doanhsocanhandkVIP")->first();

        $hoahongdaily_sof1vipdkthuong = Setting::where('key', "hoahongdaily_sof1vipdkthuong")->first();
        $hoahongdaily_sof1vipdkvip = Setting::where('key', "hoahongdaily_sof1vipdkvip")->first();

    	return view('admin.caidat.HoaHong.hoahongdoanhsodaily', ['hoahongdaily_percentf1'=> $hoahongdaily_percentf1, 'hoahongdaily_percentf2'=> $hoahongdaily_percentf2, 'hoahongdaily_percentf3'=>$hoahongdaily_percentf3, 'hoahongdaily_percentf4'=>$hoahongdaily_percentf4, 'hoahongdaily_percentf5'=> $hoahongdaily_percentf5, 'hoahongdaily_doanhsocanhandkmienphi'=>$hoahongdaily_doanhsocanhandkmienphi, 'doanhsocanhandkthuong'=>$doanhsocanhandkthuong, 'hoahongdaily_doanhsocanhandkVIP'=>$hoahongdaily_doanhsocanhandkVIP, 'hoahongdaily_sof1vipdkthuong'=>$hoahongdaily_sof1vipdkthuong, 'hoahongdaily_sof1vipdkvip'=>$hoahongdaily_sof1vipdkvip ]);
    }
    public function postcaidatdoanhsodaily(Request $request)
    {
        Setting::where('key', "hoahongdaily_percentf1")->update(['content'=> $request->hoahongdaily_percentf1]);
        Setting::where('key', "hoahongdaily_percentf2")->update(['content'=> $request->hoahongdaily_percentf2]);
        Setting::where('key', "hoahongdaily_percentf3")->update(['content'=> $request->hoahongdaily_percentf3]);
        Setting::where('key', "hoahongdaily_percentf4")->update(['content'=> $request->hoahongdaily_percentf4]);
        Setting::where('key', "hoahongdaily_percentf5")->update(['content'=> $request->hoahongdaily_percentf5]);
        Setting::where('key', "doanhsocanhandkthuong")->update(['content'=> $request->doanhsocanhandkthuong]);
        Setting::where('key', "hoahongdaily_doanhsocanhandkVIP")->update(['content'=> $request->hoahongdaily_doanhsocanhandkVIP]);
        Setting::where('key', "hoahongdaily_sof1vipdkthuong")->update(['content'=> $request->hoahongdaily_sof1vipdkthuong]);
        Setting::where('key', "hoahongdaily_sof1vipdkvip")->update(['content'=> $request->hoahongdaily_sof1vipdkvip]);
        return redirect()->back()->with(['flash_lever'=>"success",'flash_message'=>'Cập nhật thành công!']);
    }
    public function getcaidattongdaily()
    {
        return view('admin.caidat.HoaHong.hoahongtongdaily');   
    }
}
