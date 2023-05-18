@extends('admin.layout.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Article</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Article</li>
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
                                <h3 class="card-title">Create Article</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" action="{{ route('article.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Name</label>
                                        <input type="text" class="form-control" name="title" id="title"
                                            placeholder="Title">
                                        <button type="button" id="generate">Generate</button>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" class="form-control" name="slug" id="slug"
                                            placeholder="Slug">
                                        @error('slug')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" class="form-control" name="price" id="price"
                                            placeholder="99">
                                    </div>
                                    <div class="form-group">
                                        <label for="discount_price">Discount Price</label>
                                        <input type="number" class="form-control" name="discount_price" id="discount_price"
                                            placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" id="description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-select form-control" id="status">
                                            <option value="">---Please Select---</option>
                                            <option value="1">Show</option>
                                            <option value="0">Hide</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="image_url" class="form-label">Image</label>
                                        <input type="file" class="form-control" name="image_url" id="image_url">
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

@section('js-custom')
    <script>
        let myEditor;
        ClassicEditor
            .create(document.querySelector('#description'))
            .then(editor => {
                myEditor = editor;
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#title').on('keyup', function() {
                let title = $(this).val();
                $.ajax({
                    method: 'POST', //method of form
                    url: "{{ route('article.get.slug') }}", // action of form
                    data: {
                        "title": title,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        $('#slug').val(res.title);
                    },
                    error: function(res) {

                    }
                });
            });
            $('#generate').on('click', function() {
                let name = $('#title').val();

                $.ajax({
                    method: 'POST', //method of form
                    url: "{{ route('write-generate') }}", // action of form
                    data: {
                        "title": name,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        // $('#description').val(res.content);
                        myEditor.setData(res.content);
                    },
                    error: function(res) {

                    }
                });
            });
        });
    </script>
@endsection
