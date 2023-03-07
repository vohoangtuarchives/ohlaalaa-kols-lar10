@extends('index.layouts.master')
@section('content')
    <form  method="POST" action="{{route("profile.change-password.store")}}">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="admin_changepass" role="tabpanel">
                            <div class="mb-3">
                                <label class="form-label" for="name">Tên</label>
                                <div class="position-relative auth-pass-inputgroup mb-3">
                                    <input type="text" class="form-control pe-5 @error('name') is-invalid @enderror" name="name" placeholder="Thay đổi tên" id="password-input" value="{{\Illuminate\Support\Facades\Auth::guard("customers")->user()->name}}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="password-input">Mật khẩu cũ</label>
                                <div class="position-relative auth-pass-inputgroup mb-3">
                                    <input type="password" class="form-control pe-5 @error('old_password') is-invalid @enderror" name="old_password" placeholder="Mật khẩu cũ" id="password-input">
                                    @error('old_password')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="password-input">Mật khẩu mới</label>
                                <div class="position-relative auth-pass-inputgroup mb-3">
                                    <input type="password" class="form-control pe-5 @error('password') is-invalid @enderror" name="password" placeholder="Mật khẩu mới" id="password-input">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="password-input">Nhập lại mật khẩu</label>
                                <div class="position-relative auth-pass-inputgroup mb-3">
                                    <input type="password" class="form-control pe-5 @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Nhập lại mật khẩu" id="password-input">
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mb-3">
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                    <button type="button" class="btn btn-soft-success">Hủy</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</form>
@endsection