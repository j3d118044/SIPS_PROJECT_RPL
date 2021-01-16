<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelajar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pelajar'            => [
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
            'organisasi'            => [
                'type'              => 'VARCHAR',
                'constraint'        => '30',
            ],
            'foto'                  => [
                'type'              => 'VARCHAR',
                'constraint'        => '255',
            ],
            'skor_kuis'             => [
                'type'              => 'INT',
                'null'              => true,
            ],
            'waktu_kuis'            => [
                'type'              => 'TIME',
                'null'              => true,
            ],
            'aktivasi'              => [
                'type'              => 'TINYINT',
                'constraint'        => '1',
                'default'           => '0',
            ],
            'token_akt'             => [
                'type'              => 'CHAR',
                'constraint'        => '100',
                'null'              => true,
            ],
            'token_lks'             => [
                'type'              => 'CHAR',
                'constraint'        => '100',
                'null'              => true,
            ],

        ]);
        $this->forge->addKey('id_pelajar', TRUE);
        $this->forge->createTable('pelajar');
    }

    public function down()
    {
        $this->forge->dropTable('pelajar');
    }
}
