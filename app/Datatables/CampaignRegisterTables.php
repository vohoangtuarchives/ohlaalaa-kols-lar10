<?php
namespace App\Datatables;

use App\Models\Campaign;
use App\Core\Datatables\DatatablesService;
use App\Models\Customer;
use App\Models\CustomerCampaign;
use Illuminate\Support\Facades\DB;

class CampaignRegisterTables extends DatatablesService{

    public function query()
    {
//       $query = CustomerCampaign::with(["customer", "campaign"]);
       $query = CustomerCampaign::query()
           ->join('customers', 'customers.id', '=', 'customer_campaigns.customer_id')
           ->join('campaigns', 'campaigns.id', '=', 'customer_campaigns.campaign_id')
           ->select([
               "customers.id as customer_id",
               "customers.name as name",
               "customers.phone as phone",
               "customers.email as email",
               "campaigns.title as title",
               "campaigns.id as campaign_id",
               "customer_campaigns.amount as amount",
               "customer_campaigns.status as status",
               "customer_campaigns.created_at as created_at",
           ])->get();


        if(isset($this->request['status'])){
            if($this->request['status'] != 'all'){
                $query = $query->where("status", '=', $this->request['status']);
            }
        }
       return $query;
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
            'data' => 'customer_id',
            'name' => 'customer_id',
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
            'class' => 'dt-medium'
        ]);

        $this->addColumn([
            'data' => 'phone',
            'name' => 'phone',
            'title' => 'Điện thoại',
            'searchable' => false,
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'class' => 'dt-medium'
        ]);

        $this->addColumn([
            'data' => 'email',
            'name' => 'email',
            'title' => 'EMail',
            'searchable' => true,
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'class' => 'dt-medium'
        ]);

        $this->addColumn([
            'data' => 'title',
            'name' => 'title',
            'title' => 'Chiến dịch',
            'searchable' => false,
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
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

        $this->addColumn([
            'data' => 'status',
            'name' => 'status',
            'title' => 'Tình trạng',
            'searchable' => true,
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'class' => 'dt-date',
            'raw' => true,
            'render' => function($value) {
                return view("dashboard.pages.campaigns.register.status", [
                    'status' => $value->status
                ]);
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

        $this->addColumn([
            'data' => 'created_at',
            'name' => 'created_at',
            'title' => 'Created date',
            'searchable' => true,
            'orderable' => true,
            'exportable' => true,
            'printable' => true,
            'class' => 'dt-date'
        ]);


        $this->addColumn([
            'data' => 'payment',
            'name' => 'payment',
            'title' => 'Thu Tiền',
            'searchable' => false,
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'class' => 'dt-date',
            'render' => function($value){
                return view("dashboard.pages.campaigns.register.action", [
                    'campaign_id' => $value->campaign_id,
                    'customer_id' => $value->customer_id,
                    'status'    => $value->status
                ]);
            },
            'raw' => true
        ]);
    }
}