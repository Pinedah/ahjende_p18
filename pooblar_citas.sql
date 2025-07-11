-- Script para poblar la base de datos con 5 citas por ejecutivo activo
-- Práctica 18 - Conteos Recursivos desde Ejecutivos / Citas

USE ahj_ende_pinedah;

-- Limpiar citas existentes para tener un control completo
DELETE FROM cita WHERE id_cit >= 73;

-- Poblar con 5 citas por ejecutivo activo
-- Ejecutivo 2: María Fernanda López
INSERT INTO cita (cit_cit, hor_cit, nom_cit, tel_cit, id_eje2, eli_cit) VALUES
('2025-07-12', '09:00:00', 'Reunión de planificación Q3', '555-2001', 2, 1),
('2025-07-12', '11:30:00', 'Entrevista candidato Senior', '555-2002', 2, 1),
('2025-07-13', '14:00:00', 'Revisión presupuesto anual', '555-2003', 2, 1),
('2025-07-13', '16:15:00', 'Capacitación nuevo personal', '555-2004', 2, 1),
('2025-07-14', '10:00:00', 'Junta directiva mensual', '555-2005', 2, 1);

-- Ejecutivo 4: Francisco Pineda
INSERT INTO cita (cit_cit, hor_cit, nom_cit, tel_cit, id_eje2, eli_cit) VALUES
('2025-07-12', '08:30:00', 'Evaluación proyecto Alpha', '555-4001', 4, 1),
('2025-07-12', '13:00:00', 'Reunión con cliente VIP', '555-4002', 4, 1),
('2025-07-13', '09:45:00', 'Auditoria sistemas internos', '555-4003', 4, 1),
('2025-07-13', '15:30:00', 'Presentación resultados Q2', '555-4004', 4, 1),
('2025-07-14', '11:00:00', 'Workshop innovación digital', '555-4005', 4, 1);

-- Ejecutivo 6: Fatima Nava
INSERT INTO cita (cit_cit, hor_cit, nom_cit, tel_cit, id_eje2, eli_cit) VALUES
('2025-07-12', '10:15:00', 'Sesión estrategia marketing', '555-6001', 6, 1),
('2025-07-12', '14:30:00', 'Análisis competencia mercado', '555-6002', 6, 1),
('2025-07-13', '08:00:00', 'Desayuno ejecutivo networking', '555-6003', 6, 1),
('2025-07-13', '17:00:00', 'Cierre negociación contrato', '555-6004', 6, 1),
('2025-07-14', '12:30:00', 'Revisión métricas performance', '555-6005', 6, 1);

-- Ejecutivo 9: Ana Garcia Silva
INSERT INTO cita (cit_cit, hor_cit, nom_cit, tel_cit, id_eje2, eli_cit) VALUES
('2025-07-12', '09:30:00', 'Supervisión equipo ventas', '555-9001', 9, 1),
('2025-07-12', '12:00:00', 'Negociación proveedor clave', '555-9002', 9, 1),
('2025-07-13', '10:30:00', 'Evaluación desempeño trimestral', '555-9003', 9, 1),
('2025-07-13', '16:45:00', 'Planificación campaña publicitaria', '555-9004', 9, 1),
('2025-07-14', '14:00:00', 'Reunión comité ejecutivo', '555-9005', 9, 1);

-- Ejecutivo 10: Luis Rodriguez
INSERT INTO cita (cit_cit, hor_cit, nom_cit, tel_cit, id_eje2, eli_cit) VALUES
('2025-07-12', '08:00:00', 'Revisión procesos operativos', '555-1001', 10, 1),
('2025-07-12', '15:00:00', 'Entrenamiento liderazgo', '555-1002', 10, 1),
('2025-07-13', '11:15:00', 'Análisis indicadores KPI', '555-1003', 10, 1),
('2025-07-13', '14:45:00', 'Sesión feedback 360°', '555-1004', 10, 1),
('2025-07-14', '09:15:00', 'Planeación estratégica anual', '555-1005', 10, 1);

-- Ejecutivo 11: Carmen Morales Vega
INSERT INTO cita (cit_cit, hor_cit, nom_cit, tel_cit, id_eje2, eli_cit) VALUES
('2025-07-12', '11:00:00', 'Workshop desarrollo personal', '555-1101', 11, 1),
('2025-07-12', '16:30:00', 'Reunión recursos humanos', '555-1102', 11, 1),
('2025-07-13', '09:00:00', 'Capacitación normativas legales', '555-1103', 11, 1),
('2025-07-13', '13:30:00', 'Evaluación clima organizacional', '555-1104', 11, 1),
('2025-07-14', '15:45:00', 'Sesión coaching ejecutivo', '555-1105', 11, 1);

-- Ejecutivo 12: Diego Herrera Luna
INSERT INTO cita (cit_cit, hor_cit, nom_cit, tel_cit, id_eje2, eli_cit) VALUES
('2025-07-12', '10:45:00', 'Revisión portafolio inversiones', '555-1201', 12, 1),
('2025-07-12', '13:45:00', 'Análisis riesgo crediticio', '555-1202', 12, 1),
('2025-07-13', '08:15:00', 'Comité finanzas corporativas', '555-1203', 12, 1),
('2025-07-13', '15:00:00', 'Presentación estados financieros', '555-1204', 12, 1),
('2025-07-14', '11:30:00', 'Reunión auditoria externa', '555-1205', 12, 1);

