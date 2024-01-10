<!-- edit.blade.php atau file view lainnya -->
<form action="{{ route('files.editFile', ['id' => $file->id]) }}" method="post">
  @csrf
  @method('put')

  <label for="new_name">New Name:</label>
  <input type="text" id="new_name" name="new_name" value="{{ $file->name }}" required>

  <button class="btn btn-light" type="submit">Update Name</button>
</form>