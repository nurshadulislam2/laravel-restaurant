@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                <h4>{{ __('All Food') }}</h4>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('food.create') }}" class="btn btn-primary">Create</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (count($foods) > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($foods as $food)
                                        <tr>
                                            <td>{{ $food->name }}</td>
                                            <td>
                                                <img src="{{ asset('/uploads/foods/' . $food->image) }}" width="100"
                                                    alt="{{ $food->name }}">
                                            </td>
                                            <td>{{ $food->category->name }}</td>
                                            <td>{{ $food->price }}</td>
                                            <td>{{ $food->description }}</td>
                                            <td>
                                                <a href="{{ route('food.edit', $food->id) }}" class="btn btn-warning"><i
                                                        class="fas fa-edit"></i></a>
                                            </td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#exampleModal{{ $food->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{ $food->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    {{ $food->name }}</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Delete This food?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('food.delete', $food->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $foods->links() }}
                        @else
                            No data found!!!
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
