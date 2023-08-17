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
@section('title', 'Liste immobilisations vendues')
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  @section('content')
<div class="booking-form">
    <div class="page-header">
    <H2>Les immobilisations vendues</H2>
   </div>
   <div class="card-body">
       <div class="row">
           <div class="col-md-3">
            <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
            <div class="card-header">Total des immobilisations vendues</div>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text">{{count($liste_cession)}}</p>
            </div>
            </div>
        </div>
            <div class="col-md-12">
                <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: auto">
                  <table class="table table-light mb-0">
                    <thead style="background-color: DDF4FF;">
                      <tr class="text-uppercase text-success">
                            <tr>
                                 <td>Date de cession</td>
                                <td>Code barre digital</td>
                               <td>Type de cession</td>
                               <td>Prix final</td>
                            </tr>
                      </tr>
                       </thead>
                    <tbody>
                        @foreach ($liste_cession as $cession)
                        <tr>

                            <td>{{$cession->date_cession}}</td>
                            <td>
                                {{ str_pad($cession->code_barre, 12, '0', STR_PAD_LEFT);}}
                            </td>
                            <td>{{$cession->type_cession}}</td>
                            <td>{{$cession->prix_final}}</td>
                        </tr>
 @endforeach
                    </tbody>
                  </table>
                   <div class="row">
                    <div class="col-md-5"></div>
                   <div id="pagination" class="col-md-5">
                       {{ $liste_cession->links('pagination::bootstrap-4') }}
                   </div>
                  </div>
    </div>
            </div>
       </div>
   </div>
</div>
  @endsection
