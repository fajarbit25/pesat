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

        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="text-white text-capitalize ps-3">Piutang Plasma</h6>
                    </div>
                    <div class="col-sm-6 text-end">
                    </div>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="col-sm-6">
                <div class="input-group input-group-outline">
                  <input type="search" class="form-control mx-2" placeholder="Cari Suplier" wire:model.live="key">
                </div>
              </div>
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Handphone</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Hutang</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($items)
                    @foreach ($items as $item)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"> {{$loop->iteration}} </h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs text-secondary mb-0"> 
                          <a href="/hutang/{{$item->id}}/detail" class="text-primary fw-bold">
                            {{strtoupper($item->name)}} 
                          </a>
                        </p>
                      </td>
                      <td>
                        <p class="text-xs text-secondary font-weight-bold mb-0"> {{$item->phone}} </p>
                      </td>
                      <td>
                        <p class="text-xs text-secondary font-weight-bold mb-0"> {{$item->address}} </p>
                      </td>
                      <td class="align-middle text-sm">
                        <p class="text-xs @if($item->hutang < 0) text-success @endif fw-bold mb-0"> 
                            <span class="fw-bold">
                              @if($item->hutang > 0)
                                -{{number_format(abs($item->hutang))}}
                              @else
                                {{number_format(abs($item->hutang))}}
                              @endif
                          </span> 
                        </p>
                      </td>
                      <td class="align-middle text-sm">
                        <p class="text-xs fw-bold mb-0"> 
                          <a href="javascript:void(0)" class="fw-bold text-success mx-2" wire:click="editHutang({{$item->id}})"> Edit </a>
                          @if($item->hutang < 0)
                            <a href="javascript:void(0)" class="fw-bold text-warning" wire:click="bayarHutang({{$item->id}})"> Bayar </a>
                          @endif
                        </p>
                      </td>
                    </tr>
                    @endforeach
                    @endif
                    <tr>
                        <td colspan="5">{{$items->links()}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

    </div>
  
    {{-- <!-- Modal -->
    <div class="modal fade" id="modalCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true" wire:ignore.self>
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form wire:submit.prevent="@if($edit) editEgg @else addEgg @endif">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalCreateLabel">@if($edit) Edit @else Tambah @endif Obat</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
            <div class="row">
              <div class="col-sm-12">
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                  <div class="form-text text-danger">-{{ $error }}</div>
                @endforeach
                @endif
              </div>
              <div class="col-sm-6">
                <label for="name">Nama <span class="text-danger">*</span> </label>
                <div class="input-group input-group-outline mb-3">
                  <input type="text" class="form-control" wire:model="name">
                </div>
              </div>
              @if(!$edit)
              <div class="col-sm-6">
                <label for="stock">Stok Awal <span class="text-danger">*</span> </label>
                <div class="input-group input-group-outline mb-3">
                  <input type="text" class="form-control" wire:model="stock">
                </div>
              </div>
              @endif
              <div class="col-sm-6">
                <label for="buyprice">Harga Beli <span class="text-danger">*</span> </label>
                <div class="input-group input-group-outline mb-3">
                  <input type="text" class="form-control" wire:model="buyprice">
                </div>
              </div>
              <div class="col-sm-6">
                <label for="sellprice">Harga Jual <span class="text-danger">*</span> </label>
                <div class="input-group input-group-outline mb-3">
                  <input type="text" class="form-control" wire:model="sellprice">
                </div>
              </div>
            </div>
  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn @if($edit) btn-success @else btn-primary @endif">Simpan</button>
          </div>
          </form>
        </div>
      </div>
    </div> --}}

    <!-- Modal -->
    <div class="modal fade" id="modalBayar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalBayarLabel" aria-hidden="true" wire:ignore.self>
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalBayarLabel">Bayar Hutang</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
            <div class="row">
              <div class="col-sm-12">
              </div>
              <div class="col-sm-6">
                <label for="name">Total Perlu Dibayar </label>
                <div class="input-group input-group-outline mb-3">
                  <h3 class="fw-bold"> Rp.{{number_format($totalHutang) ?? 0}},- </h3>
                </div>
              </div>
              <div class="col-sm-6">
                <label for="pay">Masukan Jumlah Hutang <span class="text-danger">*</span> @if($pay != "") <span class="fw-bold">(Rp.{{number_format($pay ?? 0)}},-)</span> @endif </label>
                <div class="input-group input-group-outline mb-3">
                  <input type="number" class="form-control" wire:model.live="pay">
                </div>
              </div>
            </div>
  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-success" wire:click="prosesBayar">Bayar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true" wire:ignore.self>
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalEditLabel">Edit Hutang</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
            <div class="row">
              <div class="col-sm-12">
              </div>
              <div class="col-sm-6">
                <label for="name">Total Sekarang </label>
                <div class="input-group input-group-outline mb-3">
                  @if($totalHutang > 0)
                    <h3 class="fw-bold"> Rp.-{{number_format(abs($totalHutang ?? 0))}},- </h3>
                  @else
                    <h3 class="fw-bold"> Rp.{{number_format(abs($totalHutang ?? 0))}},- </h3>
                  @endif
                </div>
              </div>
              <div class="col-sm-6">
                <label for="hutangBaru">Masukan Total Baru <span class="text-danger">*</span> @if($hutangBaru != "") <span class="fw-bold">(Rp.{{number_format($hutangBaru ?? 0)}},-)</span> @endif </label>
                <div class="input-group input-group-outline mb-3">
                  <input type="number" class="form-control" wire:model.live="hutangBaru">
                </div>
              </div>
            </div>
  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-success" wire:click="prosesEditHutang">simpan</button>
          </div>
        </div>
      </div>
    </div>
  
    @push('scripts')
    <script>
        window.addEventListener('modalCreate', function() {
          $("#modalCreate").modal('show');
        });
        window.addEventListener('modalBayar', function() {
          $("#modalBayar").modal('show');
        });
        window.addEventListener('modalEditHutang', function() {
          $("#modalEdit").modal('show');
        });
  
        window.addEventListener('confirmDelete', function() {
          Swal.fire({
            title: "Are you sure?",
            text: "Yakin ingin menghapus data telur?",
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
          $("#modalCreate").modal('hide');
          $("#modalBayar").modal('hide');
          $("#modalEdit").modal('hide');
        });
  
        document.addEventListener('DOMContentLoaded', function () {
            var element = document.getElementById('.btn');
            if (element) {
                element.removeChild(childElement);
            }
        });
  
    </script>
    @endpush
  
  </div>
  
