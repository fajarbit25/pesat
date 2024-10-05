<div class="col-sm-12">
    <div class="row">

        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="fw-bold text-primary">Laporan Barang Keluar</span>
                        </div>
                        <div class="col-sm-6 text-end">
                        </div>
                    </div>
                </div>
                <div class="card-body m-0">
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
                    <div class="table-responsive">
                        <table class="table" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Kode Transaksi</th>
                                    <th>Penerima</th>
                                    <th>Harga</th>
                                    <th>Discount</th>
                                    <th>Total Harga</th>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @if($items)
                                @foreach($items as $item)
                                <tr>
                                    <td> {{$loop->iteration}} </td>
                                    <td> {{substr($item->created_at, 0, 10)}} </td>
                                    <td>
                                        <a href="javascript:void(0)" wire:click="modalDetail({{$item->idtransaksi}})" class="text-primary fw-bold">
                                        {{$item->idtransaksi}}
                                        </a>
                                    </td>
                                    <td> {{$item->name}} </td>
                                    <td> {{number_format($item->totalprice+$item->disc)}} </td>
                                    <td> {{number_format($item->disc)}} </td>
                                    <td> <span class="fw-bold">{{number_format($item->totalprice)}}</span> </td>
                                    <td>
                                        <a href="javascript:void(0);" class="text-warning fw-bold" onclick="openPopup('/invoice/{{$item->idtransaksi}}/print')"> cetak </a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                                <tr>
                                    <td colspan="7">  {{$items->links()}} </td>
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

        window.addEventListener('closeModal', function() {
          $("#modalDetail").modal('hide');
        });

        //open pop up
        function openPopup(url) {
            var printWindow = window.open(url, 'newwindow', 'width=800,height=600');
            printWindow.addEventListener('load', function() {
                printWindow.print();
                printWindow.onafterprint = function() {
                    printWindow.close();
                };
            });
            return false;
        }
    </script>
    @endpush
</div>