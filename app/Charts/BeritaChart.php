<?php

namespace App\Charts;

use App\Models\Berita;
use Carbon\Carbon;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class BeritaChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        // menambahkan 6 bulan terakhir
        // for ($i = 5; $i >= 0; $i--) {
        //     $month = Carbon::now()->subMonths($i)->format('F'); 
        //     $months[] = $month;
        // }
    
        $data = [];
    
        foreach ($months as $month) {     
    
            $beritas = Berita::whereMonth('created_at', Carbon::parse($month)->month)  
                              ->whereYear('created_at', Carbon::now()->year)
                              ->get();                          
            
            $data[] = $beritas->count();
        }

        return $this->chart->barChart()
            ->setTitle('Berita Bulanan')
            ->setSubtitle(date('Y'))
            ->setWidth(500)
            ->setHeight(444)
            ->addData('Berita', $data)
            ->setXAxis($months);
    }

    // public function shouldResetChart() 
    // {
    //     return Carbon::now()->startOfYear()->eq(Carbon::now());
    // }
}