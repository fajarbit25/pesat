@extends('template.main')
@section('content')
    @livewire('hutang.detail', ['userid' => $userid])
@endsection