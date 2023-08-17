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

      <form method="get" action="{{route('search')}}">
         @csrf
         <div class="form-group">
              <label for="code_article">Code Article</label>
              <input type="number" class="form-control" name="code_article"/>
          </div>
          <div class="form-group">
              <label for="nom_article">Nom Article</label>
              <input type="text" class="form-control" name="nom_article"/>
          </div>
          <div class="form-group">
              <label for="designation_article">Designation de l'article</label>
              <input type="text" class="form-control" name="designation_article"/>
          </div>
           <div class="form-group">
              <label for="designation_courte_article">Designation courte de l'article</label>
              <input type="text" class="form-control" name="designation_courte_article"/>
          </div>
          {{--


          <div class="form-group">Catégorie
           <input type="text" name="categorie_article" id="categorie" >
            </div>
          <div class="form-group">Sous-catégorie Article
           <input name="sous_categorie_article" id="sous_categorie">
            </div>
            <div class="form-group">Département concerné
           <input type="text" name="departement_article" id="departement">

            </div>
            <div class="form-group">Service concernée
           <input type="text" name="service_article" id="service">
                            </div>
        <h1>Détails</h1>
         <div class="form-group">Modèle de l'article
           <input type="text" name="modele_article" id="modele">
                            </div>
            <div class="form-group">Marque choisie
           <input type="marque_article" name="marque_article" id="marque">
                           </div>
            <div class="form-group">Couleur de l'article
           <input type="text" name="couleur_article" id="couleur">
                          </div>
            <div class="form-group">Taille de l'article
           <input type="text" name="taille_article" id="taille">
            </div>
            <h1>Méthode amortissement</h1>
            <div class="form-group">Armortissement
           <input type="text" name="amortissement_article" id="methode">
                          </div>
             <div class="form-group">Fournisseur --}}

              {{-- <input type="text" class="form-control" name="fournisseur"/> --}}
          </div>
          <button type="submit" class="btn btn-primary">Rechercher</button>
      </form>
  </div>
</div>
@endsection
