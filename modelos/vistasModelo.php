<?php
	
	class vistasModelo{

		/*--------- Modelo obtener vistas ---------*/
		protected static function obtener_vistas_modelos($vistas){
			$listaBlanca=["iniciar","disponibilidad","home","usuario-lista","agregar-equipos","lista-devoluciones","buscar-devoluciones","lista-entregados","usuario-nuevo","buscar-usuario","actualizar-usuario","actualizar-entregados","agregar-devoluciones","actualizar-traspaso","buscar-entregados","agregar-equipo","lista-equipo","buscar-equipos","buscar-equipo","actualizar-equipo","entrega-equipos","soporte-equipos","actualizar-devoluciones","agregar-traspaso","lista-traspaso","buscar-traspaso","actualizar-traspaso","disponibilidad","vista-usuario"];
			if(in_array($vistas, $listaBlanca)){
				if(is_file("./vistas/contenidos/".$vistas."-view.php")){
					$contenidos="./vistas/contenidos/".$vistas."-view.php";
				}else{
					$contenidos="404";
				}
			}elseif($vistas=="login" || $vistas=="index"){
				$contenidos="login";
			
			}elseif ($vistas=="home"){
				$contenidos="home";
			}elseif ($vistas=="registrar-login"){
				$contenidos="registrar-login";
			}else{
				$contenidos="404";
			}
			return $contenidos;
		}
	}