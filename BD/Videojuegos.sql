CREATE DATABASE Videojuegos;

USE Videojuegos;

/* ------------------------------------------------------------------------ TABLAS ------------------------------------------------------------------------ */
CREATE TABLE Pais(
    idPais INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(50),
    Continente VARCHAR(50),
    Nacionalidad VARCHAR(70),
    Bandera TEXT
)
ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

CREATE TABLE Director(
    idDirector INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(70),
    Alias VARCHAR(50),
    FechaNacimiento DATE,
    idNacionalidad INT,
    FOREIGN KEY(idNacionalidad) REFERENCES Pais(idPais) ON UPDATE CASCADE ON DELETE CASCADE
)
ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

CREATE TABLE Distribuidor(
    idDistribuidor INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(50),
    idFundador INT,
    Fundacion DATE,
    Sitio text,
    FOREIGN KEY(idFundador) REFERENCES Director(idDirector) ON UPDATE CASCADE ON DELETE CASCADE
)
ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

CREATE TABLE Desarrollador(
    idDesarrollador INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(45),
    Genero VARCHAR(100),
    idFundador INT,
    Origen VARCHAR(100),
    Fundacion DATE,
    Sitio TEXT,
    FOREIGN KEY(idFundador) REFERENCES Director(idDirector) ON UPDATE CASCADE ON DELETE CASCADE
)
ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

CREATE TABLE Juegos(
    idJuego INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(60),
    Genero VARCHAR(100),
    Modalidad VARCHAR(50),
    Plataforma VARCHAR(60),
    Lanzamiento DATE,
    idDesarrollador INT,
    idDistribuidor INT,
    idDirector INT,
    FOREIGN KEY(idDesarrollador) REFERENCES Desarrollador(idDesarrollador) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(idDistribuidor) REFERENCES Distribuidor(idDistribuidor) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(idDirector) REFERENCES Director(idDirector) ON UPDATE CASCADE ON DELETE CASCADE
)
ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

/* -------------------------------------------------------------- VISTAS -------------------------------------------------------------- */
/* ------------------------------- DIRECTOR ------------------------------- */
CREATE OR REPLACE VIEW
Vista_Director As
SELECT
idDirector,
Director.Nombre,
Alias, 
DATE_FORMAT(FechaNacimiento, "%d / %M / %Y") AS FechaNacimiento,
TIMESTAMPDIFF(Year, FechaNacimiento, NOW()) AS Edad,
Director.idNacionalidad,
CONCAT_WS(' - ', Pais.Nombre, Pais.Nacionalidad) AS Nacionalidad
FROM Director
INNER JOIN Pais
ON Director.idNacionalidad = Pais.idPais ORDER BY (Director.Nombre);

/* ------------------------------- DISTRIBUIDOR ------------------------------- */
CREATE OR REPLACE VIEW
Vista_Distribuidor AS
SELECT
idDistribuidor,
Distribuidor.Nombre,
idFundador,
Director.Nombre AS Fundador,
DATE_FORMAT(Fundacion, "%d / %M / %Y") AS Fundacion,
Sitio
FROM Distribuidor
INNER JOIN Director
ON Distribuidor.idFundador = Director.idDirector 
ORDER BY Distribuidor.Nombre;

/* ------------------------------- DESARROLLADOR ------------------------------- */
CREATE OR REPLACE VIEW
Vista_Desarrollador AS
SELECT
idDesarrollador,
Desarrollador.Nombre,
Genero,
idFundador,
Director.Nombre AS Fundador,
Origen,
DATE_FORMAT(Fundacion, "%d / %M / %Y") AS Fundacion,
Sitio
FROM Desarrollador
INNER JOIN Director
ON Desarrollador.idFundador = Director.idDirector
ORDER BY Desarrollador.Nombre;

