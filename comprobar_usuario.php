<?php
    if($conexion=mysqli_connect('localhost', 'root', '1234', 'usuarios_escuela_web')){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $cadena_JSON=file_get_contents('php://input');//Informaacion a traves de HTTP, una cadena JSON
            $datos=json_decode($cadena_JSON, true);//Indica que debe retornor un vector asociativo
            $us=$datos['us'];
            $co=$datos['co'];
            $u_cifrado=sha1($us);
            $c_cifrado=sha1($co);
            $sql="SELECT * FROM usuarios WHERE nombre_usuario='$u_cifrado' AND contrasena = '$c_cifrado'";
            $res=mysqli_query($conexion,$sql);
            $repuesta=array();
            if(mysqli_num_rows($res)==1){
                $repuesta['exito']=1;
                echo json_encode($repuesta);
            }else{
                $repuesta['fracaso']=0;
                echo json_encode($repuesta);
            }
        }
    }else{
        die("Error en la conexion ".mysqli_connect_error());
    }
?>