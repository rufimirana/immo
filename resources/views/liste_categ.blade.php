<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@600&display=swap" rel="stylesheet">
@extends('layout.template')
@section('title', 'Liste des articles par catégorie')

<style>
    .page-header{
        font-family: 'Golos Text', sans-serif;
    }
    .table{
        background-color: white;
    }
  .uper {
    margin-top: 0px;
font-family: 'Nunito', sans-serif;

}

</style>
@section('content')
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
   <div class="page-header">
    <H2>Liste des articles par catégorie </H2>
   </div>
         <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 700px">
                  <table class="table table-light mb-0">
                    <thead style="background-color: DDF4FF;">
                      <tr class="text-uppercase text-success">
                       <tr>
          <td>Code article</td>
          <td>Nom</td>
          <td>Designation</td>
          <td>Designation courte</td>
          <td>Categorie</td>
          <td>Sous catégorie</td>
          {{-- <td>Département</td>
          <td>Service</td>
          <td>Couleur</td>
          <td>Marque</td>
          <td>Modèle</td>
          <td>Taille</td>
          <td>Méthode d'amortissement</td>
          <td>Durée année</td> --}}
          <td>Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($liste_categ as $artcl)
        <tr>
               <td>{{$artcl->code_article}}</td>
            <td>{{$artcl->nom_article}}</td>
            <td>{{$artcl->designation_article}}</td>
            <td>{{$artcl->designation_courte_article}}</td>
            <td>{{$artcl->categorie_article}}</td>
            <td>{{$artcl->sous_categorie_article}}</td>
            {{-- <td>{{$artcl->departement_article}}</td>
            <td>{{$artcl->service_article}}</td>
            <td>{{$artcl->couleur_article}}</td>
            <td>{{$artcl->marque_article}}</td>
            <td>{{$artcl->modele_article}}</td>
            <td>{{$artcl->taille_article}}</td>
            <td>{{$artcl->amortissement_article}}</td>
            <td>{{$artcl->annee_amortie}}</td> --}}
            <td><button type="button" class="btn btn-warning">Fiche</button></td>
        </tr>
        @endforeach
    </tbody>
<div>
@endsection
