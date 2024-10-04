@extends('template.main')
@section('content')
    @livewire('egg.inbound', [
        'bound' => 'pembelian', 
        'tipe' => 'egg', 
        'userid' => $userid
        ]);
@endsection