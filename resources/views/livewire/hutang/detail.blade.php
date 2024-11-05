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
                        <h6 class="text-white text-capitalize ps-3">Detail Transaksi</h6>
                        <span class="fw-bold mx-3 text-light">Nama : </span> <span class="fw-bold text-light">{{$name}}</span><br/>
                        <span class="fw-bold mx-3 text-light">Alamat : </span> <span class="fw-bold text-light">{{$address}}</span><br/>
                        <span class="fw-bold mx-3 text-light">Total Hutang : </span> <span class="fw-bold text-light">Rp.{{number_format($totalHutang)}},-</span><br/>
                        <span class="fw-bold mx-3 text-light">Periode : </span> <span class="fw-bold text-light">{{$month}}</span><br/>
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
                <div class="row">
                  <div class="col-sm-4">
                    <div class="input-group input-group-outline">
                      <input type="month" class="form-control mx-2"  wire:model.live="month">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <a href="javascript:void(0);" onclick="openPopup('{{ url('hutang/cetak/'.$userid.'/'.$month) }}')" class="btn btn-warning">Cetak</a>
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
                        <th>Disc</th>
                        <th>Total</th>
                        <th>Hapus</th>
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
                        <td> @if($item->idbarang == '1') @if($item->disc == 0) - @else {{number_format($item->disc)}} @endif @else - @endif </td>
                        <td> 
                          @if($item->idbarang == '1')
                            {{number_format($item->total)}}
                          @else
                            {{number_format($item->total)}}
                          @endif
                        </td>
                        <td> 
                          <a href="javascript:void(0)" wire:click="confirmDeleteTelur('{{$item->idtransaksi}}')" class="fw-bold text-danger">Hapus</a> 
                        </td>
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
                        <th>Disc</th>
                        <th>Total</th>
                        <th>Hapus</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($produk)
                      @foreach($produk as $item)
                      <tr @if($item->name == "PELUNASAN") class="bg-light" @endif>
                        <td> {{substr($item->tanggal, 0, 10)}} </td>
                        <td> {{$item->name}} </td>
                        <td>@if($item->name == "PELUNASAN") - @else {{number_format($item->qty)}} @endif </td>
                        <td>@if($item->name == "PELUNASAN") - @else {{number_format($item->price)}} @endif </td>
                        <td>
                          @foreach($produk->groupBy('idtransaksi') as $idtrx => $produks)
                            @if($idtrx == $item->idtransaksi)
                              @if($item->idbarang == $produks->first()->idbarang)
                                {{number_format($item->disc)}}
                              @endif
                            @endif
                          @endforeach
                        </td>
                        <td> 
                          {{number_format($item->total)}}
                        </td>
                        <td> 
                          <a href="javascript:void(0)" wire:click="confirmDeleteProduk('{{$item->idtransaksi}}')" class="fw-bold text-danger">Hapus</a> 
                        </td>
                      </tr>
                      @endforeach
                      <tr>
                        <td colspan="5"></td>
                      </tr>
                      @endif
                    </tbody>
                  </table>
                </div>

                @php
                    $totalPengambilan = $produk->sum('total');
                    $totalTelur = $items->sum('total');
                @endphp

                <div class="col-sm-12">
                  <table class="table table-bordered" style="font-size:12px;">
                    <tr>
                      <td></td>
                      <th>Jumlah</th>
                      <th>Disc</th>
                      <th class="text-end">Total</th>
                    </tr>
                    <tr>
                      <th>Telur Masuk</th>
                      <td> {{number_format($totalTelur)}} </td>
                      <td> {{number_format($discTelur)}} </td>
                      <td class="text-end">{{number_format($totalTelur-$discTelur)}}</td>
                    </tr>
                    <tr>
                      <th>Pengambilan Barang</th>
                      <td>{{number_format($totalPengambilan)}}</td>
                      <td>{{number_format($discProduk)}}</td>
                      <td class="text-end">{{number_format($totalPengambilan-$discProduk)}}</td>
                    </tr>
                    <tr class="bg-light">
                      <th>Grand Total</th>
                      @php
                          $grandTotalPengambilan = $totalPengambilan-$discProduk;
                          $grandtotalTelur = $totalTelur-$discTelur;
                      @endphp
                      <th class="text-end" colspan="3">{{number_format($grandtotalTelur-$grandTotalPengambilan)}}</th>
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

        window.addEventListener('modalEditTelur', function() {
          $("#modalEditTelur").modal('show');
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
          $("#modalEditTelur").modal('hide');
        });

        window.addEventListener('confirmDeleteTelur', function() {
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
                Livewire.dispatch('deletingEgg')
            } else {
              Swal.fire({
                title: "Cancelled",
                text: "Your data is safe!.",
                icon: "error"
              });
            }
          });
        });

        window.addEventListener('confirmDeleteProduk', function() {
          Swal.fire({
            title: "Are you sure?",
            text: "Yakin ingin menghapus data Produk?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
          }).then((result) => {
            if (result.isConfirmed) {
                // Call Livewire method to delete the file
                //this.Livewire.emit('deleting');
                Livewire.dispatch('deletingProduk')
            } else {
              Swal.fire({
                title: "Cancelled",
                text: "Your data is safe!.",
                icon: "error"
              });
            }
          });
        });
  
        document.addEventListener('DOMContentLoaded', function () {
            var element = document.getElementById('.btn');
            if (element) {
                element.removeChild(childElement);
            }
        });

        function openPopup(url) {
            // Membuka window baru dengan ukuran tertentu
            var popup = window.open(url, 'popup', 'width=800,height=600');

            // Menambahkan event listener untuk menangani kapan tombol print diklik
            popup.onload = function() {
                // Menambahkan event print untuk menutup window setelah print
                popup.document.body.onafterprint = function() {
                    popup.close();
                }
            }
        }

  
    </script>
    @endpush
  
  </div>
  
