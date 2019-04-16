@extends('admin.layout.index')

@section('content')
	<div class="row">
           <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div id="page-wrapper">
                        <div class="col-lg-12">
                            @if(Session::has('flash_message'))
                                <div class="alert alert-{!! Session::get('flash_lever') !!}">
                                    {!! Session::get('flash_message') !!}
                                </div>
                            @endif
                        </div>
                        <div class="container-fluid" style="background-color: white; margin: 0 5;">
                            <div class="col-lg-12">
                                <h1 class="page-header">Thêm người dùng</h1>
                            </div>
                                <!-- /.col-lg-12 -->
                            <div class="col-lg-12" style="padding-bottom:120px">
                                <form enctype="multipart/form-data" action="{{ url('/admin/quanly/nguoidung/them')}}" method="POST">
                                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                                   <div class="col-lg-6" style="padding-bottom:120px">
                                        <div class="form-group">
                                            <label>Tên người dùng: (*)</label><br>
                                            <input class="form-control" name="name" placeholder="Please Enter Category Name" />
                                        </div>
                                        <div class="form-group">
                                            <label>Tên tài khoản: (*)</label><br>
                                            <input class="form-control" name="TaiKhoan" placeholder="Please Enter Category Name" />
                                        </div>
                                        <div class="form-group">
                                            <label>Email: (*)</label><br>
                                            <input class="form-control" name="email" placeholder="Please Enter Category Name" />
                                        </div>
                                        <div class="form-group">
                                            <label>Mật khẩu: (*)</label><br>
                                            <input type="password" class="form-control" name="password" placeholder="*******" />
                                        </div>
                                        <div class="form-group">
                                            <label>Số điện thoại</label><br>
                                            <input class="form-control" name="user_phone" />
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                    <button type="submit" class="btn btn-default">Thêm vào CSDL</button>
                                    <button type="reset" class="btn btn-default">Làm mới</button>
                                    <a href="admin/quanly/nguoidung" class="btn btn-default"> Trở lại</a>
                                </form>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

