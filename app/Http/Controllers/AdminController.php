<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meni;
use App\Models\Anketa;
use App\Models\Galerija;
use App\Models\Destinacije;
use App\Models\Kategorija;
use App\Models\Slika;
use App\Models\Korisnik;
use App\Models\Komentar;
use App\Models\Uloga;
use Illuminate\Support\Facades\File;


class AdminController extends Controller
{
    public $data;
    
    public function __construct() {
        $meni=new Meni();
        try{
            $this->data['meni']=$meni->getAll();
            
        } catch (\Exception $ex) {
                 \Log::error('Greska:'.$ex->getMessage());
        }
        
    }
    
    
    
    public function pocetna($id = null){
        
        $anketa=new Anketa();
        
        
         if(!empty($id)){
                $anketa->idAnketa = $id;
                try{
                    $this->data['anketa'] = $anketa->dohvatiAnketu();
                }
                catch(\Exception $ex){

                    \Log::error('Desila se greska: '.$ex->getMessage());
                }
            }
            
            try{
                $this->data['ankete'] = $anketa->getAll();
                return view('admin.anketa', $this->data);
            }
            catch(\Exception $ex){
            
            \Log::error('Desila se greska: '.$ex->getMessage());
        }
        
    }
    
    public function dodajAnketu(Request $request){
        
        $anketa=new Anketa();
          
        $request->validate([
            
            'pitanje' => 'required|min:10'
            
        ]);
        
  
        try{
            
         $anketa->pitanje=$request->get('pitanje');  
        
        $anketa->save();
        
        return redirect()->back()->with('success','Dodali ste anketu');
            
        }    catch(\Exception $ex){
            
            \Log::error('Desila se greska: '.$ex->getMessage());
        
        
    }
    
    } 
    
    public function izbrisiAnketu($id){
        
        $anketa=new Anketa();
        
        try{
            
            $anketa->idAnketa=$id;
            $anketa->delete();
            $anketa->deleteAll();
            
            return $redirect->back();
           
            
        }  catch(\Exception $ex){
            
            \Log::error('Greska: '.$ex->getMessage());
            return redirect()->back()->with('error', 'Greška, pokušajte kasnije');
        }
        
        
    }
    
    
    public function izmeniAnketu(Request $request,$id){
        
        
          $request->validate([
            
            'pitanje' => 'required|min:10'
            
        ]);
        
        $anketa=new Anketa();
        $anketa->pitanje=$request->get('pitanje');
        
        
        try{
            
            $anketa->idAnketa=$id;
            $anketa->update();
             
            return redirect()->back();
            
            
        } catch(\Exception $ex){
            
            \Log::error('Greska: '.$ex->getMessage());
            return redirect()->back()->with('error', 'Greška, pokušajte kasnije');
        }
        
        
        
    }
    
    
    public function podesiAktivnu(Request $request){
        
         $anketa = new Anketa();
        
        $aktivnaId = $request->get('activeList');
        
        
        try{
             $anketa->idAnketa = $aktivnaId;
             $anketa->updateActive();
             
                return redirect()->back();
                
            }
            catch(\Exception $ex){
            
            \Log::error('Desila se greska: '.$ex->getMessage());
            return redirect()->back()->with('error', 'Greška, pokušajte kasnije');
        }
        
    }
        
        public function prikaziOdgovore($id){
            
            $anketa=new Anketa();
            
            try{
                
                $anketa->idAnketa=$id;
                $odgovori=$anketa->sviodgovori();
                return  response ($odgovori, 200);
            }   catch(\Exception $ex){
            
            \Log::error('Greska: '.$ex->getMessage());
            return response(null,500);
        }
        
            
            
        }
     
        
        public function obrisiOdgovor($id){
        
        $anketa = new Anketa();
        
        try{
            
            $anketa->idOdgovor = $id;
            $anketa->deleteA();
            return redirect()->back();
        }
        catch(\Exception $ex){
            
            \Log::error('Desila se greska: '.$ex->getMessage());
            return redirect()->back()->with('error', 'Greška');
        }
        
    }
    
