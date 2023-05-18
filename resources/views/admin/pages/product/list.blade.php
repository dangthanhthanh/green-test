@extends('admin.layout.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DataTables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h3 class="card-title">DataTable with default features</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ route('admin.product.create') }}"
                                            class="btn btn-primary float-right">Create</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <form class="form-inline" method="GET" action="{{ route('admin.product.list') }}">
                                        <div class="form-group col-md-4">
                                            <label for="keyword">Search</label>
                                            <input type="text" class="form-control" name="keyword" id="keyword"
                                                placeholder="Keyword" value="{{ request()->keyword ?? '' }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputState">Status</label>
                                            <select id="inputState" class="form-control" name="status">
                                                <option value="">Choose...</option>
                                                <option value="1">Show</option>
                                                <option value="0">Hide</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-2">Search</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Image</th>
                                            <th>Category Name</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $product)
                                            <tr>
                                                <td>{{ $product->id }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{!! $product->description !!}</td>
                                                <td>{{ number_format($product->price, 2) }}</td>
                                                <td>{{ $product->status ? 'Show' : 'Hide' }}</td>
                                                <td>
                                                    <img width="150" height="150"
                                                        src="{{ asset('images') . '/' . $product->image_url }}">
                                                </td>
                                                <td>{{ $product->product_category_name }}</td>
                                                {{-- <td>{{ $product->category->name }}</td> --}}
                                                <td>
                                                    <a
                                                        href="{{ route('admin.product.detail', ['id' => $product->id]) }}">Detail</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8">No Product</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection


@section('js-custom')
    <!-- DataTables -->
    <script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
