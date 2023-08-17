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
@section('title', 'Liste all')
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  @section('content')
  <div class="booking-form">
<div class="page-header">

    <H2>Stock de toutes immobilisations</H2>
   </div>
   <div class="card-body">
       <form method="get" action={{route('liste_stock_by')}}>
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
            <div class="card-header">Total de toutes les immobilisations</div>
            <div class="card-body">
                <h5 class="card-title">Toutes les immobilisations</h5>
                <p class="card-text">{{$nombre_all_immo[0]->count}}</p>
            </div>
            </div>
        </div>

         <div class="col-md-3">
         <label for="exampleDataList" class="form-label">Emplacement<span class="obligatoire"></span></label>
            <input type="text" name="id_emplacement" class="form-control" list="datalist3" id="id_emplacement" placeholder="Code">
            <datalist id="datalist3" >
                <select>
            @foreach ($emplacement as $place)
             <option value="{{ $place->id }}">{{ $place->emplacement}}</option>
             @endforeach
                </select>
            </datalist>
     </div>
        <div class="col-md-3">
            <label for="exampleDataList" class="form-label">Article<span class="obligatoire"></span></label>
            <input type="text" class="form-control" list="datalist5" id="id_article-1" name="id_article" placeholder="Article">
            <span class="select-arrow"></span>
<datalist id="datalist5" >
    <select>
   @foreach ($article as $artcl)
                <option value="{{ $artcl->code_article }}" >{{ $artcl->designation}}</option>
                @endforeach
                </select>
</datalist>
        </div>
        <div class="col-md-3">
                    <div class="form-btn">
                <button type="submit-btn" class="btn btn-primary">Afficher</button>
                    </div>
        </div>
        </form>
   </div>
</div>
    <div class="row">

            <div class="col-md-12">
                <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: auto">
                  <table class="table table-light mb-0">
                    <thead style="background-color: DDF4FF;">
                      <tr class="text-uppercase text-success">
                            <tr>
                                <td>Code article</td>
                                <td>Designation</td>
                                <td>Nombre au total</td>
                            </tr>
                      </tr>
                       </thead>
                    <tbody>
                        @foreach ($liste_stock_all as $all)
                        <tr>

                            <td>{{$all->id_article}}</td>
                            <td>{{$all->designation}}</td>
                            <td>{{$all->count}}</td>
                        </tr>
 @endforeach
                    </tbody>
    </div>
            </div>
    </div>
   </div>
</div>
  @endsection
