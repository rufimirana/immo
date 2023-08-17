@extends('layout')
@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>

<div class="card uper">
  <h1 class="card-header">
    Nouveau article
  </h1>

  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif

      <form method="post" action="{{route('store')}}">
         @csrf
          <div class="form-group">
              <label for="nom">Nom de l'article</label>
              <input type="text" class="form-control" name="nom"/>
          </div>
           <div class="form-group">
              <label for="designation">Designation de l'article</label>
              <input type="text" class="form-control" name="designation"/>
          </div>
           <div class="form-group">
              <label for="designation_courte">Designation courte de l'article</label>
              <input type="text" class="form-control" name="designation_courte"/>
          </div>
          <div class="form-group">
           <select name="id_categorie" id="categorie">
                @foreach ($categorie as $categ)
                <option value="{{ $categ->id }}">{{ $categ->nom_categorie }}</option>
                @endforeach
            </select>
            </div>
          <div class="form-group">
           <select name="id_sous_categorie" id="sous_categorie">
                @foreach ($sous_categorie as $sous_categ)
                <option value="{{ $sous_categ->id }}">{{ $sous_categ->nom_sous_categorie }}</option>
                @endforeach
            </select>
            </div>
            <div class="form-group">
           <select name="id_departement" id="departement">
                @foreach ($departement as $depart)
                <option value="{{ $depart->id }}">{{ $depart->departement }}</option>
                @endforeach
            </select>
            </div>
            <div class="form-group">
           <select name="id_service" id="service">
                @foreach ($service as $serv)
                <option value="{{ $serv->id }}">{{ $serv->nom_service }}</option>
                @endforeach
            </select>
            </div>
        <h1>Détails</h1>
         <div class="form-group">
           <select name="id_modele" id="modele">
                @foreach ($modele as $mod)
                <option value="{{ $mod->id }}">{{ $mod->modele }}</option>
                @endforeach
            </select>
            </div>
            <div class="form-group">
           <select name="id_marque" id="marque">
                @foreach ($marque as $marq)
                <option value="{{ $marq->id }}">{{ $marq->marque }}</option>
                @endforeach
            </select>
            </div>
            <div class="form-group">
           <select name="id_couleur" id="couleur">
                @foreach ($couleur as $coul)
                <option value="{{ $coul->id }}">{{ $coul->couleur }}</option>
                @endforeach
            </select>
            </div>
            <div class="form-group">
           <select name="id_taille" id="taille">
                @foreach ($taille as $taille)
                <option value="{{ $taille->id }}">{{ $taille->taille }}</option>
                @endforeach
            </select>
            </div>
            <h1>Méthode amortissement</h1>
            <div class="form-group">
           <select name="id_methode_amortissement" id="methode">
                @foreach ($methode_amortissement as $methd)
                <option value="{{ $methd->id }}">{{ $methd->methode}}</option>
                @endforeach
            </select>
            </div>
             <div class="form-group">
              <label for="duree_annee">Durée année</label>
              <input type="number" class="form-control" name="duree_annee"/>
          </div>
          <button type="submit" class="btn btn-primary">Ajouter</button>
      </form>
  </div>
</div>
@endsection
