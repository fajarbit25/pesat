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

        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6"> <span class="fw-bold text-primary">Detail Pembelian {{$month}}</span> </div>
                        <div class="col-sm-6 text-end">
                            <a href="{{url('egg/'.$userid.'/outbound')}}" class="btn btn-primary btn-sm">Tambah</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-4 mb-3">
                                <div class="input-group input-group-outline">
                                  <input type="month" class="form-control mx-2"  wire:model.live="month">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="table-responsive">
                                <table class="table table-bordered" style="font-size: 12px;">
                                    <thead>
                                        <tr class="bg-light">
                                            <th>Tanggal</th>
                                            <th>Id Transaksi</th>
                                            <th>Produk</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($items)
                                        @foreach ($items->groupBy('idtransaksi') as $idtransaksi => $item)
                                        <tr>
                                            <td> {{$item->first()->tanggal}} </td>
                                            <td> {{$idtransaksi}} </td>
                                            <td>
                                                <table class="table table-borderless">
                                                    <tbody>
                                                        @foreach($item as $itm)
                                                        <tr>
                                                            <td>{{$itm->name}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td>
                                                <table class="table table-borderless">
                                                    <tbody>
                                                        @foreach($item as $itm)
                                                        <tr>
                                                            <td>{{number_format($itm->qty)}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td>
                                                <table class="table table-borderless">
                                                    <tbody>
                                                        @foreach($item as $itm)
                                                        <tr>
                                                            <td>{{number_format($itm->price)}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td>
                                                <table class="table table-borderless">
                                                    <tbody>
                                                        @foreach($item as $itm)
                                                        <tr>
                                                            <td>{{number_format($itm->total)}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                            <th>{{number_format($item->first()->totalprice)}}</th>
                                            <td>
                                                @if($item->first()->payment_status == 'lunas')
                                                    <span class="fw-bold text-success">Lunas</span>
                                                @else 
                                                    <a href="javascript:void(0)" wire:click="modalBayar('{{$idtransaksi}}')" ><span class="fw-bold text-danger">Pending</span> </a>
                                                @endif
                                            </td>
                                            <td style="white-space: normal;"> {!!$item->first()->keterangan!!} </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                        <tr>
                                            <td colspan="5"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="table-responsive">
                                <table class="table table-bordered" style="font-size:12px;">
                                    <thead>
                                        <tr class="bg-light">
                                            <th colspan="2">Detail Pelanggan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Nama</th>
                                            <td>: {{$users->name}} </td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>: {{$users->address}} </td>
                                        </tr>
                                        <tr>
                                            <th>No Handphone</th>
                                            <td>: {{$users->phone}} </td>
                                        </tr>
                                        <tr>
                                            <th>Level</th>
                                            <td>: {{$users->level}} </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalBayar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalBayarLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="modalBayarLabel">Pembayaran Hutang Buyer</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              
              <div class="row">
                <div class="col-sm-12">
                </div>
                <div class="col-sm-6">
                  <label for="name">Total Perlu Dibayar </label>
                  <div class="input-group input-group-outline mb-3">
                    <h3 class="fw-bold"> Rp.{{number_format($totalBayar) ?? 0}},- </h3>
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

    @push('scripts')
    <script>
        window.addEventListener('modalBayar', function() {
          $("#modalBayar").modal('show');
        });
  
  
        window.addEventListener('alert', function(event){
          Swal.fire({
                title: event.detail[0].title,
                text: event.detail[0].message,
                icon: event.detail[0].icon,
              });
        });
  
        window.addEventListener('closeModal', function() {
          $("#modalBayar").modal('hide');
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
