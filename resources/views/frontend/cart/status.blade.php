@extends('layouts.user.index')

@section('content')
<livewire:global.frontend.status :users="$users" :details="$details" :borID="$borID" :barcode="$barcode" :borreturn="$borreturn" :remarks="$remarks"  />
     
@endsection
