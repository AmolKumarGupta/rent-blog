<?php

namespace App\Controllers\Room;

use App\Controllers\BaseController;
use App\Libraries\Breadcrumb;

class Renter extends BaseController
{
    public function info($id)
    {
        $roomName = 'Left-sided Room';

        
        $faker = \Faker\Factory::create();
        $data = [
            'name'=> $faker->name(),
            'members'=> $faker->randomDigit(),
            'phone'=> $faker->phoneNumber(),
            'job'=> $faker->jobTitle(),
            'note'=> $faker->text()
        ];

        $breadcrumb = new Breadcrumb($data['name'], [
            'Room'=> '/',
            $roomName=> 'rooms/'.$id,
            'Renter'=> uri_string()
        ]);


        return view('rooms/renter', [
            'breadcrumb'=> $breadcrumb,
            'data'=> $data
        ]);
    }
}
