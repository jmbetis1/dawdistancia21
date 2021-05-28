<?php

/**
* Ejercicio 1.2 - Gestor de notas del módulo
*
* Gestiona las notas obtenidas en los exámenes
* y tareas del módulo mediante el uso de arrays en php
* Nos muestra las notas del módulo
* y podemos buscar los suspensos y cuantos sobresalientes
* se han obtenido
* PARA LA MODIFICACIÓN DEL EJERCICIO 2.2 MODIFICAMOS LA
* VERSION A 2.0
*
* @author 	Juan Manuel Marín Arellano
* @version 	2.0
* @copyright	Todos los derechos reservados (2021)
* @todo 	pasar la funcionalidad con arrays a base da datos
*
* link URL 	[https://educacionadistancia.juntadeandalucia.es/cursos/login/index.php]
*/


/** 
* Definimos los arrays que contienen las unidades y las notas por separado
* usando el orden del array para unir unidad y nota
* que seran los datos de la aplicación
* @access private
*/

/**
* @var array $unidades con las unidades del módulo
* @access private
*/ 
$unidades = ['1', '2', '3', '4', '5'];

/**
* @var array $teoria_notas con las notas de la parte de teoría
* @access private
*/
$teoria_notas = ['7', '4', '10', '9', '10'];

/**
* @var array $practica_notas con las notas de la parte práctica
* @access private
*/
$practica_notas = ['5', '6', '10', '10', '3'];

/**
* @var array $teoria unimos los arrays unidades y notas teoria en uno solo
* @access private
*/
$teoria = array_combine ($unidades, $teoria_notas);

/**
* @var array $practica unimos los arrays unidades y notas práctica en uno solo
* @access private
*/
$practica = array_combine ($unidades, $practica_notas);



/**
* Mostrar notas
*
* Función que genera un listado con las unidades y notas
* recibe un string con el tipo de notas a mostrar
* y un array bidimensional con los datos
* Primero generamos la cabecera de la tabla, según el tipo recibido
* Después recorremos el array para mostrar las unidades y notas
* En esta función usaremos dentro directamente los arrays creados
* usando $GLOBALS
*
* @author 	Juan Manuel Marín Arellano
* @version	1.0
* @param	string $tipo indica el tipo de notas: teoría o prácticas
* @global	array $teoria con las notas de teoría
* @global	array $practica con las notas de práctica
* @return	string $salida RETORNA el texto con el listado solicitado
* @access	private
*/
function mostrar_notas ($tipo) {
	if ($tipo == "teoria"){
		$salida = "Notas parte Teoría<hr>";
		$array = $GLOBALS['teoria'];
	} else if ($tipo == "practica") {
		$salida = "Notas parte Práctica<hr>";
		$array = $GLOBALS['practica'];
	}
	foreach ($array as $unidad=>$nota){			
		$salida .= "Unidad ".$unidad. " - Nota = ".$nota. "<br>";
	}
	return $salida;
}


/**
* Buscar suspensos
*
* Función que busca las notas que han suspendido
* Recibe un string con el tipo de nota en el que se va a buscar
* Recibe el array correspondiente al tipo indicado
* Primero recorremos el array, y en caso de encontrar una nota
* suspensa, cargamos un string que luego usaremos para la salida
*
* @author	Juan Manuel Marín Arellano
* @version	1.0
* @param	string $tipo indica el tipo de notas: teoría o prácticas
* @param	array $array recibe el array con las unidades y notas que se indican
* @return	string $suspenso RETORNA el texto con la información de las unidades suspensas
* @access	private
*/
function buscar_suspensos ($tipo, $array) {
	$suspenso = "";
	foreach ($array as $unidad=>$nota){
		if ($nota < 5) {
			$suspenso = "En ".$tipo;
			$suspenso .= " ha suspendido la unidad ".$unidad;
			$suspenso .= " con un ".$nota.".<br>";
		}
	}

	if ($suspenso == ""){
		$suspenso = "No ha suspendido ninguna unidad en ".$tipo.".";	
	}

	return $suspenso;
}


