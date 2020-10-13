<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Models;
use Illuminate\Support\Facades\DB;

class Meni {
    
    public $idMeni;
    public $naziv;
    public $putanja;
    public $pozicija;
    
    
    public function getAll(){
        
        $rez=DB::table('meni')
                ->get();
        
        return $rez;
        
        
    }
    
    //stavke
    public function dohvatiID(){
        
        $rez=DB::table('meni')
                ->where('idMeni',$this->idMeni)
                ->first();
        
        return $rez;
    }
    
    
    public function save(){
        
        $rez=DB::table('meni')
                ->insert([
                    'naziv'=>$this->naziv,
                    'putanja'=> $this->putanja,
                    'pozicija'=> $this->pozicija
                ]);
        return $rez;
    }
    
  
    
     public function update(){
        
        $rez=DB::table('meni')
                ->where('idMeni',$this->idMeni)
                ->update(['naziv'=>$this->naziv,
                          'putanja'=>$this->putanja,
                          'pozicija'=> $this->pozicija]);
        return $rez;
        
        
    }
    
    
    public function delete(){
        $rez=DB::table('meni')
                ->where('idMeni',$this->idMeni)
                ->delete();
        
        return $rez;
    }
     
    
    
}
