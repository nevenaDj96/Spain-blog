<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Uloga {
    public function getAll(){
        $rez=DB::table('uloga')->get();
        return $rez;
        
    }
}
