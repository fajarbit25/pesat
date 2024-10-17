<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="fw-bold">Penjualan Telur</span>
                        </div>
                        <div class="col-sm-6 text-end">
                            <a href="{{route('hargaTelur')}}" class="btn btn-success btn-sm mx-2"> Harga Telur </a>
                        </div>
                    </div>
                </div>
                <div class="card-body m-0">
                    <table class="table" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pembeli</th>
                                <th>Alamat</th>
                                <th>Jumlah Utang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($items)
                            @foreach($items as $item)
                            <tr>
                                <td> {{$loop->iteration}} </td>
                                <td> {{$item->name}} </td>
                                <td> {{$item->address}} </td>
                                <td> <span class="fw-bold"> Rp.{{number_format($item->hutang)}},-</span></td>
                                <td>
                                    <a href="buyer/{{$item->id}}/detail" class="text-primary fw-bold mx-2">Pilih</a>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="5"> {{$items->links()}} </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>