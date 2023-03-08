@extends('layouts.master-without-nav')
@section('title')
    @lang('translation.signup')
@endsection
@section('content')

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <x-index.logo-text />
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-8">
                        <div class="card mt-4">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">@lang("app.register.new")</h5>
                                </div>
                                <div class="p-2 mt-4">
                                    <form class="needs-validation" novalidate method="POST"
                                        action="{{ route('register') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Họ và tên <span
                                                        class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                   name="name" value="{{ old('name') }}" id="name"
                                                   placeholder="Họ và tên" required>
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
                                            <label for="useremail" class="form-label">Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" id="useremail"
                                                placeholder="Nhập địa chỉ email" required>
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
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="username" value="{{ old('name') }}" id="username"
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

                                        <div class="mb-2">
                                            <label for="password" class="form-label">Mật Khẩu <span
                                                    class="text-danger">*</span></label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                id="userpassword" placeholder="Nhập mật khẩu" required>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback">
                                                @lang("app.register.invalid-feedback.password")
                                            </div>
                                        </div>
                                        <div class=" mb-4">
                                            <label for="input-password">Nhập Lại Mật Khẩu</label>
                                            <input type="password"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                name="password_confirmation" id="input-password"
                                                placeholder="@lang("app.register.password_confirmation")" required>

                                            <div class="form-floating-icon">
                                                <i data-feather="lock"></i>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4  mb-3">
                                                <select name="city" class="form-select" id="city" aria-label=".form-select-sm">
                                                    <option value="" selected>Chọn tỉnh thành</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4  mb-3">
                                                <select name="district" class="form-select" id="district" aria-label=".form-select-sm">
                                                    <option value="" selected>Chọn quận huyện</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4  mb-3">
                                                <select name="ward" class="form-select" id="ward" aria-label=".form-select-sm">
                                                    <option value="" selected>Chọn phường xã</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Điện thoại <span
                                                        class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                                   name="phone" value="{{ old('phone') }}" id="phone"
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
                                                <option value="Nam"  @if(old('gender') =='Nam') selected @endif>Nam</option>
                                                <option value="Nữ"  @if(old('gender') =='Nữ') selected @endif>Nữ</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <x-input-label>
                                                <x-slot name="value">
                                                    Bạn muốn tham gia chương trình nào của chúng tôi
                                                </x-slot>
                                            </x-input-label>

                                            @foreach($campaigns as $campaign)
                                                <div class="form-check form-switch form-switch-custom form-switch-success mb-3">
                                                    <input class="form-check-input" type="checkbox" name="campaign[]" value="{{ $campaign->id }}" role="switch" id="SwitchCheck{{$campaign->id}}">
                                                    <label class="form-check-label" for="SwitchCheck{{$campaign->id}}">{{ $campaign->title }} (<span class="text-red">{{core()->format_money($campaign->amount)}} đ</span>)</label>
                                                </div>
                                            @endforeach
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

{{--                                        <div class=" mb-4">--}}
{{--                                            <input type="file" class="form-control @error('avatar') is-invalid @enderror"--}}
{{--                                                name="avatar" id="input-avatar" required>--}}
{{--                                            @error('avatar')--}}
{{--                                                <span class="invalid-feedback" role="alert">--}}
{{--                                                    <strong>{{ $message }}</strong>--}}
{{--                                                </span>--}}
{{--                                            @enderror--}}
{{--                                            <div class="">--}}
{{--                                                <i data-feather="file"></i>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <div class="mb-4">
                                            <p class="mb-0 fs-12 text-muted fst-italic">Bằng cách đăng ký, bạn đồng ý với  <a href="#"
                                                    class="text-primary text-decoration-underline fst-normal fw-medium"> Điều khoản sử dụng</a> của chúng tôi</p>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">ĐĂNG KÝ</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">Đã có tài khoản ? <a href="{{ route("login") }}"
                                    class="fw-semibold text-primary text-decoration-underline"> Đăng nhập </a> </p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <x-index.footer />
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->
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
                citis.options[citis.options.length] = new Option(x.Name, x.Id);
            }
            citis.onchange = function () {
                district.length = 1;
                ward.length = 1;
                if(this.value != ""){
                    const result = data.filter(n => n.Id === this.value);

                    for (const k of result[0].Districts) {
                        district.options[district.options.length] = new Option(k.Name, k.Id);
                    }
                }
            };
            district.onchange = function () {
                ward.length = 1;
                const dataCity = data.filter((n) => n.Id === citis.value);
                if (this.value != "") {
                    const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;

                    for (const w of dataWards) {
                        wards.options[wards.options.length] = new Option(w.Name, w.Id);
                    }
                }
            };
        }
    </script>
@endsection
