
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
 @csrf
  <form method="get" action="{{route('liste_categ')}}"  >

   <div class="form-group">
           <select name="id_categorie" id="categorie">
                @foreach ($categorie as $categ)
                <option value="{{ $categ->id }}">{{ $categ->nom_categorie }}</option>
                @endforeach
            </select>
            </div>

    <button type="submit" class="btn btn-primary">Afficher</button>
        </form>

      </form>
