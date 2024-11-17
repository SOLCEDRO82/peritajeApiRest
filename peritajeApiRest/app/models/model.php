<?php
require_once './config.php';

class Model {
    protected $db;

    public function __construct() {
        $this->db = $this->createDb(); 
        $this->db = new PDO(
            "mysql:host=" . MYSQL_HOST .
            ";dbname=" . MYSQL_DB . ";charset=utf8", 
            MYSQL_USER, MYSQL_PASS
        ); 
        $this->deploy(); 
    }

   
    private function deploy() {
        $query = $this->db->query('SHOW TABLES'); // Consultar las tablas existentes
        $tables = $query->fetchAll(); // Obtener todas las tablas
        if (count($tables) == 0) { // Si no hay tablas, se crean
            $sql =<<<END
            -- Crear tabla `aseguradora`
            CREATE TABLE `aseguradora` (
              `ID_Aseguradora` int(11) NOT NULL AUTO_INCREMENT,
              `Nombre` varchar(45) NOT NULL,
              `Direccion` varchar(45) NOT NULL,
              `Mail` varchar(45) NOT NULL,
              PRIMARY KEY (`ID_Aseguradora`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            -- Insertar datos en la tabla `aseguradora`
            INSERT INTO `aseguradora` (`ID_Aseguradora`, `Nombre`, `Direccion`, `Mail`) VALUES
            (1, 'Grupo Sancor Seguros', 'Chacabuco 472, Tandil', 'info@sancorseguros.com.ar'),
            (2, 'La Caja de Ahorro y Seguro', 'Garibaldi 504, Tandil', 'servicioatencionasegurado@lacaja.com.ar'),
            (3, 'Orbis Seguros', 'Belgrano 646, Tandil', 'atencionalcliente@orbiseguros.com.ar'),
            (4, 'Liderar Seguros', 'Av. Marconi 1477, Tandil', 'cia@liderarseguros.com.ar'),
            (5, 'Rio Uruguay Seguros', 'Av. Santamarina 402, Tandil', 'producciontandil@riouruguay.com.ar'),
            (6, 'Seguros La Segunda', 'Av. Avellaneda 1760, Tandil', 'mdavila@lasegunda.com.ar'),
            (7, 'Mercantil Andina Seguros', 'Hipolito Yrigoyen 886, Tandil', 'juan.demedio@lamercantil.com.ar'),
            (8, 'Cooperacion Seguros', 'Av. España 527, Tandil', 'clientes@cooperacionseguros.com.ar');

            -- Crear tabla `siniestro`
            CREATE TABLE `siniestro` (
              `ID_Siniestro` int(11) NOT NULL AUTO_INCREMENT,
              `Fecha` date NOT NULL,
              `Tipo_Siniestro` varchar(45) NOT NULL,
              `Asegurado` varchar(45) NOT NULL,
              `ID_Aseguradora` int(11) NOT NULL,
              PRIMARY KEY (`ID_Siniestro`),
              KEY `ID_Aseguradora` (`ID_Aseguradora`),
              FOREIGN KEY (`ID_Aseguradora`) REFERENCES `aseguradora` (`ID_Aseguradora`) 
              ON DELETE SET NULL ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            -- Insertar datos en la tabla `siniestro`
            INSERT INTO `siniestro` (`ID_Siniestro`, `Fecha`, `Tipo_Siniestro`, `Asegurado`, `ID_Aseguradora`) VALUES
            (2, '2024-05-15', 'Incendio', 'Maria Garcia', 5),
            (3, '2024-01-10', 'robo', 'Jose Sanchez', 4),
            (4, '2024-09-12', 'robo', 'Rosa Molina', 1),
            (5, '2024-09-03', 'cristales', 'Luciano Gomez', 3),
            (6, '2024-07-20', 'granizo', 'Pedro Fernandez', 7),
            (7, '2024-08-14', 'granizo', 'Ana Martinez', 1),
            (8, '2024-07-02', 'Incendio', 'Francisco Losa', 2),
            (9, '2024-03-07', 'robo', 'Hilda Lommi', 3),
            (10, '2024-06-12', 'robo', 'Romina Heid', 5),
            (11, '2024-07-29', 'cristales', 'Gimena Castellanos', 6),
            (12, '2024-08-05', 'Incendio', 'Miguel Ceballos', 7),
            (13, '2024-09-11', 'cristales', 'Juana Montes', 5),
            (14, '2024-09-19', 'robo', 'Catalina Gonzalez', 3),
            (15, '2024-09-15', 'cristales', 'Juan Perez', 2),
            (16, '2024-02-20', 'Incendio', 'Claudia Fara', 8),
            (17, '2024-09-08', 'cristales', 'Jose Sanchez', 4),
            (18, '2024-01-01', 'terceros', 'Lautaro Lopez', 5),
            (19, '2024-04-08', 'terceros', 'Diego Rios', 3),
            (20, '2024-03-09', 'terceros', 'Nahuel Tassi', 2),
            (21, '2024-04-12', 'terceros', 'Nicolas Arancibia', 6),
            (22, '2024-06-12', 'terceros', 'Julian Nuñez', 6),
            (23, '2024-06-11', 'Incendio', 'Paula Alvarez', 1),
            (24, '2024-09-01', 'terceros', 'Daniela Ceres', 7),
            (25, '2024-02-18', 'terceros', 'Cecilia Vera', 5);

            CREATE TABLE `usuario` (
              `id` int(40) NOT NULL,
              `email` varchar(250) NOT NULL,
              `password` char(60) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
            
            --
            -- Volcado de datos para la tabla `usuario`
            --
            
            INSERT INTO `usuario` (`id`, `email`, `password`) VALUES
            (1, 'webadmin', '$2y$10$rMiPv8I.rHrw1BXy/hHEFOxet.WJle.kiN2QDP6NHIVeA9d6n7HBW'),
            (2, 'pame', '$2y$10$Cb8uAe3yyZ/FlLU5WwxTDug1QweYs/20qCb1y5slVCczfLtPf0KkK'),
            (3, 'sole', '$2y$10$R1G9S5.pJ0DUrvE6G2nbceYLAOhaVBDv82NDl2fgelLvQGp4Dxhr2');
            
            --
            -- Índices para tablas volcadas
            --
            
            --
            -- Indices de la tabla `aseguradora`
            --
            ALTER TABLE `aseguradora`
              ADD PRIMARY KEY (`ID_Aseguradora`);
            
            --
            -- Indices de la tabla `siniestro`
            --
            ALTER TABLE `siniestro`
              ADD PRIMARY KEY (`ID_Siniestro`),
              ADD KEY `ID_Aseguradora` (`ID_Aseguradora`);
            
            --
            -- Indices de la tabla `usuario`
            --
            ALTER TABLE `usuario`
              ADD PRIMARY KEY (`id`);
            
            --
            -- AUTO_INCREMENT de las tablas volcadas
            --
            
            --
            -- AUTO_INCREMENT de la tabla `aseguradora`
            --
            ALTER TABLE `aseguradora`
              MODIFY `ID_Aseguradora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
            
            --
            -- AUTO_INCREMENT de la tabla `siniestro`
            --
            ALTER TABLE `siniestro`
              MODIFY `ID_Siniestro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
            
            --
            -- AUTO_INCREMENT de la tabla `usuario`
            --
            ALTER TABLE `usuario`
              MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
            
            --
            -- Restricciones para tablas volcadas
            --
            
            --
            -- Filtros para la tabla `siniestro`
            --
            ALTER TABLE `siniestro`
              ADD CONSTRAINT `Siniestro_ibfk_1` FOREIGN KEY (`ID_Aseguradora`) REFERENCES `aseguradora` (`ID_Aseguradora`);
            COMMIT;
END;
            $this->db->query($sql); // Ejecuta el SQL para crear las tablas
        }
    }

}
?>
