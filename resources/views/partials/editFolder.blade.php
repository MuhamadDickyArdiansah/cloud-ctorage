<!-- edit.blade.php atau file view lainnya -->
<form action="{{ route('folders.editFolder', ['id' => $folder->id]) }}" method="post">
  @csrf
  @method('put')

  <label for="folder_name">New Name:</label>
  <input type="text" id="folder_name" name="folder_name" value="{{ $folder->name }}" required>

  <button class="btn btn-light" type="submit">Update Name</button>
</form>