<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admin extends Migration
{
  public function up()
  {
    $this->forge->addField([
      'id_admin'            => [
        'type'              => 'INT',
        'unsigned'          => true,
        'auto_increment'    => true,
      ],
      'email'                 => [
        'type'              => 'VARCHAR',
        'constraint'        => '30',
        'unique'            => true,
      ],
      'nama'                  => [
        'type'              => 'VARCHAR',
        'constraint'        => '30',
      ],
      'kata_sandi'            => [
        'type'              => 'CHAR',
        'constraint'        => '60',
      ],

    ]);
    $this->forge->addKey('id_admin', TRUE);
    $this->forge->createTable('admin');
  }

  public function down()
  {
    $this->forge->dropTable('admin');
  }
}
