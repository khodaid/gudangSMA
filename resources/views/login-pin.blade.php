@extends('components.master-index')

@section('content')

    <div class="container">
        <div class="row justify-content-center p-5">
            <div class="col-4">
                <div class="card ">
                    <div class="m-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Login Public</h1>
                        </div>
                        @if (Session::has('errors'))
                            <p class="text-danger text-center" style="font-size: 12px">{{Session::get('errors')->first()}}</p>
                        @endif
                        <form class="user" action="{{route('public.login')}}" method="post" >
                            @csrf
                            <div class="form-group">
                                <input type="text" name="pin" class="form-control form-control-user" id="exampleInputEmail"
                                    aria-describedby="emailHelp" placeholder="Enter PIN">
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Login
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
