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
@section('title', 'Liste immobilisations amorties')
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  @section('content')
<div class="booking-form">
    <div class="page-header">
    <H2>Les immobilisations amorties</H2>
   </div>
   <div class="card-body">
       <div class="row">
           <div class="col-md-3">
            <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
            <div class="card-header">Total des immobilisations amorties</div>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text">{{count($amortis)}}</p>
            </div>
            </div>
        </div>
            <div class="col-md-12">
                <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: auto">
                  <table class="table table-light mb-0">
                    <thead style="background-color: DDF4FF;">
                      <tr class="text-uppercase text-success">
                            <tr>
                                <td>Code barre digital</td>
                                <td>Durée de vie</td>
                                <td>Date de réception</td>
                                <td>Date d'amortissement</td>
                                <td>Céder en cession</td>
                            </tr>
                      </tr>
                       </thead>
                    <tbody>
                        @foreach ($amortis as $amortie)
                        <tr>

                            <td>{{str_pad($amortie->code_barre, 12, '0', STR_PAD_LEFT);}}</td>
                            <td>{{$amortie->duree_vie}}</td>
                            <td>{{$amortie->date_reception}}</td>
                            <td>{{$amortie->date_amortie}}</td>
                            <td><a href="{{route('formulaire_cession',$amortie->id)}}">Cession</a></td>
                        </tr>
 @endforeach
                    </tbody>
    </div>
            </div>
       </div>
   </div>
</div>
  @endsection
