<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RentalHistorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                "name"          => "room charges",
                "description"   => "charges that renters pay every month"
            ],
            [
                "name" => "electricity charges",
                "description"   => ""
            ]
        ];

        $this->db->table('charge_type')->insertBatch($data);
    }
}
