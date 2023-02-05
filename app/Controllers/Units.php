<?php
namespace App\Controllers;

use App\Controllers\BaseController;

class Units extends BaseController
{
    public function check() {
        $post = $this->request->getPost();
        $units = model('ElectricityUnits');

        $unit = $units->where('room_id', $post['room_id'])
            ->where('renter_id', $post['renter_id'])
            ->where('year', $post['year'])
            ->where('month', $post['month'])
            ->first();

        if ($unit) {
            $previous_unit = $units->where('room_id', $post['room_id'])
                ->where('renter_id', $post['renter_id'])
                ->where('id <', $unit['id'])
                ->orderBy('year', 'DESC')
                ->orderBy('month', 'DESC')
                ->first();

            if ($previous_unit) {
                $diff = (int) $unit['overall_units'] - (int) $previous_unit['overall_units'];
                $diff = $diff*10;
            }else {
                $diff = 0;
            }

            return $this->response->setJson([
                "unit" => $unit['overall_units'],
                "price" => $diff
            ]); 
        }

        return $this->response->setJson(["unit" => null]);
    }


    public function save() {
        $post = $this->request->getPost();
        $units = model('ElectricityUnits');

        $unit_id = $units->insert($post);

        if ( $unit_id == null ) {
            return $this->response->setStatusCode(500)->setJson([]);
        }

        $previous_unit = $units->where('room_id', $post['room_id'])
            ->where('renter_id', $post['renter_id'])
            ->where('id <', $unit_id)
            ->orderBy('year', 'DESC')
            ->orderBy('month', 'DESC')
            ->first();

        if ($previous_unit) {
            $diff = (int) $post['overall_units'] - (int) $previous_unit['overall_units'];
            $diff = $diff*10;
        }else {
            $diff = 0;
        }

        return $this->response->setJson(["price" => $diff]);
    }
}
