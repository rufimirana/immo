<form action="{{ route('handle-form') }}" method="POST">
    @csrf
    <input type="text" name="name">
    <button type="submit">Envoyer</button>
</form>
