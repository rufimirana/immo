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
@section('title', 'Formulaire de cession')
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  @section('content')
  <div class="booking-form">
        <div class="page-header">
    <H2>Formulaire de cession</H2>
   </div>
        <div class="card-body">
            <form method="post" action="{{route('ceder_immo',$id_immo)}}">
                @csrf
            <div class="row">
                 <div class="col-md-3">
                <div class="form-group">
                    <span class="form-label">Date de la cession<span class="obligatoire"></span></span>
                    <input class="form-control" type="date"name="date_cession" required>
                </div>
            </div>
            <div class="col-md-3">
                    <label for="exampleDataList" class="form-label">Devise<span class="obligatoire"></span></label>
                    <input type="text" name="id_devise" class="form-control" list="datalist4" id="id_devise" placeholder="Code">
                    <datalist id="datalist4" >
                        <select>
                    @foreach ($devise as $devis)
                                    <option data-value="{{ $devis->id }}" value="{{ $devis->devise}}"></option>
                @endforeach
                </select>
            </datalist>
            </div>
             <div class="col-md-3">
                    <label for="exampleDataList" class="form-label">Type de cession<span class="obligatoire"></span></label>
                    <input type="text" name="id_type" class="form-control" list="datalist5" id="id_type_cession" placeholder="Type de cession">
                    <datalist id="datalist5" >
                        <select>
                    @foreach ($type_cession as $cession)
                                    <option data-value="{{ $cession->id }}" value="{{ $cession->type_cession}}"></option>
                @endforeach
                </select>
            </datalist>
            </div>
            <div class="col-md-3">
                 <label for="exampleDataList" class="form-label">Prix final<span class="obligatoire"></span></label>
                <input type="number" class="form-control" id="prix_final" name="prix_final" placeholder="Prix final">
            </div>
                </div>
                <div class="row">
                    <div class="form-btn">
                        <button type="submit-btn" class="btn btn-primary">Céder en cession</button>
                    </div>
                </div>
                </form>
         </div>
  </div>
  @endsection
