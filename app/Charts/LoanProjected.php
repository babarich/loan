<?php

namespace App\Charts;

use App\Models\Loan\LoanSchedule;
use App\Models\Loan\PaymentLoan;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class LoanProjected
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): array
    {
        $data = LoanSchedule::query()->get();
        $groupedData = $data->groupBy(function($item) {
            return Carbon::parse($item->due_date)->format('M');
        });

        $totals = $groupedData->map(function($group) {
            return $group->sum('amount');
        });



        return $this->chart->barChart()
            ->addData('Amount', $totals->values()->toArray())
            ->setXAxis($totals->keys()->toArray())
            ->setHeight(350)
            ->setColors([ '#DC3545'])
            ->toVue();
    }
}
