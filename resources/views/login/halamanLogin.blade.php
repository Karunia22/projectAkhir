<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .peringatan{
            background-color: red; 
        }
    </style>
</head>

<body>
    <div class="container">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <h2>Login</h2>
            @if ($errors->any())
                <div class="peringatan">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

    </div>
    <div class="input">
        <label for="">email</label>
        <input type="email" name="email" >
    </div>
    <div class="input">
        <label for="">password</label>
        <input type="password" name="password">
    </div>

    <button type="submit" name="submit">Login</button>
    </form>
    </div>
</body>

</html>
