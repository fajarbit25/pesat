<div class="col-sm-12">
    <div class="row">

        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="text-white text-capitalize ps-3">Stock Telur</h6>
                    </div>
                    <div class="col-sm-6 text-end">
                        <button class="btn btn-info btn-sm mx-1" wire:click="modalCreate"><i class="material-icons opacity-10">add</i> Tambah</button>
                        <a href="{{route('egg.report')}}" class="btn btn-secondary btn-sm mx-1"><i class="material-icons opacity-10">table_view</i> Laporan</a>
                    </div>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stok</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($items)
                    @foreach ($items as $item)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"> {{$item->code}} </h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs text-secondary mb-0"> {{$item->name}} </p>
                      </td>
                      <td>
                        <p class="text-xs text-secondary font-weight-bold mb-0"> {{number_format($item->stock)}} </p>
                      </td>
                      <td class="align-middle text-sm">
                        <p class="text-xs mb-0"> {{number_format($item->sellprice)}} </p>
                      </td>
                      <td class="align-middle">
                        <a href="/egg/{{$item->code}}/mutasi" class="text-info font-weight-bold text-xs">Detail</a>
                        <a href="javascript:void(0)" class="text-secondary font-weight-bold text-xs mx-2" wire:click="edits({{$item->id}})">Edit</a>
                        <a href="javascript:void(0)" class="text-warning font-weight-bold text-xs" wire:click="editStock({{$item->id}}, {{$item->stock}})">Edit Stock</a>
                        @if($item->stock == 0)
                        <a href="javascript:void(0)" class="text-danger font-weight-bold text-xs mx-2" wire:click="delete({{$item->id}})">Hapus</a>
                        @endif
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
  
    <!-- Modal -->
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
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalEditStock" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditStockLabel" aria-hidden="true" wire:ignore.self>
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form wire:submit.prevent="updateStock">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalEditStockLabel">Edit Stock</h1>
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
                <label for="stockAwal">Stock Awal  </label>
                <div class="input-group input-group-outline mb-3">
                  <input type="number" class="form-control" wire:model="stockAwal" disabled>
                </div>
              </div>

              <div class="col-sm-6">
                <label for="newStock">Masukan Stok Baru <span class="text-danger">*</span> </label>
                <div class="input-group input-group-outline mb-3">
                  <input type="number" class="form-control" wire:model="newStock">
                </div>
              </div>
              
  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  
    @push('scripts')
    <script>
        window.addEventListener('modalCreate', function() {
          $("#modalCreate").modal('show');
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

        window.addEventListener('editStock', function() {
          $("#modalEditStock").modal('show')
        });
  
        window.addEventListener('closeModal', function() {
          $("#modalCreate").modal('hide');
          $("#modalEditStock").modal('hide')
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
  