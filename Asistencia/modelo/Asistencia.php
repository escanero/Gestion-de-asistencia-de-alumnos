<?php

class Asistencia
{
    private $ID_Asistencia;
    private $ID_Asignatura;
    private $Fecha_Asistencia;
    private $ID_Alumno;
    private $ID_Profesor;
    private $Asistencia;
    private $Hora;

    private $Ruta_Justificante;

    private $observaciones;

    public function __construct($ID_Asignatura = "", $Fecha_Asistencia = "", $ID_Alumno = "", $ID_Profesor = "", $Asistencia = "", $Hora = "", $observaciones = "", $Ruta_Justificante = "")
    {
        $this->ID_Asignatura = $ID_Asignatura;
        $this->Fecha_Asistencia = $Fecha_Asistencia;
        $this->ID_Alumno = $ID_Alumno;
        $this->ID_Profesor = $ID_Profesor;
        $this->Asistencia = $Asistencia;
        $this->Hora = $Hora;
        $this->observaciones = $observaciones;
        $this->Ruta_Justificante = $Ruta_Justificante;
    }

    public function actualizarRutaJustificante($idAsistencia, $rutaJustificante)
    {
        $db = new Bd();

        $idAsistenciaEscapado = $db->escapar($idAsistencia);
        $rutaJustificanteEscapada = $db->escapar($rutaJustificante);

        $sql = "UPDATE Asistencia SET Ruta_Justificante = '$rutaJustificanteEscapada' WHERE ID_Asistencia = $idAsistenciaEscapado";

        return $db->consulta($sql);
    }
    public function registrarAsistencia($ID_Asignatura, $Fecha_Asistencia, $ID_Alumno, $ID_Profesor, $Asistencia, $Hora, $observaciones)
    {
        // Crear una instancia de la clase Bd
        $db = new Bd();

        // Escapar los valores para prevenir inyecciones SQL
        $ID_Asignatura = $db->escapar($ID_Asignatura);
        $Fecha_Asistencia = $db->escapar($Fecha_Asistencia);
        $ID_Alumno = $db->escapar($ID_Alumno);
        $ID_Profesor = $db->escapar($ID_Profesor);
        $Asistencia = $db->escapar($Asistencia);
        $Hora = $db->escapar($Hora);
        $observaciones = $db->escapar($observaciones);


        // Consulta SQL para insertar el registro de asistencia
        $sql = "INSERT INTO Asistencia (ID_Asignatura, Fecha_Asistencia, ID_Alumno,ID_Profesor, Asistencia, Hora,observaciones) VALUES ('$ID_Asignatura', '$Fecha_Asistencia', '$ID_Alumno', '$ID_Profesor', '$Asistencia', '$Hora','$observaciones')";

        // Ejecutar la consulta
        $resultado = $db->consulta($sql);

        // Verificar si la inserción fue exitosa
        if ($resultado) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerDetallesAsistencia($idAlumno)
    {
        // Crear una instancia de la clase Bd
        $db = new Bd();

        // Preparar la consulta SQL con protección contra inyecciones SQL utilizando 'escapar'
        $idAlumnoEscapado = $db->escapar($idAlumno);

        $sql = "SELECT Asistencia.ID_Asistencia, Asistencia.Fecha_Asistencia, Asistencia.Hora, Asistencia.Asistencia, Asistencia.observaciones, Alumnos.Nombre, Alumnos.Apellido, Alumnos.Foto 
                FROM Asistencia 
                JOIN Alumnos ON Asistencia.ID_Alumno = Alumnos.ID_Alumno
                WHERE Asistencia.ID_Alumno = '$idAlumnoEscapado' AND Asistencia.Asistencia IN ('Justificado', 'Ausente', 'Retraso', 'Asistencia')";

        // Ejecutar la consulta
        $resultado = $db->consulta($sql);

        // Convertir los resultados a un arreglo
        $asistencias = array();
        while ($fila = $resultado->fetch_assoc()) {
            // Formatear la fecha
            $fechaOriginal = $fila['Fecha_Asistencia'];
            $fechaFormateada = date('d-m-Y', strtotime($fechaOriginal));

            // Reemplazar la fecha original con la formateada
            $fila['Fecha_Asistencia'] = $fechaFormateada;

            $asistencias[] = $fila;
        }

        // Retornar los datos en formato JSON
        return json_encode($asistencias);
    }

    public function actualizarEstadoAsistencia($idAsistencia, $nuevoEstado)
    {
        $db = new Bd();

        $idAsistenciaEscapado = $db->escapar($idAsistencia);
        $nuevoEstadoEscapado = $db->escapar($nuevoEstado);

        $sql = "UPDATE Asistencia SET Asistencia = '$nuevoEstadoEscapado' WHERE ID_Asistencia = $idAsistenciaEscapado";

        return $db->consulta($sql);
    }

    public function actualizarObservaciones($idAsistencia, $nuevaObservacion)
    {
        $db = new Bd();

        $idAsistenciaEscapado = $db->escapar($idAsistencia);
        $nuevaObservacionEscapado = $db->escapar($nuevaObservacion);

        $sql = "UPDATE Asistencia SET observaciones = '$nuevaObservacionEscapado' WHERE ID_Asistencia = $idAsistenciaEscapado";
        
        return $db->consulta($sql);
    }



    /**
     * Get the value of ID_Asistencia
     */
    public function getIDAsistencia()
    {
        return $this->ID_Asistencia;
    }

    /**
     * Set the value of ID_Asistencia
     */
    public function setIDAsistencia($ID_Asistencia): self
    {
        $this->ID_Asistencia = $ID_Asistencia;

        return $this;
    }

    /**
     * Get the value of ID_Asignatura
     */
    public function getIDAsignatura()
    {
        return $this->ID_Asignatura;
    }

    /**
     * Set the value of ID_Asignatura
     */
    public function setIDAsignatura($ID_Asignatura): self
    {
        $this->ID_Asignatura = $ID_Asignatura;

        return $this;
    }

    /**
     * Get the value of Fecha_Asistencia
     */
    public function getFechaAsistencia()
    {
        return $this->Fecha_Asistencia;
    }

    /**
     * Set the value of Fecha_Asistencia
     */
    public function setFechaAsistencia($Fecha_Asistencia): self
    {
        $this->Fecha_Asistencia = $Fecha_Asistencia;

        return $this;
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
    public function setIDAlumno($ID_Alumno): self
    {
        $this->ID_Alumno = $ID_Alumno;

        return $this;
    }

    /**
     * Get the value of ID_Profesor
     */
    public function getIDProfesor()
    {
        return $this->ID_Profesor;
    }

    /**
     * Set the value of ID_Profesor
     */
    public function setIDProfesor($ID_Profesor): self
    {
        $this->ID_Profesor = $ID_Profesor;

        return $this;
    }

    /**
     * Get the value of Asistencia
     */
    public function getAsistencia()
    {
        return $this->Asistencia;
    }

    /**
     * Set the value of Asistencia
     */
    public function setAsistencia($Asistencia): self
    {
        $this->Asistencia = $Asistencia;

        return $this;
    }

    /**
     * Get the value of Hora
     */
    public function getHora()
    {
        return $this->Hora;
    }

    /**
     * Set the value of Hora
     */
    public function setHora($Hora): self
    {
        $this->Hora = $Hora;

        return $this;
    }


    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set the value of Hora
     */
    public function setObservaciones($observaciones): self
    {
        $this->observaciones = $observaciones;

        return $this;
    }
    public function getRutaJustificante()
    {
        return $this->Ruta_Justificante;
    }

    /**
     * Set the value of Ruta_Justificante
     */
    public function setRutaJustificante($Ruta_Justificante): self
    {
        $this->Ruta_Justificante = $Ruta_Justificante;

        return $this;
    }
}
