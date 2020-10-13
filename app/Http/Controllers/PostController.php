<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komentar;
use App\Models\Destinacije;
use App\Models\Kategorija;
use App\Models\Slika;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    
    public function dodajKomentar(Request $request){
        
        $komentar=new Komentar();
        $post = new Destinacije();
        
        $komentar->sadrzaj=$request->input('komentar');
        $komentar->idKorisnik=session()->get('kor')[0]->idKorisnik;
        $komentar->idPost=$request->input('idPost');
        
        $post->idDestinacije = $request->input('idPost');
        
        try{
            
        $komentar->save();
        $post->komentarVise();
        
        return redirect()->back()->with('success','Uspesno ste dodali komentar');

        
        }
        catch(\Exception $ex){
            
            \Log::error('Greska:'.$ex->getMessage());
            return redirect()->back()->with('error','Greska pri dodavanju komentara');
            
        }
        
    }
    
    
    public function izbrisiKomentar($id){
        
        $komentar=new Komentar();
        $komentar->idKomentar=$id;
        
        $post=new Destinacije();
        $post->idDestinacije = $komentar->idPost()->idPost;
        
        
        try{
            $komentar->delete();
            $post->komentarManje();
           return redirect()->back()->with('success','Uspesno ste obrisali komentar');

          
            
        } catch (Exception $ex) {
 
            \Log::error('Greska:'.$ex->getMessage());
            return redirect()->back()->with('error','Greska pri dodavanju komentara');
        }
        
        
    }
    
   //DODAVANJE POSTA-provera
    public function proveraDodavanja(Request $request){
       
        $request->validate([
            'naslov'=>'required|alpha_num',
            'opis'=>'required',
            'sadrzaj'=>'required',
            'gradovi' => 'required|not_in:0',
            'slika' => 'required|mimes:jpg,jpeg,png',
            'alt' => 'required'],
                
            [
             'required'=>'Polje :attribute je obavezno',
             'alpha_num'=>'Polje :attribute dozvoljava samo slova i brojeve',
             'not_in'=>'Morate izabrati kategoriju',
             'mimes' => 'Dozvoljeni formati :values formati']);
        
      
        //slika
        $slika=$request->file('slika');
        $ekstenzija=$slika->getClientOriginalExtension();
        $tmp=$slika->getPathname();
        
        $folder='/img/';
        $ime= time().".".$ekstenzija;
        $nova_putanja= public_path($folder).$ime;
        
        try{
            
            //slika
            
            File::move($tmp,$nova_putanja);
            
            
            $slika1=new Slika();
            $slika1->alt= trim($request->input('alt'));
            $slika1->putanja='/img/'.$ime;
            
            $idSlika=$slika1->save();
            
            //postovi
            $destinacija=new Destinacije();
           
            
            $destinacija->idKategorija=$request->input('gradovi');
            $destinacija->korisnikId=$request->input('idKorisnik');
            $destinacija->naslov=$request->input('naslov');
            $destinacija->opis=$request->input('opis');
            $destinacija->sadrzaj=$request->input('sadrzaj');
            $destinacija->slikaId=$idSlika;
         
            $destinacija->save();
            
            return redirect()->back()->with('success','Uspesno ste dodali post');
            
        }catch(\Exception $ex){ 
			\Log::error('Greska:'.$ex->getMessage());
			return redirect()->back()->with('error','Javila se greska prilikom dodavanja postova u bazu, pokusajte ponovo.');
		}
    }
    
    
    
    
    //izmena posta-provera
    
    
    public function proveraIzmenePOSTA(Request $request){
        
       
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
        
        
        
        $destinacija=new Destinacije();
        
        $destinacija->naslov=$request->input('naslov');
        $destinacija->opis=$request->input('opis');
        $destinacija->sadrzaj=$request->input('sadrzaj');
        $destinacija->idKategorija=$request->input('gradovi');
        $destinacija->korisnikId=$request->input('idKorisnik');
        $destinacija->idDestinacije=$request->input('idPost');
        $destinacija->datumIzmene= now();
                
        //izmena i posta i slike
        if(!empty($request->file('slika'))){
         
            try{
                
               $slika=new Slika(); 
               $stara= $destinacija->post()->putanja;
              
               //brisanje slike sa servera
               file::delete($stara);
               
               $nova=$request->file('slika');
               $tmp_path=$nova->getPathname();
               $ime_fajla= time().'.'.$nova->getClientOriginalExtension();
               
               
               $putanja='/img/'.$ime_fajla;
               $putanja_SERVER= public_path($putanja);
               
               
               file::move($tmp_path,$putanja_SERVER);
               
               $slika->putanja=$putanja;
               $slika->alt=$request->input('alt');
               $idSlika=$slika->save();
               
               
               $destinacija->slikaId=$idSlika;
               $destinacija->izmenaPosta();
               
               return redirect()->back()->with('success','Uspesno izmenjen post');
            } catch (\Exception $ex) {
 
                \Log::error('Greska: '.$ex->getMessage());
                 return redirect()->back()->with('error','Greska pri izmeni posta i slike');
            }
            
            
            
        }
        
        else{
            //izmena samo posta
           try{
               
               $destinacija->izmenaPosta();
               return redirect()->back()->with('success','Uspesno izmenjen post');
               
           } catch (\Exception $ex) {
 
                \Log::error('Greska: '.$ex->getMessage());
                 return redirect()->back()->with('error','Greska pri izmeni posta');
            }
        }
        
        
    }
    
    
    //brisanje posta-provera
    
    public function brisanje($id){
        
        try{
            
            $destinacija=new Destinacije();
            $destinacija->idDestinacije=$id;
            
          
            $idSlika=$destinacija->post()->idSlika;
            
            $slika=new Slika();
            $slika->idSlika=$idSlika;
            
            $putanja=$slika->putanja;
            
            $slika->delete();
            
            File::delete($putanja);
            
            $destinacija->deleteP();
            
            
            return redirect()->back()->with('success','Izbrisali ste post');
            
            
        } catch (\Exception $ex) {
            
            \Log::error('Greska '.$ex->getMessage());
            return redirect()->back()->with('error','Greska, prilikom brisanja posta');

        }
        
        
    }
    
    
    
    
}
