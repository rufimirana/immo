<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style_formulaire_creation_article.css') }}" />
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" ></script>
<!-- Le css Bootstrap -->
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<style>
 .obligatoire:after {
content: "*";
color: red;
 margin-left: 10px;
}
 .card-body{
        background-color: white;
    }
      .page-header{
        font-family: 'Golos Text', sans-serif;
    }
</style>
@extends('layout.template')
@section('title', 'Taux amortissement de la CEM')
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  @section('content')
  <div class="page-header">
    <H2>Liste taux d'amortissement</H2>
   </div>
  <div class="row">

            <div class="col-md-12">
 <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 700px">
                  <table class="table table-light mb-0">
                    <thead style="background-color: DDF4FF;">
                      <tr class="text-uppercase text-success">
                            <tr>
                                <td>Code catégorie</td>
                                <td>Nom catégorie</td>
                                <td>Durée de vie</td>
                                <td>Taux d'amortissement</td>
                            </tr>
                      </tr>
                       </thead>
                    <tbody>
                        @foreach ($liste_categorie as $categorie)
                            <tr>
                                <td> {{$categorie->id}}</td>
                                <td>{{$categorie->nom_categorie}}</td>
                                <td>{{$categorie->duree_vie}}</td>
                                <td>{{$categorie->taux_amortissement}} %</td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
 </div>
            </div>
  </div>
  @endsection
