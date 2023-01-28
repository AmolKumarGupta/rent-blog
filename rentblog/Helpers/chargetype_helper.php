<?php
if (! function_exists('charge_type_options')) {
    /**
     * @return Array list of options
     * eg: [ "1"=>"room rent", "2"=>"electricity bill" ]
     */
    function charge_type_options() {
        $charge = model('ChargeType');
        $rows = $charge->findAll();
        
        $data = [];
        foreach ($rows as $row) {
            $data[ $row['id'] ] = $row['name'];
        }
        return $data;
    }
}

?>