@extends('layout.template')
@section('title', 'Saisie facture')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style_formulaire_creation_article.css') }}" />
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" ></script>
<!-- Le css Bootstrap -->
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<style>
    .card-body{
        background-color: white;
    }
      .page-header{
        font-family: 'Golos Text', sans-serif;
    }
    .obligatoire:after {
content: "*";
color: red;
 margin-left: 10px;
}
  .uper {
    margin-top: 10px;
  }

</style>

<style>
    datalist option::before {
        display: none;
    }
</style>

@section('content')
<div class="page-header">
    <H2>Saisir facture</H2>
   </div>
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
<div class="col-md-12 col-md-pull-7" id="formulaire">
<div class="booking-form">
    <form method="POST" id="add_facture" action="{{route('store_facture')}}">
        @csrf
        <div class="row">
        <div class="col-sm-3">
          <div class="form-group">
              <label for="date" class="form-label">Date de création<span class="obligatoire"></span></label>
              <input type="date" class="form-control" name="date"/>
        </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="exampleDataList" class="form-label">Fournisseur<span class="obligatoire"></span></label>
                <input type="text" name="id_fournisseur" class="form-control" list="datalist1" id="nom_founisseur" placeholder="Fournisseur">
                <datalist id="datalist1">
            @foreach ($fournisseur as $fourni)
                <option data-value="{{ $fourni->id }}" value="{{ $fourni->nom_fournisseur }}"></option>
            @endforeach
                </datalist>
            </div>
        </div>

            <div class="form-group">
        <label for="exampleDataList" class="form-label" >Saisie par:<span class="obligatoire"></span></label>
        <input type="text" class="form-control" list="datalist2" id="id_consignataire" name="id__consignataire" placeholder="Consignataire">
        <datalist id="datalist2" >
        @foreach ($consignataire as $consi)
                        <option data-value="{{ $consi->id }}" value="{{ $consi->nom_gardien}}" ></option>
                        @endforeach
        </datalist>
          </div>
        </div>

 <div class="row">
     <div class="col-md-3">
         <label for="exampleDataList" class="form-label">Département<span class="obligatoire"></span></label>
            <input type="text" name="id_departement" class="form-control" list="datalist3" id="id_departement" placeholder="Code">
            <datalist id="datalist3" >
                <select>
            @foreach ($departement as $depart)
             <option data-value="{{ $depart->id }}" value="{{ $depart->departement}}"></option>
             @endforeach
                </select>
            </datalist>
     </div>

<div class=col-md-3>
 <label for="exampleDataList" class="form-label">Devise<span class="obligatoire"></span></label>
<input type="text" name="id_devise" class="form-control" list="datalist4" id="id_devise" placeholder="Code">
<datalist id="datalist4" >
     <select>
   @foreach ($devise as $devis)
                <option data-value="{{ $devis->id }}" value="{{ $devis->devise}}"></option>
                @endforeach
     </select>
</datalist>
</div>
<div class="col-md-3">
    <label for="exampleDataList" class="form-label">En cas de surplus:</label>
    <a class="btn btn-light" href="javascript:void(0)" onclick="add_row()">Ajouter une ligne</a>
</div>
</div>


 <div>
     <table id="invoice">
  <thead>
    <tr >
      <th>Code article</th>
      <th>Description</th>
      <th>Commandés</th>
      <th>Quantité reçue</th>
      <th>Prix unitaire</th>
      <th>TVA</th>
      <th>Total</th>

    </tr>
  </thead>
  <tbody id="tbody">

    <tr id="to_clone" >
        <td>
                <input type="text" class="form-control" list="datalist5" id="id_article-1" name="id_article1" placeholder="Code">
                <datalist id="datalist5" >
                @foreach ($article as $artcl)
                                <option value="{{ $artcl->code_article }}" >{{ $artcl->nom}}</option>
                                @endforeach
                </datalist></td>
        <td>
                <input type="text" class="form-control" id="description" name="description1" placeholder="Description"></td>
        <td>
            <input type="number" class="form-control" id="commanded" name="commanded1" placeholder="Commande">
        </td>
        <td>
            <input type="number" class="form-control" id="quantite-1" name="quantite1" placeholder="Quantite">
        </td>
        <td>
            <input type="number" class="form-control" id="prix_unitaire-1" name="prix_unitaire1" placeholder="Prix Unitaire">
        </td>
        <td>
            <input type="number" class="form-control" name="tva1" id="tva-1" placeholder="TVA">
        </td>
        <td>
            <input type="text" class="form-control" name="total1" id="total-1" placeholder="Total" readonly>
        </td>

    </tr>
    <tr>
       <td>
