<div class="col-sm-12">
    <div class="row">

        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="text-white text-capitalize ps-3">Detail Transaksi <span class="fw-bold">{{$name.' - '.$address}}</span> </h6>
                    </div>
                    <div class="col-sm-6 text-end">
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
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">kode Transaksi</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Transaksi</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Transaksi</th>
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
                        <p class="text-xs text-secondary font-weight-bold mb-0"> {{substr($item->created_at, 0, 10)}} </p>
                      </td>
                      <td>
                        @if($item->tipetrx == 'egg')
                          <a href="javascript:void(0);" wire:click="modalDetailEgg({{$item->idtransaksi}})" class="fw-bold text-primary"> {{$item->idtransaksi}} </a>
                        @else
                          <a href="javascript:void(0);" wire:click="modalDetail({{$item->idtransaksi}})" class="fw-bold text-primary"> {{$item->idtransaksi}} </a>
                        @endif
                      </td>
                      <td>
                        <p class="text-xs text-secondary font-weight-bold mb-0">
                          @if($item->tipetrx == 'egg') Telur @else Produk @endif  @if($item->trxtipe == 'pembelian') Inbound @else Outbound @endif 
                        </p>
                      </td>
                      <td class="align-middle text-sm">
                        <p class="text-xs fw-bold @if($item->trxtipe == 'penjualan') text-success @endif mb-0"> @if($item->trxtipe == 'pembelian') - @else + @endif {{number_format($item->totalprice)}} </p>
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
  
