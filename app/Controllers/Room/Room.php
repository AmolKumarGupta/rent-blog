<?php

namespace App\Controllers\Room;

use App\Controllers\BaseController;
use App\Libraries\Breadcrumb;
use CodeIgniter\I18n\Time;

class Room extends BaseController
{
    public function __construct() {
        helper('chargetype');
        helper('rooms');
    }

    public function index($id) {
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

        $current_room_renter_id = $room['renter_id'];
        $time = Time::now();
        $list_of_months = config('Calender')->months;
        $room_rent = room_rent($id);

        return view('rooms/history', compact('id', 'current_room_renter_id', 'breadcrumb', 'list_of_months', 'time', 'room_rent'));
    }

    public function savehistory() {
        $request = service('request');

        dd( $request->getPost() );
    }
}
