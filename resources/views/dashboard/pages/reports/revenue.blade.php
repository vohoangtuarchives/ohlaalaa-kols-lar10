@extends("layouts.master")
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center g-3">
                        <div class="col-md-3">
                            <h5 class="card-title mb-0">Thu nhập Kols</h5>
                        </div>
                        <div class="col-sm-auto ms-auto">
                            <div class="d-flex flex-wrap align-items-start justify-content-end gap-2">
                                <form action="{{ route("dashboard.reports.kols.revenue.export") }}" method="GET">
                                    <div class="row g-3 mb-0 align-items-center">
                                        <div class="col-sm-auto">
                                            <div class="input-group">
                                                <input type="text" name="startDate" id="startPicker"
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
                                                <input type="text" name="endDate"
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
                                                Export</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




