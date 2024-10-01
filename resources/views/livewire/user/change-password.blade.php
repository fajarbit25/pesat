<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <span class="fw-bold">Ganti Password</span>
                </div>
                <form wire:submit.prevent="change">
                <div class="card-body">
                    <div class="col-sm-6">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
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

                    <div class="col-sm-6">
                        <label for="current_password">Password Sekarang <span class="fw-bold text-danger">*</span> </label>
                        <div class="input-group input-group-outline mb-3">
                          <input type="text" class="form-control" wire:model.live="current_password">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="new_password">Password Baru <span class="fw-bold text-danger">*</span> </label>
                        <div class="input-group input-group-outline mb-3">
                          <input type="text" class="form-control" wire:model.live="new_password">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="new_password_confirmation">Ulangi Password Baru <span class="fw-bold text-danger">*</span> </label>
                        <div class="input-group input-group-outline mb-3">
                          <input type="text" class="form-control" wire:model.live="new_password_confirmation">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-primary">Ganti</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
