<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateChargeType extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'          =>'INT',
                'constraint'    =>'11',
                'auto_increment'=>true        
            ],
            'name'=> [
                'type'          =>'VARCHAR',
                'constraint'    =>'100'
            ],
            'description'=> [
                'type'          =>'TEXT',
                'null'          => true
            ],
            'updated_at' => [
                'type'          =>'datetime',
                'null'          =>true
            ],
            'deleted_at' => [
                'type'          =>'datetime',
                'null'          =>true
            ],
            'created_at datetime default current_timestamp'
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('charge_type', true);
    }

    public function down()
    {
        $this->forge->dropTable('charge_type');
    }
}
