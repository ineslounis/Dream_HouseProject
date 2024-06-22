<div class="box">
    <img src="../images/{{$bien->image}}" alt="">
    <div class="content">
        <div>
            {{-- <h4> <a href="{{route('bien.show',['slug' => $bien->getslug(), 'bien' => $bien])}}">{{$bien->titre}}</a></h4> --}}
            <h4>{{$bien->titre}}</h4>
            <p><b>Type:</b>{{$bien->type}} </p>
            <p><b>Wilaya:</b>{{$bien->wilaya}} </p>
            <p><b>Surface:</b>{{$bien->surface}} m2</p>
            <p><b>Prix:</b>{{ number_format($bien->prix, thousands_separator: ' ') }} DA</p>
            <br>
            <a href="{{route('biens.show', ['slug' => $bien, 'bien' => $bien])}}" >Lire Plus</a>
        </div>
    </div>
</div>