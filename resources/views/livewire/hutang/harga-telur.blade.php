<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <span class="fw-bold text-primary">Harga Telur</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="level">Pilih Jenis Pelanggan </label>
                            <div class="input-group input-group-outline mb-3">
                            <select class="form-control" wire:model.live="level">
                                <option value="">-- Pilih Jenis Pelanggan</option>
                                <option value="3">Costumer</option>
                                <option value="5">Buyer</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label for="level">Cari Nama Pelanggan </label>
                            <div class="input-group input-group-outline mb-3">
                            <input type="search" class="form-control" wire:model.live="key">
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered" style="font-size: 12px;">
                            <thead>
                                <tr class="bg-light">
                                    <th class="m-0">NO</th>
                                    <th class="m-0">Nama</th>
                                    <th class="m-0">Alamat</th>
                                    <th class="m-0">Telur Besar</th>
                                    <th class="m-0">Telur Kecil</th>
                                    <th class="m-0">Edit</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if($items)
                                @foreach($items as $item)
                                <tr @if($item->id == $userid || $item->id == $effectid) class="bg-light" @endif>
                                    <td> <span class="mx-3"> {{$loop->iteration}} </span> </td>
                                    <td> <span class="mx-3"> {{$item->name}} </span> </td>
                                    <td> <span class="mx-3"> {{$item->address}} </span> </td>
                                    <td> 
                                        @if($item->id == $userid)
                                            <input type="text" class="mx-3" wire:model="big">
                                        @else
                                        <span class="mx-3"> {{$item->big}} </span>
                                        @endif 
                                    </td>
                                    <td>
                                        @if($item->id == $userid)
                                            <input type="text" class="mx-3" wire:model="small">
                                        @else 
                                        <span class="mx-3"> {{$item->small}} </span> 
                                        @endif
                                    </td>
                                    <td> 
                                        <span class="mx-3">
                                            @if($item->id == $userid)
                                                <a href="javascript:void(0)" wire:click="saveEdit()" class="fw-bold text-success"> Simpan </a>
                                            @else 
                                                <a href="javascript:void(0)" wire:click="edit({{$item->id}})" class="fw-bold text-primary"> Edit </a>
                                            @endif
                                        </span> 
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6"> {{$items->links()}} </td>
                                </tr>
                                @endif
                                @if($items->count() <= 0) 
                                    <tr>
                                        <td colspan="6"> <span class="fw-bold text-primary">Data tidak ditemukan!</span> </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>