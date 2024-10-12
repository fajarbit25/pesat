<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-primary">Laporan Pemasukan Telur {{$tanggal}}</h3>
                    <p>
                        <span class="fw-bold">Tanggal :</span> <input type="date" wire:model.live="tanggal" style="padding: 2px; border:0px;">
                    </p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" style="font-size: 12px;">
                            <thead>
                                <tr class="bg-light">
                                    <th class="text-primary">NO</th>
                                    <th class="text-primary">NAMA</th>
                                    @if($items)
                                    @foreach($items->sortBy('egg_id')->groupBy('egg_id') as $idTelur => $item)
                                        <th class="text-primary">{{$item->first()->telur}}</th>
                                    @endforeach
                                    @endif
                                    <th class="text-primary" colspan="2">KET</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($items)
                                @foreach($items->groupBy('userid') as $userid => $item)
                                <tr>
                                    <th class="text-primary"> {{$loop->iteration}} </th>
                                    <th class="text-primary"> {{$item->first()->name}} </th>
                                    @foreach($items->sortBy('egg_id')->groupBy('egg_id') as $idTelur => $telurItems)
                                        <td>
                                            @php
                                                $stock = $telurItems->where('egg_id', $idTelur)->where('userid', $userid)->sum('qty');
                                            @endphp
                                            {{number_format($stock)}}
                                        </td>
                                    @endforeach

                                    <td> {{$item->first()->keterangan ?? "-"}} </td>
                                    <td> <a href="javascript:void(0)" class="fw-bold text-success">Edit</a>  </td>
                                </tr>
                                @endforeach
                                @endif
                                <td>
                                    <td colspan="6"></td>
                                </td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                     <span class="fw-bold text-primary">Total Laporan Harian</span>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>Jemputan</td>
                                <td> {{number_format($items->sum('qty'))}} </td>
                            </tr>
                            <tr>
                                <td>Stok Awal</td>
                                <td>
                                    {{number_format($stockAwal)}}
                                </td>
                            </tr>
                            <tr class="bg-light">
                                <td>Telur Jalan</td>
                                <td> {{number_format($stockOut)}} </td>
                            </tr>
                            <tr class="bg-light">
                                <td>Stok Sisa</td>
                                <td> {{number_format($items->sum('qty')+$stockAwal-$stockOut)}} </td>
                            </tr>
                            <tr>
                                <th>Selisih</th>
                                <th>
                                    @php
                                        
                                        $a = $items->sum('qty')+$stockAwal; //jemputan + stock awal
                                        $sisa = $a-$stockOut; //jemputan + stock awal - penjualan = sisa stock
                                        $b = $stockOut+$sisa; //penjualan + sisa stock

                                        $selisih = $a-$b;

                                    @endphp
                                    {{number_format($selisih)}}
                                </th>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>