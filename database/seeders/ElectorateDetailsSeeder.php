<?php

namespace Database\Seeders;

use App\Models\ElectorateDetails;
use Illuminate\Database\Seeder;

class ElectorateDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ElectorateDetails::create(['fldElectorateName' => 'Attanagalla']);
        ElectorateDetails::create(['fldElectorateName' => 'Biyagama']);
        ElectorateDetails::create(['fldElectorateName' => 'Divulapitiya']);
        ElectorateDetails::create(['fldElectorateName' => 'Dompe']);
        ElectorateDetails::create(['fldElectorateName' => 'Gampaha']);
        ElectorateDetails::create(['fldElectorateName' => 'Ja-Ela']);
        ElectorateDetails::create(['fldElectorateName' => 'Katana']);
        ElectorateDetails::create(['fldElectorateName' => 'Kelaniya']);
        ElectorateDetails::create(['fldElectorateName' => 'Mahara']);
        ElectorateDetails::create(['fldElectorateName' => 'Minuwangoda']);
        ElectorateDetails::create(['fldElectorateName' => 'Mirigama']);
        ElectorateDetails::create(['fldElectorateName' => 'Negombo']);
        ElectorateDetails::create(['fldElectorateName' => 'Wattala']);
    }
}
