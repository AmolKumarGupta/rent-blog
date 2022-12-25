<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnInRentersTable extends Migration
{
    public function up()
    {
        $columns = [
            'phone_no' => [
                'type' => 'VARCHAR', 
                'constraint' => '14',
                'null'  => true,
                'after' => 'name'
            ],
            'occupation' => [
                'type' => 'VARCHAR', 
                'constraint' => '100',
                'null'  => true,
                'after' => 'phone_no'
            ],
            'note' => [
                'type' => 'TEXT',
                'null'  => true,
                'after' => 'occupation'
            ],
            'rating' => [
                'type' => 'INT', 
                'constraint' => '2',
                'default'  => 0,
                'after' => 'note'
            ],
            'status' => [
                'type' => 'ENUM', 
                'constraint' => ['y','n'],
                'default'   => 'n',
                'after' => 'rating'
            ]
        ];


        $this->forge->addColumn('renters', $columns);
    }

    public function down()
    {
        //
    }
}
