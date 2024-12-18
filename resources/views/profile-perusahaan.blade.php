@extends('layout.app')

@section('contents')

<div class="container mt-5">
    <!-- Header -->
    <div class="bg-primary text-white text-center p-2 mb-4">
        <h4>DINAS KOMUNIKASI DAN INFORMATIKA</h4>
    </div>

    <!-- Profil Perusahaan -->
    <div class="card">
        <div class="card-header bg-info text-white">
            <strong>Profil Perusahaan</strong>
        </div>
        <div class="card-body p-0">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Perusahaan</th>
                        <th>Alamat</th>
                        <th>Bidang</th>
                        <th>Kelola</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $profile ? $profile->nama : '-' }}</td>
                        <td>{{ $profile ? $profile->alamat : '-' }}</td>
                        <td>{{ $profile ? $profile->bidang : '-' }}</td>
                        <td>
                            <a href="{{ route('profile.edit') }}" class="btn btn-success">
                                <i class="fa fa-wrench"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            
        </div>
    </div>

    <!-- Modal Edit Profil -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Profil Perusahaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profil.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Perusahaan</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ optional($profile)->nama }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ optional($profile)->alamat }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="bidang" class="form-label">Bidang</label>
                            <input type="text" class="form-control" id="bidang" name="bidang" value="{{ optional($profile)->bidang }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

@endsection