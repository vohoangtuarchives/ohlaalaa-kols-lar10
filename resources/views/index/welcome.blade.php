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

                    <!--end col-->
                </div>
            </div> <!-- end .h-100-->
        </div> <!-- end col -->
    </div>

    <div class="row">
        <div class="col-md-8 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">{{ Auth::guard("customers")->user()->full_name }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            @foreach($referral_level_1_2 as $referrer_level_1)
                            <div class="verti-sitemap my-3">
                                <ul class="list-unstyled mb-0" >
                                    <li class="p-0 parent-title">
                                        <a href="javascript: void(0);" class="fw-medium fs-14 d-inline-block me-2">
                                            <span class=" badge-border badge-soft-success px-2">{{ $referrer_level_1->full_name }}</span>
                                            <span  class="text-danger d-inline-block">{{ $referrer_level_1->phone }}</span>
                                        </a>

                                    </li>
                                    <li>
                                    @foreach($referrer_level_1->referrals as $referrer_level_2)
                                        <div class="first-list">
                                            <div class="list-wrap">
                                                <a href="javascript: void(0);"
                                                   class="fw-medium text-primary d-inline-block">
                                                    <span class="badge-border badge-soft-secondary px-2" style="margin-left: 6px">{{ $referrer_level_2->full_name }}</span>
                                                    <span href="tel:{{ $referrer_level_2->phone }}" class="ms-3 text-danger d-inline-block text-danger">{{ $referrer_level_2->phone }}</span>
                                                </a>

                                            </div>
                                            @if(($referral_3 = $referrer_level_2->referrals()->get(['id', 'phone', 'full_name', 'name'])))
                                                <ul class="second-list list-unstyled">
                                                    @foreach($referral_3 as $referrer_level_3)
                                                        <li>
                                                            <a href="javascript: void(0);" class="d-inline-block">
                                                                <span class="badge-border badge-soft-info px-2" style="margin-left: 6px">
                                                                    {{ $referrer_level_3->full_name }}
                                                                </span>
                                                                <span class="ms-3 text-danger d-inline-block text-danger">{{ $referrer_level_3->phone }}</span>
                                                            </a>
                                                            @if(1 < 0)
                                                                <ul class="third-list list-unstyled">
                                                                    @foreach($referrer_level_3->referrals()->get(['id', 'phone', 'full_name', 'name']) as $referrer_level_4)
                                                                    <li>
                                                                        <a href="javascript: void(0);">
                                                                            <span class="badge-border badge-soft-dark px-2" style="margin-left: 6px">
                                                                                {{ $referrer_level_4->full_name }}
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
        <div class="col-md-4 col-12">
            <div class="card">
                <div class="card-body">
                    @foreach($transactions as $transaction)
                        <p>{{ $transaction->content }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script>
        var flatpickrExamples = document.querySelectorAll("[data-provider]");
        Array.from(flatpickrExamples).forEach(function (item) {
            if (item.getAttribute("data-provider") == "flatpickr") {
                var dateData = {};
                var isFlatpickerVal = item.attributes;
                if (isFlatpickerVal["data-date-format"])
                    dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
                if (isFlatpickerVal["data-enable-time"]) {
                    (dateData.enableTime = true),
                        (dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString() + " H:i");
                }
                if (isFlatpickerVal["data-altFormat"]) {
                    (dateData.altInput = true),
                        (dateData.altFormat = isFlatpickerVal["data-altFormat"].value.toString());
                }
                if (isFlatpickerVal["data-minDate"]) {
                    dateData.minDate = isFlatpickerVal["data-minDate"].value.toString();
                    dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
                }
                if (isFlatpickerVal["data-maxDate"]) {
                    dateData.maxDate = isFlatpickerVal["data-maxDate"].value.toString();
                    dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
                }
                if (isFlatpickerVal["data-deafult-date"]) {
                    dateData.defaultDate = isFlatpickerVal["data-deafult-date"].value.toString();
                    dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
                }
                if (isFlatpickerVal["data-multiple-date"]) {
                    dateData.mode = "multiple";
                    dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
                }
                if (isFlatpickerVal["data-range-date"]) {
                    dateData.mode = "range";
                    dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
                }
                if (isFlatpickerVal["data-inline-date"]) {
                    (dateData.inline = true),
                        (dateData.defaultDate = isFlatpickerVal["data-deafult-date"].value.toString());
                    dateData.dateFormat = isFlatpickerVal["data-date-format"].value.toString();
                }
                if (isFlatpickerVal["data-disable-date"]) {
                    var dates = [];
                    dates.push(isFlatpickerVal["data-disable-date"].value);
                    dateData.disable = dates.toString().split(",");
                }
                if (isFlatpickerVal["data-week-number"]) {
                    var dates = [];
                    dates.push(isFlatpickerVal["data-week-number"].value);
                    dateData.weekNumbers = true
                }
                flatpickr(item, dateData);
            } else if (item.getAttribute("data-provider") == "timepickr") {
                var timeData = {};
                var isTimepickerVal = item.attributes;
                if (isTimepickerVal["data-time-basic"]) {
                    (timeData.enableTime = true),
                        (timeData.noCalendar = true),
                        (timeData.dateFormat = "H:i");
                }
                if (isTimepickerVal["data-time-hrs"]) {
                    (timeData.enableTime = true),
                        (timeData.noCalendar = true),
                        (timeData.dateFormat = "H:i"),
                        (timeData.time_24hr = true);
                }
                if (isTimepickerVal["data-min-time"]) {
                    (timeData.enableTime = true),
                        (timeData.noCalendar = true),
                        (timeData.dateFormat = "H:i"),
                        (timeData.minTime = isTimepickerVal["data-min-time"].value.toString());
                }
                if (isTimepickerVal["data-max-time"]) {
                    (timeData.enableTime = true),
                        (timeData.noCalendar = true),
                        (timeData.dateFormat = "H:i"),
                        (timeData.minTime = isTimepickerVal["data-max-time"].value.toString());
                }
                if (isTimepickerVal["data-default-time"]) {
                    (timeData.enableTime = true),
                        (timeData.noCalendar = true),
                        (timeData.dateFormat = "H:i"),
                        (timeData.defaultDate = isTimepickerVal["data-default-time"].value.toString());
                }
                if (isTimepickerVal["data-time-inline"]) {
                    (timeData.enableTime = true),
                        (timeData.noCalendar = true),
                        (timeData.defaultDate = isTimepickerVal["data-time-inline"].value.toString());
                    timeData.inline = true;
                }
                flatpickr(item, timeData);
            }
        });
        let startItemPicker = document.getElementById("startPicker");
        let endItemPicker = document.getElementById("endPicker");

        let startPicker = flatpickr(startItemPicker, timeData);
        let endPicker = flatpickr(endItemPicker, timeData);
    </script>
@endsection
@push("css")
    <style>
        .verti-sitemap .first-list .second-list li, .verti-sitemap .first-list .third-list li{
            padding-bottom: 10px;
        }
    </style>
@endpush