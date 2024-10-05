@extends('template.main')
@section('content')
    @livewire('egg.inbound', ['bound' => 'penjualan', 'tipe' => 'egg', 'userid' => $userid])
@endsection