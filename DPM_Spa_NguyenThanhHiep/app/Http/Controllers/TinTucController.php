<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Cmssubject;
use App\cmsnews_status;

class TinTucController extends Controller
{
    //
    public function getchude()
    {
    	$data = Cmssubject::all();
    	return view('admin.tintuc.chude.quanlychude', ['data'=>$data]);
    }
    public function getthemchude()
    {
        return view('admin.tintuc.chude.themchude');
    }
    public function postthemchude(Request $request)
    {
        $chude = new Cmssubject();
        $chude->cmssubject_name = $request->cmssubject_name;
        $chude->cmssubject_istrash = 0;
        $chude->cmssubjects_istrash = 0;
        $chude->save();
        return redirect('admin/tintuc/quanlychude')->with(['flash_lever'=>"success",'flash_message'=>'Thêm thành công!']);
    }// sủa chu đề
    public function getchudesua($id)
    {
        $data = Cmssubject::find($id);
        return view('admin.tintuc.chude.suachude', ['data'=>$data]);
    }
    public function postchudesua(Request $request, $id)
    {
         $data = Cmssubject::find($id);
         $data->cmssubject_name = $request->cmssubject_name;
         $data->save();
         return redirect('admin/tintuc/quanlychude')->with(['flash_lever'=>"success",'flash_message'=>'Sửa thành công!']);
    }
    // xóa
    public function xoadesua($id)
    {
        $data = Cmssubject::find($id);
        $data->delete();
        return redirect('admin/tintuc/quanlychude')->with(['flash_lever'=>"success",'flash_message'=>'Xóa thành công!']);
    }
    // tin tức
    public function getquanlytin()
    {
    	$data = Cmsnews::orderBy('cmsnews_id', 'desc')->get();
    	$chude = Cmssubject::all();
    	return view('admin.tintuc.tintucs.quanlytin', ['data'=>$data, 'chude'=>$chude]);
    }
    //them tin tuc
    public function getthemquanlytin()
    {
        $data = Cmssubject::all();
        return view('admin.tintuc.tintucs.themtintuc', ['data'=>$data]);
    }
    public function postthemquanlytin(Request $request)
    {
        $news = new Cmsnews();
        $news->cmssubject_id= $request->cmssubject_id;
        $news->cmsnews_title = $request->cmsnews_title;
        $news->cmsnews_shortcontent = $request->cmsnews_shortcontent;
        $news->cmsnews_fullcontent = $request->cmsnews_fullcontent;
        if($request->cmsnews_status)
        {
            $news->cmsnews_status = 1;
        }
        else {
            $news->cmsnews_status = 0;
        }
        

        $news->cmsnews_createdate = time();
        $news->cmsnews_updatedate = time();
        $news->user_id = Auth::user()->name;
        $news->save();
        return redirect('admin/tintuc/quanlytin')->with(['flash_lever'=>"success",'flash_message'=>'Thêm thành công!']);
    }
    // sửa
    public function getsuatintuc($id)
    {
        $data = Cmsnews::find($id);
        $Subject = Cmssubject::where('cmssubject_id', $data->cmssubject_id)->first();
        $dataSubject = Cmssubject::all();
        return view('admin.tintuc.tintucs.suatintuc', ['data'=>$data, 'dataSubject'=>$dataSubject, 'Subject'=>$Subject]);
    }
    public function postquanlytinsua(Request $request, $id)
    {
        $news = Cmsnews::find($id);
        $news->cmssubject_id= $request->cmssubject_id;
        $news->cmsnews_title = $request->cmsnews_title;
        $news->cmsnews_shortcontent = $request->cmsnews_shortcontent;
        $news->cmsnews_fullcontent = $request->cmsnews_fullcontent;
        if($request->cmsnews_status)
        {
            $news->cmsnews_status = 1;
        }
        else {
            $news->cmsnews_status = 0;
        }
        

        $news->cmsnews_createdate = time();
        $news->cmsnews_updatedate = time();
        $news->user_id = Auth::user()->name;
        $news->save();
        return redirect('admin/tintuc/quanlytin')->with(['flash_lever'=>"success",'flash_message'=>'Sửa thành công!']);
    }
    // xóa tin tức 
    public function xoatintuc($id)
    {
        $news = Cmsnews::find($id);
        $news->delete();
        return redirect('admin/tintuc/quanlytin')->with(['flash_lever'=>"success",'flash_message'=>'Xóa thành công!']);
    }
}
