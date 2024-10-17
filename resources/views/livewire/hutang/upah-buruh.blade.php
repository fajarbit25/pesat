<div class="col-sm-12">
    <div class="row">

        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="fw-bold text-primary">Upah Buruh</span>
                        </div>
                        <div class="col-sm-6 text-end">
                            <button class="btn btn-primary btn-sm" wire:click="tambahUpah">Tambah</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jumlah Jasa</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($items)
                                @foreach ($items as $item)
                                <tr>
                                    <td> {{$loop->iteration}} </td>
                                    <td> {{$item->name}} </td>
                                    <td> Rp.{{number_format($item->total_upah) ?? 0}},- </td>
                                    <td>
                                        <a href="javascript:void(0)" class="fw-bold text-info mx-2" wire:click="detailJasa({{$item->id}})">Detail</a>
                                        <a href="javascript:void(0)" class="fw-bold text-primary" wire:click="bayarJasa({{$item->id}})">Bayar</a>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4">{{$items->links()}}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
        <div class="modal-content">
            <form wire:submit.prevent="addUpah" method="post">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalTambahLabel">Tambah Upah Buruh</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="userid">Nama <span class="text-danger">*</span> </label>
                        <div class="input-group input-group-outline mb-3">
                          <select class="form-control" wire:model="userid">
                            <option value="">-Pilih nama--</option>
                            @foreach($dataUser as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="amount">Jumlah Jasa <span class="text-danger">*</span> </label>
                        <div class="input-group input-group-outline mb-3">
                          <input type="number" class="form-control" wire:model="amount">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="tanggal">Tanggal Pekerjaan <span class="text-danger">*</span> </label>
                        <div class="input-group input-group-outline mb-3">
                          <input type="date" class="form-control" wire:model="tanggal">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="ket">Keterangan <span class="text-danger">*</span> </label>
                        <div class="input-group input-group-outline mb-3">
                          <textarea class="form-control" wire:model="ket" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            @error('userid') <span class="text-danger">Nama harus diisi!</span><br/>@enderror
            @error('amount') <span class="text-danger">Jumlah harus diisi!</span><br/>@enderror
            @error('ket') <span class="text-danger">Keterangan harus diisi!</span><br/>@enderror
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalDetail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalDetailLabel">Detail Jasa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal/Waktu</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($detail)
                            @foreach($detail as $item)
                            <tr>
                                <td> {{$loop->iteration}} </td>
                                <td> {{$item->created_at}} </td>
                                <td> {{number_format($item->amount)}} </td>
                                <td> {{$item->keterangan}} </td>
                                <td>
                                    <a href="javascript:void(0)" wire:click="confirmDelete({{$item->id}})" class="text-danger fw-bold">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalBayar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalBayarLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalBayarLabel">Bayar Jasa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                @if($detail)
                <div class="col-sm-12">
                    <label for="">Total Jasa </label>
                    <div class="input-group input-group-outline mb-3">
                        <h3 class="fw-bold"> Rp.{{number_format($detail->sum('amount'))}},- </h3>
                </div>
                <div class="col-sm-12">
                    <label for="amount">Input Jumlah Jasa <span class="text-danger">*</span> @if($amount) {{number_format($amount)}} @endif </label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="number" class="form-control" wire:model.live="amount">
                    </div>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" wire:click="prosesBayarJasa">Bayar</button>
            </div>
        </div>
        </div>
    </div>

    @push('scripts')
    <script>
        window.addEventListener('modalTambah', function() {
            $("#modalTambah").modal('show')
        });
        window.addEventListener('modalDetail', function() {
            $("#modalDetail").modal('show')
        });
        window.addEventListener('modalBayar', function() {
            $("#modalBayar").modal('show')
        });

        window.addEventListener('confirmDelete', function() {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
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

        window.addEventListener('alert', function(event){
          Swal.fire({
                title: event.detail[0].title,
                text: event.detail[0].message,
                icon: event.detail[0].icon,
              });
        });
  
        window.addEventListener('closeModal', function() {
          $("#modalTambah").modal('hide')
          $("#modalDetail").modal('hide')
          $("#modalBayar").modal('hide')
        });
    </script>
    @endpush
</div>