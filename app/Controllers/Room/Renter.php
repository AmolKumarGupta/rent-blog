<?php

namespace App\Controllers\Room;

use App\Controllers\BaseController;
use App\Libraries\Breadcrumb;

class Renter extends BaseController
{
    public function info($id)
    {
        $faker = \Faker\Factory::create();
        $data = [
            'name'=> $faker->name(),
            'members'=> $faker->randomDigit(),
            'phone'=> $faker->phoneNumber(),
            'job'=> $faker->jobTitle(),
            'note'=> $faker->text()
        ];

        $roomName = 'Left-sided Room';
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
