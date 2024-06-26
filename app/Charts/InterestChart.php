<?php

namespace App\Charts;

use App\Models\Loan\LoanSchedule;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class InterestChart
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
            return $group->sum('interest_paid');
        });


        return $this->chart->areaChart()
            ->addData('Interest Paid', $totals->values()->toArray())
            ->setXAxis($totals->keys()->toArray())
            ->setColors(['#259AE6', '#DC3545'])
            ->toVue();
    }
}
