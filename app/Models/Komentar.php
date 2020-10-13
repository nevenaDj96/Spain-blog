<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Komentar {
    
   public $idKomentar;
   public $sadrzaj;
   public $idKorisnik;
   public $vreme;
   public $idPost;
   
    
    
   public function getAll(){
       
       $rez=DB::table('komentar')
               ->join('korisnik','komentar.idKorisnik','=','korisnik.idKorisnik')
               ->get();
       return $rez;
       
   }
   
    public function getByPost(){

    $rez=DB::table('komentar')
            ->join('korisnik','komentar.idKorisnik','=','korisnik.idKorisnik')
            ->join('post','komentar.idPost','=','post.idPost')
            ->where('komentar.idPost',$this->idPost)
            ->get();
    return $rez;
    
}
    
   public function save(){
      $rez=DB::table('komentar')->insert([
           'komentar'=>$this->sadrzaj,
           'idKorisnik'=>$this->idKorisnik,
           'idPost'=>$this->idPost
       ]);
      return $rez;
       
   }
   
   public function delete(){
       
       $rez=DB::table('komentar')
               ->where('idKomentar','=',$this->idKomentar)
               ->delete();
       
       return $rez;
       
       
   }
     public function idPost(){
        
        return DB::table('komentar')
                ->select('idPost')
                ->where('idKomentar', $this->idKomentar)
                ->first();
    }
 
       
}