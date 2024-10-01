<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <a href="{{route('medicine')}}" class="btn btn-secondary btn-sm"><i class="material-icons opacity-10">arrow_back</i> kembali </a>
        </div>
        <div class="col-4">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="text-white text-capitalize ps-3">Categori Produk</h6>
                    </div>
                    <div class="col-sm-6 text-end">
                        <button class="btn btn-info btn-sm mx-2" wire:click="modalAddCat"><i class="material-icons opacity-10">add</i> Tambah</button>
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
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Categori</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($dataCat)
                        @foreach($dataCat as $item)
                        <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm"> {{$item->code}} </h6>
                            </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-xs text-secondary mb-0"> {{$item->category}} </p>
                        </td>
                        <td class="align-middle">
                            <a href="javascript:void(0)" class="text-secondary font-weight-bold text-xs" wire:click="editCat({{$item->id}})">Edit</a>
                            <a href="javascript:void(0)" class="text-danger font-weight-bold text-xs mx-2" wire:click="deleteCat({{$item->id}})">Delete</a>
                        </td>
                        </tr>
                        @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="col-4">
            <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                  <div class="row">
                      <div class="col-sm-6">
                          <h6 class="text-white text-capitalize ps-3">Satuan Produk</h6>
                      </div>
                      <div class="col-sm-6 text-end">
                          <button class="btn btn-info btn-sm mx-2" wire:click="modalUnit"><i class="material-icons opacity-10">add</i> Tambah</button>
                      </div>
                  </div>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Satuan</th>
                        <th class="text-secondary opacity-7"></th>
                      </tr>
                    </thead>
                    <tbody>
                    @if($dataUnit)
                        @foreach($dataUnit as $item)
                        <tr>
                            <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm"> {{$loop->iteration}} </h6>
                                </div>
                            </div>
                            </td>
                            <td>
                            <p class="text-xs text-secondary mb-0"> {{$item->unit}} </p>
                            </td>
                            <td class="align-middle">
                            <a href="javascript:void(0)" class="text-secondary font-weight-bold text-xs" wire:click="editUnit({{$item->id}})">Edit</a>
                            <a href="javascript:void(0)" class="text-danger font-weight-bold text-xs mx-2" wire:click="deleteUnit({{$item->id}})">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                  <div class="row">
                      <div class="col-sm-6">
                          <h6 class="text-white text-capitalize ps-3">Kemasan Produk</h6>
                      </div>
                      <div class="col-sm-6 text-end">
                          <button class="btn btn-info btn-sm mx-2" wire:click="modalCreatePack"><i class="material-icons opacity-10">add</i> Tambah</button>
                      </div>
                  </div>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kemasan</th>
                        <th class="text-secondary opacity-7"></th>
                      </tr>
                    </thead>
                    <tbody>
                    @if($dataPack)
                        @foreach($dataPack as $item)
                        <tr>
                            <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm"> {{$loop->iteration}} </h6>
                                </div>
                            </div>
                            </td>
                            <td>
                            <p class="text-xs text-secondary mb-0"> {{$item->packaging}} </p>
                            </td>
                            <td class="align-middle">
                            <a href="javascript:void(0)" class="text-secondary font-weight-bold text-xs" wire:click="editPack({{$item->id}})">Edit</a>
                            <a href="javascript:void(0)" class="text-danger font-weight-bold text-xs mx-2" wire:click="deletePack({{$item->id}})">Delete</a>
                            </td>
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
  
    <!-- Modal -->
    <div class="modal fade" id="modalAddCat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAddCatLabel" aria-hidden="true" wire:ignore.self>
      <div class="modal-dialog">
        <div class="modal-content">
          <form wire:submit.prevent="@if($idEditCat) updateCat @else addCat @endif">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalAddCatLabel">@if($idEditCat) Edit @else Tambah @endif Category</h1>
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

              <div class="col-sm-12">
                <label for="code">Kode <span class="text-danger">*</span> </label>
                <div class="input-group input-group-outline mb-3">
                  <input type="text" class="form-control" wire:model="code">
                </div>
              </div>
              <div class="col-sm-12">
                <label for="cat">Kategory <span class="text-danger">*</span> </label>
                <div class="input-group input-group-outline mb-3">
                  <input type="text" class="form-control" wire:model="cat">
                </div>
              </div>
            </div>
  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn @if($idEditCat) btn-success @else btn-primary @endif">Simpan</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="modalUnit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalUnitLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
          <div class="modal-content">
            <form wire:submit.prevent="@if($idEditUnit) updateUnit @else addUnit @endif">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="modalUnitLabel">@if($idEditUnit) Edit @else Tambah @endif Satuan</h1>
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
  
                <div class="col-sm-12">
                  <label for="unit">Satuan <span class="text-danger">*</span> </label>
                  <div class="input-group input-group-outline mb-3">
                    <input type="text" class="form-control" wire:model="unit">
                  </div>
                </div>
              </div>
    
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" class="btn @if($idEditUnit) btn-success @else btn-primary @endif">Simpan</button>
            </div>
            </form>
          </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalPack" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalPackLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
          <div class="modal-content">
            <form wire:submit.prevent="@if($idEditPack) updatePack @else addPack @endif">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="modalPackLabel">@if($idEditPack) Edit @else Tambah @endif Kemasan</h1>
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
  
                <div class="col-sm-12">
                  <label for="pack">Kemasan <span class="text-danger">*</span> </label>
                  <div class="input-group input-group-outline mb-3">
                    <input type="text" class="form-control" wire:model="pack">
                  </div>
                </div>
              </div>
    
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" class="btn @if($idEditPack) btn-success @else btn-primary @endif">Simpan</button>
            </div>
            </form>
          </div>
        </div>
    </div>
  
    @push('scripts')
    <script>
        window.addEventListener('modalUnit', function() {
          $("#modalUnit").modal('show');
        });

        window.addEventListener('modalAddCat', function() {
          $("#modalAddCat").modal('show');
        });

        window.addEventListener('modalPack', function() {
          $("#modalPack").modal('show');
        });
  
        //Delete Cat
        window.addEventListener('confirmDeleteCat', function() {
          Swal.fire({
            title: "Are you sure?",
            text: "Yakin ingin menghapus kategory!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
          }).then((result) => {
            if (result.isConfirmed) {
                // Call Livewire method to delete the file
                //this.Livewire.emit('deleting');
                Livewire.dispatch('deletingCat')
            } else {
              Swal.fire({
                title: "Cancelled",
                text: "Your data is safe!.",
                icon: "error"
              });
            }
          });
        });

        //Delete Unit
        window.addEventListener('confirmDeleteUnit', function() {
          Swal.fire({
            title: "Are you sure?",
            text: "Yakin ingin menghapus satuan?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
          }).then((result) => {
            if (result.isConfirmed) {
                // Call Livewire method to delete the file
                //this.Livewire.emit('deleting');
                Livewire.dispatch('deletingUnit')
            } else {
              Swal.fire({
                title: "Cancelled",
                text: "Your data is safe!.",
                icon: "error"
              });
            }
          });
        });

        //Delete Pack
        window.addEventListener('confirmDeletePack', function() {
          Swal.fire({
            title: "Are you sure?",
            text: "Yakin ingin menghapus kemasan?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
          }).then((result) => {
            if (result.isConfirmed) {
                // Call Livewire method to delete the file
                //this.Livewire.emit('deleting');
                Livewire.dispatch('deletingPack')
            } else {
              Swal.fire({
                title: "Cancelled",
                text: "Your data is safe!.",
                icon: "error"
              });
            }
          });
        });
  
        //Alert
        window.addEventListener('alert', function(event){
          Swal.fire({
                title: event.detail[0].title,
                text: event.detail[0].message,
                icon: event.detail[0].icon,
              });
        });
  
        window.addEventListener('closeModal', function() {
            $("#modalAddCat").modal('hide');
            $("#modalUnit").modal('hide');
            $("#modalPack").modal('hide');
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
  