@extends('admin.layout.index')

@section('content')
	<div class="row">
           <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div id="page-wrapper">
                        <div class="container-fluid" style="background-color: white; margin: 0 5;">
                            <div class="col-lg-12">
                                <h1 class="page-header">Thêm
                                    <small>Nhóm sản phẩm</small>
                                </h1>
                                </div>
                                <!-- /.col-lg-12 -->
                                <div class="col-lg-7" style="padding-bottom:120px">
                                @if(count($errors) > 0)
                                    <div class="alert alert-danger">
                                        @foreach($errors -> all() as $err)
                                            {{$err}} <br>
                                        @endforeach
                                    </div>
                                @endif
                                @if(session('ThongBaoThem'))
                                    <div class="alert alert-success">
                                        {{session('ThongBaoThem')}}
                                    </div>
                                @endif
                                <form enctype="multipart/form-data" action="{{ url('/admin/danhmuc/nhomsanpham/them')}}" method="POST">
                                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="form-group">
                                        <label>Tên nhóm</label><br>
                                        <input class="form-control" name="catalogy_name" placeholder="Please Enter Category Name" />
                                    </div>
                                    <div class="form-group">
                                        <label>Nhóm cấp trên</label>
                                        <select name="catalogy_parent" class="form-control">
											<option value="0">--Chọn--</option>
											<option value="Châm sóc da mặt">Châm sóc da mặt</option>
											<option value="Châm sóc da toàn thân">Châm sóc da toàn thân</option>
											<option value="Gói liệu trình">Gói liệu trình</option>
											<option value="Hiệu quả">Hiệu quả</option>
										</select>
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh</label><br>
                                        <input type="file" name="HinhAnh" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Banner</label><br>
                                        <input type="file" name="Banner" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label><br>
                                        <!--<input class="form-control" name="description" placeholder="Please Enter Category Name" /> -->
                                        <textarea name="catalogy_description" class="form-control " id="editor1"></textarea>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-default">Thêm vào CSDL</button>
                                    <button type="reset" class="btn btn-default">Làm mới</button>
                                    <a href="admin/product/danhsach" class="btn btn-default"> Trở lại</a>
                                <form>
                            </div>
                        </div>
                        <!-- /.row -->
                     </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        </div>


@endsection