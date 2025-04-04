<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
    <title>{{$title}}</title>
    
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link rel="stylesheet" href="{{asset('assets/css/invoice.css')}}">
    <link id="pagestyle" href="{{asset('assets/css/material-dashboard.css?v=3.0.0')}}" rel="stylesheet" />
    <style>
        table td, table th {
            font-size: 11px;
        }
    </style>
</head>
<body>
    <div class="row mt-3 p-3">
        <div class="col-6">
            <h2>LAPORAN TRANSAKSI</h2>
            <h5 class="fw-bold m-0">Periode {{$bulan}}</h5>
        </div>
        <div class="col-4 text-end">
            <h5 class="fw-light m-0"> CV. ASYLA TERNAK </h5>
            <h5 class="fw-light m-0"> ENREKANG </h5>
        </div>
        <div class="col-2">
            <img src="{{asset('assets/img/favicon.png')}}" alt="Logo" height="60">
        </div>

        <div class="col-sm-12">
            <hr class="horizontal dark my-2">
        </div>

        <div class="col-6 mt-3">
            <span class="fw-bold">PELANGGAN :</span><br/>
            <span class="fw-bold"> Nama : </span> <span class="fw-light"> {{$user->name}} </span><br/>
            <span class="fw-bold"> Handphone : </span> <span class="fw-light"> {{$user->phone}} </span><br/>
            <span class="fw-bold"> Alamat : </span> <span class="fw-light"> {{$user->address}} </span>
        </div>
        <div class="col-6 mt-3 text-end">
            <span class="fw-bold">TOTAL TRANSAKSI :</span><br/>
            <span class="fw-bold"> Pengambilan : </span> <span> Rp.{{number_format($produks->sum('total'))}},- </span><br/>
            <span class="fw-bold"> Telur Masuk : </span> <span> Rp.{{number_format($telurs->sum('total'))}},- </span><br/>
            <span class="fw-bold"> Sisa Bulan {{$bulan}} : </span> <span> Rp.{{number_format($telurs->sum('total')-$produks->sum('total'))}},- </span><br/>
        </div>

        <div class="col-sm-12">
            <hr class="horizontal dark my-3">
        </div>

        <div class="col-6">
            <table class="table mb-0">
                <thead>
                    <tr class="table-secondary">
                        <th> <span class="d-flex"> TANGGAL </span></th>
                        <th> <span class="d-flex"> TELUR </span></th>
                        <th> <span class="d-flex"> JUMLAH </span></th>
                        <th> <span class="d-flex"> HARGA </span></th>
                        <th> <span class="d-flex"> TOTAL </span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($telurs as $telur)
                    <tr>
                        <td class="m-0"><span class="d-flex fw-light"> {{substr($telur->tanggal, 0, 10)}} </span></td>
                        <td class="m-0"><span class="d-flex fw-light"> {{$telur->name}} </span></td>
                        <td class="m-0"><span class="d-flex fw-light"> {{number_format($telur->qty)}} </span></td>
                        <td class="m-0"><span class="d-flex fw-light"> Rp.{{number_format($telur->price)}},- </span></td>
                        <td class="m-0"><span class="d-flex fw-light"> Rp.{{number_format($telur->total)}},- </span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-6">
            <table class="table mb-0">
                <thead>
                    <tr class="table-secondary">
                        <th> <span class="d-flex"> TANGGAL </span></th>
                        <th> <span class="d-flex"> PRODUK </span></th>
                        <th> <span class="d-flex"> JUMLAH </span></th>
                        <th> <span class="d-flex"> HARGA </span></th>
                        <th> <span class="d-flex"> TOTAL </span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produks as $produk)
                    <tr>
                        <td class="m-0"><span class="d-flex fw-light"> {{substr($produk->tanggal, 0, 10)}} </span></td>
                        <td class="m-0"><span class="d-flex fw-light"> {{$produk->name}} </span></td>
                        <td class="m-0"><span class="d-flex fw-light"> {{number_format($produk->qty)}} </span></td>
                        <td class="m-0"><span class="d-flex fw-light"> Rp.{{number_format($produk->price)}},- </span></td>
                        <td class="m-0"><span class="d-flex fw-light"> Rp.{{number_format($produk->total)}},- </span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <hr class="horizontal dark my-3">

        <div class="col-6 mt-5">
            <br/><br/><br/>
            <h5 class="fw-bold">
                TERIMA KASIH ATAS <br/>
                PEMBELIAN ANDAxx
            </h5>
        </div>
        <div class="col-6 mt-5 text-center">
            <br/><br/><br/><br/><br/>
            <span class="fw-light text-decoration-underline mt-5">
                CV. ASYLA TERNAK
            </span>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>