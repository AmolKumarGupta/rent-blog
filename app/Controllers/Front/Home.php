<?php
namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Libraries\Breadcrumb;

class Home extends BaseController
{
    public function __construct() {
        $this->rooms = model('RoomModel');
        $this->renters = model('RenterModel');
    }

    public function index()
    {
        $breadcrumb = new Breadcrumb('Dashboard', ['Home'=>'/']);
        
        $rooms = $this->rooms->select('rooms.*, renters.name as renter_name')
                    ->join('renters', 'renters.id = rooms.renter_id', 'left')
                    ->findAll();
        
        $breadcrumb->add('dashboard', '/');
        return view('front/index', compact(
            'breadcrumb',
            'rooms'
        ));
    }
}
