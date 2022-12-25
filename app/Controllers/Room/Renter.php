<?php

namespace App\Controllers\Room;

use App\Controllers\BaseController;
use App\Libraries\Breadcrumb;
use App\Models\RenterModel;

class Renter extends BaseController
{
    public function info($id)
    {
        $renterModel = new RenterModel();
        $res = $renterModel->where('id', $id)->find();
        if($res) {
            $data = $res[0];
        }else{
            $data = [];
        }
        
        $breadcrumb = new Breadcrumb($data['name'], [
            'Home'=> '/',
            'Renter'=> uri_string()
        ]);


        return view('rooms/renter', [
            'breadcrumb'=> $breadcrumb,
            'data'=> $data
        ]);
    }

    public function update ($id) {
        $validate = \Config\Services::validation();

        $validate->setRules([
            "name"  => "required",
            "rating"  => "required",
            "phone_no"  => "phone_number_or_empty"
        ]);

        if ($validate->withRequest($this->request)->run()) {
            $data = $this->request->getPost();
            try {
                $renter = new RenterModel();
                $data['id'] = $id;
                $renter->save($data);
                return $this->response->setStatusCode(200)->setJson([
                    "status" => 200,
                    "data" => $data
                ]);
            }catch (\Exception $e) {
                return $this->response->setStatusCode(500)->setJson(["status" => 500, "msg" => $e->getMessage()]);
            }
        } else {
            return $this->response->setStatusCode(400)->setJson(["status" => 400, "errors" => $validate->getErrors()]);
        }
    }
}
