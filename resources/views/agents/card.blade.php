
<div class="box">
    <img src="../images/{{$utilisateur->image_user}}" alt="">
    <div class="content">
        <div>
            <p><b>Nom:</b>{{$utilisateur->name}}</p>
            <p><b>Prenom:</b>{{$utilisateur->prenom}} </p>
            <p><b>email:</b>{{$utilisateur->email}}</p>
            <p><b>tel:</b>{{$utilisateur->tel}}</p>
            <br>
            {{-- <a href="#">Choisir</a> --}}
        </div>
    </div>
</div>