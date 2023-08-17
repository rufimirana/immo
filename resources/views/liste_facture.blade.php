<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@600&display=swap" rel="stylesheet">
@extends('layout.template')
@section('title', 'Liste facture')
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

</style>
@section('content')
 <div class="page-header">
    <H2>Liste des Factures</H2>
 </div>
   <?php if(isset($error_reception)){ ?>
       <div class="alert alert-danger" role="alert">
            {{ $error_reception }}
</div>
    <?php  } ?>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  <form method="get" action="{{route('liste_facture_entre_date')}}">
  <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <span class="form-label">Date 1</span>
                    <input class="form-control" type="date"name="date1">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <span class="form-label"> Date 2</span>
                    <input class="form-control" type="date" name="date2">
                </div>
            </div>
              <div class="col-sm-4">
                    <div class="form-btn"  style="padding-top:1.55em;">
                <button type="submit-btn" class="btn btn-primary">Afficher</button>
                    </div>
              </div>
        </div>
        </form>
 <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 700px">
       <table class="table table-light mb-0">
                    <thead style="background-color: F5F4F4;">
                      <tr class="text-uppercase text-success">

        <tr>
          <td>Référence facture</td>
          <td>Date</td>
          <td>Fournisseur</td>
          <td>Nom consignataire</td>
          <td>Prénom</td>
          <td>Département</td>
          <td>Devise</td>
          <td>Détails</td>
          <td>Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($liste_facture as $fact)
        <tr>
            <td>{{$fact->id}}</td>
            <td>{{$fact->date}}</td>
            <td>{{$fact->nom_fournisseur}}</td>
            <td>{{$fact->nom_gardien}}</td>
            <td>{{$fact->prenom}}</td>
            <td>{{$fact->departement}}</td>
            <td>{{$fact->devise}}</td>
            <td><a href="{{ route('fiche_facture',$fact->id) }}"><button type="button" class="btn btn-warning">Détails facture</button></a></td>
            <td>
                <a href="{{ route('reception_info',$fact->id) }}"><button type="button" class="btn btn-success">Recevoir facture</button></a></td>
        </tr>
        @endforeach
    </tbody>
       </table>
        <div class="row">
                    <div class="col-md-5"></div>
                   <div id="pagination" class="col-md-5">
                        {{ $liste_facture->links('pagination::bootstrap-4') }}
                   </div>
                  </div>
<div>
@endsection

