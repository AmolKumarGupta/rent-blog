<?php
if (!function_exists('get_active_renters')) {
    function get_active_renters($select = 'id, name') {
        $renters = model('RenterModel');

        return $renters->select($select)->where('status', 'y')->findAll();
    }
}

if (!function_exists('renters_flatten')) {
    function renters_flatten() {
        $renters = get_active_renters();
        $data = [];

        foreach ($renters as $r) {
            $data[$r['id']] = $r['name'];
        }
        return $data;
    }
}

/**
 * get those renter that are not rented to any room and also active
 */
if (! function_exists('renters_not_rented')) {
    function renters_not_rented() {
        $renters = model('RenterModel');
        $db      = \Config\Database::connect();

        $subquery = $db->table('rooms')->select('renter_id')->where('renter_id !=', null)->where('deleted_at', null);
        $data = $renters->whereNotIn('id', $subquery)->findAll();

        $res = [];
        foreach ($data as $d) {
            $res[$d['id']] = $d['name'];
        }

        return $res;
    }
}
?>