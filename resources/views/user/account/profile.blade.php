@extends('user.layouts.master')
@section('title','Profile')
@section('content')
<div class="container-fluid ">
    <div class="main-content">
        <div class="section__content section__content--p30 p-sm-0">
            <div class="container-fluid">
                <div class="col-md-10 offset-md-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2 text-uppercase">{{ Auth::user()->name }} Info</h3>
                            </div>
                            <hr>
                            <form action="{{ route('user#accountUpdate',Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @if(session('updateSuccess'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-check"></i> {{ session('updateSuccess') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-5 offset-md-1">
                                        @if(Auth::user()->image == null)
                                            @if(Auth::user()->gender == 'female')
                                            <img src="{{ asset('image/default_female.jpg') }}" alt="" class="img-thumbnail shadow-sm">
                                            @else
                                            <img src="{{ asset('image/default_user.png') }}" alt="" class="img-thumbnail shadow-sm">
                                            @endif
                                        @else
                                        <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="John Doe" class="img-thumbnail shadow-sm" />
                                        @endif
                                        <div class="mt-3">
                                            <input type="file" name="image" class="form-control @error('image')
                                            is-invalid
                                            @enderror">
                                            @error('image')
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
                                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',Auth::user()->name) }}" aria-required="true" aria-invalid="false" placeholder="Enter Admin Name...">
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Email</label>
                                            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',Auth::user()->email) }}" aria-required="true" aria-invalid="false" placeholder="Enter Admin Email...">
                                            @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                            <textarea name="address" id="" cols="30" rows="10" class="form-control @error('address') is-invalid @enderror">{{ old('name',Auth::user()->address) }}</textarea>
                                            @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Phone</label>
                                            <input name="phone" type="number" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone',Auth::user()->phone) }}" aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone...">
                                            @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Gender</label>
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="male" @if(Auth::user()->gender =="male") Selected @endif>Male</option>
                                                <option value="female" @if(Auth::user()->gender =="female") Selected @endif>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Role</label>
                                            <input name="role" type="text" class="form-control" value="{{ old('role',Auth::user()->role) }}" aria-required="true" aria-invalid="false" placeholder="Enter Admin Address..." disabled>
                                        </div>
                                        {{-- @error('categoryName')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror --}}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
