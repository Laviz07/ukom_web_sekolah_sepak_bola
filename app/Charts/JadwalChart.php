<?php

namespace App\Charts;


use App\Models\Jadwal;
use Carbon\Carbon;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class JadwalChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        // $jadwals = Jadwal::all();
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $data = [];

        foreach ($months as $month) {
            $beritas = Jadwal::whereMonth('created_at', Carbon::parse($month)->month)  
                              ->whereYear('created_at', Carbon::now()->year)
                              ->get();                          
            
            $data[] = $beritas->count();
        }

        return $this->chart->barChart()
            ->setTitle('Jadwal Bulanan')
            ->setSubtitle(date('Y'))
            ->setWidth(500)
            ->setHeight(444)
            ->addData('Berita', $data)
            ->setXAxis($months);
    }
}
