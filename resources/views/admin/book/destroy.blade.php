@extends('layouts.app')

@section('content')
    <h2 aria-level="2">
        Suppresion du livre
    </h2>
    <form aria-label="Suppréssion du livre {{$book->title}}" role="form" method='POST' action="{{ route('book.destroy', ['book' => $book->title]) }}">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete Post" />
    </form>

@endsection
