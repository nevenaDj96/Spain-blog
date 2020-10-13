<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Korisnik {
    
    public $id;
    public $ime;
    public $prezime;
    public $email;
    public $lozinka;
    public $idUloga;
    
    
    public function getAll(){
        
        $rez=DB::table('korisnik')
                ->join('uloga','korisnik.IdUloga','=','uloga.IdUloga')
                ->get();
         return $rez;
    }
    
    public function getByEmailandPass(){
        
        $rez=DB::table('korisnik')
                ->join('uloga','korisnik.idUloga','=','uloga.idUloga')
                ->where([['email','=',$this->email],
                        ['lozinka','=',md5($this->lozinka)]])
                ->first();
        
        return $rez;
    }
    
    public function dohvatiID(){
         $rez=DB::table('korisnik')
                ->join('uloga','korisnik.idUloga','=','uloga.idUloga')
                ->where('idKorisnik',$this->id)
                ->first();
        
        return $rez;
    }   
    
    public function save(){
        
        $rez=DB::table('korisnik')->insert([
            'ime'=>$this->ime,
            'prezime'=>$this->prezime,
            'email'=> $this->email,
            'lozinka'=> md5($this->lozinka),  
            'idUloga'=>2   
        ]);
        return $rez;
                
        
    }
    
    public function update(){
        $rez=DB::table('korisnik')
                ->where('idKorisnik',$this->id)
                ->update([
                    'ime'=>$this->ime,
                    'prezime'=>$this->prezime,
                    'email'=>$this->email,
                    'lozinka'=> md5($this->lozinka),
                    'idUloga'=>$this->idUloga  
                ]);
        return $rez;
    }
    
     public function delete(){
         
         $rez=DB::table('korisnik')
                 ->where('idKorisnik', $this->id)
                 ->delete();
         
         
         return $rez;
         
     }
}
