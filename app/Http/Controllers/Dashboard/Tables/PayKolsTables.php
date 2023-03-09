<?php

class PayKolsTables extends \App\Core\Datatables\DatatablesService{

    public function query()
    {
       return \App\Models\Customer::query();
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
    }
}