<?php
if (! function_exists('getEmptyRooms')) {
    function getEmptyRooms() {
        $rooms = model('RoomModel');
        $data = $rooms->where("renter_id", null)->findAll();
        $res = [];
        foreach ($data as $d) {
            $res[$d['id']] = $d['name'];
        }
        return $res;
    }
}
?>