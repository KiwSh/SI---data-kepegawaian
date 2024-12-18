@extends('layout.app')

@section('contents')
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5>Tambah Jabatan</h5>
        </div>
        <div class="card-body">
            <form id="formTambahJabatan" action="{{ route('jabatan.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                    <input 
                        type="text" 
                        class="form-control @error('nama_jabatan') is-invalid @enderror" 
                        id="nama_jabatan" 
                        name="nama_jabatan" 
                        placeholder="Nama Jabatan" 
                        value="{{ old('nama_jabatan') }}"
                    >
                    @error('nama_jabatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Simpan Jabatan</button>
                <button type="button" class="btn btn-secondary" id="btnBatal">Batal</button>
            </form>
        </div>
    </div>

    <div class="mt-4">
        <h5>Daftar Jabatan</h5>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Jabatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tb_jabatan as $j)
                <tr>
                    <td>{{ $j->id }}</td>
                    <td>{{ $j->nama_jabatan }}</td>
                    <td>
                        <form action="{{ route('jabatan.destroy', $j->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Tangkap tombol "Batal" dan form
    document.getElementById('btnBatal').addEventListener('click', function() {
        // Dapatkan form berdasarkan ID atau elemen
        const form = document.getElementById('formTambahJabatan');
        
        // Reset semua input di dalam form
        form.reset();

        // Tambahkan logika untuk reset styling jika ada
        const inputs = form.querySelectorAll('.is-invalid');
        inputs.forEach(input => {
            input.classList.remove('is-invalid');
        });
    });
</script>
@endsection