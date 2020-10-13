<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;
/**
 * Description of Anketa
 *
 */
class Anketa {
    public $idAnketa;
    public $pitanje;
    public $aktivna;
    
    public $idKorisnik;
    public $idAktivna;
    public $idOdgovor;
    public $odgovor; 
    
    //aktivna anketa!
    public function get(){
         $rez =DB::table('anketa')
                 ->where('aktivna','=',1)
                 ->first();
         
         return $rez;
        
        
    }

    
    public function odgovori(){
        
       $rez=DB::table('anketa')
                ->join('odgovor', 'odgovor.idAnketa', '=', 'anketa.idAnketa')
                ->where('aktivna', '=', 1)
                ->get();
       return $rez;
    }
    
    
    public function proveraGlasanja(){
        
       $rez=DB::table('glasanje')
                ->select('idKorisnik')
                ->where([
                    ['idAnketa', '=', $this->idAktivna],
                    ['idKorisnik', '=', $this->idKorisnik]
                    ])
                ->first();
       return $rez;
    }
    
    public function dodajGlas(){
        
        $rez=DB::table('glasanje')
                ->insert(['idKorisnik' => $this->idKorisnik,
                          'idAnketa' => $this->idAktivna,
                          'idOdgovor' => $this->idOdgovor]);
        return $rez;
        
    }
    
    public function azurirajRezultate(){
        
      $rez=DB::table('rezultat')
                ->where([
                    ['idAnketa', '=', $this->idAktivna],
                    ['idOdgovor', '=', $this->idOdgovor]
                ])
                ->increment('rezultat');
      return $rez;
    }
    
    
    
    public function dohvatiAnketu(){
        
        $rez= DB::table('anketa')
                ->where('idAnketa',$this->idAnketa)
                ->first();
        return $rez;
    }
    
    public function getAll(){
        
        $rez=DB::table('anketa')->get();
        return $rez;
               
    }
    
    
    public function save(){
       $rez= DB::table('anketa')
                ->insert([
                    
                    'pitanje'=>$this->pitanje
                ]);
        return $rez;
    }
       
    public function update(){
        
        $rez=DB::table('anketa')
                ->where('idAnketa',$this->idAnketa)
                ->update(['pitanje'=>$this->pitanje]);
        return $rez;
        
        
    }    
    public function delete(){
        
         $rez=DB::table('anketa')
                 ->where('idAnketa',$this->idAnketa)
                 ->delete();
    
         return $rez;
    }
    
    public function updateActive(){
        DB::table('anketa')
                ->where('aktivna',1)
                ->update(['aktivna'=>0]);
        $rez=DB::table('anketa')
                ->where('idAnketa',$this->idAnketa)
                ->update([
                    'aktivna'=>1
                ]);
        return $rez;
        
    }
    
    public function sviodgovori(){
        
        $rez=DB::table('odgovor')
                ->join('rezultat','rezultat.idOdgovor','=','odgovor.idOdgovor')
                ->where('odgovor.idAnketa',$this->idAnketa)
                ->get();
        return $rez;
    }
    
    public function saveAnsver(){
        
        $idOdg = DB::table('odgovor')
                ->insertGetId(
                        ['idAnketa' => $this->idAnketa,
                         'odgovor' => $this->odgovor]
                        );
        
        DB::table('rezultat')
                ->insert([
                    'idAnketa' => $this->idAnketa,
                    'idOdgovor' => $idOdg,
                    'rezultat' => 0
                ]);
        
    }
    
    public function getA(){
        
        $rez = DB::table('odgovor')
                ->where('idOdgovor', $this->idOdgovor)
                ->first();
        return $rez;
    }
    
    
      public function updateA(){
        
        $rez= DB::table('odgovor')
                ->where('idOdgovor', $this->idOdgovor)
                ->update(['odgovor' => $this->odgovor]);
        return $rez;
    }
    
    public function deleteA(){
        
        
              DB::table('rezultat')
                ->where('idOdgovor', $this->idOdgovor)
                ->delete();
        
        return DB::table('odgovor')
                ->where('idOdgovor', $this->idOdgovor)
                ->delete();
        
    }
    
    
    //brisanje odgovora
    
     public function deleteAll(){
        
        $rez=DB::table('odgovor')
                ->where('idAnketa', $this->idAnketa)
                ->delete();
        
        return $rez;
    }
    
    
    
    
    
    
    
    
    
    
    
    
}
