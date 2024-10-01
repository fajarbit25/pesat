<div class="col-sm-12">
  <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
              <div class="row">
                  <div class="col-sm-6">
                      <h6 class="text-white text-capitalize ps-3">Tabel Personal</h6>
                  </div>
                  <div class="col-sm-6 text-end">
                      <button class="btn btn-info btn-sm mx-2" wire:click="modalCreate"><i class="material-icons opacity-10">add</i> Tambah</button>
                  </div>
              </div>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <div class="col-sm-12">
              <div class="col-sm-4 mx-2">
                <div class="input-group input-group-outline mb-3">
                  <input type="search" class="form-control" wire:model.live="key" placeholder="Cari personal">
                </div>
              </div>
            </div>
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Personal</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Handphone</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Fungsi</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Rekening</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Alamat</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Tedaftar</th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                  @if($items)
                  @foreach ($items as $item)
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="{{asset('storage/user/'.$item->img)}}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm"> {{$item->name}} </h6>
                          <p class="text-xs text-secondary mb-0"> {{$item->email}} </p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs text-secondary mb-0"> {{$item->phone}} </p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{$item->divisi}}</p>
                      <p class="text-xs text-secondary mb-0"> {{$item->level}} </p>
                    </td>
                    <td>
                      <p class="text-xs text-secondary mb-0"> {{$item->norek}} </p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      @if($item->tag_active == 'active')
                      <span class="badge badge-sm bg-gradient-success">Active</span>
                      @else
                      <span class="badge badge-sm bg-gradient-secondary">Inactive</span>
                      @endif
                    </td>
                    <td>
                      <p class="text-xs text-secondary mb-0"> {{$item->address}} </p>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{substr($item->created_at, 0, 10)}}</span>
                    </td>
                    <td class="align-middle">
                      <a href="javascript:void(0)" class="text-secondary font-weight-bold text-xs" wire:click="editUser({{$item->id}})">Edit</a>
                      <a href="javascript:void(0)" class="text-danger font-weight-bold text-xs mx-2" wire:click="deleteUser({{$item->id}})">Delete</a>
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
    <div class="modal-dialog">
      <div class="modal-content">
        <form wire:submit.prevent="@if($edit) editKaryawan @else addKaryawan @endif">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalCreateLabel">@if($edit) Edit @else Tambah @endif</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
          <div class="row">
            <div class="col-sm-12">
              <label for="name">Nama <span class="text-danger">*</span> </label>
              @error('name')<div class="form-text text-danger">{{$message}}</div>@enderror
              <div class="input-group input-group-outline mb-3">
                <input type="text" class="form-control" wire:model="name">
              </div>
            </div>
            <div class="col-sm-12">
              <label for="name">Level <span class="text-danger">*</span> </label>
              @error('level')<div class="form-text text-danger">{{$message}}</div>@enderror
              <div class="input-group input-group-outline mb-3">
                <select class="form-control" wire:model="level">
                  <option value="">--Pilih level karyawan--</option>
                  @if($dataLevel)
                    @foreach($dataLevel as $item)
                      <option value="{{$item->id}}"> {{$item->level}} </option>
                    @endforeach
                  @endif
                </select>
              </div>
            </div>
            <div class="col-sm-12">
              <label for="name">Handphone <span class="text-danger">*</span> </label>
              @error('phone')<div class="form-text text-danger">{{$message}}</div>@enderror
              <div class="input-group input-group-outline mb-3">
                <input type="text" class="form-control" wire:model="phone">
              </div>
            </div>
            <div class="col-sm-12">
              <label for="name">Email <span class="text-danger">*</span> </label>
              @error('email')<div class="form-text text-danger">{{$message}}</div>@enderror
              <div class="input-group input-group-outline mb-3">
                <input type="email" class="form-control" wire:model="email">
              </div>
            </div>
            <div class="col-sm-12">
              <label for="name">Aktif <span class="text-danger">*</span> </label>
              @error('level')<div class="form-text text-danger">{{$message}}</div>@enderror
              <div class="input-group input-group-outline mb-3">
                <select class="form-control" wire:model="isActive">
                  <option value="">--Aktif / Tidak Aktif--</option>
                  <option value="active">Aktif</option>
                  <option value="inactive">Tidak Aktif</option>
                </select>
              </div>
            </div>
            <div class="col-sm-12">
              <label for="norek">Nomor Rekening <span class="text-danger">*</span> </label>
              @error('norek')<div class="form-text text-danger">{{$message}}</div>@enderror
              <div class="input-group input-group-outline mb-3">
                <input type="text" class="form-control" wire:model="norek">
              </div>
            </div>
            <div class="col-sm-12">
              <label for="address">Alamat <span class="text-danger">*</span> </label>
              @error('address')<div class="form-text text-danger">{{$message}}</div>@enderror
              <div class="input-group input-group-outline mb-3">
                <input type="text" class="form-control" wire:model="address">
              </div>
            </div>
            <div class="col-sm-12">
              <label for="name">Password <span class="text-danger">*</span> </label>
              @error('password')<div class="form-text text-danger">{{$message}}</div>@enderror
              <div class="input-group input-group-outline mb-3">
                <input type="text" class="form-control" wire:model="password" @if($edit) disabled @endif>
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
