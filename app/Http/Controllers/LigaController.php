<?php

namespace App\Http\Controllers;

use App\Models\Liga;
use Illuminate\Http\Request;

class LigaController extends Controller
{
    public function getAll()
    {
        $ligas = Liga::all();
        return json_encode($ligas);
    }
}
