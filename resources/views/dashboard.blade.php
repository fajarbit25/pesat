@extends('template.main')
@section('content')
  <div class="row">

    @if(session('error'))
      <div class="col-sm-10 mb-3">
        <div class="alert alert-danger text-light col-sm-12 mx-3">
          <span class="fw-bold">{{ session('error') }}</span>
        </div>
      </div>
    @endif


    <div class="col-sm-3">
      <div class="card  mb-2">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">payments</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Total Piutang</p>
            <h4 class="mb-0">Rp.{{number_format($piutang)}},-</h4>
          </div>
        </div>
      
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3"></div>
      </div>
    </div>

    <div class="col-sm-3">
      <div class="card  mb-2">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-warning shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">payments</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Hutang Ke Costumer</p>
            <h4 class="mb-0"> {{number_format(abs($piutangMines))}} </h4>
          </div>
        </div>
  
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3"></div>
      </div>
    </div>

    <div class="col-sm-3">
      <div class="card  mb-2">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-danger shadow-danger shadow text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">payments</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Total Hutang</p>
            <h4 class="mb-0">Rp.{{number_format($hutang)}},-</h4>
          </div>
        </div>
      
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3"></div>
      </div>
    </div>

    <div class="col-sm-3">
      <div class="card  mb-2">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">engineering</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Total Upah Buruh</p>
            <h4 class="mb-0"> Rp.{{number_format($upahBuruh)}},- </h4>
          </div>
        </div>
  
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3"> </div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="card ">
        <div class="card-header p-3 pt-2 bg-transparent">
          <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">download</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize fw-bold text-info">Total Pemasukan</p>
            <hr class="horizontal my-3 dark"> 
            <ol class="list-group list-group-numbered">
              <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                  <div class="fw-bold">Hari Ini</div>
                </div>
                <span class="badge text-bg-info rounded-pill">{{number_format($pemasukan['hari'])}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                  <div class="fw-bold">Minggu ini</div>
                </div>
                <span class="badge text-bg-info rounded-pill">{{number_format($pemasukan['minggu'])}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                  <div class="fw-bold">Bulan ini</div>
                </div>
                <span class="badge text-bg-info rounded-pill">{{number_format($pemasukan['bulan'])}}</span>
              </li>
            </ol>

          </div>
        </div>
      
        <hr class="horizontal my-0 dark">
        <div class="card-footer p-3"></div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="card ">
        <div class="card-header p-3 pt-2 bg-transparent">
          <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">upload</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize fw-bold text-success">Total Pengeluaran</p>
            <hr class="horizontal my-3 dark"> 
            <ol class="list-group list-group-numbered">
              <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                  <div class="fw-bold">Hari Ini</div>
                </div>
                <span class="badge text-bg-success rounded-pill">{{number_format($pembelian['hari'])}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                  <div class="fw-bold">Minggu ini</div>
                </div>
                <span class="badge text-bg-success rounded-pill">{{number_format($pembelian['minggu'])}}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                  <div class="fw-bold">Bulan ini</div>
                </div>
                <span class="badge text-bg-success rounded-pill">{{number_format($pembelian['bulan'])}}</span>
              </li>
            </ol>

          </div>
        </div>
      
        <hr class="horizontal my-0 dark">
        <div class="card-footer p-3"></div>
      </div>
    </div>

  </div>
@endsection