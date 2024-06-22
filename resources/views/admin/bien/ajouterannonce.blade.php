@extends('admin.admin')

@section('title', $bien->exists ? "Editer un bien" : "Créer un bien")

@section('content')
<style>
    .button-container {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 30px;
        margin-bottom: 20px;
        margin-right: 220px
    }

    @media (max-width: 768px) {
        .button-container {
            flex-direction: column;
            align-items: center;
        }
    }
</style>

<section>
    <form action="{{ route($bien->exists ? 'admin.bien.update' : 'admin.bien.store', $bien) }}" class="formulaire" method="POST" enctype="multipart/form-data">
        @csrf
        @method($bien->exists ? 'put' : 'post')
        <h2>Depot d'annonce immobiliere</h2>
        <div class="row">
            <div class="col" style="flex: 100">
                <div class="row">
                    @include('shared.input', ['class' => 'col', 'label' => 'Titre', 'name' => 'titre', 'id'=>'titre', 'value' => $bien->titre])
                </div>
                <div class="row">
                    <label for="type">Type</label>
                    <select name="type" id="type">
                        <option value="Local commercial" {{ $bien->type === 'Local commercial' ? 'selected' : '' }}>Local commercial</option>
                        <option value="Ville" {{ $bien->type === 'Villa' ? 'selected' : '' }}>Villa</option>
                        <option value="Appartement" {{ $bien->type === 'Appartement' ? 'selected' : '' }}>Appartement</option>
                        <option value="Terrain" {{ $bien->type === 'Terrain' ? 'selected' : '' }}>Terrain</option>
                    </select>
                </div>
                <div class="col row">
                    @include('shared.input', ['class' => 'col', 'label' => 'Surface','name' => 'surface','id'=>'surface', 'value' => $bien->surface])
                </div>
                <div class="col row">
                    @include('shared.input', ['class' => 'col', 'label' => 'Numero d\'etage (en cas d\'une appartement)','name' => 'numero_etage', 'id'=>'numero_etage', 'value' => $bien->numero_etage])
                </div>
                <div class="col row">
                    @include('shared.input', ['class' => 'col', 'label' => 'Nombre etages','name' => 'nombre_etages', 'id'=>'nombre_etages', 'value' => $bien->nombre_etages])
                </div>
                <div class="col row">
                    @include('shared.input', ['class' => 'col', 'label' => 'Nombre de chambres','name' => 'nombre_chambre', 'id'=>'nombre_chambre', 'value' => $bien->nombre_chambre])
                </div>
                <div class="row">
                    @include('shared.input', ['class' => 'col', 'label' => 'Prix', 'name' => 'prix', 'id'=>'prix', 'value' => $bien->prix])
                </div>
                <div class="row">
                    @include('shared.input', ['class' => 'col', 'label' => 'wilaya', 'name' => 'wilaya', 'id'=>'wilaya', 'value' => $bien->wilaya])
                </div>
                <div class="row">
                    @include('shared.input', ['class' => 'col', 'name' => 'adresse', 'id'=>'adresse','label' => 'Adresse', 'value' => $bien->adresse])
                </div>
                <div class="row">
                    <label for="transaction">Transaction</label>
                    <select name="transaction" id="transaction" class="form-select">
                        <option value="Vente" {{ $bien->transaction === 'Vente' ? 'selected' : '' }}>Vente</option>
                        <option value="Location" {{ $bien->transaction === 'Location' ? 'selected' : '' }}>Location</option>
                        <option value="Echange" {{ $bien->transaction === 'Echange' ? 'selected' : '' }}>Echange</option>
                    </select>
                </div>
                
                <div class="row">
                    <label for="id_proprietaire">Propriétaire</label>
                    <select name="id_proprietaire" id="id_proprietaire">
                        @foreach($proprietaires as $proprietaire)
                            <option value="{{ $proprietaire }}" {{ $bien->id_proprietaire == $proprietaire ? 'selected' : '' }}>
                                {{ $proprietaire }} <!-- Ici, vous pouvez afficher les détails du propriétaire -->
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="row">
                    <label for="agent_immobilier">Agent immobilier</label>
                    <select name="agent_immobilier" id="agent_immobilier" class="form-select">
                        @foreach($agents as $agent)
                            <option value="{{ $agent->id }}" {{ $bien->agent_immobilier == $agent->id ? 'selected' : '' }}>{{ $agent->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <label for="image">Image principale</label>
                    @if($bien->image)
                        <div>
                            <span style="margin-left: 70px;font-weight: bold;">{{ $bien->image }}</span>
                        </div>
                    @endif
                    <input type="file" name="image" id="image">
                    @error('image')
                        <div class="text text-danger">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="row">
                    <label for="imgs">Images multiples</label>
                    @if($bien->imgs)
                        @php
                            $imgCount = count(json_decode($bien->imgs, true));
                        @endphp
                        <div>
                            <span style="margin-left: 70px;font-weight: bold; ">{{ $imgCount }} image(s) actuellement insérée(s)</span>
                        </div>
                    @endif
                    <input type="file" name="imgs[]" id="imgs" multiple>
                    @error('imgs')
                        <div class="text text-danger">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="row">
                    @include('shared.input', ['type' => 'textarea', 'class' => 'col', 'label' => 'Description','name' => 'description', 'value' => $bien->description])
                </div>
                <div class="row" style="margin-left: 70px; margin-top: 20px;">
                    @include('shared.checkbox', ['name' => 'etat','label' => 'Disponibilité', 'value' => $bien->etat])
                </div>
            </div>
        </div>
        <div class="button-container">
            <button class="btn-connexion" id="btn-annuler">Annuler</button>
            <button class="btn-connexion">
                @if($bien->exists)
                    Modifier
                @else
                    Ajouter
                @endif
            </button>
        </div>
    </form>
</section>
@endsection