    public function dodajOdgovor(Request $request){
    
    $request->validate([
        'odgovorPlus' => 'required',
        'activeList' => 'required'
    ]);
    
    $anketa = new Anketa();
    
    $idAnketa = $request->input('activeList');
    $anketa->idAnketa = $idAnketa;
    $odgovori = explode(';', $request->input('odgovorPlus'));
    
    try{
        
        foreach($odgovori as $o){
            
           $anketa->odgovor = $o;
           $anketa->saveAnsver();
        }
        return redirect()->back()->with('success', 'Dodali ste odgovore');
    }
    catch(\Exception $ex){
            
            \Log::error('Desila se greska: '.$ex->getMessage());
            return redirect()->back()->with('error', 'Greška, pokušajte kasnije');
        }
    
}
    

//meni-prikazivanje


   public function meni(){
       
       $meni=new Meni();
    
       try{
           
          $this->data['meni']=$meni->getAll();
          return view('admin.meni',$this->data);
          
          
       }  catch (\Exception $ex) {
            
               \Log::error('Greska: '.$ex->getMessage());
           }
           
       
       
   }
   
   
   //dodavanje menija
   
   public function dodajMeni(){
    
       return view('admin.dodajMeni',$this->data);
       
   }
   
   
   //provera dodavanja menija
   
   public function proveraMeni(Request $request){
       
       $request->validate([
        'naziv'=>'required',
         'putanja'=>'required',
           'pozicija'=>'required|numeric'
           
           
       ],
         [   
               'required'=>'Polje :attribute je obavezno']);
       
     try{
         
         
         $meni=new Meni();
         
         $meni->naziv=$request->input('naziv');
         $meni->putanja=$request->input('putanja');
         $meni->pozicija=$request->input('pozicija');
         
         
         $meni->save();
         return redirect('/meni')->with('success','Uspesno ste dodali meni');
         
         
     } catch (\Exception $ex) {
              \Log::error('Greska: '.$ex->getMessage());
               return redirect()->back()->with('error','Greska pri dodavanju menija, pokusajte ponovo');
        
     }
       
       
       
   }
   
   
   //izmena menija
   
   public function izmeniMeni($id){
   
       $meni = new Meni();
       $meni->idMeni=$id;
      
       $izmeni=$meni->dohvatiID();
       
       $this->data['izmeni']=$izmeni;
       //dd($this->data['izmeni']);
       return view('admin.izmenaMeni',$this->data);
       
       
   }
    
    
   //provera izmene menija
   
   public function proveraIzmeneM(Request $request){
       
        
       $request->validate([
        'naziv'=>'required',
         'putanja'=>'required',
           'pozicija'=>'required|numeric'
           
           
       ],
         [   
               'required'=>'Polje :attribute je obavezno',
                'numeric'=>'Dozvoljen samo upis brojeva']);
           
       
       try{
           
           $meni=new Meni();
           
           $meni->idMeni=$request->input('idMeni');
           $meni->naziv=$request->input('naziv');
           $meni->putanja=$request->input('putanja');
           $meni->pozicija=$request->input('pozicija');
           
          
          // dd($meni);
             
             
             
           $meni->update();
           
           return redirect('/meni')->with('success','Uspesno izmenjen meni');
           
       } catch (\Exception $ex) {
              \Log::error('Greska:'.$ex->getMessage());
                return redirect()->back()->with('error','Greska prilikom izmene menija');
       }
       
       
   }
   
   
   
   //brisanje menija
   
   
   
   public function obrisiMeni($id){
       
       
       try{
                
       $meni=new Meni();
       $meni->idMeni=$id;
       
       $meni->delete();
       
     return redirect()->back()->with('success','Uspesno ste izbrisali meni');
            
       
       }  catch (\Exception $ex) {
            
            \Log::error('Greska '.$ex->getMessage());
            return redirect()->back()->with('error','Greska, prilikom brisanja menija');

        }
  
      
       
   }
   //galerija
   
   
   public function galerija(){
      
       
       $galerija=new Galerija();
       
       
         

    try{
        $gal=$galerija->stranicenje(4);
    
     return view('admin.galerija',$this->data,compact('gal'));
    
    
}   catch(\Exception $ex){
            
            \Log::error('Desila se greska: '.$ex->getMessage());
        }
   }
   
   
   //dodavanje slike
   
   public function dodajSliku(){
       
       return view('admin.dodajSliku',$this->data);
    
   }
   
   //dodavanje- provera slike
   
