<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AdminGroups extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 45,
                'null' => false
            ],
            'display_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
                'null' => true
            ],
            'disabled'       => [
                'type'       => 'VARCHAR',
                'constraint' => 12,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'timestamp',
                'default CURRENT_TIMESTAMP NOT NULL',
            ]
        ]);
        $this->forge->addPrimaryKey('id', true);
        $this->forge->createTable('m_auth_admin_groups');
    }

    public function down()
    {
        $this->forge->dropTable('m_auth_admin_groups');
    }
}
