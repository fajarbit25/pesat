<div class="col-sm-12">
    <div class="col-sm-12">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <span class="fw-bold">Update Toko</span>
                </div>
                <form wire:submit.prevent="updateToko">
                <div class="card-body">

                    <div class="col-sm-12">
                        <label for="storename">Nama Toko <span class="fw-bold text-danger">*</span> </label>
                        <div class="input-group input-group-outline mb-3">
                          <input type="text" class="form-control" wire:model.live="storename">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="slogan">Slogan <span class="fw-bold text-danger">*</span> </label>
                        <div class="input-group input-group-outline mb-3">
                          <input type="text" class="form-control" wire:model.live="slogan">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="shopaddress">Alamat <span class="fw-bold text-danger">*</span> </label>
                        <div class="input-group input-group-outline mb-3">
                          <input type="text" class="form-control" wire:model.live="shopaddress">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="norek">Rekening <span class="fw-bold text-danger">*</span> </label>
                        <div class="input-group input-group-outline mb-3">
                          <input type="text" class="form-control" wire:model.live="norek">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <span class="fw-bold">Ganti Foto</span>
                </div>
                <form wire:submit.prevent="updatePhoto">
                <div class="card-body">

                    <div class="col-sm-12 text-center">
                        <img src="{{asset('storage/logo/'.$img)}}" alt="logo" width="200px;">
                    </div>

                    <div class="col-sm-12">
                        <label for="photo">Ganti Foto <span class="fw-bold text-danger">*</span> </label>
                        <div class="input-group input-group-outline mb-3">
                          <input type="file" class="form-control" wire:model="photo">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
