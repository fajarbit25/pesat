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
                        <h6 class="text-white text-capitalize ps-3">Detail Transaksi {{$month}}</h6>
                        <span class="fw-bold mx-3 text-light">Nama : </span> <span class="fw-bold text-light">{{$name}}</span><br/>
                        <span class="fw-bold mx-3 text-light">Alamat : </span> <span class="fw-bold text-light">{{$address}}</span><br/>
                    </div>
                    <div class="col-sm-6 text-end">
                      <a href="{{url('egg/'.$userid.'/inbound')}}" class="btn btn-success btn-sm mx-1">Telur Masuk</a>
                      <a href="{{url('transaksi/'.$userid.'/pos')}}" class="btn btn-info btn-sm mx-1">Ambil Barang</a>
                    </div>
                </div>
              </div>
            </div>
            <div class="card-body pb-2">
              <div class="col-sm-12">
                <div class="col-sm-4">
                    <div class="input-group input-group-outline">
                      <input type="month" class="form-control mx-2"  wire:model.live="month">
                    </div>
                </div>
            </div>
              <div class="row">
                <div class="col-sm-6">
                  <span class="fw-bold">Telur  Masuk</span>
                  <table class="table table-bordered" style="font-size:12px;">
                    <thead>
                      <tr class="bg-light">
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($items)
                      @foreach($items as $item)
                      <tr>
                        <td> {{substr($item->tanggal, 0, 10)}} </td>
                        <td> {{$item->name}} </td>
                        <td> {{number_format($item->qty)}} </td>
                        <td> {{number_format($item->price)}} </td>
                        <td> {{number_format($item->total)}} </td>
                      </tr>
                      @endforeach
                      <tr>
                        <td colspan="5"></td>
                      </tr>
                      @endif
                    </tbody>
                  </table>
                </div>

                <div class="col-sm-6">
                  <span class="fw-bold">Pengambilan Barang</span>
                  <table class="table table-bordered" style="font-size:12px;">
                    <thead>
                      <tr class="bg-light">
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($produk)
                      @foreach($produk as $item)
                      <tr>
                        <td> {{substr($item->tanggal, 0, 10)}} </td>
                        <td> {{$item->name}} </td>
                        <td> {{number_format($item->qty)}} </td>
                        <td> {{number_format($item->price)}} </td>
                        <td> {{number_format($item->total)}} </td>
                      </tr>
                      @endforeach
                      <tr>
                        <td colspan="5"></td>
                      </tr>
                      @endif
                    </tbody>
                  </table>
                </div>

                <div class="col-sm-12">
                  <table class="table table-bordered" style="font-size:12px;">
                    <tr>
                      <th>Telur Masuk</th>
                      <td> {{number_format($items->sum('total'))}} </td>
                    </tr>
                    <tr>
                      <th>Pengambilan Barang</th>
                      <td>{{number_format($produk->sum('total'))}}</td>
                    </tr>
                    <tr class="bg-light">
                      <th>Grand Total</th>
                      <th>{{number_format($produk->sum('total')-$items->sum('total'))}}</th>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

    </div>
  
    <!-- Modal -->
    <div class="modal fade" id="modalDetail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalDetailLabel">Detail Transaksi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    @if($dataTrx)
                    <table class="table" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Quantity</th>
                                <th>Harga</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataTrx as $item)
                            <tr>
                                <td> {{$loop->iteration}} </td>
                                <td> {{$item->code.' - '.$item->name}} </td>
                                <td> {{$item->qty}} </td>
                                <td> {{number_format($item->price)}} </td>
                                <td> {{number_format($item->total)}} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else 
                    <span class="fw-bold text-danger">No Data!</span>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
        </div>
    </div>
  
    @push('scripts')
    <script>
        window.addEventListener('modalDetail', function() {
          $("#modalDetail").modal('show');
        });
  
        window.addEventListener('alert', function(event){
          Swal.fire({
                title: event.detail[0].title,
                text: event.detail[0].message,
                icon: event.detail[0].icon,
              });
        });
  
        window.addEventListener('closeModal', function() {
          $("#modalDetail").modal('hide');
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
  
