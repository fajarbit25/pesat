<div class="col-sm-12">
    <div class="row">
        
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="fw-bold text-primary">
                                Catatan Operational
                            </span>
                        </div>
                        <div class="col-sm-6 text-end">
                            <a href="javascript:void(0)" wire:click="modalAdd()" class="btn btn-primary btn-sm">Tambah</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if($items)
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="col-sm-12">
                                    <div class="input-group input-group-outline mb-3">
                                      <input type="month" class="form-control" wire:model.live="monthYear">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group input-group-outline mb-3">
                                    <select class="form-control" wire:model.live="tipeFilter">
                                      <option value="">-- Semua --</option>
                                      <option value="BBM">BBM</option>
                                      <option value="Komsumsi">Komsumsi</option>
                                      <option value="Tagihan">Tagihan</option>
                                      <option value="ATK">ATK</option>
                                      <option value="Lainnya">Lainnya</option>
                                    </select>
                                  </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group input-group-outline mb-3">
                                    <input type="text" class="form-control" value="Row : {{number_format($items->count())}}" disabled>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group input-group-outline mb-3">
                                    <input type="text" class="form-control" value="Jumlah : {{number_format($items->sum('amount'))}}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered" style="font-size: 12px;">
                            <thead>
                                <tr class="bg-light">
                                    <th> NO </th>
                                    <th> TANGGAL </th>
                                    <th> JENIS </th>
                                    <th> NAMA </th>
                                    <th colspan="2"> KETERANGAN </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($items)
                                @foreach($items as $item)
                                <tr>
                                    <td> <span class="mx-3"> {{$loop->iteration}} </span> </td>
                                    <td> <span class="mx-3"> {{$item->date}} </span> </td>
                                    <td> <span class="mx-3"> {{strtoupper($item->tipe)}} </span> </td>
                                    <td> <span class="mx-3"> {{$item->name}} </span> </td>
                                    <td> <span class="mx-3"> {{$item->noted}} </span> </td>
                                    <td> 
                                        <a href="javascript:void(0)" wire:click="confirmDelete({{$item->id}})" class="fw-bold text-danger">
                                        <span class="mx-3"> Hapus </span> 
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5">{{$items->links()}}</td>
                                </tr>

                                @if($items->count() <= 0)
                                <tr>
                                    <td colspan="5">Belum ada data</td>
                                </tr>
                                @endif
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
        <form wire:submit.prevent="saveRecord()">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalAddLabel">Tambah Catatan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <div class="col-sm-12">
                        <label for="tanggal">Tanggal <span class="fw-bold text-danger">*</span></label>
                        <div class="input-group input-group-outline mb-3">
                          <input type="date" class="form-control" wire:model="tanggal">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="tipe">Jenis <span class="fw-bold text-danger">*</span></label>
                        <div class="input-group input-group-outline mb-3">
                          <select class="form-control" wire:model="tipe">
                            <option value="">- Jenis Pengeluaran --</option>
                            <option value="BBM">BBM</option>
                            <option value="Komsumsi">Komsumsi</option>
                            <option value="Tagihan">Tagihan</option>
                            <option value="ATK">ATK</option>
                            <option value="Lainnya">Lainnya</option>
                          </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="amount">Jumlah <span class="fw-bold text-danger">*</span> @if($amount) ({{number_format($amount)}}) @endif </label>
                        <div class="input-group input-group-outline mb-3">
                          <input type="number" class="form-control" wire:model.live="amount">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="noted">Catatan <span class="fw-bold text-danger">*</span></label>
                        <div class="input-group input-group-outline mb-3">
                          <textarea class="form-control" rows="4" wire:model="noted"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" >Simpan</button>
            </div>
        </div>
        </form>
        </div>
    </div>


    @push('scripts')
    <script>
        window.addEventListener('modalAdd', function() {
            $("#modalAdd").modal('show');
        });

        window.addEventListener('closeModal', function() {
            $("#modalAdd").modal('hide');
        });

        window.addEventListener('alert', function(event){
          Swal.fire({
                title: event.detail[0].title,
                text: event.detail[0].message,
                icon: event.detail[0].icon,
              });
        });

        window.addEventListener('confirmDelete', function() {
          Swal.fire({
            title: "Are you sure?",
            text: "Yakin ingin menghapus?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Lanjutkan"
          }).then((result) => {
            if (result.isConfirmed) {
                // Call Livewire method to delete the file
                //this.Livewire.emit('deleting');
                Livewire.dispatch('deleting')
            } else {
              Swal.fire({
                title: "Cancelled",
                text: "Your data is safe!.",
                icon: "error"
              });
            }
          });
        });
    </script>
    @endpush

</div>