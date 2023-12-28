/*Se crea la base de datos */
drop schema if exists SG_SOFTWARE;
CREATE SCHEMA SG_SOFTWARE;
use SG_SOFTWARE;

create table Animal(
	id_animal int  not null auto_increment,
    nombre varchar(50) not null,
    fecha_nacimiento date not null,
    raza varchar(50) not null,
    peso float not null,
    numero_arete int unique not null ,
    colores_caracteristicas text,

    observaciones text,
	PRIMARY KEY (id_animal)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;
    
CREATE TABLE Produccion (
    idProduccion INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE not null,
    id_vaca INT not null, 
    litros FLOAT,
    observacionesPr TEXT,
    foreign key fk_produccion_animal (id_vaca) references Animal(id_animal)                                                   
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


CREATE TABLE Produccion_semanal (
    id_produccion_semanal INT AUTO_INCREMENT PRIMARY KEY not null,
    fechaSemana DATE not null,
    litros FLOAT not null,
    calidad_bacteriologica VARCHAR(30) not null,
    celulas_somaticas FLOAT not null,
    porcentaje_grasa FLOAT not null,
    porcentaje_proteina FLOAT not null,
    punto_crioscopico FLOAT not null,
    presencia_inhibidores VARCHAR(30) not null
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

CREATE TABLE Enfermedad (
    id_enfermedad INT AUTO_INCREMENT PRIMARY KEY not null,
    nombre_enfermedad varchar(40) not null,
    descripcion text not null,
    sintomas text not null,
    tratamiento text not null
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


CREATE TABLE Enfermedad_Animal (
    id_enfermedad_animal INT AUTO_INCREMENT PRIMARY KEY not null,
    id_enfermedad INT not null,
    id_animal int not null,
    estado_animal enum('en curso', 'recuperada','cronica','fallecida') not null,
    sintomas_animal text not null,
    fecha_diagnostico date not null,
    observaciones text not null,
    foreign key fk_animal_enfermedad_enfermedad (id_enfermedad) references Enfermedad(id_enfermedad),
    foreign key fk_animal_enfermedad_animal (id_animal) references Animal(id_animal)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


CREATE TABLE Vacuna (
    id_vacuna INT AUTO_INCREMENT PRIMARY KEY not null,
    nombre_vacuna varchar(50) not null,
    descripcion text not null,
	fecha_vencimiento date not null,
    lote varchar(30) not null,
    observaciones text not null,
    casa_distribuidora varchar(100)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

CREATE TABLE Vacunacion (
    id_vacunacion INT AUTO_INCREMENT PRIMARY KEY not null,
	id_vacuna INT not null,
    lugar_aplicacion varchar(50)  not null,
    dosis_aplicada varchar(50) not null,
	fecha_vacunacion date not null,
    cantidad_animales int not null,
    foreign key fk_vacunacion_vacuna (id_vacuna) references Vacuna(id_vacuna)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

CREATE TABLE Vacunacion_Animal (
    id_vacunacion_animal INT AUTO_INCREMENT PRIMARY KEY not null,
	id_vacunacion INT not null,
    id_animal INT not null,
    foreign key fk_vacunacion_animal_vacunacion (id_vacunacion) references Vacunacion(id_vacunacion),
    foreign key fk_vacunacion_animal_animal (id_animal) references Animal(id_animal)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


CREATE TABLE Antibiotico (
    id_antibiotico INT AUTO_INCREMENT PRIMARY KEY not null,
    nombre_antibiotico varchar(80) not null,
    tipo varchar(50) not null,
    descripcion text not null,
	fecha_vencimiento date not null,
    lote varchar(30) not null,
    dias_retiro_leche int not null
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

CREATE TABLE Medicamento (
    id_medicamento INT AUTO_INCREMENT PRIMARY KEY not null,
    nombre_medicamento varchar(80) not null,
    tipo varchar(50) not null,
    descripcion text not null,
	fecha_vencimiento date not null,
    lote varchar(30) not null,
    presentacion varchar(30) not null
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

CREATE TABLE Inyeccion_Medicamento (
    id_inyeccion_medicamento INT AUTO_INCREMENT PRIMARY KEY not null,
	id_medicamento INT not null,
    id_animal INT  not null,
    lugar_aplicacion varchar(50)  not null,
    dosis_aplicada varchar(50) not null,
	fecha_inyeccion date not null,
	foreign key fk_inyeccion_medicamento_medicamento (id_medicamento) references Medicamento(id_medicamento),
    foreign key fk_inyeccion_medicamento_animal (id_animal) references Animal(id_animal)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

CREATE TABLE Inyeccion_Antibiotico (
    id_inyeccion_antibiotico INT AUTO_INCREMENT PRIMARY KEY not null,
	id_antibiotico INT not null,
    id_animal INT  not null,
    lugar_aplicacion varchar(50)  not null,
    dosis_aplicada varchar(50) not null,
	fecha_inyeccion date not null,
    foreign key fk_inyeccion_antibiotico_antibiotico (id_antibiotico) references Antibiotico(id_antibiotico),
    foreign key fk_inyeccion_antibiotico_animal (id_animal) references Animal(id_animal)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;




CREATE TABLE Mastitis (
    id_mastitis INT AUTO_INCREMENT PRIMARY KEY not null,
    id_animal int not null,
    tipo_tratamiento varchar(50) not null,
    cuartos_afectados varchar(50) not null,
	fecha_diagnostico date not null,
    foreign key fk_mastitis_animal (id_animal) references Animal(id_animal)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

CREATE TABLE Aborto (
    id_aborto INT AUTO_INCREMENT PRIMARY KEY not null,
    id_vaca int not null,
	fecha_aborto date not null,
    estado_vaca varchar(80) not null,
    observaciones text not null,
    foreign key fk_aborto_vaca (id_vaca) references  Animal(id_animal)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

CREATE TABLE Parto (
    id_parto INT AUTO_INCREMENT PRIMARY KEY not null,
    id_vaca int not null,
	fecha_parto date not null,
    tipo_parto varchar(30),
    observaciones text not null,
    foreign key fk_parto_vaca (id_vaca) references Animal(id_animal)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

CREATE TABLE Celo (
    id_celo INT AUTO_INCREMENT PRIMARY KEY not null,
    id_animal int not null,
	fecha_celo date not null,
    detalles_celo varchar(80) not null,
    foreign key fk_celo_animal (id_animal) references animal(id_animal)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;



CREATE TABLE Servicio (
    id_servicio INT AUTO_INCREMENT PRIMARY KEY not null,
    id_animal int not null,
	fecha_servicio date not null,
    tipo_servicio varchar (30) not null,
    observaciones text not null
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

CREATE TABLE Secado (
    id_secado INT AUTO_INCREMENT PRIMARY KEY not null,
    id_animal int not null,
    fecha_secado int not null,
    observaciones text not null,
    foreign key fk_secado_animal (id_animal) references Animal(id_animal)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

CREATE TABLE Vaca_Prenada (
    id_vaca_prenada INT AUTO_INCREMENT PRIMARY KEY not null,
    id_servicio int not null,
    foreign key fk_vaca_prenada_servicio (id_servicio) references Servicio(id_servicio)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;





/*foreneas de servicio*/
alter table servicio 
add foreign key (id_animal) references Animal(id_animal);
alter table servicio 
add foreign key (id_animal) references Animal(id_animal);

/*foreneas de Vaca_Prenada*/
alter table Vaca_Prenada 
add foreign key (id_servicio) references Servicio(id_servicio);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    temrs boolean NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Inserts para la tabla Animal
INSERT INTO Animal (nombre, fecha_nacimiento, raza, peso, numero_arete, colores_caracteristicas, observaciones) 
VALUES 
('Bella', '2019-05-15', 'Holstein', 450.5, 250, 'Blanco y negro', 'Vaca lechera de gran tamaño y excelente producción'),
('Roja', '2020-08-20', 'Jersey', 380.2, 251, 'Marrón claro', 'Ternero joven con gran vitalidad'),
('Luna', '2017-12-10', 'Pardo Suizo', 500.0, 252, 'Marrón oscuro', 'Vaca madura con descendencia exitosa'),
('Perla', '2021-02-28', 'Angus', 600.7, 253, 'Negro', 'Toro robusto para reproducción'),
('Daisy', '2020-04-02', 'Simmental', 480.9, 254, 'Rojo y blanco', 'Vaca con excelente temperamento'),
('Rex', '2022-11-18', 'Simmental', 410.6, 255, 'Marrón y blanco', 'Ternero con excelente linaje genético'),
('Lola', '2023-01-10', 'Jersey', 370.9, 256, 'Marrón claro', 'Novilla de gran temperamento y salud'),
('Bruno', '2021-09-05', 'Angus', 590.3, 257, 'Negro', 'Toro reproductor con buena descendencia'),
('Molly', '2020-07-12', 'Holstein', 480.2, 258, 'Blanco y negro', 'Vaca lechera estable y saludable'),
('Max', '2019-12-25', 'Pardo Suizo', 510.8, 259, 'Marrón claro', 'Toro maduro con gran historial de reproducción');

-- Inserts para la tabla Produccion
INSERT INTO Produccion (fecha, id_vaca, litros, observacionesPr) 
VALUES 
('2023-01-05', 1, 28.3, 'Producción promedio diaria'),
('2023-01-06', 2, 25.8, 'Ligero descenso en producción'),
('2023-01-07', 3, 30.5, 'Aumento significativo en la producción'),
('2023-01-08', 4, 32.1, 'Buena producción para la época'),
('2023-01-09', 5, 29.6, 'Estabilidad en la producción lechera'),
('2023-01-10', 6, 27.4, 'Ligero aumento en la producción'),
('2023-01-11', 7, 29.2, 'Producción diaria estable'),
('2023-01-12', 8, 31.8, 'Incremento significativo en la producción'),
('2023-01-13', 9, 26.5, 'Leve descenso en la producción lechera'),
('2023-01-14', 10, 30.5, 'Vaca con producción constante de leche');

-- Inserts para la tabla Enfermedad
INSERT INTO Enfermedad (nombre_enfermedad, descripcion, sintomas, tratamiento) 
VALUES 
('Mastitis', 'Inflamación de la ubre', 'Hinchazón, dolor, cambios en la leche', 'Antibióticos y cuidados específicos'),
('Neumonía', 'Infección respiratoria', 'Tos, dificultad para respirar, fiebre', 'Antibióticos y reposo'),
('Cetosis', 'Desequilibrio metabólico', 'Letargo, pérdida de apetito, problemas de coordinación', 'Cambios en la dieta y tratamiento veterinario'),
('Hepatitis', 'Inflamación del hígado', 'Ictericia, pérdida de apetito, letargo', 'Medicación y dieta especial'),
('Parasitosis', 'Infección por parásitos', 'Diarrea, pérdida de peso, anemia', 'Desparasitación y cuidados sanitarios'),
('Artritis', 'Inflamación de las articulaciones', 'Rigidez, hinchazón, cojera', 'Antiinflamatorios y cuidados veterinarios'),
('Diarrea', 'Trastorno gastrointestinal', 'Heces líquidas, deshidratación', 'Rehidratación y tratamiento específico'),
('Fiebre Aftosa', 'Enfermedad viral contagiosa', 'Ampollas en boca y pezuñas, fiebre alta', 'Control sanitario y cuarentena'),
('Timpanismo', 'Afección digestiva', 'Distensión abdominal, dificultad para respirar', 'Alivio del gas y seguimiento veterinario'),
('Hemorragia Interna', 'Sangrado interno', 'Pérdida de apetito, palidez de mucosas', 'Tratamiento de soporte y transfusiones');

-- Inserts para la tabla Vacuna
INSERT INTO Vacuna (nombre_vacuna, descripcion, fecha_vencimiento, lote, observaciones, casa_distribuidora) 
VALUES 
('Vacuna A', 'Protección contra enfermedades específicas', '2024-06-15', 'ABC123', 'Almacenar a temperatura controlada', 'Veterinaria X'),
('Vacuna B', 'Inmunización contra patógenos comunes', '2024-09-20', 'DEF456', 'Revisar fecha de caducidad antes de usar', 'Veterinaria Y'),
('Vacuna C', 'Prevención de enfermedades virales', '2024-04-30', 'GHI789', 'Uso exclusivo en ganado vacuno', 'Veterinaria Z'),
('Vacuna D', 'Refuerzo de inmunidad para terneros', '2024-08-10', 'JKL012', 'Administrar dosis según protocolo', 'Veterinaria W'),
('Vacuna E', 'Protección contra agentes infecciosos', '2024-11-25', 'MNO345', 'Consultar con profesional veterinario', 'Veterinaria V'),
('Vacuna F', 'Inmunización contra enfermedades específicas', '2024-10-18', 'PQR678', 'Almacenamiento en frío', 'Veterinaria M'),
('Vacuna G', 'Prevención de patógenos comunes', '2024-07-05', 'STU901', 'Uso exclusivo en ganado bovino', 'Veterinaria N'),
('Vacuna H', 'Inmunidad para enfermedades virales', '2024-12-30', 'VWX234', 'Consultar con especialista veterinario', 'Veterinaria O'),
('Vacuna I', 'Protección contra agentes infecciosos', '2024-09-15', 'YZA567', 'Administrar según protocolo establecido', 'Veterinaria P'),
('Vacuna J', 'Vacuna reforzadora para terneros', '2024-11-28', 'BCD890', 'Revisar fecha de vencimiento antes de uso', 'Veterinaria Q');

-- Inserts para la tabla Antibiotico
INSERT INTO Antibiotico (nombre_antibiotico, tipo, descripcion, fecha_vencimiento, lote, dias_retiro_leche) 
VALUES 
('Antibiótico X', 'Amoxicilina', 'Para infecciones bacterianas comunes', '2024-03-12', 'ABCD1234', 5),
('Antibiótico Y', 'Cefalexina', 'Tratamiento de infecciones respiratorias', '2024-07-18', 'EFGH5678', 3),
('Antibiótico Z', 'Enrofloxacina', 'Efectivo contra infecciones urinarias', '2024-05-30', 'IJKL9012', 7),
('Antibiótico W', 'Tetraciclina', 'Para afecciones dérmicas y oculares', '2024-09-25', 'MNOP3456', 4),
('Antibiótico V', 'Penicilina', 'Amplio espectro antibacteriano', '2024-12-10', 'QRST7890', 6),
('Antibiótico R', 'Eritromicina', 'Para infecciones bacterianas diversas', '2024-04-20', 'EFGH5678', 6),
('Antibiótico S', 'Gentamicina', 'Tratamiento de infecciones graves', '2024-08-05', 'IJKL9012', 4),
('Antibiótico T', 'Metronidazol', 'Efectivo contra infecciones parasitarias', '2024-06-10', 'MNOP3456', 5),
('Antibiótico U', 'Clindamicina', 'Para infecciones de piel y tejidos blandos', '2024-09-30', 'QRST7890', 3),
('Antibiótico V', 'Ciprofloxacina', 'Tratamiento de infecciones del tracto urinario', '2024-12-15', 'UVWX1234', 7);

INSERT INTO Medicamento (nombre_medicamento, tipo, descripcion, fecha_vencimiento, lote, presentacion) 
VALUES 
('Medicamento A', 'Suplemento nutricional', 'Para fortalecer sistema inmune', '2024-05-25', 'ABCD5678', 'Inyectable'),
('Medicamento B', 'Antiparasitario', 'Control de parásitos internos', '2024-08-08', 'EFGH9012', 'Oral'),
('Medicamento C', 'Analgésico', 'Alivio del dolor y la inflamación', '2024-07-20', 'IJKL3456', 'Tópico'),
('Medicamento D', 'Antihistamínico', 'Control de reacciones alérgicas', '2024-10-05', 'MNOP7890', 'Oral'),
('Medicamento E', 'Antiinflamatorio', 'Reducción de la inflamación', '2024-11-20', 'QRST1234', 'Inyectable');

INSERT INTO Produccion_semanal (fechaSemana, litros, calidad_bacteriologica, celulas_somaticas, porcentaje_grasa, porcentaje_proteina, punto_crioscopico, presencia_inhibidores) 
VALUES 
('2023-01-01', 200.5, 'Buena', 150000, 4.2, 3.5, -0.15, 'Negativo'),
('2023-01-08', 190.0, 'Aceptable', 160000, 4.0, 3.8, -0.10, 'Negativo'),
('2023-01-15', 205.8, 'Buena', 145000, 4.5, 3.7, -0.18, 'Negativo'),
('2023-01-22', 198.2, 'Aceptable', 155000, 4.1, 3.6, -0.12, 'Negativo'),
('2023-01-29', 201.6, 'Buena', 148000, 4.3, 3.9, -0.17, 'Negativo');

INSERT INTO Enfermedad_Animal (id_enfermedad, id_animal, estado_animal, sintomas_animal, fecha_diagnostico, observaciones) 
VALUES 
(1, 6, 'en curso', 'Hinchazón en la articulación derecha', '2023-01-10', 'Iniciar tratamiento antibiótico'),
(2, 7, 'recuperada', 'Episodios intermitentes de diarrea', '2023-01-12', 'Finalizó tratamiento con mejoría'),
(3, 8, 'cronica', 'Fiebre y pérdida de apetito', '2023-01-14', 'Continuar monitoreo y tratamiento'),
(4, 9, 'fallecida', 'Letargo y coloración amarillenta en mucosas', '2023-01-16', 'Lamentablemente, no se logró recuperar'),
(5, 10, 'en curso', 'Episodios de debilidad y hemorragia', '2023-01-18', 'Iniciar tratamiento intensivo');


INSERT INTO Vacunacion (id_vacuna, lugar_aplicacion, dosis_aplicada, fecha_vacunacion, cantidad_animales) 
VALUES 
(6, 'Hombro izquierdo', '5 ml', '2023-01-02', 20),
(7, 'Cadera derecha', '4 ml', '2023-01-09', 18),
(8, 'Hombro derecho', '6 ml', '2023-01-16', 22),
(9, 'Muslo izquierdo', '7 ml', '2023-01-23', 19),
(10, 'Cadera izquierda', '5 ml', '2023-01-30', 21);

INSERT INTO Vacunacion_Animal (id_vacunacion, id_animal) 
VALUES 
(1, 6),
(2, 7),
(3, 8),
(4, 9),
(5, 10);

INSERT INTO Servicio (id_animal, fecha_servicio, tipo_servicio, observaciones) 
VALUES 
(1, '2023-01-05', 'Inseminación artificial', 'Servicio realizado con éxito'),
(2, '2023-01-12', 'Monta natural', 'Servicio exitoso, esperar confirmación'),
(3, '2023-01-19', 'Inseminación artificial', 'Servicio programado'),
(4, '2023-01-26', 'Monta natural', 'Servicio exitoso, confirmar preñez'),
(5, '2023-02-02', 'Inseminación artificial', 'Servicio realizado con cuidados adicionales');


INSERT INTO Inyeccion_Medicamento (id_medicamento, id_animal, lugar_aplicacion, dosis_aplicada, fecha_inyeccion) 
VALUES 
(1, 6, 'Espalda', '10 ml', '2023-01-05'),
(2, 7, 'Cuello', '8 ml', '2023-01-12'),
(3, 8, 'Costado derecho', '12 ml', '2023-01-19'),
(4, 9, 'Costado izquierdo', '9 ml', '2023-01-26'),
(5, 10, 'Espalda', '11 ml', '2023-02-02');


INSERT INTO Inyeccion_Antibiotico (id_antibiotico, id_animal, lugar_aplicacion, dosis_aplicada, fecha_inyeccion) 
VALUES 
(6, 6, 'Cadera derecha', '15 ml', '2023-01-08'),
(7, 7, 'Espalda', '12 ml', '2023-01-15'),
(8, 8, 'Costado izquierdo', '18 ml', '2023-01-22'),
(9, 9, 'Costado derecho', '13 ml', '2023-01-29'),
(10, 10, 'Cuello', '16 ml', '2023-02-05');


INSERT INTO Mastitis (id_animal, tipo_tratamiento, cuartos_afectados, fecha_diagnostico) 
VALUES 
(6, 'Antibióticos', 'Cuarto trasero izquierdo', '2023-01-07'),
(7, 'Compresas calientes', 'Cuarto delantero derecho', '2023-01-14'),
(8, 'Masaje terapéutico', 'Cuartos traseros', '2023-01-21'),
(9, 'Antibióticos y masajes', 'Cuartos delanteros', '2023-01-28'),
(10, 'Compresas frías', 'Todos los cuartos', '2023-02-04');

INSERT INTO Aborto (id_vaca, fecha_aborto, estado_vaca, observaciones) 
VALUES 
(6, '2023-01-11', 'En recuperación', 'Aborto debido a complicaciones en gestación'),
(7, '2023-01-18', 'Estable', 'Aborto espontáneo, vaca en buen estado'),
(8, '2023-01-25', 'En tratamiento', 'Aborto debido a infección, requiere seguimiento'),
(9, '2023-02-01', 'Recuperada', 'Aborto provocado por trauma, vaca se recupera bien'),
(10, '2023-02-08', 'Fallecida', 'Aborto con complicaciones, vaca no sobrevivió');

INSERT INTO Parto (id_vaca, fecha_parto, tipo_parto, observaciones) 
VALUES 
(6, '2023-01-13', 'Normal', 'Parto sin complicaciones, cría saludable'),
(7, '2023-01-20', 'Asistido', 'Parto asistido, cría sana pero débil'),
(8, '2023-01-27', 'Distócico', 'Parto difícil, cría y vaca necesitan cuidados'),
(9, '2023-02-03', 'Normal', 'Parto exitoso, cría y madre bien'),
(10, '2023-02-10', 'Asistido', 'Parto asistido, cría saludable pero débil');

INSERT INTO Celo (id_animal, fecha_celo, detalles_celo) 
VALUES 
(6, '2023-01-15', 'Celo evidente, comportamiento inquieto'),
(7, '2023-01-22', 'Síntomas leves de celo, menor actividad'),
(8, '2023-01-29', 'Celo marcado, comportamiento agitado'),
(9, '2023-02-05', 'Celo observado, intentos de monta'),
(10, '2023-02-12', 'Celo evidente, actividad aumentada');

INSERT INTO Secado (id_animal, fecha_secado, observaciones) 
VALUES 
(6, '2023-01-17', 'Secado programado tras parto exitoso'),
(7, '2023-01-24', 'Secado anticipado debido a enfermedad'),
(8, '2023-01-31', 'Secado según cronograma establecido'),
(9, '2023-02-07', 'Secado tras complicaciones en parto'),
(10, '2023-02-14', 'Secado con cuidados adicionales tras parto asistido');


INSERT INTO Vaca_Prenada (id_servicio) 
VALUES 
(1),
(2),
(3),
(4),
(5);




