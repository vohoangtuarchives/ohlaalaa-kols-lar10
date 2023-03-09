@extends("layouts.master")
@section("content")
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center g-3">
                        <div class="col-md-3">
                            <h5 class="card-title mb-0">Danh sách đăng ký tham gia Campaign mới</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center g-3">
                        <div class="col-md-3">
                            <a class="btn btn-outline-warning" href="?status=pending">Pending</a>
                            <a class="btn btn-outline-success" href="?status=completed">Completed</a>
                        </div>
                        <div class="col-md-auto ms-auto">
                            <div class="d-flex gap-2">
                                <div class="search-box">
                                    <input type="text" class="form-control search" placeholder="Search for name or email ..." id="custom-input-search">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                                <button class="btn btn-success" id="custom-btn-submit"><i class="ri-equalizer-line align-bottom me-1" ></i> Search</button>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                </div>
                <div class="card-body p-4">
                    {{ $datatables->html() }}
                </div>
            </div>
        </div>
    </div>
    @include("dashboard.pages.$entity.modal.create")
    <div id="updateContentEdit"></div>
@endsection
@section("script")
    {{ $datatables->includeScript() }}

    <script>
        function makePayment(id, customer){
            Swal.fire({
                title: "Xác nhận đã thu tiền?",
                text: "Hãy kiểm tra lại, hãy xác nhận nếu đã thu tiền rồi!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
                cancelButtonClass: 'btn btn-danger w-xs mt-2',
                confirmButtonText: "Đã thu tiền!",
                buttonsStyling: false,
                showCloseButton: true
            }).then(function (result) {
                if (result.value) {
                    try {
                        axios.post('{{route("dashboard.".$entity.".register.make-payment")}}', {
                                id: id,
                                customer: customer
                        }).then(function (response) {
                            if(response.data.success){
                                location.reload();
                            }
                        })
                    } catch (error) {
                        console.log(error)
                    }
                }
            });
        }
        function showEditModal(id){
            try {
                axios.get('{{request()->url()}}/edit/'+id, {
                    data: {
                        id: id
                    }
                }).then(function (response) {
                    document.getElementById('updateContentEdit').innerHTML = response.data;
                    let myModal = new bootstrap.Modal(document.getElementById('showUpdateModal'), {
                        keyboard: false
                    });
                    myModal.show();
                })
            } catch (error) {
                console.log(error)
            }

        }
        function deleteMultiple() {
            ids_array = [];
            var items = document.getElementsByName('chk_child');
            for (i = 0; i < items.length; i++) {
                if (items[i].checked == true) {
                    ids_array.push(items[i].value);
                }
            }

            if (typeof ids_array !== 'undefined' && ids_array.length > 0) {
                singleDelete(ids_array);
            } else {
                Swal.fire({
                    title: 'Please select at least one checkbox',
                    confirmButtonClass: 'btn btn-info',
                    buttonsStyling: false,
                    showCloseButton: true
                });
            }
        }
    </script>

@endsection

@push("css")
    {{ $datatables->includeStyles() }}
@endpush
@push("js")
    {{ $datatables->script() }}
@endpush


