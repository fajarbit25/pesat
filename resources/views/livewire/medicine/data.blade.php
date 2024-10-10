<div class="col-sm-12">
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="text-white text-capitalize ps-3">Master Produk</h6>
                    </div>
                    <div class="col-sm-6 text-end">
                        <button class="btn btn-info btn-sm mx-2" wire:click="modalCreate"><i class="material-icons opacity-10">add</i> Tambah</button>
                        <a href="{{route('medicine.settings')}}" class="btn btn-secondary btn-sm mx-2"><i class="material-icons opacity-10">settings</i> Pengaturan</a>
                    </div>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="col-sm-4">
                <div class="input-group input-group-outline">
                  <input type="search" class="form-control mx-2" placeholder="Cari Produk" wire:model.live="key">
                </div>
              </div>
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Produk</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Categori</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kemasan</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stok</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Satuan</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Supplier</th>
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
                        <p class="text-xs text-secondary mb-0"> {{$item->jenis}} </p>
                      </td>
                      <td>
                        <p class="text-xs text-secondary mb-0"> {{$item->category}} </p>
                      </td>
                      <td class="align-middle text-center">
                        <p class="text-xs font-weight-bold mb-0">{{$item->packaging}}</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">{{number_format($item->stock)}}</p>
                      </td>
                      <td>
                        <p class="text-xs text-secondary mb-0"> {{$item->unit}} </p>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{number_format($item->price)}}</span>
                      </td>
                      <td>
                        <p class="text-xs text-secondary mb-0"> {{$item->suppliername}} </p>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:void(0)" class="text-secondary font-weight-bold text-xs" wire:click="edits({{$item->id}})">Edit</a>
                        <a href="javascript:void(0)" class="text-danger font-weight-bold text-xs mx-2" wire:click="deletes({{$item->id}})">Delete</a>
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
          <form wire:submit.prevent="@if($edit) editMedic @else addMedic @endif">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalCreateLabel">@if($edit) Edit @else Tambah @endif</h1>
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
              <div class="col-sm-6">
                <label for="jenis">Jenis <span class="text-danger">*</span> </label>
                <div class="input-group input-group-outline mb-3">
                  <select class="form-control" wire:model="jenis">
                    <option value="">--Pilih jenis--</option>
                    <option value="pakan">Pakan</option>
                    <option value="obat">Obat</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <label for="cat">Kategori <span class="text-danger">*</span> </label>
                <div class="input-group input-group-outline mb-3">
                  <select class="form-control" wire:model="cat">
                    <option value="">--Pilih kategory--</option>
                    @if($dataCat)
                      @foreach($dataCat as $cat)
                      <option value="{{$cat->id}}">{{$cat->category}}</option>
                      @endforeach
                    @endif
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <label for="unit">Satuan <span class="text-danger">*</span> </label>
                <div class="input-group input-group-outline mb-3">
                  <select class="form-control" wire:model="unit">
                    <option value="">--Pilih satuan--</option>
                    @if($dataUnit)
                      @foreach($dataUnit as $unit)
                      <option value="{{$unit->id}}">{{$unit->unit}}</option>
                      @endforeach
                    @endif
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <label for="packaging">Kemasan <span class="text-danger">*</span> </label>
                <div class="input-group input-group-outline mb-3">
                  <select class="form-control" wire:model="packaging">
                    <option value="">--Pilih kemasan--</option>
                    @if($dataPack)
                      @foreach($dataPack as $pack)
                      <option value="{{$pack->id}}">{{$pack->packaging}}</option>
                      @endforeach
                    @endif
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <label for="stock">Stok Awal <span class="text-danger">*</span> @if($stock) <span class="fw-bold">{{number_format($stock) ?? 0}}</span> @endif </label>
                <div class="input-group input-group-outline mb-3">
                  <input type="text" class="form-control" wire:model.live="stock">
                </div>
              </div>
              <div class="col-sm-6">
                <label for="price">Harga Beli <span class="text-danger">*</span> @if($price) <span class="fw-bold">Rp.{{number_format($price)}},-</span> @endif</label>
                <div class="input-group input-group-outline mb-3">
                  <input type="text" class="form-control" wire:model.live="price">
                </div>
              </div>
              <div class="col-sm-6">
                <label for="sellprice">Harga Jual <span class="text-danger">*</span> @if($sellprice) <span class="fw-bold">Rp.{{number_format($sellprice)}},-</span> @endif</label>
                <div class="input-group input-group-outline mb-3">
                  <input type="text" class="form-control" wire:model.live="sellprice">
                </div>
              </div>
              <div class="col-sm-12">
                <label for="packaging">Suplier <span class="text-danger">*</span> </label>
                <div class="input-group input-group-outline mb-3">
                  <select class="form-control" wire:model="supplier">
                    <option value="">--Pilih suplier--</option>
                    @if($dataSupplier)
                      @foreach($dataSupplier as $supp)
                      <option value="{{$supp->id}}">{{$supp->name}}</option>
                      @endforeach
                    @endif
                  </select>
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
  
    @push('scripts')
    <script>
        window.addEventListener('modalCreate', function() {
          $("#modalCreate").modal('show');
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
          $("#modalCreate").modal('hide');
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
  