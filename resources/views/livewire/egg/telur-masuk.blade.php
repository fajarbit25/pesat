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
            <div class="col-sm-12">
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
            
            <div class="col-sm-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <span class="fw-bold text-primary">Laporan Harian Manual</span>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-4">
                              <label for="jemputan" class="col-form-label">Jemputan</label>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-outline">
                                    <input type="number" class="form-control" wire:model.live="jemputan" >
                                </div>
                            </div>
                            <div class="col-2">
                                <span class="fw-bold">
                                    @if($jemputan == "")
                                    -
                                    @else
                                    {{number_format($jemputan ?? 0)}}
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-4">
                              <label for="sAwal" class="col-form-label">Stock Awal</label>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-outline">
                                    <input type="number" class="form-control" wire:model.live="sAwal" >
                                </div>
                            </div>
                            <div class="col-2">
                                <span class="fw-bold">
                                    @if($sAwal == "")
                                    -
                                    @else
                                    {{number_format($sAwal ?? 0)}}
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-4">
                              <label for="tJalan" class="col-form-label">Telur Jalan</label>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-outline">
                                    <input type="number" class="form-control" wire:model.live="tJalan" >
                                </div>
                            </div>
                            <div class="col-2">
                                <span class="fw-bold">
                                    @if($tJalan == "")
                                    -
                                    @else
                                    {{number_format($tJalan ?? 0)}}
                                    @endif
                                </span>
                            </div>
                        </div>
                            @php
                                if ( $jemputan && $sAwal && $tJalan) {
                                    $stockAkhir = $jemputan+$sAwal-$tJalan;

                                    $a = $jemputan+$sAwal;
                                    $b = $tJalan+$stockAkhir;

                                    $selisih = $a-$b;
                                } else {
                                    $stockAkhir = 0;
                                    $selisih = 0;
                                }
                            @endphp
                        <div class="row align-items-center">
                            <div class="col-4">
                              <label for="sAkhir" class="col-form-label">Stock Akhir</label>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-outline">
                                    <input type="number" class="form-control" value="{{$stockAkhir}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-4">
                              <label for="selisih" class="col-form-label">Selisih</label>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-outline">
                                    <input type="number" class="form-control" value="{{$selisih}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-4">
                              <label for="catatan" class="col-form-label">Catatan</label>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-outline">
                                    <textarea class="form-control" rows="3" wire:model.live="catatan"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-10 mt-3 text-end">
                            <button type="button" wire:click="saveReportManual" class="btn btn-primary"> Simpan </button>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        window.addEventListener('alert', function(event){
          Swal.fire({
                title: event.detail[0].title,
                text: event.detail[0].message,
                icon: event.detail[0].icon,
              });
        });
    </script>
    @endpush
</div>