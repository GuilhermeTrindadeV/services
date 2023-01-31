INSERT INTO usuario (id, nome, email, senha, apelido, token, tip_usu_id, data_c, data_m) VALUES 
    (1, 'Admin', 'admin@gtgng.software', '$2y$10$D0kwH1JulzE7xOdrzDWaAe/SYkX9isoWeWyL2QOpqPGx5OvKB6N4C', 'admin', 'fahdsfewtewiuthaidsuf', 1, '2022-12-13 20:45:00', '2022-12-13 20:45:00');

INSERT INTO usuario (id, nome, email, senha, apelido, token, tip_usu_id, data_c, data_m) VALUES 
    (4, 'Gui', 'gui@gtgng.software', 'gui', 'gui', 'fahdsfewtewiuthaidsuf', 1, '2022-12-13 20:45:00', '2022-12-13 20:45:00');

INSERT INTO tipo_usuario (tip_usu_id, tip_nome, tip_nome_plural, tip_data_c, tip_data_m) VALUES 
    (1, 'Administrador', 'Administradores', '2022-12-13 20:45:00', '2022-12-13 20:45:00'), 
    (2, 'Editor', 'Editores', '2022-12-13 20:45:00', '2022-12-13 20:45:00'),
    (3, 'Ministro', 'Ministros', '2022-12-13 20:45:00', '2022-12-13 20:45:00'),
    (4, 'Visualizador', 'Visualizadores', '2022-12-13 20:45:00', '2022-12-13 20:45:00');