<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Session;
use App\Shiptype;
use App\Catalogy;
use App\Paymenttype;
use App\Properties;
use App\Product;
use App\Price;
use App\Product_image;
use App\Catalogyservice;
use App\Services;
use App\Serviceincatalogy;
use App\Slider;

class DanhMucController extends Controller
{
    //Hình thức thanh toán
    public function getDanhSachHinhThucThanhToan()
    {
        $ds_httt = DB::table('paymenttype')->orderBy('paymenttype_createdate', 'asc')->get();
    	return view('admin.danhmuc.HTthanhToan.hinhthucthanhtoan',['ds_httt' => $ds_httt] );
    }

    public function posthinhthucthanhtoan_Them(Request $request)
    {
        $this->validate($request, [
            'paymenttype_name' => 'required|string|max:10|unique:paymenttype',
            'paymenttype_code' => 'required|string|max:255|unique:paymenttype',
            'paymenttype_description' => 'required|string|max:10|unique:paymenttype'
        ]);
        
        $controls = array();
        if(!empty($request->paymenttype_name)) $controls['paymenttype_name'] = $request->paymenttype_name;
        if(!empty($request->paymenttype_code)) $controls['paymenttype_code'] = $request->paymenttype_code;
        if(!empty($request->paymenttype_description)) $controls['paymenttype_description'] = $request->paymenttype_description;
        if(!empty($request->paymenttype_status) == "checked") 
        {
            $controls['paymenttype_status'] = 1;
        }
        else
        {
            $controls['paymenttype_status'] = 2;
        }
            
        DB::table('paymenttype')->insert($controls);
        return redirect('admin/danhmuc/hinhthucthanhtoan')->with(['flash_lever'=>"success",'flash_message'=>'Thêm thành công!']);
        
    }
    public function gethinhthucthanhtoan_Sua($id)
    {
        $data = Paymenttype::find($id);
        //echo($data);
        return view('admin.danhmuc.HTthanhToan.suahinhthucthanhtoan',['data'=>$data]);
    }
    public function posthinhthucthanhtoan_Sua(Request $request, $id)
    {
        $data = Paymenttype::find($id);
        // $this->validate($request, [
        //     'paymenttype_name' => 'required|string|max:10|unique:paymenttype',
        //     'paymenttype_code' => 'required|string|max:255|unique:paymenttype',
        //     'paymenttype_description' => 'required|string|max:10|unique:paymenttype'
        // ]);
        $data -> paymenttype_name = $request -> paymenttype_name;
        $data -> paymenttype_description = $request -> paymenttype_description;
        $data -> paymenttype_code = $request -> paymenttype_code;
        

        if(!empty($request->paymenttype_status) == "checked") 
        {
            $data ->paymenttype_status = 1;
        }
        else
        {
            $data ->paymenttype_status = 2;
        }
        $data->save();
        return redirect('admin/danhmuc/hinhthucthanhtoan')->with(['flash_lever'=>"success",'flash_message'=>'Cập nhật thành công!']);
    }

    public function gethinhthucthanhtoan_Xoa($id)
    {
         $data = Paymenttype::find($id);
         $data -> delete();
        return redirect('admin/danhmuc/hinhthucthanhtoan')->with(['flash_lever'=>"success",'flash_message'=>'Xóa thành công!']);
    }
// hình thức vận chuyển
    public function getDanhSachHinhThucVanChuyen()
    {
        $ds_htvc = Shiptype::orderBy('id', 'asc')->get();
    	return view('admin.danhmuc.HTvanchuyen.hinhthucvanchuyen',['ds_htvc'=>$ds_htvc]);
    }

