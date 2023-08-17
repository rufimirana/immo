<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel + Bootstrap 5</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" ></script>
        <!-- Le css Bootstrap -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>

<style>
  .uper {
    margin-top: 40px;
  }
</style>
<style>
    datalist option::before {
        display: none;
    }
</style>

<div class="card uper">
  <h1 class="card-header">
    Nouvelle Facture
  </h1>

  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif

      <form method="POST" action="{{route('store_facture')}}">
         @csrf
          <div class="form-group">
              <label for="date">Date de création</label>
              <input type="date" class="form-control" name="date"/>
          </div>
 <div class="form-group">
    <label for="exampleDataList" class="form-label">Fournisseur</label>
    <input type="text" name="id_fournisseur" class="form-control" list="datalist1" id="nom_founisseur" placeholder="Type to search...">
    <datalist id="datalist1">
        @foreach ($fournisseur as $fourni)
            <option data-value="{{ $fourni->id }}" value="{{ $fourni->nom_fournisseur }}"></option>
        @endforeach
    </datalist>
</div>
          <div class="form-group">
 <label for="exampleDataList" class="form-label">Consignataire</label>
<input type="text" class="form-control" list="datalist2" id="id_consignataire" name="id__consignataire" placeholder="Type to search...">
<datalist id="datalist2" >
   @foreach ($consignataire as $consi)
                <option data-value="{{ $consi->id }}" value="{{ $consi->nom_gardien}}" ></option>
                @endforeach
</datalist>
          </div>
          <div>
 <label for="exampleDataList" class="form-label">Département</label>
<input type="text" name="id_departement" class="form-control" list="datalist3" id="id_departement" placeholder="Type to search...">
<datalist id="datalist3" >
     <select>
   @foreach ($departement as $depart)
                <option data-value="{{ $depart->id }}" value="{{ $depart->departement}}"></option>
                @endforeach
     </select>
</datalist>
</div>
<div>
 <label for="exampleDataList" class="form-label">Devise</label>
<input type="text" name="id_devise" class="form-control" list="datalist4" id="id_devise" placeholder="Type to search...">
<datalist id="datalist4" >
     <select>
   @foreach ($devise as $devis)
                <option data-value="{{ $devis->id }}" value="{{ $devis->devise}}"></option>
                @endforeach
     </select>
</datalist>
</div>
  {{-- <div class="form-group">
 <label for="exampleDataList" class="form-label">Code article</label>
<input type="text" class="form-control" list="datalist5" id="id_article" name="id_article" placeholder="Type to search...">
<datalist id="datalist5" >
   @foreach ($article as $artcl)
                <option value="{{ $artcl->code_article }}" >{{ $artcl->nom}}</option>
                @endforeach
</datalist>
          </div>
           <div class="form-group">
 <label for="exampleDataList" class="form-label">Description</label>
<input type="text" class="form-control" id="description" name="description" placeholder="Description"></
           </div>

           <div class="form-group">
 <label for="exampleDataList" class="form-label">Quantité</label>
<input type="number" class="form-control" id="quantite" name="quantite" placeholder="Quantite">
          </div>
</div>
 <div class="form-group">
 <label for="exampleDataList" class="form-label">Prix Unitaire</label>
<input type="number" class="form-control" id="prix_unitaire" name="prix_unitaire" placeholder="Prix Unitaire">
          </div>
           <div class="form-group">
 <label for="exampleDataList" class="form-label">Commande</label>
<input type="number" class="form-control" id="commanded" name="commanded" placeholder="Commande">
          </div>
          <button type="submit" class="btn btn-primary">Ajouter</button>
      </form>
  </div> --}}
 <div>
     <table id="invoice">
  <thead>
    <tr>
      <th>Code article</th>
      <th>Description</th>
      <th>Commandés</th>
      <th>Quantité reçue</th>
      <th>Prix unitaire</th>
      <th>TVA</th>
      <th>Total</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td> <label for="exampleDataList" class="form-label">Code article</label>
<input type="text" class="form-control" list="datalist5" id="id_article" name="id_article" placeholder="Type to search...">
<datalist id="datalist5" >
   @foreach ($article as $artcl)
                <option value="{{ $artcl->code_article }}" >{{ $artcl->nom}}</option>
                @endforeach
</datalist></td>
      <td><label for="exampleDataList" class="form-label">Description</label>
<input type="text" class="form-control" id="description" name="description" placeholder="Description"></td>
      <td><label for="exampleDataList" class="form-label">Commande</label>
<input type="number" class="form-control" id="commanded" name="commanded" placeholder="Commande"></td>
<td><label for="exampleDataList" class="form-label">Quantité</label>
<input type="number" class="form-control" id="quantite" name="quantite" placeholder="Quantite"></td>
<td><label for="exampleDataList" class="form-label">Prix Unitaire</label>
<input type="number" class="form-control" id="prix_unitaire" name="prix_unitaire" placeholder="Prix Unitaire"></td>
<td> <label for="tva">TVA</label>
    <input type="number" name="tva" id="tva"></td>
<td><label for="total">Total</label>
    <input type="text" name="total" id="total" readonly></td>
    </tr>
    <tr>
       <td> <label for="exampleDataList" class="form-label">Code article</label>
<input type="text" class="form-control" list="datalist5" id="id_article" name="id_article" placeholder="Type to search...">
<datalist id="datalist5" >
   @foreach ($article as $artcl)
                <option value="{{ $artcl->code_article }}" >{{ $artcl->nom}}</option>
                @endforeach
