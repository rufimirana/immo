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
@section('title', 'Transférer une immo')
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  @section('content')
  <div class="page-header">
    <H2>Transférer immo {{$id_immo}}</H2>
   </div>
<div class="card-body">

<div class="col-md-12 col-md-pull-7" id="formulaire">
<div class="booking-form">
     <form method="post" action="{{route('update_immo',$id_immo)}}">
        @csrf
        <div class="row">
        <div class="col-sm-3">
          <div class="form-group">
              <label for="date" class="form-label">Date de transfert<span class="obligatoire"></span></label>
              <input type="date" class="form-control" name="date_transfert"/>
        </div>
        </div>
            <div class="col-md-3">
         <label for="exampleDataList" class="form-label">Nouveau emplacement<span class="obligatoire"></span></label>
            <input type="text" name="id_emplacement" class="form-control" list="datalist3" id="id_emplacement" placeholder="Code">
            <datalist id="datalist3" >
                <select>
            @foreach ($emplacement as $place)
             <option data-value="{{ $place->id }}" value="{{ $place->emplacement}}"></option>
             @endforeach
                </select>
            </datalist>
     </div>
     <div class="col-md-3">
       <div class="form-group">
        <label for="exampleDataList" class="form-label" >Saisie par:<span class="obligatoire"></span></label>
        <input type="text" class="form-control" list="datalist2" id="id_consignataire" name="id__consignataire" placeholder="Consignataire">
        <datalist id="datalist2" >
        @foreach ($consignataire as $consi)
                        <option data-value="{{ $consi->id }}" value="{{ $consi->nom_gardien}}" ></option>
                        @endforeach
        </datalist>
          </div>
     </div>
        </div>
        <div class="row">
              <label class="form-label">Remarque</label>
<input type="text" class="form-control" id="remarque" name="remarque" placeholder="Remarque"></p>
        </div>
        <div class="row">
            <div class="form-btn">
 <button type="submit-btn" class="btn btn-primary">Tranférer immo</button>
</div>
        </div>

      </form>
  </div>

</div>

</div>
  </div>
@endsection
