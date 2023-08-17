   @extends('../layout.template')
@section('title', 'Détails de réception')
   <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" ></script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style_formulaire_creation_article.css') }}" />
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
        <!-- Le css Bootstrap -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>

<style>
  .uper {
    margin-top: 40px;
  }
  .page-header{
        font-family: 'Golos Text', sans-serif;
    }

</style>
@section('content')


<style>
  .uper {
    margin-top: 40px;
  }
  .obligatoire:after {
content: "*";
color: red;
 margin-left: 10px;
}
</style>
<style>
    datalist option::before {
        display: none;
    }
</style>
<div class="card uper">
 <div class="page-header">
    <H2>Formulaire de récéption</H2>
   </div>

  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
 <div class="col-md-12 col-md-pull-7" id="formulaire">
						<div class="booking-form">

      <form method="post" action="{{route('recevoir',$facture->id)}}">
         @csrf
<div class="row">
    <div class="col-md-3">
         <div class="form-group">
              <label for="date"class="form-label">Date de réception<span class="obligatoire"></span></label>
              <input type="date" class="form-control" name="date_reception">
          </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleDataList" class="form-label">Fournisseur<span class="obligatoire"></span></label>
                <input type="text" name="id_fournisseur" class="form-control" list="datalist1" id="nom_founisseur" placeholder="Type to search...">
                <datalist id="datalist1">
        @foreach ($fournisseur as $fourni)
            <option data-value="{{ $fourni->id }}" value="{{ $fourni->nom_fournisseur }}"></option>
        @endforeach
               </datalist>
        </div>
        </div>
<div class="col-md-3">
    <div class="form-group">
 <label for="exampleDataList" class="form-label">Consignataire<span class="obligatoire"></span></label>
<input type="text" class="form-control" list="datalist2" id="id_consignataire" name="id__consignataire" placeholder="Type to search...">
<datalist id="datalist2" >
   @foreach ($consignataire as $consi)
                <option data-value="{{ $consi->id }}" value="{{ $consi->nom_gardien}}" ></option>
                @endforeach
</datalist>
          </div>
        </div>
        <div class="col-md-3">
  <div>
 <label for="exampleDataList" class="form-label">Emplacement<span class="obligatoire"></span></label>
<input type="text" name="id_emplacement" class="form-control" list="datalist3" id="id_emplacement" placeholder="Type to search...">
<datalist id="datalist3" >
     <select>
   @foreach ($emplacement as $place)
                <option data-value="{{ $place->id }}" value="{{ $place->emplacement}}"></option>
                @endforeach
     </select>
</datalist>
</div>
        </div>
        </div>
 <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 350px">
                  <table class="table table-light mb-0">
                    <thead style="background-color: DDF4FF;">
                      <tr class="text-uppercase text-success">
        <tr>
          <td>Numéro de l'article en facture</td>
          <td>Ref article</td>
          <td>Description</td>
          <td>Commandé</td>
          <td>Quantité reçue</td>
        </tr>
    </thead>
    <tbody>
        @foreach($recevoir as $dfact)
        <tr>
            <td>{{$dfact->numero_article_facture}}</td>
            <td>{{$dfact->id_article}}</td>
            <td>{{$dfact->description}}</td>
            <td>{{$dfact->commanded}}</td>
            <td>{{$dfact->quantite}}</td>
        </tr>
        @endforeach
    </tbody>
 </table>
</div>
<button type="submit" class="btn btn-primary">Recevoir</button>
      </form>
@endsection