   public function proveraSlike(Request $request){
       
    
        $request->validate([
            
             'alt'=>'required',
              'slika'=> 'required|mimes:jpg,jpeg,png'
           
        ],
                [
                    'required'=>'Polje :attribute je obavezno',
                    'mimes'=>'Dozvoljeni su formati :values'
                ]);
        
       
        $slika=$request->file('slika');
        $ekstenzija=$slika->getClientOriginalExtension();
        $tmp=$slika->getPathname();
         $folder='img/';
        $ime= time().".".$ekstenzija;
        $nova_putanja= public_path($folder).$ime;
        
        try{
            
            File::move($tmp,$nova_putanja);
            
            
            $slika1=new Galerija();
            
            $slika1->alt= trim($request->get('alt'));
            $slika1->putanja='/img/'.$ime;
            
           
            $slika1->save();
            
            
           return redirect()->back()->with('success','Uspesno ste dodali sliku');
           
       } catch(\Exception $ex){ 
			\Log::error('Greska:'.$ex->getMessage());
			return redirect()->back()->with('error','Javila se greska prilikom dodavanja slika u bazu, pokusajte ponovo.');
		}
  
   }
   
   
   
   //izmena slike
   
   public function izmenaSlike($id){
       
       $slika=new Galerija();
      
       $slika->idGalerija=$id;
      
       $izmena=$slika->slika();
       
       $this->data['izmena']=$izmena;
     
       return view('admin.izmenaSlike',$this->data);
   }
 
   
   //provera izmene slike
   
   public function proveraIzmeneSlike(Request $request){
       
      $validate = [
            'alt'=>'required'
        ];
        
        if(!empty($request->file('slika'))){
            
            $validate['slika'] ='required|mimes:jpg,jpeg,png';
        }
        
        $customMessages = [
          
            'required' => 'Polje :attribute je obavezno',
            'mimes' => 'Dozvoljeni formati :values formati'
           
            
        ];
        
        $request->validate($validate, $customMessages);
    
        
       try{
              
          $slika=new Galerija();
          $slika->idGalerija=$request->input('idGalerija');
       
           $stara=$slika->slika()->putanja;
          
           
           //dd($stara)
                  
           file::delete($stara);
           
           $nova=$request->file('slika');
           $tmp=$nova->getPathname();
           $ime_fajla=time().'.'.$nova->getClientOriginalExtension();
               
               
               $putanja='/img/'.$ime_fajla;
               $putanja_SERVER= public_path($putanja);
               
               
               file::move($tmp,$putanja_SERVER);
               
               
              
               $slika->putanja=$putanja;
               $slika->alt=$request->input('alt');
               
              
              
               $slika->update();
               
               
            return redirect()->back()->with('success','Uspesno izmenjena slika');
        
           }
       
       catch (\Exception $ex) {
 
                \Log::error('Greska: '.$ex->getMessage());
                 return redirect()->back()->with('error','Greska pri izmeni slike');
            }
       
       

       
   }
   
   
//brisanje slike
   
   public function obrisiSliku($id){
       
       try{
           
       $slika=new Galerija();
       
       $slika->idGalerija=$id;
       $slika->delete();
     
       $putanja=$slika->putanja;
      
       File::delete($putanja);
       
            return redirect()->back()->with('success','Izbrisali ste sliku');
            
             
       } catch (\Exception $ex) {
            
            \Log::error('Greska '.$ex->getMessage());
            return redirect()->back()->with('error','Greska, prilikom brisanja slike');

        }
        
      
   }
   //postovi
   
   
   public function postovi(){
           
     $post=new Destinacije();
      
        try{
            
        $postovi=$post->stranicenje(1);
     
       //dd($postovi);
       
        return view('admin.postovi',$this->data,compact('postovi'));
        
        }
        catch(\Exception $ex){
            
            \Log::error('Desila se greska: '.$ex->getMessage());
        }
   }
   
   
   //dodavanje postova
   
   public function dodajPost(){
       
       
       $gradovi=new Kategorija();
       $this->data['gradovi']=$gradovi->getAll();
       
       return view('admin.dodajPost',$this->data);
       
   }   
   
   //provera dodavanja posta
   
