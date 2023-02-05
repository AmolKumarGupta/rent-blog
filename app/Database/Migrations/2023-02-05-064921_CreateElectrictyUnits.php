<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateElectrictyUnits extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'          => 'INT',
                'constraint'    => '11',
                'auto_increment'=> true        
            ],
            'room_id'=> [
                'type'          => 'INT',
                'constraint'    => '11'
            ],
            'renter_id'=> [
                'type'          => 'INT',
                'constraint'    => '11'
            ],
            'year'=> [
                'type'          => 'SMALLINT',
                'constraint'    => '4'
            ],
            'month'=> [
                'type'          => 'TINYINT',
                'constraint'    => '2'
            ],
            'overall_units'=> [
                'type'          => 'INT',
                'constraint'    => '11'
            ],
            'created_at datetime default current_timestamp',
            'updated_at' => [
                'type'          => 'datetime',
                'null'          => true
            ],
            'deleted_at' => [
                'type'          => 'datetime',
                'null'          => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('electricity_units', true);
    }

    public function down()
    {
        $this->forge->dropTable('electricity_units');
    }
}
