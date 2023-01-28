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

if (! function_exists('room_rent')) {
    function room_rent ($room_id) {
        $roomModel = model('RoomModel');
        $row = $roomModel->find($room_id);

        if ($row) {
            return $row['price'];
        }
        return null;
    }
}
?>