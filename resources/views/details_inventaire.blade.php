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
    <H2>Détails de l'inventaire</H2>
   </div>
   <div class="card-body">
       {{-- <div class="row">
           <div class="col-md-3">
            <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
            <div class="card-header">Nombre d'immos à établir en inventaire'</div>
            <div class="card-body">
                <p class="card-text">{{$nombre_total[0]->count_total}}</p>
            </div>
            </div>
        </div>
       </div>
       <div class="col-md-1">
       </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
            <div class="card-header">Nombre d'immos présentes'</div>
            <div class="card-body">
                <p class="card-text">{{$nombre_ok[0]->count_ok}}</p>
            </div>
            </div>
        </div>
       </div>
       <div class="col-md-1">
       </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
            <div class="card-header">Nombre d'immos absentes</div>
            <div class="card-body">
                <p class="card-text">{{$nombre_disparue[0]->count_disparue}}</p>
            </div>
            </div>
        </div>
       </div> --}}

   </div>
   <div class="row">
        {{-- <strong>Emplacement: {{$emplacement}}</strong>
        <strong>Catégorie:{{$categorie}}</strong> --}}
   </div>
   <div class="row">
 <div class="col-md-12">
                <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 700px">
                  <table class="table table-light mb-0">
                    <thead style="background-color: DDF4FF;">
                      <tr class="text-uppercase text-success">
                            <tr>
                                <td>Id_immo</td>
                                <td>Code barre</td>
                                <td>Designation</td>
                                <td>Etat de l'immobilisation</td>
                                <td>Etat</td>
                            </tr>
                      </tr>
                       </thead>
                    <tbody>
                        @foreach ($details_inventaire as $details)
                        <tr>
                            <td>{{$details->id_immo}}</td>
                            <td>{{str_pad($details->code_barre, 12, '0', STR_PAD_LEFT);}}</td>
                            <td>{{$details->designation}}</td>
                            <td>{{$details->etat_usage}}</td>
                            <td>
                            @if($details->etat == 1)
                                Ok
                            @else
                                Absent
                            @endif
                            <td>

</td></td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </div>
            </div>
   </div>
 </div>
  @endsection
