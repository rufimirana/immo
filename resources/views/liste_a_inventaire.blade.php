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
@section('title', 'Liste inventaire')
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  @section('content')
	<div class="booking-form">
        <div class="page-header">
    <H2>Inventaire à établir</H2>
   </div>
   <div class="row">
       <form method="post" action="{{route('liste_inventaire',['id_inventaire' => $id_inventaire, 'categorie' => $categorie, 'emplacement' => $emplacement])}}">
         @csrf
   <div class="col-md-12">

                <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: auto">
                  <table class="table table-light mb-0">
                    <thead style="background-color: DDF4FF;">
                      <tr class="text-uppercase text-success">
                            <tr>
                                <td>Id immo</td>
                                <td>Code barre digital</td>
                                <td>Designation</td>
                                <td>Emplacement</td>
                                <td>Etat d'usage</td>
                                <td>Check</td>
                            </tr>
                      </tr>
                       </thead>
                    <tbody>
                        @foreach ($liste_inventaire as $inventaire)
                        <tr>
                            <td><input type="text" style="border: none;outline:none;" value="{{$inventaire->id_immo}}" name="{{'id_immo'.$inventaire->id_immo}}"></td>
                            <td>{{ str_pad($inventaire->code_barre, 12, '0', STR_PAD_LEFT);}} </td>
                            <td>{{$inventaire->designation}}</td>
                            <td>{{$inventaire->emplacement}}</td>
                            <td> <div class="form-group">
                                <span class="form-label">Etat Usage</span>
                                <select class="form-control" name="{{'id_etat_usage'.$inventaire->id_immo}}" id="etat_usage">
                                    <option>Etat usage</option>
                                        @foreach ($etat_usage as $etat_use)

                                        <option value="{{ $etat_use->id }}">{{ $etat_use->etat }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                            </td>
                            <td>
                        <input type="checkbox" name="{{'etat'.$inventaire->id_immo}}" value="1" id="etat_id" {{ old('etat') === 1 ? 'checked' : '' }}>
                        <label for="etat_id">Vérifiée</label>
                            </td>
</div>
                        </tr>
 @endforeach
                    </tbody>
    </div>
   </div>
 <div class="form-btn">
          <button type="submit-btn" class="btn btn-primary">Valider cet inventaire</button>
</div>
            </div>

</form>
   </div>
    </div>
@endsection
