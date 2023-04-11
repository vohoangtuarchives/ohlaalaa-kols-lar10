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

                        <div class="mb-4">
                            <div class="row">
                                <div class="col-md-4  mb-3">
                                    <select name="city" class="form-select" id="city" aria-label=".form-select-sm">
                                        <option value="{{ $customer->city }}" selected>{{ $customer->city }}</option>
                                    </select>
                                </div>
                                <div class="col-md-4  mb-3">
                                    <select name="district" class="form-select" id="district" aria-label=".form-select-sm">
                                        <option value="{{ $customer->district }}" selected>{{ $customer->district }}</option>
                                    </select>
                                </div>
                                <div class="col-md-4  mb-3">
                                    <select name="ward" class="form-select" id="ward" aria-label=".form-select-sm">
                                        <option value="{{ $customer->ward }}" selected>{{ $customer->ward }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Điện thoại <span
                                        class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                   name="phone" value="{{ $customer->phone }}" id="phone"
                                   placeholder="Nhập số điện thoại" required disabled>
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

                        <div class="mb-3">
                            <label for="phone" class="form-label">Tên ngân hàng<span
                                        class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('banking_name') is-invalid @enderror"
                                   name="banking_name" value="{{ $customer->banking_name }}" id="banking_name"
                                   placeholder="Nhập tên ngân hàng" required>
                            @error('banking_name')
                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                            @enderror
                            <div class="invalid-feedback">
                                @lang("app.register.invalid-feedback.banking_name")
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="banking_account_name" class="form-label">Tên chủ tài khoản<span
                                        class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('banking_account_name') is-invalid @enderror"
                                   name="banking_account_name" value="{{ $customer->banking_account_name }}" id="banking_account_name"
                                   placeholder="Nhập tên chủ tài khoản" required>
                            @error('banking_account_name')
                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                            @enderror
                            <div class="invalid-feedback">
                                @lang("app.register.invalid-feedback.banking_account_name")
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="banking_account_number" class="form-label">Số tài khoản<span
                                        class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('banking_account_number') is-invalid @enderror"
                                   name="banking_account_number" value="{{ $customer->banking_account_number }}" id="banking_account_number"
                                   placeholder="Nhập số tài khoản" required>
                            @error('banking_account_number')
                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                            @enderror
                            <div class="invalid-feedback">
                                @lang("app.register.invalid-feedback.banking_account_number")
                            </div>
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

@section('script')
    <script src="{{ URL::asset('assets/libs/particles.js/particles.js.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/particles.app.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        var citis = document.getElementById("city");
        var districts = document.getElementById("district");
        var wards = document.getElementById("ward");
        var Parameter = {
            url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
            method: "GET",
            responseType: "application/json",
        };
        var promise = axios(Parameter);
        promise.then(function (result) {
            renderCity(result.data);
        });

        function renderCity(data) {
            for (const x of data) {
                citis.options[citis.options.length] = new Option(x.Name, x.Name);
            }
            citis.onchange = function () {
                district.length = 1;
                ward.length = 1;
                if(this.value != ""){
                    const result = data.filter(n => n.Name === this.value);

                    for (const k of result[0].Districts) {
                        district.options[district.options.length] = new Option(k.Name, k.Name);
                    }
                }
            };
            district.onchange = function () {
                ward.length = 1;
                const dataCity = data.filter((n) => n.Name === citis.value);
                if (this.value != "") {
                    const dataWards = dataCity[0].Districts.filter(n => n.Name === this.value)[0].Wards;

                    for (const w of dataWards) {
                        wards.options[wards.options.length] = new Option(w.Name, w.Name);
                    }
                }
            };
        }
    </script>
@endsection