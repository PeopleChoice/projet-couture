@extends('layouts.auth.app')

@section('content')

<div class="animate form login_form">
    <section class="login_content">
        <form method="POST" action="{{ route('login') }}">
            <h1>Dane Haute Couture</h1>
            @csrf
            <div>
                <input type="email"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="exampleFormControlInput1" placeholder="Email" name="email" required autocomplete="email"
                    autofocus>
                @error('email') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
            <div>

                <input type="password"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="exampleFormControlInput1" placeholder="Password" name="password" required
                    autocomplete="password" autofocus>
                @error('password') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>






            <div>
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>



            </div>
        </form>
    </section>
</div>


@endsection