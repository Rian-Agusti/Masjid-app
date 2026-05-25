<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JadwalPetugasController extends Controller
{
    public function index()
    {
        return view('admin.jadwal-petugas.index');
    }
}
