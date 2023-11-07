<?php

namespace App\Charts;

use App\Models\Users;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class DataChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): LarapexChart
    {
        $siswaKelas = Users::get();
        $data = [
            $siswaKelas->where('kelas', 10)->count(),
            $siswaKelas->where('kelas', 11)->count(),
            $siswaKelas->where('kelas', 12)->count(),

        ];

        $label = [
            'kelas 10',
            'kelas 11',
            'kelas 12',
        ];

        return $this->chart->pieChart()
            ->setTitle('Data Siswa PerKelas')
            ->setSubtitle(date('Y'))
            ->addData($data)
            ->setLabels($label);
    }
}
