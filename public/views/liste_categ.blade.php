<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  <table class="table table-striped">
    <thead>
        <tr>
          <td>Code article</td>
          <td>Nom</td>
          <td>Designation</td>
          <td>Designation courte</td>
          <td>Categorie</td>
          <td>Sous catégorie</td>
          <td>Département</td>
          <td>Service</td>
          <td>Couleur</td>
          <td>Marque</td>
          <td>Modèle</td>
          <td>Taille</td>
          <td>Méthode d'amortissement</td>
          <td>Durée année</td>
        </tr>
    </thead>
    <tbody>
        @foreach($liste_categ as $artcl)
        <tr>
               <td>{{$artcl->code_article}}</td>
            <td>{{$artcl->nom_article}}</td>
            <td>{{$artcl->designation_article}}</td>
            <td>{{$artcl->designation_courte_article}}</td>
            <td>{{$artcl->categorie_article}}</td>
            <td>{{$artcl->sous_categorie_article}}</td>
            <td>{{$artcl->departement_article}}</td>
            <td>{{$artcl->service_article}}</td>
            <td>{{$artcl->couleur_article}}</td>
            <td>{{$artcl->marque_article}}</td>
            <td>{{$artcl->modele_article}}</td>
            <td>{{$artcl->taille_article}}</td>
            <td>{{$artcl->amortissement_article}}</td>
            <td>{{$artcl->annee_amortie}}</td>
        </tr>
        @endforeach
    </tbody>
<div>
