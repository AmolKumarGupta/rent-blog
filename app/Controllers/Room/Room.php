<?php

namespace App\Controllers\Room;

use App\Controllers\BaseController;
use App\Libraries\Breadcrumb;
use App\Libraries\Ssp;
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

        return view('rooms/room', compact('id', 'breadcrumb', 'time', 'preTime'));
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
        $validation = \Config\Services::validation();
        $validation->setRules([
            'paid' => ['required', 'numeric']
        ]);

        if ($validation->withRequest($this->request)->run()) {
            $post =  $this->request->getPost();

            $post['total_charges'] = match ($post['charge_type_id']) {
                "1" => $post['fake_room_rent'],
                "2" => $post['fake_electric_bill']
            };

            unset($post['fake_room_rent']);
            unset($post['fake_electric_bill']);
            if ($post['created_at'] == "") {
                unset( $post['created_at'] );
            }
            
            $rentalHistoryModel = model('RentalHistory');
            if ( $rentalHistoryModel->insert($post, false) )
            {
                return $this->response->setJson(["status" => 200]);
            }
            return $this->response->setStatusCode(500)->setJson(["err" => "Something went wrong"]);

        }else {
            return $this->response
                        ->setStatusCode(400)
                        ->setJson( $validation->getErrors() );
        }
    }

    public function ajax() {
        $req = service('request');
        $data = $req->getGet();
        $prefix = key($data);
        $label = $data[$prefix];
        $func = $prefix . '_' . $label;
        return $this->$func();
    }

    public function datatable_rooms() {
        $time = Time::now();
        $months = config('Calender')->months;
        $id = $this->request->getGet('renter_id');

        $table = 'rental_history';
        $primaryKey = 'id';

        $columns = array(
            array( 
                'db' => '`rental_history`.`month`', 
                'dt' => 0 ,
                "formatter" => function($d, $row) use($months) {
                    $label = "";
                    $rentalHistoryModel = model('RentalHistory');

                    $query = $rentalHistoryModel->selectSum('paid')
                                            ->where("room_id", $row['room_id'])
                                            ->where("renter_id", $row['renter_id'])
                                            ->where("month", $row['month'])
                                            ->where("year", $row['year'])
                                            ->where('charge_type_id', $row['charge_type_id'])
                                            ->get();
                    $tmp = $query->getRowArray();

                    if ($tmp['paid'] < $row['total_charges']) {
                        $label = "data-paid='incomplete'";
                    }

                    return "<span ".$label.">". $months[ $row['month'] ] ." ". $row['year'] ."</span>";
                },
                'field' => 'month'
            ),
            array( 
                'db' => '`renters`.`name`',
                'dt' => 1 ,
                'as'    => 'renter_name',
                'field' => 'renter_name'
            ),
            array( 
                'db' => '`charge_type`.`name`', 
                'dt' => 2,
                'as'    => 'charge_type_name',
                'field' => 'charge_type_name'
            ),
            array( 
                'db' => '`rental_history`.`paid`', 
                'dt' => 3,
                'field' => 'paid'
            ),
            array( 
                'db' => '`rental_history`.`total_charges`', 
                'dt' => 4,
                'field' => 'total_charges'
            ),
            array( 
                'db' => '`rental_history`.`created_at`', 
                'dt' => 5,
                "formatter" => function ($d) {
                    return (new Time($d))->toLocalizedString('d MMMM yyyy');
                },
                'field' => 'created_at'
            ),

            array( 
                'db' => '`rental_history`.`year`', 
                'dt' => 6,
                'field' => 'year'
            ),
            array( 
                'db' => '`rental_history`.`room_id`', 
                'dt' => 7,
                'field' => 'room_id'
            ),
            array( 
                'db' => '`rental_history`.`renter_id`', 
                'dt' => 8,
                'field' => 'renter_id'
            ),
            array( 
                'db' => '`rental_history`.`charge_type_id`', 
                'dt' => 9,
                'field' => 'charge_type_id'
            ),
        );

        $joinQuery = "
        FROM `rental_history` 
        LEFT JOIN `renters` ON (`renters`.`id` = `rental_history`.`renter_id`) 
        LEFT JOIN `charge_type` ON (`charge_type`.`id` = `rental_history`.`charge_type_id`) 
        ";

        $extraCondition = "
            `rental_history`.`deleted_at` is null AND 
            `renters`.`deleted_at` is null AND 
            `charge_type`.`deleted_at` is null AND
            `rental_history`.`room_id`=$id
        ";
        
        $sql_details = array(
            'user' => env('database.default.username'),
            'pass' => env('database.default.password'),
            'db'   => env('database.default.database'),
            'host' => env('database.default.hostname')
        );
        
        return $this->response->setJson( Ssp::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraCondition ) );
    }
}
