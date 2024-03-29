@extends('index.layouts.master')
@section('content')
    <div class="row">
        <div class="col">
            <div class="h-100 row">
                @foreach($campaigns as $campaign)
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="d-lg-flex align-items-center">
                                    <div class="ms-lg-3 my-3 my-lg-0">
                                        <span class="fs-15 text-uppercase">{{ $campaign->title }}</span>
                                    </div>
                                    <div class="d-flex gap-4 mt-0 mx-auto">
                                        <div>
                                            <i class="ri-map-pin-2-line text-primary me-1 align-bottom fs-16"></i> {{ core()->format_money($campaign->amount) }}
                                        </div>
                                    </div>

                                    <div>
                                        @if(!$campaign->customer(\Illuminate\Support\Facades\Auth::guard("customers")->id()))
                                            <a class="btn btn-soft-success" href="javascript:void();" onclick="event.preventDefault(); document.getElementById('join-campaign-form').submit();">
                                                <i class="bx bx-power-off font-size-16 align-middle me-1"></i> <span key="t-logout">Tham gia</span></a>
                                            <form id="join-campaign-form" action="{{ route('index.campaign.join') }}" method="POST" style="display: none;">
                                                @csrf
                                                <input type="hidden" name="campaign" value="{{$campaign->id}}">
                                            </form>

                                        @else
                                            <a href="#" class="btn btn-soft-danger">Đã Tham gia</a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection