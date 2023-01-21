<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\Breadcrumb;

class Setting extends BaseController
{
    public function __construct() {
        $this->rooms = model('RoomModel');
        $this->renters = model('RenterModel');
        helper('renters');
    }

    public function index() {

        $breadcrumb = new Breadcrumb('Settings', [
            'Home'=> '/',
            'Settings' => 'admin/settings'
        ]);

        return view('admin/setting/index', compact('breadcrumb'));
    }

    public function changeRoom() {
        service('response');
        $req = service('request');
        $req = $req->getPost();

        $roomId = $req['room'];
        $renterId = $req['renter']!='0' ? $req['renter'] : null;

        if ($this->rooms->update($roomId, ["renter_id" => $renterId])) {
            return $this->response->setJson([
                "status" => 200
            ]);
        }
        
        return $this->response->setJson([
            "status" => 500
        ], 500);

    }

    public function ajax() {
        $req = service('request');
        $data = $req->getGet();
        $prefix = key($data);
        $label = $data[$prefix];
        $func = $prefix . '_' . $label;
        return $this->$func();
    }

    public function table_renterRoom() {

        $db = \Config\Database::connect();
        $rooms = $db->table('rooms')
                    ->select('rooms.*, renters.name as renter_name')
                    ->where('rooms.deleted_at', null)
                    ->join('renters', 'rooms.renter_id = renters.id', 'left')
                    ->get();

        $rooms = $rooms->getResultArray();

        $renterData = ["0" => "No Selected"] + renters_not_rented();
        $tuid = "table_renter_room";
        return view('templates/table/renter_room', compact('tuid', 'rooms', 'renterData'));
    }
}
