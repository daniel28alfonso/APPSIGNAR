<?php  

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombres=(isset($_POST['txtNombres']))?$_POST['txtNombres']:"";
$txtApellidos=(isset($_POST['txtApellidos']))?$_POST['txtApellidos']:"";
$txtDivision=(isset($_POST['txtDivision']))?$_POST['txtDivision']:"";
$txtPerfil=(isset($_POST['txtPerfil']))?$_POST['txtPerfil']:"";
$txtCorreo=(isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"";
$txtFoto=(isset($_FILES['txtFoto']["name"]))?$_FILES['txtFoto']["name"]:"";

$accion=(isset($_POST['accion']))?$_POST['accion']:"";

//$accionAgregar="";
//$accionModificar

include ("global/conexion.php");

switch($accion){
        case "btnAgregar":

          $sentencia= $pdo ->prepare("INSERT INTO empleados(Nombres,Apellidos,Division,Perfil,Correo,Foto) 
          VALUES (:Nombres,:Apellidos,:Division,:Perfil,:Correo,:Foto) ");
            $sentencia->bindParam(':Nombres',$txtNombres);
            $sentencia->bindParam(':Apellidos',$txtApellidos);
            $sentencia->bindParam(':Division',$txtDivision);
            $sentencia->bindParam(':Perfil',$txtPerfil);
            $sentencia->bindParam(':Correo',$txtCorreo);

            $Fecha= new DateTime();
            $nombreArchivo=($txtFoto!="")?$Fecha->getTimestamp()."_".$_FILES["txtFoto"]["name"]:"imagen.png";
            $tmpFoto= $_FILES["txtFoto"]["tmp_name"];
            if ($tmpFoto!=""){
                move_uploaded_file($tmpFoto,"../appsignar/imagenes/".$nombreArchivo);
            }

            $sentencia->bindParam(':Foto',$nombreArchivo);


            $sentencia->execute();
            
        break;


        case "btnModificar":
            $sentencia= $pdo ->prepare("UPDATE  empleados SET 
            Nombres=:Nombres,
            Apellidos=:Apellidos,
            Division=:Division,
            Perfil=:Perfil,
            Correo=:Correo
            WHERE
            ID =:ID"); 
            
              $sentencia->bindParam(':Nombres',$txtNombres);
              $sentencia->bindParam(':Apellidos',$txtApellidos);
              $sentencia->bindParam(':Division',$txtDivision);
              $sentencia->bindParam(':Perfil',$txtPerfil);
              $sentencia->bindParam(':Correo',$txtCorreo);
              $sentencia->bindParam(':ID',$txtID);
  
              $sentencia->execute();
              $Fecha= new DateTime();
              $nombreArchivo=($txtFoto!="")?$Fecha->getTimestamp()."_".$_FILES["txtFoto"]["name"]:"imagen.png";
              $tmpFoto= $_FILES["txtFoto"]["tmp_name"];
              if ($tmpFoto!=""){
                  move_uploaded_file($tmpFoto,"../appsignar/imagenes/".$nombreArchivo);
                  $sentencia=$pdo->prepare("SELECT Foto From empleados WHERE ID=:ID");
                 $sentencia->bindParam(':ID',$txtID);
                 $sentencia->execute();
                 $empleado=$sentencia->fetch(PDO::FETCH_LAZY);
                print_r($empleado);

              if(isset($empleado["Foto"])){
                  if(file_exists("../appsignar/imagenes/".$empleado["Foto"])){
                    unlink("../appsignar/imagenes/".$empleado['Foto']);
                 }
               }

                  $sentencia= $pdo ->prepare("UPDATE  empleados SET 
                  Foto=:Foto
                  WHERE ID =:ID"); 
                  $sentencia->bindParam(':Foto',$nombreArchivo);
                  $sentencia->bindParam(':ID',$txtID);
                  $sentencia->execute();
              }
              header('location:vistaempleados.php');
        break;
        //------Eliminar registro----//
        case "btnEliminar":
            $sentencia=$pdo->prepare("SELECT Foto From empleados WHERE ID=:ID");
            $sentencia->bindParam(':ID',$txtID);
            $sentencia->execute();
            $empleado=$sentencia->fetch(PDO::FETCH_LAZY);
            print_r($empleado);

            if(isset($empleado["Foto"])){
                if(file_exists("../appsignar/imagenes/".$empleado["Foto"])){
                    unlink("../appsignar/imagenes/".$empleado['Foto']);
                }
            }
            $sentencia= $pdo->prepare(" DELETE FROM  empleados 
             WHERE
            ID =:ID"); 
              $sentencia->bindParam(':ID',$txtID);
  
              $sentencia->execute();
              header('location:vistaempleados.php');
        break;


        case "btnCancelar":
          
        break;
    
}

$sentencia= $pdo -> prepare ("SELECT * FROM empleados WHERE 1");
$sentencia->execute();
$listaEmpleados=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>



<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" >
<?php include ("modulos/empleado.php") ?>
<?php include ("menus.php") ?>
<?php include ("cabezera.php")?>

 <div class="container-fluid">
                     <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">EMPLEADOS</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> DESCARGAR REPORTE EMPLEADOS</a>
                      </div>
     <div class="row">
            <div class="col-xl-8 col-lg-7">
            <!--<div class="card shadow mb-4">
                    <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Formulario Agregar Empleados</h6>
                    </div>
                <form action="operacion_guardar.php" method="POST">
                    <input type="text" class="form-control mb-2 mr-sm-2" REQUIRED name="Id" placeholder="Cedula..." value="" />
                    <input type="text" class="form-control mb-2 mr-sm-2" REQUIRED name="Nombre" placeholder="Nombre..." value="" />

                <select class="form-control mb-2 mr-sm-2" REQUIRED name="Division">
                    <option value="">División</option>
                    <option value="Cloud">Cloud</option>
                    <option value="Cloud/S4H">Cloud/S4H</option>
                    <option value="DEV">DEV</option>
                    <option value="S4H">S4H</option>
                    <option value="Innovacion">Innovacion</option>
                    <option value="B1">B1</option>
                </select>

                <select class="form-control mb-2 mr-sm-2" REQUIRED name="Perfil">
                    <option value="">Perfil</option>
                    <option value="Consultor AMS">Consultor AMS</option>
                    <option value="Consultor B1">Consultor B1</option>
                </select>

                <input type="submit" class="btn btn-dark" value="Registrar Empleado" />
                </form>
                </div>
                ----------------------------------------------------------------------->
              <form action="" method="post" enctype="multipart/form-data">
                    

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">EMPLEADOS</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-row">
                                  <input type="hidden" REQUIRED name="txtID" value="<?php echo $txtID; ?>" placeholder="" id="txtID" require="">

                                    <label for="">Nombres:</label>
                                    <input type="text" class="form-control" REQUIRED name="txtNombres" value="<?php echo $txtNombres; ?>" placeholder="" id="txtNombres" require=""><br>
                                    <label for="">Apellidos:</label>
                                    <input type="text" class="form-control" REQUIRED name="txtApellidos" value="<?php echo $txtApellidos; ?>" placeholder="" id="txtApellidos" require=""><br>
                                    <div class="form-group col-md-6">
                                    <label for="">Division:</label>
                                    <input type="text" class="form-control" REQUIRED name="txtDivision" value="<?php echo $txtDivision; ?>" placeholder="" id="txtDivision" require=""><br>
                                    </div>

                                    <div class="form-group col-md-6">
                                    <label for="">Perfil:</label>
                                    <input type="text"class="form-control" REQUIRED name="txtPerfil" value="<?php echo $txtPerfil; ?>" placeholder="" id="txtPerfil" require=""><br>
                                    </div>
                                    <div class="form-group col-md-12">
                                    <label for="">Correo:</label>
                                    <input type="email"class="form-control" REQUIRED name="txtCorreo" value="<?php echo $txtCorreo; ?>" placeholder="" id="txtCorreo" require=""><br>
                                    </div>
                                    <div class="form-group col-md-12">
                                    <label for="">Foto:</label>
                                    <input type="file" class="form-control" accept="image/*" name="txtFoto" value="<?php echo $txtFoto; ?>" placeholder="" id="txtFoto" require=""><br>
                                     </div>
                                    </div>   
                                </div>
                                <div class="modal-footer">
                                <Button value="btnAgregar" class="btn btn-success" type="submit" name="accion">Agregar</Button>
                                <Button value="btnModificar" class="btn btn-warning" type="submit" name="accion">Modificar</Button>
                                <Button value="btnEliminar" class="btn btn-danger" type="submit" name="accion">Eliminar</Button>
                                <Button value="btnCancelar" class="btn btn-primary" type="submit" name="accion">Cancelar</Button>

                                </div>
                                </div>
                            </div>
                            </div>
                             <!-- Button trigger modal -->
                             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                               AGREGAR EMPLEADO
                            </button>



              </form>
               
            

         </div> 
        
         

         <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                    
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Filtro Empleados</h6> 
                        </div>
                
            

                    <form action="operacion_guardar.php" method="POST">
                            <input type="text" class="form-control mb-2 mr-sm-2" REQUIRED name="Nombre" placeholder="Nombre..." value="" />
                    
                            <input type="date" class="form-control mb-2 mr-sm-2" id="start" name="trip-start" placeholder="Fecha inicio" value="" min="2021-01-01" max="2030-12-31"/>
                            <input type="date"class="form-control mb-2 mr-sm-2" id="start" name="trip-start"  placeholder="Fecha Fin" value="" min="2021-01-01" max="2030-12-31"/>
                            <select class="form-control mb-2 mr-sm-2" REQUIRED name="Division">
                                <option value="">División</option>
                                <option value="Cloud">Cloud</option>
                                <option value="Cloud/S4H">Cloud/S4H</option>
                                <option value="DEV">DEV</option>
                                <option value="S4H">S4H</option>
                                <option value="Innovacion">Innovacion</option>
                                <option value="B1">B1</option>
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



         <div class="row">

           <table class="table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Division</th>
                    <th>Perfil</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
             </thead>
                    <?php foreach($listaEmpleados as $empleado){?>
                      <tr>
                        <td> <img class ="img-thumbnail" width="100px" src="../appsignar/imagenes/<?php echo $empleado['Foto'];?>"/> </td>
                        <td><?php echo $empleado['Nombres']?></td>
                        <td><?php echo $empleado['Apellidos']?></td>
                        <td><?php echo $empleado['Division']?></td>
                        <td><?php echo $empleado['Perfil']?></td>
                        <td><?php echo $empleado['Correo']?></td>
                         
                        <td>
                        <form action="" method="post">
                            <input type="hidden" name="txtID" value="<?php echo $empleado['ID'];?>"> 
                            <input type="hidden" name="txtNombres" value="<?php echo $empleado['Nombres'];?>">
                            <input type="hidden" name="txtApellidos" value="<?php echo $empleado['Apellidos'];?>">
                            <input type="hidden" name="txtDivision" value="<?php echo $empleado['Division'];?>">
                            <input type="hidden" name="txtPerfil" value="<?php echo $empleado['Perfil'];?>">
                            <input type="hidden" name="txtCorreo" value="<?php echo $empleado['Correo'];?>">
                            <input type="hidden" name="txtFoto" value="<?php echo $empleado['Foto'];?>">

                        <input type="Submit" value="Selecionar" name="accion">
                        <Button value="btnEliminar" type="submit" name="accion">Eliminar</Button>
                         </form>   
                        </td>
                      <?php } ?>

            </table>

         </div>
        </div>          

        

    </div>              
<?php include ("piedepagina.php")?>