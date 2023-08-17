<form method="POST" action="{{ route('pdf.import') }}" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="pdf">PDF file</label>
        <input type="file" name="pdf" class="form-control-file" id="pdf">
    </div>

    <button type="submit" class="btn btn-primary">Import PDF</button>
</form>
