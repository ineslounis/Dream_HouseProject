<div class="row anc" style="margin-top: 200px">
    <div class="col-md-4">
        <div class="divimg">
            <a href="#" >
            <img src="../images/{{$bien->image}}" alt="" class="image-responsive" >
            </a>
        </div>
    </div>
    <div class="col-md-8">
        <div class="info">
            <h5>{{$bien->titre}}<b style="float: right; color: #10b1d0;">{{ number_format($bien->prix, thousands_separator: ' ') }} DA <img src="../images/etiquette-de-prix (1).png" alt=""></b></h5>
            <ul>
                <li><img src="{{asset('images/broche-de-localisation (2).png')}}" alt=""> {{$bien->adresse}}, {{$bien->wilaya}} </li>
                <li><img src="{{asset('images/surface.png')}}" alt=""> {{$bien->type}} avec {{$bien->surface}}m2  habitable</li>
                <li><img src="{{asset('images/contracter.png')}}" alt=""> Agence Dream house</li>
                <li><img src="{{asset('images/images.png')}}" alt=""> {{$bien->transaction}}</li>
            </ul>
            <p><b>Description: </b>{{$bien->description}}
                 {{-- <a href="{{route('biens.show', ['slug' => $bien->slug])}}">Voir plus</a></p> --}}
                 <a href="{{route('biens.show', ['slug' => $bien, 'bien' => $bien])}}">Voir plus</a></p>

        </div>
    </div>
</div>