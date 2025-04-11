@extends('layouts.user.index')

@section('content')


@include('frontend.items.single.banner')
<livewire:frontend.item.details :item="$item" />
<livewire:frontend.active-borrower />
        
@endsection