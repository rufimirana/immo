	<!DOCTYPE html>
<html lang="en">

<head>
    <title>Création article</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style_formulaire_creation_article.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
@extends('layout.template')
@section('content')
<style>
     .page-header{
        font-family: 'Golos Text', sans-serif;
    }
  .uper {
    margin-top: 10px;
  }
  #formulaire{
      font-family: 'Montserrat', sans-serif;
      display: inline-block;
	color: #3e485c;
	font-weight: 700;
	margin-bottom: 6px;
	margin-left: 7px;

  }
    .obligatoire:after {
content: "*";
color: red;
 margin-left: 10px;
}
</style>

<div class="card uper">
   <div class="page-header">
    <H2>Création article</H2>
   </div>
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
    <div class="col-md-12 col-md-pull-7" id="formulaire">
						<div class="booking-form">
      <form method="post" action="{{route('store')}}">
         @csrf
         <div class=row>
             <div class="col-sm-4">
              <div class="form-group">
              <label for="nom">Nom de l'article<span class="obligatoire"></span></label>
              <input type="text" class="form-control" name="nom"/>
              </div>
          </div>
          <div class="col-sm-4">
           <div class="form-group">
              <label for="designation">Designation de l'article<span class="obligatoire"></span></label>
              <input type="text" class="form-control" name="designation"/>
          </div>
          </div>
          <div class="col-sm-4">
           <div class="form-group">
              <label for="designation_courte">Designation courte de l'article<span class="obligatoire"></span></label>
              <input type="text" class="form-control" name="designation_courte"/>
          </div>
          </div>
         </div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        <span class="form-label">Catégorie<span class="obligatoire"></span></span>
           <select class="form-control" name="id_categorie" id="categorie">
               <option>Catégorie</option>
                @foreach ($categorie as $categ)

                <option value="{{ $categ->id }}">{{ $categ->nom_categorie }}</option>
                @endforeach
            </select>
            <span class="select-arrow"></span>
            </div>
            </div>
            <div class="col-md-4">
          <div class="form-group">
              <span class="form-label">Sous catégorie<span class="obligatoire"></span></span>
           <select class="form-control" name="id_sous_categorie" id="sous_categorie">
               <option>Sous catégorie</option>
                @foreach ($sous_categorie as $sous_categ)

                <option value="{{ $sous_categ->id }}">{{ $sous_categ->nom_sous_categorie }}</option>
                @endforeach
            </select>
            <span class="select-arrow"></span>
            </div>
            </div>
        </div>
<div class="row">
    <div class="col-md-4">
         <div class="form-group">
          <span class="form-label">Département<span class="obligatoire"></span></span>
           <select class="form-control" name="id_departement" id="departement">
               <option>Département</option>
                @foreach ($departement as $depart)

                <option value="{{ $depart->id }}">{{ $depart->departement }}</option>
                @endforeach
            </select>
            <span class="select-arrow"></span>
            </div>
    </div>

            <div class="col-md-4">
                 <div class="form-group">
                 <span class="form-label">Service<span class="obligatoire"></span></span>
           <select class="form-control" name="id_service" id="service">
               <option>Service</option>
                @foreach ($service as $serv)

                <option value="{{ $serv->id }}">{{ $serv->nom_service }}</option>
                @endforeach
            </select>
            <span class="select-arrow"></span>
            </div>
        </div>

</div>

        <h3 class="page-header">Détails</h3>
        <div class="row">
             <div class="col-md-3">
             <div class="form-group">
           <select class="form-control" name="id_modele" id="modele">
               <option>Modèle</option>
                @foreach ($modele as $mod)
                <option value="{{ $mod->id }}">{{ $mod->modele }}</option>
                @endforeach
            </select>
            <span class="select-arrow"></span>
            </div>
             </div>
             <div class="col-md-3">
            <div class="form-group">
           <select class="form-control" name="id_marque" id="marque">
               <option>Marque</option>
                @foreach ($marque as $marq)
                <option value="{{ $marq->id }}">{{ $marq->marque }}</option>
                @endforeach
            </select>
            <span class="select-arrow"></span>
            </div>
             </div>
             <div class="col-md-3">
            <div class="form-group">
           <select class="form-control" name="id_couleur" id="couleur">
               <option>Couleur</option>
                @foreach ($couleur as $coul)
                <option value="{{ $coul->id }}">{{ $coul->couleur }}</option>
                @endforeach
            </select>
            <span class="select-arrow"></span>
            </div>
             </div>
             <div class="col-md-3">
            <div class="form-group">
           <select class="form-control" name="id_taille" id="taille">
               <option>Taille</option>
                @foreach ($taille as $taille)
                <option value="{{ $taille->id }}">{{ $taille->taille }}</option>
                @endforeach
            </select>
            <span class="select-arrow"></span>
            </div>
             </div>
        </div>

            <h3 class="page-header">Méthode amortissement</h3>
            <div class="row">
                <div class="col-md-3">
                 <div class="form-group">
                      <span class="form-label">Méthode amortissement<span class="obligatoire"></span></span>
           <select class="form-control" name="id_methode_amortissement" id="methode">
               <option>Méthode amortissement</option>
                @foreach ($methode_amortissement as $methd)
                <option value="{{ $methd->id }}">{{ $methd->methode}}</option>
                @endforeach
            </select>
            <span class="select-arrow"></span>
            </div>
                </div>
                <div class="col-md-3">
              <div class="form-group">
              <label for="duree_annee">Durée année<span class="obligatoire"></span></label>
              <input type="number" class="form-control" name="duree_annee"/>
              </div>
          </div>
        </div>

<div class="form-btn">
          <button type="submit-btn" class="btn btn-primary">Ajouter</button>
</div>
      </form>
  </div>
</div>
</div>
@endsection
