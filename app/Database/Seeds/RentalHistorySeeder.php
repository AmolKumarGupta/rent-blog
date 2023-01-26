<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RentalHistorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                "name"          => "room rent",
                "description"   => "charges that renters pay every month"
            ],
            [
                "name" => "electricity bill",
                "description"   => ""
            ]
        ];

        $this->db->table('charge_type')->insertBatch($data);
    }
}
