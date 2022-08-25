<?php
namespace App\Controllers\Admin\Setting;

use App\Controllers\BaseController;
use App\Libraries\Breadcrumb;

class Room extends BaseController
{
    public function index()
    {
        $breadcrumb = new Breadcrumb('Rooms', [
            'Home'=> '/',
            'Settings' => 'admin/settings'
        ]);
        return view('admin/setting/rooms',[
            'breadcrumb' => $breadcrumb
        ]);
    }

    public function create()
    {
        /* save data in DB */
    }
}
