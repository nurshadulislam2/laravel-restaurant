@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Food') }}</div>

                    <div class="card-body">
                        <form action="{{ route('food.update', $food->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text"
                                    class="form-control @error('name')
                                    is-invalid
                                @enderror"
                                    id="name" name="name" value="{{ $food->name }}">
                                @error('name')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select class="form-control" id="category_id" name="category_id">
                                    @foreach ($categories as $category)
                                        @if ($category->id == $food->category_id)
                                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @endif
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" name="image" id="image"
                                    accept="image/png, image/jpeg">
                                <img src="{{ asset('/uploads/foods/' . $food->image) }}" width="80"
                                    alt="{{ $food->name }}">
                                @error('image')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number"
                                    class="form-control @error('price')
                                    is-invalid
                                @enderror"
                                    id="price" name="price" value="{{ $food->price }}">
                                @error('price')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea
                                    class="form-control @error('description')
                                    is-invalid
                                @enderror"
                                    id="description" name="description" rows="3">{{ $food->description }}</textarea>
                                @error('description')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
