@extends('index.layouts.master')
@section('content')
    <div class="row">
        <div class="col">
            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-md-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column justify-content-end">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">Xin chào, {{ core()->auth()->user()->name }}!</h4>
                            </div>
                            <div class="mt-3 mt-lg-0 me-3">
                                <form action="" method="GET">
                                    <div class="row g-3 mb-0 align-items-center">
                                        <div class="col-sm-auto">
                                            <div class="input-group">
                                                <input type="text" name="start_date" id="startPicker"
                                                       class="form-control border-0 dash-filter-picker shadow"
                                                       data-provider="flatpickr"
                                                       data-date-format="d-m-Y"
                                                       data-deafult-date="{{ $startDate }}" >
                                                <div
                                                        class="input-group-text bg-primary border-primary text-white">
                                                    From
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-auto">
                                            <div class="input-group">
                                                <input type="text" name="end_date"
                                                       class="form-control border-0 dash-filter-picker shadow" id="endPicker"
                                                       data-provider="flatpickr"
                                                       data-date-format="d-m-Y"
                                                       data-deafult-date="{{ $endDate }}">
                                                <div
                                                        class="input-group-text bg-primary border-primary text-white">
                                                    To
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-soft-success"><i
                                                        class="ri-add-circle-line align-middle me-1"></i>
                                                Refresh</button>
                                        </div>

                                    </div>
                                    <!--end row-->
                                </form>
                            </div>
{{--                            <div class="col-auto">--}}
{{--                                <button type="button" class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn"><i class="ri-pulse-line"></i></button>--}}
{{--                            </div>--}}
                        </div><!-- end card header -->
                    </div>
                    @if(empty(Auth::guard("customers")->user()->banking_account_number) || 
                        empty(Auth::guard("customers")->user()->banking_account_name) ||
                        empty(Auth::guard("customers")->user()->banking_name))
                        <div class="col-md-12 mt-3">
                            <!-- Info Alert -->
                            <div class="alert alert-warning" role="alert">
                                Xin vui lòng xác lập thông tin chuyển khoản <a href="{{ route("profile.settings") }}"><strong> ở đây </strong></a>
                            </div>

                        </div>
                    @endif
                    <!--end col-->
                </div>
            </div> <!-- end .h-100-->
        </div> <!-- end col -->
    </div>

    <div class="row">
        <div class="col-lg-7 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">{{ Auth::guard("customers")->user()->name }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            @foreach($referral_level_1_2 as $referrer_level_1)
                            <div class="verti-sitemap my-3">
                                <ul class="list-unstyled mb-0" >
                                    <li class="p-0 parent-title">
                                        <a href="javascript: void(0);" class="fw-medium fs-14 d-inline-block me-2">
                                            <span class=" badge-border badge-soft-success px-2">{{ $referrer_level_1->name }}</span>
                                            <span  class="text-danger d-inline-block">{{ $referrer_level_1->phone }}</span>
                                        </a>

                                    </li>
                                    <li>
                                    @foreach($referrer_level_1->referrals as $referrer_level_2)
                                        <div class="first-list">
                                            <div class="list-wrap">
                                                <a href="javascript: void(0);"
                                                   class="fw-medium text-primary d-inline-block">
                                                    <span class="badge-border badge-soft-secondary px-2" style="margin-left: 6px">{{ $referrer_level_2->name }}</span>
                                                    <span href="tel:{{ $referrer_level_2->phone }}"
                                                          class="ms-3 text-danger d-inline-block text-danger">
                                                        {{ $referrer_level_2->phone }}
                                                    </span>
                                                </a>

                                            </div>
                                            @if(($referral_3 = $referrer_level_2->referrals()->get(['id', 'phone', 'full_name', 'name'])))
                                                <ul class="second-list list-unstyled">
                                                    @foreach($referral_3 as $referrer_level_3)
                                                        <li>
                                                            <a href="javascript: void(0);" class="d-inline-block">
                                                                <span class="badge-border badge-soft-info px-2" style="margin-left: 6px">
                                                                    {{ $referrer_level_3->name }}
                                                                </span>
                                                                <span class="ms-3 text-danger d-inline-block text-danger">{{ $referrer_level_3->phone }}</span>
                                                            </a>
                                                            @if(1 < 0)
                                                                <ul class="third-list list-unstyled">
                                                                    @foreach($referrer_level_3->referrals()->get(['id', 'phone', 'full_name', 'name']) as $referrer_level_4)
                                                                    <li>
                                                                        <a href="javascript: void(0);">
                                                                            <span class="badge-border badge-soft-dark px-2" style="margin-left: 6px">
                                                                                {{ $referrer_level_4->name }}
                                                                            </span>
                                                                            <span class="ms-3 text-danger d-inline-block text-danger">{{ $referrer_level_4->phone }}</span>
                                                                        </a>
                                                                    </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    @endforeach
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    <!--end row-->
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-lg-5 col-12">
            <div class="card">
                <div class="card-body">
                    <ul id="customer_transactions" class="list-group">
                    @foreach($transactions as $transaction)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                [{{$transaction->created_at}}]
                                {{ $transaction->content }}
                            </span>
                            <span class="badge badge-soft-success fs-15">{{ core()->format_money($transaction->amount, 'đ') }}</span>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
@endsection
@section('script')

@endsection
@push("css")
    <style>
        .verti-sitemap .first-list .second-list li, .verti-sitemap .first-list .third-list li{
            padding-bottom: 10px;
        }
    </style>
@endpush