@extends('layouts.app')
@section('content')
    <x-user :users="$users" :letters="$letters" :totalbooks="$totalbooks" :statuses="$statuses"></x-user>
@endsection
