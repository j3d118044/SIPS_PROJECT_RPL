<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SoalSk extends Migration
{
  public function up()
  {
    $this->forge->addField([
      'id_soal'            => [
        'type'              => 'INT',
        'unsigned'          => true,
        'auto_increment'    => true,
      ],
      'soal'                 => [
        'type'              => 'TEXT',
      ],
      'pembahasan'                 => [
        'type'              => 'TEXT',
      ],

    ]);
    $this->forge->addKey('id_soal', TRUE);
    $this->forge->createTable('soal_sk');
  }

  public function down()
  {
    $this->forge->dropTable('soal_sk');
  }
}
