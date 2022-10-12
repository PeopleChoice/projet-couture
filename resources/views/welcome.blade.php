<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dane Haute Couture</title>

        <!-- Styles -->
     

        <style>
            body {
                font-family: 'Calibri', sans-serif;
                
            }
         
           
        </style>
    </head>
    <body class="antialiased"  >
        <div wire:offline>
            
        </div>
        <div >
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline" style="text-align: end">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-2xl text-black-300 underline font-bold" style="text-align: end">Connexion</a>

                    @endauth
                </div>
            @endif
            <br><br><br>
            <p style="text-align: center;vertical-align: middle;margin-top: 20%;font-size: 25px;font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">DANE HAUTE COUTURE</p>
           
        </div>
    </body>
</html>
