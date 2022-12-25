<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMembersTable extends Migration
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
                'constraint'    =>'11'
            ],
            'first_name'=> [
                'type'          =>'VARCHAR',
                'constraint'    =>'100'
            ],
            'last_name' => [
                'type'          =>'VARCHAR',
                'constraint'    =>'100',
                'null'          =>true
            ],
            'expected_age' => [
                'type'          =>'datetime',
                'null'          =>true
            ],
            'birth_year' => [
                'type'          =>'INT',
                'constraint'    =>'5',
                'null'          =>true
            ],
            'description'=> [
                'type'          =>'TEXT',
                'null'          =>true
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
        $this->forge->addForeignKey('renter_id', 'renters', 'id');
        $this->forge->createTable('members', true);
    }

    public function down()
    {
        $this->forge->dropTable('members');
    }
}
