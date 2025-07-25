<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 18 - Sistema de Citas</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Handsontable CSS -->
    <link rel="stylesheet" href="handsontable/handsontable.full.min.css">
    
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Handsontable JS -->
    <script src="handsontable/handsontable.full.min.js"></script>
    
    <style>
        .horario-column {
            background-color: #f8f9fa;
            font-weight: bold;
            text-align: center;
        }
        .filter-section {
            background-color: #e9ecef;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .filter-section label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 5px;
        }
        .filter-section .form-control {
            border-radius: 4px;
            border: 1px solid #ced4da;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .filter-section .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        .filter-section .btn {
            border-radius: 4px;
            padding: 6px 12px;
            font-weight: 500;
        }
        .filter-section .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
        .filter-section .btn-info:hover {
            background-color: #138496;
            border-color: #117a8b;
        }
        .filter-section .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .filter-section .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        .search-section {
            background-color: #f1f3f4;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        /* Estilos para mejorar la visualización de grupos horarios */
        .ht_master .wtHolder .wtTable tbody tr:nth-child(4n+1) td {
            border-top: 2px solid #007bff !important;
        }
        .ht_master .wtHolder .wtTable tbody tr:nth-child(4n+2) td,
        .ht_master .wtHolder .wtTable tbody tr:nth-child(4n+3) td {
            background-color: #f8f9fa;
        }
        
        /* Estilos para el modal de historial */
        #modalHistorialCita .modal-dialog {
            max-width: 90%;
        }
        
        #tablaHistorialCita {
            font-size: 0.9em;
        }
        
        #tablaHistorialCita td {
            vertical-align: middle;
            word-wrap: break-word;
            max-width: 300px;
        }
        
        #infoHistorialCita {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            border-left: 4px solid #007bff;
        }
        
        .badge {
            font-size: 0.8em;
            padding: 0.4em 0.6em;
        }
    </style>
