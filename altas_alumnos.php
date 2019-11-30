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
            $sql="INSERT INTO alumnos VALUES('$nc','$n','$pa','$sa',$e,$s,'$c')";
            $res=mysqli_query($conexion,$sql);
            $repuesta=array();
            if($res){
                $repuesta['exito']=1;
                $repuesta['mensaje']="Insercion correcta";
                echo json_encode($repuesta);
            }else{
                $repuesta['exito']=0;
                $repuesta['mensaje']="ERROR en Insercion";
                echo json_encode($repuesta);
            }
        }
    }else{
        die("Error en la conexion ".mysqli_connect_error());
    }
?>