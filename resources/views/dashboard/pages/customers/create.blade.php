@extends("layouts.master")
@section("content")
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <x-input-label for="username" :value="__('Username')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus />
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <x-input-label for="name" :value="__('Họ và Tên')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <x-input-label for="phone" :value="__('Điện thoại')" />
                            <x-text-input id="phone" class="block mt-1 w-full" type="phone" name="phone" :value="old('phone')" required autofocus />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>
                    </div>
                    <div class="mb-3">
                        @livewire("ui.city")
                    </div>
                    <div class="mb-3">
                        <x-input-label for="referral_code" :value="__('app.referral_code')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="text" :value="old('referral_code')" autofocus />
                        <x-input-error :messages="$errors->get('referral_code')" class="mt-2" />
                    </div>

{{--                    <div class="mb-3">--}}
{{--                        <label class="form-label">Content</label>--}}
{{--                        <textarea id="ckeditor-classic" name="content">--}}
{{--                        </textarea>--}}
{{--                    </div>--}}


                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

            <!-- end card -->
            <div class="text-end mb-4">
                <button type="submit" class="btn btn-success w-sm">Thêm mới</button>
            </div>
        </div>
        <!-- end col -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Trạng thái</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="choices-privacy-status-input" class="form-label">Trạng thái</label>
                        <select class="form-select" data-choices data-choices-search-false id="choices-privacy-status-input" name="visibility">
                            @foreach(\App\Models\Status::CUSTOMER_STATUS as $status)
                                <option value="{{$status}}">{{ __("app.customers.status.$status") }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <!-- end card body -->
            </div>
        </div>
        <!-- end col -->
    </div>
@endsection

@section("css")
{{--    <link href="{{ asset("assets/libs/dropzone/dropzone.css") }}" rel="stylesheet" type="text/css" />--}}

@endsection
@section("script")
{{--    <script src="{{asset("assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js")}}"></script>--}}
{{--    <script src="{{asset("assets/libs/dropzone/dropzone-min.js")}}"></script>--}}
{{--    <script src="{{asset("assets/js/pages/project-create.init.js")}}"></script>--}}
@endsection