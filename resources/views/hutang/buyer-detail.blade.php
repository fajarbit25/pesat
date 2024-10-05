@extends('template.main')
@section('content')
    @livewire('hutang.buyer-detail', ['userid' => $userid])
@endsection