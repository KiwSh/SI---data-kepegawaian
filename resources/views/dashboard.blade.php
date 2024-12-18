@extends('layout.app')

@section('contents')
<div class="container-fluid">
    <div class="row">
        <!-- Profil Perusahaan -->
        <div class="col-md-12">
            <h3 class="text-primary text-center mb-4">Profil Perusahaan</h3>
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <strong>Informasi Perusahaan</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nama Dinas</label>
                            <input type="text" class="form-control" value="DINAS KOMUNIKASI DAN INFORMATIKA" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Alamat</label>
                            <input type="text" class="form-control" value="KABUPATEN BOGOR" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Bidang</label>
                            <input type="text" class="form-control" value="KOMUNIKASI, INFORMATIKA, PERSANDIAN, dan STATISTIK" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Grafik -->
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <strong>Total Pegawai</strong>
                </div>
                <div class="card-body">
                    <canvas id="pegawaiChart" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-warning text-white">
                    <strong>Jumlah Pengguna</strong>
                </div>
                <div class="card-body">
                    <canvas id="userChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-5 text-center">
        <p>&copy; 2024 Data Kepegawaian - Laravel Admin Panel</p>
    </footer>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data Statistik Pegawai
    const ctxPegawai = document.getElementById('pegawaiChart').getContext('2d');
    const pegawaiChart = new Chart(ctxPegawai, {
        type: 'bar',
        data: {
            labels: ['Total Pegawai'],
            datasets: [{
                label: 'Pegawai',
                data: [25], // Ganti data ini dengan jumlah total pegawai
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Data Statistik Pengguna
    const ctxUser = document.getElementById('userChart').getContext('2d');
    const userChart = new Chart(ctxUser, {
        type: 'pie',
        data: {
            labels: ['Pengguna Aktif', 'Pengguna Tidak Aktif'],
            datasets: [{
                label: 'User',
                data: [15, 5], // Ganti data ini dengan jumlah pengguna aktif & tidak aktif
                backgroundColor: ['rgba(255, 206, 86, 0.6)', 'rgba(255, 99, 132, 0.6)'],
                borderColor: ['rgba(255, 206, 86, 1)', 'rgba(255, 99, 132, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
        }
    });
</script>
@endsection
