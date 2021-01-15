@extends('layouts.app')
@section('content')
    @foreach($books as $book)
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="{{ $book->imagePath }}" alt="..." class="img-responsive">
                <div class="caption">
                    <h3>{{ $book->title }}</h3>
                    <p class="description">{{ $book->description }}</p>
                    <div class="clearfix">
                        <div class="pull-left price">${{ $book->price }}</div>
                        <a href="{{ route('product.addToCart', ['id' => $book->id]) }}"
                           class="btn btn-success pull-right" role="button">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
