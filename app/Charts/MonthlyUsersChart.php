<?php

namespace App\Charts;

use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyUsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        return $this->chart->pieChart()
            ->setTitle('User Paling Aktif dan Tidak Aktif')
            ->addData([
                User::where('id_user', '<=', 60)->count(), 
                User::where('id_user', '>', 60)->count()])
            ->setColors(['#ffc63b', '#ff6384'])
            ->setLabels(['Active users', 'Inactive users']);
    }
}
