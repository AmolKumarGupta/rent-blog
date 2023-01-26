<?php

namespace App\Controllers\Room;

use App\Controllers\BaseController;
use App\Libraries\Breadcrumb;
use CodeIgniter\I18n\Time;

class Room extends BaseController
{
    public function index($id)
    {
        $roomModel = model('RoomModel');
        $room = $roomModel->find($id);
        
        $time = Time::now();
        $preTime = $time->subMonths(1);
        
        $roomName = ucwords($room['name']);
        $breadcrumb = new Breadcrumb($roomName, [
            'Room'=> '/',
            $roomName=> 'rooms/'.$id,            
        ]);

        return view('rooms/room', compact('breadcrumb', 'time', 'preTime'));
    }

    public function history($id) {
        $roomModel = model('RoomModel');
        $room = $roomModel->find($id);
        
        $roomName = ucwords($room['name']);
        $breadcrumb = new Breadcrumb($roomName, [
            $roomName=> 'rooms/'.$id,
            'History'=> '',
        ]);

        return view('rooms/history', compact('breadcrumb'));
    }
}
