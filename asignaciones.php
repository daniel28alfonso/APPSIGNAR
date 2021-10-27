<?php include ("menus.php") ?>
<?php include ("cabezera.php")?>
<?php

////////////////// CONEXION A LA BASE DE DATOS ////////////////////////////////////

/*$host="localhost";
$usuario="root";
$contraseña="";
$base="asignacion";

$conexion= new mysqli($host, $usuario, $contraseña, $base);
if ($conexion -> connect_errno)
{
	die("Fallo la conexion:(".$conexion -> mysqli_connect_errno().")".$conexion-> mysqli_connect_error());
}
////////////////// VARIABLES DE CONSULTA////////////////////////////////////

$where="";
if( isset($_POST['xnombre']) ) {
	$nombre = $_POST['xnombre'];
 }
if( isset($_POST['xcarrera']) ) {
	$carrera = $_POST['xcarrera'];
}
if( isset($_POST['xregistros']) ) {
	$limit = $_POST['xregistros'];
}

////////////////////// BOTON BUSCAR //////////////////////////////////////

if (isset($_POST['buscar']))
{

	

	if (empty($_POST['xcarrera']))
	{
		$where="where nombre like '".$nombre."%'";
	}

	else if (empty($_POST['xnombre']))
	{
		$where="where carrera='".$carrera."'";
	}

	else
	{
		$where="where nombre like '".$nombre."%' and carrera='".$carrera."'";
	}
}
/////////////////////// CONSULTA A LA BASE DE DATOS ////////////////////////

$alumnos="SELECT * FROM asignar $where ";
$resAlumnos=$conexion->query($alumnos);
$resCarreras=$conexion->query($alumnos);
$resNombre=$conexion->query($alumnos);

if(mysqli_num_rows($resAlumnos)==0)
{
	$mensaje="<h1>No hay registros que coincidan con su criterio de búsqueda.</h1>";
}*/
?>

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colrolib Templates">
    <meta name="author" content="Colrolib">
    <meta name="keywords" content="Colrolib Templates">

    <!-- Title Page-->
    <title>Asignación</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Asignaciones</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generar Excel</a>
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Asignar</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="collapseCardExample">
                        <div class="card-body">
                            <form action="operacion_guardar.php" method="POST">
                                <div class="row">
                                    <!------------------------------------------- NOMBRE ----------------------------------------------->
                                    <div class="col">
                                        <input type="text" class="form-control mb-2 mr-sm-2" REQUIRED name="nombre" placeholder="Nombre..." value="" />
                                    </div>
                                    <!------------------------------------------- CLIENTE ----------------------------------------------->
                                    <div class="col">
                                        <input type="text" class="form-control mb-2 mr-sm-2" REQUIRED name="cliente" placeholder="Cliente..." value="" />
                                    </div>
                                </div>
                                <!------------------------------------------- ESTADO ----------------------------------------------->
                                <div class="row">
                                    <div class="col">
                                        <select class="form-control mb-2 mr-sm-2" REQUIRED name="estado">
                                            <option value="">Estado...</option>
                                            <option value="Cloud">Cloud</option>
                                            <option value="Cloud/S4H">Cloud/S4H</option>
                                            <option value="DEV">DEV</option>
                                            <option value="S4H">S4H</option>
                                            <option value="Innovacion">Innovacion</option>
                                            <option value="B1">B1</option>
                                        </select>
                                    </div>
                                    <!------------------------------------------- LUGAR ----------------------------------------------->
                                    <div class="col">
                                        <select class="form-control mb-2 mr-sm-2" REQUIRED name="lugar">
                                            <option value="">Lugar de trabajo...</option>
                                            <option value="Consultor AMS">Consultor AMS</option>
                                            <option value="Consultor B1">Consultor B1</option>
                                        </select>
                                    </div>
                                </div>

                                <!------------------------------------------- DÍA --------------------------------------------------->
                                <div class="row">
                                    <div class="col">
                                        <br>
                                        <label class="m-0 font-weight-bold text-primary" class="label">Día:
                                        </label>
                                        <div class="col-auto" class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" name="jornada" value="Mañana" id="customCheck6">
                                                <label class="custom-control-label" for="customCheck6">
                                                    <h5>Lunes</h5>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto" class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" name="jornada" value="Mañana" id="customCheck7">
                                                <label class="custom-control-label" for="customCheck7">
                                                    <h5>Martes</h5>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto" class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" name="jornada" value="Mañana" id="customCheck8">
                                                <label class="custom-control-label" for="customCheck8">
                                                    <h5>Miercoles</h5>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto" class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" name="jornada" value="Mañana" id="customCheck9">
                                                <label class="custom-control-label" for="customCheck9">
                                                    <h5>Jueves</h5>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto" class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" name="jornada" value="Mañana" id="customCheck10">
                                                <label class="custom-control-label" for="customCheck10">
                                                    <h5>Viernes</h5>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto" class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" name="jornada" value="Mañana" id="customCheck11">
                                                <label class="custom-control-label" for="customCheck11">
                                                    <h5>Sábado</h5>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto" class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" name="jornada" value="Mañana" id="customCheck12">
                                                <label class="custom-control-label" for="customCheck12">
                                                    <h5>Domingo</h5>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto" class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" name="jornada" value="Mañana" id="customCheck13">
                                                <label class="custom-control-label" for="customCheck13">
                                                    <h5>Todos</h5>
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                    <!------------------------------------------- JORNADA ----------------------------------------------->

                                    <div class="col">
                                        <br>
                                        <label class="m-0 font-weight-bold text-primary" class="label">Jornada:</label>
                                        <br>
                                        <div class="col-auto" class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" name="jornada" value="Mañana" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">
                                                    <h5>Jornada de 8:00 a 10:00</h5>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto" class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" name="jornada" value="Mañana" id="customCheck2">
                                                <label class="custom-control-label" for="customCheck2">
                                                    <h5>Jornada de 10:00 a 12:00</h5>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto" class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" name="jornada" value="Mañana" id="customCheck3">
                                                <label class="custom-control-label" for="customCheck3">
                                                    <h5>Jornada de 1:00 a 3:00</h5>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto" class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" name="jornada" value="Mañana" id="customCheck4">
                                                <label class="custom-control-label" for="customCheck4">
                                                    <h5>Jornada de 3:00 a 5:00</h5>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto" class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" name="jornada" value="Mañana" id="customCheck5">
                                                <label class="custom-control-label" for="customCheck5">
                                                    <h5>Todo</h5>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!------------------------------------------- FECHA ----------------------------------------------->
                                <div class="row">
                                    <div class="col-auto">
                                        <label>
                                            <label class="m-0 font-weight-bold text-primary" class="label">Fecha Inicio</label>
                                            <input class="form-control mb-2 mr-sm-2" class="input--style-1" form-control mb-2 mr-sm-2 type="text" name="fechainicio" placeholder="mm/dd/yyyy" id="input-start">
                                        </label>
                                    </div>
                                    <div class="col-auto">
                                        <label class="m-0 font-weight-bold text-primary" class="label">Fecha Fin</label>
                                        <input class="form-control mb-2 mr-sm-2" class="input--style-1" type="text" name="fechafin" placeholder="mm/dd/yyyy" id="input-end">
                                    </div>
                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Escriba la descripción de la asignación..." id="floatingTextarea" style="height: 80px"></textarea>
                                </div>
                                <br><input type="submit" class="btn btn-dark" value="Asignar" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!--------------------------------- BUSCAR -------------------------------------------->


            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">

                    <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Buscar Asignaciones</h6>
                    </a>


                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="collapseCardExample2">
                        <div class="card-body">
                            <form action="operacion_guardar.php" method="POST">
                                <input type="text" class="form-control mb-2 mr-sm-2" REQUIRED name="Nombre" placeholder="Nombre..." value="" />
                                <!------------------------------------------- FECHA ----------------------------------------------->

                                <label class="m-0 font-weight-bold text-primary" class="label">Fecha Inicio</label>
                                <input class="form-control mb-2 mr-sm-2" class="input--style-1" form-control mb-2 mr-sm-2 type="text" name="fechainicio" placeholder="mm/dd/yyyy" id="input-start">

                                <label class="m-0 font-weight-bold text-primary" class="label">Fecha Fin</label>
                                <input class="form-control mb-2 mr-sm-2" class="input--style-1" type="text" name="fechafin" placeholder="mm/dd/yyyy" id="input-end">


                                <input type="date" class="form-control mb-2 mr-sm-2" id="start" name="trip-start" placeholder="Fecha inicio" value="" min="2021-01-01" max="2030-12-31" />
                                <input type="date" class="form-control mb-2 mr-sm-2" id="start" name="trip-start" placeholder="Fecha Fin" value="" min="2021-01-01" max="2030-12-31" />
                                <select class="form-control mb-2 mr-sm-2" REQUIRED name="Division">
                                    <option value="">División</option>
                                    <option value="Cloud">Cloud</option>
                                    <option value="Cloud/S4H">Cloud/S4H</option>
                                    <option value="DEV">DEV</option>
                                    <option value="S4H">S4H</option>
                                    <option value="Innovacion">Innovacion</option>
                                    <option value="B1">B1</option>
                                </select>


                                <select class="form-control mb-2 mr-sm-2" name="xnombre">
                                    <option value="">Nombre...</option>
                                    <?php
						      while ($registroNombre = $resNombre->fetch_array(MYSQLI_BOTH)){
							     echo '<option value="'.$registroNombre['nombre'].'">'.$registroNombre['nombre'].'</option>';
						      }
					        ?>
                                </select>

                                <select class="form-control mb-2 mr-sm-2" name="xcarrera">
                                    <option value="">Carrera </option>
                                    <?php
						      while ($registroCarreras = $resCarreras->fetch_array(MYSQLI_BOTH)){
							     echo '<option value="'.$registroCarreras['perfil'].'">'.$registroCarreras['perfil'].'</option>';
						      }
					        ?>
                                </select>

                                <select class="form-control mb-2 mr-sm-2" REQUIRED name="Perfil">
                                    <option value="">Perfil</option>
                                    <option value="Consultor AMS">Consultor AMS</option>
                                    <option value="Consultor B1">Consultor B1</option>
                                </select>
                                <input type="submit" class="btn btn-dark" value="Filtrar" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/jquery-validate/jquery.validate.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>
</body>
<?php include ("piedepagina.php")?>