/* ------------------------------- JUEGOS ------------------------------- */
CREATE OR REPLACE VIEW
Vista_Juegos AS
SELECT
idJuego,
Juegos.Nombre,
Juegos.Genero,
Modalidad,
Plataforma,
DATE_FORMAT(Lanzamiento, "%d / %M / %Y") AS Lanzamiento,
Desarrollador.Nombre AS Desarrollador,
Juegos.idDesarrollador,
Distribuidor.Nombre AS Distribuidor,
Juegos.idDistribuidor,
Director.Nombre AS Director,
Juegos.idDirector
FROM Juegos
INNER JOIN Desarrollador
ON Juegos.idDesarrollador = Desarrollador.idDesarrollador
INNER JOIN Distribuidor
ON Juegos.idDistribuidor = Distribuidor.idDistribuidor
INNER JOIN Director
ON Juegos.idDirector = Director.idDirector
ORDER BY Juegos.Nombre;

/* ----------------------------------------------------------------------------------------------------------------------- PROCEDIMIENTOS ALMACENADOS ----------------------------------------------------------------------------------------------------------------------- */

/* ------------------------------------------ PAIS ------------------------------------------ */
/* -------- MOSTRAR -------- */
DELIMITER $$
CREATE PROCEDURE `mostrar_pais`()
BEGIN
SELECT idPais, Nombre, Continente, Nacionalidad, Bandera FROM Pais ORDER BY Nombre;
END$$

DELIMITER ;

/* -------- INSERTAR -------- */
DELIMITER $$
CREATE PROCEDURE `inserta_pais`(
    IN NombreI VARCHAR(50),
    IN ContinenteI VARCHAR(50),
    IN NacionalidadI VARCHAR(70),
    IN BanderaI TEXT
)
BEGIN
INSERT INTO Pais(
    Nombre,
    Continente,
    Nacionalidad,
    Bandera
)VALUES(
    NombreI,
    ContinenteI,
    NacionalidadI,
    BanderaI
);
END$$

DELIMITER ;

/* -------- ACTUALIZAR -------- */
DELIMITER $$
CREATE PROCEDURE `actualiza_pais`(
    IN NombreU VARCHAR(50),
    IN ContinenteU VARCHAR(50),
    IN NacionalidadU VARCHAR(70),
    IN BanderaU TEXT,
    IN idPaisU INT
)
BEGIN
UPDATE Pais SET
    Nombre = NombreU,
    Continente = ContinenteU,
    Nacionalidad = NacionalidadU,
    Bandera = BanderaU
WHERE idPais = idPaisU;
END$$

DELIMITER ;

/* -------- ELIMINAR -------- */
DELIMITER $$
CREATE PROCEDURE `elimina_pais`(IN idPaisE INT)
BEGIN
DELETE FROM Pais WHERE idPais = idPaisE;
END$$

DELIMITER ;

/* -------- BUSCAR -------- */
DELIMITER $$
CREATE PROCEDURE `obtener_pais`(IN idPaisI INT)
BEGIN
SELECT * FROM Pais WHERE idPais = idPaisI;
END$$

DELIMITER ;

/* ----------------------------------------- DIRECTOR ----------------------------------------- */
/* -------- MOSTRAR -------- */
DELIMITER $$
CREATE PROCEDURE `mostrar_director`()
BEGIN
SELECT idDirector, Nombre, Alias, FechaNacimiento, Nacionalidad, Edad FROM Vista_Director;
END$$

DELIMITER ;

/* -------- INSERTAR -------- */
DELIMITER $$
CREATE PROCEDURE `inserta_director`(
    IN NombreI VARCHAR(70),
    IN AliasI VARCHAR(50),
    IN FechaNacimientoI DATE,
    IN idNacionalidadI INT
)
BEGIN
INSERT INTO Director(
    Nombre,
    Alias,
    FechaNacimiento,
    idNacionalidad
)
VALUES
    (
        NombreI,
        AliasI,
        FechaNacimientoI,
        idNacionalidadI
    );
END$$

DELIMITER ;

/* -------- ACTUALIZAR -------- */
DELIMITER $$
CREATE PROCEDURE `actualiza_director`(
    IN NombreU VARCHAR(70),
    IN AliasU VARCHAR(50),
    IN FechaNacimientoU DATE,
    IN idNacionalidadU INT,
    IN idDirectorU INT
)
BEGIN
UPDATE Director SET
Nombre = NombreU,
    Alias = AliasU,
    FechaNacimiento = FechaNacimientoU,
    idNacionalidad = idNacionalidadU
