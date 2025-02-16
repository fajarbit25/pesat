<div class="col-sm-12">
    <div class="row">

        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="fw-bold text-primary">Laporan Barang</span>
                        </div>
                    </div>
                </div>
                <div class="card-body m-0">

                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="input-group input-group-outline mb-3">
                                    <input type="month" class="form-control" wire:model="bulan">
                                </div>
                                @error('bulan')
                                <div class="form text text-danger"> <span class="fw-bold">Bulan harus diisi!</span> </div>
                                @enderror
                            </div>

                            <div class="col-sm-3">
                                <div class="input-group input-group-outline mb-3">
                                <select wire:model="jenis" class="form-control">
                                    <option value="">--Pilih Jenis Transaksi--</option>
                                    <option value="pembelian">Barang Masuk</option>
                                    <option value="penjualan">Barang Keluar</option>
                                </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="input-group input-group-outline mb-3">
                                <input type="search" class="form-control" placeholder="Masukan kode barang" wire:model="code">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-primary" wire:click="loadReport()">Tampilkan</button>
                            </div>

                            @if ($items)

                            <div class="col-sm-3">
                                <div class="input-group input-group-outline mb-3">
                                <input type="text" class="form-control" value="Total - Rp.{{number_format($items->sum('totalprice'))}},-" disabled>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group input-group-outline mb-3">
                                <input type="text" class="form-control" value="Total : Rp.{{number_format($items->sum('disc'))}},-" disabled>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group input-group-outline mb-3">
                                <input type="text" class="form-control" value="Grand Total : Rp.{{number_format($items->sum('totalprice')-$items->sum('disc'))}},-" disabled>
                                </div>
                            </div>

                            @endif
                            
                        </div>
                    </div>

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

                    <div class="table-responsive">
                        <table class="table" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Barang</th>
                                    <th>Jenis</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($items)
                                @foreach ($items as $item)
                                <tr>
                                    <td> {{$loop->iteration}} </td>
                                    <td> {{substr($item->created_at, 0, 10)}} </td>
                                    <td> {{$item->code.' - '.$item->name}} </td>
                                    <td> {{$item->trxtipe}} </td>
                                    <td> {{number_format($item->qty)}} </td>
                                    <td> {{number_format($item->price)}} </td>
                                    <th> Rp.{{number_format($item->qty*$item->price)}},- </th>
                                    <td> {{$item->payment_status}} </td>
                                </tr>
                                @endforeach
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>


    @push('scripts')
    <script>
        window.addEventListener('modalDetail', function() {
          $("#modalDetail").modal('show');
        });

        window.addEventListener('closeModal', function() {
          $("#modalDetail").modal('hide');
        });

        window.addEventListener('confirmEdit', function() {
          Swal.fire({
            title: "Are you sure?",
            text: "Yakin ingin mengedit transaksi?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Lanjutkan"
          }).then((result) => {
            if (result.isConfirmed) {
                // Call Livewire method to delete the file
                //this.Livewire.emit('deleting');
                Livewire.dispatch('editing')
            } else {
              Swal.fire({
                title: "Cancelled",
                text: "Your data is safe!.",
                icon: "error"
              });
            }
          });
        });

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