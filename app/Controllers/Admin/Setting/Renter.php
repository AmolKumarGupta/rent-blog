<?php
namespace App\Controllers\Admin\Setting;

use App\Controllers\BaseController;
use App\Libraries\Breadcrumb;
use App\Models\RenterModel;
use App\Models\RoomModel;

class Renter extends BaseController
{
    public function index()
    {
        helper(['form', 'rooms']);
        $breadcrumb = new Breadcrumb('Renters', [
            'Home'=> '/',
            'Settings' => 'admin/settings'
        ]);

        $renterModal = new RenterModel();
        if( $this->request->getGet('all')===null ){
            $renters = $renterModal->where('status', 'y')->findAll();
        }else{
            $renters = $renterModal->findAll();
        }
        $get = $this->request->getGet('all');

        $room_options = getEmptyRooms();
        $room_options = ["" => 'No room given'] + $room_options;

        return view('admin/setting/renters',compact('breadcrumb','renters', 'get', 'room_options') );
    }

    public function create()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required'
        ]);

        if( $validation->withRequest($this->request)->run() ){
            $data = $this->request->getPost();
            $data['status'] = 'y';

            try {
                $renter = new RenterModel();
                $id = $renter->insert($data);

                if ($data['room']!="") {
                    $roomModel = new RoomModel();
                    $roomModel->update($data['room'], ['renter_id' => $id]);
                }

                return $this->response->setStatusCode(200)->setJson([
                    "status" => 200,
                    "data" => [
                        "id"  => $id,
                        "name"=> $data['name']
                    ]
                ]);

            }catch( \Exception $e ){
                return $this->response->setStatusCode(500)->setJson([
                    "status"    => 500,
                    "msg"       => $e->getMessage()
                ]);
            }
        }
    }

    public function update()
    {   
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id' => 'required',
            'name' => ['required']
        ]);

        if( $validation->withRequest($this->request)->run() ){
            $data = $this->request->getPost();
            try {
                $renter = new RenterModel();
                
                $renter->save($data);
                return $this->response->setStatusCode(200)->setJson([
                    "status" => 200,
                    "data" => $data
                ]);

            }catch( \Exception $e ) {
                return $this->response->setStatusCode(500)->setJson(["status" => 500, "msg" => $e->getMessage()]);
            }
        } else {
            return $this->response->setStatusCode(400)->setJson(["status" => 400, "errors" => $validation->getErrors()]);
        }
    }

    public function delete()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            "id" =>'required'
        ]);

        if( $validation->withRequest($this->request)->run() ){
            try {
                $id = $this->request->getPost('id');
                $renter = new RenterModel();
                $renter->delete($id);

                return $this->response->setStatusCode(200)->setJson(["status" => 200]);
            }catch( \Exception $e ){
                return $this->response->setStatusCode(500)->setJson(["status" => 500]);
            }
        }
    }

}/*  */
