<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admin extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'null' => false
            ],
            'name'       => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
                'null' => true
            ],
            'password'       => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            'username'       => [
                'type'       => 'VARCHAR',
                'constraint' => 12,
                'null' => false,
                'default' => 'email'
            ],
            'email'       => [
                'type'       => 'VARCHAR',
                'constraint' => 120,
                'null' => false
            ],
            'phone'       => [
                'type'       => 'VARCHAR',
                'constraint' => 17,
                'null' => true
            ],
            'active'       => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'null' => false,
                'default' => 1
            ],
            'default_group'       => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
                'null' => false
            ],
            'created_at' => [
                'type' => 'timestamp',
                'default CURRENT_TIMESTAMP NOT NULL',
            ]
        ]);
        $this->forge->addPrimaryKey('id', true);
        $this->forge->addUniqueKey('email');
        $this->forge->createTable('m_auth_admins');
    }

    public function down()
    {
        $this->forge->dropTable('m_auth_admins');
    }
}