/**
* Contar sobresalientes
*
* Función que cuenta el número de sobresalientes que se tiene en un tipo
* No se reciben parámetros, y usamos los arrays iniciales
* declarándolos con GLOBALS
* Primero recorremos el array teoria, y en caso de encontrar un sobresaliente
* aumentamos la variable contadora
* Después hacemos lo mismo con el array de práctica
*
* @author	Juan Manuel Marín Arellano
* @version	1.0
* @global	array $teoria recibe array con las unidades y notas de teoría
* @global	array $practica recibe array con las unidades y notas de práctica
* @var		number $sobre_t cuenta los sobresalientes en el array teoría
* @var		number $sobre_p cuenta los sobresalientes en el array práctica
* @return	string $sobresalientes RETORNA el texto con la información de las unidades suspensas
* @access	private
*/
function contar_sobresalientes (){
	$sobre_t = 0;
	$dobre_p = 0;
	foreach ($GLOBALS['teoria'] as $unidad=>$nota){
		if ($nota >= 9) {
			$sobre_t ++;		
		}		
	}
	foreach ($GLOBALS['practica'] as $unidad=>$nota){
		if ($nota >= 9) {
			$sobre_p ++;		
		}		
	}

	$sobresalientes = "Ha obtenido ".$sobre_t." sobresalientes en Teoría.<br /><br />";
	$sobresalientes .= "Y ha obtenido ".$sobre_p." sobresalientes en Prácticas.";
	return $sobresalientes;
}
?>

<?php

/**
* Generamos el código HTML sobre el que mostrar nuestra aplicación
*/
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Notas DAW</title>
		<style type="text/css">
			body {
				font-family: Arial, Helvetica, sans-serif;
				padding: 50px;
				text-align: center;
			}
			h1 {
				color: #FFF;
			}
		</style>
	</head>
	<body>
		<div style="padding: 5px 20px; background-color: blue; margin-bottom: 20px;">
			<h1>Gestor de Notas del Módulo</h1>
			<h3>Versión 1.0</h3>
		</div>

		<div style=" width: 48%; border: solid 2px #666; float: left">
			<?php 
			/**
			* Llamamos a la función mostrar_notas para que nos liste las notas de teoría
			*/
			echo mostrar_notas ("teoria"); 
			?>
		</div>

		<div style=" width: 48%; border: solid 2px #666; float: right">
			<?php 
			/**
			* Llamamos a la función mostrar_notas para que nos liste las notas de práctica
			*/
			echo mostrar_notas ("practica"); 
			?>
		</div>

		<div style="clear: both"></div>
		
		<div style="margin-top: 50px;">
			<?php
			/**
			* Mostramos los botones que van a ejecutar las funcionalidades
			*/
			?>			
			<button name="suspensos" onclick="window.open ('practica-jumaar.php?accion=suspensos','_self')">Buscar Suspensos</button>
			<button name="sobresalientes" onclick="window.open ('practica-jumaar.php?accion=sobresalientes','_self')">Contar Sobresalientes</button>
			<button name="limpiar" onclick="window.open ('practica-jumaar.php','_self')">X</button>
		</div>

		<div style="margin-top:30px; border: solid 1px green; margin: 50px; padding: 10px 30px; color: green"><i><u>Panel de Resultados</u></i><br /><br />
			<?php
			/**
			* Panel de resultados
			*
			* Recibimos por GET la accion que tenemos que realizar y mostrar en el panel de resultados
			* si se recibe la accion suspensos, llamamos a la funcion buscar_suspensos
			* si se recibe la accion sobresalientes, llamamos a la función contar_sobresalientes
			*/
			if (isset ($_GET['accion'])) {
				$accion = $_GET['accion'];
				if ($accion == "suspensos"){
					echo buscar_suspensos ("teoria", $teoria);
					echo "<br />";
					echo buscar_suspensos ("practica", $practica);
				} else if ($accion == "sobresalientes"){
					echo contar_sobresalientes ();
				}
			}
			?>
		</div>
	</body>
</html>

