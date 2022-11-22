@extends('admin.layouts.master')

@section('title','Category List')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="row">
                                <div class="col-4">
                                    <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                                </div>
                                <div class="col-4">
                                    <h3 class="text-center title-2">Update Pizza</h3>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <form action="{{ route('product#update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-5 offset-1">
                                    <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">
                                    <img src="{{ asset('storage/'.$pizza->image) }}" alt="Pizza Product" class="img-thumbnail shadow-sm d-block mx-auto" />
                                    <div class="mt-3">
                                        <input type="file" name="pizzaImage" class="form-control @error('pizzaImage')
                                        is-invalid
                                        @enderror">
                                        @error('pizzaImage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-dark text-white w-100"><i class="fa-solid fa-circle-chevron-right mr-1"></i>Update</button>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="control-label mb-1">Name</label>
                                        <input name="pizzaName" type="text" class="form-control @error('pizzaName') is-invalid @enderror" value="{{ old('pizzaName',$pizza->name) }}" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name...">
                                        @error('pizzaName')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Description</label>
                                        <textarea name="pizzaDescription" id="" cols="30" rows="10" class="form-control @error('pizzaDescription') is-invalid @enderror" placeholder="Enter Description...">{{ old('pizzaDescription',$pizza->description) }}</textarea>
                                        @error('pizzaDescription')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Category</label>
                                        <select name="pizzaCategory" class="form-control @error('pizzaCategory') is-invalid @enderror">
                                            <option value="">Choose Pizza</option>
                                            @foreach ($categories as $category )
                                                <option value="{{ $category->id }}" @if ($pizza->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('pizzaCategory')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">Price</label>
                                        <input type="number" name="pizzaPrice" id="" class="form-control @error('pizzaPrice') is-invalid @enderror" value="{{ old('pizzaPrice',$pizza->price) }}" placeholder="Enter Price...">
                                        @error('pizzaPrice')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">Waiting Time</label>
                                        <input type="number" name="pizzaWaitingTime" id="" class="form-control @error('pizzaWaitingTime') is-invalid @enderror" value="{{ old('pizzaWaitingTime',$pizza->waiting_time) }}" placeholder="Enter Wating Time...">
                                        @error('pizzaWaitingTime')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">View Count</label>
                                        <input type="text" class="form-control" value="{{ $pizza->view_count }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label mb-1">Created At</label>
                                        <input type="text" class="form-control" value="{{ $pizza->created_at->format('j-M-Y')}}" disabled>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
