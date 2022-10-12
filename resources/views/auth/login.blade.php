@extends('layouts.auth.app')

@section('content')

                   <br><br><br><br>
                    <div class="max-w-2xl mx-auto sm:px-8 lg:px-10  pt-15" >
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4">
                          
                            <label for="exampleFormControlInput1"
                                class="block text-gray-700 text-sm font-bold mb-2">{{ __('E-Mail Address') }}<b style="color: red">*</b></label>
                            <input type="email"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput1" placeholder="Email" name="email" required autocomplete="email" autofocus >
                            @error('email') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                          
                            <label for="exampleFormControlInput1"
                                class="block text-gray-700 text-sm font-bold mb-2">{{ __('Password') }}<b style="color: red">*</b></label>
                            <input type="password"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput1" placeholder="Password" name="password" required autocomplete="password" autofocus >
                            @error('password') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>

                    

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-blue-600 text-base leading-6 font-bold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


                       </div>
                    </div>

@endsection
