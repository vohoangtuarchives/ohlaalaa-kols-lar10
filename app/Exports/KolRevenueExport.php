<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class KolRevenueExport implements FromView, ShouldAutoSize
{
    protected $customerTransactions;

    public function __construct($customerTransactions)
    {
        $this->customerTransactions = $customerTransactions;
    }


    public function view(): View
    {
        return view('exports.kols-revenue', [
            'transactions' => $this->customerTransactions
        ]);
    }
}
