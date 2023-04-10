<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\KolRevenueExport;
use App\Http\Controllers\Controller;

use App\Models\CustomerTransaction;
use App\Repository\CustomerCampaigns\CustomerCampaignRepositoryContract;

use App\Datatables\CustomerCampaignTables;
use App\Models\CustomerCampaign;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    protected $startDate;
    protected $endDate;

    protected $currentDate;
    public function showKolRevenue(Request $request){
        $this->currentDate = Carbon::now();
        $this->startDate = $this->currentDate->clone();
        $this->startDate = $this->startDate->subDays(7)->startOfDay();
        $this->endDate = null;

        if(request()->has('startDate') && !empty(request()->get('startDate'))){
            $this->startDate = Carbon::createFromFormat('d-m-Y', request()->get('startDate'));
            $this->startDate = $this->startDate->startOfDay();
        }
        if(request()->has('endDate') && !empty(request()->get('endDate'))){
            $this->endDate = Carbon::createFromFormat('d-m-Y', request()->get('endDate'));
        }

        return view("dashboard.pages.reports.revenue", [
            'startDate' => $this->startDate->format('d-m-Y'),
            'endDate'   => $this->endDate ? $this->endDate->format('d-m-Y'): $this->currentDate->format('d-m-Y'),
        ]);
    }

    public function exportKolRevenue(Request $request){

        if($request->has('startDate') && !empty($request->get('startDate'))) {
            $startDate = Carbon::createFromFormat('d-m-Y', $request->get('startDate'))->startOfDay();
        }

        if(request()->has('endDate') && !empty(request()->get('endDate'))){
            $endDate = Carbon::createFromFormat('d-m-Y', request()->get('endDate'))->endOfDay();
        }

        $customerTransactions =
            CustomerTransaction::with("customer")
                ->select(["customer_id",DB::raw('SUM(amount) as sum')])
            ->where("updated_at", ">=", $startDate->format("Y-m-d H:i:s"))
            ->where("updated_at", "<=", $endDate->format("Y-m-d H:i:s"))
            ->groupBy("customer_id")
            ->get();

//        return (new KolRevenueExport($customerTransactions))->download('invoices.xlsx');
        return Excel::download(new KolRevenueExport($customerTransactions), 'kol-revenue-'.$startDate->format("Y-m-d").'_'.$endDate->format("Y-m-d").'.xlsx');

    }
}