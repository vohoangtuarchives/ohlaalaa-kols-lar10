@extends('index.layouts.master')
@section('content')
    <div class="row">
        <div class="col">
            <div class="h-100 row">
                <div class="mb-3">
                    <label for="useremail" class="form-label">Link kết nối </label>
                    <input type="text" class="form-control" value="{{ route("register") }}?phone={{ \Illuminate\Support\Facades\Auth::guard("customers")->user()->phone }}">

                </div>
                <div class="mb-3">
                    <div class="visible-print text-center">
                        {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(250)->generate(route("register").'?phone='.\Illuminate\Support\Facades\Auth::guard("customers")->user()->phone ); !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

