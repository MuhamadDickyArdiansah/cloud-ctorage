<form action="{{ route('folders.create') }}" method="post">
  @csrf
  <label for="folderName">Nama Folder:</label>
  <input type="text" name="folder_name" required>
  <button type="submit" class="btn btn-light">Buat Folder</button>
  @if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
  @endif

</form>