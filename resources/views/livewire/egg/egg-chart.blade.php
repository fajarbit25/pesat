<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12 mb-3">
            <div class="card mt-5">
                <h3 class="card-header p-3">{{ $name }}</h3>
                <div class="card-body">
                    <canvas id="myChart" height="120px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h6>Tabel Mutasi Stok</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Total Stok Masuk</th>
                                    <th>Total Stok Keluar</th>
                                    <th>Revisi Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($labels as $index => $label)
                                <tr>
                                    <td>{{ $label }}</td>
                                    <td>{{ number_format($data1[$index]) }}</td>
                                    <td>{{ number_format($data2[$index]) }}</td>
                                    <td> {{number_format($restock[$index])}} </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script type="text/javascript">
        var labels = {{ Js::from($labels) }};
        var data1 = {{ Js::from($data1) }};
        var data2 = {{ Js::from($data2) }};

        const data = {
            labels: labels,
            datasets: [
                {
                    label: 'Total Stok Masuk',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: data1,
                    fill: false,
                },
                {
                    label: 'Total Stok Keluar',
                    backgroundColor: 'rgb(54, 162, 235)',
                    borderColor: 'rgb(54, 162, 235)',
                    data: data2,
                    fill: false,
                }
            ]
        };

        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Total Stok'
                        }
                    }
                }
            }
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
    @endpush
</div>
