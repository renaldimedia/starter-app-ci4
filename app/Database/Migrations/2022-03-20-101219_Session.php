<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Session extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 128,
                'null' => false
            ],
            'ip_address'       => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
                'null' => false
            ],
            'timestamp' => [
                'type' => 'timestamp',
                'default CURRENT_TIMESTAMP NOT NULL',
            ],
            'data' => [
                'type' => 'blob',
                'null' => false
            ]
        ]);
        $this->forge->addKey('timestamp', true);
        $this->forge->createTable('ci_sessions');
    }

    public function down()
    {
        $this->forge->dropTable('ci_sessions');
    }
}