WHERE idDirector = idDirectorU;
END$$

DELIMITER ;
/* -------- ELIMINAR -------- */
DELIMITER $$
CREATE PROCEDURE `elimina_director` (IN idDirectorE INT)
BEGIN
DELETE FROM Director WHERE idDirector = idDirectorE;
END$$

DELIMITER ;

/* -------- BUSCAR -------- */
DELIMITER $$
CREATE PROCEDURE `obtener_director` (IN idDirectorE INT)
BEGIN
SELECT * FROM Director WHERE idDirector = idDirectorE;
END$$

DELIMITER ;

/* ----------------------------------------- DISTRIBUIDOR ----------------------------------------- */
/* -------- MOSTRAR -------- */
DELIMITER $$
CREATE PROCEDURE `mostrar_distribuidor` ()
BEGIN
SELECT idDistribuidor, Nombre, Fundador, Fundacion, Sitio FROM Vista_Distribuidor;
END$$

DELIMITER ;

/* -------- INSERTAR -------- */
DELIMITER $$
CREATE PROCEDURE `inserta_distribuidor` (
	IN NombreI VARCHAR(50),
    IN idFundadorI INT,
    IN FundacionI DATE,
    IN SitioI text
    )
BEGIN
INSERT INTO Distribuidor(
    Nombre,
    idFundador,
    Fundacion,
    Sitio
)VALUES(
    NombreI,
    idFundadorI,
    FundacionI,
    SitioI
);
END$$

DELIMITER ;

/* -------- ACTUALIZAR -------- */
DELIMITER $$
CREATE PROCEDURE `actualiza_distribuidor` (
	IN NombreU VARCHAR(50),
    IN idFundadorU INT,
    IN FundacionU DATE,
    IN SitioU text,
    IN idDistribuidorU INT
    )
BEGIN
UPDATE Distribuidor SET
    Nombre=NombreU,
    idFundador=idFundadorU,
    Fundacion=FundacionU,
    Sitio=SitioU
WHERE idDistribuidor = idDistribuidorU;
END$$

DELIMITER ;

/* -------- ELIMINAR -------- */
DELIMITER $$
CREATE PROCEDURE `elimina_distribuidor` (IN idDistribuidorE INT)
BEGIN
DELETE FROM Distribuidor WHERE idDistribuidor = idDistribuidorE;
END$$

DELIMITER ;

/* -------- BUSCAR -------- */
DELIMITER $$
CREATE PROCEDURE `obtener_distribuidor` (IN idDistribuidorI INT)
BEGIN
SELECT * FROM Distribuidor WHERE idDistribuidor = idDistribuidorI;
END$$

DELIMITER ;

/* ----------------------------------------- DESARROLLADOR ----------------------------------------- */
/* -------- MOSTRAR -------- */
DELIMITER $$
CREATE PROCEDURE `mostrar_desarrollador` ()
BEGIN
SELECT idDesarrollador, Nombre, Genero, Fundador, Origen, Fundacion, Sitio FROM Vista_Desarrollador;
END$$

DELIMITER ;

/* -------- INSERTAR -------- */
DELIMITER $$
CREATE PROCEDURE `inserta_desarrollador` (
	IN NombreI VARCHAR(45),
    IN GeneroI VARCHAR(100),
    IN idFundadorI INT,
    IN OrigenI VARCHAR(100),
    IN FundacionI DATE,
    IN SitioI TEXT
)
BEGIN
INSERT INTO Desarrollador(
	Nombre,
	Genero,
	idFundador,
	Origen,
	Fundacion,
	Sitio
) VALUES (
	NombreI,
	GeneroI,
	idFundadorI,
	OrigenI,
	FundacionI,
	SitioI
);
END$$

DELIMITER ;

