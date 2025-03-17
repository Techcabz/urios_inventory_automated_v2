@extends('layouts.user.index')

@section('content')


@include('frontend.items.single.banner')
<livewire:frontend.item.details :item="$item" />
        
@endsection