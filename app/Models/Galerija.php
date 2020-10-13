<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Galerija {
    
    public $idGalerija;
    public $alt;
    public $putanja;
    
    public function getAll(){
        
        $rez=DB::table('galerija')->get();
        
        return $rez;
}

     public function stranicenje($poStrani){
    $rez=DB::table('galerija') 
                ->paginate($poStrani);
         return $rez;      
    }
    
    
      
    public function save(){
        
        $rez=DB::table('galerija')
                ->insertGetId([
                    'alt'=>$this->alt,
                    'putanja'=> $this->putanja,
                    
                ]);
        return $rez;
    }
    
    
    public function slika(){
        
        $rez=DB::table('galerija')
                ->where('idGalerija',$this->idGalerija)
                ->first();
        
        return $rez;
    }
  
    public function update(){
         $rez=DB::table('galerija')
                     ->where('idGalerija',$this->idGalerija)
                     ->update([
                         'alt'=>$this->alt,
                         'putanja'=>$this->putanja
                     ]);
         return $rez;
         
    }
    
    
    public function delete(){
        $rez=DB::table('galerija')
                ->where('idGalerija',$this->idGalerija)
                ->delete();
        return $rez;
        
        
        
    }
    
}
