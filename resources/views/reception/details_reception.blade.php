@extends('layout.template')
@section('title', 'Détails de réception')
<style>
  .uper {
    margin-top: 40px;
  }

</style>
@section('content')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Détails de réception
        </h2>
        <form method="get" action="{{route('recevoir_immo')}}">
   <div class="py-12">
      <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-lg mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="container text-center">
{{-- <div class="container px-4">
  <div class="row justify-content-start ">
    <div class="col-1 col-md-2">
     <div class=" border bg-light">  <p class="text-2xl">Code récéption</p>
          <p>{{ $reception->id}}</p></div>
    </div>

  </div>
</div> --}}
{{-- <div class="row">
      <p class="text-2xl">Fournisseur:</p>
  <div class=" border bg-light col-1 col-md-2 ml-md-auto"> <p>{{ $fournisseur->id_fournisseur }}</p> </div>
  <div class=" border bg-light col-md-3 ml-md-auto"><p>{{ $fournisseur->nom_fournisseur }}</p></div>
</div>
<div class="row">
    <p class="text-2xl">Saisie par</p>
  <div class="border bg-light col-1 col-md-2 ml-md-auto">   <p class="text-2xl">{{ $consignataire->id_consignataire }}</p></div>

  <div class="border bg-light col-md-3 ml-md-auto">  <p class="text-2xl">{{ $consignataire->nom_gardien }}</p> <p class="text-2xl">{{ $reception->prenom}}</p></div>
</div>
<div class="row">
    <p class="text-2xl">Emplacement </p>
  <div class="border bg-light col-1 col-md-2 ml-md-auto">   <p class="text-2xl">{{ $emplacement ->id_emplacement }}</p></div>

  <div class="border bg-light col-md-3 ml-md-auto">  <p class="text-2xl">{{ $emplacement ->emplacement }}</p></div>
</div> --}}
<div class=".col-sm-5 .offset-sm-2 .col-md-6 .offset-md-0">
      <div class=" border bg-light"><p class="text-2xl">Date de réception</p>
          <p>{{ $date_reception}}</p></div>
    </div>
<div class="row">
      <p class="text-2xl">Fournisseur:</p>

  <div class=" border bg-light col-md-3 ml-md-auto"><p name="id_fournisseur">{{ $fournisseur}}</p></div>
</div>
<div class="row">
    <p class="text-2xl">Saisie par</p>


  <div class="border bg-light col-md-3 ml-md-auto">  <p class="text-2xl" name="id_consignataire">{{ $consignataire}}</p></div>
</div>
<div class="row">
    <p class="text-2xl">Emplacement </p>


  <div class="border bg-light col-md-3 ml-md-auto">   <p name="id_emplacement" class="text-2xl">{{ $emplacement }}</p></div>
</div>
<div class="row">
    <p class="text-2xl">Référence facture </p>


  <div class="border bg-light col-md-3 ml-md-auto">  <p name="id_facture" class="text-2xl">{{ $facture}}</p></div>
</div>

 <table class="table table-striped">
    <thead>
        <tr>
          <td>Numéro de l'article en facture</td>
          <td>Ref article</td>
          <td>Description</td>
          <td>Commandé</td>
          <td>Quantité reçue</td>
        </tr>
    </thead>
    <tbody>
        @foreach($details_facture as $dfact)
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
 <button type="submit" class="btn btn-primary">Recevoir immo</button>
 </form>
@endsection