   public function proveraDodavanjaPosta(Request $request){
       
       $request->validate([
           
           'gradovi'=>'required|not_in:0',
           'naslov'=>'required|alpha_num',
           'opis'=>'required',
           'sadrzaj'=>'required',
           'slika'=>'required|mimes:jpg,jpeg,png',
           'alt'=>'required'
           
       ],
               ['required'=>'Polje :attribute je obavezno',
                 'alpha_num' =>'Dozvoljen je unos samo brojeva i slova',
                   'mimes'=>'Dozvoljeni su sledeci formati :values']);
       
      
           $slika=$request->file('slika');
           $ekstenzija=$slika->getClientOriginalExtension();
           $tmp=$slika->getPathname();
           
           $folder="/img/";
           $ime=time().".".$ekstenzija;
           $nova_putanja= public_path($folder).$ime;
           
       
       try{
           
           File::move($tmp,$nova_putanja);
        
           $slika1=new Slika();
           $slika1->alt=trim($request->input('alt'));
           $slika1->putanja='/img/'.$ime;
           $slika_id=$slika1->save();
           
           $post=new Destinacije();
           $post->naslov=$request->input('naslov');
           $post->opis=$request->input('opis');
           $post->sadrzaj=$request->input('sadrzaj');
           $post->korisnikId=$request->input('idKorisnik');
           $post->idKategorija=$request->input('gradovi');
           $post->slikaId=$slika_id;
           
           
           $post->save();
           return redirect()->back()->with('success','Uspesno ste dodali post');
           
       } 
      catch (\Exception $ex)
       { 
           
         \Log::error($ex->getMessage());
			return redirect()->back()->with('error','Greska pri dodavanju posta!');
		}
   }
   
   //izmena posta
   
   
   public function izmeniPost($id){
       
       $post=new Destinacije();
       $grad=new Kategorija();
       
       
       $grad->idKategorija=$id;
       $post->idDestinacije=$id;
       
       $izmena=$post->post();
       
       //dd($izmena);
       $this->data['izmena']=$izmena;
       $this->data['grad']=$grad->getAll();
       
       return view('admin.izmenaPosta',$this->data);
       
       
   }
   //provera izmene posta
   public function proveraIzmenePostaAdmin(Request $request){
       
      
        $validate = [
            'naslov'=>'required',
            'opis'=>'required',
            'sadrzaj'=>'required',
            'gradovi'=>'required|not_in:0',
            'alt'=>'required'
        ];
        
        if(!empty($request->file('slika'))){
            
            $validate['slika'] ='required|mimes:jpg,jpeg,png';
        }
        
        $customMessages = [
          
            'required' => 'Polje :attribute je obavezno',
            'not_in' => 'Morate izabrati kategoriju',
            'mimes' => 'Dozvoljeni formati :values formati'
           
            
        ];
        
        $request->validate($validate, $customMessages);
        
        $post=new Destinacije();
        
         $post->naslov=$request->input('naslov');
         $post->opis=$request->input('opis');
         $post->sadrzaj=$request->input('sadrzaj');
         $post->idKategorija=$request->input('gradovi');
         $post->korisnikId=$request->input('idKorisnik');
         $post->idDestinacije=$request->input('idPost');
         
         
         
         $post->datumIzmene= now();
         
         if(!empty($request->file('slika'))){
     
       
           try{
           
           $slika=new Slika();
           
           $stara=$post->post()->putanja;
           
           //dd($stara);
         
         
                      
           file::delete($stara);
           
           $nova=$request->file('slika');
           $tmp_path=$nova->getPathname();
           $ime_fajla=time().'.'.$nova->getClientOriginalExtension();
               
           $putanja='/img/'.$ime_fajla;
           $putanja_SERVER= public_path($putanja);
               
               
               file::move($tmp_path,$putanja_SERVER);
               
               $slika->putanja=$putanja;
               $slika->alt=$request->input('alt');
               
               $idSlika=$slika->update();
               
               
               $post->slikaId=$idSlika;
               $post->izmenaPosta();
               
               return redirect()->back()->with('success','Uspesno izmenjen post');
            } catch (\Exception $ex) {
 
                \Log::error('Greska: '.$ex->getMessage());
                 return redirect()->back()->with('error','Greska pri izmeni posta');
            }
            
            
            
        }
        
        else{
            //izmena samo posta
           try{
               
               $post->izmenaPosta();
               return redirect()->back()->with('success','Uspesno izmenjen post');
               
           } catch (\Exception $ex) {
 
                \Log::error('Greska: '.$ex->getMessage());
                 return redirect()->back()->with('error','Greska pri izmeni posta');
            }
   }
   
   
   }
   
