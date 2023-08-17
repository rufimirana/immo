<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@600&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="{{ asset('css/style_formulaire_creation_article.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
<link href={{asset('css/font-awesome.min.css')}}>
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
font-family: 'Nunito', sans-serif;}
</style>

@extends('layout.template')
@section('title', 'Liste des immobilisations')
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  @section('content')


  <div class="page-header">
    <H2>Liste des immobilisations</H2>
  </div>
  
    <div class="row">
           <div class="col-md-1">
           </div>
            <div class="col-md-3">
                <form method="get" action="{{route('liste_immo_by_code')}}">
           <div class="form-group">
              <label for="designation">Code barre</span></label>
              <input type="text" class="form-control" name="code_barre"/>
          </div>
           <button type="submit" class="btn btn-light">Afficher</button>
          </div>
        </form>
  </div>
   <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 700px">
                  <table class="table table-light mb-0">
                    <thead style="background-color: DDF4FF;">
                      <tr class="text-uppercase text-success">
                            <tr>
                                <td>Id</td>
                                <td>Barre code digital</td>
                                <td>Barre code physique</td>
                                <td>Emplacement</td>
                                <td>Détails</td>
                                <td>Transférer</td>
                            </tr>
                      </tr>
                       </thead>
                    <tbody>
                        @foreach ($immo as $list_immo)
                            <tr>
                                <td> {{$list_immo->id}}</td>
                                <td>{{str_pad($list_immo->code_barre, 12, '0', STR_PAD_LEFT)}}</td>
                                <td >
                                    {!! DNS1D::getBarcodeHTML('$list_immo->barcode', 'C128',2,40) !!}
                                </td>
                                <td>{{$list_immo->id_emplacement}}</td>
                                <td><a href="{{route('fiche_immo',[$list_immo->id])}}"><button type="button" class="btn btn-warning">Détails immo</button></a></td>
                                <td><a href="{{route('transferer_immo',[$list_immo->id])}}"><button type="button" class="btn btn-success">Transférer</button></a></td>

                            </tr>
                        @endforeach
                    </tbody>
                  </table>
<div class="row">
                    <div class="col-md-5"></div>
                   <div id="pagination" class="col-md-5">
                       {{ $immo->links('pagination::bootstrap-4') }}
                   </div>
                  </div>
@endsection
