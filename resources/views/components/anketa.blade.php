@isset($anketa)

<form class="form-control" method="post">
    {{csrf_field()}}
    <table id='table'>
        <tr>
            <th>{{$anketa->pitanje}}</th>
        </tr>
            @isset($odgovori)
                @foreach($odgovori as $odg)
            <tr> 
                <td><input  type="radio" class="odgovor" name="odg" value="{{$odg->idOdgovor}}"/>{{$odg->odgovor}}</td>
            </tr>
                @endforeach
            <tr><td><input type="submit" class="form-control" name="glasaj" id="glasaj" value="Glasaj"/></td></tr>
            @endisset
    </table><br/>
    
    <div class="alert alert-info" id="anketaObavestenje">
    
    </div>
    
</form>
     
@endisset

