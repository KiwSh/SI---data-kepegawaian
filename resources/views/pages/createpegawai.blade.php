@extends('layout.app')

@section('contents')
<div class="container mt-4">
    <h4>Tambah Pegawai</h4>
    <form id="formTambahPegawai" method="POST" action="{{ route('pegawai.store') }}" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="mb-3">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama Pegawai</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jabatan</label>
            <select name="tb_jabatan_id" class="form-control" required>
                <option value="">-- Pilih Jabatan --</option>
                @foreach($jabatans as $jabatan)
                    <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Mulai Kerja</label>
            <input type="date" name="mulai_kerja" id="mulai_kerja" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Lama Kerja</label>
            <select name="lama_kerja" id="lama_kerja" class="form-control" required>
                <option value="">-- Pilih Lama Kerja --</option>
                @for ($i = 1; $i <= 30; $i++)
                    <option value="{{ $i }}">{{ $i }} Tahun</option>
                @endfor
            </select>
        </div>
        
        <div class="mb-3">
            <label>Selesai Kerja</label>
            <input type="date" name="selesai_kerja" id="selesai_kerja" class="form-control" required readonly>
        </div>
        <div class="mb-3">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary" id="btnSimpan">Simpan</button>
    </form>
</div>

<style>
    .is-invalid {
        border-color: red;
        background-color: #ffe6e6;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('formTambahPegawai').addEventListener('submit', function(event) {
        const form = this;
        let isValid = true;

        // Ambil semua input dengan atribut "required"
        const requiredInputs = form.querySelectorAll('[required]');
        
        requiredInputs.forEach(input => {
            if (!input.value.trim()) {
                isValid = false;
                input.classList.add('is-invalid'); // Tambahkan kelas "is-invalid" ke input kosong
            } else {
                input.classList.remove('is-invalid'); // Hapus kelas "is-invalid" jika input terisi
            }
        });

        if (!isValid) {
            event.preventDefault(); // Cegah pengiriman form jika ada input yang kosong
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Semua form wajib diisi!',
            });
        }
    });

    // Tambahkan event listener untuk menghapus kelas "is-invalid" saat pengguna mengetik
    document.querySelectorAll('[required]').forEach(input => {
        input.addEventListener('input', function() {
            if (this.value.trim()) {
                this.classList.remove('is-invalid'); // Hapus kelas "is-invalid" jika input terisi
            }
        });
    });

    // Menampilkan notifikasi berhasil tambah data pegawai
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
        });
    @endif

    // Script untuk menghitung selesai_kerja berdasarkan mulai_kerja dan lama_kerja
    document.getElementById('mulai_kerja').addEventListener('change', hitungSelesaiKerja);
    document.getElementById('lama_kerja').addEventListener('change', hitungSelesaiKerja);

    function hitungSelesaiKerja() {
        const mulaiKerja = document.getElementById('mulai_kerja').value;
        const lamaKerja = document.getElementById('lama_kerja').value;

        if (mulaiKerja && lamaKerja) {
            const mulaiKerjaDate = new Date(mulaiKerja);
            mulaiKerjaDate.setFullYear(mulaiKerjaDate.getFullYear() + parseInt(lamaKerja)); // Tambahkan tahun
            const selesaiKerja = mulaiKerjaDate.toISOString().split('T')[0]; // Format date yyyy-mm-dd
            document.getElementById('selesai_kerja').value = selesaiKerja;
        }
    }
</script>
@endsection
