<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Folder;

class FileController extends Controller
{
  public function index()
  {
    $user = Auth::user();
    $files = File::where('user_id', auth()->id())->get();
    $folders = Folder::where('user_id', auth()->id())->get();


    return view('pages.home', compact('files', 'folders'));
  }

  public function detailFile($id)
  {
    $file = File::findOrFail($id);
    return redirect()->route('files.index');
  }

  public function shared()
  {
    $publicFiles = File::where('sharing', 'publik')->get();
    $folders = Folder::all();

    return view('pages.shared', compact('publicFiles', 'folders'));
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




  public function store(Request $request)
  {
    $request->validate([
      'file' => 'required|max:2048',
      'folder_id' => 'nullable|exists:folders,id',
      'sharing_option' => 'required|in:pribadi,publik',
    ]);

    $file = $request->file('file');
    $folderId = $request->input('folder_id');
    $sharingOption = $request->input('sharing_option');

    // Simpan ukuran file dalam kilobytes
    $sizeInKB = $file->getSize() / 1024;
    $size = number_format($sizeInKB, 2);

    $user = Auth::user();

    $folder = null;
    $folderPath = 'files'; // Folder default jika tidak ada folder yang dipilih

    if ($folderId) {
      $folder = Folder::find($folderId);
      if ($folder) {
        $folderPath = 'folders/' . $folder->name;
      }
    }

    $extension = $file->getClientOriginalExtension();
    $filePath = $file->storeAs($folderPath, $file->getClientOriginalName(), 'public');

    File::create([
      'name' => $file->getClientOriginalName(),
      'extension' => $extension,
      'path' => $filePath,
      'folder_id' => $folderId,
      'user_id' => auth()->id(),
      'size' => $size,
      'sharing' => $sharingOption,
    ]);

    return redirect()->back()->with('success', 'File uploaded successfully!');
  }

  public function deleteFile($id)
  {
    $file = File::findOrFail($id);

    if ($file) {
      $filePath = storage_path('app/public/' . $file->path);

      if (file_exists($filePath)) {
        unlink($filePath); // Hapus file dari sistem penyimpanan

        // Hapus record file dari database
        $file->delete();

        return redirect()->back()->with('success', 'File deleted successfully!');
      } else {
        return redirect()->back()->with('error', 'File not found.');
      }
    } else {
      return redirect()->back()->with('error', 'File not found.');
    }
  }

  public function editFile(Request $request, $id)
  {
    $request->validate([
      'new_name' => 'required|string|max:255',
    ]);

    $file = File::findOrFail($id);
    $newName = $request->input('new_name');

    // Dapatkan path baru
    $newPath = $file->folder ? 'public/folders/' . $file->folder->name . '/' . $newName : 'public/files/' . $newName;

    // Ganti nama file di sistem penyimpanan
    Storage::move($file->path, $newPath);

    // Update record file di database
    $file->name = $newName;
    $file->path = $newPath;
    $file->save();

    return redirect()->route('files.index')->with('success', 'File name updated successfully!');
  }

  public function download($id)
  {
    $file = File::findOrFail($id);

    if ($file) {
      $filePath = 'public/files/' . $file->name; // Update the path

      if (Storage::exists($filePath)) {
        return Storage::download($filePath, $file->name);
      } else {
        return response()->json(['error' => 'File not found'], 404);
      }
    } else {
      return response()->json(['error' => 'File not found'], 404);
    }
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
}
