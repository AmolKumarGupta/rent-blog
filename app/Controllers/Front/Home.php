<?php
namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Libraries\Breadcrumb;

class Home extends BaseController
{
    public function index()
    {
        $breadcrumb = new Breadcrumb('Dashboard', ['Home'=>'/']);

        return view('front/index', [
            'breadcrumb'=> $breadcrumb
        ]);
    }
}
