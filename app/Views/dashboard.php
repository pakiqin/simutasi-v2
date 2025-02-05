<?= $this->extend('layouts/main_layout'); ?>
<?= $this->section('content'); ?>
<style>
    .card-custom {
        border-left: 12px solid #FFC107; /* Warna default */
        border-radius: 8px; /* Membuat sudut lebih halus */
        box-shadow: 2px 4px 8px rgba(0, 0, 0, 0.1); /* Efek shadow */
        padding: 15px;
        height: 100%; /* Tinggi card seragam */
        transition: 0.3s; /* Animasi efek hover */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-custom:hover {
        transform: scale(1.02); /* Efek sedikit membesar saat hover */
    }

    .icon-bg {
        position: absolute;
        bottom: 15px;
        right: 15px;icon-bg
        opacity: 0.8;
    }

    .card-yellow {
        border-left-color: #FFC107;
    }

    .card-blue {
        border-left-color: #007BFF;
    }

    .card-green {
        border-left-color: #28A745;
    }

    .card-red {
        border-left-color: #DC3545;
    }

    .card-purple {
        border-left-color: #6F42C1;
    }

    .h-100 {
        height: 100%; /* Memastikan semua card memiliki tinggi yang sama */
    }

    /* Ukuran teks lebih besar */
    .text-md {
        font-size: 1 rem;
        font-weight: bold;
    }

    .text-right {
        text-align: right;
    }


</style>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>
<!-- 🔹 BARIS PERTAMA: 4 KOTAK STATISTIK -->
<div class="row">
    <!-- TOTAL USULAN MUTASI -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-custom card-blue">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-lg font-weight-bold text-uppercase">01 : Usulan Mutasi</div>
                        <div class="text-xs text-muted">Semua Tahun</div>
                    </div>
                    <div class="text-right">
                        <div class="h2 font-weight-bold"><?= $total_usulan; ?></div>
                    </div>
                </div>
                <i class="fas fa-file-alt fa-2x text-gray-300 icon-bg"></i>
            </div>
        </div>
    </div>

    <!-- USULAN DIKIRIM KE DINAS -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-custom card-yellow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-lg font-weight-bold text-uppercase">02 : Usulan Cabdin</div>
                        <div class="text-xs text-muted">Tahun <?= $tahun_saat_ini; ?></div>
                        <div class="mt-2">
                            <span class="badge bg-primary text-white">Menunggu Verifikasi: <?= $total_terkirim; ?></span>
                            <span class="badge bg-danger text-white">Belum Dikirim: <?= $usulan_belum_dikirim; ?></span>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="h2 font-weight-bold"><?= $total_usulan_cabdin; ?></div>
                    </div>
                </div>
                <i class="fas fa-paper-plane fa-2x text-gray-300 icon-bg"></i>
            </div>
        </div>
    </div>

    <!-- VERIFIKASI DINAS -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-custom card-red">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-lg font-weight-bold text-uppercase">03 : Verifikasi Dinas</div>
                        <div class="text-xs text-muted">Tahun <?= $tahun_saat_ini; ?></div>
                        <div class="mt-2">
                            <span class="badge bg-success text-white">Lengkap: <?= $total_lengkap; ?></span>
                            <span class="badge bg-danger text-white">TdkLengkap: <?= $total_tdk_lengkap; ?></span>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="h2 font-weight-bold"><?= $total_verif_dinas; ?></div>
                    </div>
                </div>
                <i class="fas fa-check-circle fa-2x text-gray-300 icon-bg"></i>
            </div>
        </div>
    </div>

    <!-- TELAAH KABID -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card card-custom card-yellow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-lg font-weight-bold text-uppercase">04 : Telaah Usulan</div>
                        <div class="text-xs text-muted">Tahun <?= $tahun_saat_ini; ?></div>
                        <div class="mt-2">
                            <span class="badge bg-success text-white">Disetujui: <?= $telaah_disetujui; ?></span>
                            <span class="badge bg-danger text-white">Ditolak: <?= $telaah_ditolak; ?></span>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="h2 font-weight-bold"><?= $total_telaah_kabid; ?></div>
                    </div>
                </div>
                <i class="fas fa-user-tie fa-2x text-gray-300 icon-bg"></i>
            </div>
        </div>
    </div>
</div>

<!-- 🔹 BARIS KEDUA: 3 KOTAK STATISTIK -->
<div class="row">
    <!-- REKOMENDASI KADIS -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card card-custom card-green">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-lg font-weight-bold text-uppercase">05 : Rekomendasi Kadis</div>
                        <div class="text-xs text-muted">Tahun <?= $tahun_saat_ini; ?></div>
                        <div class="mt-2">
                            <span class="badge bg-success text-white">Ada Rekom: <?= $rekom_kadis_ada; ?></span>
                            <span class="badge bg-danger text-white">Belum Ada Rekom: <?= $rekom_kadis_belum; ?></span>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="h2 font-weight-bold"><?= $rekom_kadis; ?></div>
                    </div>
                </div>
                <i class="fas fa-clipboard-check fa-2x text-gray-300 icon-bg"></i>
            </div>
        </div>
    </div>

    <!-- KIRIM BKPSDM -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card card-custom card-blue">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-lg font-weight-bold text-uppercase">06 : Dikirim ke BKPSDM</div>
                        <div class="text-xs text-muted">Tahun <?= $tahun_saat_ini; ?></div>
                        <div class="mt-2">
                            <span class="badge bg-success text-white">Sudah: <?= $kirim_bka_sudah; ?></span>
                            <span class="badge bg-danger text-white">Belum: <?= $kirim_bka_belum; ?></span>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="h2 font-weight-bold"><?= $dikirim_bkpsdm; ?></div>
                    </div>
                </div>
                <i class="fas fa-share-square fa-2x text-gray-300 icon-bg"></i>
            </div>
        </div>
    </div>

    <!-- SK MUTASI -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card card-custom card-purple">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-lg font-weight-bold text-uppercase">07 : SK Mutasi Terbit</div>
                        <div class="text-xs text-muted">Tahun <?= $tahun_saat_ini; ?></div>
                        <div class="mt-2">
                            <span class="badge bg-success text-white">Nota Dinas: <?= $nota_dinas; ?></span>
                            <span class="badge bg-primary text-white">SK Mutasi: <?= $sk_mutasi; ?></span>
                            <span class="badge bg-danger text-white">Belum Terbit: <?= $belum_terbit; ?></span>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="h2 font-weight-bold"><?= $terbit_sk; ?></div>
                    </div>
                </div>
                <i class="fas fa-file-signature fa-2x text-gray-300 icon-bg"></i>
            </div>
        </div>
    </div>
</div>



<!-- 🔹 BARIS KETIGA: GRAFIK -->
<div class="row">
    <!-- Grafik Bar/Line: Usulan Per Bulan -->
    <div class="col-xl-8 col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Jumlah Usulan Mutasi Per Bulan</h6>
                <select id="filterTahun" class="form-control form-control-sm" style="width: 120px;">
                    <!-- Pilihan tahun akan di-load dari database -->
                </select>
            </div>
            <div class="card-body">
                <canvas id="chartUsulan"></canvas>
            </div>
        </div>
    </div>

    <!-- Pie Chart: Distribusi Status Usulan -->
    <div class="col-xl-4 col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Distribusi Status Usulan</h6>
            </div>
            <div class="card-body">
                <canvas id="chartPie"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- 🔹 Tabel Ringkasan Usulan Terbaru -->
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Usulan Mutasi Terbaru</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tableUsulan" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Usulan</th>
                                <th>Nama Guru</th>
                                <th>Sekolah Asal</th>
                                <th>Sekolah Tujuan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="latestUsulanBody">
                            <tr><td colspan="6" class="text-center">Loading...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Script Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    let yearSelect = document.getElementById("filterTahun");

    // Ambil daftar tahun dari database
    fetch("<?= base_url('dashboard/getAvailableYears'); ?>")
        .then(response => response.json())
        .then(years => {
            yearSelect.innerHTML = ""; // Kosongkan dropdown

            if (years.length === 0) {
                yearSelect.innerHTML = "<option value=''>Tidak Ada Data</option>";
                return;
            }

            years.forEach(year => {
                let option = document.createElement("option");
                option.value = year;
                option.textContent = year;
                yearSelect.appendChild(option);
            });

            // Pilih tahun terbaru secara default & load chart + tabel
            yearSelect.value = years[0];
            loadCharts(years[0]);
            loadLatestUsulan();
        })
        .catch(error => console.error("Error fetching available years:", error));

    function loadCharts(year) {
        fetch(`<?= base_url('dashboard/getChartData'); ?>?year=${year}`)
            .then(response => response.json())
            .then(data => {
                console.log("Data Chart:", data); // Debugging console.log

                if (window.barChart) {
                    window.barChart.destroy();
                }
                if (window.pieChart) {
                    window.pieChart.destroy();
                }

                // Cek apakah data untuk grafik tidak kosong
                let isDataEmpty = data.usulan_per_bulan.every(val => val === 0);
                let isPieEmpty = data.data_pie.every(val => val === 0);

                // Bar Chart: Usulan per Bulan
                let ctx = document.getElementById("chartUsulan").getContext("2d");
                window.barChart = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: data.labels_bulan,
                        datasets: [{
                            label: "Jumlah Usulan",
                            data: data.usulan_per_bulan,
                            backgroundColor: "rgba(54, 162, 235, 0.6)",
                            borderColor: "rgba(54, 162, 235, 1)",
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: !isDataEmpty },
                            tooltip: { enabled: !isDataEmpty }
                        },
                        scales: {
                            y: { beginAtZero: true }
                        }
                    }
                });

                // Pie Chart: Distribusi Status Usulan
                let ctxPie = document.getElementById("chartPie").getContext("2d");
                window.pieChart = new Chart(ctxPie, {
                    type: "pie",
                    data: {
                        labels: data.labels_pie,
                        datasets: [{
                            data: data.data_pie,
                            backgroundColor: ["#FFC107", "#28A745", "#DC3545"]
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: !isPieEmpty },
                            tooltip: { enabled: !isPieEmpty }
                        }
                    }
                });
            })
            .catch(error => console.error("Error fetching chart data:", error));
    }

    function loadLatestUsulan() {
        fetch("<?= base_url('dashboard/getLatestUsulan'); ?>")
            .then(response => response.json())
            .then(data => {
                let tableBody = document.getElementById("latestUsulanBody");
                tableBody.innerHTML = ""; // Kosongkan tabel sebelum isi ulang

                if (data.length === 0) {
                    tableBody.innerHTML = "<tr><td colspan='6' class='text-center'>Tidak ada usulan terbaru</td></tr>";
                    return;
                }

                data.forEach((usulan, index) => {
                    let statusLabel = getStatusBadge(usulan.status);
                    tableBody.innerHTML += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${usulan.nomor_usulan}</td>
                            <td>${usulan.guru_nama}</td>
                            <td>${usulan.sekolah_asal}</td>
                            <td>${usulan.sekolah_tujuan}</td>
                            <td>${statusLabel}</td>
                        </tr>
                    `;
                });
            })
            .catch(error => console.error("Error fetching latest usulan:", error));
    }

    function getStatusBadge(status) {
        let badgeColor;
        switch (status) {
            case "01": badgeColor = "badge badge-primary"; break;
            case "02": badgeColor = "badge badge-info"; break;
            case "03": badgeColor = "badge badge-warning"; break;
            case "04": badgeColor = "badge badge-secondary"; break;
            case "05": badgeColor = "badge badge-success"; break;
            case "06": badgeColor = "badge badge-dark"; break;
            case "07": badgeColor = "badge badge-danger"; break;
            default: badgeColor = "badge badge-light";
        }
        return `<span class="${badgeColor}">${status}</span>`;
    }

    // Update chart & tabel saat tahun berubah
    yearSelect.addEventListener("change", function() {
        loadCharts(this.value);
        loadLatestUsulan();
    });
});
</script>




<?= $this->endSection(); ?>
