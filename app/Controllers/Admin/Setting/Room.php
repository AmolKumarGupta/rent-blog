<?php
namespace App\Controllers\Admin\Setting;

use App\Controllers\BaseController;
use App\Libraries\Breadcrumb;
use CodeIgniter\HTTP\IncomingRequest;
use App\Models\RoomModel;
use App\Models\RenterModel;

class Room extends BaseController
{
    private $rooms;
    private $renters;

    public function __construct(){
        $this->rooms = new RoomModel();
        $this->renters = new RenterModel();
    }

    public function index()
    {
        $rooms_data = $this->rooms->findAll();
        foreach( $rooms_data as $key=>$val ){
            if( $val['renter_id']===null ){
                $rooms_data[$key]['renter_name'] = 'None';
            }else{
                try{
                    $renter = $this->renters->find($val['renter_id']);
                    $rooms_data[$key]['renter_name'] = $renter['name'];
                }
                catch(\Exception $e){
                    $rooms_data[$key]['renter_name'] = 'None';
                }
            }
        }
        $breadcrumb = new Breadcrumb('Rooms', [
            'Home'=> '/',
            'Settings' => 'admin/settings'
        ]);
        return view('admin/setting/rooms',[
            'breadcrumb' => $breadcrumb,
            'rooms' => $rooms_data
        ]);
    }

    public function create()
    {
        service('response');
        $request = service('request');

        if( $request->isAjax() ){
            $data = $request->getGet('name', FILTER_SANITIZE_SPECIAL_CHARS);
            if( !empty($data) ) {
                try{
                    $this->rooms->insert(['name' => $data]);
                    $id = $this->rooms->getInsertID();

                    return $this->response->setStatusCode(200)->setJson([ 
                        'status' => 200, 'data'=> [
                            'id'=> $id,
                            'name'=> $data
                        ]
                    ]);
                }
                catch(\Exception $e){
                    return $this->response->setStatusCode(500)->setJson(['status' => 500, 'data'=> "database error"]);
                }
            }
        }

        return $this->response->setStatusCode(400)->setJson(['status' => 400, 'data'=> "invalid request"]);
    }

    public function delete(){
        service('response');
        $request = service('request');

        if( $request->isAjax() ){
            $id = $request->getPost('id');
            try{
                $this->rooms->delete($id);
                return $this->response
                ->setStatusCode(200)
                ->setJson(['status' => 200, 'data'=> "deleted"]);    
            }
            catch(\Exception $e){
                return $this->response
                ->setStatusCode(500)
                ->setJson(['status' => 500, 'data'=> "something went wrong."]);    
            }
        }

        return $this->response
            ->setStatusCode(401)
            ->setJson(['status' => 401, 'data'=> "invalid request"]);
    }

    public function update()
    {
        service('request');
        $validation = \Config\Services::validation();

        $validation->setRules([
            'id' => 'required',
            'name' => ['required', 'htmlspecialchars' ],
            'price' => ['required', 'numeric'],
        ]);

        if( $validation->withRequest($this->request)->run() ){
            $data = $this->request->getPost();

            try{
                $this->rooms->save($data);
            }catch(\Exception $e){

            }
        }

        return redirect()->route('setting_room');
    }
}
