
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
					<a href="#" >
						<span class="fa fa-users icon-menu"></span>Pacientes
					</a>
				</li>

				<li>
					<a href="{{ route('plantas.index') }}" >
						<span class="fa fa-medkit icon-menu"></span>Plantas
					</a>
				</li>
				
				<li class="item-submenu" menu="1">
					<a href="#"><span class="fa fa-list-alt icon-menu"></span>Pase Médico</a>
					<ul class="submenu">
						<li class="title-menu"><span class="fa fa-list-alt icon-menu"></span>Pase Médico</li>
						<li class="go-back">Atras</li>

						<li>
							<a href="#" >
								<span class="fa fa-list-alt icon-menu"></span>Todos los Pases
							</a>
						</li>
						<li>
							<a href="#" >
								<span class="fa fa-tasks icon-menu"></span>Programación de Pases
							</a>
						</li>
						<li><a href="#"><span class="fa fa-chart-bar icon-menu"></span>Indicadores</a></li>
					</ul>
				</li>
				<li>
					<a href="#" >
						<span class="fa fa-industry icon-menu"></span>Clientes
					</a>
				</li>
				
				<li class="item-submenu" menu="2">
					<a href="#"><span class="fa fa-handshake icon-menu"></span>Recursos Humanos</a>
					<ul class="submenu">
						<li class="title-menu"><span class="fa fa-handshake icon-menu"></span>Recursos Humanos</li>
						<li class="go-back">Atras</li>

						<li>
							<a href="#" >
								<span class="fa fa-address-book icon-menu"></span>Puestos
							</a>
						</li>
						<li>
							<a href="#ndex') }}" >
								<span class="fa fa-user-md icon-menu"></span>Empleado
							</a>
						</li>
						<li><a href="#"><span class="fa fa-file icon-menu"></span>Asignar puesto</a></li>
					</ul>
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
		