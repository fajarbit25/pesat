<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-primary">Laporan Pemasukan Telur</h3>
                    <p>
                        <span class="fw-bold">Tanggal :</span> <input type="date" wire:model="tanggal" style="padding: 2px; border:0px;">
                    </p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th class="text-primary">NO</th>
                                    <th class="text-primary">NAMA</th>
                                    @if($items)
                                    @foreach($items->sortBy('egg_id')->groupBy('egg_id') as $idTelur => $item)
                                        <th class="text-primary">{{$item->first()->telur}}</th>
                                    @endforeach
                                    @endif
                                    <th class="text-primary">KET</th>
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

                                    <td> {{$item->first()->keterangan}} </td>
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
    </div>
</div>