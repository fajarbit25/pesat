<div class="col-sm-12">
    <div class="row">

        @session('success')
        <div class="col-sm-12">
            <div class="alert alert-success alert-dismissible text-white" role="alert">
                <span class="text-sm"> {{session('success')}} </span>
                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endsession

        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6"> <span class="fw-bold text-primary">Detail Pembelian</span> </div>
                        <div class="col-sm-6 text-end">
                            <a href="{{url('egg/'.$userid.'/outbound')}}" class="btn btn-primary btn-sm">Tambah</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-4">
                                <div class="input-group input-group-outline">
                                  <input type="month" class="form-control mx-2"  wire:model.live="month">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="table-responsive">
                                <table class="table table-bordered" style="font-size: 12px;">
                                    <thead>
                                        <tr class="bg-light">
                                            <th>Tanggal</th>
                                            <th>Id Transaksi</th>
                                            <th>Produk</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($items)
                                        @foreach ($items as $item)
                                        <tr>
                                            <td> {{$item->tanggal}} </td>
                                            <td> {{$item->idtransaksi}} </td>
                                            <td> {{$item->name}} </td>
                                            <td> {{number_format($item->qty)}} </td>
                                            <td> {{number_format($item->price)}} </td>
                                            <td> {{number_format($item->total)}} </td>
                                            <td>
                                                @if($item->payment_status == 'lunas')
                                                    <span class="fw-bold text-success">Lunas</span>
                                                @else 
                                                    <span class="fw-bold text-danger">Pending</span>
                                                @endif
                                            </td>
                                            <td> {{$item->keterangan}} </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                        <tr>
                                            <td colspan="5"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="table-responsive">
                                <table class="table table-bordered" style="font-size:12px;">
                                    <thead>
                                        <tr class="bg-light">
                                            <th colspan="2">Detail Pelanggan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Nama</th>
                                            <td>: {{$users->name}} </td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>: {{$users->address}} </td>
                                        </tr>
                                        <tr>
                                            <th>No Handphone</th>
                                            <td>: {{$users->phone}} </td>
                                        </tr>
                                        <tr>
                                            <th>Level</th>
                                            <td>: {{$users->level}} </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
