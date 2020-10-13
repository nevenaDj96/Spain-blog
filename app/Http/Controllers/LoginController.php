<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Korisnik;

class LoginController extends Controller
{
         //registracija
     public function proveraReg(Request $request){
        
        $request->validate([
            
            'ime'=>'required|alpha_num|min:3|max:15',
            'prezime'=>'required|alpha_num|min:3|max:15',
            'email'=>'required|email|unique:korisnik,email',
            'lozinka'=>'required|min:6'],
                
                
                
           ['required'=>'Polje :attribute je obavezno',
            'alpha_num' => 'Polje :attribute nije u ispravnom formatu',
            'min'=>'Polje :attribute mora sadrzati najmanje :min karaktera',
            'max'=>'Polje :attribute moze sadrzati najvise :max karaktera',
            'unique' => ':attribute vec postoji']);
        
        
        
          $korisnik=new Korisnik();
          $korisnik->ime=$request->input('ime');
          $korisnik->prezime=$request->input('prezime');
          $korisnik->email=$request->input('email');
          $korisnik->lozinka=$request->input('lozinka');
          
        
          
          try{
              
              $dodavanje=$korisnik->save();
              
              if($dodavanje){
              
                  return redirect()->back()->with('success','Uspesno ste se registrovali,sada se mozete prijaviti');
                  
              }
              else{
                  
                  return redirect()->back()->with('error','Greska pri registraciji');
                  
              }
              
          } catch (\Exception $ex) {

              \Log::error('Greska: '.$ex->getMessage());
              return redirect()->back()->with('error','Serverska greska');
              
          }
          
        
    }
    
    
    //logovanje
    public function proveraPrijava(Request $request){
        
        $request->validate([
            
            'email'=>'required|email',
            'lozinka'=>'required|min:6|max:15|alpha_num'
            
        ], 
           ['required'=>'Polje :attribute je obavezno!',
            'min'=>'Polje :attribute treba da ima minumum :min karaktera',
            'max'=>'Polje :attribute ne sme da ima vise od :max karaktera',
            'alpha_num' => 'Polje :attribute dozvoljava samo slova i brojeve',  
               ]     
                );
        
        
        $email=$request->input('email');
        $lozinka=$request->input('lozinka');
        
        $korisnik=new Korisnik();
       
        $korisnik->email = $email;
        $korisnik->lozinka = $lozinka;
        
        try{
          
            $ulogovanKorisnik= $korisnik->getByEmailandPass();
           // dd($ulogovanKorisnik);
            
            if($ulogovanKorisnik!=null){
                
                $request->session()->push('kor',$ulogovanKorisnik);
                return redirect('/')->with('success','Uspesno ste se ulogovali');
                
            }
            else{
                    return redirect()->back()->with('error','Korisnik ne postoji u bazi');
            }
            
            
        } catch (\Exception $ex) {

            \Log::error('Greska: '.$ex->getMessage());
           return redirect()->back()->with('error','Serverska greska');
            
            
            
        }
        
        
    }
    
    
    //odjava
      public function odjava(Request $request){
      
          
        $request->session()->forget('kor');
        $request->session()->flush();
	return redirect('/');
        
        
    }
 
    
    
    
    //kontakt provera
    
    
    public function proveraKontakt(Request $request){
        
        $request->validate([
           'mail'=>'required|email',
           'naslov'=>'regex:/^[A-Z][a-z]+(\s[\w\d\-]+)*$/',
           'poruka'=>'required'
            ],
          [
             'required'=>'Polje :attribute je obavezno',
             'naslov.regex'=>'Polje :attribute dozvoljava samo slova i brojeve'
          ]);
        
        
        try{
            
              
            $naslov= $request->input('naslov');
            $poruka = $request->input('poruka');
            $to = "nevena.djakovic996@gmail.com";
            $header= "From: webmaster@example.com";

            mail($to, $naslov, $poruka,$header);
            return redirect()->back()->with('success', 'Uspesno poslata poruka.');
        } 
        catch (\Exception $ex) {

            \Log::error('Greska: '.$ex->getMessage());
            
            return redirect()->back()->with('error','Greska,pokusajte ponovo');
            
            
        }
    }
    
   
    
    
}
