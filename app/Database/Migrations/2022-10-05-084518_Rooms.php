<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Rooms extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'          =>'INT',
                'constraint'    =>'11',
                'auto_increment'=>true        
            ],
            'renter_id'=> [
                'type'          =>'INT',
                'constraint'    =>'11',
                'null'          =>true
            ],
            'name'=> [
                'type'          =>'VARCHAR',
                'constraint'    =>'100',
                'default'       =>'room'
            ],
            'price'=> [
                'type'          =>'INT',
                'constraint'    =>'5',
                'default'       =>'1500'
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('renter_id', 'renters', 'id');
        $this->forge->createTable('rooms', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('rooms');
    }
}
