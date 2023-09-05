@extends('admin.layouts.master')

@section('title', 'FF Details')

@section('content')

    <div class="main-content">
        <div class="row">
            @if (session('updateSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check"></i> {{ session('updateSuccess') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif
        </div>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="ml-5">
                                {{-- <a href="{{ route('product#list') }}" class="text-decoration-none text-dark"> --}}
                                <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                                {{-- </a> --}}
                            </div>
                            {{-- <div class="card-title">
                            <h3 class="text-center title-2">Pizza Details</h3>
                        </div> --}}
                            <hr>

                            <div class="row">
                                <div class="col-3 offset-2">
                                    <img src="{{ asset('storage/' . $pizza->image) }}" alt="John Doe"
                                        class="img-thumbnail shadow-sm" />
                                </div>
                                <div class="col-7">

                                    <div class="my-3 btn rounded bg-danger text-white w-50 d-block fs-5 text-center">
                                        {{ $pizza->name }}</div>
                                    <span class="my-3 btn rounded bg-dark text-white fs-6"><i
                                            class="fa-solid fs-4 fa-money-bill-1-wave mr-1"></i>{{ $pizza->price }}kyats</span>
                                    <span class="my-3 btn rounded bg-dark text-white fs-6"><i
                                            class="fa-solid fs-4 fa-clock mr-1"></i>{{ $pizza->waiting_time }}mins</span>
                                    <span class="my-3 btn rounded bg-dark text-white fs-6"><i
                                            class="fa-solid fs-4 fa-eye mr-1"></i>{{ $pizza->view_count }}</span>
                                    <span class="my-3 btn rounded bg-dark text-white fs-6"><i
                                            class="fa-solid fa-clone mr-1"></i>{{ $pizza->category_name }}</span>
                                    <span class="my-3 btn rounded bg-dark text-white fs-6"><i
                                            class="fa-solid fs-4 fa-calendar-days mr-1 bold"></i>{{ $pizza->created_at->format('j. F. Y') }}</span>

                                    <div class="my-3"><i class="fa-solid fs-4 fa-file-lines mr-2"></i>Details</div>
                                    <div class="">{{ $pizza->description }}</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
