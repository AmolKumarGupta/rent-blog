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

        return $this->response->setJson($req->getPost());
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

        return view('templates/table/renter_room', compact('rooms', 'renterData'));
    }
}
