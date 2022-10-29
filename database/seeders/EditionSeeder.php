<?php

namespace Database\Seeders;

use App\Models\Edition;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = strtotime(date("Y/m/d"));

        for ($k = 1; $k < 5; $k++) {
            $exception = date("m", strtotime("+" . $k . " month", $time));
            if ($exception == '01') {
                $time = strtotime(date("Y/m/d", strtotime('+0 years')));
            }

            $monthNum = date("n", strtotime("+" . $k . " month", $time));
            $dateObj = DateTime::createFromFormat('!m', $monthNum);
            $monthName = $dateObj->format('F'); // March

            $edition = new Edition();
            $edition->title = $monthName . '-' . date("Y", strtotime("+" . $k . " month", $time));
            $edition->beginDate = date("Y-m-d", strtotime("+" . $k . " month", $time));
            $edition->endDate = date("Y-m-d", strtotime(
                "+" . ($k) . " month",
                $time
            ));

            $edition->space = 20;
            $edition->beginDateUpload = date("Y-m-d", strtotime("+" . $k . " month", $time));
            $edition->endDateUpload = date("Y-m-d", strtotime("+" . ($k) . " month", $time));

            $edition->save();
        }
    }
}
