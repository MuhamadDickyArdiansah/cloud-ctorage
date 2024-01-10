@extends('layouts.app')

@push('styles')
@endpush

@section('content')

<section class="content-section">
  <div class="header d-flex align-items-center justify-content-between mb-3">
    <h1 class="section-header">Shared Files</h1>

    <!-- <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createFolderModal">
      <i class="fa-regular fa-folder-open"></i> Buat Folder
    </button> -->
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

  <!-- Detail File Modal -->
  @foreach ($publicFiles as $publicFile)
  <div class="modal " id="detailFileModal{{ $publicFile->id }}" tabindex="-1" aria-labelledby="detailFileModalLabel{{ $publicFile->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable ">
      <div class="modal-content" style="max-width: 300px; min-height: 100vh; top: -30px; left: 587px;">
        <div class="modal-header">
          <h5 class="modal-title" id="detailFileModalLabel{{ $publicFile->id }}">File Detail - {{ $publicFile->name }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Sidebar Content -->
          <p>Nama File: {{ $publicFile->name }}</p>
          <p>Tipe : {{ substr(strrchr($publicFile->name, '.'), 1) }}</p>
          <p>Ukuran: {{ $publicFile->size }} Kb</p>
          <p>Pemilik : {{ $publicFile->user->name }}</p>
          <p>Ditambahkan: {{ $publicFile->created_at->format('M d, Y. H:i A') }}</p>
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
    @foreach ($publicFiles as $publicFile)
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-end mb-4">
          <div class="dropdown">
            <button class="btn dropdown-toggle more-download" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-ellipsis-vertical"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <li> <a class="dropdown-item showRight" data-bs-toggle="modal" data-bs-target="#detailFileModal{{ $publicFile->id }}" href="#">Detail</a></li>
              <li><a class="dropdown-item" href="{{ route('files.download', ['id' => $publicFile->id]) }}">Download</a></li>
              <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editFileModal{{ $publicFile->id }}" href="#">Edit</a></li>
              <li><a class=" dropdown-item" href="{{ route('files.deleteFile', ['id' => $publicFile->id]) }}" onclick="return confirm('Apakah Anda yakin ingin Hapus?')">Hapus</a></li>
            </ul>
          </div>
        </div>
        <div class="text-center d-flex gap-3 flex-column">
          <i class="fa-regular fa-file-pdf fa-2xl"></i>
          <p>{{ $publicFile->size }} Kb</p>
        </div>
        <div>
          <p class="card-text mb-0">{{ Str::limit($publicFile->name, 10) }}</p>
          <p class="">{{ $publicFile->created_at->format('M d, Y. H:i A') }}</p>
        </div>
      </div>
    </div>
    @endforeach
  </div>

</section>

@endsection