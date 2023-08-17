<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@600&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="{{ asset('css/style_formulaire_creation_article.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
<link href={{asset('css/font-awesome.min.css')}}>
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
@section('title', 'Liste inventaire')
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  @section('content')
 <div class="page-header">
    <H2>Liste de tous les inventaires</H2>
   </div>
   <div class="booking-form">
   <div class="card-body">
       <form method="post" action="{{route('liste_inventaire_entre_deux_dates')}}">
        @csrf
    	<div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <span class="form-label">Date 1</span>
                    <input class="form-control" type="date"name="date1" >
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <span class="form-label"> Date 2</span>
                    <input class="form-control" type="date" name="date2" >
                </div>
            </div>
              <div class="col-sm-4" style="padding-top:1.95em;">
                    <div class="form-btn">
                <button type="submit-btn" class="btn btn-primary">Afficher</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <span class="form-label">Categorie</span>
                    <select name="categorie_id" id="categorie_id" class="form-control">
                        <option value="">--</option>
                        <?php foreach ($liste_categorie as $categorie) { ?>
                            <option value="{{$categorie->id}}">{{$categorie->nom_categorie}}</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                {{-- <div class="form-group">
                    <span class="form-label"> Date 2</span>
                    <input class="form-control" type="date" name="date2" required>
                </div> --}}
            </div>
              {{-- <div class="col-sm-4" style="padding-top:1.95em;">
                    <div class="form-btn">
                <button type="submit-btn" class="btn btn-primary">Afficher</button>
                    </div>
                </div> --}}
            </div>
        </div>
        </form>
       <div class="row">
            <div class="col-md-12">
                <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 700px">
                  <table class="table table-light mb-0">
                    <thead style="background-color: DDF4FF;">
                      <tr class="text-uppercase text-success">
                            <tr>
                                <td>Id</td>
                                <td>Date de l'inventaire</td>
                                <td>Emplacement</td>
                                <td>Catégorie</td>
                                <td>Inventoriste</td>
                                <td>Détails</td>
                            </tr>
                      </tr>
                       </thead>
                    <tbody>
                        @foreach ($liste_inventaire as $inventaire)
                        <tr>
                            <td>{{$inventaire->id}}</td>
                            <td>{{$inventaire->date_inventaire}}</td>
                            <td>{{$inventaire->emplacement}}</td>
                            <td>{{$inventaire->nom_categorie}}</td>
                            <td>{{$inventaire->nom_gardien}}{{$inventaire->prenom}}</td>
                            <td><a href="{{route('details_inventaire',$inventaire->id)}}">Détails</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </div>
            </div>
       </div>
   </div>
   </div>
@endsection
