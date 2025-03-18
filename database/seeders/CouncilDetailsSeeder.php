<?php

namespace Database\Seeders;

use App\Models\CouncilDetails;
use Illuminate\Database\Seeder;

class CouncilDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CouncilDetails::create(['fldCouncilName' => 'Attanagalla PS','fldIdElectorate' => '1']);
        CouncilDetails::create(['fldCouncilName' => 'Biyagama PS','fldIdElectorate' => '2']);
        CouncilDetails::create(['fldCouncilName' => 'Divulapitiya PS','fldIdElectorate' => '3']);
        CouncilDetails::create(['fldCouncilName' => 'Dompe PS','fldIdElectorate' => '4']);
        CouncilDetails::create(['fldCouncilName' => 'Gampaha MC','fldIdElectorate' => '5']);
        CouncilDetails::create(['fldCouncilName' => 'Gampaha PS','fldIdElectorate' => '5']);
        CouncilDetails::create(['fldCouncilName' => 'Ja-Ela UC','fldIdElectorate' => '6']);
        CouncilDetails::create(['fldCouncilName' => 'Ja-Ela PS','fldIdElectorate' => '6']);
        CouncilDetails::create(['fldCouncilName' => 'Katana PS','fldIdElectorate' => '7']);
        CouncilDetails::create(['fldCouncilName' => 'Katunayake-SeeduwaUC','fldIdElectorate' => '7']);
        CouncilDetails::create(['fldCouncilName' => 'Kelaniya PS','fldIdElectorate' => '8']);
        CouncilDetails::create(['fldCouncilName' => 'Peliyagoda UC','fldIdElectorate' => '8']);
        CouncilDetails::create(['fldCouncilName' => 'Mahara PS','fldIdElectorate' => '9']);
        CouncilDetails::create(['fldCouncilName' => 'Minuwangoda UC','fldIdElectorate' => '10']);
        CouncilDetails::create(['fldCouncilName' => 'Minuwangoda PS','fldIdElectorate' => '10']);
        CouncilDetails::create(['fldCouncilName' => 'Mirigama PS','fldIdElectorate' => '11']);
        CouncilDetails::create(['fldCouncilName' => 'Negombo MC','fldIdElectorate' => '12']);
        CouncilDetails::create(['fldCouncilName' => 'Wattala UC','fldIdElectorate' => '13']);
        CouncilDetails::create(['fldCouncilName' => 'Wattala PS','fldIdElectorate' => '13']);
    }
}
