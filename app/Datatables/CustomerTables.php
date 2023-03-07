<?php
namespace App\Datatables;

use App\Models\Customer;
use App\Core\Datatables\DatatablesService;

class CustomerTables extends DatatablesService{

    public function query()
    {
        $query = Customer::query();
        return $query->orderBy('id', 'desc');
    }

    public function columns()
    {
        $this->addColumn([
            'data' => 'checkbox',
            'class' => 'text-center dt-id',
            'searchable' => false,
            'orderable' => false,
            'title' => '<div class="form-check text-center">
                                <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                            </div>',
            'render' => function($value){
                return '<div class="custom-control custom-checkbox text-center">
                        <input type="checkbox" name="chk_child" value="'.$value->id.'" class="dataTable-checkbox">
                        </div>';
            },
            'raw' => true
        ]);
        $this->addColumn([
            'data' => 'id',
            'name' => 'id',
            'title' => 'Id',
            'searchable' => false,
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'class' => 'text-center dt-id'
        ]);

        $this->addColumn([
            'data' => 'email',
            'name' => 'email',
            'title' => 'Email',
            'searchable' => true,
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'class' => 'dt-medium'
        ]);


        $this->addColumn([
            'data' => 'name',
            'name' => 'name',
            'title' => 'Họ Tên',
            'searchable' => true,
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'class' => 'dt-medium'
        ]);
        $this->addColumn([
            'data' => 'phone',
            'name' => 'phone',
            'title' => 'Điện thoại',
            'searchable' => true,
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'class' => 'dt-medium'
        ]);

        $this->addColumn([
            'data' => 'balance',
            'name' => 'balance',
            'title' => 'Tài khoản',
            'searchable' => true,
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'class' => 'dt-date'
        ]);

        $this->addColumn([
            'data' => 'referral_code',
            'name' => 'referral_code',
            'title' => 'Mã kết nối',
            'searchable' => true,
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'class' => 'dt-date'
        ]);

        $this->addColumn([
            'data' => 'created_at',
            'name' => 'created_at',
            'title' => 'Ngày tham gia',
            'searchable' => true,
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'class' => 'dt-date',
            'render' => function($value){
                return date('d-m-Y', strtotime($value->created_at));
            },
        ]);

        $this->addColumn([
            'data' => 'action',
            'class' => 'text-center dt-id',
            'title' => 'Action',
            'raw' => true,
            'render' => function($value){
                return view('dashboard.pages.customers.partials.action', [
                    'value' => $value,
                    'entity' => "customers"
                ]);
            },
        ]);
    }
}