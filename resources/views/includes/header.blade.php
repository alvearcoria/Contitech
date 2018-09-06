
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

				@if(Auth::user()->permisos_user=="E")
				<li class="item-submenu" menu="1">
					<a href="#"><span class="fa fa-book icon-menu"></span>Catálogos</a>
					<ul class="submenu">
						<li class="title-menu"><span class="fa fa-book icon-menu"></span>Catálogo</li>
						<li class="go-back">Atras</li>
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
							<a href="{{ route('puestos.index') }}" >
								<span class="fa fa-address-book icon-menu"></span>Puestos
							</a>
						</li>

						<li>
							<a href="{{ route('areas.index') }}" >
								<span class="fa fa-project-diagram icon-menu"></span>Áreas
							</a>
						</li>

						<li>
							<a href="{{ route('diagnosticos.index') }}" >
								<span class="fa fa-file-medical-alt icon-menu"></span>Diagnosticos
							</a>
						</li>

						<li>
							<a href="{{ route('partes_cuerpo.index') }}" >
								<span class="fa fa-diagnoses icon-menu"></span>Partes del cuerpo
							</a>
						</li>

								
					</ul>
				</li>
				@endif

				<li>
					<a href="{{ route('accidentes.index') }}" >
						<span class="fa fa-band-aid icon-menu"></span>Accidentabilidad
					</a>
				</li>
				
				<li>
					<a href="{{ route('incapacidades.index') }}" >
						<span class="fa fa-procedures icon-menu"></span>Incapacidad
					</a>
				</li>

				<li>
					<a href="{{ route('indicadores.index') }}" >
						<span class="fa fa-chart-line icon-menu"></span>Indicadores
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
		