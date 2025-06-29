@extends('backend.master')
@section('mainContent')
    <div class="container-fluid dashboard-content ">
        <div class="row">
            <!-- pageheader -->
            <!-- ============================================================== -->

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">

                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tables</a></li>
                                <li class="breadcrumb-item active" aria-current="page">General Tables</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- end pageheader -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- bordered table -->
            <!-- ============================================================== -->
            <div class="col-12">
                @if (Session::has('success'))
                    <p class="alert alert-success"> {{ Session::get('success') }}</p>
                @elseif(Session::has('danger'))
                    <p class="alert alert-danger">{{ Session::get('danger') }}</p>
                    <!-- here to 'withWarning()' -->
                @endif
                <div class="card table-card">

                    <div class="row">

                        <div class="col-6">
                            <h5 class="card-header">product list</h5>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('product.create') }}" class="btn btn-primary text-white add-new-btn">Add
                                new</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">name</th>
                                    <th scope="col">qty</th>
                                    <th scope="col">short_description</th>
                                    <th scope="col">image</th>
                                    <th scope="col">order</th>
                                    </th>
                                    <th scope="col">status</th>
                                    <th scope="col">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $row)
                                    <tr>
                                     

                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->quantity }}</td>
                                        <td>{{ $row->short_description }}</td>
                                        <td>
                                            @foreach ($row->images as $image)
                                                <img src="{{ asset($image->file_path) }}" class="img responsive img-thumbnail" alt="Product Image"
                                                    style="width: 50px; height: 50px;">
                                            @endforeach
                                        </td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->order }}</td>
                                        <td class="{{ $row->status == 1 ? 'text-success' : 'text-danger' }}">
                                            {{ $row->status == 1 ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <a href="{{ route('product.edit', $row->id) }}"
                                                class="btn btn-info text-white .table-card">Edit</a>
                                            <a href="{{ route('category.destroy', $row->id) }}"
                                                onclick="return confirm('Are you sure you want to delete this category?')"
                                                class="btn btn-warning text-white .table-card">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $products->links() }}
                        </div>

                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end bordered table -->
            <!-- ============================================================== -->
        </div>
    </div>
@endsection
