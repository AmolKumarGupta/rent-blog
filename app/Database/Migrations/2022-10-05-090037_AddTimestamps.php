<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTimestamps extends Migration
{
    public function up()
    {        
        $columns = [
            'updated_at' => [
                'type'          =>'datetime',
                'null'          =>true,
            ],
            'deleted_at' => [
                'type'          =>'datetime',
                'null'          =>true,
            ],
            'created_at datetime default current_timestamp',
        ];
        $this->forge->addColumn('renters', $columns);
        $this->forge->addColumn('rooms', $columns);
    }

    public function down()
    {
        //
    }
}
