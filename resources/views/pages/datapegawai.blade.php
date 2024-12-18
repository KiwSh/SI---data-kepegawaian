@extends('layout.app')

@section('contents')
<div class="container mt-4">
    <h4>Data Pegawai</h4>
    <a href="{{ route('pegawai.create') }}" class="btn btn-primary mb-3">Tambah Pegawai</a>
    <button class="btn btn-secondary mb-3" data-bs-toggle="modal" data-bs-target="#importModal">Tambah Banyak Data</button>
    <button class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#deleteModal">Hapus Semua Data</button>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Mulai Kerja</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pegawais as $index => $pegawai)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    @if($pegawai->foto)
                        <img src="{{ asset('storage/' . $pegawai->foto) }}" alt="Foto Pegawai" width="70" height="50">
                    @else
                        Tidak Ada Foto
                    @endif
                </td>
                <td>{{ $pegawai->nik }}</td>
                <td>{{ $pegawai->nama }}</td>
                <td>{{ $pegawai->jabatan ? $pegawai->jabatan->nama_jabatan : 'Tidak Ada Jabatan' }}</td>
                <td>{{ $pegawai->mulai_kerja }}</td>
                <td>
                    <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn btn-sm btn-success">Edit</a>
                    <form action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST" style="display:inline;" id="deleteForm{{ $pegawai->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $pegawai->id }})">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal for Upload Excel -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Tambah Banyak Data Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="excel_file" class="form-label">Pilih File Excel (.xlsx)</label>
                        <input type="file" class="form-control" id="excel_file" name="excel_file" accept=".xlsx" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Unggah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Modal Konfirmasi Hapus Semua Data -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Untuk menghapus semua data pegawai, ketikkan <strong>Hapus Semua Data</strong> di kotak di bawah ini:</p>
                <input type="text" id="confirmation-input" class="form-control" placeholder="Ketikkan 'Hapus Semua Data'" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirm-delete-btn" disabled onclick="submitDeleteAll()">Hapus Semua Data</button>
            </div>
        </div>
    </div>
</div>


<!-- SweetAlert2 Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm' + id).submit(); // Submit form jika konfirmasi diterima
            }
        });
    }

    // Variable untuk menyimpan id yang akan dihapus
let isDeleteAllConfirmed = false;

// Fungsi untuk menangani input konfirmasi penghapusan semua data
document.getElementById('confirmation-input').addEventListener('input', function() {
    const inputValue = this.value;
    // Aktifkan tombol hapus jika input cocok dengan "Hapus Semua Data"
    document.getElementById('confirm-delete-btn').disabled = inputValue !== "Hapus Semua Data";
});

// Fungsi untuk menangani penghapusan semua data pegawai
function submitDeleteAll() {
    const confirmationInput = document.getElementById('confirmation-input').value;
    if (confirmationInput === "Hapus Semua Data") {
        // Menyembunyikan modal setelah penghapusan
        $('#deleteModal').modal('hide');
        
        // Konfirmasi penghapusan menggunakan SweetAlert2
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Semua data pegawai akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus Semua!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirimkan form untuk menghapus semua data
                document.getElementById('deleteAllForm').submit();
            }
        });
    } else {
        Swal.fire('Gagal', 'Pastikan Anda mengetikkan "Hapus Semua Data" untuk melanjutkan penghapusan.', 'error');
    }
}

</script>

@endsection
