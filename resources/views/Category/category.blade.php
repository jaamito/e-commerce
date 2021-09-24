@extends('layouts.app')

@section('content')
<div class="container">
    <div class='row'>
        <div class='col-md-9'>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add new category</h3>
                </div>
                <form method='post' action='{{ url('saveCategory') }}' enctype="multipart/form-data">
                @csrf
                    <div class="card-body">
                        <div class='row'>
                            <div class='col-md-6'>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category Name</label>
                                    <input type="text" class="form-control" id="categoryName" name='categoryName' placeholder="category name">
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class="form-group">
                                    <label for="productImage">Category image</label>
                                    <input type="file" class="form-control-file" id="categoryImage" name='categoryImage'>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
        <div class='col-md-3'>
            <form action='{{ url('removeCategory') }}' method='post' >
            @csrf
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Product categories</h3>
                    </div>
                    <div class='card-body'>
                        @foreach( $categories as $key => $category )
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value='{{$category->id}}' name='category[]' id="category">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{$category->categoryName}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class='card-footer'>
                        <button type='submit' class="btn btn-danger">Remove</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
