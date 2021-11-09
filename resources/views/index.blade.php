@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @foreach ($categories as $category)
                    <h3 class="text-center mb-5 mt-3">{{ $category->name }}</h3>
                    <div class="row">
                        @foreach (App\Models\Food::where('category_id', $category->id)->get() as $food)
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img src="{{ asset('uploads/foods/' . $food->image) }}" class="card-img-top"
                                        alt="{{ $food->name }}" height="200">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $food->name }}</h5>
                                        <p class="card-text">{{ $food->price }} Taka</p>
                                        <p class="card-text">{{ $food->description }} Taka</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
