@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="content">
            
            <form action="{{ url('dangky')}}" method="post" class="beta-form-checkout" id="form">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-8">
                         <img src="image/icon_people.png" width="130px" height="100px">
                        <h4>
                            Đăng ký tài khoản
                           
                        </h4>
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach( $errors -> all() as $er)
                                        <li>{{ $er }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="space20">&nbsp;</div>
                        <div class="form-block">
                            <label for="customer_account_name">Tài khoản (*)</label>
                            <input type="text" id="customer_account_name" name="customer_account_name" class="form-control">
                        </div>
                        <div class="form-block">
                            <label for="customer_email">Email(*)</label>
                            <input type="text" id="customer_email" name="customer_email" class="form-control">
                        </div>
                        <div class="form-block">
                            <label for="customer_username">Họ và Tên (*)</label>
                            <input type="text" id="customer_username" name="customer_username" class="form-control">
                        </div>
                        <div class="form-block">
                            <label for="customer_identity_card">Số chứng minh nhân dân(*)</label>
                            <input type="text" id="customer_identity_card" name="customer_identity_card" class="form-control">
                        </div>
                        <div class="form-block">
                            <label for="customer_dateofbirth">Ngày tháng năm sinh(*)</label>
                            <input type="date" id="customer_dateofbirth" name="customer_dateofbirth" class="form-control">
                        </div>




                        <div class="form-block">
                            <label for="customer_sex">Giớ tính</label>
                            <div class="row">
                                <div class="col-sm-4"><input type="radio" name="customer_sex" value="1" checked class="form-control">Nam</div>
                                <div class="col-sm-4"><input type="radio" name="customer_sex" value="2" class="form-control"> Nữ</div>
                                <div class="col-sm-4"><input type="radio" name="customer_sex" value="3" class="form-control">Khác</div>
                            </div>
                        </div>
                        <div class="form-block">
                            <label for="customer_phone">Số điện thoại(*)</label>
                            <input type="text" id="customer_phone" name="customer_phone" class="form-control">
                        </div>
                        <div class="form-block">
                            <label for="customer_password">Mật khẩu (*)</label>
                            <input type="password" id="customer_password" name="customer_password" class="form-control">
                        </div>
                        <div class="form-block">
                            <label for="customer_password_confirm">Xác nhận mật khẩu(*)</label>
                            <input type="password" id="customer_password_confirm" name="customer_password_confirm" required class="form-control">
                        </div>
                        @if(isset($find_customer))
                        <div class="form-block">
                            <label for="customer_parent">Tài khoản giới thiệu</label>
                                <input type="text" id="customer_parent" name="customer_parent" class="form-control" value="{{$find_customer->customer_account_name}}" >
                        </div>
                        @endif

                       <div class="g-recaptcha" data-sitekey="6LeuhJEUAAAAAMTLsXx4JtjTSsI8JS9i60Seh67V"></div>

                        <div class="form-block">
                            <button type="submit" class="btn btn-primary">Đăng ký</button>
                        </div>
                    </div>
                    <div class="col-sm-2">
                    </div>
                </div>
            </form>
        </div> <!-- #content -->
    </div> <!-- .container -->

@endsection
