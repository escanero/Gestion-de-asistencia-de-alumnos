<?php
class Asignatura {
    private $ID_Asignatura;
    private $Nombre_Asignatura;

    public function __construct($Nombre_Asignatura="") {
        
        $this->Nombre_Asignatura = $Nombre_Asignatura;
    }

    public function obtenerAsignatura($Nombre_Asignatura) {
        $bd = new Bd();
        
        $nombreAsignaturaEscapado = $bd->escapar($Nombre_Asignatura);
    
        // Preparar la consulta
        // Usa comillas simples alrededor de la variable para que sea interpretada como una cadena en SQL
        $sql = "SELECT ID_Asignatura, Nombre_Asignatura FROM Asignaturas WHERE Nombre_Asignatura = '$nombreAsignaturaEscapado'";
    
        // Ejecutar la consulta
        $resultado = $bd->consulta($sql);
    
        if ($resultado->num_rows > 0) {
            // Obtener los datos como un array asociativo
            $datosAsignatura = $resultado->fetch_assoc();
    
            // Convertir los datos a JSON
            $json = json_encode($datosAsignatura);
    
            // Retornar los datos en formato JSON
            return $json;
        } else {
            // No se encontraron datos, retornar JSON vacío o un mensaje de error en JSON
            return json_encode(['error' => 'No se encontraron datos de la asignatura.']);
        }
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
     * Get the value of Nombre_Asignatura
     */
    public function getNombreAsignatura()
    {
        return $this->Nombre_Asignatura;
    }

    /**
     * Set the value of Nombre_Asignatura
     */
    public function setNombreAsignatura($Nombre_Asignatura): self
    {
        $this->Nombre_Asignatura = $Nombre_Asignatura;

        return $this;
    }
}



?>
