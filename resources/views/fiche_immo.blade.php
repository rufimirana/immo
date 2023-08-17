@extends('layout.template')
@section('title', 'Fiche immo')
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style_formulaire_creation_article.css') }}" />
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
<style>
    .uper{
        background-color: white
    }
    .page-header{
        font-family: 'Golos Text', sans-serif;
    }
    .card-body{
        background-color: white;
    }
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
     @media print {
   .uper{
        background-color: white
    }
    .page-header{
        font-family: 'Golos Text', sans-serif;
    }
    .card-body{
        background-color: white;
    }
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
}
</style>


  @section('content')
  <div class="uper" id="to_pdf">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
   <div class="booking-form">
   <div class="page-header">
    <H2>Fiche immobilisation</H2>
   </div>

   <div class="card">
   <div class="card-body">
        <div class="row">
            <div class="col-md-4">

        {!! DNS1D::getBarcodeHTML('$immo->barcode', 'C128',2,40) !!}
        {{str_pad($immo->code_barre, 12, '0', STR_PAD_LEFT)}}
            </div>
            <div class="col-md-6">

            </div>
            <div class="col-md-2">

            </div>
        </div>

    <div class="row">
        <div class="col-md-8">
        <div>
             <h3>Détails_immo</h3>
            <label><label class="decoration">Code_article:</label>{{$article[0]->code_article}}</label>
            <br/>
            <label><label class="decoration">Emplacement:</label>{{$immo->id_emplacement}} soit {{$emplacement_immo}}</label>
            <br/>
            <label><label class="decoration">Designation de l'article:</label>{{$article[0]->designation}}</label>
            <br/>
            <label><label class="decoration">Durée de vie de l'article:</label>{{$article[0]->duree_annee}}</label>
            <br/>
            <label><label class="decoration">Catégorie:</label>{{$categorie[0]->nom_categorie}}</label>
            <br/>
            <label><label class="decoration">Designation:</label>{{$details_reception[0]->remarque}}</label>
        </div>
        </div>

         <div class="col-md-4">
             <div class="form-btn">
                  <a href="javascript:void(0)"  id="export" onclick="printPDF()" class="btn btn-outline-success">Exporter PDF</a>
             </div>
             <h3>Détails date</h3>
             <br/>
             <label><label class="decoration">Date d'achat:</label>{{$details_reception[0]->date_facture}}</label>
             <br/>
             <label><label class="decoration">Date de réception:</label>{{$details_reception[0]->date_reception}}</label>
            <br/>
               <label><label class="decoration">Date d'amortissement:</label>{{$date_amortie}}</label>
         </div>
    </div>
    <br/>
    <br/>

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h6>Tableau d'amortissement</h6>
         <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 600px">
                  <table class="table table-light mb-0">
                    <thead style="background-color: DDF4FF;">
                      <tr class="text-uppercase text-success">
                            <tr>
                                <td>Année</td>
                                <td>Valeur Comptable Initiale</td>
                                <td>La charge d'amortissement</td>
                                <td>Valeur comptable finale</td>
                            </tr>
                      </tr>
                       </thead>
                    <tbody>

                        @for($i = 1; $i <= count($vnc); $i++)
                        <tr>
                            <td>{{$vnc[$i]['annee']}}</td>
                            <td>{{$vnc[$i]['valeur_comptable_initiale']}}</td>
                            <td>{{$vnc[$i]['annuite']}}</td>
                            <td>{{$vnc[$i]['valeur_comptable_finale']}}</td>
                        </tr>
                        @endfor
                    </tbody>
    </div>
        </div>
    <div class="col-md-2">

</div>
    </div>
    </div>

</div>
   </div>
</div>

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
