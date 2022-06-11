@extends('components.master-index')

@section('content')
    <div class="container h-100">

        <!-- Outer Row -->
        <div class="row align-items-center h-100">

            <div class="col-xl-10 col-lg-12 col-md-9 mx-auto">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0 ">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            {{-- <div class="col-lg-6 d-none d-lg-block bg-login-image "></div> --}}
                            <div class="col-lg-6 d-none d-flex align-items-center justify-content-center p-5">
                                <img src="{{ asset('image/SMAN11.jpg') }}" alt="" srcset="">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form action="{{ route('login') }}" method="post" enctype="multipart/form-data"
                                        class="user">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." name="email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" name="password">
                                        </div>
                                        <div class="form-group">
                                            {{-- <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div> --}}
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <div class="mt-2 mx-2 d-flex flex-row-reverse">
                                        <a href="{{route('reset.view')}}"><p style="font-size: 12px">Reset Password</p style="font-size: 12px"></a>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