-- Ejecutivo 13: Sofia Mendoza
INSERT INTO cita (cit_cit, hor_cit, nom_cit, tel_cit, id_eje2, eli_cit) VALUES
('2025-07-12', '09:15:00', 'Sesión innovación tecnológica', '555-1301', 13, 1),
('2025-07-12', '14:00:00', 'Revisión arquitectura sistemas', '555-1302', 13, 1),
('2025-07-13', '10:00:00', 'Workshop metodologías ágiles', '555-1303', 13, 1),
('2025-07-13', '17:30:00', 'Evaluación herramientas DevOps', '555-1304', 13, 1),
('2025-07-14', '13:00:00', 'Planeación roadmap tecnológico', '555-1305', 13, 1);

-- Ejecutivo 14: Pablo Jimenez
INSERT INTO cita (cit_cit, hor_cit, nom_cit, tel_cit, id_eje2, eli_cit) VALUES
('2025-07-12', '08:45:00', 'Reunión equipo desarrollo', '555-1401', 14, 1),
('2025-07-12', '12:15:00', 'Revisión calidad software', '555-1402', 14, 1),
('2025-07-13', '14:30:00', 'Capacitación nuevas tecnologías', '555-1403', 14, 1),
('2025-07-13', '16:00:00', 'Análisis performance aplicaciones', '555-1404', 14, 1),
('2025-07-14', '10:30:00', 'Sesión arquitectura microservicios', '555-1405', 14, 1);

-- Ejecutivo 15: Elena Vargas
INSERT INTO cita (cit_cit, hor_cit, nom_cit, tel_cit, id_eje2, eli_cit) VALUES
('2025-07-12', '11:45:00', 'Evaluación satisfacción cliente', '555-1501', 15, 1),
('2025-07-12', '15:30:00', 'Estrategia retención clientes', '555-1502', 15, 1),
('2025-07-13', '09:30:00', 'Análisis journey del cliente', '555-1503', 15, 1),
('2025-07-13', '13:00:00', 'Workshop experiencia usuario', '555-1504', 15, 1),
('2025-07-14', '16:15:00', 'Reunión equipo customer success', '555-1505', 15, 1);

-- Ejecutivo 16: Andres Castro
INSERT INTO cita (cit_cit, hor_cit, nom_cit, tel_cit, id_eje2, eli_cit) VALUES
('2025-07-12', '10:00:00', 'Supervisión cadena suministro', '555-1601', 16, 1),
('2025-07-12', '13:15:00', 'Negociación contratos logística', '555-1602', 16, 1),
('2025-07-13', '08:30:00', 'Optimización procesos distribución', '555-1603', 16, 1),
('2025-07-13', '15:45:00', 'Evaluación proveedores estratégicos', '555-1604', 16, 1),
('2025-07-14', '12:00:00', 'Reunión comité operaciones', '555-1605', 16, 1);

-- Ejecutivo 18: Francisco Pineda Hernández
INSERT INTO cita (cit_cit, hor_cit, nom_cit, tel_cit, id_eje2, eli_cit) VALUES
('2025-07-12', '09:45:00', 'Sesión mentoría ejecutiva', '555-1801', 18, 1),
('2025-07-12', '14:15:00', 'Revisión estrategia corporativa', '555-1802', 18, 1),
('2025-07-13', '11:00:00', 'Workshop liderazgo transformacional', '555-1803', 18, 1),
('2025-07-13', '16:30:00', 'Evaluación cultura organizacional', '555-1804', 18, 1),
('2025-07-14', '13:45:00', 'Planeación sucesión ejecutiva', '555-1805', 18, 1);

-- Ejecutivo 20: Samuel Ortigoza
INSERT INTO cita (cit_cit, hor_cit, nom_cit, tel_cit, id_eje2, eli_cit) VALUES
('2025-07-12', '08:15:00', 'Análisis mercado internacional', '555-2001', 20, 1),
('2025-07-12', '11:15:00', 'Estrategia expansión regional', '555-2002', 20, 1),
('2025-07-13', '14:15:00', 'Evaluación alianzas estratégicas', '555-2003', 20, 1),
('2025-07-13', '17:15:00', 'Sesión innovación disruptiva', '555-2004', 20, 1),
('2025-07-14', '10:45:00', 'Reunión consejo administración', '555-2005', 20, 1);

-- Ejecutivo 21: Rodrigo Ramirez
INSERT INTO cita (cit_cit, hor_cit, nom_cit, tel_cit, id_eje2, eli_cit) VALUES
('2025-07-12', '12:30:00', 'Supervisión seguridad informática', '555-2101', 21, 1),
('2025-07-12', '16:00:00', 'Auditoria compliance regulatorio', '555-2102', 21, 1),
('2025-07-13', '09:15:00', 'Capacitación protección datos', '555-2103', 21, 1),
('2025-07-13', '12:45:00', 'Evaluación riesgos operacionales', '555-2104', 21, 1),
('2025-07-14', '15:00:00', 'Reunión comité riesgos', '555-2105', 21, 1);

-- Verificar que se insertaron correctamente
SELECT 'Citas insertadas por ejecutivo:' as mensaje;
SELECT 
    e.id_eje,
    e.nom_eje,
    COUNT(c.id_cit) as total_citas
FROM ejecutivo e
LEFT JOIN cita c ON e.id_eje = c.id_eje2 AND c.eli_cit = 1
WHERE e.eli_eje = 1
GROUP BY e.id_eje, e.nom_eje
ORDER BY e.id_eje;
