GRANT ALL ON SCHEMA public TO postgres;

-- tables

-- Table: Usuario
CREATE TABLE Usuario (
    usuario_id  SERIAL,
    usuario     VARCHAR(50),
    contrasenia VARCHAR(300),
    nombres     VARCHAR(100),
    apellidos   VARCHAR(100),
    correo      VARCHAR(100),
    perfil      VARCHAR(20) DEFAULT 'GANADERO',
    estado      BOOLEAN,
    cod_conf    SERIAL,
    CONSTRAINT usuario_id PRIMARY KEY (usuario_id)
);

-- Table: Ganadero
CREATE TABLE Ganadero (
    ganadero_id SERIAL,
    usuario     VARCHAR(50),
    detalle     TEXT,
    CONSTRAINT ganadero_id PRIMARY KEY (ganadero_id)
);

-- Table: Establo
CREATE TABLE Establo (
    establo_id  SERIAL,
    nombre      VARCHAR(50),
    detalle     TEXT,
    pais        VARCHAR(50),
    region      VARCHAR(50),
    ciudad      VARCHAR(50),
    comuna      VARCHAR(50),
    latitud     NUMERIC(10,8),
    longitud    NUMERIC(10,8),
    altitud     NUMERIC(10,8),
    ganadero_id SERIAL,
    CONSTRAINT establo_id PRIMARY KEY (establo_id),
    FOREIGN KEY (ganadero_id) REFERENCES Ganadero (ganadero_id)  
);

-- Table: Ganado
CREATE TABLE Ganado (
    ganado_id       SERIAL,
    nombre          VARCHAR(50),
    registro        VARCHAR(100),
    raza            VARCHAR(50),
    procedencia     VARCHAR(50),
    dob             DATE,
    pesodob         NUMERIC(5,2),
    v_padre         VARCHAR(100),
    rgp             VARCHAR(100),                    -- registro geneologico del padre
    v_madre         VARCHAR(100),
    rgm             VARCHAR(100),
    establo_id      SERIAL,
    estado_saca     BOOLEAN,
    motivo_saca     TEXT,
    fecha_saca      DATE,
    CONSTRAINT ganado_id PRIMARY KEY (ganado_id),
    FOREIGN KEY (establo_id) REFERENCES Establo (establo_id) 
);

-- Table: produccion
CREATE TABLE produccion (
    produccion_id   SERIAL,
    fecha           DATE,
    hora            VARCHAR(20),   -- intervalos de hora
    litros_leche    DECIMAL(5,2),
    solidos         DECIMAL(5,2),
    c_somaticas     DECIMAL(5,2),
    estado_prod     VARCHAR(20),            -- estado de produccion  ALTA, MEDIA, BAJA
    ganado_id       SERIAL,
    CONSTRAINT produccion_id PRIMARY KEY (produccion_id),
    FOREIGN KEY (ganado_id) REFERENCES Ganado (ganado_id)  
);

-- Table: Monitoreo
CREATE TABLE Monitoreo (
    monitoreo_id    SERIAL,
    prof_ubre       DECIMAL(5,2),
    prof_corp       DECIMAL(5,2),
    url_imagen_1      VARCHAR(500),
    url_imagen_2     VARCHAR(500),
    fecha           DATE,
    ganado_id       SERIAL,
    CONSTRAINT monitoreo_id PRIMARY KEY (monitoreo_id),
    FOREIGN KEY (ganado_id) REFERENCES Ganado (ganado_id)  
);

-- Table: reproduccion
CREATE TABLE Reproduccion(
    reproduccion_id SERIAL,
    estado_vaca     VARCHAR(50),      -- VACA PREÑANA,VACIA,SECA
    ultimo_celo     DATE,
    peso            DECIMAL(5,2),
    estado          BOOLEAN,
    ganado_id       SERIAL,
    CONSTRAINT reproduccion_id PRIMARY KEY (reproduccion_id),
    FOREIGN KEY (ganado_id) REFERENCES Ganado (ganado_id) 
);
-- Table: Catalogo
CREATE TABLE Catalogo (
    catalogo_id SERIAL,
    cod_tabla   VARCHAR(3),
    indice      CHAR(1),
    codigo      VARCHAR(4),
    descripcion VARCHAR(80),
    CONSTRAINT catalogo_id PRIMARY KEY (catalogo_id)
);







