<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GraphController extends Controller
{
    public function showMap(){
        $label = ['Thể loại', 'Hãng', 'Gara', 'Ô tô'];
        $price = ['7', '3', '2', '10', ];
        return view('Admin.showMap',['labels' => $label, 'prices' => $price]);
    }
}
