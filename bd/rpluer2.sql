CREATE TABLE odts
(
ID bigint not null primary key,
CLAVE varchar(150) not null,
TARJETA varchar(150),
CVE_CTE varchar(200),
CVE_RELOJ varchar(200),
REFERENCIA varchar(200),
CVE_SERVICIO varchar(200),
MN bigint,
RECIBO_PLUER varchar(200),
AUTORIZADO varchar(10),
ENTRADA_CAJA varchar(200),
RECIBE_RELOJERO varchar(10),
ENTREGA_RELOJERO varchar(10),
ENTREGA_CLIENTE varchar(10),
CVE_RELOJERO varchar(200)
)

CREATE TABLE clientes(
CLAVE varchar(10) not null,
ESTATUS varchar(1) not null,
NOMBRE varchar(120),
RFC varchar(15),
CALLE varchar(80),
COLONIA varchar(50),
MUNICIPIO varchar(50),
ESTADO varchar(50),
TELEFONO varchar(25),
EMAIL varchar(60),
SALDO double precision
JOYERIA varchar(150)
)

CREATE TABLE joyeria(
CLAVE varchar(10) not null,
NOMBRE varchar(120),
CALLE varchar(80),
COLONIA varchar(50),
MUNICIPIO varchar(50),
ESTADO varchar(50),
TELEFONO varchar(25)
)

CREATE TABLE reloj(
CVE_RELOJ varchar(10) not null,
MARCA varchar(150),
MODELO varchar(150),
NO_CAJA varchar(150),
CALIBRE varchar(150),
MAQUINA varchar(150),
MAT_CAJA varchar(150),
MAT_PULSO varchar(150)
)

CREATE TABLE relojero(
CLAVE varchar(150) not null,
NOMBRE varchar(120),
CALLE varchar(80),
COLONIA varchar(50),
MUNICIPIO varchar(50),
ESTADO varchar(50),
TELEFONO varchar(25)
)

CREATE TABLE servicios(
CLAVE varchar(150) not null,
NOMBRE varchar(100),
TIPO varchar(150),
LIBRE1 varchar(150),
LIBRE2 varchar(150)
)

CREATE TABLE ejemplo(
REMISION varchar(200),
TARJETA varchar(200),
NOMBRE_CLIENTE varchar(200),
JOYERIA varchar(200),
MARCA varchar(200),
MODELO varchar(200),
NO_CAJA varchar(200),
REFERENCIA varchar(200),
CALIBRE varchar(200),
MAQUINA varchar(200),
SERVICIO varchar(200),
MN varchar(200),
RECIBO_PLUER varchar(200),
AUTORIZA varchar(200),
ENTRADA_CAJA varchar(200),
ENTR_R varchar(200),
SALIDA_R varchar(200),
ENTREGADO varchar(200),
RELOJERO varchar(200)
)