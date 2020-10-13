<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinacije;
use App\Models\Anketa;

class AjaxController extends Controller
{
    public function prikazPostova($id){
        
        $postovi = new Destinacije();
        
        if($id == 0){
        
        
        try{
            
            $prikaz = $postovi->getAll();
            
            if(count($prikaz) > 0){
                
                return response($prikaz, 200);
            }
            
            return response("Nema postova...", 200);

            
        }
        catch(\Exception $ex){
            
            \Log::error('Greska: '.$ex->getMessage());
            return response("Greska na serveru", 500);
        }
        
        }
        else{
            
          $postovi->idKategorija = $id;
          
          try{
              
              $prikaz = $postovi->poKategoriji();
            
            if(count($prikaz) == 0){
                
                return response("Nema postova trazenog grada", 200);
                
            }
            else{
                return response($prikaz, 200);
            } 
              
              
          }
          catch(\Exception $ex){
              
              \Log::error('Greska: '.$ex->getMessage());
            return response("Greska na serveru", 500);
          }
            
        }
        
    }
        public function dodajGlas(Request $request){
        
        $idOdgovor = $request->input('odgovor');
        
        if($idOdgovor == null){
            
            return response('Izaberite odgovor');
        }
        else{
            
             $anketa = new Anketa();
        
            $idKorisnik = session('kor')[0]->idKorisnik;
            $anketa->idKorisnik = $idKorisnik;
            
            
           try{
                $idAktivna = $anketa->get()->idAnketa;
                $anketa->idAktivna = $idAktivna;

                $provera = $anketa->proveraGlasanja();
                //dd($anketa->proveraGlasanja());

                if($provera != null){
                    return response("Vec ste glasali", 200);
                }
                else{

                    $anketa->idOdgovor = $idOdgovor;
                    $anketa->dodajGlas();
                    $anketa->azurirajRezultate();
                   
                    
                    return response("Hvala sto ste glasali", 200);
                }

                }
            catch(\Exception $ex){

                \Log::error('Greska: '.$ex->getMessage());
                return response('Greska na serveru', 500);
            }

        }
        
    }
    
    
}
