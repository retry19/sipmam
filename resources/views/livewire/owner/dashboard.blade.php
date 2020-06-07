<div class="row">
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info">
                <i class="fas fa-cart-plus"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Pesanan</span>
                <span class="info-box-number">{{ $countPesanan }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-success">
                <i class="fas fa-book"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Jumlah Menu</span>
                <span class="info-box-number">{{ $countMenu }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-warning">
                <i class="fas fa-chart-bar"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Rata-rata pesanan (hari)</span>
                <span class="info-box-number">{{ round($avgPesananPerDay[0]->rata) }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-danger">
                <i class="fas fa-funnel-dollar"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Pemasukan</span>
                <span class="info-box-number">{{ $this->hargaFormat($totalBayar - $kembali) }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Pelanggan</h3>
                    <a href="{{ route('owner.pesanan-all') }}">Lihat Detail</a>
                </div>
            </div>
            <div class="card-body">
                <div class="position-relative mb-4">
                    <canvas id="canvas-pelanggan" height="200"></canvas>
                </div>
                <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2">
                        <i class="fas fa-square text-primary"></i> Tahun ini
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Pemasukan</h3>
                    <a href="{{ route('owner.transaksi-all') }}">Lihat Detail</a>
                </div>
            </div>
            <div class="card-body">
                <div class="position-relative mb-4">
                    <canvas id="canvas-income" height="200"></canvas>
                </div>
                <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2">
                        <i class="fas fa-square text-primary"></i> Tahun ini
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let url1 = "{{ url('api/income/chart') }}";
    let url2 = "{{ url('api/pelanggan/chart') }}";
    let incomes = [];
    let month = [];
    let pelanggan = [];
    let month2 = [];

    $(document).ready(() => {
        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        };

        var mode = 'index';
        var intersect = true;

        $.get(url1, res => {
            res.forEach(el => {
                incomes.push(el.total_bayar - el.kembali);
                month.push(el.month);
            });

            let ctx = document.getElementById('canvas-income').getContext('2d');
            let myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: month,
                    datasets: [{
                        label: 'Pemasukan',
                        backgroundColor: '#007bff',
                        borderColor: '#007bff',
                        data: incomes,
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: true,
                                lineWidth: '4px',
                                color: 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                            },
                            ticks: $.extend({
                                beginAtZero:true,
                                callback: (value) => {
                                    if (value >= 1000) {
                                        value /= 1000;
                                        value += 'k';
                                    }
                                    return `Rp. ${value}`;
                                }
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false
                            },
                            ticks: ticksStyle
                        }]
                    }
                }
            });
        });

        $.get(url2, res => {
            res.forEach(el => {
                pelanggan.push(el.pelanggan);
                month2.push(el.month);
            });

            let ctx = document.getElementById('canvas-pelanggan').getContext('2d');
            let myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: month2,
                    datasets: [{
                        label: 'Pelanggan',
                        backgroundColor: 'transparent',
                        borderColor: '#007bff',
                        pointBorderColor: '#007bff',
                        pointBackgroundColor: '#007bff',
                        fill: false,
                        data: pelanggan,
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: true,
                                lineWidth: '4px',
                                color: 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                            },
                            ticks: $.extend({
                                beginAtZero:true
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false
                            },
                            ticks: ticksStyle
                        }]
                    }
                }
            });
        });
    });
</script>
