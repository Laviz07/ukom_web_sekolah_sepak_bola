<?php

namespace App\Charts;

use App\Models\Tim;
use Carbon\Carbon; 
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TimChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $months = [];
        $currMonth = Carbon::now()->month;
        for($i = 0; $i <= $currMonth; $i++){
        $monthNum = $i == 0 ? 12 : $i;
        $monthName = Carbon::createFromDate()->month($monthNum)->format('F');
        $months[$monthName] = 0; 
        }

         // hitung jumlah tim per bulan
         foreach($months as $monthName => $value){

            $firstDay = Carbon::parse('first day of ' . $monthName);
            $lastDay = Carbon::parse('last day of ' . $monthName);
        
            $total = Tim::where(function($query) use ($firstDay, $lastDay){
                $query->whereBetween('created_at', [  
                    $firstDay->format('Y-m-d'), 
                    $lastDay->format('Y-m-d')]);
            })->count();
        }


        $labels = [];
        foreach ($months as $monthName => $value) {
            if (is_numeric($monthName)) {
                continue;
            }

            $labels[] = $monthName;
        }

        // warna random & labels
        $colors = $this->rand_color(count($months));

        $data = array_values($months);
       
        return $this->chart->pieChart()
            ->setTitle("Aktivitas Tim Bulan Ini")
            ->addData($data)
            ->setLabels($labels)
            ->setColors([$colors]);
    }

    public function rand_color($count) {

        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);    
      }
}
