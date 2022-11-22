@extends('admin.layouts.master')

@section('title','Create Pizza')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('product#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Create your Product</h3>
                        </div>
                        <hr>
                        <form action="{{ route('product#create') }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="control-label mb-1">Name</label>
                                <input name="pizzaName" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter Product Name..." value="{{ old('pizzaName') }}">
                                @error('pizzaName')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-1">Category</label>
                                <select name="pizzaCategory" class="form-control">
                                    <option value="">Choose Category</option>
                                    @foreach ($categories as $category )
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('pizzaCategory')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-1">Description</label>
                                <textarea name="pizzaDescription" class="form-control" rows="5" placeholder="Enter Description...">{{ old('pizzaDescription') }}</textarea>
                                @error('pizzaDescription')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-1">Image</label>
                                <input name="pizzaImage" type="file" class="form-control" aria-required="true" aria-invalid="false" value="{{ old('pizzaImage') }}">
                                @error('pizzaImage')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-1">Waiting Time</label>
                                <input name="pizzaWaitingTime" type="number" class="form-control" aria-required="true" aria-invalid="false" value="{{ old('pizzaWaitingTime') }}" placeholder="Enter Waiting Time">
                                @error('pizzaWaitingTime')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-1">Price</label>
                                <input name="pizzaPrice" type="number" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter Product Price..." value="{{ old('pizzaPrice') }}">
                                @error('pizzaPrice')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Create</span>
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
