<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meni;
use App\Models\Galerija;
use App\Models\Destinacije;
use App\Models\Komentar;
use App\Models\Kategorija;
use App\Models\Anketa;
use App\Models\Korisnik;

class FrontEndController extends Controller
{
    
    private $data=[];
    
    //meni
    public function __construct() {
       
       $meni=new Meni();
       $korisnik= new Korisnik();
       
       
       try{
           
       $this->data['meni']=$meni->getAll();
       $this->data['korisnik']=$korisnik->getAll();
   
              }
       
       catch(\Exception $ex){
            
            \Log::error('Desila se greska: '.$ex->getMessage());
        }
        
    }
    
   //pocetna
   public function index(){
       
       
       $anketa=new Anketa();
      
        
        try{
            $this->data['anketa'] = $anketa->get();
            $this->data['odgovori'] = $anketa->odgovori();
            
            return view('pages.pocetna', $this->data);        
            
        }
        catch(\Exception $ex){
            
            \Log::error('Desila se greska: '.$ex->getMessage());
            return redirect()->back()->with('error', 'Desila se greska, pokusajte kasnije');
        }
       
       
       return view('pages.pocetna',$this->data);
   }
   
   //login
   public function prijava(){
       
       return view('pages.prijava',$this->data);
       
       
   }
   
   //registracija
   public function registracija(){
        
        return view('pages.registracija',$this->data);
        
    }
   
   //kontakt forma
   public function kontakt(){
      
       return view('pages.kontakt',$this->data);
   }
    
   //galerija
    public function galerija(){
        $galerija=new Galerija();
      
        try{
            
        $gal=$galerija->stranicenje(9);
     
       
        return view('pages.galerija',$this->data,compact('gal'));
        
        }
        catch(\Exception $ex){
            
            \Log::error('Desila se greska: '.$ex->getMessage());
        }
        
    }
    
    //autor
    
    public function autor(){
        
        return view('pages.autor',$this->data);
    }
   
    
    //destinacije
    
    
    public function destinacije(){
        
        $destinacije=new Destinacije();
        $kategorije = new Kategorija();
        try{
            
            $this->data['kategorije']= $kategorije->getAll();
            $this->data['destinacije']= $destinacije->getAll(); 
        
       //var_dump($this->data['destinacije']);
       
       return view('pages.destinacije',$this->data);
       
        }
     catch(\Exception $ex){
            \Log::error('Greska: '.$ex->getMessage());
            
        }
        
    }
    
    public function destinacija($id){
        
        $destinacija=new Destinacije();
        $destinacija->idDestinacije=$id;
        $komentar=new Komentar();
        $komentar->idPost=$id;
        try{
            $this->data['destinacija']=$destinacija->get();
            $this->data['komentari']=$komentar->getByPost();
           // var_dump($this->data['destinacija']);
            
            return view('pages.destinacija',$this->data);
        }   
        catch(\Exception $ex){
            \Log::error('Greska: '.$ex->getMessage());
            
        }
        
        }
        
        
        //korisnik
        
   public function korisnik(){
      
       if(session()->has('kor')){
       
        $korisnik = session('kor')[0];
       // dd($korisnik);
       
       $this->data['korisnik']=$korisnik;
       
       $id=$korisnik->idKorisnik;
       
       $destinacija=new Destinacije();
       $destinacija->korisnikId=$id;
       
       try{
           
         
           $destinacije=$destinacija->postID();
           $this->data['destinacije']=$destinacije;
           
           
           
           return view('pages.korisnik',$this->data);
           
       } catch (\Exception $ex) {
              \Log::error('Greska: '.$ex->getMessage());
              
              return redirect()->back()->with('error','Desila se greska, pokusajte kasnije');
       }
       
       
       }
        }
        
        
        
     public function drugiKorisnik($id){
       
       $drugiKorisnik= new Korisnik();
       $destinacija = new Destinacije();
      
       $destinacija->korisnikId=$id;
       $drugiKorisnik->id=$id;
      
       try{
              
           $k=$drugiKorisnik->dohvatiID();
           $this->data['drugiKorisnik']=$k;
           
           
           $destinacije = $destinacija->postID();
           $this->data['destinacije'] = $destinacije;
           return view('pages.drugiKorisnik', $this->data);
           
           
       } 
         catch(\Exception $ex){
           \Log::error('Greska: '.$ex->getMessage());
            return redirect()->back()->with('error', 'Desila se greska, pokusajte kasnije');
       }
         
         
         
         
         
           return view('pages.drugiKorisnik', $this->data);
     
   }
        //dodavanje postova 
        
        public function dodavanjePostova(){
        
          
          $gradovi=new Kategorija();
          $this->data['gradovi']=$gradovi->getAll();
          
          //dd( $this->data['gradovi']);
            
            
        return view('pages.dodavanjePostova',$this->data);
       
        }
        
        
        //izmena posta
        public function izmenaPostova($id){
               
            $gradovi=new Kategorija();
            $destinacija=new Destinacije();
            
            $destinacija->idDestinacije=$id;
           
            
            $izmena=$destinacija->post();
            $this->data['izmena']=$izmena;
            $this->data['gradovi']=$gradovi->getAll();
            //dd($this->data['izmena']);
            
            return view('pages.izmenaPostova',$this->data);
            
      
        }
        
        //dokumentacija
        
        public function dokumentacija(){
            
        $headers = array(
          'Content-Type: application/pdf',
        );
        return response()->download(public_path('dokumentacija.pdf'), 'dokumentacija.pdf', $headers);
    }
    
    
    
    
    
}
