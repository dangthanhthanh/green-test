@extends('admin.layout.master')

@section('content')
    <div class="content-wrapper">
        {{-- {{ dd($errors) }} --}}
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Create User</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" action="{{ route('admin.user.save') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text"
                                            class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}"
                                            name="name" id="name" placeholder="Name" value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text"
                                            class="form-control {{ $errors->first('phone') ? 'is-invalid' : '' }}"
                                            name="phone" id="phone" placeholder="0352405575">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Email</label>
                                        <input type="text"
                                            class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}"
                                            name="email" id="email" placeholder="aaa@test.com">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password"
                                            class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}"
                                            name="password" id="password">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password"
                                            class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}"
                                            name="password_confirmation" id="confirmed_password">
                                        @error('confirmed_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-select form-control" id="status">
                                            <option value="">---Please Select---</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="is_admin">Role</label>
                                        <select name="is_admin" class="form-select form-control" id="is_admin">
                                            <option value="">---Please Select---</option>
                                            <option value="0">User</option>
                                            <option value="1">Admin</option>
                                        </select>
                                        @error('is_admin')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
