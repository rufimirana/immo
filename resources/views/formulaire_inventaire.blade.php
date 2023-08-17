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
@section('title', 'Formulaire inventaire')
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  @section('content')

	<div class="booking-form">
        <div class="page-header">
    <H2>Formulaire d'inventaire</H2>
   </div>
        <?php if(isset($error)){ ?>
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
        <?php  } ?>

        <?php if(isset($error_existant)){ ?>
        <div class="alert alert-danger" role="alert">
            {{ $error_existant }}
        </div>
                <br/>

        <?php  } ?>

        <div class="card-body">

   <form method="post" action="{{route('store_inventaire')}}">
                         @csrf
        <div class="row">
             <div class="col-sm-4">
                <div class="form-group">
                    <span class="form-label">Date de l'inventaire<span class="obligatoire"></span></span>
                    <input class="form-control" type="date"name="date_inventaire" required>
                </div>
            </div>
            <div class="col-sm-4">
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
            <div class="col-sm-4">
         <div class="form-group">
          <span class="form-label">Emplacement<span class="obligatoire"></span></span>
           <select class="form-control" name="id_emplacement" id="emplacement">
               <option>Emplacement</option>
                @foreach ($emplacement as $place)
                <option value="{{ $place->id }}">{{ $place->emplacement }}</option>
                @endforeach
            </select>
            <span class="select-arrow"></span>
            </div>
    </div>
        </div>
        <div class="row">
            <div class="col-md-6">
<div class="form-group">
        <label for="exampleDataList" class="form-label" >Responsable emplacement<span class="obligatoire"></span></label>
        <input type="text" class="form-control" list="datalist2" id="id_consignataire" name="id_consignataire" placeholder="Consignataire">
        <datalist id="datalist2" >
        @foreach ($consignataire as $consi)
                        <option data-value="{{ $consi->id }}" value="{{ $consi->nom_gardien}}" ></option>
                        @endforeach
        </datalist>
          </div>
            </div>
 <div class="col-md-6">
<div class="form-group">
        <label for="exampleDataList" class="form-label" >Inventoriste<span class="obligatoire"></span></label>
        <input type="text" class="form-control" list="datalist2" id="id_gardien" name="id_gardien" placeholder="Inventoriste">
        <datalist id="datalist2" >
        @foreach ($gardien as $gardien)
                        <option data-value="{{ $gardien->id }}" value="{{ $gardien->nom_gardien}}" ></option>
                        @endforeach
        </datalist>
          </div>
            </div>
        </div>
        </div>
        <div class="row">
<div class="form-btn" style="margin-left: 35px;">
          <button type="submit-btn" class="btn btn-primary">Etablir cet inventaire</button>
</div>
</form>
        </div>
        </div>
    </div>
    </div>
  @endsection