</head>
<body>
    <div class="container-fluid mt-4">
        <h1 class="text-center mb-4">Práctica 18 - Sistema de Citas</h1>
        
        <div class="card">
            <div class="card-header">
                <h4>Sistema de Citas</h4>
            </div>
            <div class="card-body">
                
                <!-- Mensaje de navegación desde árbol de ejecutivos -->
                <div id="mensajeNavegacion"></div>
                
                <!-- Botón de regreso (solo visible cuando se navega desde un árbol) -->
                <div id="botonRegreso" style="display: none;" class="mb-3">
                    <button class="btn btn-outline-primary" onclick="regresarAOrigen()">
                        <i class="fas fa-arrow-left"></i> <span id="textoRegreso">Regresar</span>
                    </button>
                </div>
                
                <!-- Buscador de citas -->
                <div class="search-section">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="buscador-citas"><strong>Buscar Citas:</strong></label>
                            <input type="text" id="buscador-citas" class="form-control" placeholder="Buscar por nombre, teléfono o ejecutivo...">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-primary" onclick="buscarCitas()">Buscar</button>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-secondary" onclick="limpiarBusqueda()">Actualizar</button>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-success" onclick="mostrarModalNuevaColumna()">+ Columna</button>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-info" onclick="recargarEstructura()">🔄 Recargar</button>
                        </div>
                        <br>
                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-outline-primary" onclick="window.location.href='arbol_ejecutivos.php'">
                                <i class="fas fa-sitemap"></i> Ejecutivos
                            </button>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-outline-success" onclick="window.location.href='arbol_planteles.php'">
                                <i class="fas fa-building"></i> Planteles
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Filtro de fecha -->
                <div class="filter-section">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="fecha-inicio-filtro"><strong>Fecha Inicio:</strong></label>
                            <input type="date" id="fecha-inicio-filtro" class="form-control" value="">
                        </div>
                        <div class="col-md-2">
                            <label for="fecha-fin-filtro"><strong>Fecha Fin:</strong></label>
                            <input type="date" id="fecha-fin-filtro" class="form-control" value="">
                        </div>
                        <div class="col-md-2">
                            <label for="ejecutivo-filtro"><strong>Ejecutivo:</strong></label>
                            <select id="ejecutivo-filtro" class="form-control">
                                <option value="">Todos los ejecutivos</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="plantel-filtro"><strong>Plantel:</strong></label>
                            <select id="plantel-filtro" class="form-control">
                                <option value="">Todos los planteles</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="planteles-asociados-filtro"><strong>Incluir Planteles Asociados:</strong></label>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" id="planteles-asociados-filtro" value="1">
                                <label class="form-check-label" for="planteles-asociados-filtro">
                                    🕋 Planteles Asociados
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-info mr-2" onclick="cargarCitas()">
                                <i class="fas fa-filter"></i> Filtrar
                            </button>
                            <button class="btn btn-secondary" onclick="limpiarFiltros()">
                                <i class="fas fa-times"></i> Limpiar
                            </button>
                        </div>
                    </div>
                    <!-- Información del filtro activo -->
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div id="info-filtro-activo" class="alert alert-info" style="display: none; margin-bottom: 0; padding: 8px 12px;">
                                <small><strong>Filtros activos:</strong> <span id="detalle-filtros"></span></small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Filtros rápidos -->
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <small class="text-muted">
                                <strong>Filtros rápidos:</strong>
                                <button class="btn btn-sm btn-outline-secondary ml-1" onclick="aplicarFiltroRapido('hoy')">Hoy</button>
                                <button class="btn btn-sm btn-outline-secondary ml-1" onclick="aplicarFiltroRapido('semana')">Esta Semana</button>
                                <button class="btn btn-sm btn-outline-secondary ml-1" onclick="aplicarFiltroRapido('mes')">Este Mes</button>
                                <button class="btn btn-sm btn-outline-secondary ml-1" onclick="aplicarFiltroRapido('ultimos7')">Últimos 7 días</button>
                                <button class="btn btn-sm btn-outline-secondary ml-1" onclick="aplicarFiltroRapido('ultimos30')">Últimos 30 días</button>
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Contenedor Handsontable -->
                <div id="tabla-citas" style="width: 100%; height: 600px;"></div>
                
            </div>
        </div>
    </div>

    <!-- Modal para agregar nueva columna -->
    <div class="modal fade" id="modalNuevaColumna" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Nueva Columna</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="formNuevaColumna">
                        <div class="form-group">
                            <label for="nombreColumna">Nombre de la Columna:</label>
                            <input type="text" class="form-control" id="nombreColumna" placeholder="ej: observaciones" required>
                            <small class="form-text text-muted">Solo letras, números y guiones bajos. No espacios.</small>
                        </div>
                        <div class="form-group">
                            <label for="tipoColumna">Tipo de Columna:</label>
                            <select class="form-control" id="tipoColumna">
                                <option value="VARCHAR(100)">Texto (VARCHAR)</option>
                                <option value="TEXT">Texto Largo (TEXT)</option>
                                <option value="INT">Número Entero (INT)</option>
                                <option value="DECIMAL(10,2)">Número Decimal</option>
                                <option value="DATE">Fecha (DATE)</option>
                                <option value="TIME">Hora (TIME)</option>
                                <option value="DATETIME">Fecha y Hora</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="crearNuevaColumna()">Crear Columna</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para mostrar historial de cita -->
    <div class="modal fade" id="modalHistorialCita" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Historial de Cita</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="infoHistorialCita" class="mb-3">
                        <strong>Cita:</strong> <span id="nombreCitaHistorial"></span><br>
                        <strong>ID:</strong> <span id="idCitaHistorial"></span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Fecha/Hora</th>
                                    <th>Responsable</th>
                                    <th>Movimiento</th>
                                    <th>Descripción</th>
                                </tr>
                            </thead>
                            <tbody id="tablaHistorialCita">
                                <!-- Contenido dinámico -->
                            </tbody>
                        </table>
                    </div>
                    <div id="sinHistorial" style="display: none;" class="text-center text-muted">
                        <p>No hay historial disponible para esta cita.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // =====================================
        // CONFIGURACIÓN DE COLUMNAS
        // =====================================
        
        // Configuración dinámica de columnas (se carga desde el servidor)
        var columnasConfig = [];
        
        // Variables globales
        var hot = null;
        var ejecutivos = [];
        var ejecutivosDropdown = [];
        var modoFiltroFecha = true; // true = filtro por fecha, false = búsqueda
        var citasPorRango = 4; // Número de citas por rango horario (2 en blanco + 2 para citas)
        var filaEditandose = null; // Fila que se está editando actualmente
        var datosPendientes = {}; // Datos pendientes de guardar para la fila actual
        
        // =====================================
        // INICIALIZACIÓN
        // =====================================
        
        $(document).ready(function() {
            // Configurar fechas por defecto (última semana)
            var fechaHoy = new Date();
            var fechaFin = fechaHoy.toISOString().split('T')[0];
            var fechaInicioDate = new Date(fechaHoy);
            fechaInicioDate.setDate(fechaInicioDate.getDate() - 7); // Una semana atrás
            var fechaInicio = fechaInicioDate.toISOString().split('T')[0];
            
            $('#fecha-inicio-filtro').val(fechaInicio);
            $('#fecha-fin-filtro').val(fechaFin);
            
            // Agregar validación de fechas
            $('#fecha-inicio-filtro, #fecha-fin-filtro').on('change', function() {
                validarRangoFechas();
            });
            
            // Cargar estructura de columnas primero
            cargarEstructuraTabla().then(function() {
                return cargarEjecutivos();
            }).then(function() {
                inicializarTabla();
                cargarCitas();
                // Aplicar filtros desde URL después de cargar todo
                aplicarFiltrosDesdeURL();
            }).catch(function(error) {
                console.error('Error en inicialización:', error);
                alert('Error al inicializar la aplicación: ' + error);
            });
        });
        
        // Función para validar rango de fechas
        function validarRangoFechas() {
            var fechaInicio = $('#fecha-inicio-filtro').val();
            var fechaFin = $('#fecha-fin-filtro').val();
            
            if (fechaInicio && fechaFin) {
                var inicio = new Date(fechaInicio);
                var fin = new Date(fechaFin);
                
                if (inicio > fin) {
                    alert('La fecha de inicio no puede ser mayor que la fecha de fin');
                    $('#fecha-inicio-filtro').val('');
                    return false;
                }
            }
            return true;
        }
        
        // =====================================
        // FUNCIONES DE CONFIGURACIÓN
        // =====================================
        
        function cargarEstructuraTabla() {
            return new Promise(function(resolve, reject) {
                $.ajax({
                    url: 'server/controlador_citas.php',
                    type: 'POST',
                    data: { action: 'obtener_estructura_tabla' },
                    dataType: 'json',
                    success: function(response) {
                        if(response.success) {
                            columnasConfig = response.data;
                            console.log('Estructura de tabla cargada:', columnasConfig);
                            resolve();
                        } else {
                            reject('Error al cargar estructura de tabla: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        reject('Error de conexión al cargar estructura: ' + error);
                    }
                });
            });
        }
        
        function generarHeaders() {
            return columnasConfig.map(function(col) { return col.header; });
        }
        
        function generarColumnas() {
            return columnasConfig.map(function(col) {
                var columna = {
                    type: col.type,
                    width: col.width || 120
                };
                
                if (col.readOnly) columna.readOnly = col.readOnly;
                if (col.className) columna.className = col.className;
                if (col.dateFormat) columna.dateFormat = col.dateFormat;
                if (col.timeFormat) columna.timeFormat = col.timeFormat;
                if (col.type === 'dropdown') {
                    columna.source = col.key === 'id_eje2' ? ejecutivosDropdown : col.source;
                    columna.strict = false;
                }
                
                return columna;
            });
        }
        
        function obtenerCampo(columnIndex) {
            return columnasConfig[columnIndex] ? columnasConfig[columnIndex].key : null;
        }
        
        function obtenerIndiceColumna(campo) {
            for (var i = 0; i < columnasConfig.length; i++) {
                if (columnasConfig[i].key === campo) return i;
            }
            return -1;
        }
        
        // =====================================
        // FUNCIONES DE EJECUTIVOS
        // =====================================
        
        function cargarEjecutivos() {
            return new Promise(function(resolve, reject) {
                $.ajax({
                    url: 'server/controlador_citas.php',
                    type: 'POST',
                    data: { action: 'obtener_ejecutivos' },
                    dataType: 'json',
                    success: function(response) {
                        if(response.success) {
                            ejecutivos = response.data;
                            ejecutivosDropdown = response.data.map(function(eje) {
                                return eje.nom_eje;
                            });
                            
                            // Actualizar configuración de columna dropdown
                            var colEjecutivo = columnasConfig.find(function(col) { return col.key === 'id_eje2'; });
                            if (colEjecutivo) {
                                colEjecutivo.source = ejecutivosDropdown;
                            }
                            
                            // Poblar el dropdown del filtro de ejecutivos
                            var selectEjecutivo = $('#ejecutivo-filtro');
                            selectEjecutivo.empty();
                            selectEjecutivo.append('<option value="">Todos los ejecutivos</option>');
                            
                            ejecutivos.forEach(function(ejecutivo) {
                                selectEjecutivo.append('<option value="' + ejecutivo.id_eje + '">' + 
                                    ejecutivo.nom_eje + '</option>');
                            });
                            
                            console.log('Ejecutivos cargados:', ejecutivos);
                            
                            // Cargar planteles para el filtro
                            cargarPlanteles().then(function() {
                                resolve();
                            }).catch(function(error) {
                                reject(error);
                            });
                        } else {
                            reject('Error al cargar ejecutivos');
                        }
                    },
                    error: function() {
                        reject('Error de conexión');
                    }
                });
            });
        }
        
        function cargarPlanteles() {
            return new Promise(function(resolve, reject) {
                $.ajax({
                    url: 'server/controlador_ejecutivos.php',
                    type: 'POST',
                    data: { action: 'obtener_planteles' },
                    dataType: 'json',
                    success: function(response) {
                        if(response.success) {
                            var planteles = response.data;
                            
                            // Poblar el dropdown del filtro de planteles
                            var selectPlantel = $('#plantel-filtro');
                            selectPlantel.empty();
                            selectPlantel.append('<option value="">Todos los planteles</option>');
                            
                            planteles.forEach(function(plantel) {
                                selectPlantel.append('<option value="' + plantel.id_pla + '">' + 
                                    plantel.nom_pla + '</option>');
                            });
                            
                            console.log('Planteles cargados:', planteles);
                            resolve();
                        } else {
                            reject('Error al cargar planteles');
                        }
                    },
                    error: function() {
                        reject('Error de conexión al cargar planteles');
                    }
                });
            });
        }
        
        function obtenerIdEjecutivo(nombreEjecutivo) {
            var ejecutivo = ejecutivos.find(function(eje) {
                return eje.nom_eje === nombreEjecutivo;
            });
            return ejecutivo ? ejecutivo.id_eje : null;
        }
        
        function obtenerNombreEjecutivo(idEjecutivo) {
            var ejecutivo = ejecutivos.find(function(eje) {
                return eje.id_eje == idEjecutivo;
            });
            return ejecutivo ? ejecutivo.nom_eje : '';
        }

        // =====================================
        // TABLA DINÁMICA
        // =====================================
        
        function inicializarTabla() {
            console.log('Inicializando tabla Handsontable...');
            console.log('Configuración de columnas:', columnasConfig);
            
            var container = document.getElementById('tabla-citas');
            var datosBase = generarHorariosFijos();
            
            hot = new Handsontable(container, {
                data: datosBase,
                colHeaders: generarHeaders(),
                columns: generarColumnas(),
                rowHeaders: true,
                height: 600,
                licenseKey: 'non-commercial-and-evaluation',
                contextMenu: {
                    items: {
                        'row_above': {
                            name: 'Insertar fila arriba'
                        },
                        'row_below': {
                            name: 'Insertar fila abajo'
                        },
                        'sep1': '---------',
                        'ver_historial': {
                            name: 'Ver historial',
                            callback: function(key, selection, clickEvent) {
                                verHistorialCita(selection);
                            },
                            disabled: function() {
                                // Habilitar solo si hay una cita en la fila seleccionada
                                var selected = hot.getSelected();
                                if (selected && selected.length > 0) {
                                    var row = selected[0][0];
                                    var data = hot.getDataAtRow(row);
                                    var idCitIndex = obtenerIndiceColumna('id_cit');
                                    return !data || !data[idCitIndex] || data[idCitIndex] === '';
                                }
                                return true;
                            }
                        },
                        'eliminar_cita': {
                            name: 'Eliminar cita',
                            callback: function(key, selection, clickEvent) {
                                eliminarCitaSeleccionada(selection);
                            },
                            disabled: function() {
                                // Habilitar solo si hay una cita en la fila seleccionada
                                var selected = hot.getSelected();
                                if (selected && selected.length > 0) {
                                    var row = selected[0][0];
                                    var data = hot.getDataAtRow(row);
                                    var idCitIndex = obtenerIndiceColumna('id_cit');
                                    return !data || !data[idCitIndex] || data[idCitIndex] === '';
                                }
                                return true;
                            }
                        },
                        'sep2': '---------',
                        'undo': {
                            name: 'Deshacer'
                        },
                        'redo': {
                            name: 'Rehacer'
                        }
                    }
                },
                stretchH: 'all',
                
                // Evento para manejar cambios
                afterChange: function(changes, source) {
                    if (changes && source !== 'loadData') {
                        changes.forEach(function([row, prop, oldValue, newValue]) {
                            if (newValue !== oldValue && prop > 0) {
                                manejarCambioEnFila(row, prop, newValue, oldValue);
                            }
                        });
                    }
                },
                
                // Evento cuando se selecciona una celda diferente
                afterSelection: function(row, column, row2, column2, preventScrolling, selectionLayerLevel) {
                    if (filaEditandose !== null && filaEditandose !== row) {
                        // El usuario cambió de fila, guardar cambios pendientes
                        guardarCambiosPendientes();
                    }
                },
                
                // Evento antes de perder el foco
                beforeOnCellMouseDown: function(event, coords, TD) {
                    if (filaEditandose !== null && filaEditandose !== coords.row) {
                        // El usuario hizo clic en otra fila, guardar cambios pendientes
                        guardarCambiosPendientes();
                    }
                },
                
                // Evento antes de validación
                beforeChange: function(changes, source) {
                    if (source === 'edit') {
                        changes.forEach(function([row, prop, oldValue, newValue]) {
                            var campo = obtenerCampo(prop);
                            if (campo === 'id_eje2' && newValue) {
                                var idEjecutivo = obtenerIdEjecutivo(newValue);
                                if (idEjecutivo) {
                                    changes[0][3] = idEjecutivo;
                                }
                            }
                        });
                    }
                },
                
                // Evento antes de eliminar fila - capturar IDs de citas
                beforeRemoveRow: function(index, amount, physicalRows, source) {
                    if (source !== 'loadData') {
                        var idCitIndex = obtenerIndiceColumna('id_cit');
                        var citasAEliminar = [];
                        
                        // Capturar los IDs de las citas antes de que se eliminen
                        physicalRows.forEach(function(rowIndex) {
                            var rowData = hot.getSourceDataAtRow(rowIndex);
                            if (rowData && rowData[idCitIndex]) {
                                citasAEliminar.push(rowData[idCitIndex]);
                                console.log('BEFORE REMOVE ROW: Capturando cita con ID:', rowData[idCitIndex]);
                            }
                        });
                        
                        // Guardar los IDs para procesarlos después
                        hot._citasAEliminar = citasAEliminar;
                    }
                },
                
                // Evento después de eliminar fila - eliminar de base de datos
                afterRemoveRow: function(index, amount, physicalRows, source) {
                    if (source !== 'loadData' && hot._citasAEliminar) {
                        // Procesar las citas capturadas en beforeRemoveRow
                        hot._citasAEliminar.forEach(function(id_cit) {
                            console.log('AFTER REMOVE ROW: Eliminando cita con ID:', id_cit);
                            eliminarCitaBaseDatos(id_cit);
                        });
                        
                        // Limpiar la variable temporal
                        delete hot._citasAEliminar;
                    }
                },
                
                // Renderer personalizado para grupos de horarios
                afterRenderer: function(TD, row, col, prop, value, cellProperties) {
                    var campo = obtenerCampo(col);
                    
                    // Renderer para ejecutivos
                    if (campo === 'id_eje2' && value) {
                        var nombreEjecutivo = obtenerNombreEjecutivo(value);
                        if (nombreEjecutivo) {
                            TD.innerHTML = nombreEjecutivo;
                        }
                    }
                    
                    // Estilo para filas de grupo horario
                    var esInicioGrupo = row % citasPorRango === 0;
                    if (esInicioGrupo && col === 0) {
                        TD.style.borderTop = '3px solid #007bff';
                        TD.style.fontWeight = 'bold';
                    }
                    
                    // Resaltar celdas vacías reservadas
                    var posicionEnGrupo = row % citasPorRango;
                    if (posicionEnGrupo >= 2 && !value && col > 0) {
                        TD.style.backgroundColor = '#ffffff';
                        TD.style.border = '1px dashed #cccccc';
                    }
                }
            });
        }

        function agregarNuevaColumna(){
            // Esta función ahora se llama desde el modal
            mostrarModalNuevaColumna();
        }
        
        function mostrarModalNuevaColumna() {
            $('#modalNuevaColumna').modal('show');
        }
        
        function crearNuevaColumna() {
            var nombreColumna = $('#nombreColumna').val().trim();
            var tipoColumna = $('#tipoColumna').val();
            
            if (!nombreColumna) {
                alert('Por favor ingrese un nombre para la columna');
                return;
            }
            
            // Validar formato del nombre
            if (!/^[a-zA-Z][a-zA-Z0-9_]*$/.test(nombreColumna)) {
                alert('El nombre de la columna debe comenzar con una letra y contener solo letras, números y guiones bajos');
                return;
            }
            
            // Verificar que no exista ya
            var existeColumna = columnasConfig.some(function(col) {
                return col.key === nombreColumna;
            });
            
            if (existeColumna) {
                alert('Ya existe una columna con ese nombre');
                return;
            }
            
            $.ajax({
                url: 'server/controlador_citas.php',
                type: 'POST',
                data: {
                    action: 'crear_nueva_columna',
                    nombre_columna: nombreColumna,
                    tipo_columna: tipoColumna
                },
                dataType: 'json',
                success: function(response) {
                    if(response.success) {
                        alert('Columna creada correctamente: ' + response.data.nombre_columna);
                        $('#modalNuevaColumna').modal('hide');
                        $('#nombreColumna').val('');
                        $('#tipoColumna').val('VARCHAR(100)');
                        
                        // Recargar estructura y tabla
                        recargarEstructura();
                    } else {
                        alert('Error al crear columna: ' + response.message);
                    }
                },
                error: function() {
                    alert('Error de conexión al crear columna');
                }
            });
        }
        
        function recargarEstructura() {
            console.log('Recargando estructura de tabla...');
            cargarEstructuraTabla().then(function() {
                console.log('Estructura recargada, reinicializando tabla...');
                // Reinicializar tabla con nueva estructura
                if (hot) {
                    hot.destroy();
                }
                inicializarTabla();
                cargarCitas();
            }).catch(function(error) {
                console.error('Error al recargar estructura:', error);
                alert('Error al recargar estructura: ' + error);
            });
        }
        
        function actualizarConfiguracionTabla() {
            // Actualizar headers
            hot.updateSettings({
                colHeaders: generarHeaders(),
                columns: generarColumnas()
            });
        }
        
        function generarHorariosFijos() {
            var horarios = [];
            for (var h = 8; h <= 20; h++) {
                var inicio = h < 10 ? '0' + h + ':00' : h + ':00';
                var fin = (h + 1) < 10 ? '0' + (h + 1) + ':00' : (h + 1) + ':00';
                var rango = inicio + ' - ' + fin;
                
                // Crear múltiples filas para cada rango horario
                for (var i = 0; i < citasPorRango; i++) {
                    var fila = new Array(columnasConfig.length).fill('');
                    // Solo mostrar el rango en la primera fila de cada grupo
                    fila[0] = i === 0 ? rango : '';
                    horarios.push(fila);
                }
            }
            return horarios;
        }
        
        function manejarCambioEnFila(row, column, newValue, oldValue) {
            var campo = obtenerCampo(column);
            var idCitIndex = obtenerIndiceColumna('id_cit');
            var id_cit = hot.getDataAtCell(row, idCitIndex);
            
            // Establecer la fila que se está editando
            if (filaEditandose === null || filaEditandose !== row) {
                filaEditandose = row;
                datosPendientes = {}; // Limpiar datos pendientes al cambiar de fila
            }
            
            // Guardar el cambio en los datos pendientes
            datosPendientes[campo] = newValue;
            
            console.log('Cambio detectado en fila', row, '- Campo:', campo, '- Valor:', newValue);
            console.log('Datos pendientes para fila', row, ':', datosPendientes);
        }
        
        function guardarCambiosPendientes() {
            if (filaEditandose === null || Object.keys(datosPendientes).length === 0) {
                return;
            }
            
            var idCitIndex = obtenerIndiceColumna('id_cit');
            var id_cit = hot.getDataAtCell(filaEditandose, idCitIndex);
            
            console.log('Guardando cambios pendientes para fila', filaEditandose, '- ID:', id_cit);
            console.log('Datos a guardar:', datosPendientes);
            
            if (!id_cit) {
                // Nueva cita - crear con todos los datos pendientes
                crearNuevaCitaCompleta(filaEditandose, datosPendientes);
            } else {
                // Cita existente - actualizar campos modificados
                actualizarCitaCompleta(filaEditandose, id_cit, datosPendientes);
            }
            
            // Limpiar estado
            filaEditandose = null;
            datosPendientes = {};
        }
        
        function obtenerRangoHorario(fila) {
            // Calcular el rango horario basado en la fila
            var grupoHorario = Math.floor(fila / citasPorRango);
            var hora = grupoHorario + 8;
            
            if (hora >= 8 && hora <= 20) {
                var inicio = hora < 10 ? '0' + hora + ':00' : hora + ':00';
                var fin = (hora + 1) < 10 ? '0' + (hora + 1) + ':00' : (hora + 1) + ':00';
                return inicio + ' - ' + fin;
            }
            return '';
        }
        
        function crearNuevaCitaCompleta(row, datosPendientes) {
            // Recopilar datos de la fila para crear nueva cita
            var rowData = hot.getDataAtRow(row);
            
            // Usar fecha del filtro como valor por defecto si no hay fecha especificada
            var fechaIndex = obtenerIndiceColumna('cit_cit');
            var fecha = datosPendientes['cit_cit'] || rowData[fechaIndex] || $('#fecha-filtro').val() || new Date().toISOString().split('T')[0];
            
            // Generar hora basada en el rango horario si no se especifica
            var horaIndex = obtenerIndiceColumna('hor_cit');
            var hora = datosPendientes['hor_cit'] || rowData[horaIndex];
            if (!hora) {
                var rangoHorario = obtenerRangoHorario(row);
                if (rangoHorario) {
                    hora = rangoHorario.split(' - ')[0] + ':00';
                } else {
                    hora = '09:00:00';
                }
            }
            
            // Asegurar que la hora tenga el formato correcto
            if (hora && hora.length <= 5) {
                hora = hora + ':00';
            }
            
            // Preparar datos dinámicamente basado en la configuración de columnas
            var datos = { action: 'guardar_cita' };
            
            // Combinar datos pendientes con datos de la fila
            columnasConfig.forEach(function(col, index) {
                if (col.key !== 'horario' && col.key !== 'nom_eje') { // Excluir columnas virtuales
                    var valor = datosPendientes[col.key] || rowData[index] || '';
                    
                    // Solo agregar valores no vacíos para permitir NULL en la BD
                    if (valor !== '') {
                        datos[col.key] = valor;
                    }
                }
            });
            
            // Siempre incluir fecha y hora por defecto para evitar problemas
            datos['cit_cit'] = fecha;
            datos['hor_cit'] = hora;
            
            // Validar que al menos haya algún dato significativo para crear la cita
            if (!datos.nom_cit && !datos.tel_cit && !datos.id_eje2) {
                console.log('No hay datos suficientes para crear la cita');
                return;
            }
            
            console.log('Enviando datos para nueva cita completa:', datos);
            
            $.ajax({
                url: 'server/controlador_citas.php',
                type: 'POST',
                data: datos,
                dataType: 'json',
                success: function(response) {
                    console.log('Respuesta del servidor:', response);
                    if(response.success) {
                        // Actualizar el ID en la tabla
                        var idCitIndex = obtenerIndiceColumna('id_cit');
                        hot.setDataAtCell(row, idCitIndex, response.data.id);
                        console.log('Nueva cita creada con ID:', response.data.id);
                    } else {
                        alert('Error al crear cita: ' + response.message);
                        cargarCitas();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error AJAX:', {
                        status: status,
                        error: error,
                        responseText: xhr.responseText
                    });
                    alert('Error de conexión al crear cita. Revise la consola para más detalles.');
                    cargarCitas();
                }
            });
        }
        
        function actualizarCitaCompleta(row, id_cit, datosPendientes) {
            // Actualizar todos los campos modificados de una vez
            var actualizaciones = [];
            
            Object.keys(datosPendientes).forEach(function(campo) {
                var valor = datosPendientes[campo];
                actualizaciones.push({
                    campo: campo,
                    valor: valor
                });
            });
            
            if (actualizaciones.length === 0) {
                return;
            }
            
            console.log('Actualizando cita', id_cit, 'con cambios:', actualizaciones);
            
            // Procesar actualizaciones una por una
            var procesarActualizacion = function(index) {
                if (index >= actualizaciones.length) {
                    console.log('Todas las actualizaciones completadas');
                    return;
                }
                
                var update = actualizaciones[index];
                
                $.ajax({
                    url: 'server/controlador_citas.php',
                    type: 'POST',
                    data: {
                        action: 'actualizar_cita',
                        campo: update.campo,
                        valor: update.valor,
                        id_cit: id_cit
                    },
                    dataType: 'json',
                    success: function(response) {
                        if(response.success) {
                            console.log('Campo', update.campo, 'actualizado correctamente');
                            // Procesar siguiente actualización
                            procesarActualizacion(index + 1);
                        } else {
                            alert('Error al actualizar campo ' + update.campo + ': ' + response.message);
                            cargarCitas();
                        }
                    },
                    error: function() {
                        alert('Error de conexión al actualizar campo ' + update.campo);
                        cargarCitas();
                    }
                });
            };
            
            // Iniciar proceso de actualizaciones
            procesarActualizacion(0);
        }
        
        function cargarConfiguracionColumnas() {
            return new Promise(function(resolve, reject) {
                // Cargar columnas dinámicas desde la base de datos
                $.ajax({
                    url: 'server/controlador_citas.php',
                    type: 'POST',
                    data: { action: 'obtener_columnas_dinamicas' },
                    dataType: 'json',
                    success: function(response) {
                        if(response.success && response.data) {
                            response.data.forEach(function(columna) {
                                var nuevaColumna = {
                                    key: columna.nombre,
                                    header: columna.nombre.replace('col_dinamica_', 'Columna ').replace(/_\d+_\d+$/, ''),
                                    type: 'text',
                                    width: 150
                                };
                                columnasConfig.push(nuevaColumna);
                            });
                            console.log('Columnas dinámicas cargadas desde BD:', response.data);
                        }
                        resolve();
                    },
                    error: function() {
                        console.error('Error al cargar columnas dinámicas desde BD');
                        resolve(); // No fallar la inicialización
                    }
                });
            });
        }
        
        function eliminarCitaBaseDatos(id_cit) {
            if (!id_cit) {
                console.log('No hay ID de cita para eliminar');
                return;
            }
            
            console.log('Eliminando cita con ID:', id_cit);
            $.ajax({
                url: 'server/controlador_citas.php',
                type: 'POST',
                data: {
                    action: 'eliminar_cita',
                    id_cit: id_cit
                },
                dataType: 'json',
                success: function(response) {
                    console.log('Respuesta del servidor:', response);
                    if(response.success) {
                        console.log('Cita eliminada correctamente de la base de datos');
                        // Recargar inmediatamente para actualizar la vista
                        if (modoFiltroFecha) {
                            cargarCitas();
                        } else {
                            buscarCitas();
                        }
                    } else {
                        console.error('Error al eliminar cita:', response.message);
                        alert('Error al eliminar cita: ' + response.message);
                        cargarCitas();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error AJAX:', {
                        status: status,
                        error: error,
                        responseText: xhr.responseText
                    });
                    alert('Error de conexión al eliminar cita');
                    cargarCitas();
                }
            });
        }
        
        // =====================================
        // CARGA Y BÚSQUEDA DE DATOS
        // =====================================
        
        function cargarCitas() {
            // Validar rango de fechas antes de continuar
            if (!validarRangoFechas()) {
                return;
            }
            
            modoFiltroFecha = true;
            var fechaInicio = $('#fecha-inicio-filtro').val();
            var fechaFin = $('#fecha-fin-filtro').val();
            var idEjecutivo = $('#ejecutivo-filtro').val();
            var idPlantel = $('#plantel-filtro').val();
            var incluirPlanteles = $('#planteles-asociados-filtro').is(':checked');
            
            var datos = { 
                action: 'obtener_citas'
            };
            
            // Agregar filtros de fecha si están presentes
            if (fechaInicio) {
                datos.fecha_inicio = fechaInicio;
            }
            if (fechaFin) {
                datos.fecha_fin = fechaFin;
            }
            
            if (idEjecutivo) {
                datos.id_ejecutivo = idEjecutivo;
                datos.incluir_planteles_asociados = incluirPlanteles ? 'true' : 'false';
            }
            
            if (idPlantel) {
                datos.id_plantel = idPlantel;
            }
            
            console.log('=== DEBUG CARGAR CITAS ===');
            console.log('Fecha inicio:', fechaInicio);
            console.log('Fecha fin:', fechaFin);
            console.log('ID Ejecutivo:', idEjecutivo);
            console.log('ID Plantel:', idPlantel);
            console.log('Incluir planteles:', incluirPlanteles);
            console.log('Datos enviados:', datos);
            console.log('========================');
            
            $.ajax({
                url: 'server/controlador_citas.php',
                type: 'POST',
                data: datos,
                dataType: 'json',
                success: function(response) {
                    if(response.success) {
                        console.log('Citas cargadas:', response.data.length, 'registros');
                        // Mostrar algunas citas para debug
                        if (response.data.length > 0) {
                            console.log('Primeras 3 citas:', response.data.slice(0, 3));
                        }
                        mostrarCitasEnTabla(response.data, true);
                        actualizarInfoFiltroActivo();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al cargar citas:', error);
                    alert('Error de conexión al servidor: ' + error);
                }
            });
        }
        
        function actualizarInfoFiltroActivo() {
            var filtros = [];
            var fechaInicio = $('#fecha-inicio-filtro').val();
            var fechaFin = $('#fecha-fin-filtro').val();
            var idEjecutivo = $('#ejecutivo-filtro').val();
            var idPlantel = $('#plantel-filtro').val();
            var incluirPlanteles = $('#planteles-asociados-filtro').is(':checked');
            
            if (fechaInicio && fechaFin) {
                filtros.push('📅 Fechas: ' + fechaInicio + ' a ' + fechaFin);
            } else if (fechaInicio) {
                filtros.push('📅 Desde: ' + fechaInicio);
            } else if (fechaFin) {
                filtros.push('📅 Hasta: ' + fechaFin);
            }
            
            if (idEjecutivo) {
                var nombreEjecutivo = $('#ejecutivo-filtro option:selected').text();
                filtros.push('👤 Ejecutivo: ' + nombreEjecutivo);
                
                if (incluirPlanteles) {
                    filtros.push('🕋 Incluyendo planteles asociados');
                }
            }
            
            if (idPlantel) {
                var nombrePlantel = $('#plantel-filtro option:selected').text();
                filtros.push('🏢 Plantel: ' + nombrePlantel);
            }
            
            if (filtros.length > 0) {
                $('#detalle-filtros').text(filtros.join(' | '));
                $('#info-filtro-activo').show();
            } else {
                $('#info-filtro-activo').hide();
            }
        }
        
        function aplicarFiltroRapido(tipo) {
            var fechaHoy = new Date();
            var fechaInicio, fechaFin;
            
            switch(tipo) {
                case 'hoy':
                    fechaInicio = fechaFin = fechaHoy.toISOString().split('T')[0];
                    break;
                    
                case 'semana':
                    // Inicio de la semana (lunes)
                    var inicioSemana = new Date(fechaHoy);
                    inicioSemana.setDate(fechaHoy.getDate() - fechaHoy.getDay() + 1);
                    fechaInicio = inicioSemana.toISOString().split('T')[0];
                    fechaFin = fechaHoy.toISOString().split('T')[0];
                    break;
                    
                case 'mes':
                    // Inicio del mes actual
                    var inicioMes = new Date(fechaHoy.getFullYear(), fechaHoy.getMonth(), 1);
                    fechaInicio = inicioMes.toISOString().split('T')[0];
                    fechaFin = fechaHoy.toISOString().split('T')[0];
                    break;
                    
                case 'ultimos7':
                    var hace7Dias = new Date(fechaHoy);
                    hace7Dias.setDate(fechaHoy.getDate() - 7);
                    fechaInicio = hace7Dias.toISOString().split('T')[0];
                    fechaFin = fechaHoy.toISOString().split('T')[0];
                    break;
                    
                case 'ultimos30':
                    var hace30Dias = new Date(fechaHoy);
                    hace30Dias.setDate(fechaHoy.getDate() - 30);
                    fechaInicio = hace30Dias.toISOString().split('T')[0];
                    fechaFin = fechaHoy.toISOString().split('T')[0];
                    break;
            }
            
            $('#fecha-inicio-filtro').val(fechaInicio);
            $('#fecha-fin-filtro').val(fechaFin);
            cargarCitas();
        }
        
        function buscarCitas() {
            var termino = $('#buscador-citas').val().trim();
            if (!termino) {
                //alert('Ingrese un término de búsqueda');
                limpiarBusqueda();
                return;
            }
            
            modoFiltroFecha = false;
            
            $.ajax({
                url: 'server/controlador_citas.php',
                type: 'POST',
                data: { 
                    action: 'obtener_citas'
                    // Sin fecha_filtro para obtener todas las citas
                },
                dataType: 'json',
                success: function(response) {
                    if(response.success) {
                        // Filtrar localmente por el término de búsqueda
                        var citasFiltradas = response.data.filter(function(cita) {
                            return (cita.nom_cit && cita.nom_cit.toLowerCase().includes(termino.toLowerCase())) ||
                                   (cita.tel_cit && cita.tel_cit.includes(termino)) ||
                                   (cita.nom_eje && cita.nom_eje.toLowerCase().includes(termino.toLowerCase()));
                        });
                        
                        mostrarCitasEnTabla(citasFiltradas, false);
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function() {
                    alert('Error de conexión al servidor');
                }
            });
        }
        
        function limpiarBusqueda() {
            $('#buscador-citas').val('');
            cargarCitas();
        }
        
        function limpiarFiltros() {
            // Configurar fechas por defecto (última semana)
            var fechaHoy = new Date();
            var fechaFin = fechaHoy.toISOString().split('T')[0];
            var fechaInicioDate = new Date(fechaHoy);
            fechaInicioDate.setDate(fechaInicioDate.getDate() - 7); // Una semana atrás
            var fechaInicio = fechaInicioDate.toISOString().split('T')[0];
            
            $('#fecha-inicio-filtro').val(fechaInicio);
            $('#fecha-fin-filtro').val(fechaFin);
            $('#ejecutivo-filtro').val('');
            $('#plantel-filtro').val('');
            $('#planteles-asociados-filtro').prop('checked', false);
            
            // Limpiar mensaje de navegación
            $('#mensajeNavegacion').html('');
            
            // Ocultar información del filtro activo
            $('#info-filtro-activo').hide();
            
            cargarCitas();
        }
        
        function mostrarCitasEnTabla(citas, usarHorariosFijos) {
            var datos;
            
            if (usarHorariosFijos) {
                // Modo normal con horarios fijos expandidos
                datos = generarHorariosFijos();
                
                // Agrupar citas por hora para distribución
                var citasPorHora = {};
                citas.forEach(function(cita) {
                    var hora = parseInt(cita.hor_cit.split(':')[0]);
                    if (!citasPorHora[hora]) {
                        citasPorHora[hora] = [];
                    }
                    citasPorHora[hora].push(cita);
                });
                
                // Distribuir citas en las filas correspondientes
                Object.keys(citasPorHora).forEach(function(hora) {
                    var horaNum = parseInt(hora);
                    var indiceGrupoInicio = (horaNum - 8) * citasPorRango;
                    
                    if (indiceGrupoInicio >= 0 && indiceGrupoInicio < datos.length) {
                        citasPorHora[hora].forEach(function(cita, index) {
                            var indiceFila = indiceGrupoInicio + index;
                            if (indiceFila < datos.length) {
                                // Mantener el rango de horario solo en la primera fila del grupo
                                var rangoHorario = datos[indiceFila][0];
                                datos[indiceFila] = mapearCitaAFila(cita, rangoHorario);
                            }
                        });
                    }
                });
            } else {
                // Modo búsqueda - mostrar solo resultados
                datos = citas.map(function(cita) {
                    return mapearCitaAFila(cita, '');
                });
            }
            
            hot.loadData(datos);
        }
        
        function mapearCitaAFila(cita, horario) {
            var fila = new Array(columnasConfig.length).fill('');
            
            columnasConfig.forEach(function(col, index) {
                if (col.key === 'horario') {
                    fila[index] = horario;
                } else if (cita.hasOwnProperty(col.key)) {
                    // Mapear directamente desde los datos de la cita
                    fila[index] = cita[col.key] || '';
                }
            });
            
            return fila;
        }
        
        // =====================================
        // FUNCIONES DE HISTORIAL
        // =====================================
        
        function verHistorialCita(selection) {
            if (!selection || selection.length === 0) {
                alert('Por favor selecciona una fila para ver el historial');
                return;
            }
            
            var row = selection[0].start.row;
            var data = hot.getDataAtRow(row);
            var idCitIndex = obtenerIndiceColumna('id_cit');
            var nombreIndex = obtenerIndiceColumna('nom_cit');
            
            if (!data || !data[idCitIndex] || data[idCitIndex] === '') {
                alert('No hay una cita en esta fila para ver el historial');
                return;
            }
            
            var idCit = data[idCitIndex];
            var nombreCita = data[nombreIndex] || 'Sin nombre';
            
            // Mostrar información de la cita
            $('#idCitaHistorial').text(idCit);
            $('#nombreCitaHistorial').text(nombreCita);
            
            // Cargar historial
            cargarHistorialCita(idCit);
            
            // Mostrar modal
            $('#modalHistorialCita').modal('show');
        }
        
        function cargarHistorialCita(idCit) {
            $.ajax({
                url: 'server/controlador_citas.php',
                type: 'POST',
                data: {
                    action: 'obtener_historial_cita',
                    id_cit: idCit
                },
                dataType: 'json',
                success: function(response) {
                    if(response.success) {
                        mostrarHistorialEnTabla(response.data);
                    } else {
                        alert('Error al cargar historial: ' + response.message);
                    }
                },
                error: function() {
                    alert('Error de conexión al cargar historial');
                }
            });
        }
        
        function mostrarHistorialEnTabla(historial) {
            var tbody = $('#tablaHistorialCita');
            tbody.empty();
            
            if (!historial || historial.length === 0) {
                $('#sinHistorial').show();
                return;
            }
            
            $('#sinHistorial').hide();
            
            historial.forEach(function(registro) {
                var fecha = new Date(registro.fec_his_cit);
                var fechaFormateada = fecha.toLocaleString('es-ES', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
                
                var movimientoClass = '';
                var movimientoIcon = '';
                
                switch(registro.mov_his_cit) {
                    case 'alta':
                        movimientoClass = 'badge-success';
                        movimientoIcon = '➕';
                        break;
                    case 'cambio':
                        movimientoClass = 'badge-warning';
                        movimientoIcon = '✏️';
                        break;
                    case 'baja':
                        movimientoClass = 'badge-danger';
                        movimientoIcon = '🗑️';
                        break;
                }
                
                var fila = `
                    <tr>
                        <td style="white-space: nowrap;">${fechaFormateada}</td>
                        <td>${registro.res_his_cit}</td>
                        <td>
                            <span class="badge ${movimientoClass}">
                                ${movimientoIcon} ${registro.mov_his_cit.toUpperCase()}
                            </span>
                        </td>
                        <td>${registro.des_his_cit}</td>
                    </tr>
                `;
                
                tbody.append(fila);
            });
        }
        
        // =====================================
        // FUNCIONES DE ELIMINACIÓN
        // =====================================
        
        function eliminarCitaSeleccionada(selection) {
            if (!selection || selection.length === 0) {
                alert('Por favor selecciona una fila para eliminar');
                return;
            }
            
            var row = selection[0].start.row;
            var data = hot.getDataAtRow(row);
            var idCitIndex = obtenerIndiceColumna('id_cit');
            
            if (!data || !data[idCitIndex] || data[idCitIndex] === '') {
                alert('No hay una cita en esta fila para eliminar');
                return;
            }
            
            var idCit = data[idCitIndex];
            var nombreIndex = obtenerIndiceColumna('nom_cit');
            var nombreCita = data[nombreIndex] || 'Sin nombre';
            
            console.log('Eliminando cita:', {id: idCit, nombre: nombreCita});
            
            // Eliminar directamente sin confirmación
            eliminarCitaBaseDatos(idCit);
            // Remover la fila visualmente después de la eliminación exitosa
            setTimeout(function() {
                cargarCitas(); // Recargar datos para actualizar la vista
            }, 500);
        }
        
        // =====================================
        // FUNCIONES DE UTILIDAD
        // =====================================
        
        function obtenerParametrosURL() {
            var params = {};
            var queryString = window.location.search.substring(1);
            var vars = queryString.split('&');
            
            for (var i = 0; i < vars.length; i++) {
                var pair = vars[i].split('=');
                if (pair.length === 2) {
                    params[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1]);
                }
            }
            return params;
        }
        
        function regresarAOrigen() {
            var params = obtenerParametrosURL();
            var url = '';
            
            if (params.origen === 'ejecutivos') {
                url = 'arbol_ejecutivos.php';
            } else if (params.origen === 'plantel') {
                url = 'arbol_planteles.php';
            } else {
                // Fallback al árbol de ejecutivos
                url = 'arbol_ejecutivos.php';
            }
            
            // Conservar los filtros de fecha para mantener la consistencia
            var queryString = '';
            if (params.fecha_inicio) {
                queryString += (queryString ? '&' : '') + 'fechaInicio=' + params.fecha_inicio;
            }
            if (params.fecha_fin) {
                queryString += (queryString ? '&' : '') + 'fechaFin=' + params.fecha_fin;
            }
            
            if (queryString) {
                url += '?' + queryString;
            }
            
            window.location.href = url;
        }
        
        function aplicarFiltrosDesdeURL() {
            var params = obtenerParametrosURL();
            
            console.log('=== DEBUG APLICAR FILTROS URL ===');
            console.log('Parámetros URL:', params);
            
            // Aplicar filtro de ejecutivo si existe
            if (params.ejecutivo) {
                $('#ejecutivo-filtro').val(params.ejecutivo);
                console.log('Ejecutivo seleccionado:', params.ejecutivo);
            }
            
            // Aplicar filtro de plantel si existe
            if (params.plantel) {
                $('#plantel-filtro').val(params.plantel);
                console.log('Plantel seleccionado:', params.plantel);
            }
            
            // Aplicar filtros de fecha si existen
            if (params.fecha_inicio) {
                $('#fecha-inicio-filtro').val(params.fecha_inicio);
                console.log('Fecha inicio:', params.fecha_inicio);
            }
            
            if (params.fecha_fin) {
                $('#fecha-fin-filtro').val(params.fecha_fin);
                console.log('Fecha fin:', params.fecha_fin);
            }
            
            // Manejar checkbox de planteles asociados según el tipo de conteo
            if (params.tipo_conteo === 'propias') {
                // Para citas propias, nunca incluir planteles asociados
                $('#planteles-asociados-filtro').prop('checked', false);
                console.log('Planteles asociados desactivado para citas propias');
            } else if (params.tipo_conteo === 'recursivas') {
                // Para citas recursivas, sí incluir planteles asociados
                $('#planteles-asociados-filtro').prop('checked', true);
                console.log('Planteles asociados activado para citas recursivas');
            } else if (params.incluir_planteles === 'true') {
                $('#planteles-asociados-filtro').prop('checked', true);
                console.log('Planteles asociados activado');
            } else {
                $('#planteles-asociados-filtro').prop('checked', false);
            }
            
            // Mostrar mensaje específico según el origen y tipo
            if (params.origen === 'plantel' || params.origen === 'ejecutivos') {
                var mensaje = '';
                var fechaTexto = '';
                
                // Generar texto de fechas si existen
                if (params.fecha_inicio && params.fecha_fin) {
                    fechaTexto = ' del ' + params.fecha_inicio + ' al ' + params.fecha_fin;
                } else if (params.fecha_inicio) {
                    fechaTexto = ' desde ' + params.fecha_inicio;
                } else if (params.fecha_fin) {
                    fechaTexto = ' hasta ' + params.fecha_fin;
                }
                
                if (params.ejecutivo) {
                    if (params.tipo_conteo === 'propias') {
                        mensaje = '<div class="alert alert-info alert-dismissible fade show" role="alert">' +
                                '<i class="fas fa-user"></i> <strong>Navegación desde Árbol de Ejecutivos:</strong> ' +
                                'Mostrando <strong>citas propias</strong> del ejecutivo seleccionado' + fechaTexto + '.' +
                                '<button type="button" class="close" data-dismiss="alert">' +
                                '<span aria-hidden="true">&times;</span></button></div>';
                    } else if (params.tipo_conteo === 'recursivas') {
                        mensaje = '<div class="alert alert-info alert-dismissible fade show" role="alert">' +
                                '<i class="fas fa-users"></i> <strong>Navegación desde Árbol de Ejecutivos:</strong> ' +
                                'Mostrando <strong>citas recursivas</strong> (incluye descendientes) del ejecutivo seleccionado' + fechaTexto + '.' +
                                '<button type="button" class="close" data-dismiss="alert">' +
                                '<span aria-hidden="true">&times;</span></button></div>';
                    } else {
                        mensaje = '<div class="alert alert-info alert-dismissible fade show" role="alert">' +
                                '<i class="fas fa-user"></i> <strong>Navegación desde Árbol de Ejecutivos:</strong> ' +
                                'Mostrando todas las citas del ejecutivo seleccionado' + fechaTexto + '.' +
                                '<button type="button" class="close" data-dismiss="alert">' +
                                '<span aria-hidden="true">&times;</span></button></div>';
                    }
                }
                
                if (params.plantel) {
                    mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                            '<i class="fas fa-building"></i> <strong>Navegación desde Árbol de Planteles:</strong> ' +
                            'Mostrando <strong>citas totales</strong> del plantel seleccionado' + fechaTexto + '.' +
                            '<button type="button" class="close" data-dismiss="alert">' +
                            '<span aria-hidden="true">&times;</span></button></div>';
                }
                
                if (mensaje) {
                    $('#mensajeNavegacion').html(mensaje);
                }
                
                // Mostrar botón de regreso
                if (params.origen === 'ejecutivos') {
                    $('#textoRegreso').text('Regresar al Árbol de Ejecutivos');
                    $('#botonRegreso').show();
                } else if (params.origen === 'plantel') {
                    $('#textoRegreso').text('Regresar al Árbol de Planteles');
                    $('#botonRegreso').show();
                }
            }
            
            // Aplicar filtros automáticamente si se recibieron parámetros
            if (params.ejecutivo || params.plantel || params.fecha_inicio) {
                console.log('Aplicando filtros automáticamente...');
                cargarCitas();
                actualizarInfoFiltroActivo();
            }
        }
    </script>
</body>
</html>