/* -------- ACTUALIZAR -------- */
DELIMITER $$
CREATE PROCEDURE `actualiza_desarrollador` (
	IN NombreU VARCHAR(45),
    IN GeneroU VARCHAR(100),
    IN idFundadorU INT,
    IN OrigenU VARCHAR(100),
    IN FundacionU DATE,
    IN SitioU TEXT,
    IN idDesarrolladorU INT
    )
BEGIN
UPDATE Desarrollador SET
	Nombre=NombreU,
	Genero=GeneroU,
	idFundador=idFundadorU,
	Origen=OrigenU,
	Fundacion=FundacionU,
	Sitio=SitioU
WHERE idDesarrollador = idDesarrolladorU;
END$$

DELIMITER ;

/* -------- ELIMINAR -------- */
DELIMITER $$
CREATE PROCEDURE `elimina_desarrollador` (IN idDesarrolladorE INT)
BEGIN
DELETE FROM Desarrollador WHERE idDesarrollador = idDesarrolladorE;
END$$

DELIMITER ;

/* -------- BUSCAR -------- */
DELIMITER $$
CREATE PROCEDURE `obtener_desarrollador` (IN idDesarrolladorI INT)
BEGIN
SELECT * FROM Desarrollador WHERE idDesarrollador = idDesarrolladorI;
END$$

DELIMITER ;

/* ----------------------------------------- JUEGOS ----------------------------------------- */
/* -------- MOSTRAR -------- */
DELIMITER $$
CREATE PROCEDURE `mostrar_juego` ()
BEGIN
SELECT idJuego, Nombre, Genero, Modalidad, Plataforma, Lanzamiento, Desarrollador, Distribuidor, Director FROM Vista_Juegos;
END$$

DELIMITER ;

/* -------- INSERTAR -------- */
DELIMITER $$
CREATE PROCEDURE `inserta_juego` (
	IN NombreI VARCHAR(60),
    IN GeneroI VARCHAR(100),
    IN ModalidadI VARCHAR(50),
    IN PlataformaI VARCHAR(60),
    IN LanzamientoI DATE,
    IN idDesarrolladorI INT,
    IN idDistribuidorI INT,
    IN idDirectorI INT
)
BEGIN
INSERT INTO Juegos (
	Nombre,
	Genero,
	Modalidad,
	Plataforma,
	Lanzamiento,
	idDesarrollador,
	idDistribuidor,
	idDirector
)VALUES(
	NombreI,
	GeneroI,
	ModalidadI,
	PlataformaI,
	LanzamientoI,
	idDesarrolladorI,
	idDistribuidorI,
	idDirectorI
);
END$$

DELIMITER ;

/* -------- ACTUALIZAR -------- */
DELIMITER $$
CREATE PROCEDURE `actualiza_juego` (
	IN NombreI VARCHAR(60),
    IN GeneroU VARCHAR(100),
    IN ModalidadU VARCHAR(50),
    IN PlataformaU VARCHAR(60),
    IN LanzamientoU DATE,
    IN idDesarrolladorU INT,
    IN idDistribuidorU INT,
    IN idDirectorU INT,
    IN idJuegoU INT)
BEGIN
UPDATE Juegos SET
	Nombre=NombreI,
	Genero=GeneroU,
	Modalidad=ModalidadU,
	Plataforma=PlataformaU,
	Lanzamiento=LanzamientoU,
	idDesarrollador=idDesarrolladorU,
	idDistribuidor=idDistribuidorU,
	idDirector=idDirectorU
    WHERE idJuego = idJuegoU;
END$$

DELIMITER ;

/* -------- ELIMINAR -------- */
DELIMITER $$
CREATE PROCEDURE `elimina_juego` (IN idJuegoE INT)
BEGIN
DELETE FROM Juegos WHERE idJuego = idJuegoE;
END$$

DELIMITER ;

/* -------- BUSCAR -------- */
DELIMITER $$
CREATE PROCEDURE `obtener_juego` (IN idJuegoI INT)
BEGIN
SELECT * FROM Juegos WHERE idJuego = idJuegoI;
END$$

DELIMITER ;