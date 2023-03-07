<?php
namespace App\Datatables;

use App\Models\User;
use App\Core\Datatables\DatatablesService;

class UserTables extends DatatablesService{

    public function query()
    {
        $query = User::query();
        return $query->orderBy('id', 'asc');
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
            'data' => 'name',
            'name' => 'name',
            'title' => 'Tên',
            'searchable' => true,
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'class' => 'dt-id'
        ]);
        $this->addColumn([
            'data' => 'email',
            'name' => 'email',
            'title' => 'Email',
            'searchable' => true,
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
        ]);

        $this->addColumn([
            'data' => 'roles',
            'name' => 'roles',
            'title' => 'Phân quyền',
            'searchable' => true,
            'orderable' => true,
            'exportable' => true,
            'printable' => false,
            'class' => 'dt-date',
            'render' => function($value){
                return $value->getRole()->title ?? '';
            },
        ]);

        $this->addColumn([
            'data' => 'created_at',
            'name' => 'created_at',
            'title' => 'Gia nhập ngày',
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
            'title' => 'Hành động',
            'raw' => true,
            'render' => function($value){
                return view('dashboard.pages.users.partials.action', ['value' => $value]);
            },
        ]);
    }
}