<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Destinacije {
   
    
    public $idDestinacije;
    public $naslov;
    public $opis;
    public $sadrzaj;
    public $datumKreiranja;
    public $datumIzmene=['datum_izmene'];
    public $slikaId;
    public $korisnikId;
    public $brojKomentara;
    public $idKategorija;
  
  
    
    public function getAll(){
        
        $rez=DB::table('post')
                ->join('slika', 'post.idSlika', '=', 'slika.idSlika')
                ->join('korisnik', 'korisnik.idKorisnik', '=', 'post.idKorisnik')
                ->join('kategorija','post.idKategorije','=','kategorija.idKategorije')
                ->get();
        
        return $rez;
        
        
    }
    public function get(){
        
        $rez=DB::table('post')
             ->join('slika', 'post.idSlika', '=', 'slika.idSlika')
             ->join('korisnik', 'korisnik.idKorisnik', '=', 'post.idKorisnik')
             ->where('idPost','=',$this->idDestinacije)
             ->first();  
        return $rez;
    }
    
    public function komentarVise(){
        
         $rez=DB::table('post')
                ->where('idPost', $this->idDestinacije)
                ->increment('brojKomentara', 1);
         return $rez;
    }
    
    public function komentarManje(){
         $rez=DB::table('post')
                ->where('idPost', $this->idDestinacije)
                ->decrement('brojKomentara', 1);
         return $rez;
        
    }
    
    public function poKategoriji(){
        
        $rez=DB::table('post')
                ->join('slika', 'post.idSlika', '=', 'slika.idSlika')
                ->join('korisnik', 'korisnik.idKorisnik', '=', 'post.idKorisnik')
                ->where('post.idKategorije', $this->idKategorija)
                ->get();
        
        return $rez;
    }
    
    
    //dohvatanje jednog posta
     public function post(){
        
     $rez=DB::table('post')
                ->join('slika', 'post.idSlika', '=', 'slika.idSlika')
                ->join('kategorija', 'kategorija.idKategorije', '=', 'post.idKategorije')
                ->join('korisnik', 'korisnik.idKorisnik', '=', 'post.idKorisnik')
                ->where('post.idPost', $this->idDestinacije)
                ->first();
     
     return $rez;
    }
    
    
    
    public function postID(){
        
        $rez= DB::table('post')
                ->join('slika', 'post.idSlika', '=', 'slika.idSlika')
                ->join('kategorija', 'kategorija.idKategorije', '=', 'post.idKategorije')
                ->join('korisnik', 'korisnik.idKorisnik', '=', 'post.idKorisnik')
                ->where('post.idKorisnik', $this->korisnikId)
                ->get();
               return $rez;
    }
   
    public function save(){
        
        $rez=DB::table('post')
                ->insert([
                    
                    'naslov'=>$this->naslov,
                    'opis'=>$this->opis,
                    'sadrzaj'=>$this->sadrzaj,
                    'idSlika'=>$this->slikaId,
                    'idKorisnik'=>$this->korisnikId,
                    'idKategorije'=>$this->idKategorija
                    
                ]);
                
        return $rez;
    }
    
    
    //izmena posta
    
    public function izmenaPosta(){
        
        $data=[
            'naslov'=>$this->naslov,
            'opis'=>$this->opis,
            'sadrzaj'=>$this->sadrzaj,
            'idKorisnik'=>$this->korisnikId,
            'idKategorije'=>$this->idKategorija,
            'datum_izmene'=>$this->datumIzmene
        ];
                
     if(!empty($this->slikaId)){
         $data['idSlika']=$this->slikaId;
     }
        
        
     $rez=DB::table('post')
             ->where('idPost',$this->idDestinacije)
             ->update($data);
     
     return $rez;
     
    }
    
    //brisanje 
    
    public function deleteP(){
        
        $rez=DB::table('post')
                ->where('idPost',$this->idDestinacije)
                ->delete();
        
        return $rez;
    }
 
        public function stranicenje($poStrani){
          $rez=DB::table('post') 
                  ->join('slika','post.idSlika','=','slika.idSlika')
                   ->join('korisnik', 'korisnik.idKorisnik', '=', 'post.idKorisnik')
                  ->join('kategorija','post.idKategorije','=','kategorija.idKategorije')
                ->paginate($poStrani);
         return $rez;      
    }
    
 
    
    
}
