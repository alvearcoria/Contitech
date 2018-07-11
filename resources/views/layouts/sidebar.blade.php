<!doctype html>
<html>
    <head>
        @include('includes.head')
    </head>

    <body>
        <div class="container">
        <header>
            @include('includes.header')
        </header>
        
        <div class="container" id="contenido">
            @yield('content')
        </div>
    
        <!--
        <footer class="footer">
            @include('includes.footer')
        </footer>
    -->
        </div>
</body>

</html>