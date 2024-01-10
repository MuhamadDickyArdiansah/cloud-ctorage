<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Folder;


class FolderController extends Controller
{
  public function index()
  {
    $user = Auth::user();
    $folders = Folder::where('user_id', auth()->id())->get();


    return view('pages.home', compact('folders'));
  }

  public function listFolders()
  {
    $folders = Folder::all();
    return view('pages.list-folders', compact('folders'));
  }

  public function detailFolder($id)
  {
    $folder = Folder::findOrFail($id);
    $files = $folder->files; // Misalnya, untuk mendapatkan daftar file di dalam folder

    return view('pages.folderDetail', compact('folder', 'files'));
  }

  public function createFolder(Request $request)
  {
    $request->validate([
      'folder_name' => 'required|string|max:255',
      'parent_folder_id' => 'nullable|exists:folders,id',
    ]);

    // Membuat folder di database
    $newFolder = Folder::create([
      'name' => $request->input('folder_name'),
      'parent_id' => $request->input('parent_folder_id'),
      'user_id' => auth()->id(), // Menambahkan user_id

    ]);

    // Membuat folder di sistem penyimpanan
    $folderPath = 'public/folders/' . $newFolder->name;
    Storage::makeDirectory($folderPath);

    return redirect()->back()->with('success', 'Folder created successfully!');
  }

  // FolderController.php

  public function editFolder(Request $request, $id)
  {
    $request->validate([
      'folder_name' => 'required|string|max:255',
    ]);

    $folder = Folder::findOrFail($id);
    $newName = $request->input('folder_name');

    // Dapatkan path baru
    $newPath = 'public/folders/' . $newName;

    // Ganti nama folder di sistem penyimpanan
    Storage::move('public/folders/' . $folder->name, $newPath);

    // Update record folder di database
    $folder->name = $newName;
    $folder->save();

    return redirect()->back()->with('success', 'Folder name updated successfully!');
  }
}
