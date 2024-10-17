<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-4">
            <div class="card  mb-2">
                <div class="card-header p-3 pt-2">
                  <div class="icon icon-lg icon-shape bg-gradient-success shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">payments</i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Total Transaksi</p>
                    <h4 class="mb-0">Rp.{{number_format($sumTx) ?? 0}},-</h4>
                  </div>
                </div>
          
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <span class="fw-bold">Table Penjualan</span>
                </div>
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" style="font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($items)
                                            @if($items->count() != 0)
                                            @foreach($items as $item)
                                            <tr>
                                                <td> {{$loop->iteration}} </td>
                                                <td> {{$item->code}} </td>
                                                <td> {{$item->name}} </td>
                                                <td> {{number_format($item->price)}} </td>
                                                <td> <a href="javascript:void(0);" wire:click="editQty({{$item->id}})" class="text-primary fw-bold">{{$item->qty}}</a> </td>
                                                <td> {{number_format($item->total)}} </td>
                                                <td>
                                                    <a href="javascript:void(0);" wire:click="deleteTemp({{$item->id}})" class="text-danger fw-bold">Hapus</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan="7"> <span class="fw-bold">Belum ada transaksi!</span> </td>
                                            </tr>
                                            @endif
                                        @endif
                                        <tr>
                                            <td colspan="7"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <button type="button" class="btn btn-info btn-sm" wire:click="modalAdd"><i class="material-icons opacity-10">add</i> Tambah Item</button>
                        </div>
                        <div class="col-sm-6 text-end">
                            <button type="button" class="btn btn-success btn-sm" wire:click="modalPayment"><i class="material-icons opacity-10">sync</i> Proses</button>
                        </div>
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalAddLabel">Data Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="input-group input-group-outline mb-3">
                            <input type="search" wire:model.live="key" class="form-control" placeholder="Cari telur">
                        </div>
                    </div>
                    <hr class="dark horizontal my-2">
                    <div class="col-sm-12">
                        <span class="fw-bold">Table Telur</span>
                        <table class="table" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($products)
                                @foreach($products as $item)
                                <tr>
                                    <td> <a href="javascript:void(0);" wire:click="addproducts({{$item->id}})" class="text-primary fw-bold">{{$item->code}}</a>  </td>
                                    <td> {{$item->name}} </td>
                                    <td> {{number_format($item->stock)}} </td>
                                    <td> {{number_format($item->price)}} </td>
                                </tr>
                                @endforeach
                                @endif
                                <tr>
                                    <td colspan="4"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalEditQty" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditQtyLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEditQtyLabel">Edit Quantity</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <label for="qty">Qty <span class="text-danger">*</span> </label>
                        <div class="input-group input-group-outline mb-3">
                          <input type="number" class="form-control" wire:model="qty">
                        </div>
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" wire:click="updateQty">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalPayment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalPaymentLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalPaymentLabel">Proses</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <label for="sumTx">Total Transaksi <span class="text-danger">*</span> </label>
                        <div class="input-group input-group-outline">
                          <h3 class="fw-bold mx-2">Rp.{{number_format($sumTx)}},-</h3>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="disc">Diskon <span class="fw-bold">(Rp.{{ number_format((float)($disc ?? 0)) }})</span></label>
                        <div class="input-group input-group-outline mb-3">
                          <input type="number" class="form-control" wire:model.live="disc">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="tanggal">Tanggal <span class="fw-bold">*</span></label>
                        <div class="input-group input-group-outline mb-3">
                          <input type="date" class="form-control" wire:model="tanggal">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="status">Status <span class="fw-text-danger">*</span></label>
                        <div class="input-group input-group-outline mb-3">
                          <select class="form-control" wire:model.live="status">
                            <option value="">- Pilih Status --</option>
                            <option value="lunas">Lunas</option>
                            <option value="pending">pending</option>
                          </select>
                        </div>
                    </div>
                    @if($status == 'pending')
                    <div class="col-sm-12">
                        <label for="supplier">Suplier <span class="fw-text-danger">*</span></label>
                        <div class="input-group input-group-outline mb-3">
                          <select class="form-control" wire:model="supplier">
                            <option value="">- Pilih Suplier --</option>
                            @foreach($dataSupplier as $supp)
                            <option value="{{$supp->id}}">{{$supp->name}}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>
                    @endif
                    <div class="col-sm-12">
                        <label for="disc">Input Jumlah Transaksi <span class="text-danger">*</span> <span class="fw-bold">(Rp.{{ number_format((float)($pay ?? 0)) }})</span></label>
                        <div class="input-group input-group-outline mb-3">
                          <input type="number" class="form-control" wire:model.live="pay">
                        </div>
                    </div>
                    @error('pay')<span class="fw-bold text-danger">Masukan jumlah pembayaran.</span>@enderror <br/>
                    @error('status')<span class="fw-bold text-danger">Status Pembayaran wajib diisi.</span>@enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" wire:click="prosesPayment">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        window.addEventListener('modalAdd', function() {
            $("#modalAdd").modal('show');
        });
        window.addEventListener('modalEditQty', function() {
            $("#modalEditQty").modal('show')
        });
        window.addEventListener('modalPayment', function() {
            $("#modalPayment").modal('show')
        });
        window.addEventListener('modalPelanggan', function() {
            $("#modalPelanggan").modal('show')
        });

        window.addEventListener('closeModal', function() {
            $("#modalAdd").modal('hide');
            $("#modalEditQty").modal('hide')
            $("#modalPayment").modal('hide')
            $("#modalPelanggan").modal('hide')
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