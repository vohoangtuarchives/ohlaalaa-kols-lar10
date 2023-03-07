@extends('index.layouts.master')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 col-lg-6 col-xl-8">
        <div class="card mt-4">
            <div class="card-body p-4">

                <div class="p-2 mt-4">
                    <form class="needs-validation" novalidate method="POST"
                          action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và tên <span
                                        class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ $customer->name }}" id="name"
                                   placeholder="Họ và tên" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                            @enderror
                            <div class="invalid-feedback">
                                @lang("app.register.invalid-feedback.name")
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="useremail" class="form-label">Email <span
                                        class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ $customer->email }}" id="useremail"
                                   placeholder="Nhập địa chỉ email" disabled>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                            @enderror
                            <div class="invalid-feedback">
                                @lang("app.register.invalid-feedback.email")
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Bí danh <span
                                        class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                   name="username" value="{{ $customer->username }}" id="username"
                                   placeholder="Nhập bí danh sẽ sử dụng" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                            @enderror
                            <div class="invalid-feedback">
                                @lang("app.register.invalid-feedback.username")
                            </div>
                        </div>

                        <div class="mb-4">
                            @livewire("ui.city", ['customer' => $customer])
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Điện thoại <span
                                        class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                   name="phone" value="{{ $customer->phone }}" id="phone"
                                   placeholder="Nhập số điện thoại" required>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                            @enderror
                            <div class="invalid-feedback">
                                @lang("app.register.invalid-feedback.phone")
                            </div>
                        </div>
                        <div class="col-md-4  mb-3">
                            <label class="form-label">Giới tính</label>
                            <select name="gender" class="form-select">
                                <option selected>Chọn giới tính</option>
                                <option value="Nam"  @if($customer->gender =='Nam') selected @endif>Nam</option>
                                <option value="Nữ"  @if($customer->gender =='Nữ') selected @endif>Nữ</option>
                            </select>
                        </div>
                        @isset($referrer)
                            <div>
                                <x-input-label for="referral_code" class="fs-16 mb-0">
                                    <x-slot name="value">{!! __('app.referral_code_of', ['name' => $referrer->name]) !!}</x-slot>
                                </x-input-label>
                                <x-text-input id="email" name="referrer_code" type="hidden" :value=" $referrer->referral_code ?? ''"  />
                                <x-text-input id="email" name="referrer_id" type="hidden" :value=" $referrer->id ?? ''" />
                                <x-input-error :messages="$errors->get('referral_code')" class="mt-2" />
                            </div>
                        @endisset



                        <div class="mt-4">

                            <button class="btn btn-success" type="submit">Thay Đổi</button>
                        </div>

                    </form>

                </div>
            </div>
            <!-- end card body -->
        </div>
    </div>
</div>
@endsection