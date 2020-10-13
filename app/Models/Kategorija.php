<?php



namespace App\Models;
use Illuminate\Support\Facades\DB;

class Kategorija {

    public $idKategorija;
    public $grad;
    
    
    public function getAll(){
        
       $rez=DB::table('kategorija')->get();
       return $rez;
    }

    public  function update(){
        
        $rez=DB::table('kategorija')
                ->where('idKategorije',$this->idKategorija)
                ->update(['grad'=>$this->grad]);
        return $rez;
    }
    
     
    public function save(){
        
        $rez=DB::table('kategorija')
                ->insertGetId([
                    'grad'=>$this->grad,
                    
                ]);
        return $rez;
    }
    
    
    public function poID(){
        $rez=DB::table('kategorija')
                ->where('idKategorije',$this->idKategorija)
                ->first();
        return $rez;
        
        
    }
    public function delete(){
        
        $rez=DB::table('kategorija')
                ->where('idKategorije',$this->idKategorija)
                ->delete();
        return $rez;
    }
    
}
