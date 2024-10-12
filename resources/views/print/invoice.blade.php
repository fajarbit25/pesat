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
</head>
<body>
    <div class="container">
        <div class="row mt-3">
            <div class="col-6">
                <h1>INVOICE</h1>
            </div>
            <div class="col-4 text-end">
                <h5 class="fw-light m-0"> {{$store->storename}} </h5>
                <h5 class="fw-light m-0"> {{$store->slogan}} </h5>
            </div>
            <div class="col-2">
                <img src="{{asset('assets/img/favicon.png')}}" alt="Logo" height="60">
            </div>

            <div class="col-sm-12">
                <hr class="horizontal dark my-2">
            </div>

            <div class="col-6 mt-3">
                <span class="fw-bold">KEPADA :</span><br/>
                <span class="fw-light"> {{$invto->name}} </span><br/>
                <span class="fw-light"> {{$invto->email}} </span>
            </div>
            <div class="col-6 mt-3 text-end">
                <span class="fw-bold">TANGGAL :</span><br/>
                <span class="fw-light"> {{$tanggal}} </span><br/>

                <span class="fw-bold mt-4">NOMOR :</span><br/>
                <span class="fw-light"> INV/{{time()}}/{{$bulan}} </span><br/>
            </div>

            <div class="col-sm-12">
                <hr class="horizontal dark my-3">
            </div>

            <div class="col-12">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th> <span class="d-flex"> KETERANGAN </span></th>
                            <th> <span class="d-flex"> HARGA </span></th>
                            <th> <span class="d-flex"> JUMLAH </span></th>
                            <th> <span class="d-flex"> TOTAL </span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($temp as $item)
                        <tr class="table-secondary">
                            <td class="m-0">
                                <span class="d-flex fw-light">
                                    {{$item->code.' '.$item->name}} 
                                </span>
                            </td>
                            <td class="m-0"> <span class="d-flex fw-light"> {{number_format($item->price)}} </span> </td>
                            <td class="m-0"> <span class="d-flex fw-light"> {{number_format($item->qty)}} </span> </td>
                            <td class="m-0"> <span class="fw-light"> {{number_format($item->total)}} </span> </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-6 mt-5">
                <span class="fw-bold mt-4">PEMBAYARAN :</span><br/>
                <span class="fw-light"> Nama : {{session('store')->storename}} </span><br/>
                <span class="fw-light"> {{$store->norek}} </span><br/>
            </div>
            <div class="col-6 mt-5">
                <div class="row">
                    <div class="col-6 text-end">
                        <span class="fw-light">SUB TOTAL :</span><br/>
                        <span class="fw-light">PAJAK :</span><br/>
                        <span class="fw-bold">TOTAL :</span><br/>
                    </div>
                    <div class="col-6 text-end">
                        <span class="fw-light">Rp.{{number_format($total)}},-</span><br/>
                        <span class="fw-light">Rp.{{number_format($total*0.11)}},-</span><br/>
                        <span class="fw-bold">Rp.{{number_format($total*0.11+$total)}},-</span><br/>
                    </div>
                </div>
            </div>
            <div class="col-6 mt-5">
                <br/><br/><br/>
                <h5 class="fw-bold">
                    TERIMA KASIH ATAS <br/>
                    PEMBELIAN ANDA
                </h5>
            </div>
            <div class="col-6 mt-5 text-center">
                <br/><br/><br/><br/><br/>
                <span class="fw-light text-decoration-underline mt-5">
                    ( {{$store->name}} )
                </span>
            </div>
        </div>
    </div>

    <script>
        //window.print();
    </script>
</body>
</html>