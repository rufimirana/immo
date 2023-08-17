<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@600&display=swap" rel="stylesheet">
<link href={{asset('css/font-awesome.min.css')}}>
@extends('layout.template')
@section('title', 'Liste des articles')
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
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  <div class="page-header">
    <H2>Liste des articles</H2>
    <div class="row">
        <form method="get" action="{{route('liste_categ')}}"  >
        <div class="col-md-6">
            <label for="designation">Article par catégorie</label>
                    <select name="id_categorie" id="categorie">
                @foreach ($categorie as $categ)
                <option value="{{ $categ->id }}">{{ $categ->nom_categorie }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-light">Afficher</button>
        </div>

        </form>
        <form method="get" action="{{route('search_article')}}">
<div class="col-md-12">
           <div class="form-group">
              <label for="designation">Designation de l'article<span class="obligatoire"></span></label>
              <input type="text" class="form-control" name="designation_article"/>
          </div>
           <button type="submit" class="btn btn-light">Trouver</button>
          </div>
        </form>


    </div>

  </div>
     <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 700px">
                  <table class="table table-light mb-0">
                    <thead style="background-color: DDF4FF;">
                      <tr class="text-uppercase text-success">
                       <tr>
          <td>Code article</td>
          <td>Nom</td>
          <td>Designation</td>
          <td>Designation courte</td>
          <td>Categorie</td>
          <td>Sous catégorie</td>
          <td>Action</td>
        </tr>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($liste_article as $artcl)
        <tr>
            <td>{{$artcl->code_article}}</td>
            <td>{{$artcl->nom_article}}</td>
            <td>{{$artcl->designation_article}}</td>
            <td>{{$artcl->designation_courte_article}}</td>
            <td>{{$artcl->categorie_article}}</td>
            <td>{{$artcl->sous_categorie_article}}</td>
            <td><button type="button" class="btn btn-outline-warning">Fiche</button></td>
        </tr>
        @endforeach
                    </tbody>
                  </table>
                  <div class="row">
                    <div class="col-md-5"></div>
                   <div id="pagination" class="col-md-5">
                        {{ $liste_article->links('pagination::bootstrap-4') }}
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
