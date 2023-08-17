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
@section('title', 'Liste transfert')
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  @section('content')
 <div class="page-header">
    <H2>Liste transfert</H2>
   </div>
<div class="card-body">
    <form method="get" action="{{route('liste_transfert_entre_date')}}">
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
        <div class="row">
                <div class="col-md-3">
         <label for="exampleDataList" class="form-label">Emplacement</label>
            <input type="text" name="id_emplacement" class="form-control" list="datalist3" id="id_emplacement" placeholder="Code emplacement">
            <datalist id="datalist3" >
                <select>
            @foreach ($emplacement as $place)
             <option data-value="{{ $place->id }}" value="{{ $place->emplacement}}"></option>
             @endforeach
                </select>
            </datalist>
     </div>
        </div>
        </form>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 700px">
                  <table class="table table-light mb-0">
                    <thead style="background-color: DDF4FF;">
                      <tr class="text-uppercase text-success">
                            <tr>
                                <td>Code transfert</td>
                                <td>Date transfert </td>
                                <td>Code barre digital</td>
                                <td>Emplacement</td>
                                <td>Gardien</td>
                                <td>Remarque</td>
                            </tr>
                      </tr>
                       </thead>
                    <tbody>
                        @foreach ($liste_transfert as $transfert)
                        <tr>

                            <td>{{$transfert->code_transfert}}</td>
                            <td>{{$transfert->date_transfert}}</td>
                            <td>{{str_pad($transfert->code_barre, 12, '0', STR_PAD_LEFT);}}</td>
                            <td>{{$transfert->emplacement}}</td>
                            <td>{{$transfert->nom_gardien}}{{$transfert->prenom}}</td>
                            <td>{{$transfert->remarque}}</td>
                        </tr>
 @endforeach
                    </tbody>
                  </table>

                   <div class="row">
                    <div class="col-md-5"></div>
                   <div id="pagination" class="col-md-5">

                       {{ $liste_transfert->links('pagination::bootstrap-4') }}
                   </div>
                  </div>
                </div>

            </div>

        </div>
</div>
  @endsection