<input type="text" class="form-control" list="datalist5" id="id_article-2" name="id_article2" placeholder="Code">
<datalist id="datalist5" >
   @foreach ($article as $artcl)
                <option value="{{ $artcl->code_article }}" >{{ $artcl->nom}}</option>
                @endforeach
</datalist></td>
      <td>
<input type="text" class="form-control" id="description" name="description2" placeholder="Description"></td>
      <td>
<input type="number" class="form-control" id="commanded" name="commanded2" placeholder="Commande"></td>
<td>
<input type="number" class="form-control" id="quantite-2" name="quantite2" placeholder="Quantite"></td>
<td>
<input type="number" class="form-control" id="prix_unitaire-2" name="prix_unitaire2" placeholder="Prix Unitaire"></td>
<td>
    <input type="number" class="form-control" name="tva2" id="tva-2" placeholder="TVA"></td>
<td>
    <input type="text" class="form-control" name="total2" id="total-2" placeholder="Total" readonly></td>
    </tr>
    <tr>
       <td>
<input type="text" class="form-control" list="datalist5" id="id_article-3" name="id_article3" placeholder="Code">
<datalist id="datalist5" >
   @foreach ($article as $artcl)
                <option value="{{ $artcl->code_article }}" >{{ $artcl->nom}}</option>
                @endforeach
</datalist></td>
      <td>
<input type="text" class="form-control" id="description" name="description3" placeholder="Description"></td>
      <td>
<input type="number" class="form-control" id="commanded" name="commanded3" placeholder="Commande"></td>
<td>
<input type="number" class="form-control" id="quantite-3" name="quantite3" placeholder="Quantite"></td>
<td>
<input type="number" class="form-control" id="prix_unitaire-3" name="prix_unitaire3" placeholder="Prix Unitaire"></td>
<td>
    <input type="number" class="form-control" name="tva3" id="tva-3" placeholder="TVA"></td>
<td>
    <input type="number" class="form-control" name="total3" id="total-3" placeholder="Total" readonly></td>
    </tr>
    <tr>
       <td>
<input type="text" class="form-control" list="datalist5" id="id_article-4" name="id_article4" placeholder="Code">
<datalist id="datalist5" >
   @foreach ($article as $artcl)
                <option value="{{ $artcl->code_article }}" >{{ $artcl->nom}}</option>
                @endforeach
</datalist></td>
      <td>
<input type="text" class="form-control" id="description" name="description4" placeholder="Description"></td>
      <td>
<input type="number" class="form-control" id="commanded" name="commanded4" placeholder="Commande"></td>
<td>
<input type="number" class="form-control" id="quantite-4" name="quantite4" placeholder="Quantite"></td>
<td>
<input type="number" class="form-control" id="prix_unitaire-4" name="prix_unitaire4" placeholder="Prix Unitaire"></td>
<td>
    <input type="number" class="form-control" name="tva4" id="tva-4" placeholder="TVA"></td>
<td>
    <input type="number" class="form-control" name="total4" id="total-4" placeholder="Total" readonly></td>
    </tr>
  </tbody>
    <tfoot>
    <tr>
      <td colspan=""><label for="grand_total">Grand Total:</td>
      <td><input type="number" class="form-control" class="form-label" id="grand_total" readonly></td>
    </tr>
  </tfoot>

</table>
<div class="form-btn">
 <button type="submit-btn" class="btn btn-primary">Créer facture</button>
</div>
      </form>
 </div>


    </div>
  </div>
</div>

<script>
function calculateTotal(lineNumber) {
    var quantite = $('#quantite-' + lineNumber).val();
    var prix_unitaire = $('#prix_unitaire-' + lineNumber).val();
    var tva = $('#tva-' + lineNumber).val();
    var total = (quantite * prix_unitaire) + (quantite * prix_unitaire * tva / 100);
    $('#total-' + lineNumber).val(total);
    return total;
}
function updateGrandTotal() {
    var grandTotal = 0;
    for (var i = 1; i <= 4; i++) {
        grandTotal += parseFloat($('#total-' + i).val()) || 0;
    }
    $('#grand_total').val(grandTotal);
}

