<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@600&display=swap" rel="stylesheet">
<link href={{asset('css/font-awesome.min.css')}}>
@extends('layout.template')
@section('title', 'Liste récéption')
<style>
    .page-header{
        font-family: 'Golos Text', sans-serif;
    }
    .table{
        background-color: white;
    }
  .uper {
    margin-top: 0px;
    background-color: white;
font-family: 'Nunito', sans-serif;

}
#table_reception{
    font-size: 10px;
}
</style>
@section('content')
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  <div class="page-header">
    <H2>Liste des récéptions</H2>
 <?php if(isset($error_immo)){ ?>
       <div class="alert alert-danger" role="alert">
            {{ $error_immo }}
</div>
    <?php  } ?>
  </div>
  <div class="row">
           <div class="col-md-1">
           </div>
            <div class="col-md-3">
                <form method="get" action="{{route('liste_reception_by_facture')}}">
           <div class="form-group">
              <label for="designation">Référence de la facture<span class="obligatoire"></span></label>
              <input type="text" class="form-control" name="facture_reception"/>
          </div>
           <button type="submit" class="btn btn-light">Afficher</button>
          </div>
        </form>
  </div>
     <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: auto" id="table_reception">
                  <table class="table table-light mb-0">
                    <thead style="background-color: DDF4FF;">
                      <tr class="text-uppercase text-success">
                       <tr>
          <td>Code récéption</td>
          <td>Date de récéption</td>
          <td>Référence facture</td>
          <td>Fournisseur</td>
          <td>Consignataire</td>
          <td>Code article</td>
          <td>Reçu</td>
          <td>Restant</td>
          <td>Remarque</td>
          <td>Action</td>
        </tr>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($liste_reception as $reception)
        <tr>
            <td>{{$reception->code_reception}}</td>
            <td>{{$reception->date_reception}}</td>
            <td>{{$reception->facture_reception}}</td>
            <td>{{$reception->fournisseur}}</td>
            <td>{{$reception->nom_consignataire}}{{$reception->prenom_consignataire}}</td>
            <td>{{$reception->code_article}}</td>
            <td>{{$reception->recu}}</td>
            <td>{{$reception->restant}}</td>
            <td>{{$reception->remarque}}</td>
            <td><form method="POST" action="{{route('generer_barcode',$reception->id_details_reception)}}">
                @csrf
                  <button type="submit" class="btn btn-dark" >Générer code barre</button>
                </form>
            </td>
        </tr>
        @endforeach
                    </tbody>
                  </table>
                  <div class="row">
                    <div class="col-md-5"></div>
                   <div id="pagination" class="col-md-5">
                       {{ $liste_reception->links('pagination::bootstrap-4') }}
                   </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<div>
@endsection
