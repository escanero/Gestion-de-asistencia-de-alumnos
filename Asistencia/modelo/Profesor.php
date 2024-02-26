<?php
class Profesor {
    private $Nombre;
    private $Apellido;
    private $Correo;
    private $pass;
    

    // Constructor
    public function __construct($Nombre="", $Apellido="", $Correo="", $pass="") {
        $this->Nombre = $Nombre;
        $this->Apellido = $Apellido;
        $this->Correo = $Correo;
        $this->pass = $pass;
    }



    public function validar($correo, $pass) {
        $conexion = new Bd();
        $correo = addslashes($correo);
    
        // Consulta SQL para obtener la contraseña y el indicador de contraseña predeterminada
        $sql = "SELECT pass, passPredeterminada FROM Profesores WHERE Correo = '$correo'";
    
        $resultado = $conexion->consulta($sql);
    
        if ($fila = $resultado->fetch_assoc()) {
            if ($pass === 'contrasena' && $fila['passPredeterminada']) {
                return ['valido' => true, 'cambiarContrasena' => true];
            }
    
            if (password_verify($pass, $fila['pass'])) {
                return ['valido' => true, 'cambiarContrasena' => false];
            }
        }
    
        return ['valido' => false, 'cambiarContrasena' => false];
    }
    
    
    public function obtenerDatos($correo) {
        $bd = new Bd();
        
        // Es importante escapar los valores para proteger contra SQL Injection
        $correoSeguro = $bd->escapar($correo);
    
        // Preparar la consulta
        $sql = "SELECT * FROM Profesores WHERE Correo = '{$correoSeguro}'";
    
        // Ejecutar la consulta
        $resultado = $bd->consulta($sql);
    
        if ($resultado->num_rows > 0) {
            // Obtener los datos como un array asociativo
            $datosUsuario = $resultado->fetch_assoc();
    
            // Convertir los datos a JSON
            $json = json_encode($datosUsuario);
    
            // Retornar los datos en formato JSON
            return $json;
        } else {
            // No se encontraron datos, retornar JSON vacío o un mensaje de error en JSON
            return json_encode(['error' => 'No se encontraron datos para el correo proporcionado.']);
        }
    }

    public function actualizarPass($correo, $nuevaPassword) {
        $bd = new Bd();
        
        // Escapar el correo para seguridad
        $correoSeguro = $bd->escapar($correo);
        
        // Hash de la nueva contraseña
        $passwordHash = password_hash($nuevaPassword, PASSWORD_DEFAULT);
        
        // Preparar la consulta SQL para actualizar la contraseña y el estado de passPredeterminada
        $sql = "UPDATE Profesores SET pass = '{$passwordHash}', passPredeterminada = FALSE WHERE Correo = '{$correoSeguro}'";
        
        // Ejecutar la consulta
        $bd->consulta($sql);
    }
    
    


    


    /**
     * Get the value of Nombre
     */
    public function getNombre()
    {
        return $this->Nombre;
    }

    /**
     * Set the value of Nombre
     */
    public function setNombre($Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    /**
     * Get the value of Apellido
     */
    public function getApellido()
    {
        return $this->Apellido;
    }

    /**
     * Set the value of Apellido
     */
    public function setApellido($Apellido): self
    {
        $this->Apellido = $Apellido;

        return $this;
    }

    /**
     * Get the value of Correo
     */
    public function getCorreo()
    {
        return $this->Correo;
    }

    /**
     * Set the value of Correo
     */
    public function setCorreo($Correo): self
    {
        $this->Correo = $Correo;

        return $this;
    }

    /**
     * Get the value of Contrase
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Set the value of Contrase
     */
    public function setPass($pass): self
    {
        $this->pass = $pass;

        return $this;
    }

        
    
    
}

    