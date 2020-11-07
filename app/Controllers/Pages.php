<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Beranda'
        ];
        return view('pages/home', $data);
    }

    public function materi()
    {
        $data = [
            'title' => 'Materi'
        ];
        return view('pages/materi', $data);
    }

    public function latihansk()
    {
        $data = [
            'title' => 'Latihan Studi Kasus'
        ];
        return view('pages/latihansk', $data);
    }

    public function quiz()
    {
        $data = [
            'title' => 'Quiz'
        ];
        return view('pages/quiz', $data);
    }

    public function peringkat()
    {
        $data = [
            'title' => 'Peringkat'
        ];
        return view('pages/peringkat', $data);
    }

    public function tentang()
    {
        $data = [
            'title' => 'Tentang'
        ];
        return view('pages/tentang', $data);
    }

    public function masuk()
    {
        $data = [
            'title' => 'Masuk'
        ];
        return view('pages/masuk', $data);
    }


    public function daftar()
    {
        $data = [
            'title' => 'Daftar'
        ];
        return view('pages/daftar', $data);
    }


    //--------------------------------------------------------------------

}
