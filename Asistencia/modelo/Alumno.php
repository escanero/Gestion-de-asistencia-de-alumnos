<?php
class Alumno {
    private $ID_Alumno;
    private $Nombre;
    private $Apellido;
    private $Correo;
    private $Pass;
    private $Especialidad;
    private $Foto;

    // Constructor
    public function __construct($Nombre="", $Apellido="", $Correo="", $Pass="", $Especialidad="", $Foto="",$ID_Alumno="") {
        $this->Nombre = $Nombre;
        $this->Apellido = $Apellido;
        $this->Correo = $Correo;
        $this->Pass = $Pass;
        $this->Especialidad = $Especialidad;
        $this->Foto = $Foto;
        $this->ID_Alumno = $ID_Alumno;
    }

    public function obtenerAlumnosPorEspecialidad($especialidad) {
        $bd = new Bd();
        
        // Es importante escapar los valores para proteger contra SQL Injection
        $especialidadSegura = $bd->escapar($especialidad);
    
        // Preparar la consulta
        $sql = "SELECT * FROM Alumnos WHERE Especialidad = '{$especialidadSegura}'";
    
        // Ejecutar la consulta
        $resultado = $bd->consulta($sql);
    
        if ($resultado->num_rows > 0) {
            // Crear un array para almacenar todos los alumnos
            $alumnos = [];
    
            // Iterar sobre cada fila del resultado
            while($fila = $resultado->fetch_assoc()) {
                $alumnos[] = $fila; // Agregar la fila al array de alumnos
            }
    
            // Convertir el array de alumnos a JSON
            $json = json_encode($alumnos);
    
            return $json;   
        } else {
            // No se encontraron datos, retornar JSON vacío o un mensaje de error en JSON
            return json_encode(['error' => 'No se encontraron datos del Ciclo Formativo.']);
        }
    }


    public function obtenerTodosLosAlumnos() {
        $bd = new Bd();
    
        // Preparar la consulta para seleccionar solo los campos necesarios
        $sql = "SELECT * FROM Alumnos";
    
        // Ejecutar la consulta
        $resultado = $bd->consulta($sql);
    
        if ($resultado && $resultado->num_rows > 0) {
            // Crear un array para almacenar todos los alumnos
            $alumnos = [];
    
            // Iterar sobre cada fila del resultado
            while($fila = $resultado->fetch_assoc()) {
                $alumnos[] = $fila; // Agregar la fila al array de alumnos
            }
    
            // Convertir el array de alumnos a JSON
            return json_encode($alumnos);
        } else {
            // No se encontraron datos, retornar JSON vacío o un mensaje de error en JSON
            return json_encode(['error' => 'No se encontraron alumnos.']);
        }
    }

    public function validar($correo, $pass) {
        $conexion = new Bd();
        $correo = addslashes($correo);
    
        // Consulta SQL para obtener la contraseña y el indicador de contraseña predeterminada
        $sql = "SELECT pass, passPredeterminada FROM Alumnos WHERE Correo = '$correo'";
    
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
        $sql = "SELECT * FROM Alumnos WHERE Correo = '{$correoSeguro}'";

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
        $sql = "UPDATE Alumnos SET Pass = '{$passwordHash}', passPredeterminada = FALSE WHERE Correo = '{$correoSeguro}'";
        
        // Ejecutar la consulta
        $bd->consulta($sql);
    }


    public function obtenerAsistencia() {
        $bd = new Bd();
        $idAlumno = $this->ID_Alumno; // Usa el ID del alumno
    
        $query_asistencia = "SELECT a.ID_Asignatura, a.Fecha_Asistencia, a.ID_Alumno, a.ID_Profesor, a.Asistencia, a.Hora, a.observaciones, asignaturas.Nombre_Asignatura AS Nombre_Asignatura, profesores.Nombre AS Nombre_Profesor
                    FROM Asistencia a
                    JOIN Asignaturas ON a.ID_Asignatura = Asignaturas.ID_Asignatura
                    JOIN Profesores ON a.ID_Profesor = Profesores.ID_Profesor
                    WHERE a.ID_Alumno = $idAlumno";
    
        try {
            $result_asistencia = $bd->consulta($query_asistencia);
    
            $asistencias = [];
            while ($row_asistencia = $result_asistencia->fetch_assoc()) {
                // Formatear la fecha
                $fechaOriginal = $row_asistencia['Fecha_Asistencia'];
                $fechaFormateada = date('d-m-Y', strtotime($fechaOriginal));
    
                // Reemplazar la fecha original con la formateada
                $row_asistencia['Fecha_Asistencia'] = $fechaFormateada;
    
                $asistencias[] = $row_asistencia;
            }
    
            return json_encode($asistencias); // Convertir el array en JSON
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
    
    


    /**
     * Get the value of ID_Alumno
     */
    public function getIDAlumno()
    {
        return $this->ID_Alumno;
    }

    /**
     * Set the value of ID_Alumno
     */
    public function setIDAlumno($ID_Alumno)
    {
        $this->ID_Alumno = $ID_Alumno;

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
        return $this->Pass;
    }

    /**
     * Set the value of Contrase
     */
    public function setPass($Pass): self
    {
        $this->Pass = $Pass;

        return $this;
    }

    /**
     * Get the value of Especialidad
     */
    public function getEspecialidad()
    {
        return $this->Especialidad;
    }

    /**
     * Set the value of Especialidad
     */
    public function setEspecialidad($Especialidad): self
    {
        $this->Especialidad = $Especialidad;

        return $this;
    }

    /**
     * Get the value of Foto
     */
    public function getFoto()
    {
        return $this->Foto;
    }

    /**
     * Set the value of Foto
     */
    public function setFoto($Foto)
    {
        $this->Foto = $Foto; 
    }




  

    
}





?>