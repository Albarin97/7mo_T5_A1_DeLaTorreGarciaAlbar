<?php
    if($conexion=mysqli_connect('localhost', 'root', '1234', 'escuela_web')){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $cadena_JSON=file_get_contents('php://input');//Informaacion a traves de HTTP, una cadena JSON
            $datos=json_decode($cadena_JSON, true);//Indica que debe retornor un vector asociativo
            $nc=$datos['nc'];
            $n=$datos['n'];
            $pa=$datos['pa'];
            $sa=$datos['sa'];
            $e=$datos['e'];
            $s=$datos['s'];
            $c=$datos['c'];
            $sql="UPDATE alumnos SET Nombre_Alumno='$n', Primer_Ape='$pa', Segundo_Ape='$sa', Edad=$e, Semestre=$s, Carrera='$c' WHERE Num_Control='$nc'";
            $res=mysqli_query($conexion,$sql);
            $repuesta=array();
            if($res){
                $repuesta['exito']=1;
                $repuesta['mensaje']="Actualizacion correcta";
                echo json_encode($repuesta);
            }else{
                $repuesta['exito']=0;
                $repuesta['mensaje']="ERROR en Actualizacion";
                echo json_encode($repuesta);
            }
        }
    }else{
        die("Error en la conexion ".mysqli_connect_error());
    }
?>