@extends('admin.layouts.master')

@section('title', 'Product List')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Product List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Product
                                </button>
                            </a>
                            {{-- <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button> --}}
                        </div>
                    </div>



                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-trash me-2"></i> {{ session('deleteSuccess') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-2 bg-white py-2 rounded shadow-sm text-center">
                            <h3><i class="fa-solid fa-database"></i> Total - {{ $pizzas->total() }}</h3>
                        </div>
                        <div class="col-3 d-flex align-items-center text-center">
                            @if (request('key') != null)
                                <h4 class="text-secondary">Search key : <span
                                        class="text-danger">{{ request('key') }}</span></h4>
                            @endif
                        </div>
                        <div class="col-3 offset-4">
                            <form action="{{ route('product#list') }}" method="get">
                                {{-- @csrf --}}
                                <div class="input-group">
                                    <input type="text" name='key' class="form-control" placeholder="Search Here..."
                                        value="{{ request('key') }}">
                                    <button type="submit" class="text-white btn btn-dark"><i
                                            class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2 mt-3">
                        @if (count($pizzas) != 0)
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Pirce</th>
                                        <th>View</th>
                                        <th>Category</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pizzas as $pizza)
                                        <tr class="tr-shadow">
                                            <td class="col-2">
                                                <img src="{{ asset('storage/' . $pizza->image) }}" alt="{{ $pizza->name }}"
                                                    class="rounded shadow-sm" style="height: 65px; width:60px;">
                                            </td>
                                            <td class="col-3"> {{ $pizza->name }} </td>
                                            <td class="col-2"> {{ $pizza->price }} </td>
                                            <td class="col-1"><i class="fa-solid fa-eye"></i> {{ $pizza->view_count }}
                                            </td>
                                            <td class="col-3"> {{ $pizza->category_name }} </td>
                                            <td class="col-2">
                                                <div class="table-data-feature">
                                                    <a href="{{ route('product#edit', $pizza->id) }}">
                                                        <button class="item mr-1" data-toggle="tooltip" data-placement="top"
                                                            title="View">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </button>
                                                    </a>

                                                    <a href="{{ route('product#updatePage', $pizza->id) }}">
                                                        <button class="item mr-1" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                    </a>

                                                    <a href="{{ route('product#delete', $pizza->id) }}">
                                                        <button class="item mr-1" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $pizzas->links() }}
                            </div>
                        @else
                            <h3 class="text-center text-secondary mt-5">There is no data Here.</h3>
                        @endif
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection
