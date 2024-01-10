<div class="right-area-content">
  <div class="detail-content">
    <span>tipe</span>
    <span>{{ substr(strrchr($file->name, '.'), 1) }}</span>

  </div>

  <div class="detail-content">
    <span>ukuran</span>
    <span>{{ $file->size }} Kb</span>
  </div>

  <div class="detail-content">
    <span>pemilik</span>
    <span>{{ $file->user->name }}</span>
  </div>

  <div class="detail-content">
    <span>diubah</span>
    <span>{{$file->updated_at}}</span>
  </div>

  <div class="detail-content">
    <span>ditambahkan</span>
    <span>{{$file->created_at}}</p>
  </div>

</div>