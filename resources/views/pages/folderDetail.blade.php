@extends('layouts.app')

@push('styles')
@endpush

@section('content')

<section class="content-section">
  <div class="header d-flex align-items-center justify-content-between mb-3">
    <h1 class="section-header">My Drive > {{ $folder->name }}</h1>


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
    @foreach ($files as $file)
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-end mb-4">
          <div class="dropdown">
            <button class="btn dropdown-toggle more-download" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-ellipsis-vertical"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <li> <a class="dropdown-item" href="#">Detail</a>
              </li>
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
    @endforeach
  </div>

</section>

@endsection