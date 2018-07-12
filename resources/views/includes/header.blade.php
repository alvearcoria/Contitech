
	<div id="boton_barras">
		<span id="button-menu" class="fa fa-bars"></span>
	</div>
	<div id="titulo"> 
		<img src="{{ URL::asset('img/logo.png') }}" height="40px">
	</div>

	<div id="usuario">
		<span class="fa fa-user-md" ></span> {{ Auth::user()->id }} {{ Auth::user()->name }} 
	</div>

	<nav class="navegacion">
			<ul class="menu">
				<li>
					<a href="{{ url('/home') }}">
						<span class="fa fa-home icon-menu"></span>Inicio
					</a>
				</li>
			
				<li>
					<a href="{{ route('pacientes.index') }}" >
						<span class="fa fa-users icon-menu"></span>Pacientes
					</a>
				</li>

				<li>
					<a href="{{ route('plantas.index') }}" >
						<span class="fa fa-industry icon-menu"></span>Plantas
					</a>
				</li>
				
				<li>
					<a href="{{ route('logout') }}" 
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <span class="fa fa-sign-out-alt icon-menu"></span>{{ __('Salir') }}

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                	</a>
             	</li>
				<li class="ultimo_menu"></li>
			</ul>
		</nav>
		