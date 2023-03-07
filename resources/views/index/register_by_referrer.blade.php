@extends('layouts.master-without-nav')
@section('title')
    Kết nối bởi KOL {{ $referrer->full_name ?? '' }}
@endsection
@section('content')
    <form method="POST">
    @csrf

    <div class="container">
        <div class="card mt-5">
            <div class="card-body">

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
                    <x-input-label for="phone" :value="__('Mật khẩu')" />
                    <x-text-input id="phone" class="block mt-1 w-full" type="phone" name="phone" :value="old('password')" required autofocus />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mb-3">
                    <x-input-label for="phone" :value="__('Xác Nhận Mật khẩu')" />
                    <x-text-input id="phone" class="block mt-1 w-full" type="phone" name="phone" :value="old('repassword')" required autofocus />
                    <x-input-error :messages="$errors->get('repassword')" class="mt-2" />
                </div>

                <div class="mb-3">
                    <x-input-label>
                        <x-slot name="value">
                            Bạn muốn tham gia chương trình nào của chúng tôi
                        </x-slot>
                    </x-input-label>

                    @foreach($campaigns as $campaign)
                        <div class="form-check form-switch form-switch-custom form-switch-success mb-3">
                            <input class="form-check-input" type="checkbox" name="campaign[]" value="{{$campaign->slug}}" role="switch" id="SwitchCheck{{$campaign->id}}">
                            <label class="form-check-label" for="SwitchCheck{{$campaign->id}}">{{ $campaign->title }} (<span class="text-red">{{core()->format_money($campaign->amount)}} đ</span>)</label>
                        </div>
                    @endforeach
                </div>


                <div class="mb-3">
                    <x-input-label for="referral_code" class="fs-16">
                        <x-slot name="value">{!! __('app.referral_code_of', ['name' => $referrer->full_name]) !!}</x-slot>
                    </x-input-label>
                    <x-text-input id="email" class="d-none" type="text" :value=" $referrer->referral_code ?? ''" autofocus />
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
            <button type="submit" class="btn btn-success w-sm">Xác Nhận</button>
        </div>
    </div>
    </form>
@endsection
<!-- end auth-page-wrapper -->
@section('script')
    <script src="{{ URL::asset('assets/libs/particles.js/particles.js.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/particles.app.js') }}"></script>

@endsection