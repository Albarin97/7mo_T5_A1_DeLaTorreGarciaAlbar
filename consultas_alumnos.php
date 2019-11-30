<?php
    if($conexion=mysqli_connect('localhost', 'root', '1234', 'escuela_web')){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $cadena_JSON=file_get_contents('php://input');//Informaacion a traves de HTTP, una cadena JSON
            $datos=json_decode($cadena_JSON, true);//Indica que debe retornor un vector asociativo
            $sql="SELECT * FROM alumnos";
            $res=mysqli_query($conexion,$sql);
            $datos['Alumnos']=array();
            while($fila=mysqli_fetch_assoc($res)){
                $alumno= array();
                $alumno['nc']=$fila['Num_Control'];
                $alumno['n']=$fila['Nombre_Alumno'];
                $alumno['pa']=$fila['Primer_Ape'];
                $alumno['sa']=$fila['Segundo_Ape'];
                $alumno['e']=$fila['Edad'];
                $alumno['s']=$fila['Semestre'];
                $alumno['c']=$fila['Carrera'];
                array_push($datos['Alumnos'], $alumno);
            }
            echo json_encode($datos);
        }
    }else{
        die("Error en la conexion ".mysqli_connect_error());
    }
?>