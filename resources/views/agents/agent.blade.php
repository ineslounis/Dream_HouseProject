@section('title')
Page d'agents immobiliers
@endsection

@extends('base')

@section('content')
    {{-- <div class="find_trip" style="margin-bottom: 450px; width: 72% ; margin-left: 160px;">
        <form action="" method="GET">
            <div>
                <label>Type:</label>
                <input type="text" placeholder="Entrez un type" name="type" value="{{ $input['type'] ?? ''}}">
            </div>
            <div>
                <label>Transaction:</label>
                <input type="text" placeholder="transaction" name="transaction" value="{{ $input['transaction'] ?? ''}}">
            </div>
            <div>
                <label>Surface:</label>
                <input type="text" placeholder="Entrez une surface" name="surface" value="{{ $input['surface'] ?? ''}}">
            </div>
            <div>
                <label>Prix Max:</label>
                <input type="number" placeholder="Entrez le prix max" name="prix" value="{{ $input['prix'] ?? ''}}">
            </div>
            <input type="submit" value="rechercher">
        </form>
    </div> --}}
    <section class="container" id="annonce" style="margin-bottom: 90px; margin-top: -60px;">
        <div class="row" id="cartean" style="">
            <div class="col-12" >
              @forelse ($utilisateur as $utilisateur)
                @if ($utilisateur->hasRole('agent'))
                    @include('agents.agt')
                @endif
              @empty
                  <h2 style="color: #10b1d0; text-align: center; margin-top: 200px">Aucun agent ne correspond à votre recherche 😔😔</h2>
              @endforelse
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
@endsection
