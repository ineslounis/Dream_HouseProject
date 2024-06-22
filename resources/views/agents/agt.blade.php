<div class="row anc" style="margin-top: 200px">
    <div class="col-md-4">
        <div class="divimg">
            <a href="#" >
            <img src="../images/{{$utilisateur->image_user}}" alt="" class="image-responsive" >
            </a>
        </div>
    </div>
    <div class="col-md-8">
        <div class="info">
            <ul>
                <li style="font-weight: bold"> Agence Dream house</li> <br>
                <li> {{$utilisateur->name}}  {{$utilisateur->prenom}}</li> <br>
                <li> {{$utilisateur->adresse}}, {{$utilisateur->wilaya}} </li><br>
                <li> {{$utilisateur->email}}</li> <br>
                <li> {{$utilisateur->tel}}</li>
            </ul>
           
                 {{-- <a href="{{route('biens.show', ['slug' => $bien->slug])}}">Voir plus</a></p> --}}
                 {{-- <a href="{{route('biens.show', ['slug' => $bien, 'bien' => $bien])}}">Voir plus</a></p> --}}

        </div>
    </div>
</div>