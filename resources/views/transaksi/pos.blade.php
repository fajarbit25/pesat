@extends('template.main')
@section('content')
    @livewire('transaksi.pos', [
        'userid'    => $userid,
    ])
@endsection