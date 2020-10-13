<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Slika {
    public $idSlika;
    public $putanja;
    public $alt;
    
    
    
    public function save(){
        
        $rez= DB::table('slika')
                ->insertGetId([
                    
                    'putanja'=>$this->putanja,
                    'alt'=>$this->alt
                        
                ]);
        return $rez;
        
        
    }
    
    
    public function delete(){
        $rez = DB::table('slika')
                ->where('idSlika',$this->idSlika)
                ->delete();
        
        return $rez;
        
    }
public function update(){
      
        $rez = DB::table('slika')
                ->where('idSlika',$this->idSlika)
                ->update(['putanja'=>$this->putanja]);
        
        return $rez;
        
}
}
