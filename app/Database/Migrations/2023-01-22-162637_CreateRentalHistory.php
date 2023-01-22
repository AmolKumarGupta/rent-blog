<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRentalHistory extends Migration
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
            'charge_type_id'=> [
                'type'          => 'INT',
                'constraint'    => '11'
            ],
            'total_charges'=> [
                'type'          => 'SMALLINT',
                'constraint'    => '4'
            ],
            'paid'=> [
                'type'          => 'SMALLINT',
                'constraint'    => '4'
            ],
            'year'=> [
                'type'          => 'SMALLINT',
                'constraint'    => '4'
            ],
            'month'=> [
                'type'          => 'TINYINT',
                'constraint'    => '2'
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
        $this->forge->createTable('rental_history', true);
    }

    public function down()
    {
        $this->forge->dropTable('rental_history');
    }
}