$(document).ready(function() {
    // Autocomplete for line 1
    $('#quantite-1, #prix_unitaire-1, #tva-1').on('input', function() {
        calculateTotal(1);
        updateGrandTotal();
    });

    // Autocomplete for line 2
    $('#quantite-2, #prix_unitaire-2, #tva-2').on('input', function() {
        calculateTotal(2);
        updateGrandTotal();
    });

    // Autocomplete for line 3
    $('#quantite-3, #prix_unitaire-3, #tva-3').on('input', function() {
        calculateTotal(3);
        updateGrandTotal();
    });

    // Autocomplete for line 4
    $('#quantite-4, #prix_unitaire-4, #tva-4').on('input', function() {
        calculateTotal(4);
        updateGrandTotal();
    });
});





//    // Calculate total price
//   function calculateTotal() {
//         var quantite = $('#quantite').val();
//         var prix_unitaire = $('#prix_unitaire').val();
//         var tva = $('#tva').val();
//         var total = (quantite * prix_unitaire) + (quantite * prix_unitaire * tva / 100);
//         $('#total').val(total);
//     }

//     Autocomplete
//     $(document).ready(function() {
//         $('#quantite, #prix_unitaire, #tva').on('input', function() {
//             calculateTotal();
//         });
//     });
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
@endsection
<script>
    var global= 1;
    function add_ligne(){
        global++;
        alert(global);
        $('#tr_1').append('<input type="text" placeholder="name" id="name">');
    }
    function add_row() {
        var tr = document.getElementById('to_clone');
         var tbody = document.getElementById('tbody');
        var cln = tr.cloneNode(true);
        // var elem = cln.querySelector('#quantite1');
        // elem.value = '';
        var table = document.getElementById("invoice");

        var n_tr = document.createElement("tr");
        var td = document.createElement("td");
        var td1 = document.createElement("td");
        var td2 = document.createElement("td");
        var td3 = document.createElement("td");
        var td4 = document.createElement("td");
         var td5 = document.createElement("td");
          var td6 = document.createElement("td");
            var input = document.createElement("input");
            input.setAttribute('type', 'text');
            input.setAttribute('placeholder', 'Code');
            input.setAttribute('class', 'form-control');
             var input1 = document.createElement("input");
            input1.setAttribute('type', 'text');
            input1.setAttribute('placeholder', 'Description');
            input1.setAttribute('class', 'form-control');
             var input2 = document.createElement("input");
            input2.setAttribute('type', 'number');
            input2.setAttribute('placeholder', 'Commande');
            input2.setAttribute('class', 'form-control');
             var input3 = document.createElement("input");
            input3.setAttribute('type', 'number');
            input3.setAttribute('placeholder', 'Quantite');
            input3.setAttribute('class', 'form-control');
             var input4 = document.createElement("input");
            input4.setAttribute('type', 'number');
            input4.setAttribute('placeholder', 'Prix Unitaire');
            input4.setAttribute('class', 'form-control');
            var input5 = document.createElement("input");
            input5.setAttribute('type', 'number');
            input5.setAttribute('placeholder', 'TVA');
            input5.setAttribute('class', 'form-control');
             var input6 = document.createElement("input");
            input6.setAttribute('type', 'text');
            input6.setAttribute('placeholder', 'Total');
            input6.setAttribute('class', 'form-control');
        td.appendChild(input);
         td1.appendChild(input1);
        td2.appendChild(input2);
        td3.appendChild(input3);
         td4.appendChild(input4);
          td5.appendChild(input5);
                    td6.appendChild(input6);

        n_tr.appendChild(td);
        n_tr.appendChild(td1);
        n_tr.appendChild(td2);
        n_tr.appendChild(td3);
        n_tr.appendChild(td4);
        n_tr.appendChild(td5);
        n_tr.appendChild(td6);
        tbody.appendChild(n_tr);
        // table.appendChild(cln);

    }

</script>
