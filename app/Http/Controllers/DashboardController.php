<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LulusanModel;
use App\Models\StakeholderModel;
use App\Models\ProdiModel;
use App\Models\ProfesiModel;

class DashboardController extends Controller
{
    public function index()
    {
        $lulusanCount = LulusanModel::count();
        $stakeholderCount = StakeholderModel::count();
        $prodiCount = ProdiModel::count();
        $profesiCount = ProfesiModel::count();
        $lulusanFilled = LulusanModel::where('sudah_mengisi', true)->count();
        $lulusanFilledPercentage = $lulusanCount > 0 ? round(($lulusanFilled / $lulusanCount) * 100, 2) : 0;
        $recentLulusan = LulusanModel::orderBy('created_at', 'desc')->limit(5)->get();

        return view('dashboard.index', [
            'lulusanCount' => $lulusanCount,
            'stakeholderCount' => $stakeholderCount,
            'prodiCount' => $prodiCount,
            'profesiCount' => $profesiCount,
            'lulusanFilledPercentage' => $lulusanFilledPercentage,
            'recentLulusan' => $recentLulusan,
            'lulusanFilled' => $lulusanFilled, // Add this line to pass the variable
        ]);
    }
}