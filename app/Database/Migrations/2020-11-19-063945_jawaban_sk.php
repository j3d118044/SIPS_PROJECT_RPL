<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JawabanSk extends Migration
{
  public function up()
  {
    $this->forge->addField([
      'id_jawaban'            => [
        'type'              => 'INT',
        'unsigned'          => true,
        'auto_increment'    => true,
      ],
      'id_soal'               => [
        'type'              => 'INT',
        'unsigned'          => true,
      ],
      'id_pertanyaan'         => [
        'type'              => 'INT',
      ],
      'jawaban'               => [
        'type'              => 'VARCHAR',
        'constraint'        => 50
      ],

    ]);
    $this->forge->addKey('id_jawaban', TRUE);
    $this->forge->addForeignKey('id_soal', 'soal_sk', 'id_soal', 'CASCADE', 'CASCADE');
    $this->forge->createTable('jawaban_sk');
  }

  public function down()
  {
    $this->forge->dropTable('jawaban_sk');
  }
}
