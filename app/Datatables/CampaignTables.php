<?php
namespace App\Datatables;

use App\Models\Campaign;
use App\Core\Datatables\DatatablesService;

class CampaignTables extends DatatablesService{

    public function query()
    {
        $query = Campaign::with("rebates")->select(['id' , 'title', 'amount', 'rebate_levels' , 'created_at']);
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
            'data' => 'title',
            'name' => 'title',
            'title' => 'Title',
            'searchable' => true,
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'class' => 'dt-medium'
        ]);

        $this->addColumn([
            'data' => 'amount',
            'name' => 'amount',
            'title' => __('admin.pages.amount'),
            'searchable' => true,
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'class' => 'dt-date',
            'render' => function($value) {
                return core()->format_money($value->amount);
            }
        ]);

//        $this->addColumn([
//            'data' => 'rebate_levels',
//            'name' => 'rebate_levels',
//            'title' => __('admin::pages.rebate_levels'),
//            'searchable' => true,
//            'orderable' => true,
//            'exportable' => true,
//            'printable' => true,
//            'class' => 'dt-date',
//            'render' => function($value) {
//                return $value->rebate_levels;
//            }
//        ]);
        for ($i = 1; $i<=3; $i++){
            $leveli = 'currenRateLevel_'.$i;
            $this->addColumn([
                'data' => 'level_'.$i,
                'name' => 'level_'.$i,
                'title' => '% cấp '. $i,
                'searchable' => false,
                'orderable' => false,
                'exportable' => false,
                'printable' => true,
                'class' => 'dt-date',
                'render' => function($value) use ($leveli){
                    return $value->{$leveli}() ?? 0;
                },
            ]);
        }

        $this->addColumn([
            'data' => 'created_at',
            'name' => 'created_at',
            'title' => 'Created date',
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
                return view('dashboard.pages.campaigns.partials.action', [
                    'value' => $value,
                    'entity' => "campaigns"
                ]);
            },
        ]);
    }
}