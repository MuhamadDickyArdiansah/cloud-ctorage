<form action="{{ route('files.store') }}" method="post" enctype="multipart/form-data">
  @csrf

  <!-- Input file dengan gaya Bootstrap -->
  <div class="mb-3">
    <label for="file" class="form-label">Choose File:</label>
    <input type="file" class="form-control" name="file" required>
  </div>

  <!-- Dropdown untuk memilih folder -->
  <div class="mb-3">
    <label for="folder_id" class="form-label">Select Folder (optional):</label>
    <select class="form-select" name="folder_id">
      <option value="">No Folder</option>
      @foreach ($folders as $folder)
      <option value="{{ $folder->id }}">{{ $folder->name }}</option>
      @endforeach
    </select>

    <label for="sharing_option" class="form-label mt-3">Sharing Option:</label>
    <select class="form-select" name="sharing_option" required>
      <option value="pribadi">Pribadi</option>
      <option value="publik">Publik</option>
    </select>
    <!-- Menampilkan ukuran file
    <label for="size">File Size:</label>
    <input type="text" name="size" value="{{ old('size') }}" readonly> -->
  </div>

  <!-- Tombol submit -->
  <div class="mb-3">
    <button type="submit" class="btn btn-light">Upload</button>
  </div>
</form>