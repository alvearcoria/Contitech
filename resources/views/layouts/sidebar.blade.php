<!doctype html>
<html>
    <head>
        @include('includes.head')
    </head>

    @php
        $plantas_perm="";
        for($i=1; $i<=5;$i++){
            switch ($i) {
                case 1:
                    if(Auth::user()->perm_planta_1==1){
                        $plantas_perm=$plantas_perm."1,";
                    }
                    break;
                case 2:
                    if(Auth::user()->perm_planta_2==1){
                        $plantas_perm=$plantas_perm."2,";
                    }
                    break;
                case 3:
                    if(Auth::user()->perm_planta_3==1){
                        $plantas_perm=$plantas_perm."3,";
                    }
                    break;
                case 4:
                    if(Auth::user()->perm_planta_4==1){
                        $plantas_perm=$plantas_perm."4,";
                    }
                    break;
                case 5:
                    if(Auth::user()->perm_planta_5==1){
                        $plantas_perm=$plantas_perm."5,";
                    }
                    break;
            }
        }
        $plantas_perm=rtrim($plantas_perm,',');
        $plantas_perm=explode(',', $plantas_perm);

        $hoy = date('Y-m-d');
        $count_inc=\App\Incapacidad::whereIn('id_planta',$plantas_perm)->where('id_accidente',null)->where('estatus_inc','A')->where('fecha_ing_lab','<',$hoy)->count();
    @endphp

    <body>
         <div class="indicadores" id="indicadores">       
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button class="btn btn-default btn-lg btn-link" style="font-size:25px; color: #ffffff;">
                                <span class="fa fa-band-aid icon-menu"></span>
                            </button>
                            <span class="badge badge-notify">1</span>
                            <br>
                            <br>
                            <button class="btn btn-default btn-lg btn-link" style="font-size:25px; color: #ffffff;">
                                <span class="fa fa-procedures icon-menu"></span>
                            </button>
                            <span class="badge badge-notify">{{ $count_inc }}</span>
                        </div>
                    </div>
            </div>

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