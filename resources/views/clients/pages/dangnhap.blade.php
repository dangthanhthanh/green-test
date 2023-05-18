@extends('clients.layout.master')

@section('title')
    Blog
@endsection

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Blog</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Blog</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row justify-content-center">
                <h2>Login</h2>
            </div>
            <div class="row justify-content-center">
                @auth
                    <a href="{{ route('dangxuat') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Dang xuat
                    </a>
                    <form id="logout-form" action="{{ route('dangxuat') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endauth
                @guest
                    <div class="col-md-4 align-self-center">
                        <form class="align-middle" method="post" action="{{ route('dangnhap') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                @endguest

            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection
