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
@section('title', 'Liste immobilisations disparues')
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  @section('content')
<div class="booking-form">
    <div class="page-header">
    <H2>Les immobilisations disparues</H2>
   </div>
   <div class="card-body">
       <div class="row">
           <div class="col-md-3">
            <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
            <div class="card-header">Total des immobilisations disparues</div>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text">{{count($disparues)}}</p>
            </div>
            </div>
        </div>
            <div class="col-md-12">
                <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: auto">
                  <table class="table table-light mb-0">
                    <thead style="background-color: DDF4FF;">
                      <tr class="text-uppercase text-success">
                            <tr>
                                 <td>Date d'inventaire</td>
                                <td>Code barre digital</td>
                                <td>Emplacement</td>
                                <td>Catégorie</td>
                            </tr>
                      </tr>
                       </thead>
                    <tbody>
                        @foreach ($disparues as $disparue)
                        <tr>

                            <td>{{$disparue->date_inventaire}}</td>
                            <td>{{str_pad($disparue->code_barre, 12, '0', STR_PAD_LEFT);}}</td>
                            <td>{{$disparue->emplacement}}</td>
                            <td>{{$disparue->nom_categorie}}</td>
                        </tr>
 @endforeach
                    </tbody>
    </div>
            </div>
       </div>
   </div>
</div>
  @endsection
