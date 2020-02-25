<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BelajarController extends Controller
{
    public function index() {
    	$data = [
			['judul' => 'Ini Judul'],
			['judul' => 'Ini Judul'],
			['judul' => 'Ini Judul'],
			['judul' => 'Ini Judul'],
			['judul' => 'Ini Judul']
		];
		return view('belajar.list', compact('data'));
    }
}
