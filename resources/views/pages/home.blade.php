@extends('layouts.app')

@push('styles')
@endpush

@section('content')
<section class="content-section">
  <div class="header d-flex align-items-center justify-content-between mb-3">
    <h1 class="section-header">Quick Access</h1>
    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#uploadModal">
      <i class="fa-solid fa-upload"></i> Upload
    </button>
    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createFolderModal">
      <i class="fa-regular fa-folder-open"></i> Buat Folder
    </button>
  </div>

  <!-- Upload Modal -->
  <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Include the upload form or customize as needed -->
          @include('partials.upload-form')
        </div>
      </div>
    </div>
  </div>

  <!-- Create Folder Modal -->
  <div class="modal fade" id="createFolderModal" tabindex="-1" role="dialog" aria-labelledby="createFolderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createFolderModalLabel">Buat Folder</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Include the folder creation form or customize as needed -->
          @include('partials.create-folder')
        </div>
      </div>
    </div>
  </div>

  <!-- Modal untuk Edit Nama File -->
  @foreach ($files as $file)
  <div class="modal fade" id="editFileModal{{ $file->id }}" tabindex="-1" role="dialog" aria-labelledby="editFileModalLabel{{ $file->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editFileModalLabel{{ $file->id }}">Edit File Name</h5>
        </div>
        <div class="modal-body">
          <!-- Formulir untuk Edit Nama File -->
          @include('partials.editFile', ['file' => $file])
        </div>
      </div>
    </div>
  </div>
  @endforeach

  <!-- Add this section for Edit Folder Modal -->
  @foreach ($folders as $folder)
  <div class="modal fade" id="editFolderModal{{ $folder->id }}" tabindex="-1" role="dialog" aria-labelledby="editFolderModalLabel{{ $folder->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editFolderModalLabel{{ $folder->id }}">Edit Folder Name</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Form for Editing Folder Name -->
          @include('partials.editFolder', ['folder' => $folder])
        </div>
      </div>
    </div>
  </div>
  @endforeach


  <!-- Detail File Modal -->
  @foreach ($files as $file)
  <div class="modal " id="detailFileModal{{ $file->id }}" tabindex="-1" aria-labelledby="detailFileModalLabel{{ $file->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable ">
      <div class="modal-content" style="max-width: 300px; min-height: 100vh; top: -30px; left: 570px;">
        <div class="modal-header">
          <h5 class="modal-title" id="detailFileModalLabel{{ $file->id }}">File Detail - {{ $file->name }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Sidebar Content -->
          <p>Nama File: {{ $file->name }}</p>
          <p>Tipe : {{ substr(strrchr($file->name, '.'), 1) }}</p>
          <p>Ukuran: {{ $file->size }} Kb</p>
          <p>Pemilik : {{ $file->user->name }}</p>
          <p>Ditambahkan: {{ $file->created_at->format('M d, Y. H:i A') }}</p>
          <!-- Add more details as needed -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  @endforeach



  <div class="access-links">

    @foreach ($files as $file)
    @if (empty($file->folder_id))
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-end mb-4">
          <div class="dropdown">
            <button class="btn dropdown-toggle more-download" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-ellipsis-vertical"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <li> <a class="dropdown-item showRight" data-bs-toggle="modal" data-bs-target="#detailFileModal{{ $file->id }}" href="#">Detail</a></li>
              <li><a class="dropdown-item" href="{{ route('files.download', ['id' => $file->id]) }}">Download</a></li>
              <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editFileModal{{ $file->id }}" href="#">Edit</a></li>
              <li><a class=" dropdown-item" href="{{ route('files.deleteFile', ['id' => $file->id]) }}" onclick="return confirm('Apakah Anda yakin ingin Hapus?')">Hapus</a></li>
            </ul>
          </div>
        </div>
        <div class="text-center d-flex gap-3 flex-column">
          <i class="fa-regular fa-file-pdf fa-2xl"></i>
          <p>{{ $file->size }} Kb</p>
        </div>
        <div>
          <p class="card-text mb-0">{{ Str::limit($file->name, 10) }}</p>
          <p class="">{{ $file->created_at->format('M d, Y. H:i A') }}</p>
        </div>
      </div>
    </div>
    @endif
    @endforeach


    @foreach ($folders as $folder)
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-end mb-4">

          <div class="dropdown">
            <button class="btn dropdown-toggle more-download" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-ellipsis-vertical"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <li> <a class="dropdown-item" href="{{ route('folders.detailFolder', ['id' => $folder->id]) }}">Detail</a>
              <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editFolderModal{{ $folder->id }}" href="#">Edit</a></li>

              </li>

            </ul>
          </div>
        </div>
        <div class="text-center d-flex gap-3 flex-column">
          <i class="fa-regular fa-folder-open fa-2xl"></i>
        </div>
        <div class="mt-5">
          <h5 class="card-text text-center mb-0">{{ $folder->name }}</h5>
          <p class="">{{ $folder->created_at->format('M d, Y. H:i A') }}</p>
        </div>
      </div>
    </div>
    @endforeach


  </div>
</section>

<section class="content-section">
  <div class="section-header-wrapper">
    <h1 class="section-header">File Saya</h1>
  </div>

  <div class="files-table">
    <table id="myTable" class="row-border display table-responsive nowrap" style="width: 100%;">
      <thead>
        <tr>
          <th></th>
          <th>nama</th>
          <th>diubah</th>
          <th>ukuran</th>
          <th>berbagi</th>
          <th>aksi</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($files as $file)
        @if (empty($file->folder_id))
        <tr>
          <td>
            <!-- <div class="table-cell name-cell {{ $file->extension }}"></div> -->
            <i class="fa-regular fa-file"></i>
          </td>
          <td>{{ Str::limit($file->name, 10) }}</td>
          <td>{{ now() }}</td>
          <td>{{ $file->size }} kb</td>
          <td>{{ $file->sharing }}</td>
          <td>
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle more-action" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#detailFileModal{{ $file->id }}" href="#">Detail</a></li>
                <li><a class="dropdown-item" href="#">Hapus</a></li>
              </ul>
            </div>
          </td>
        </tr>
        @endif
        @endforeach

        <!-- Tambahkan loop untuk data dari tabel folder jika diperlukan -->

        @foreach ($folders as $folder)
        <tr>
          <td>
            <i class="fa-regular fa-folder-open"></i>
          </td>
          <td>{{ $folder->name }}</td>
          <td>{{ now() }}</td>
          <td></td>
          <td>pribadi</td>
          <td>
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle more-action" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('folders.detailFolder', ['id' => $folder->id]) }}">Detail</a></li>
                <li><a class="dropdown-item" href="#">Hapus</a></li>
              </ul>
            </div>
          </td>
        </tr>
        @endforeach

      </tbody>
    </table>
  </div>
</section>

@endsection

@push('scripts')
@endpush