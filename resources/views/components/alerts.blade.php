 @if ($errors->any())
            <div class="alert alert-danger"  style='width: 50%; margin-left: 6%;'>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
       
            @if(session()->has('error'))
            <div class="alert alert-danger"  style='width: 50%; margin-left: 6%;'>
                {{ session()->get('error') }}
            </div>
                
            @endif
            
            @if(session()->has('success'))
            <div class="alert alert-success"  style='width: 50%; margin-left: 6%;'>
                {{ session()->get('success') }}
            </div>
                
            @endif
            