</datalist></td>
      <td><label for="exampleDataList" class="form-label">Description</label>
<input type="text" class="form-control" id="description" name="description" placeholder="Description"></td>
      <td><label for="exampleDataList" class="form-label">Commande</label>
<input type="number" class="form-control" id="commanded" name="commanded" placeholder="Commande"></td>
<td><label for="exampleDataList" class="form-label">Quantité</label>
<input type="number" class="form-control" id="quantite" name="quantite" placeholder="Quantite"></td>
<td><label for="exampleDataList" class="form-label">Prix Unitaire</label>
<input type="number" class="form-control" id="prix_unitaire" name="prix_unitaire" placeholder="Prix Unitaire"></td>
<td> <label for="tva">TVA</label>
    <input type="number" name="tva" id="tva"></td>
<td><label for="total">Total</label>
    <input type="text" name="total" id="total" readonly></td>
    </tr>
    <tr>
       <td> <label for="exampleDataList" class="form-label">Code article</label>
<input type="text" class="form-control" list="datalist5" id="id_article" name="id_article" placeholder="Type to search...">
<datalist id="datalist5" >
   @foreach ($article as $artcl)
                <option value="{{ $artcl->code_article }}" >{{ $artcl->nom}}</option>
                @endforeach
</datalist></td>
      <td><label for="exampleDataList" class="form-label">Description</label>
<input type="text" class="form-control" id="description" name="description" placeholder="Description"></td>
      <td><label for="exampleDataList" class="form-label">Commande</label>
<input type="number" class="form-control" id="commanded" name="commanded" placeholder="Commande"></td>
<td><label for="exampleDataList" class="form-label">Quantité</label>
<input type="number" class="form-control" id="quantite" name="quantite" placeholder="Quantite"></td>
<td><label for="exampleDataList" class="form-label">Prix Unitaire</label>
<input type="number" class="form-control" id="prix_unitaire" name="prix_unitaire" placeholder="Prix Unitaire"></td>
<td> <label for="tva">TVA</label>
    <input type="number" name="tva" id="tva"></td>
<td><label for="total">Total</label>
    <input type="number" name="total" id="total" readonly></td>
    </tr>
  </tbody>
    <tfoot>
    <tr>
      <td colspan="4">Grand Total:</td>
      <td><input type="number" id="grand-total" readonly></td>
    </tr>
  </tfoot>

</table>

 </div>
<script>


//    // Calculate total price
  function calculateTotal() {
        var quantite = $('#quantite').val();
        var prix_unitaire = $('#prix_unitaire').val();
        var tva = $('#tva').val();
        var total = (quantite * prix_unitaire) + (quantite * prix_unitaire * tva / 100);
        $('#total').val(total);
    }

    // Autocomplete
    $(document).ready(function() {
        $('#quantite, #prix_unitaire, #tva').on('input', function() {
            calculateTotal();
        });
    });
//     function calculateTotal(quantiteInput, unitPriceInput, tvaInput, totalInput) {
//     var quantite = $(quantiteInput).val();
//     var unitPrice = $(unitPriceInput).val();
//     var tva = $(tvaInput).val();
//     var total = quantite * unitPrice + quantite * unitPrice * tva / 100;
//     $(totalInput).val(total);
//   }

//   $(document).ready(function() {
//     $('.quantite, .unit-price, .tva').on('input', function() {
//       var row = $(this).closest('tr');
//       var quantiteInput = row.find('.quantite');
//       var unitPriceInput = row.find('.unit-price');
//       var tvaInput = row.find('.tva');
//       var totalInput = row.find('.total');
//       calculateTotal(quantiteInput, unitPriceInput, tvaInput, totalInput);
//       var grandTotal = 0;
//       $('.total').each(function() {
//         grandTotal += parseFloat($(this).val() || 0);
//       });
//       $('#grand-total').val(grandTotal);
//     });
//   });


    // Get the selected option when the form is submitted
    document.getElementById("my-form").addEventListener("submit", function(event) {
        var input = document.getElementById("nom_fournisseur");
        var datalist1 = document.getElementById("datalist1");
        var selectedOption = Array.from(datalist1.options).find(function(option) {
            return option.value === input.value;
        });
        var selectedValue = selectedOption.getAttribute("data-value");
         var input = document.getElementById("nom_gardien");
        var datalist2 = document.getElementById("datalist2");
        var selectedOption = Array.from(datalist2.options).find(function(option) {
            return option.value === input.value;
        });
        var selectedValue = selectedOption.getAttribute("data-value");
 var selectedValue = selectedOption.getAttribute("data-value");
         var input = document.getElementById("departement");
        var datalist3 = document.getElementById("datalist3");
        var selectedOption = Array.from(datalist3.options).find(function(option) {
            return option.value === input.value;
        });
        var selectedValue = selectedOption.getAttribute("data-value");
 var selectedValue = selectedOption.getAttribute("data-value");
         var input = document.getElementById("devise");
        var datalist4 = document.getElementById("datalist4");
        var selectedOption = Array.from(datalist4.options).find(function(option) {
            return option.value === input.value;
        });
        var selectedValue = selectedOption.getAttribute("data-value");

        var selectedValue = selectedOption.getAttribute("data-value");
         var input = document.getElementById("devise");
        var datalist5 = document.getElementById("datalist5");
        var selectedOption = Array.from(datalist5.options).find(function(option) {
            return option.value === input.value;
        });
        var selectedValue = selectedOption.getAttribute("data-value");


        // Insert the selected value into the database using your preferred method
        // ...
    });
</script>


</html>
