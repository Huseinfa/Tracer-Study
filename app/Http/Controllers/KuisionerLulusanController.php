<?php

namespace App\Http\Controllers;

use App\Models\LulusanModel;
use Illuminate\Http\Request;

class KuisionerLulusanController extends Controller
{
    public function index()
    {
        return view('kuisionerlulusan.index');
    }
}
