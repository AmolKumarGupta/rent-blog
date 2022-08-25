<?php
namespace App\Controllers\Dev;

use App\Controllers\BaseController;
use CodeIgniter\Shield\Entities\User;

class Users extends BaseController
{
    public function index()
    {
        echo 'hello dev, how is it going....';
    }

    public function admin(){
        echo 'has been removed.';
    }
}
