<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Renters extends Migration
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
                'constraint'    =>'100',
                'null'          =>true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('renters', true);

    }

    public function down()
    {
        //
    }
}
