<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{$pageTitle}}</title>
    <link rel="stylesheet" href="{{asset('clients/css/bootstrap.min.css')}}" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="{{asset('clients/css/reset.css')}}" />
    <link rel="stylesheet" href="{{asset('clients/css/sign-in.css')}}" />
    <link rel="stylesheet" href="{{asset('clients/css/sign-up.css')}}" />

</head>
<body>
@yield('content')
</body>
</html>
