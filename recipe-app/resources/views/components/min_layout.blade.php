<html>
<head>
    @include('components.head')
    <meta name="keywords" content="App, Vigi, Laravel">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">AppVigi</a>
        <a href="{{ url('recipes') }}" class="navbar-brand" aria-current="page">All recipes</a>
        <a href="{{ url('admin/recipe') }}" class="navbar-brand ms-auto" aria-current="page">Admin</a>
        <div class="collapse navbar-collapse" id="navbarCollapse">
        </div>
    </div>
</nav>
<div class="container">
    @yield('content')
</div>
<footer class="container">
    &copy 2023 Vigi App
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>