    public function gethinhthucvanchuyen_Them(Request $request)
    {
        $this->validate($request, [
            'shiptype_name' => 'required|string|max:250|unique:shiptype',
            'shiptype_code' => 'required'
           
        ]);
        $shiptype = new Shiptype();

        //$controls = array();
        $shiptype->shiptype_name = $request->shiptype_name;
        $shiptype->shiptype_code = $request->shiptype_code;
        if(!empty($request->shiptype_status) == "checked") 
        {
            $shiptype->shiptype_status = 1;
        }
        else
        {
            $shiptype->shiptype_status = 2;
        }
            
        $shiptype->save();
        return redirect('admin/danhmuc/hinhthucvanchuyen');
    }
    // sửa hình thức vận chuyển
    public function gethinhthucvanchuyen_Sua($id)
    {
        $data = Shiptype::find($id);
        return view('admin.danhmuc.HTvanchuyen.suahinhthucvanchuyen',['data'=>$data]);
    }
    public function posthinhthucvanchuyen_Sua(Request $request, $id)
    {
        $data_update = Shiptype::find($id);
        // $this->validate($request, [
        //     'paymenttype_name' => 'required|string|max:10|unique:paymenttype',
        //     'paymenttype_code' => 'required|string|max:255|unique:paymenttype',
        //     'paymenttype_description' => 'required|string|max:10|unique:paymenttype'
        // ]);
        $data_update -> shiptype_name = $request -> shiptype_name;
        $data_update -> shiptype_code = $request -> shiptype_code;
        $data_update -> shiptype_update = date('Y-m-d H:i:s');
        if(!empty($request->shiptype_status) == "checked") 
        {
            $data_update ->shiptype_status = 1;
        }
        else
        {
            $data_update ->shiptype_status = 2;
        }
        $data_update->save();
        return redirect('admin/danhmuc/hinhthucvanchuyen')->with(['flash_lever'=>"success",'flash_message'=>'Cập nhật thành công!']);
    }
    // xóa hình thức vận chuyển
    public function gethinhthucvanchuyen_Xoa($id)
    {
        $data_delete = Shiptype::find($id);
        $data_delete -> delete();
        return redirect('admin/danhmuc/hinhthucvanchuyen')->with(['flash_lever'=>"success",'flash_message'=>'Xóa thành công!']);
    }
    // list nhóm sản phẩm
    public function getnhomsanpham()
    {
        $ds_nsp = Catalogy::orderBy('id','asc')->get();
    	return view('admin.danhmuc.NhomSanPham.nhomsanpham',['ds_nsp'=>$ds_nsp]);
    }
    public function getnhomsanpham_Them()
    {
        return view('admin.danhmuc.NhomSanPham.themnhomsanpham');
    }
    public function postnhomsanpham_Them(Request $request)
    {
        $catalogy = new Catalogy();
        $catalogy->catalogy_name = $request->catalogy_name;
        $catalogy->catalogy_parent = $request->catalogy_parent;
        $catalogy->catalogy_description = $request->catalogy_description;
        if($request->catalogy_status == "checked")
        {
            $catalogy->catalogy_status = 1;
        }
        else
        {
            $catalogy->catalogy_status = 2;
        }



        if($request -> hasFile('HinhAnh'))
        {
            $file = $request -> file('HinhAnh');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/danhmuc/nhomsanpham') -> with('loi','bạn có thể chọn hình ảnh đuôi jpg, png, jepg !');
            }
            $name = $file -> getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while (file_exists("trangAdmin/images/".$hinh)) {
                $hinh = str_random(4)."_".$name;
            }
            echo $hinh;
            //luu hình 
            $file -> move("trangAdmin/images",$hinh);
            $catalogy ->catalogy_image = $hinh;
        }
        else
        {
            $catalogy ->catalogy_image = "";
        }
        //banner
        if($request->hasFile('Banner'))
        {
            $file = $request -> file('Banner');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/danhmuc/nhomsanpham') -> with('loi','bạn có thể chọn hình ảnh đuôi jpg, png, jepg !');
            }
            $name = $file -> getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while (file_exists("trangAdmin/images/".$hinh)) {
                $hinh = str_random(4)."_".$name;
            }
            //echo $hinh;
            //luu hình 
            $file -> move("trangAdmin/images",$hinh);
            $catalogy -> catalogy_banner = $hinh;
        }
        else
        {
            $catalogy -> catalogy_banner = "ghgjh";
        }

        $catalogy->save();
        return redirect('admin/danhmuc/nhomsanpham')->with(['flash_lever'=>"success",'flash_message'=>'Thêm thành công!']);
    }
    // sửa nhóm sản phẩm
    public function getnhomsanpham_Sua($id)
    {
        $data = Catalogy::find($id);
        return view('admin.danhmuc.NhomSanPham.suanhomsanpham', ['data'=>$data]);
    }
    //sửa post nhóm sản phẩm.
    public function postnhomsanpham_Sua(Request $request, $id)
    {
        $data_edit = Catalogy::find($id);
        $data_edit->catalogy_name = $request->catalogy_name;
        $data_edit->catalogy_parent = $request->catalogy_parent;
        $data_edit->catalogy_description = $request->catalogy_description;
        if($request->catalogy_status == "checked")
        {
            $data_edit->catalogy_status = 1;
        }
        else
        {
            $data_edit->catalogy_status = 2;
        }
        //thêm hình
        if($request -> hasFile('HinhAnh'))
        {
            $file = $request -> file('HinhAnh');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/danhmuc/nhomsanpham') -> with('loi','bạn có thể chọn hình ảnh đuôi jpg, png, jepg !');
            }
            $name = $file -> getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while (file_exists("trangAdmin/images/".$hinh)) {
                $hinh = str_random(4)."_".$name;
            }
            //echo $hinh;
            //luu hình 
            $file -> move("trangAdmin/images",$hinh);
            $data_edit ->catalogy_image = $hinh;
        }
        
        //banner
        if($request->hasFile('Banner'))
        {
            $file = $request -> file('Banner');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/danhmuc/nhomsanpham') -> with('loi','bạn có thể chọn hình ảnh đuôi jpg, png, jepg !');
            }
            $name = $file -> getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while (file_exists("trangAdmin/images/".$hinh)) {
                $hinh = str_random(4)."_".$name;
            }
            //echo $hinh;
            //luu hình 
            $file -> move("trangAdmin/images",$hinh);
            $data_edit -> catalogy_banner = $hinh;
        }

        $data_edit->save();
        return redirect('admin/danhmuc/nhomsanpham')->with(['flash_lever'=>"success",'flash_message'=>'Sửa thành công!']);
    }
    //xóa nhóm sản phẩm
    public function getnhomsanpham_Xoa($id)
    {
        $data_delete = Catalogy::find($id);
        $data_delete -> delete();
        return redirect('admin/danhmuc/nhomsanpham')->with(['flash_lever'=>"success",'flash_message'=>'Xóa thành công!']);
    }
    // List thuộc tính sản phẩm.
    public function getthuoctinhsanpham()
    {
        $data_Properties_option = \App\Properties_option::all();
        $data = Properties::orderBy('id', 'asc')->get();
        return view('admin.danhmuc.ThuocTinhSanPham.thuoctinhsanpham', ['data'=>$data, 'data_Properties_option'=>$data_Properties_option]);
    }
    // Thêm thuộc tính sản phẩm
    // Sửa thuộc tính sản phẩm
    // Xóa thuộc tính sản phẩm.

    // List sản phẩm
    public function getsanpham()
    {   $data_catalogy = Catalogy::all();
        $data_price = Price::all();
        $data = Product::orderBy('id', 'asc')->get();
    	return view('admin.danhmuc.SanPham.sanpham', ['data'=>$data,'data_price'=>$data_price, 'data_catalogy'=>$data_catalogy]);
    }
    // get thêm sản phẩm
    public function getsanpham_Them()
    {
        $data_catalogy = Catalogy::all();
        return view('admin.danhmuc.SanPham.themsanpham',['data_catalogy'=>$data_catalogy]);
    }
    public function postsanpham_Them(Request $request)
    {
        $product = new Product();
        $product->catalogy_id = $request->catalogy_id;
        $product->product_name = $request->product_name;
        $product->product_short_desciption = $request->product_short_desciption;
        $product->product_desciption = $request->product_desciption;
        if($request->product_status == "checked")
        {
            $product->product_status = 1;
        }
        else
        {
            $product->product_status = 2;
        }

        $product->save();

        $price = new Price();
        $price->price_value = $request->price_value;
        $price->price_agency = $request->price_agency;
        $price->price_special = $request->price_special;
        $price->price_applydate = $request->price_applydate;
        $price->price_todate = $request->price_todate;
        $price->product_id = $product->id;
        $price->save();

        $product_image = new Product_image();
        $product_image->product_id = $product->id;
        if($request -> hasFile('HinhAnh'))
        {
            $file = $request -> file('HinhAnh');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/danhmuc/nhomsanpham') -> with('loi','bạn có thể chọn hình ảnh đuôi jpg, png, jepg !');
            }
            $name = $file -> getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while (file_exists("trangAdmin/images_product/".$hinh)) {
                $hinh = str_random(4)."_".$name;
            }
            echo $hinh;
            //luu hình 
            $file -> move("trangAdmin/images_product",$hinh);
            $product_image ->image_file = $hinh;
        }
        else
        {
            $product_image->image_file = "";
        }
        $product_image ->save();
        return redirect('admin/danhmuc/sanpham')->with(['flash_lever'=>"success",'flash_message'=>'Thêm thành công!']);
    }
    //sửa sản phẩm
    public function getsanpham_Sua($id)
    {
        $data_edit = Product::find($id);
        // danh muc
        $idcatagory = $data_edit->catalogy_id;
        $data_catalogyfind = Catalogy::where('id', $idcatagory)->first();
        $data_catalogy = Catalogy::all();
        //giá
        $price = Price::where('product_id', $id)->first();
        //hình
        $image = Product_image::where('product_id', $id)->first();
        //echo($image);
        return view('admin.danhmuc.SanPham.suasanpham',['data_edit'=>$data_edit, 'data_catalogy'=>$data_catalogy, 'data_catalogyfind'=>$data_catalogyfind, 'price'=>$price,'image'=> $image]);
    }
    public function postsanpham_Sua(Request $request, $id)
    {
        $data_product_edit = Product::find($id);
        $data_product_edit->catalogy_id = $request->catalogy_id;
        $data_product_edit->product_name = $request->product_name;
        $data_product_edit->product_short_desciption = $request->product_short_desciption;
        $data_product_edit->product_desciption = $request->product_desciption;
        if($request->product_status == "checked")
        {
            $data_product_edit->product_status = 1;
        }
        else
        {
            $data_product_edit->product_status = 2;
        }

        $data_product_edit->save();

        $price_edit = Price::where('product_id', $id)->first();
        $price_edit->price_value = $request->price_value;
        $price_edit->price_agency = $request->price_agency;
        $price_edit->price_special = $request->price_special;
        $price_edit->price_applydate = $request->price_applydate;
        $price_edit->price_todate = $request->price_todate;
        $price_edit->product_id = $data_product_edit->id;
        $price_edit->save();

        $product_image_edit = Product_image::where('product_id', $id)->first();
        $product_image_edit->product_id = $data_product_edit->id;
        if($request -> hasFile('HinhAnh'))
        {
            $file = $request -> file('HinhAnh');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/danhmuc/nhomsanpham') -> with('loi','bạn có thể chọn hình ảnh đuôi jpg, png, jepg !');
            }
            $name = $file -> getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while (file_exists("trangAdmin/images_product/".$hinh)) {
                $hinh = str_random(4)."_".$name;
            }
            echo $hinh;
            //luu hình 
            $file -> move("trangAdmin/images_product",$hinh);
            $product_image_edit ->image_file = $hinh;
        }
        $product_image_edit ->save();
        return redirect('admin/danhmuc/sanpham')->with(['flash_lever'=>"success",'flash_message'=>'Sửa thành công!']);
    }
    // xóa sản phẩm
    public function getsanpham_Xoa($id)
    {
        $data_product_delete = Product::find($id);
        $data_product_delete->delete();
        $price_edit = Price::where('product_id', $id)->first();
        $price_edit->delete();
        $product_image_edit = Product_image::where('product_id', $id)->first();
        $product_image_edit->delete();
        
        //echo($data_product_delete);
        return redirect('admin/danhmuc/sanpham')->with(['flash_lever'=>"success",'flash_message'=>'Xóa thành công!']);
    }
    // List danh mục dịch vụ

    public function getdanhmucdichvu()
    {
        $ds_dmdv = Catalogyservice::orderBy('id', 'asc')->get();
    	return view('admin.danhmuc.DanhMucDichVu.danhmucdichvu',['ds_dmdv'=>$ds_dmdv]);
    }
    // Thêm danh mục dịch vụ
    public function getdanhmucdichvu_Them()
    {
        return view('admin.danhmuc.DanhMucDichVu.themdanhmucdichvu');
    }
    //
    public function postdanhmucdichvu_Them(Request $request)
    {
        $data = new Catalogyservice();
        $data->catalogyservice_name = $request->catalogyservice_name;
        $data->catalogyservice_parent = $request->catalogyservice_parent;
        // icon
        if($request -> hasFile('catalogyservice_icon'))
        {
            $file = $request -> file('catalogyservice_icon');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/danhmuc/nhomsanpham') -> with('loi','bạn có thể chọn hình ảnh đuôi jpg, png, jepg !');
            }
            $name = $file -> getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while (file_exists("trangAdmin/inages_dichvu/".$hinh)) {
                $hinh = str_random(4)."_".$name;
            }
            echo $hinh;
            //luu hình 
            $file -> move("trangAdmin/inages_dichvu",$hinh);
            $data ->catalogyservice_icon = $hinh;
        }
        else
        {
            $data ->catalogyservice_icon = "";
        }
        // hình ảnh
        if($request -> hasFile('catalogyservice_image'))
        {
            $file = $request -> file('catalogyservice_image');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/danhmuc/nhomsanpham') -> with('loi','bạn có thể chọn hình ảnh đuôi jpg, png, jepg !');
            }
            $name = $file -> getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while (file_exists("trangAdmin/inages_dichvu/".$hinh)) {
                $hinh = str_random(4)."_".$name;
            }
            echo $hinh;
            //luu hình 
            $file -> move("trangAdmin/inages_dichvu",$hinh);
            $data ->catalogyservice_image = $hinh;
        }
        else
        {
            $data ->catalogyservice_image = "";
        }
        //banner
        if($request -> hasFile('catalogyservice_banner'))
        {
            $file = $request -> file('catalogyservice_banner');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/danhmuc/nhomsanpham') -> with('loi','bạn có thể chọn hình ảnh đuôi jpg, png, jepg !');
            }
            $name = $file -> getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while (file_exists("trangAdmin/inages_dichvu/".$hinh)) {
                $hinh = str_random(4)."_".$name;
            }
            echo $hinh;
            //luu hình 
            $file -> move("trangAdmin/inages_dichvu",$hinh);
            $data ->catalogyservice_banner = $hinh;
        }
        else
        {
            $data ->catalogyservice_banner = "";
        }
        //
        $data->catalogyservice_description = $request->catalogyservice_description;
        if($request->catalogyservice_status == "checked")
        {
            $data ->catalogyservice_status = 1;
        }
        else
        {
            $data ->catalogyservice_status = 2;
        }

        $data->save();
        return redirect('admin/danhmuc/danhmucdichvu')->with(['flash_lever'=>"success",'flash_message'=>'Thêm thành công!']);
    }
    // sửa danh mục dịch vụ
    public function getdanhmucdichvu_Sua($id)
    {
        $data_edit = Catalogyservice::find($id);
        return view('admin.danhmuc.DanhMucDichVu.suadanhmucdichvu', ['data_edit'=>$data_edit]);
    }
    public function postdanhmucdichvu_Sua(Request $request, $id)
    {
        $data_edit = Catalogyservice::find($id);
        $data_edit->catalogyservice_name = $request->catalogyservice_name;
        $data_edit->catalogyservice_parent = $request->catalogyservice_parent;
        // if($request->catalogyservice_parent == 0)
        // {
        //     $data_edit->catalogyservice_parent = $data_edit->catalogyservice_parent;
        // }
        // else {
        //     $data_edit->catalogyservice_parent = $request->catalogyservice_parent;
        // }
        
        // icon
        if($request -> hasFile('catalogyservice_icon'))
        {
            $file = $request -> file('catalogyservice_icon');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/danhmuc/nhomsanpham') -> with('loi','bạn có thể chọn hình ảnh đuôi jpg, png, jepg !');
            }
            $name = $file -> getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while (file_exists("trangAdmin/inages_dichvu/".$hinh)) {
                $hinh = str_random(4)."_".$name;
            }
            echo $hinh;
            //luu hình 
            $file -> move("trangAdmin/inages_dichvu",$hinh);
            $data_edit ->catalogyservice_icon = $hinh;
        }

        // hình ảnh
        if($request -> hasFile('catalogyservice_image'))
        {
            $file = $request -> file('catalogyservice_image');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/danhmuc/nhomsanpham') -> with('loi','bạn có thể chọn hình ảnh đuôi jpg, png, jepg !');
            }
            $name = $file -> getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while (file_exists("trangAdmin/inages_dichvu/".$hinh)) {
                $hinh = str_random(4)."_".$name;
            }
            echo $hinh;
            //luu hình 
            $file -> move("trangAdmin/inages_dichvu",$hinh);
            $data_edit ->catalogyservice_image = $hinh;
        }

        //banner
        if($request -> hasFile('catalogyservice_banner'))
        {
            $file = $request -> file('catalogyservice_banner');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/danhmuc/danhmucdichvu') -> with('loi','bạn có thể chọn hình ảnh đuôi jpg, png, jepg !');
            }
            $name = $file -> getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while (file_exists("trangAdmin/inages_dichvu/".$hinh)) {
                $hinh = str_random(4)."_".$name;
            }
            echo $hinh;
            //luu hình 
            $file -> move("trangAdmin/inages_dichvu",$hinh);
            $data_edit ->catalogyservice_banner = $hinh;
        }

        //
        $data_edit->catalogyservice_description = $request->catalogyservice_description;
        if($request->catalogyservice_status == "checked")
        {
            $data_edit ->catalogyservice_status = 1;
        }
        else
        {
            $data_edit ->catalogyservice_status = 2;
        }

        $data_edit->save();
        return redirect('admin/danhmuc/danhmucdichvu')->with(['flash_lever'=>"success",'flash_message'=>'Sửa thành công!']);
    }
    // xóa danh mục dịch vụ
    public function getdanhmucdichvu_Xoa($id)
    {
        $data_delete = Catalogyservice::find($id);
        $data_delete -> delete();
        return redirect('admin/danhmuc/danhmucdichvu')->with(['flash_lever'=>"success",'flash_message'=>'Xóa thành công!']);
    }
    // List dịch vụ
    public function getdichvu()
    {
        $ds_dv = Services::orderBy('id','asc')->get();
    	return view('admin.danhmuc.DichVu.dichvu',['ds_dv'=>$ds_dv] );
    }
    public function getdichvu_Them()
    {
        $data_dmdv = Catalogyservice::all();
       // echo($data_dmdv);
        return view('admin.danhmuc.DichVu.themdichvu',['data_dmdv'=>$data_dmdv]);
    }
    public function postdichvu_Them(Request $request)
    {
        $service = new Services();
        $service->service_name = $request->service_name;
        $service->service_shortdescription = $request->service_shortdescription;
        $service->service_longdescription = $request->service_longdescription;
        $service->total_times = $request->total_times;
        $service->service_normalprice = $request->service_normalprice;
        $service->service_specialprice = $request->service_specialprice;
        $service->service_datesellfrom = $request->service_datesellfrom;
        $service->service_datesellto = $request->service_datesellto;

        if($request -> hasFile('service_images'))
        {
            $file = $request -> file('service_images');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/danhmuc/danhmucdichvu') -> with('loi','bạn có thể chọn hình ảnh đuôi jpg, png, jepg !');
            }
            $name = $file -> getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while (file_exists("trangAdmin/inages_dichvu/".$hinh)) {
                $hinh = str_random(4)."_".$name;
            }
            echo $hinh;
            //luu hình 
            $file -> move("trangAdmin/inages_dichvu",$hinh);
            $service ->service_images = $hinh;
        }

        if($request->service_status == "checked")
        {
            $service ->service_status = 1;
        }
        else
        {
            $service ->service_status = 2;
        }
        //
        if($request->service_isnew == "checked")
        {
            $service ->service_isnew = 1;
        }
        else
        {
            $service ->service_isnew = 2;
        }
        $service->save();
        //
        $serviceincatalogy = new Serviceincatalogy();
        $serviceincatalogy->catalogyservice_id = $request->catalogyservice_id;
        $serviceincatalogy->service_id = $service->id;
        $serviceincatalogy->save();

        return redirect('admin/danhmuc/dichvu')->with(['flash_lever'=>"success",'flash_message'=>'Thêm thành công!']);
    }
    // sửa dịch vụ
    public function getdichvu_Sua($id)
    {
        $service_edit = Services::find($id);
        $data_dmdv_edit = Catalogyservice::all();
        $serviceincatalogy_edit = Serviceincatalogy::all();
        //echo($service_edit);
        return view('admin.danhmuc.DichVu.suadichvu', ['service_edit'=>$service_edit, 'data_dmdv_edit'=>$data_dmdv_edit, 'serviceincatalogy_edit'=>$serviceincatalogy_edit]);
    }
    public function postdichvu_Sua(Request $request, $id)
    {
        $service_edit = Services::find($id);
        $service_edit->service_name = $request->service_name;
        $service_edit->service_shortdescription = $request->service_shortdescription;
        $service_edit->service_longdescription = $request->service_longdescription;
        $service_edit->total_times = $request->total_times;
        $service_edit->service_normalprice = $request->service_normalprice;
        $service_edit->service_specialprice = $request->service_specialprice;
        $service_edit->service_datesellfrom = $request->service_datesellfrom;
        $service_edit->service_datesellto = $request->service_datesellto;

        $service_edit->service_updatedate = date('Y-m-d H:i:s');;
        if($request -> hasFile('service_images'))
        {
            $file = $request -> file('service_images');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/danhmuc/danhmucdichvu') -> with('loi','bạn có thể chọn hình ảnh đuôi jpg, png, jepg !');
            }
            $name = $file -> getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while (file_exists("trangAdmin/inages_dichvu/".$hinh)) {
                $hinh = str_random(4)."_".$name;
            }
            echo $hinh;
            //luu hình 
            $file -> move("trangAdmin/inages_dichvu",$hinh);
            $service_edit ->service_images = $hinh;
        }

        if($request->service_status == "checked")
        {
            $service_edit ->service_status = 1;
        }
        //
        if($request->service_isnew == "checked")
        {
            $service_edit ->service_isnew = 1;
        }
        else
        {
            $service_edit ->service_isnew = 2;
        }
        $service_edit->save();
        //
        $serviceincatalogy_edit = Serviceincatalogy::where('service_id',$id)->first();
        $serviceincatalogy_edit->catalogyservice_id = $request->catalogyservice_id;
        $serviceincatalogy_edit->save();

        return redirect('admin/danhmuc/dichvu')->with(['flash_lever'=>"success",'flash_message'=>'Cập nhật thành công!']);
    }
    // delete dịch vụ
    public function getdichvu_Xoa($id)
    {
        $serviceincatalogy_delete = Serviceincatalogy::where('service_id',$id)->first();
        $serviceincatalogy_delete->delete();
        $service_delete = Services::find($id);
        $service_delete->delete();
         return redirect('admin/danhmuc/dichvu')->with(['flash_lever'=>"success",'flash_message'=>'Xóa thành công!']);
    }

    // danh sách slider
    public function getslider()
    {
        $data = Slider::all();
        return view('admin.danhmuc.Slider.slider', ['data'=>$data]);
    }
    // thêm slider
    public function getslider_Them()
    {
        return view('admin.danhmuc.Slider.themslider');
    }
    public function postslider_Them(Request $request)
    {
        $data = new Slider();
        if($request -> hasFile('file_name'))
        {
            $file = $request -> file('file_name');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/danhmuc/Slider/slider') -> with('loi','bạn có thể chọn hình ảnh đuôi jpg, png, jepg !');
            }
            $name = $file -> getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while (file_exists("image/slider/".$hinh)) {
                $hinh = str_random(4)."_".$name;
            }
            echo $hinh;
            //luu hình 
            $file -> move("image/slider",$hinh);
            $data ->file_name = $hinh;
        }
        else
        {
            $data ->file_name = "";
        }
        $data ->content = $request->content;
        $data -> save();
        return redirect('admin/danhmuc/slider')->with(['flash_lever'=>"success",'flash_message'=>'Xóa thành công!']);

    }
    // sửa slider 
    public function getslider_Sua($id)
    {
        $data_edit = Slider::find($id);
        return view('admin.danhmuc.Slider.suaslider', ['data_edit'=>$data_edit]);
    }
    public function postslider_Sua(Request $request, $id)
    {
        $data_edit = Slider::find($id);
        if($request -> hasFile('file_name'))
        {
            $file = $request -> file('file_name');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/danhmuc/Slider/slider') -> with('loi','bạn có thể chọn hình ảnh đuôi jpg, png, jepg !');
            }
            $name = $file -> getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while (file_exists("image/slider/".$hinh)) {
                $hinh = str_random(4)."_".$name;
            }
            echo $hinh;
            //luu hình 
            $file -> move("image/slider",$hinh);
            $data_edit ->file_name = $hinh;
        }
        $data_edit ->content = $request->content;
        $data_edit -> save();
        return redirect('admin/danhmuc/slider')->with(['flash_lever'=>"success",'flash_message'=>'Cập nhật thành công!']);
    }
    // xóa slider
    public function getslider_Xoa($id)
    {
        $data_delete = Slider::find($id);
        $data_delete -> delete();
        return redirect('admin/danhmuc/slider')->with(['flash_lever'=>"success",'flash_message'=>'Xóa thành công!']);
    }
}
