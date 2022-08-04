@extends('components.master-index')

@section('content')

    <div class="container">
        <div class="row justify-content-center p-5">
            <div class="col-4">
                <div class="card ">
                    <div class="m-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
                        </div>
                        @if (Session::has('errors'))
                            <p class="text-danger text-center" style="font-size: 12px">{{Session::get('errors')->first()}}</p>
                        @endif
                        <form class="user" action="{{route('reset')}}" method="post" >
                            @csrf
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail"
                                    aria-describedby="emailHelp" placeholder="Enter Email Address...">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword"
                                    placeholder="New Password">
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Reset
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
