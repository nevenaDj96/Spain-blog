<?php
//FrontEndController

Route::get('/', 'FrontEndController@index')->name('pocetna');
Route::get('/prijava', 'FrontEndController@prijava')->name('prijava');
Route::get('/registracija','FrontEndController@registracija')->name('registracija');
Route::get('/kontakt','FrontEndController@kontakt');
Route::get('/galerija','FrontEndController@galerija');
Route::get('/autor','FrontEndController@autor')->name('autor');
Route::get('/destinacije','FrontEndController@destinacije');
Route::get('/destinacija/{id}','FrontEndController@destinacija');
Route::get('/korisnik','FrontEndController@korisnik')->name('korisnik');
Route::get('/drugiKorisnik/{id}','FrontEndController@drugiKorisnik')->name('drugiKorisnik');
Route::get('/korisnik/dodavanjePostova','FrontEndController@dodavanjePostova')->name('dodavanjePostova');
Route::get('/korisnik/izmenaPostova/{id}','FrontEndController@izmenaPostova')->name('izmenaPostova');


//LoginController

Route::post('/proveraPrijava','LoginController@proveraPrijava')->name('proveraPrijava');
Route::post('/proveraReg','LoginController@proveraReg')->name('proveraReg');
Route::get('/odjava','LoginController@odjava')->name('odjava');
Route::post('/proveraKontakt','LoginController@proveraKontakt')->name('proveraKontakt');



//PostController

//Postovi
Route::post('/korisnik/proveraDodavanja','PostController@proveraDodavanja')->name('proveraDodavanja');
Route::post('/korisnik/proveraIzmenePOSTA','PostController@proveraIzmenePOSTA')->name('proveraIzmenePOSTA');
Route::get('/korisnik/brisanje/{id}','PostController@brisanje')->name('brisanje');

//Komentari
Route::post('/dodajKomentar','PostController@dodajKomentar')->name('dodajKomentar');
Route::get('/izbrisiKomentar/{id}','PostController@izbrisiKomentar')->name('izbrisiKomentar');

//AJAX

Route::get('/postoviAjax/{id}', 'AjaxController@prikazPostova')->name('prikazPostova');
Route::post('/anketa/dodajGlas', 'AjaxController@dodajGlas');


//ADMIN


Route::group(['middleware'=>'admin'],function(){
    
    //anketa
Route::get('/admin/{id?}', 'AdminController@pocetna')->name('admin');
Route::get('/admin/odgovor/{id?}', 'AdminController@izmenaOdgovora')->name('izmenaOdgovora');
Route::get('/admin/odgovor/brisi/{id}', 'AdminController@obrisiOdgovor')->name('obrisiOdgovor');
Route::post('/admin/dodajAnketu', 'AdminController@dodajAnketu')->name('dodajAnketu');
Route::post('/admin/izmeniAnketu/{id}', 'AdminController@izmeniAnketu')->name('izmeniAnketu');
Route::post('/admin/podesiAktivnu', 'AdminController@podesiAktivnu')->name('podesiAktivnu');
Route::post('/admin/prikaziOdgovore/{id}', 'AdminController@prikaziOdgovore')->name('prikaziOdgovore');
Route::post('/admin/dodajOdgovor', 'AdminController@dodajOdgovor')->name('dodajOdgovor');
Route::get('/admin/izbrisiAnketu/{id}', 'AdminController@izbrisiAnketu')->name('izbrisiAnketu');

//meni
Route::get('/meni', 'AdminController@meni')->name('meni');
Route::get('/dodajMeni','AdminController@dodajMeni')->name('dodajMeni');
Route::post('/proveraMeni','AdminController@proveraMeni')->name('proveraMeni');
Route::get('/izmeniMeni/{id}','AdminController@izmeniMeni')->name('izmeniMeni');   
Route::post('/proveraIzmeneM','AdminController@proveraIzmeneM')->name('proveraIzmeneM');
Route::get('/obrisiMeni/{id}','AdminController@obrisiMeni')->name('obrisiMeni');    


//galerija
Route::get('/gal','AdminController@galerija')->name('gal');
Route::get('/dodajSliku','AdminController@dodajSliku')->name('dodajSliku');
Route::post('/proveraSlike','AdminController@proveraSlike')->name('proveraSlike');
Route::get('/izmenaSlike/{id}','AdminController@izmenaSlike')->name('izmenaSlike');
Route::post('/proveraIzmeneSlike','AdminController@proveraIzmeneSlike')->name('proveraIzmeneSlike');
Route::get('obrisiSliku/{id}','AdminController@obrisiSliku')->name('obrisiSliku');

//postovi

Route::get('/postovi','AdminController@postovi')->name('postovi');
Route::get('/dodajPost','AdminController@dodajPost')->name('dodajPost');
Route::post('/proveraDodavanjaPosta','AdminController@proveraDodavanjaPosta')->name('proveraDodavanjaPosta');
Route::get('/izmeniPost/{id}','AdminController@izmeniPost')->name('izmeniPost');
Route::post('/proveraIzmenePostaAdmin','AdminController@proveraIzmenePostaAdmin')->name('proveraIzmenePostaAdmin');
Route::get('/brisanjePostova/{id}','AdminController@brisanjePostova')->name('brisanjePostova');

//korisnici

Route::get('/korisnici','AdminController@korisnici')->name('korisnici');
Route::get('/dodajKorisnika','AdminController@dodajKorisnika')->name('dodajKorisnika');
Route::post('/proveraDodavanjaKorisnika','AdminController@proveraDodavanjaKorisnika')->name('proveraDodavanjaKorisnika');
Route::get('/izmenaKorisnika/{id}','AdminController@izmenaKorisnika')->name('izmenaKorisnika');
Route::post('/proveraIzmene','AdminController@proveraIzmene')->name('proveraIzmene');
Route::get('/brisanjeKorisnika/{id}','AdminController@brisanjeKorisnika')->name('brisanjeKorisnika');


//komentari

Route::get('/komentari','AdminController@komentari')->name('komentari');
Route::get('/brisanjeKomentara/{id}','AdminController@brisanjeKomentara')->name('brisanjeKomentara');

//gradovi
Route::get('/gradovi','AdminController@gradovi')->name('gradovi');
Route::get('/dodajGrad','AdminController@dodajGrad')->name('dodajGrad');
Route::post('/proveraGrada','AdminController@proveraGrada')->name('proveraGrada');
Route::get('/izmenaGrada/{id}','AdminController@izmenaGrada')->name('izmenaGrada');
Route::post('/proveraIzmenegrada','AdminController@proveraizmeneGrada')->name('proveraIzmeneGrada');
Route::get('/brisanjeGrada/{id}','AdminController@brisanjeGrada')->name('brisanjeGrada');
});


//dokumentacija
Route::get('/dokumentacija','FrontEndController@dokumentacija')->name('dokumentacija');