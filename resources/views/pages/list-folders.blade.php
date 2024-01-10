@extends('layouts.app')

@push('styles')
@endpush

@section('content')

<section class="content-section">
  <div class="header d-flex align-items-center mb-3 gap-3">
    <h1 class="section-header">List Folder</h1>

    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createFolderModal">
      <i class="fa-regular fa-folder-open"></i> Buat Folder
    </button>
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

  <div class="access-links">
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

              </li>

            </ul>
          </div>
        </div>
        <div class="text-center d-flex gap-3 flex-column">
          <i class="fa-regular fa-folder-open fa-2xl"></i>
        </div>
        <div>
          <p class="card-text mb-0">{{ $folder->name }}</p>
          <p class="">{{ $folder->created_at->format('M d, Y. H:i A') }}</p>
        </div>
      </div>
    </div>
    @endforeach
  </div>

</section>

@endsection