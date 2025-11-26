<?php
include_once('../../config/Connection.php');

class LogicaSession {
    private $connection;
    
    public function __construct() {
        $this->connection = getConnection();
    }
    
public function login($email, $psw){
    echo "=== DEBUG LOGIN ===<br>";
    echo "Email recibido: " . $email . "<br>";
    echo "Password recibido: " . $psw . "<br>";

    $query = "SELECT * FROM usuarios u 
            INNER JOIN personas p ON p.id_usuario = u.id_usuario 
            WHERE u.correo = ? 
            LIMIT 1";
    $stmt = $this->connection->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();
    
    echo "Usuario encontrado en BD: ";
    var_dump($usuario);
    echo "<br>";
    
    if ($usuario) {
        echo "Hash en BD: " . $usuario['contrasena'] . "<br>";
        echo "Longitud hash: " . strlen($usuario['contrasena']) . "<br>";
        
        $verificacion = password_verify($psw, $usuario['contrasena']);
        echo "Resultado password_verify: ";
        var_dump($verificacion);
        echo "<br>";
        
        if ($verificacion) {
            echo "=== LOGIN EXITOSO ===<br>";
            return $usuario;
        } else {
            echo "=== CONTRASEÑA INCORRECTA ===<br>";
        }
    } else {
        echo "=== USUARIO NO ENCONTRADO ===<br>";
    }

    echo "=== LOGIN FALLIDO ===<br>";


        $nuevaPassword = "admin123"; // Cambia esta contraseña por la que quieras
    $hash = password_hash($nuevaPassword, PASSWORD_DEFAULT);
    
    echo "=== NUEVA CONTRASEÑA GENERADA ===<br>";
    echo "Contraseña en texto plano: " . $nuevaPassword . "<br>";
    echo "Hash para la base de datos: " . $hash . "<br>";
    echo "Longitud del hash: " . strlen($hash) . " caracteres<br>";
    
    // SQL listo para copiar y pegar
    echo "<br>=== COMANDO SQL ===<br>";
    echo "UPDATE usuarios SET contrasena = '" . $hash . "' WHERE correo = 'admin@clinica.com';<br>";
    echo "O<br>";
    echo "INSERT INTO usuarios (correo, contrasena, nombre, rol) VALUES ('admin@clinica.com', '" . $hash . "', 'Administrador', 'admin');";
    return false;
}

    public function loginDos($email, $psw){
        $query = "SELECT * FROM usuarios WHERE correo = ? LIMIT 1";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $usuario = $stmt->get_result()->fetch_assoc();

        if ($usuario && password_verify($psw, $usuario['contrasena'])) {
            return $usuario;
        }

        return false;
    }

}
?>