   //brisanje postova
   
   public function brisanjePostova($id){
       
       
       try{
       $post=new Destinacije();
       $post->idDestinacije=$id;
       
       $idSlika=$post->post()->idSlika;
       
       
       $slika=new Slika();
       $slika->idSlika=$idSlika;
       $putanja=$slika->putanja;
       
       $slika->delete();
       file::delete($putanja);
       
       $post->deleteP();
       
       
       
    return redirect()->back()->with('success','Izbrisali ste post');
            
            
        } catch (\Exception $ex) {
            
            \Log::error('Greska '.$ex->getMessage());
            return redirect()->back()->with('error','Greska, prilikom brisanja posta');

        }

}

//korisnici

public function korisnici(){
    
    $korisnici=new Korisnik();
    $this->data['korisnici']=$korisnici->getAll();
    
    return view('admin.korisnici',$this->data);
    
}
//dodavanje korisnika

public function dodajKorisnika(){
    
    return view('admin.dodajKorisnika',$this->data);
    
}

//provera dodavanja korisnika

public function proveraDodavanjaKorisnika(Request $request){
    
    
    $request->validate([
        
         
            'ime'=>'required|alpha_num|min:3|max:15',
            'prezime'=>'required|alpha_num|min:3|max:15',
            'email'=>'required|email|unique:korisnik,email',
            'lozinka'=>'required|min:6'
        
    ],
                 
           ['required'=>'Polje :attribute je obavezno',
            'alpha_num' => 'Polje :attribute dozvoljava samo slova i brojeve',
            'min'=>'Polje :attribute mora sadrzati najmanje :min karaktera',
            'max'=>'Polje :attribute moze sadrzati najvise :max karaktera',
            'unique' => ':attribute vec postoji']);
       
    
    $korisnik=new Korisnik();
    
    try{
        
        $korisnik->ime=$request->input('ime');
        $korisnik->prezime=$request->input('prezime');
        $korisnik->email=$request->input('email');
        $korisnik->lozinka=$request->input('lozinka');
        
        $korisnik->save();
        
        return redirect('/korisnici')->with('success','Uspesno ste dodali korisnika');
        
    }catch (\Exception $ex) {

              \Log::error('Greska: '.$ex->getMessage());
              return redirect()->back()->with('error','Greska prilikom dodavanja korisnika u bazu');
              
          }
    
    
}


//izmena korisnika

public function izmenaKorisnika($id){
    
    $korisnik=new Korisnik();
    $uloga=new Uloga();
    
    $korisnik->id=$id;
    
    $izmena=$korisnik->dohvatiID();
    
    $this->data['izmena']=$izmena;
    
    $this->data['uloga']=$uloga->getAll();
    
   // dd($this->data['uloga']);
    
    
    return view('admin.izmenaKorisnika',$this->data);
    
}

//provera izmene korisnika
 public function proveraIzmene(Request $request){
     
    $request->validate([
        
         
            'ime'=>'required|alpha_num|min:3|max:15',
            'prezime'=>'required|alpha_num|min:3|max:15',
            'email'=>'required|email',
            'lozinka'=>'required|min:6',
            'uloga' =>'not_in:0' 
    ],
                 
           ['required'=>'Polje :attribute je obavezno',
            'alpha_num' => 'Polje :attribute dozvoljava samo slova i brojeve',
            'min'=>'Polje :attribute mora sadrzati najmanje :min karaktera',
            'max'=>'Polje :attribute moze sadrzati najvise :max karaktera',
            'unique' => ':attribute vec postoji',
            'not_in'=>'Morate izabrati ulogu'  ]);
       
    
    $korisnik=new Korisnik();
    
    try{
        
        $korisnik->id=$request->input('idKorisnik');
        $korisnik->ime=$request->input('ime');
        $korisnik->prezime=$request->input('prezime');
        $korisnik->email=$request->input('email');
        $korisnik->lozinka=$request->input('lozinka');
        $korisnik->idUloga=$request->input('uloga');
        
       
        
        $korisnik->update();
                
        
        return redirect('korisnici')->with('success','Uspesno ste izmenili korisnika');
        
    }catch (\Exception $ex) {

              \Log::error('Greska: '.$ex->getMessage());
              return redirect()->back()->with('error','Greska prilikom izmene korisnika');
              
          }
    
    
}
//brisanje korisnika


public function brisanjeKorisnika($id){
    
   
    
    try{
        
        $korisnik=new Korisnik();   
        $korisnik->id=$id;
        
        
        $korisnik->delete();
        
        return redirect()->back()->with('success','Uspesno ste obrisali korisnika');
        
        
    } catch (\Exception $ex) {

              \Log::error('Greska: '.$ex->getMessage());
              return redirect()->back()->with('error','Greska prilikom brisanja korisnika');
              
          }
    
}

public function komentari(){
    
    $komentari=new Komentar();
    
    $this->data['komentari']=$komentari->getAll();
    //dd($this->data['komentari']);
    
    
   return view('admin.komentari',$this->data);
   
    
}
//brisanje komentara


public function brisanjeKomentara($id){
    
    try{
        
         $komentar=new Komentar();
         $komentar->idKomentar=$id;
         
        $post=new Destinacije();
        $post->idDestinacije = $komentar->idPost()->idPost;
         
         $komentar->delete();
         $post->komentarManje();
       
         return redirect()->back()->with('success','Uspesno ste izbrisali komentar');
            
       
       }  catch (\Exception $ex) {
            
            \Log::error('Greska '.$ex->getMessage());
            return redirect()->back()->with('error','Greska, prilikom brisanja komentara');

        }
  
    
}

//radovi

public function gradovi(){
    
    $gradovi=new Kategorija();
    $this->data['gradovi']=$gradovi->getAll();
    
    return view('admin.gradovi',$this->data);
    
}

//dodaj grad

public function dodajGrad(){
    
    return view('admin.dodajGrad',$this->data);
    
    
}

//provera dodavanja grada

public function proveraGrada(Request $request){
    
    $request->validate([
        
        'grad'=>'required|alpha_num'
        
    ],
            ['required'=>'Polje :attribute je obavezno',
                'alpha_num'=>'Dozvoljen je upis samo slova i brojeva']);
            
    try{
        
        $grad=new Kategorija();
        $grad->grad=$request->input('grad');
        
        
        $grad->save();
        
        
        
   return redirect('/gradovi')->with('success','Uspesno ste dodali grad');
            
       
       }  catch (\Exception $ex) {
            
            \Log::error('Greska '.$ex->getMessage());
            return redirect()->back()->with('error','Greska, prilikom dodavanja grada');

        }
}

//izmena grada

public function izmenaGrada($id)
{
    
    $grad=new Kategorija();
    $grad->idKategorija=$id;
    
    $izmena=$grad->poID();
    $this->data['izmena']=$izmena;
    
    return view('admin.izmenaGrada',$this->data);
    
}


//provera
public function proveraIzmeneGrada(Request $request){
      $request->validate([
        
        'grad'=>'required|alpha_num'
        
    ],
            ['required'=>'Polje :attribute je obavezno',
                'alpha_num'=>'Dozvoljen je upis samo slova i brojeva']);
            
      
      try{
          
         $grad=new Kategorija();
         $grad->idKategorija=$request->input('idKategorije');
        $grad->grad=$request->input('grad');
        
        
        $grad->update();
        
          
      return redirect('/gradovi')->with('success','Uspesno ste izmenili grad');
            
       
       }  catch (\Exception $ex) {
            
            \Log::error('Greska '.$ex->getMessage());
            return redirect()->back()->with('error','Greska, prilikom izmene grada');

        }
      
}





//brisanje grada

public function brisanjeGrada($id){
    try{
        
    $grad=new Kategorija();
    $grad->idKategorija=$id;
    
    $grad->delete();
    
    return redirect()->back()->with('success','Uspesno ste obrisali grad');
    }  catch (\Exception $ex) {
            
            \Log::error('Greska '.$ex->getMessage());
            return redirect()->back()->with('error','Greska, prilikom brisanja grada');

        }
      
    
    
    
    
}




}