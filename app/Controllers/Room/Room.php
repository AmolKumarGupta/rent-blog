<?php

namespace App\Controllers\Room;

use App\Controllers\BaseController;
use App\Libraries\Breadcrumb;

class Room extends BaseController
{
    public function index($id)
    {
        $roomName = 'Left-sided Room';


        $breadcrumb = new Breadcrumb($roomName, [
            'Room'=> '/',
            $roomName=> 'rooms/'.$id,            
        ]);

        return view('rooms/room', [
            'breadcrumb'=> $breadcrumb
        ]);
    }
}
