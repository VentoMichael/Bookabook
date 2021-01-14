@extends('layouts.app')
@section('content')

    <x-user :users="$users" :studentSuspended="$studentSuspended" :letters="$letters" :totalbooks="$totalbooks" :statuses="$statuses"></x-user>
@endsection
