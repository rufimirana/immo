@extends('layout.template')
@section('title', 'Liste facture')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
@section('content')
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  <table class="table table-striped">
    <thead>
        <tr>
          <td>Référence facture</td>
          <td>Date</td>
          <td>Fournisseur</td>
          <td>Nom consignataire</td>
          <td>Prénom</td>
          <td>Département</td>
          <td>Devise</td>
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
        </tr>
        @endforeach
    </tbody>
<div>
@endsection
