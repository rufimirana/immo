@extends('layout.template')
@section('title', 'Fiche facture')
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style_formulaire_creation_article.css') }}" />
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
<style>
    .page-header{
        font-family: 'Golos Text', sans-serif;
    }
    .decoration{
        text-decoration: underline;
        text-decoration-style: double;
        text-decoration-color: yellow;
    }
    .submit-btn{
        background-color: rgb(150, 223, 41);
    }
    #formulaire{
        background-color: white;
    }
</style>

@section('content')
<div class="uper" id="to_pdf">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
<h2 class="page-header border border-warning">Détails de la facture N° {{$fiche_facture->id}}</h2>
<div class="col-md-12 col-md-pull-7" id="formulaire">
  <div class="booking-form">
  <div class="row ">
      <div class="col-md-10">
          <div class="form-group">
    	<label for="date" class="form-label"><p class="decoration">Date:</p><span>{{ $fiche_facture->date}}</span></label>
      </div>
    </div>
      <div class="col-md-offset-6 col-md-2 ">
           <div class="form-btn">
               {{-- <form method="post" action="{{route('facture_to_pdf')}}"> --}}
          {{-- <button  id="export" onclick="printPDF()" class="btn btn-outline-success">Importer PDF</button> --}}
                  <a href="javascript:void(0)"  id="export" onclick="printPDF()" class="btn btn-outline-success">Exporter PDF</a>

        {{-- </form> --}}
      </div>
</div>
  </div>

  <div class="row">
      <div class="col-md-6">
<label for="reference_fournisseur"><p class="decoration">Référence Fournisseur:</p>{{ $fiche_facture->id_fournisseur }}</label>
  </div>
  <div class="col-md-6">
       <label for="fournisseur"><p class="decoration">Fournisseur:</p><span>{{ $fiche_facture->nom_fournisseur }}</span></label>
   </div>
  </div>
  <div class="row">
      <div class="col-md-6">
          <label for="consignataire"><p class="decoration">Id_consignataire:</p>{{ $fiche_facture->id__consignataire }} </label>
      </div>
<div class="col-md-6">
<label for="consignataire"><p class="decoration">Saisie par: </p>{{ $fiche_facture->nom_gardien }} {{ $fiche_facture->prenom }} </label>
</div>
  </div>
  <div class="row">
<div class="col-md-6">
    <label for="id_departement"><p class="decoration">Id_département:</p>{{ $fiche_facture->id_departement }}</label>
</div>
<div class="col-md-6">
    <label for="departement"><p class="decoration">Nom département:</p>{{ $fiche_facture->departement }}</label>
</div>
  </div>
  <div class="row">
      <div class="col-md-6">
           <label for="id_devise"><p class="decoration">Id_devise:</p>{{$fiche_facture->id_devise}}</label>
      </div>
<div class="col-md-6">
    <label for="devise"><p class="decoration">Devise:</p>{{ $fiche_facture->devise }}</label>
</div>
  </div>
  <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px">
       <table class="table table-light mb-0">
                    <thead style="background-color: DDF4FF;">
                      <tr class="text-uppercase text-success">
 <tr>
            <td>Détails facture</td>
          <td>Code article</td>
          <td>Description</td>
          <td>Quantité</td>
          <td>Prix unitaire</td>
          <td>Tva</td>
          <td>Total sans tva</td>
          <td>Total soumis tva</td>
        </tr>
    </thead>
    <tbody>
        @foreach($fiche_montant_facture as $fiche)
        <tr>
            <td>{{$fiche->numero_article_facture}}</td>
            <td>{{$fiche->id_article}}</td>
            <td>{{$fiche->description}}</td>
            <td>{{$fiche->quantite}}</td>
            <td>{{$fiche->prix_unitaire}}</td>
            <td>{{$fiche->tva}}</td>
            <td>{{$fiche->total_details}}</td>
            <td>{{$fiche->total_soumis_tva}}</td>
        </tr>
        @endforeach
    </tbody>
  </table>
<br/>
<div class="row">
    <i class="fst-italic">Grand total hors taxe:</i>
  <div class="col">{{$grand_total->montant_sans_tva}}{{$fiche_facture->description_devise}}</div>
  <i class="fst-italic">Grand total avec taxe:</i>
  <div class="col">{{$grand_total->montant_avec_tva}}{{$fiche_facture->description_devise}}</div>
</div>
  </div>
</div>
{{-- <script type="text/javascript">
  function print() {
        window.print();
    }
    function printDiv() {
            var divContents = document.getElementById("GFG").innerHTML;
            var a = window.open('', '', 'height=500, width=500');
            a.document.write('<html>');
            a.document.write('<body > <h1>Div contents are <br>');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }
</script> --}}
<script>
function printPDF() {
  window.print();
}
</script>
<div class="container">
    <div id="to_pdf">
    </div>
</div>
@endsection
