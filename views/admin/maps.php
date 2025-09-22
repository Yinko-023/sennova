<!-- Header -->
<div id="hdr" class="text-center mb-4">
  <div id="hdr-box" class="container">
    <h1 id="hdr-ttl">Sistema de Gestión de Solicitudes</h1>
    <p id="hdr-sub">Centro de Servicios Tecnológicos</p>
    <a id="hdr-pdf" href="inAdmin.php?vista=pdfs" class="mt-3">
      <i class="fa fa-file-pdf me-2"></i> Ver PDFs generados
    </a>
  </div>
</div>


<a id="pdf-fab" href="inAdmin.php?vista=pdfs" class="btn-fab" aria-label="Ver PDFs generados" title="Ver PDFs generados">
  <i class="fa-solid fa-file-pdf"></i>
</a>

<div class="container">
  <!-- Navegación por pestañas -->
  <ul class="nav nav-tabs justify-content-center" id="formTabs" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="form1-tab" data-bs-toggle="tab" data-bs-target="#form1" type="button"
        role="tab" aria-controls="form1" aria-selected="true">Formulario 1</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="form2-tab" data-bs-toggle="tab" data-bs-target="#form2" type="button"
        role="tab" aria-controls="form2" aria-selected="false">Formulario 2</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="form3-tab" data-bs-toggle="tab" data-bs-target="#form3" type="button"
        role="tab" aria-controls="form3" aria-selected="false">Formulario 3</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="form4-tab" data-bs-toggle="tab" data-bs-target="#form4" type="button"
        role="tab" aria-controls="form4" aria-selected="false">Formulario 4</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="form5-tab" data-bs-toggle="tab" data-bs-target="#form5" type="button"
        role="tab" aria-controls="form5" aria-selected="false">Formulario 5</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="form6-tab" data-bs-toggle="tab" data-bs-target="#form6" type="button"
        role="tab" aria-controls="form6" aria-selected="false">Formulario 6</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="form7-tab" data-bs-toggle="tab" data-bs-target="#form7" type="button"
        role="tab" aria-controls="form7" aria-selected="false">Formulario 7</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="form8-tab" data-bs-toggle="tab" data-bs-target="#form8" type="button"
        role="tab" aria-controls="form8" aria-selected="false">Formulario 8</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="form9-tab" data-bs-toggle="tab" data-bs-target="#form9" type="button"
        role="tab" aria-controls="form9" aria-selected="false">Formulario 9</button>
    </li>
  </ul>
  <div class="tab-content" id="formTabsContent">
    <!-- Formulario 1: Solicitud de servicio -->
    <div class="tab-pane fade show active" id="form1" role="tabpanel" aria-labelledby="form1-tab">
      <section class="card">
        <header>
          <h2>📋 Información del Proyecto</h2>
        </header>
        <div>
          <form id="form-solicitud" method="POST" action="routes/estres.php">
            <input type="hidden" name="form_action" value="solicitud">

            <div class="form-group">
              <label for="n_cliente">N° Cliente:</label>
              <input type="text" id="n_cliente" name="n_cliente" class="form-control">
            </div>

            <!-- ====== SOLICITUD VÍA ====== -->
            <div class="soli-h3">SOLICITUD VÍA</div>
            <div class="soli-wrap">
              <div class="soli-checks">
                <div class="soli-check-col">
                  <label><input type="checkbox" name="solicitud_via[]" value="Telefónica"> Telefónica</label>
                  <label><input type="checkbox" name="solicitud_via[]" value="Presencial"> Presencial</label>
                </div>
                <div class="soli-check-col">
                  <label><input type="checkbox" name="solicitud_via[]" value="Correo electrónico"> Correo electrónico</label>
                  <label>
                    <input type="checkbox" name="solicitud_via[]" value="Otro"> Otro
                    <input type="text" name="solicitud_via_otro" class="form-control" placeholder="Especifique" style="margin-left:6px; display:inline-block; max-width:240px">
                  </label>
                </div>
              </div>

              <div class="soli-row" style="margin-top:10px">
                <div class="soli-group">
                  <label for="fecha">Fecha</label>
                  <input type="date" id="fecha" name="fecha" class="form-control" required>
                </div>
                <div class="soli-group">
                  <label for="numero_solicitud">No. de Solicitud</label>
                  <input type="text" id="numero_solicitud" name="numero_solicitud" class="form-control" readonly>
                  <small class="muted">Se llena automáticamente (puedes editar si lo manejas desde backend).</small>
                </div>
              </div>
            </div>

            <!-- ====== TIPO DE SERVICIO ====== -->
            <div class="soli-h3">TIPO DE SERVICIO</div>
            <div class="soli-wrap">
              <div class="soli-row">
                <div class="soli-check-col">
                  <label><input type="checkbox" name="tipo_servicio[]" value="Diseño de tarjetas de circuito impreso"> Diseño de tarjetas de circuito impreso</label>
                  <label><input type="checkbox" name="tipo_servicio[]" value="Diseño de piezas 3D"> Diseño de piezas 3D</label>
                  <label><input type="checkbox" name="tipo_servicio[]" value="Impresión de piezas 3D"> Impresión de piezas 3D</label>
                  <label><input type="checkbox" name="tipo_servicio[]" value="Montaje de componentes electrónicos"> Montaje de componentes electrónicos</label>
                </div>
                <div class="soli-check-col">
                  <label><input type="checkbox" name="tipo_servicio[]" value="Fabricación de tarjetas de circuito impreso"> Fabricación de tarjetas de circuito impreso</label>
                  <label><input type="checkbox" name="tipo_servicio[]" value="Transferencia de conocimientos y/o tecnologías"> Transferencia de conocimientos y/o tecnologías</label>
                  <label><input type="checkbox" name="tipo_servicio[]" value="Fabricación o integración de soluciones tecnológicas"> Fabricación o integración de soluciones tecnológicas</label>
                </div>
              </div>
            </div>

            <!-- ====== DATOS DEL CLIENTE ====== -->
            <div class="soli-h3">DATOS DEL CLIENTE</div>
            <div class="soli-wrap">
              <div class="soli-row">
                <div class="soli-group">
                  <label for="razon_social">Razón Social (Nombre)</label>
                  <input type="text" id="razon_social" name="razon_social" class="form-control" required>
                </div>
                <div class="soli-group">
                  <label for="nit_cc">NIT o C.C</label>
                  <input type="text" id="nit_cc" name="nit_cc" class="form-control" required>
                </div>
              </div>

              <div class="soli-row" style="margin-top:8px">
                <div class="soli-group">
                  <label for="direccion">Dirección</label>
                  <input type="text" id="direccion" name="direccion" class="form-control" required>
                </div>
                <div class="soli-group">
                  <label for="telefono">Teléfono</label>
                  <input type="tel" id="telefono" name="telefono" class="form-control" required>
                </div>
              </div>

              <div class="soli-row" style="margin-top:8px">
                <div class="soli-group">
                  <label for="email">Correo electrónico</label>
                  <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="soli-group">
                  <label for="departamento">Departamento/Municipio</label>
                  <input type="text" id="departamento" name="departamento" class="form-control" required>
                </div>
              </div>
            </div>

            <!-- ====== DESCRIPCIÓN GENERAL ====== -->
            <div class="soli-h3">DESCRIPCIÓN GENERAL DEL SERVICIO</div>
            <div class="soli-wrap">
              <textarea class="form-control soli-textarea" id="descripcion_general" name="descripcion_general" placeholder="Describa el servicio solicitado…"></textarea>
            </div>

            <!-- ====== REQUERIMIENTOS FUNCIONALES ====== -->
            <div class="soli-h3">REQUERIMIENTOS FUNCIONALES</div>
            <div class="soli-wrap">
              <textarea class="form-control soli-textarea" id="requerimientos_funcionales" name="requerimientos_funcionales"></textarea>
            </div>

            <!-- ====== REQUERIMIENTOS TÉCNICOS ====== -->
            <div class="soli-h3">REQUERIMIENTOS TÉCNICOS</div>
            <div class="soli-wrap">
              <textarea class="form-control soli-textarea" id="requerimientos_tecnicos" name="requerimientos_tecnicos"></textarea>
            </div>

            <!-- ====== REQUERIMIENTOS MECÁNICOS / DISEÑO 3D ====== -->
            <div class="soli-h3">REQUERIMIENTOS MECÁNICOS / DISEÑO 3D</div>
            <div class="soli-wrap">
              <textarea class="form-control soli-textarea" id="req_mecanicos" name="req_mecanicos"></textarea>
            </div>

            <!-- ====== REQUERIMIENTOS DE SOFTWARE ====== -->
            <div class="soli-h3">REQUERIMIENTOS DE SOFTWARE</div>
            <div class="soli-wrap">
              <textarea class="form-control soli-textarea" id="req_software" name="req_software"></textarea>
            </div>

            <!-- ====== REQUERIMIENTOS DE COMUNICACIÓN / CONECTIVIDAD ====== -->
            <div class="soli-h3">REQUERIMIENTOS DE COMUNICACIÓN / CONECTIVIDAD</div>
            <div class="soli-wrap">
              <textarea class="form-control soli-textarea" id="req_comunicacion" name="req_comunicacion"></textarea>
            </div>

            <!-- ====== REQUERIMIENTOS NORMATIVOS APLICABLES ====== -->
            <div class="soli-h3">REQUERIMIENTOS NORMATIVOS APLICABLES</div>
            <div class="soli-wrap">
              <textarea class="form-control soli-textarea" id="req_normativos" name="req_normativos"></textarea>
            </div>

            <!-- ====== REQUERIMIENTOS DE VALIDACIÓN Y PRUEBAS ====== -->
            <div class="soli-h3">REQUERIMIENTOS DE VALIDACIÓN Y PRUEBAS</div>
            <div class="soli-wrap">
              <textarea class="form-control soli-textarea" id="req_validacion" name="req_validacion"></textarea>
            </div>

            <!-- ====== RESTRICCIONES Y CONDICIONES ESPECIALES ====== -->
            <div class="soli-h3">RESTRICCIONES Y CONDICIONES ESPECIALES</div>
            <div class="soli-wrap">
              <textarea class="form-control soli-textarea" id="restricciones" name="restricciones"></textarea>
            </div>

            <!-- ====== FIRMAS ====== -->
            <div class="soli-h3">Usuarios</div>
            <div class="soli-wrap">
              <table class="soli-table">
                <thead>
                  <tr>
                    <th style="width:50%">SOLICITANTE</th>
                    <th>RESPONSABLE</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="soli-group">
                        <label>Nombre:</label>
                        <input type="text" name="solicitante_nombre" class="form-control">
                      </div>
                    </td>
                    <td>
                      <div class="soli-group">
                        <label>Nombre:</label>
                        <input type="text" name="responsable_nombre" class="form-control">
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- ====== ACCIONES ====== -->
            <div style="display:grid; grid-template-columns: 1fr auto 1fr; align-items:center; gap:15px; width:100%;">
              <!-- Imprimir (izquierda) -->
              <button class="btn" type="submit" name="mode" value="print" formtarget="_blank"
                style="grid-column:1; justify-self:start; white-space:nowrap;">
                Imprimir PDF
              </button>

              <!-- Generar (centro) -->
              <button class="btn" id="btnGen" type="submit" name="mode" value="download"
                style="grid-column:2; justify-self:center; white-space:nowrap;">
                Generar PDF
              </button>

              <!-- Siguiente (derecha) -->
              <button type="button" class="btn" onclick="showTab('form2-tab')"
                style="grid-column:3; justify-self:end; white-space:nowrap;">
                Siguiente →
              </button>
            </div>
          </form>
        </div>
      </section>
    </div>

    <!-- Formulario 2: Evaluación Técnica -->
    <div class="tab-pane fade " id="form2" role="tabpanel" aria-labelledby="form2-tab">
      <section class="card">
        <header>
          <h2>📝 Formulario de Evaluación Técnica</h2>
        </header>
        <div>
          <!-- Aquí va el contenido completo del primer formulario que ya tienes -->
          <form method="POST" action="routes/estres.php">
            <input type="hidden" name="form_action" value="generate">
            <input type="hidden" name="advance_code" value="1">
            <div class="grid grid-3">
              <div> <label for="f_nombre">Nombre</label> <input id="f_nombre" name="nombre"
                  placeholder="Nombre completo" required /> </div>
              <div> <label for="f_fecha">Fecha</label> <input id="f_fecha" name="fecha" type="date" required /> </div>
              <div> <label for="f_cel">Celular</label> <input id="f_cel" name="celular" type="tel"
                  placeholder="(+57) 3XX XXX XXXX" required /> </div>
            </div> <!-- Servicios -->
            <div class="control-section"> <label>Servicio</label>
              <div id="f_servicios">
                <div class="form-check"> <input type="checkbox" name="servicio[servicio_diseno_pcb]" value="SI"
                    id="servicio1" /> <label class="form-check-label" for="servicio1">Diseño de tarjetas de circuito
                    impreso</label> </div>
                <div class="form-check"> <input type="checkbox" name="servicio[servicio_fabricacion_pcb]" value="SI"
                    id="servicio2" /> <label class="form-check-label" for="servicio2">Fabricación de tarjetas de
                    circuito impreso</label> </div>
                <div class="form-check"> <input type="checkbox" name="servicio[servicio_impresion_3d]" value="SI"
                    id="servicio3" /> <label class="form-check-label" for="servicio3">Impresión de piezas 3D</label>
                </div>
                <div class="form-check"> <input type="checkbox" name="servicio[servicio_diseno_3d]" value="SI"
                    id="servicio4" /> <label class="form-check-label" for="servicio4">Diseño de piezas 3D</label> </div>
                <div class="form-check"> <input type="checkbox" name="servicio[servicio_transferencia]" value="SI"
                    id="servicio5" /> <label class="form-check-label" for="servicio5">Transferencia de conocimientos y/o
                    tecnologías</label> </div>
                <div class="form-check"> <input type="checkbox" name="servicio[servicio_montaje]" value="SI"
                    id="servicio6" /> <label class="form-check-label" for="servicio6">Montaje de componentes
                    electrónicos</label> </div>
                <div class="form-check"> <input type="checkbox" name="servicio[servicio_integracion]" value="SI"
                    id="servicio7" /> <label class="form-check-label" for="servicio7">Fabricación o integración de
                    soluciones tecnológicas</label> </div>
              </div>
            </div> <!-- Observaciones -->
            <div class="control-section"> <label for="f_obs">Observaciones (límite de 686 caracteres)</label> <textarea id="f_obs"
                name="observaciones" placeholder="Notas…" rows="3" maxlength="686"></textarea> </div>
            <!-- Ítems SI/NO/N/A (EN LA MISMA TARJETA) -->
            <hr class="divider">
            <h3 class="section-title">✔ ASPECTOS A EVALUAR</h3>
            <div class="evaluation-container" id="ctl"> <!-- Grupo 1: Diseño de tarjetas de circuito impreso -->
              <div class="evaluation-group">
                <h4>1. Diseño de tarjetas de circuito impreso</h4>
                <div class="evaluation-item"> <label>1.1 Requiere normas especiales de diseño (MIL, UL, IPC)</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_1_1" id="i_1_1_si" value="SI"> <label
                        for="i_1_1_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_1_1" id="i_1_1_no" value="NO"> <label
                        for="i_1_1_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_1_1" id="i_1_1_na" value="N/A"> <label
                        for="i_1_1_na">N/A</label> </div>
                  </div>
                </div>
                <div class="evaluation-item"> <label>1.2 Requiere análisis térmico</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_1_2" id="i_1_2_si" value="SI"> <label
                        for="i_1_2_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_1_2" id="i_1_2_no" value="NO"> <label
                        for="i_1_2_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_1_2" id="i_1_2_na" value="N/A"> <label
                        for="i_1_2_na">N/A</label> </div>
                  </div>
                </div>
                <div class="evaluation-item"> <label>1.3 Requiere análisis mecánico</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_1_3" id="i_1_3_si" value="SI"> <label
                        for="i_1_3_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_1_3" id="i_1_3_no" value="NO"> <label
                        for="i_1_3_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_1_3" id="i_1_3_na" value="N/A"> <label
                        for="i_1_3_na">N/A</label> </div>
                  </div>
                </div>
                <div class="evaluation-item"> <label>1.4 Requiere análisis de radio frecuencia</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_1_4" id="i_1_4_si" value="SI"> <label
                        for="i_1_4_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_1_4" id="i_1_4_no" value="NO"> <label
                        for="i_1_4_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_1_4" id="i_1_4_na" value="N/A"> <label
                        for="i_1_4_na">N/A</label> </div>
                  </div>
                </div>
              </div> <!-- Grupo 2: Fabricación de tarjetas de circuito impreso -->
              <div class="evaluation-group">
                <h4>2. Fabricación de tarjetas de circuito impreso</h4>
                <div class="evaluation-item"> <label>2.1 El equipo se encuentra disponible para el desarrollo del
                    proceso</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_2_1" id="i_2_1_si" value="SI"> <label
                        for="i_2_1_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_2_1" id="i_2_1_no" value="NO"> <label
                        for="i_2_1_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_2_1" id="i_2_1_na" value="N/A"> <label
                        for="i_2_1_na">N/A</label> </div>
                  </div>
                </div>
                <div class="evaluation-item"> <label>2.2 Es menor o igual al máximo tamaño permitido (280mm x
                    210mm)</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_2_2" id="i_2_2_si" value="SI"> <label
                        for="i_2_2_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_2_2" id="i_2_2_no" value="NO"> <label
                        for="i_2_2_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_2_2" id="i_2_2_na" value="N/A"> <label
                        for="i_2_2_na">N/A</label> </div>
                  </div>
                </div>
                <div class="evaluation-item"> <label>2.3 Se puede fabricar en material FR4 de 1 o 2 caras calibre 1.5
                    mm</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_2_3" id="i_2_3_si" value="SI"> <label
                        for="i_2_3_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_2_3" id="i_2_3_no" value="NO"> <label
                        for="i_2_3_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_2_3" id="i_2_3_na" value="N/A"> <label
                        for="i_2_3_na">N/A</label> </div>
                  </div>
                </div>
                <div class="evaluation-item"> <label>2.4 Las perforaciones son menores o iguales a (0.4mm)</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_2_4" id="i_2_4_si" value="SI"> <label
                        for="i_2_4_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_2_4" id="i_2_4_no" value="NO"> <label
                        for="i_2_4_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_2_4" id="i_2_4_na" value="N/A"> <label
                        for="i_2_4_na">N/A</label> </div>
                  </div>
                </div>
                <div class="evaluation-item"> <label>2.5 El ancho de las pistas es menor o igual a 0.2 mm</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_2_5" id="i_2_5_si" value="SI"> <label
                        for="i_2_5_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_2_5" id="i_2_5_no" value="NO"> <label
                        for="i_2_5_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_2_5" id="i_2_5_na" value="N/A"> <label
                        for="i_2_5_na">N/A</label> </div>
                  </div>
                </div>
                <div class="evaluation-item"> <label>2.6 El espacio entre pistas, vías y pads es mayor o igual a
                    0.1mm</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_2_6" id="i_2_6_si" value="SI"> <label
                        for="i_2_6_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_2_6" id="i_2_6_no" value="NO"> <label
                        for="i_2_6_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_2_6" id="i_2_6_na" value="N/A"> <label
                        for="i_2_6_na">N/A</label> </div>
                  </div>
                </div>
                <div class="evaluation-item"> <label>2.7 Acabado Anti-solder color verde</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_2_7" id="i_2_7_si" value="SI"> <label
                        for="i_2_7_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_2_7" id="i_2_7_no" value="NO"> <label
                        for="i_2_7_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_2_7" id="i_2_7_na" value="N/A"> <label
                        for="i_2_7_na">N/A</label> </div>
                  </div>
                </div>
                <div class="evaluation-item"> <label>2.8 Acabado silk-screen color blanco</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_2_8" id="i_2_8_si" value="SI"> <label
                        for="i_2_8_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_2_8" id="i_2_8_no" value="NO"> <label
                        for="i_2_8_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_2_8" id="i_2_8_na" value="N/A"> <label
                        for="i_2_8_na">N/A</label> </div>
                  </div>
                </div>
                <div class="evaluation-item"> <label>2.9 Hueco metalizado</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_2_9" id="i_2_9_si" value="SI"> <label
                        for="i_2_9_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_2_9" id="i_2_9_no" value="NO"> <label
                        for="i_2_9_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_2_9" id="i_2_9_na" value="N/A"> <label
                        for="i_2_9_na">N/A</label> </div>
                  </div>
                </div>
              </div> <!-- Grupo 3: Fabricación o integración de soluciones tecnológicas -->
              <div class="evaluation-group">
                <h4>3. Fabricación o integración de soluciones tecnológicas</h4>
                <div class="evaluation-item"> <label>3.1 Requiere cumplimiento de normas especiales de productos
                    electrónicos (IPC clase 2 o 3)</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_3_1" id="i_3_1_si" value="SI"> <label
                        for="i_3_1_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_3_1" id="i_3_1_no" value="NO"> <label
                        for="i_3_1_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_3_1" id="i_3_1_na" value="N/A"> <label
                        for="i_3_1_na">N/A</label> </div>
                  </div>
                </div>
                <div class="evaluation-item"> <label>3.2 Se cuenta con los equipos o herramientas necesarias</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_3_2" id="i_3_2_si" value="SI"> <label
                        for="i_3_2_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_3_2" id="i_3_2_no" value="NO"> <label
                        for="i_3_2_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_3_2" id="i_3_2_na" value="N/A"> <label
                        for="i_3_2_na">N/A</label> </div>
                  </div>
                </div>
              </div> <!-- Grupo 4: Transferencia de conocimientos y/o tecnologías -->
              <div class="evaluation-group">
                <h4>4. Transferencia de conocimientos y/o tecnologías</h4>
                <div class="evaluation-item"> <label>4.1 Se cuenta con los equipos o herramientas necesarias</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_4_1" id="i_4_1_si" value="SI"> <label
                        for="i_4_1_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_4_1" id="i_4_1_no" value="NO"> <label
                        for="i_4_1_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_4_1" id="i_4_1_na" value="N/A"> <label
                        for="i_4_1_na">N/A</label> </div>
                  </div>
                </div>
                <div class="evaluation-item"> <label>4.2 Se cuenta con los materiales necesarios para realizar la
                    transferencia</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_4_2" id="i_4_2_si" value="SI"> <label
                        for="i_4_2_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_4_2" id="i_4_2_no" value="NO"> <label
                        for="i_4_2_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_4_2" id="i_4_2_na" value="N/A"> <label
                        for="i_4_2_na">N/A</label> </div>
                  </div>
                </div>
              </div> <!-- Grupo 5: Diseño de piezas en 3D -->
              <div class="evaluation-group">
                <h4>5. Diseño de piezas en 3D</h4>
                <div class="evaluation-item"> <label>5.1 El software de diseño se encuentra autorizado para uso
                    institucional</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_5_1" id="i_5_1_si" value="SI"> <label
                        for="i_5_1_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_5_1" id="i_5_1_no" value="NO"> <label
                        for="i_5_1_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_5_1" id="i_5_1_na" value="N/A"> <label
                        for="i_5_1_na">N/A</label> </div>
                  </div>
                </div>
                <div class="evaluation-item"> <label>5.2 El diseño debe cumplir con medidas exactas para
                    ensamblaje</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_5_2" id="i_5_2_si" value="SI"> <label
                        for="i_5_2_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_5_2" id="i_5_2_no" value="NO"> <label
                        for="i_5_2_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_5_2" id="i_5_2_na" value="N/A"> <label
                        for="i_5_2_na">N/A</label> </div>
                  </div>
                </div>
              </div> <!-- Grupo 6: Impresión de piezas en 3D -->
              <div class="evaluation-group">
                <h4>6. Impresión de piezas en 3D</h4>
                <div class="evaluation-item"> <label>6.1 La impresora se encuentra disponible para el desarrollo del
                    proceso</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_6_1" id="i_6_1_si" value="SI"> <label
                        for="i_6_1_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_6_1" id="i_6_1_no" value="NO"> <label
                        for="i_6_1_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_6_1" id="i_6_1_na" value="N/A"> <label
                        for="i_6_1_na">N/A</label> </div>
                  </div>
                </div>
                <div class="evaluation-item"> <label>6.2 El software del equipo está actualizado para la
                    fabricación</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_6_2" id="i_6_2_si" value="SI"> <label
                        for="i_6_2_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_6_2" id="i_6_2_no" value="NO"> <label
                        for="i_6_2_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_6_2" id="i_6_2_na" value="N/A"> <label
                        for="i_6_2_na">N/A</label> </div>
                  </div>
                </div>
                <div class="evaluation-item"> <label>6.3 Los materiales de impresión solicitados están
                    disponibles</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_6_3" id="i_6_3_si" value="SI"> <label
                        for="i_6_3_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_6_3" id="i_6_3_no" value="NO"> <label
                        for="i_6_3_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_6_3" id="i_6_3_na" value="N/A"> <label
                        for="i_6_3_na">N/A</label> </div>
                  </div>
                </div>
                <div class="evaluation-item"> <label>6.4 El diseño a imprimir cumple con las condiciones de tamaño del
                    equipo</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_6_4" id="i_6_4_si" value="SI"> <label
                        for="i_6_4_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_6_4" id="i_6_4_no" value="NO"> <label
                        for="i_6_4_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_6_4" id="i_6_4_na" value="N/A"> <label
                        for="i_6_4_na">N/A</label> </div>
                  </div>
                </div>
                <div class="evaluation-item"> <label>6.5 Se cuenta con las especificaciones de boquilla
                    necesaria</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_6_5" id="i_6_5_si" value="SI"> <label
                        for="i_6_5_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_6_5" id="i_6_5_no" value="NO"> <label
                        for="i_6_5_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_6_5" id="i_6_5_na" value="N/A"> <label
                        for="i_6_5_na">N/A</label> </div>
                  </div>
                </div>
              </div> <!-- Grupo 7: Montaje de componentes electrónicos -->
              <div class="evaluation-group">
                <h4>7. Montaje de componentes electrónicos</h4>
                <div class="evaluation-item"> <label>7.1 Los equipos de soldadura adecuados se encuentran
                    disponibles</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_7_1" id="i_7_1_si" value="SI"> <label
                        for="i_7_1_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_7_1" id="i_7_1_no" value="NO"> <label
                        for="i_7_1_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_7_1" id="i_7_1_na" value="N/A"> <label
                        for="i_7_1_na">N/A</label> </div>
                  </div>
                </div>
                <div class="evaluation-item"> <label>7.2 Hay disponibilidad de insumos adecuados para el trabajo
                    solicitado</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_7_2" id="i_7_2_si" value="SI"> <label
                        for="i_7_2_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_7_2" id="i_7_2_no" value="NO"> <label
                        for="i_7_2_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_7_2" id="i_7_2_na" value="N/A"> <label
                        for="i_7_2_na">N/A</label> </div>
                  </div>
                </div>
                <div class="evaluation-item"> <label>7.3 Hay disponibilidad de equipos para las pruebas de continuidad
                    eléctrica</label>
                  <div class="radio-group">
                    <div class="radio-option"> <input type="radio" name="i_7_3" id="i_7_3_si" value="SI"> <label
                        for="i_7_3_si">SI</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_7_3" id="i_7_3_no" value="NO"> <label
                        for="i_7_3_no">NO</label> </div>
                    <div class="radio-option"> <input type="radio" name="i_7_3" id="i_7_3_na" value="N/A"> <label
                        for="i_7_3_na">N/A</label> </div>
                  </div>
                </div>
              </div> <!-- Aprobado general -->
              <div class="approval-card">
                <div class="approval-header">
                  <h4>Aprobado general</h4>
                  <div class="status-indicator" id="approval-status">Pendiente</div>
                </div>

                <div class="approval-row">
                  <!-- Radios accesibles pero ocultos -->
                  <input type="radio" name="aprobado" id="aprobado_si" value="SI" class="visually-hidden" checked>
                  <input type="radio" name="aprobado" id="aprobado_no" value="NO" class="visually-hidden">

                  <!-- Switch -->
                  <div class="switch">
                    <label for="aprobado_si" class="switch-seg si">
                      <span class="icon">✓</span> SI
                    </label>
                    <label for="aprobado_no" class="switch-seg no">
                      <span class="icon">✗</span> NO
                    </label>
                    <span class="switch-slider" aria-hidden="true"></span>
                  </div>
                </div>
              </div>
            </div> <!-- Botones -->
            <div class="control-section">
              <div style="display:flex; align-items:center; justify-content:space-between; gap:12px; width:100%;">
                <button type="button" class="btn secondary" onclick="showTab('form1-tab')" style="flex:0 0 auto; white-space:nowrap;">
                  ← Anterior
                </button>
                <!-- Descargar PDF -->
                <button class="btn" type="submit" name="mode" value="download" style="flex:0 0 auto; white-space:nowrap;">
                  Generar PDF
                </button>
                <!-- Abrir PDF inline (para imprimir) -->
                <button class="btn" type="submit" name="mode" value="print" formtarget="_blank" style="flex:0 0 auto; white-space:nowrap;">
                  Imprimir PDF
                </button>
                <button type="button" class="btn" onclick="showTab('form3-tab')" style="flex:0 0 auto; white-space:nowrap;">
                  Siguiente →
                </button>
              </div>

            </div>
          </form>
        </div>
      </section>
    </div>

    <!-- Formulario 3: Recursos y Materiales -->
    <div class="tab-pane fade" id="form3" role="tabpanel" aria-labelledby="form3-tab">
      <section class="card">
        <header>
          <h2>🛠️ Recursos y Materiales</h2>
        </header>
        <div>
          <form id="form-cotizacion-3" class="cot-wrap" method="POST" action="routes/estres.php">
            <input type="hidden" name="advance_code" id="f3_advance_code" value="1">
            <input type="hidden" name="reset_code" id="f3_reset_code" value="0">
            <input type="hidden" name="accion" value="cotizacion">
            <div class="fieldset">
              <div class="legend">SOLICITUD</div>
              <div class="box">

                <!-- Vía de solicitud -->
                <div class="soli-grid">
                  <div class="soli-col">
                    <label class="chk">
                      <input type="radio" name="solicitud_via" value="Telefónica">
                      <span>Telefónica</span>
                    </label>
                    <label class="chk">
                      <input type="radio" name="solicitud_via" value="Presencial">
                      <span>Presencial</span>
                    </label>
                  </div>

                  <div class="soli-col">
                    <label class="chk">
                      <input type="radio" name="solicitud_via" value="Correo electrónico">
                      <span>Correo electrónico</span>
                    </label>

                    <!-- “Otro” con campo visible al marcar -->
                    <div class="soli-otro">
                      <label class="chk" style="margin:0">
                        <input type="radio" id="sol_via_otro" name="solicitud_via" value="Otro">
                        <span>Otro</span>
                      </label>
                      <input class="control" id="sol_via_otro_text" name="solicitud_via_otro" placeholder="Especifique" style="display:none;max-width:240px">
                    </div>
                  </div>
                </div>


                <!-- Fecha / números -->
                <div class="row auto-3 mt-12">
                  <div class="fg">
                    <label>Fecha</label>
                    <input class="control" type="date" name="fecha" required>
                  </div>
                  <div class="fg">
                    <label>Comprobante Pago No.</label>
                    <input class="control" name="comprobante_no" placeholder="OP-12345">
                  </div>
                </div>

              </div>
            </div>
            <!-- ===== DATOS DEL CLIENTE ===== -->
            <div class="fieldset">
              <div class="legend">DATOS DEL CLIENTE</div>
              <div class="box">
                <div class="row c2">
                  <div class="fg"><label>Razón Social (Nombre):</label><input class="control" name="razon_social" required></div>
                  <div class="fg"><label>NIT o C.C:</label><input class="control" name="nit_cc"></div>
                </div>
                <div class="row c2" style="margin-top:10px">
                  <div class="fg"><label>Dirección:</label><input class="control" name="direccion"></div>
                  <div class="fg"><label>Teléfono:</label><input class="control" name="telefono"></div>
                </div>
                <div class="row c2" style="margin-top:10px">
                  <div class="fg"><label>Correo electrónico:</label><input class="control" type="email" name="correo"></div>
                  <div class="fg"><label>Municipio/Departamento:</label><input class="control" name="municipio"></div>
                </div>
              </div>
            </div>

            <!-- ===== TIPO DE CLIENTE ===== -->
            <div class="fieldset">
              <div class="legend">TIPO DE CLIENTE</div>
              <div class="box">
                <div class="row c3">
                  <label class="chk"><input type="radio" name="tipo_cliente" value="Aprendiz" required>Aprendiz</label>
                  <label class="chk"><input type="radio" name="tipo_cliente" value="Emprendedor">Emprendedor</label>
                  <label class="chk"><input type="radio" name="tipo_cliente" value="Persona natural">Persona natural</label>
                  <label class="chk"><input type="radio" name="tipo_cliente" value="Persona jurídica">Persona jurídica</label>
                  <label class="chk"><input type="radio" name="tipo_cliente" value="Proyectos I+D+i">Proyectos I+D+i</label>
                  <label class="chk"><input type="radio" name="tipo_cliente" value="Otro" id="cli_otro">Otro</label>
                </div>
                <div class="row" id="cli_otro_wrap" style="display:none;margin-top:10px">
                  <div class="fg"><label>Especifique “Otro”</label><input class="control" name="tipo_cliente_otro" placeholder="Detalle…"></div>
                </div>
              </div>
            </div>

            <!-- ===== DETALLE DE COTIZACIÓN ===== -->
            <div class="fieldset">
              <div class="legend">DETALLE DE COTIZACIÓN</div>
              <div class="box">
                <table class="items" id="items-table">
                  <thead>
                    <tr>
                      <th style="width:70px">ÍTEM</th>
                      <th>DESCRIPCIÓN</th>
                      <th style="width:120px">CANTIDAD</th>
                      <th style="width:160px">VALOR UNITARIO</th>
                      <th style="width:160px">VALOR TOTAL</th>
                      <th style="width:70px">—</th>
                    </tr>
                  </thead>
                  <tbody id="items-body"></tbody>
                  <tfoot>
                    <tr>
                      <td colspan="4">TOTAL</td>
                      <td><input class="control" id="total_general" name="total_general" readonly value="$0"></td>
                      <td></td>
                    </tr>
                  </tfoot>
                </table>
                <button type="button" class="btn secondary" id="btnAddItem" style="margin-top:10px">+ Agregar ítem</button>

                <div class="fg" style="margin-top:12px">
                  <label>Observaciones:</label>
                  <textarea class="control" name="observaciones" rows="4" style="height:auto"></textarea>
                </div>
              </div>
            </div>

            <!-- ===== ACEPTACIÓN ===== -->
            <div class="fieldset">
              <div class="legend">ACEPTO</div>
              <div class="box">
                <div class="fg"><label>Nombre:</label><input class="control" name="acepta_nombre"></div>
              </div>
            </div>

            <!-- ===== BOTONERA (centrado perfecto del PDF) ===== -->
            <div class="text-center">
              <div style="display:flex; align-items:center; justify-content:space-between; gap:12px; width:100%;">
                <button type="button" class="btn secondary" onclick="showTab('form2-tab')" style="flex:0 0 auto; white-space:nowrap;">
                  ← Anterior
                </button>
                <!-- Descargar PDF -->
                <button class="btn" type="submit" name="mode" value="download" style="flex:0 0 auto; white-space:nowrap;">
                  Generar PDF
                </button>
                <!-- Imprimir PDF en nueva pestaña -->
                <button class="btn" type="submit" name="mode" value="print" formtarget="_blank" style="flex:0 0 auto; white-space:nowrap;">
                  Imprimir PDF
                </button>
                <button type="button" class="btn" onclick="showTab('form4-tab')" style="flex:0 0 auto; white-space:nowrap;">
                  Siguiente →
                </button>
              </div>
          </form>
        </div>
      </section>
    </div>

    <!-- Formulario 4: Cronograma -->
    <div class="tab-pane fade" id="form4" role="tabpanel" aria-labelledby="form4-tab">
      <section class="card">
        <header>
          <h2>📅 Cronograma de Actividades</h2>
        </header>

        <div>
          <!-- ===== ORDEN DE TRABAJO ===== -->
          <form id="form-ot" method="POST" action="routes/estres.php" class="ot-wrap">
            <!-- Campos ocultos -->
            <input type="hidden" name="action" value="generate_ot">
            <input type="hidden" id="ot_materiales_json" name="ot_materiales_json" value="[]">
            <input type="hidden" name="advance_code" id="f4_advance_code" value="1">
            <input type="hidden" name="reset_code" id="f4_reset_code" value="0">


            <!-- ===== Encabezado ===== -->
            <div class="row g-3 mb-2 ot-header">

              <!-- No Conformidad -->
              <div class="col-md-4">
                <label class="form-label">Atención a una No Conformidad:</label>
                <input class="form-control form-control-sm" type="text" name="ot_no_conformidad" id="ot_no_conformidad" placeholder="Escriba aquí...">
              </div>

              <!-- Fecha -->
              <div class="col-md-4">
                <label class="form-label">Fecha:</label>
                <input class="form-control form-control-sm" type="date" name="ot_fecha" id="ot_fecha" placeholder="dd/mm/aaaa">
              </div>
            </div>

            <!-- ===== Tipo de Servicio ===== -->
            <div class="servicio-section">
              <label class="fw-bold mb-2">Servicio</label>
              <div class="servicio-grid">
                <label class="servicio-item">
                  <input type="checkbox" name="ot_servicio[diseno_pcb]">
                  <span>Diseño de tarjetas de circuito impreso</span>
                </label>
                <label class="servicio-item">
                  <input type="checkbox" name="ot_servicio[fabricacion_pcb]">
                  <span>Fabricación de tarjetas de circuito impreso</span>
                </label>
                <label class="servicio-item">
                  <input type="checkbox" name="ot_servicio[impresion_3d]">
                  <span>Impresión de piezas 3D</span>
                </label>
                <label class="servicio-item">
                  <input type="checkbox" name="ot_servicio[diseno_3d]">
                  <span>Diseño de piezas 3D</span>
                </label>
                <label class="servicio-item">
                  <input type="checkbox" name="ot_servicio[transferencia]">
                  <span>Transferencia de conocimientos y/o tecnologías</span>
                </label>
                <label class="servicio-item">
                  <input type="checkbox" name="ot_servicio[integracion]">
                  <span>Fabricación o integración de soluciones tecnológicas</span>
                </label>
                <label class="servicio-item">
                  <input type="checkbox" name="ot_servicio[montaje]">
                  <span>Montaje de componentes electrónicos</span>
                </label>
              </div>
            </div>

            <!-- ===== Asignado a ===== -->
            <div class="mb-2">
              <label class="form-label">Asignado a:</label>
              <input class="form-control" name="ot_asignado" id="ot_asignado" placeholder="Nombre(s) y/o equipo responsable">
            </div>

            <!-- ===== Descripción de actividades ===== -->
            <div class="mb-3">
              <label class="form-label">Descripción de actividades:</label>
              <textarea class="form-control" rows="5" name="ot_actividades" id="ot_actividades" placeholder="Detalle las actividades a realizar"></textarea>
            </div>

            <!-- ===== Materiales e insumos ===== -->
            <input type="hidden" name="accion" value="generate_ot">

            <div class="fieldset">
              <div class="legend">MATERIALES E INSUMOS</div>
              <div class="box">
                <table class="items">
                  <thead>
                    <tr>
                      <th style="width:70px; text-align:center">ÍTEM</th>
                      <th>DESCRIPCIÓN</th>
                      <th style="width:120px; text-align:right">CANTIDAD</th>
                      <th style="width:160px;">UNIDAD</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Máximo 6 filas; deja vacías las que no uses -->
                    <!-- Fila 1 -->
                    <tr>
                      <td style="text-align:center">1</td>
                      <td><input class="control" name="ot_mat_nombre[]" placeholder="Descripción del material"></td>
                      <td><input class="control" name="ot_mat_cantidad[]" type="number" min="1" step="1" value=""></td>
                      <td><input class="control" name="ot_mat_unidad[]" placeholder="und, m, kg"></td>
                    </tr>
                    <!-- Fila 2 -->
                    <tr>
                      <td style="text-align:center">2</td>
                      <td><input class="control" name="ot_mat_nombre[]" placeholder="Descripción del material"></td>
                      <td><input class="control" name="ot_mat_cantidad[]" type="number" min="1" step="1" value=""></td>
                      <td><input class="control" name="ot_mat_unidad[]" placeholder="und, m, kg"></td>
                    </tr>
                    <!-- Fila 3 -->
                    <tr>
                      <td style="text-align:center">3</td>
                      <td><input class="control" name="ot_mat_nombre[]" placeholder="Descripción del material"></td>
                      <td><input class="control" name="ot_mat_cantidad[]" type="number" min="1" step="1" value=""></td>
                      <td><input class="control" name="ot_mat_unidad[]" placeholder="und, m, kg"></td>
                    </tr>
                    <!-- Fila 4 -->
                    <tr>
                      <td style="text-align:center">4</td>
                      <td><input class="control" name="ot_mat_nombre[]" placeholder="Descripción del material"></td>
                      <td><input class="control" name="ot_mat_cantidad[]" type="number" min="1" step="1" value=""></td>
                      <td><input class="control" name="ot_mat_unidad[]" placeholder="und, m, kg"></td>
                    </tr>
                    <!-- Fila 5 -->
                    <tr>
                      <td style="text-align:center">5</td>
                      <td><input class="control" name="ot_mat_nombre[]" placeholder="Descripción del material"></td>
                      <td><input class="control" name="ot_mat_cantidad[]" type="number" min="1" step="1" value=""></td>
                      <td><input class="control" name="ot_mat_unidad[]" placeholder="und, m, kg"></td>
                    </tr>
                    <!-- Fila 6 -->
                    <tr>
                      <td style="text-align:center">6</td>
                      <td><input class="control" name="ot_mat_nombre[]" placeholder="Descripción del material"></td>
                      <td><input class="control" name="ot_mat_cantidad[]" type="number" min="1" step="1" value=""></td>
                      <td><input class="control" name="ot_mat_unidad[]" placeholder="und, m, kg"></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- ===== Botón de envío ===== -->
            <div class="text-center">
              <div style="display:flex; align-items:center; justify-content:space-between; gap:12px; width:100%;">
                <button type="button" class="btn secondary" onclick="showTab('form3-tab')" style="flex:0 0 auto; white-space:nowrap;">
                  ← Anterior
                </button>
                <!-- Descargar PDF -->
                <button class="btn" type="submit" name="mode" value="download" style="flex:0 0 auto; white-space:nowrap;">
                  Generar PDF
                </button>
                <!-- Imprimir PDF en nueva pestaña -->
                <button class="btn" type="submit" name="mode" value="print" formtarget="_blank" style="flex:0 0 auto; white-space:nowrap;">
                  Imprimir PDF
                </button>
                <button type="button" class="btn" onclick="showTab('form5-tab')" style="flex:0 0 auto; white-space:nowrap;">
                  Siguiente →
                </button>
              </div>
            </div>
          </form>
          <script>
            // Al enviar, volcar la tabla de materiales al hidden JSON
            document.getElementById('form-ot')?.addEventListener('submit', function() {
              // usa el arreglo global que ya manipulan otAgregarMaterial/otEliminarMaterial
              if (window.otMateriales) {
                document.getElementById('ot_materiales_json').value = JSON.stringify(window.otMateriales);
              }
            });
          </script>
        </div>
      </section>
    </div>

    <!-- Formulario 5: Presupuesto -->
    <div class="tab-pane fade" id="form5" role="tabpanel" aria-labelledby="form5-tab">
      <section class="card">
        <header>
          <h2>💰 Presupuesto Estimado</h2>
        </header>
        <div>
          <form method="POST" action="routes/estres.php" id="vd-form" class="mb-4">
            <input type="hidden" name="action" value="generate_verificacion_pcb">
            <input type="hidden" name="advance_code" value="1">
            <input type="hidden" name="reset_code" value="0">


            <!-- Encabezado -->
            <div class="vd-block">
              <div class="vd-title">Información general</div>
              <div class="vd-row">
                <div>
                  <label class="vd-label">Fecha:</label>
                  <input class="form-control" type="date" name="vd_fecha" id="vd_fecha">
                </div>
                <div></div>
              </div>
            </div>

            <!-- Sección 1 -->
            <div class="vd-block">
              <div class="vd-title">Verificación del diseño de tarjetas de circuito impreso</div>
              <table class="vd-matrix">
                <thead>
                  <tr>
                    <th class="vd-num">No</th>
                    <th>Ítem a verificar</th>
                    <th class="vd-si">SI</th>
                    <th class="vd-no">NO</th>
                    <th class="vd-na">N/A</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="vd-num">1.1</td>
                    <td>Esquemático contiene todas las conexiones solicitadas</td>
                    <td class="vd-si"><input type="radio" name="vd_i_1_1" value="SI"></td>
                    <td class="vd-no"><input type="radio" name="vd_i_1_1" value="NO"></td>
                    <td class="vd-na"><input type="radio" name="vd_i_1_1" value="NA"></td>
                  </tr>
                  <tr>
                    <td class="vd-num">1.2</td>
                    <td>Cumple con requerimientos de tamaño</td>
                    <td class="vd-si"><input type="radio" name="vd_i_1_2" value="SI"></td>
                    <td class="vd-no"><input type="radio" name="vd_i_1_2" value="NO"></td>
                    <td class="vd-na"><input type="radio" name="vd_i_1_2" value="NA"></td>
                  </tr>
                  <tr>
                    <td class="vd-num">1.3</td>
                    <td>Cumple con requerimientos de número de capas</td>
                    <td class="vd-si"><input type="radio" name="vd_i_1_3" value="SI"></td>
                    <td class="vd-no"><input type="radio" name="vd_i_1_3" value="NO"></td>
                    <td class="vd-na"><input type="radio" name="vd_i_1_3" value="NA"></td>
                  </tr>
                  <tr>
                    <td class="vd-num">1.4</td>
                    <td>Cumple con requerimientos mecánicos / test points</td>
                    <td class="vd-si"><input type="radio" name="vd_i_1_4" value="SI"></td>
                    <td class="vd-no"><input type="radio" name="vd_i_1_4" value="NO"></td>
                    <td class="vd-na"><input type="radio" name="vd_i_1_4" value="NA"></td>
                  </tr>
                  <tr>
                    <td class="vd-num">1.5</td>
                    <td>DRC / Design Rule Check sin errores</td>
                    <td class="vd-si"><input type="radio" name="vd_i_1_5" value="SI"></td>
                    <td class="vd-no"><input type="radio" name="vd_i_1_5" value="NO"></td>
                    <td class="vd-na"><input type="radio" name="vd_i_1_5" value="NA"></td>
                  </tr>
                  <tr>
                    <td class="vd-num">1.6</td>
                    <td>Se verifican holes / vías / pads (tamaños mínimos)</td>
                    <td class="vd-si"><input type="radio" name="vd_i_1_6" value="SI"></td>
                    <td class="vd-no"><input type="radio" name="vd_i_1_6" value="NO"></td>
                    <td class="vd-na"><input type="radio" name="vd_i_1_6" value="NA"></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Sección 2 -->
            <div class="vd-block">
              <div class="vd-title">Verificación de la fabricación de tarjetas de circuito impreso</div>
              <table class="vd-matrix">
                <thead>
                  <tr>
                    <th class="vd-num">No</th>
                    <th>Ítem a verificar</th>
                    <th class="vd-si">SI</th>
                    <th class="vd-no">NO</th>
                    <th class="vd-na">N/A</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="vd-num">2.1</td>
                    <td>Capas TOP y/o BOTTOM correctas</td>
                    <td class="vd-si"><input type="radio" name="vd_i_2_1" value="SI"></td>
                    <td class="vd-no"><input type="radio" name="vd_i_2_1" value="NO"></td>
                    <td class="vd-na"><input type="radio" name="vd_i_2_1" value="NA"></td>
                  </tr>
                  <tr>
                    <td class="vd-num">2.2</td>
                    <td>Máscara de soldadura correcta</td>
                    <td class="vd-si"><input type="radio" name="vd_i_2_2" value="SI"></td>
                    <td class="vd-no"><input type="radio" name="vd_i_2_2" value="NO"></td>
                    <td class="vd-na"><input type="radio" name="vd_i_2_2" value="NA"></td>
                  </tr>
                  <tr>
                    <td class="vd-num">2.3</td>
                    <td>Pads bien formados / sin puentes</td>
                    <td class="vd-si"><input type="radio" name="vd_i_2_3" value="SI"></td>
                    <td class="vd-no"><input type="radio" name="vd_i_2_3" value="NO"></td>
                    <td class="vd-na"><input type="radio" name="vd_i_2_3" value="NA"></td>
                  </tr>
                  <tr>
                    <td class="vd-num">2.4</td>
                    <td>Serigrafía y textos legibles</td>
                    <td class="vd-si"><input type="radio" name="vd_i_2_4" value="SI"></td>
                    <td class="vd-no"><input type="radio" name="vd_i_2_4" value="NO"></td>
                    <td class="vd-na"><input type="radio" name="vd_i_2_4" value="NA"></td>
                  </tr>
                  <tr>
                    <td class="vd-num">2.5</td>
                    <td>Prueba de continuidad eléctrica pasada</td>
                    <td class="vd-si"><input type="radio" name="vd_i_2_5" value="SI"></td>
                    <td class="vd-no"><input type="radio" name="vd_i_2_5" value="NO"></td>
                    <td class="vd-na"><input type="radio" name="vd_i_2_5" value="NA"></td>
                  </tr>
                  <tr>
                    <td class="vd-num">2.6</td>
                    <td>Prueba de aislamiento pasada</td>
                    <td class="vd-si"><input type="radio" name="vd_i_2_6" value="SI"></td>
                    <td class="vd-no"><input type="radio" name="vd_i_2_6" value="NO"></td>
                    <td class="vd-na"><input type="radio" name="vd_i_2_6" value="NA"></td>
                  </tr>
                  <tr>
                    <td class="vd-num">2.7</td>
                    <td>Dimensiones finales dentro de tolerancia</td>
                    <td class="vd-si"><input type="radio" name="vd_i_2_7" value="SI"></td>
                    <td class="vd-no"><input type="radio" name="vd_i_2_7" value="NO"></td>
                    <td class="vd-na"><input type="radio" name="vd_i_2_7" value="NA"></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Aprobado / Observaciones -->
            <div class="vd-block">
              <div class="row g-3">
                <div class="col-12 col-md-6">
                  <label class="vd-label d-block">Aprobado:</label>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="vd_aprobado" id="vd_aprobado_si" value="SI">
                    <label class="form-check-label" for="vd_aprobado_si">SI</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="vd_aprobado" id="vd_aprobado_no" value="NO">
                    <label class="form-check-label" for="vd_aprobado_no">NO</label>
                  </div>
                </div>
                <div class="col-12">
                  <label class="vd-label">Observaciones:</label>
                  <textarea class="form-control" name="vd_observaciones" rows="5"></textarea>
                </div>
              </div>
            </div>

            <div style="display:flex; align-items:center; justify-content:space-between; gap:12px; width:100%;">
              <button type="button" class="btn secondary" onclick="showTab('form4-tab')" style="flex:0 0 auto; white-space:nowrap;">
                ← Anterior
              </button>
              <!-- Descargar PDF -->
              <button class="btn" type="submit" name="mode" value="download" style="flex:0 0 auto; white-space:nowrap;">
                Generar PDF
              </button>
              <!-- Abrir inline en nueva pestaña para imprimir -->
              <button class="btn" type="submit" name="mode" value="print" formtarget="_blank" style="flex:0 0 auto; white-space:nowrap;">
                Imprimir PDF
              </button>
              <button type="button" class="btn" onclick="showTab('form6-tab')" style="flex:0 0 auto; white-space:nowrap;">
                Siguiente →
              </button>
            </div>
          </form>
        </div>
      </section>
    </div>

    <!-- Formulario 6: Revisión y Envío -->
    <div class="tab-pane fade" id="form6" role="tabpanel" aria-labelledby="form6-tab">
      <section class="card">
        <header>
          <h2>✅ Revisión Final</h2>
        </header>
        <div>
          <!-- ================== Verificación Diseño e Impresión 3D ================== -->
          <form method="POST" action="routes/estres.php" id="v3d-form" class="mb-4">
            <input type="hidden" name="action" value="generate_verificacion_3d">
            <input type="hidden" name="advance_code" value="1">
            <input type="hidden" name="reset_code" value="0">


            <!-- ============== Info general ============== -->
            <div class="v3d-block">
              <div class="v3d-title">Información general</div>
              <div class="row g-3">
                <div class="col-12 col-md-6 col-lg-4">
                  <label class="v3d-label">Fecha:</label>
                  <input class="form-control" type="date" name="v3d_fecha" id="v3d_fecha">
                </div>
              </div>
            </div>

            <!-- ============== Sección A: Diseño 3D ============== -->
            <div class="v3d-block">
              <div class="v3d-title">Verificación del diseño de pieza 3D</div>
              <table class="v3d-matrix">
                <thead>
                  <tr>
                    <th class="v3d-num">No</th>
                    <th>Ítem a verificar</th>
                    <th class="v3d-si">SI</th>
                    <th class="v3d-no">NO</th>
                    <th class="v3d-na">N/A</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="v3d-num">1.1</td>
                    <td>Se modeló la pieza en el software de diseño 3D</td>
                    <td class="v3d-si"><input type="radio" name="v3d_i_1_1" value="SI"></td>
                    <td class="v3d-no"><input type="radio" name="v3d_i_1_1" value="NO"></td>
                    <td class="v3d-na"><input type="radio" name="v3d_i_1_1" value="NA"></td>
                  </tr>
                  <tr>
                    <td class="v3d-num">1.2</td>
                    <td>El diseño se verificó contra los requerimientos establecidos</td>
                    <td class="v3d-si"><input type="radio" name="v3d_i_1_2" value="SI"></td>
                    <td class="v3d-no"><input type="radio" name="v3d_i_1_2" value="NO"></td>
                    <td class="v3d-na"><input type="radio" name="v3d_i_1_2" value="NA"></td>
                  </tr>
                  <tr>
                    <td class="v3d-num">1.3</td>
                    <td>Se verificó la geometría, tolerancias y compatibilidad para la impresión</td>
                    <td class="v3d-si"><input type="radio" name="v3d_i_1_3" value="SI"></td>
                    <td class="v3d-no"><input type="radio" name="v3d_i_1_3" value="NO"></td>
                    <td class="v3d-na"><input type="radio" name="v3d_i_1_3" value="NA"></td>
                  </tr>
                  <tr>
                    <td class="v3d-num">1.4</td>
                    <td>Se exportó el diseño al formato adecuado (STL/OBJ)</td>
                    <td class="v3d-si"><input type="radio" name="v3d_i_1_4" value="SI"></td>
                    <td class="v3d-no"><input type="radio" name="v3d_i_1_4" value="NO"></td>
                    <td class="v3d-na"><input type="radio" name="v3d_i_1_4" value="NA"></td>
                  </tr>
                  <tr>
                    <td class="v3d-num">1.5</td>
                    <td>Se validó el diseño con el cliente o se aclararon requisitos</td>
                    <td class="v3d-si"><input type="radio" name="v3d_i_1_5" value="SI"></td>
                    <td class="v3d-no"><input type="radio" name="v3d_i_1_5" value="NO"></td>
                    <td class="v3d-na"><input type="radio" name="v3d_i_1_5" value="NA"></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- ============== Sección B: Impresión 3D ============== -->
            <div class="v3d-block">
              <div class="v3d-title">Verificación de la impresión de pieza 3D</div>
              <table class="v3d-matrix">
                <thead>
                  <tr>
                    <th class="v3d-num">No</th>
                    <th>Ítem a verificar</th>
                    <th class="v3d-si">SI</th>
                    <th class="v3d-no">NO</th>
                    <th class="v3d-na">N/A</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="v3d-num">1.6</td>
                    <td>El diseño está en el formato adecuado para la impresión</td>
                    <td class="v3d-si"><input type="radio" name="v3d_i_1_6" value="SI"></td>
                    <td class="v3d-no"><input type="radio" name="v3d_i_1_6" value="NO"></td>
                    <td class="v3d-na"><input type="radio" name="v3d_i_1_6" value="NA"></td>
                  </tr>
                  <tr>
                    <td class="v3d-num">1.7</td>
                    <td>Se especificó el material de preferencia para la impresión</td>
                    <td class="v3d-si"><input type="radio" name="v3d_i_1_7" value="SI"></td>
                    <td class="v3d-no"><input type="radio" name="v3d_i_1_7" value="NO"></td>
                    <td class="v3d-na"><input type="radio" name="v3d_i_1_7" value="NA"></td>
                  </tr>
                  <tr>
                    <td class="v3d-num">1.8</td>
                    <td>Se ajustaron los parámetros de impresión (temperatura, velocidad, soporte)</td>
                    <td class="v3d-si"><input type="radio" name="v3d_i_1_8" value="SI"></td>
                    <td class="v3d-no"><input type="radio" name="v3d_i_1_8" value="NO"></td>
                    <td class="v3d-na"><input type="radio" name="v3d_i_1_8" value="NA"></td>
                  </tr>
                  <tr>
                    <td class="v3d-num">1.9</td>
                    <td>La(s) impresora(s) está(n) calibrada(s) correctamente</td>
                    <td class="v3d-si"><input type="radio" name="v3d_i_1_9" value="SI"></td>
                    <td class="v3d-no"><input type="radio" name="v3d_i_1_9" value="NO"></td>
                    <td class="v3d-na"><input type="radio" name="v3d_i_1_9" value="NA"></td>
                  </tr>
                  <tr>
                    <td class="v3d-num">1.10</td>
                    <td>Se registraron tiempos y condiciones de impresión</td>
                    <td class="v3d-si"><input type="radio" name="v3d_i_1_10" value="SI"></td>
                    <td class="v3d-no"><input type="radio" name="v3d_i_1_10" value="NO"></td>
                    <td class="v3d-na"><input type="radio" name="v3d_i_1_10" value="NA"></td>
                  </tr>
                  <tr>
                    <td class="v3d-num">1.11</td>
                    <td>La pieza impresa cumple con dimensiones y especificaciones solicitadas</td>
                    <td class="v3d-si"><input type="radio" name="v3d_i_1_11" value="SI"></td>
                    <td class="v3d-no"><input type="radio" name="v3d_i_1_11" value="NO"></td>
                    <td class="v3d-na"><input type="radio" name="v3d_i_1_11" value="NA"></td>
                  </tr>
                  <tr>
                    <td class="v3d-num">1.12</td>
                    <td>Se realizó prueba de ensamble</td>
                    <td class="v3d-si"><input type="radio" name="v3d_i_1_12" value="SI"></td>
                    <td class="v3d-no"><input type="radio" name="v3d_i_1_12" value="NO"></td>
                    <td class="v3d-na"><input type="radio" name="v3d_i_1_12" value="NA"></td>
                  </tr>
                  <tr>
                    <td class="v3d-num">1.13</td>
                    <td>Es necesario repetir la impresión</td>
                    <td class="v3d-si"><input type="radio" name="v3d_i_1_13" value="SI"></td>
                    <td class="v3d-no"><input type="radio" name="v3d_i_1_13" value="NO"></td>
                    <td class="v3d-na"><input type="radio" name="v3d_i_1_13" value="NA"></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- ============== Aprobación y Observaciones ============== -->
            <div class="v3d-block">
              <div class="row g-3">
                <div class="col-12 col-md-6">
                  <label class="v3d-label d-block">Aprobado:</label>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="v3d_aprobado" id="v3d_aprobado_si" value="SI">
                    <label class="form-check-label" for="v3d_aprobado_si">SI</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="v3d_aprobado" id="v3d_aprobado_no" value="NO">
                    <label class="form-check-label" for="v3d_aprobado_no">NO</label>
                  </div>
                </div>
                <div class="col-12">
                  <label class="v3d-label">Observaciones:</label>
                  <textarea class="form-control" name="v3d_observaciones" rows="5"></textarea>
                </div>
              </div>
            </div>

            <!-- ============== Firmas ============== -->
            <div class="v3d-block">
              <div class="row g-3">
                <div class="col-12 col-md-6">
                  <label class="v3d-label">Elaboró:</label>
                  <input class="form-control" name="v3d_elaboro" id="v3d_elaboro">
                </div>
                <div class="col-12 col-md-6">
                  <label class="v3d-label">Aprobó:</label>
                  <input class="form-control" name="v3d_aprobo" id="v3d_aprobo">
                </div>
              </div>
            </div>
            <div style="display:flex; align-items:center; justify-content:space-between; gap:12px; width:100%;">
              <button type="button" class="btn secondary" onclick="showTab('form5-tab')" style="flex:0 0 auto; white-space:nowrap;">
                ← Anterior
              </button>
              <!-- Descargar PDF -->
              <button class="btn" type="submit" name="mode" value="download" style="flex:0 0 auto; white-space:nowrap;">
                Generar PDF
              </button>
              <!-- Abrir PDF en el navegador (para imprimir) -->
              <button class="btn" type="submit" name="mode" value="print" formtarget="_blank" style="flex:0 0 auto; white-space:nowrap;">
                Imprimir PDF
              </button>
              <button type="button" class="btn" onclick="showTab('form7-tab')" style="flex:0 0 auto; white-space:nowrap;">
                Siguiente →
              </button>
            </div>
          </form>
        </div>
      </section>
    </div>

    <!-- Formulario 7: Revisión y Envío -->
    <div class="tab-pane fade" id="form7" role="tabpanel" aria-labelledby="form7-tab">
      <section class="card">
        <header>
          <h2>✅ Revisión Final</h2>
        </header>
        <div>
          <!-- ===== Continuidad de Tarjeta (CT) ===== -->
          <form id="ct-form" class="ct-wrap" method="POST" action="routes/estres.php">
            <input type="hidden" name="action" value="generate_continuidad">
            <input type="hidden" name="advance_code" value="1">
            <input type="hidden" name="reset_code" value="0">

            <!-- Encabezado -->
            <div class="ct-card ct-grid" style="margin-bottom:1rem">
              <div class="ct-title">Información general</div>
              <div class="ct-row">
                <div>
                  <label class="ct-label">Fecha</label>
                  <input class="form-control" type="date" name="ct_fecha" id="ct_fecha">
                </div>

              </div>

              <div class="ct-row">
                <div>
                  <label class="ct-label">Identificador único de la tarjeta de circuito impreso</label>
                  <input class="form-control" type="text" name="ct_identificador" id="ct_identificador" placeholder="Ej. PCB-XYZ-001">
                </div>
                <div>
                  <label class="ct-label">Método de prueba</label>
                  <input class="form-control" type="text" name="ct_metodo" id="ct_metodo" placeholder="Ej. Continuidad con multímetro">
                </div>
              </div>

              <div>
                <label class="ct-label">Responsable de realizar la prueba</label>
                <input class="form-control" type="text" name="ct_responsable" id="ct_responsable" placeholder="Nombre del responsable">
              </div>
            </div>

            <!-- Tabla de continuidad -->
            <div class="ct-card">
              <div class="ct-title">Continuidad</div>
              <div class="ct-table-wrap">
                <table class="ct-table">
                  <thead>
                    <tr>
                      <th colspan="2">Desde</th>
                      <th colspan="2">Hasta</th>
                      <th colspan="2">Continuidad</th>
                      <th rowspan="2">Observaciones</th>
                    </tr>
                    <tr>
                      <th>Componente</th>
                      <th>Pin</th>
                      <th>Componente</th>
                      <th>Pin</th>
                      <th class="ct-center">Sí</th>
                      <th class="ct-center">No</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Fila 1 -->
                    <tr>
                      <td><input type="text" name="ct_rows[0][desde_comp]" /></td>
                      <td><input type="text" name="ct_rows[0][desde_pin]" /></td>
                      <td><input type="text" name="ct_rows[0][hasta_comp]" /></td>
                      <td><input type="text" name="ct_rows[0][hasta_pin]" /></td>
                      <td class="ct-center"><input type="radio" name="ct_rows[0][cont]" value="SI"></td>
                      <td class="ct-center"><input type="radio" name="ct_rows[0][cont]" value="NO"></td>
                      <td><input type="text" name="ct_rows[0][obs]" /></td>
                    </tr>
                    <!-- Fila 2 -->
                    <tr>
                      <td><input type="text" name="ct_rows[1][desde_comp]" /></td>
                      <td><input type="text" name="ct_rows[1][desde_pin]" /></td>
                      <td><input type="text" name="ct_rows[1][hasta_comp]" /></td>
                      <td><input type="text" name="ct_rows[1][hasta_pin]" /></td>
                      <td class="ct-center"><input type="radio" name="ct_rows[1][cont]" value="SI"></td>
                      <td class="ct-center"><input type="radio" name="ct_rows[1][cont]" value="NO"></td>
                      <td><input type="text" name="ct_rows[1][obs]" /></td>
                    </tr>
                    <!-- Fila 3 -->
                    <tr>
                      <td><input type="text" name="ct_rows[2][desde_comp]" /></td>
                      <td><input type="text" name="ct_rows[2][desde_pin]" /></td>
                      <td><input type="text" name="ct_rows[2][hasta_comp]" /></td>
                      <td><input type="text" name="ct_rows[2][hasta_pin]" /></td>
                      <td class="ct-center"><input type="radio" name="ct_rows[2][cont]" value="SI"></td>
                      <td class="ct-center"><input type="radio" name="ct_rows[2][cont]" value="NO"></td>
                      <td><input type="text" name="ct_rows[2][obs]" /></td>
                    </tr>
                    <!-- Fila 4 -->
                    <tr>
                      <td><input type="text" name="ct_rows[3][desde_comp]" /></td>
                      <td><input type="text" name="ct_rows[3][desde_pin]" /></td>
                      <td><input type="text" name="ct_rows[3][hasta_comp]" /></td>
                      <td><input type="text" name="ct_rows[3][hasta_pin]" /></td>
                      <td class="ct-center"><input type="radio" name="ct_rows[3][cont]" value="SI"></td>
                      <td class="ct-center"><input type="radio" name="ct_rows[3][cont]" value="NO"></td>
                      <td><input type="text" name="ct_rows[3][obs]" /></td>
                    </tr>
                    <!-- Fila 5 -->
                    <tr>
                      <td><input type="text" name="ct_rows[4][desde_comp]" /></td>
                      <td><input type="text" name="ct_rows[4][desde_pin]" /></td>
                      <td><input type="text" name="ct_rows[4][hasta_comp]" /></td>
                      <td><input type="text" name="ct_rows[4][hasta_pin]" /></td>
                      <td class="ct-center"><input type="radio" name="ct_rows[4][cont]" value="SI"></td>
                      <td class="ct-center"><input type="radio" name="ct_rows[4][cont]" value="NO"></td>
                      <td><input type="text" name="ct_rows[4][obs]" /></td>
                    </tr>
                    <!-- Fila 6 -->
                    <tr>
                      <td><input type="text" name="ct_rows[5][desde_comp]" /></td>
                      <td><input type="text" name="ct_rows[5][desde_pin]" /></td>
                      <td><input type="text" name="ct_rows[5][hasta_comp]" /></td>
                      <td><input type="text" name="ct_rows[5][hasta_pin]" /></td>
                      <td class="ct-center"><input type="radio" name="ct_rows[5][cont]" value="SI"></td>
                      <td class="ct-center"><input type="radio" name="ct_rows[5][cont]" value="NO"></td>
                      <td><input type="text" name="ct_rows[5][obs]" /></td>
                    </tr>
                    <!-- Fila 7 -->
                    <tr>
                      <td><input type="text" name="ct_rows[6][desde_comp]" /></td>
                      <td><input type="text" name="ct_rows[6][desde_pin]" /></td>
                      <td><input type="text" name="ct_rows[6][hasta_comp]" /></td>
                      <td><input type="text" name="ct_rows[6][hasta_pin]" /></td>
                      <td class="ct-center"><input type="radio" name="ct_rows[6][cont]" value="SI"></td>
                      <td class="ct-center"><input type="radio" name="ct_rows[6][cont]" value="NO"></td>
                      <td><input type="text" name="ct_rows[6][obs]" /></td>
                    </tr>
                    <!-- Fila 8 -->
                    <tr>
                      <td><input type="text" name="ct_rows[7][desde_comp]" /></td>
                      <td><input type="text" name="ct_rows[7][desde_pin]" /></td>
                      <td><input type="text" name="ct_rows[7][hasta_comp]" /></td>
                      <td><input type="text" name="ct_rows[7][hasta_pin]" /></td>
                      <td class="ct-center"><input type="radio" name="ct_rows[7][cont]" value="SI"></td>
                      <td class="ct-center"><input type="radio" name="ct_rows[7][cont]" value="NO"></td>
                      <td><input type="text" name="ct_rows[7][obs]" /></td>
                    </tr>
                    <!-- Fila 9 -->
                    <tr>
                      <td><input type="text" name="ct_rows[8][desde_comp]" /></td>
                      <td><input type="text" name="ct_rows[8][desde_pin]" /></td>
                      <td><input type="text" name="ct_rows[8][hasta_comp]" /></td>
                      <td><input type="text" name="ct_rows[8][hasta_pin]" /></td>
                      <td class="ct-center"><input type="radio" name="ct_rows[8][cont]" value="SI"></td>
                      <td class="ct-center"><input type="radio" name="ct_rows[8][cont]" value="NO"></td>
                      <td><input type="text" name="ct_rows[8][obs]" /></td>
                    </tr>
                    <!-- Fila 10 -->
                    <tr>
                      <td><input type="text" name="ct_rows[9][desde_comp]" /></td>
                      <td><input type="text" name="ct_rows[9][desde_pin]" /></td>
                      <td><input type="text" name="ct_rows[9][hasta_comp]" /></td>
                      <td><input type="text" name="ct_rows[9][hasta_pin]" /></td>
                      <td class="ct-center"><input type="radio" name="ct_rows[9][cont]" value="SI"></td>
                      <td class="ct-center"><input type="radio" name="ct_rows[9][cont]" value="NO"></td>
                      <td><input type="text" name="ct_rows[9][obs]" /></td>
                    </tr>
                    <!-- Fila 11 -->
                    <tr>
                      <td><input type="text" name="ct_rows[10][desde_comp]" /></td>
                      <td><input type="text" name="ct_rows[10][desde_pin]" /></td>
                      <td><input type="text" name="ct_rows[10][hasta_comp]" /></td>
                      <td><input type="text" name="ct_rows[10][hasta_pin]" /></td>
                      <td class="ct-center"><input type="radio" name="ct_rows[10][cont]" value="SI"></td>
                      <td class="ct-center"><input type="radio" name="ct_rows[10][cont]" value="NO"></td>
                      <td><input type="text" name="ct_rows[10][obs]" /></td>
                    </tr>
                    <!-- Fila 12 -->
                    <tr>
                      <td><input type="text" name="ct_rows[11][desde_comp]" /></td>
                      <td><input type="text" name="ct_rows[11][desde_pin]" /></td>
                      <td><input type="text" name="ct_rows[11][hasta_comp]" /></td>
                      <td><input type="text" name="ct_rows[11][hasta_pin]" /></td>
                      <td class="ct-center"><input type="radio" name="ct_rows[11][cont]" value="SI"></td>
                      <td class="ct-center"><input type="radio" name="ct_rows[11][cont]" value="NO"></td>
                      <td><input type="text" name="ct_rows[11][obs]" /></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="ct-muted" style="margin-top:.5rem">* Agrega más filas duplicando las últimas si lo necesitas.</div>
            </div>

            <!-- Aprobado + Recomendaciones -->
            <div class="ct-card ct-grid" style="margin-top:1rem">
              <div class="ct-3col">
                <div>
                  <label class="ct-label d-block">Aprobado</label>
                  <div class="ct-inline-checks">
                    <label><input type="radio" name="ct_aprobado" value="SI"> Sí</label>
                    <label><input type="radio" name="ct_aprobado" value="NO"> No</label>
                  </div>
                </div>
              </div>

              <div>
                <label class="ct-label">Recomendaciones para ser aprobado</label>
                <textarea class="form-control" name="ct_recomendaciones" rows="5" placeholder="Escriba las recomendaciones..."></textarea>
              </div>

              <div>
                <label class="ct-label">Responsable de la gestión del laboratorio</label>
                <input class="form-control" type="text" name="ct_responsable_gestion" placeholder="Nombre y apellido">
              </div>
            </div>
            <div style="display:flex; align-items:center; justify-content:space-between; gap:12px; width:100%;">
              <button type="button" class="btn secondary" onclick="showTab('form6-tab')" style="flex:0 0 auto; white-space:nowrap;">
                ← Anterior
              </button>
              <!-- Descargar -->
              <button class="btn" type="submit" name="mode" value="download" style="flex:0 0 auto; white-space:nowrap;">
                Generar PDF
              </button>
              <!-- Imprimir -->
              <button class="btn" type="submit" name="mode" value="print" formtarget="_blank" style="flex:0 0 auto; white-space:nowrap;">
                Imprimir PDF
              </button>
              <button type="button" class="btn" onclick="showTab('form8-tab')" style="flex:0 0 auto; white-space:nowrap;">
                Siguiente →
              </button>
            </div>
          </form>
        </div>
      </section>
    </div>

    <!-- Formulario 8: Revisión y Envío -->
    <div class="tab-pane fade" id="form8" role="tabpanel" aria-labelledby="form8-tab">
      <section class="card">
        <header>
          <h2>✅ Revisión Final</h2>
        </header>
        <div>
          <!-- ========= Informe de Servicio (HTML + CSS) ========= -->
          <form method="POST" action="routes/estres.php" id="isv-form" class="mb-4" enctype="multipart/form-data">
            <input type="hidden" name="action" value="generate_informe_servicio">
            <input type="hidden" name="advance_code" value="1">
            <input type="hidden" name="reset_code" value="0">


            <!-- Encabezado -->
            <div class="isv-block">
              <div class="isv-row">
                <div>
                  <label class="isv-label" for="isv_fecha">Fecha de Emisión del Informe</label>
                  <input class="form-control isv-field" type="date" id="isv_fecha" name="isv_fecha">
                </div>
              </div>
            </div>

            <!-- Servicio -->
            <div class="isv-block">
              <div class="isv-title">Servicio</div>
              <div class="isv-service">
                <label class="isv-check">
                  <input type="checkbox" name="isv_servicio[diseno_pcb]">
                  <span>Diseño de tarjetas de circuito impreso</span>
                </label>
                <label class="isv-check">
                  <input type="checkbox" name="isv_servicio[fabricacion_pcb]">
                  <span>Fabricación de tarjetas de circuito impreso</span>
                </label>
                <label class="isv-check">
                  <input type="checkbox" name="isv_servicio[diseno_3d]">
                  <span>Diseño de piezas 3D</span>
                </label>
                <label class="isv-check">
                  <input type="checkbox" name="isv_servicio[impresion_3d]">
                  <span>Impresión de piezas 3D</span>
                </label>
                <label class="isv-check">
                  <input type="checkbox" name="isv_servicio[montaje]">
                  <span>Montaje de componentes electrónicos</span>
                </label>
                <label class="isv-check">
                  <input type="checkbox" name="isv_servicio[transferencia]">
                  <span>Transferencia de conocimientos y/o tecnologías</span>
                </label>
                <label class="isv-check">
                  <input type="checkbox" name="isv_servicio[integracion]">
                  <span>Fabricación o integración de soluciones tecnológicas</span>
                </label>
              </div>
            </div>

            <!-- Resultados -->
            <div class="isv-block">
              <label class="isv-label" for="isv_resultados">Resultados Obtenidos</label>

              <!-- Subida de imágenes -->
              <div class="mt-2">
                <label class="isv-label d-block" for="isv_resultados_img">Agregar imágenes:</label>
                <input class="form-control"
                  type="file"
                  id="isv_resultados_img"
                  name="isv_resultados_img[]"
                  accept=".jpg,.jpeg,.png,.gif,.webp"
                  multiple>
                <small class="text-muted">Puedes subir una o varias imágenes (formatos: JPG, PNG, etc.).</small>
              </div>
              <!-- Observaciones -->
              <div class="isv-block">
                <label class="isv-label" for="isv_obs">Observaciones</label>
                <textarea class="form-control isv-area-obsv" id="isv_obs" name="isv_obs"
                  placeholder="Observaciones adicionales, notas, restricciones…"></textarea>
              </div>

              <!-- Botones -->
              <div style="display:flex; align-items:center; justify-content:space-between; gap:12px; width:100%;">
                <button type="button" class="btn secondary" onclick="showTab('form7-tab')" style="flex:0 0 auto; white-space:nowrap;">
                  ← Anterior
                </button>
                <!-- Descargar PDF -->
                <button class="btn" type="submit" name="isv_mode" value="download" style="flex:0 0 auto; white-space:nowrap;">
                  Generar PDF
                </button>
                <!-- Abrir PDF en el navegador (ideal para imprimir) -->
                <button class="btn" type="submit" name="isv_mode" value="print" formtarget="_blank" style="flex:0 0 auto; white-space:nowrap;">
                  Imprimir PDF
                </button>
                <button type="button" class="btn" onclick="showTab('form9-tab')" style="flex:0 0 auto; white-space:nowrap;">
                  Siguiente →
                </button>
              </div>

          </form>
        </div>
      </section>
    </div>

    <!-- Formulario 9: Revisión y Envío -->
    <div class="tab-pane fade" id="form9" role="tabpanel" aria-labelledby="form9-tab">
      <section class="card">
        <header>
          <h2>✅ Revisión Final</h2>
        </header>
        <div>
          <!-- ========= Encuesta de Satisfacción del Cliente ========= -->
          <form method="POST" action="routes/estres.php" id="esc-form" class="mb-4">
            <input type="hidden" name="action" value="generate_satisfaccion">

            <!-- Servicio -->
            <div class="esc-block">
              <div class="esc-title">Servicio</div>
              <div class="esc-checks">
                <label class="esc-check"><input type="checkbox" name="esc_servicio[diseno_pcb]">Diseño de tarjetas de circuito impreso</label>
                <label class="esc-check"><input type="checkbox" name="esc_servicio[fabricacion_pcb]">Fabricación de tarjetas de circuito impreso</label>
                <label class="esc-check"><input type="checkbox" name="esc_servicio[diseno_3d]">Diseño de piezas 3D</label>
                <label class="esc-check"><input type="checkbox" name="esc_servicio[impresion_3d]">Impresión de piezas 3D</label>
                <label class="esc-check"><input type="checkbox" name="esc_servicio[montaje]">Montaje de componentes electrónicos</label>
                <label class="esc-check"><input type="checkbox" name="esc_servicio[transferencia]">Transferencia de conocimientos y/o tecnologías</label>
                <label class="esc-check"><input type="checkbox" name="esc_servicio[integracion]">Fabricación o integración de soluciones tecnológicas</label>
              </div>
            </div>

            <!-- Instalaciones y Fecha -->
            <div class="esc-block esc-row">
              <div>
                <label class="esc-label">Instalaciones:</label>
                <select class="form-select" name="esc_instalacion">
                  <option value="Laboratorio">Laboratorio</option>
                  <option value="Ambiente de formación">Ambiente de formación</option>
                  <option value="Otro">Otro</option>
                </select>
              </div>
              <div>
                <label class="esc-label">Fecha:</label>
                <input type="date" class="form-control" name="esc_fecha">
              </div>
            </div>

            <!-- Tipo de Cliente -->
            <div class="esc-block">
              <label class="esc-label">Tipo de Cliente</label>
              <div class="esc-checks">
                <label class="esc-check"><input type="radio" name="esc_tipo_cliente" value="Aprendiz">Aprendiz</label>
                <label class="esc-check"><input type="radio" name="esc_tipo_cliente" value="Emprendedor">Emprendedor</label>
                <label class="esc-check"><input type="radio" name="esc_tipo_cliente" value="Persona natural">Persona natural</label>
                <label class="esc-check"><input type="radio" name="esc_tipo_cliente" value="Persona jurídica">Persona jurídica</label>
                <label class="esc-check"><input type="radio" name="esc_tipo_cliente" value="Proyectos I+D+i">Proyectos I+D+i</label>
                <label class="esc-check"><input type="radio" name="esc_tipo_cliente" value="Otro">Otro</label>
              </div>
            </div>

            <!-- Datos del cliente -->
            <div class="esc-block esc-row">
              <div>
                <label class="esc-label">Nombre del cliente/empresa</label>
                <input type="text" class="form-control" name="esc_cliente">
              </div>
              <div>
                <label class="esc-label">Teléfono</label>
                <input type="text" class="form-control" name="esc_telefono">
              </div>
            </div>

            <div class="esc-block">
              <label class="esc-label">Dirección</label>
              <input type="text" class="form-control" name="esc_direccion">
            </div>

            <!-- Evaluación de Satisfacción -->
            <div class="esc-block">
              <div class="esc-title">Evaluación de Satisfacción del Cliente</div>

              <!-- Primera tabla de evaluación -->
              <table class="esc-table">
                <thead>
                  <tr>
                    <th>Categoría</th>
                    <th>Pregunta</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Personal</td>
                    <td>¿Nuestro personal efectuó el trabajo a su satisfacción?</td>
                    <td><input type="radio" name="esc_eval_personal" value="1"></td>
                    <td><input type="radio" name="esc_eval_personal" value="2"></td>
                    <td><input type="radio" name="esc_eval_personal" value="3"></td>
                    <td><input type="radio" name="esc_eval_personal" value="4"></td>
                    <td><input type="radio" name="esc_eval_personal" value="5"></td>
                  </tr>
                  <tr>
                    <td>Equipo</td>
                    <td>¿Considera que las instalaciones y equipos aportaron al desarrollo del producto y/o servicio?</td>
                    <td><input type="radio" name="esc_eval_equipo" value="1"></td>
                    <td><input type="radio" name="esc_eval_equipo" value="2"></td>
                    <td><input type="radio" name="esc_eval_equipo" value="3"></td>
                    <td><input type="radio" name="esc_eval_equipo" value="4"></td>
                    <td><input type="radio" name="esc_eval_equipo" value="5"></td>
                  </tr>
                  <tr>
                    <td>Diseño</td>
                    <td>¿Se efectuó el trabajo acorde a lo estipulado y lo que previamente se acordó?</td>
                    <td><input type="radio" name="esc_eval_diseno" value="1"></td>
                    <td><input type="radio" name="esc_eval_diseno" value="2"></td>
                    <td><input type="radio" name="esc_eval_diseno" value="3"></td>
                    <td><input type="radio" name="esc_eval_diseno" value="4"></td>
                    <td><input type="radio" name="esc_eval_diseno" value="5"></td>
                  </tr>
                  <tr>
                    <td>Producto y seguridad</td>
                    <td>¿Nuestro producto y/o servicio son lo que usted esperaba?</td>
                    <td><input type="radio" name="esc_eval_producto" value="1"></td>
                    <td><input type="radio" name="esc_eval_producto" value="2"></td>
                    <td><input type="radio" name="esc_eval_producto" value="3"></td>
                    <td><input type="radio" name="esc_eval_producto" value="4"></td>
                    <td><input type="radio" name="esc_eval_producto" value="5"></td>
                  </tr>
                  <tr>
                    <td>Salud y seguridad</td>
                    <td>¿Nos desempeñamos de forma cuidadosa y segura?</td>
                    <td><input type="radio" name="esc_eval_seguridad" value="1"></td>
                    <td><input type="radio" name="esc_eval_seguridad" value="2"></td>
                    <td><input type="radio" name="esc_eval_seguridad" value="3"></td>
                    <td><input type="radio" name="esc_eval_seguridad" value="4"></td>
                    <td><input type="radio" name="esc_eval_seguridad" value="5"></td>
                  </tr>
                </tbody>
              </table>

              <!-- Segunda tabla de evaluación -->
              <table class="esc-table mt-3">
                <thead>
                  <tr>
                    <th>Aspecto</th>
                    <th>Pregunta</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Medio ambiente</td>
                    <td>¿Nos comportamos de manera respetuosa con el medio ambiente?</td>
                    <td><input type="radio" name="esc_eval_medio" value="1"></td>
                    <td><input type="radio" name="esc_eval_medio" value="2"></td>
                    <td><input type="radio" name="esc_eval_medio" value="3"></td>
                    <td><input type="radio" name="esc_eval_medio" value="4"></td>
                    <td><input type="radio" name="esc_eval_medio" value="5"></td>
                  </tr>
                  <tr>
                    <td>Puntualidad</td>
                    <td>¿Se realizó el trabajo puntualmente?</td>
                    <td><input type="radio" name="esc_eval_puntualidad" value="1"></td>
                    <td><input type="radio" name="esc_eval_puntualidad" value="2"></td>
                    <td><input type="radio" name="esc_eval_puntualidad" value="3"></td>
                    <td><input type="radio" name="esc_eval_puntualidad" value="4"></td>
                    <td><input type="radio" name="esc_eval_puntualidad" value="5"></td>
                  </tr>
                  <tr>
                    <td>Comunicación</td>
                    <td>¿Nuestro personal se comunicó adecuadamente durante el proceso?</td>
                    <td><input type="radio" name="esc_eval_comunicacion" value="1"></td>
                    <td><input type="radio" name="esc_eval_comunicacion" value="2"></td>
                    <td><input type="radio" name="esc_eval_comunicacion" value="3"></td>
                    <td><input type="radio" name="esc_eval_comunicacion" value="4"></td>
                    <td><input type="radio" name="esc_eval_comunicacion" value="5"></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Mejoramiento y Comentarios -->
            <div class="esc-block">
              <label class="esc-label">¿Qué podríamos hacer para mejorar el servicio?</label>
              <textarea class="form-control esc-textarea" name="esc_mejoramiento"></textarea>
            </div>

            <div class="esc-block">
              <label class="esc-label">Comentarios adicionales</label>
              <textarea class="form-control esc-textarea" name="esc_comentario"></textarea>
            </div>

            <!-- Botones de navegación -->
            <div class="d-flex align-items-center justify-content-between gap-3 w-100">
              <button type="button" class="btn btn-secondary" onclick="showTab('form8-tab')" style="flex: 0 0 auto; white-space: nowrap;">
                ← Anterior
              </button>
              <!-- Descargar PDF -->
              <button class="btn btn-primary" type="submit" name="mode" value="download" style="flex: 0 0 auto; white-space: nowrap;">
                Generar PDF
              </button>
              <!-- Abrir PDF en nueva pestaña (para imprimir) -->
              <button class="btn btn-primary" type="submit" name="mode" value="print" formtarget="_blank" style="flex: 0 0 auto; white-space: nowrap;">
                Imprimir PDF
              </button>
            </div>

          </form>
        </div>
      </section>
    </div>
  </div>
</div>

<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2): ?>
  <div class="container my-5">
    <div class="d-flex justify-content-center mt-4">
      <button type="button" class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#modalResetCorrelativos">
        <i class="fas fa-sync-alt me-2"></i>Reiniciar Correlativos
      </button>
    </div>
  </div>

  <div class="modal fade modal-reset-correlativos " id="modalResetCorrelativos" tabindex="-1" aria-labelledby="modalResetCorrelativosLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalResetCorrelativosLabel">
            <i class="fas fa-sync-alt"></i> Reiniciar Correlativos
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="admin-badge">
            <i class="fas fa-shield-alt"></i> Solo administradores
          </div>

          <p class="intro-text">Selecciona los formularios a reiniciar o usa la opción "Todos". El nuevo valor se aplicará a los correlativos seleccionados.</p>

          <div class="value-input-container">
            <label>Nuevo valor inicial:</label>
            <div class="value-input-wrapper">
              <input type="number" name="modal_set_to" class="form-control" value="0" min="0">
              <small>0 = siguiente número será 001</small>
            </div>
          </div>

          <div class="selection-header mt-4">
            <div class="form-check-all">
              <input class="form-check-input" type="checkbox" id="modal-chk-all">
              <label class="form-check-label" for="modal-chk-all">Seleccionar todos</label>
            </div>
            <span class="selected-count" id="selected-count">0 seleccionados</span>
          </div>

          <div class="counters-grid mt-4" id="modal-counters-list">
            <div class="counter-item">
              <label class="form-check">
                <input class="form-check-input modal-counter-chk" type="checkbox" name="modal_selected[]" value="form1_solicitud">
                <span class="form-check-label">F1 – Solicitud</span>
              </label>
            </div>
            <div class="counter-item">
              <label class="form-check">
                <input class="form-check-input modal-counter-chk" type="checkbox" name="modal_selected[]" value="form2_evaluacion">
                <span class="form-check-label">F2 – Evaluación técnica</span>
              </label>
            </div>
            <div class="counter-item">
              <label class="form-check">
                <input class="form-check-input modal-counter-chk" type="checkbox" name="modal_selected[]" value="form3_cotizacion">
                <span class="form-check-label">F3 – Cotización</span>
              </label>
            </div>
            <div class="counter-item">
              <label class="form-check">
                <input class="form-check-input modal-counter-chk" type="checkbox" name="modal_selected[]" value="form4_orden_trabajo">
                <span class="form-check-label">F4 – Orden de trabajo</span>
              </label>
            </div>
            <div class="counter-item">
              <label class="form-check">
                <input class="form-check-input modal-counter-chk" type="checkbox" name="modal_selected[]" value="form5_verificacion_pcb">
                <span class="form-check-label">F5 – Verificación PCB</span>
              </label>
            </div>
            <div class="counter-item">
              <label class="form-check">
                <input class="form-check-input modal-counter-chk" type="checkbox" name="modal_selected[]" value="form6_verificacion_3d">
                <span class="form-check-label">F6 – Verificación 3D</span>
              </label>
            </div>
            <div class="counter-item">
              <label class="form-check">
                <input class="form-check-input modal-counter-chk" type="checkbox" name="modal_selected[]" value="form7_continuidad_pcb">
                <span class="form-check-label">F7 – Continuidad PCB</span>
              </label>
            </div>
            <div class="counter-item">
              <label class="form-check">
                <input class="form-check-input modal-counter-chk" type="checkbox" name="modal_selected[]" value="form8_informe_servicio">
                <span class="form-check-label">F8 – Informe de servicio</span>
              </label>
            </div>
            <div class="counter-item">
              <label class="form-check">
                <input class="form-check-input modal-counter-chk" type="checkbox" name="modal_selected[]" value="form9_satisfaccion">
                <span class="form-check-label">F9 – Satisfacción</span>
              </label>
            </div>
          </div>

          <div class="result-container" id="modal-reset-result"></div>
        </div>
        <div class="modal-footer">
          <div class="modal-footer-actions">
            <button type="button" class="btn btn-modal btn-modal-cancel" data-bs-dismiss="modal">
              <i class="fas fa-times"></i> Cancelar
            </button>
            <button type="button" class="btn btn-modal btn-modal-reset" id="modal-btn-reset-selected">
              <i class="fas fa-sync"></i> Reiniciar seleccionados
            </button>
            <button type="button" class="btn btn-modal btn-modal-reset-all" id="modal-btn-reset-all">
              <i class="fas fa-exclamation-triangle"></i> Reiniciar TODOS
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<script>
  (function() {
    const ENDPOINT = 'routes/reset_counters.php';

    function bindResetModal(modal) {
      if (!modal || modal.dataset.bound) return; // evita doble binding
      modal.dataset.bound = '1';

      const $ = s => modal.querySelector(s);
      const $$ = s => Array.from(modal.querySelectorAll(s));

      const chkAll = $('#modal-chk-all');
      const setToInput = $('input[name="modal_set_to"]');
      const resultBox = $('#modal-reset-result');
      const selectedCount = $('#selected-count');
      const btnSelected = $('#modal-btn-reset-selected');
      const btnAll = $('#modal-btn-reset-all');
      const checkboxes = () => $$('.modal-counter-chk');

      function showResult(msg, type = 'info') {
        if (!resultBox) return;
        resultBox.className = 'result-container';
        resultBox.style.display = 'block';
        resultBox.textContent = msg;
        if (type === 'error') resultBox.classList.add('result-error');
        else if (type === 'warning') resultBox.classList.add('result-warning');
        else resultBox.classList.add('result-success');
      }

      function setLoading(loading) {
        [btnSelected, btnAll].forEach(b => b && (b.disabled = loading));
        if (btnSelected) btnSelected.innerHTML = loading ?
          '<i class="fas fa-spinner fa-spin me-1"></i> Procesando...' :
          '<i class="fas fa-sync me-1"></i> Reiniciar seleccionados';
        if (btnAll) btnAll.innerHTML = loading ?
          '<i class="fas fa-spinner fa-spin me-1"></i> Procesando...' :
          '<i class="fas fa-exclamation-triangle me-1"></i> Reiniciar TODOS';
      }

      function updateCount() {
        const n = checkboxes().filter(cb => cb.checked).length;
        if (selectedCount) selectedCount.textContent = `${n} seleccionado(s)`;
        if (chkAll) chkAll.checked = n === checkboxes().length;
      }

      async function resetCounters({
        selected = [],
        all = false,
        setTo = 0
      }) {
        const n = parseInt(setTo, 10);
        if (!Number.isInteger(n) || n < 0) {
          showResult('El valor inicial debe ser un entero ≥ 0.', 'warning');
          return;
        }
        if (!all && selected.length === 0) {
          showResult('Selecciona al menos un formulario o usa "Reiniciar TODOS".', 'warning');
          return;
        }
        const msg = all ?
          `¿Reiniciar TODOS al valor ${n}?` :
          `¿Reiniciar ${selected.length} formulario(s) al valor ${n}?`;
        if (!confirm(msg)) return;

        setLoading(true);
        showResult('Procesando solicitud...', 'info');

        try {
          const res = await fetch(ENDPOINT, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            credentials: 'same-origin', // usa la sesión (rol)
            body: JSON.stringify({
              set_to: n,
              selected,
              all
            })
          });

          if (!res.ok) {
            const txt = await res.text();
            throw new Error(`HTTP ${res.status}: ${txt}`);
          }

          const data = await res.json();
          if (!data.ok) {
            throw new Error(data.message || 'Fallo en el reinicio');
          }

          const okCount = (data.results || []).filter(r => r.ok).length;
          showResult(all ?
            `✓ Reiniciados TODOS (ok=${okCount}).` :
            `✓ Reiniciados ${okCount} formulario(s).`, 'success');

        } catch (e) {
          showResult(`✗ Error: ${e.message}`, 'error');
        } finally {
          setLoading(false);
        }
      }

      // Listeners
      if (chkAll) chkAll.addEventListener('change', function() {
        checkboxes().forEach(cb => cb.checked = this.checked);
        updateCount();
      });
      checkboxes().forEach(cb => cb.addEventListener('change', updateCount));
      if (btnSelected) btnSelected.addEventListener('click', () => {
        const sel = checkboxes().filter(cb => cb.checked).map(cb => cb.value);
        resetCounters({
          selected: sel,
          all: false,
          setTo: setToInput ? setToInput.value : 0
        });
      });
      if (btnAll) btnAll.addEventListener('click', () => {
        resetCounters({
          all: true,
          setTo: setToInput ? setToInput.value : 0
        });
      });

      updateCount();
    }

    // Enlaza si ya está en el DOM
    const modalEl = document.getElementById('modalResetCorrelativos');
    if (modalEl) bindResetModal(modalEl);

    // Y también cuando se abre (por si se inyecta dinámicamente)
    document.addEventListener('show.bs.modal', (e) => {
      if (e.target && e.target.id === 'modalResetCorrelativos') bindResetModal(e.target);
    });

    // (Opcional) Asegura que los modales cuelguen de <body>
    document.querySelectorAll('.modal').forEach(m => {
      if (m.parentElement !== document.body) document.body.appendChild(m);
    });

    if (!window.bootstrap) console.error('Falta bootstrap.bundle.min.js');
  })();
</script>

<script>
  window.APP_ROLE = <?= (int)($_SESSION['rol'] ?? 0) ?>;
</script>

<script>
  (() => {
    if (window.__APP_INIT__) return;
    window.__APP_INIT__ = true;

    const $ = (s, r = document) => r.querySelector(s);
    const $$ = (s, r = document) => Array.from(r.querySelectorAll(s));
    const esc = (s) => (s ?? '').toString().replace(/[&<>"']/g, m => ({
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#39;'
    } [m]));
    const fmtCOP = (n) => (isFinite(n) ? new Intl.NumberFormat('es-CO', {
      style: 'currency',
      currency: 'COP',
      maximumFractionDigits: 0
    }).format(n) : '$0');

    // ====== Control de rol (admin puede pasar sin completar previos) ======
    const IS_ADMIN = (window.APP_ROLE === 1) ||
      (document.body?.dataset?.role === '1'); // fallback si usas <body data-role="1">

    // Tabs con bloqueo secuencial
    const TAB_IDS = ['form1-tab', 'form2-tab', 'form3-tab', 'form4-tab', 'form5-tab', 'form6-tab', 'form7-tab', 'form8-tab', 'form9-tab'];

    function isStepAllowed(targetIdx) {
      if (IS_ADMIN) return true; // Admin salta validación
      for (let i = 0; i < targetIdx; i++) {
        if (sessionStorage.getItem('form' + (i + 1) + '_done') !== '1') return false;
      }
      return true;
    }

    function refreshTabsLock() {
      TAB_IDS.forEach((id, idx) => {
        const btn = document.getElementById(id);
        if (!btn) return;
        const enabled = IS_ADMIN || idx === 0 || isStepAllowed(idx);
        btn.disabled = !enabled;
        btn.classList.toggle('disabled', !enabled);
        btn.setAttribute('aria-disabled', (!enabled).toString());
      });
    }

    function showTab(tabId) {
      const el = document.getElementById(tabId);
      if (!el) return;
      const targetIdx = TAB_IDS.indexOf(tabId);
      if (!IS_ADMIN && targetIdx >= 0 && !isStepAllowed(targetIdx)) {
        alert('Debes completar los formularios anteriores antes de avanzar.');
        return;
      }
      if (window.bootstrap?.Tab) {
        new bootstrap.Tab(el).show();
      } else {
        const paneId = el.getAttribute('data-bs-target')?.slice(1);
        const pane = paneId ? document.getElementById(paneId) : null;
        if (!pane) return;
        $$('.tab-pane').forEach(p => p.classList.remove('active', 'show'));
        pane.classList.add('active', 'show');
        $$('.nav-link').forEach(a => a.classList.remove('active'));
        el.classList.add('active');
      }
    }
    window.showTab = showTab;

    // Interceptar clicks en tabs
    TAB_IDS.forEach((id, idx) => {
      const btn = document.getElementById(id);
      if (!btn) return;
      btn.addEventListener('click', (ev) => {
        if (!IS_ADMIN && !isStepAllowed(idx)) {
          ev.preventDefault();
          ev.stopPropagation();
          alert('Debes completar los formularios anteriores antes de avanzar.');
        }
      }, true);
    });

    // Marcar done al enviar cada form
    function bindCompletionOnSubmit() {
      TAB_IDS.forEach((id, idx) => {
        const paneId = document.getElementById(id)?.getAttribute('data-bs-target')?.slice(1);
        if (!paneId) return;
        const pane = document.getElementById(paneId);
        if (!pane) return;
        const form = pane.querySelector('form');
        if (!form || form.dataset.boundDone === '1') return;
        form.dataset.boundDone = '1';
        form.addEventListener('submit', () => {
          sessionStorage.setItem('form' + (idx + 1) + '_done', '1');
          refreshTabsLock();
        });
      });
    }

    // Inicializa
    refreshTabsLock();
    bindCompletionOnSubmit();

    // 1) ORDEN DE TRABAJO – MATERIALES    // =========================
    const otMateriales = [];

    function otRenderMateriales() {
      const tb = document.getElementById('ot_mat_list');
      if (!tb) return;
      tb.innerHTML = '';
      otMateriales.forEach((m, i) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
        <td style="text-align:center">${i+1}</td>
        <td>${esc(m.nombre)}</td>
        <td style="text-align:right">${esc(m.cantidad)}</td>
        <td>${esc(m.unidad)}</td>
        <td><button type="button" class="btn btn-sm btn-danger" onclick="otEliminarMaterial(${i})">Eliminar</button></td>
      `;
        tb.appendChild(tr);
      });
    }

    function otAgregarMaterial() {
      const nombre = $('#ot_mat_nombre')?.value?.trim();
      const cantidad = $('#ot_mat_cantidad')?.value?.trim();
      const unidad = $('#ot_mat_unidad')?.value?.trim();
      if (!nombre || !cantidad || !unidad) {
        alert('Complete nombre, cantidad y unidad.');
        return;
      }
      otMateriales.push({
        nombre,
        cantidad,
        unidad
      });
      if ($('#ot_mat_nombre')) $('#ot_mat_nombre').value = '';
      if ($('#ot_mat_cantidad')) $('#ot_mat_cantidad').value = '';
      if ($('#ot_mat_unidad')) $('#ot_mat_unidad').value = '';
      otRenderMateriales();
    }

    function otEliminarMaterial(idx) {
      otMateriales.splice(idx, 1);
      otRenderMateriales();
    }
    window.otAgregarMaterial = otAgregarMaterial;
    window.otEliminarMaterial = otEliminarMaterial;

    // 2) ÍTEMS DE COTIZACIÓN – máx 4
    function initItemsManagers() {
      $$('#items-body').forEach((oldBody) => {
        const container = oldBody.closest('form') || document;
        if (container.dataset.itemsInit === '1') return;
        container.dataset.itemsInit = '1';

        let oldBtn = container.querySelector('#btnAddItem');
        const total = container.querySelector('#total_general');
        if (!oldBtn) return;

        // limpiar listeners previos
        const newBtn = oldBtn.cloneNode(true);
        oldBtn.parentNode.replaceChild(newBtn, oldBtn);
        oldBtn = newBtn;

        const newBody = oldBody.cloneNode(true);
        oldBody.parentNode.replaceChild(newBody, oldBody);

        const btn = newBtn;
        const body = newBody;

        const MAX = 4;
        const fmt = (n) => new Intl.NumberFormat('es-CO', {
          style: 'currency',
          currency: 'COP',
          maximumFractionDigits: 0
        }).format(n || 0);

        function updateBtn() {
          const full = body.rows.length >= MAX;
          btn.disabled = full;
          btn.textContent = full ? 'Límite alcanzado (4)' : '+ Agregar ítem';
        }

        function renumerar() {
          [...body.querySelectorAll('tr')].forEach((tr, i) => {
            const num = tr.querySelector('[name="item_num[]"]');
            if (num) num.value = i + 1;
          });
        }

        function recalc() {
          let t = 0;
          [...body.querySelectorAll('tr')].forEach(tr => {
            const cant = parseFloat(tr.querySelector('[name="item_cant[]"]')?.value) || 0;
            const vu = parseFloat(tr.querySelector('[name="item_vu[]"]')?.value) || 0;
            const vt = cant * vu;
            const vtInput = tr.querySelector('[name="item_vt[]"]');
            if (vtInput) vtInput.value = fmt(vt);
            t += vt;
          });
          if (total) total.value = fmt(t);
        }

        function addRow(data = {}) {
          if (body.rows.length >= MAX) {
            updateBtn();
            return;
          }
          const n = body.rows.length + 1;
          const tr = document.createElement('tr');
          tr.innerHTML = `
          <td><input class="control" name="item_num[]"  value="${esc(data.num ?? n)}"></td>
          <td><input class="control" name="item_desc[]" value="${esc(data.desc ?? '')}" placeholder="Descripción del servicio / producto"></td>
          <td><input class="control" name="item_cant[]" type="number" min="1" step="1"    value="${esc(data.cant ?? 1)}"></td>
          <td><input class="control" name="item_vu[]"   type="number" min="0" step="0.01" value="${esc(data.vu ?? 0)}"></td>
          <td><input class="control" name="item_vt[]"   type="text"   value="${fmt((+data.cant||1) * (+data.vu||0))}" readonly></td>
          <td style="text-align:center"><button class="btn secondary" type="button">✕</button></td>
        `;
          body.appendChild(tr);
          renumerar();
          recalc();
          updateBtn();
        }

        btn.addEventListener('click', (e) => {
          e.preventDefault();
          e.stopPropagation();
          e.stopImmediatePropagation();
          addRow();
        }, true);

        body.addEventListener('input', (e) => {
          if (e.target.matches('[name="item_cant[]"], [name="item_vu[]"]')) recalc();
        }, true);

        body.addEventListener('click', (e) => {
          const b = e.target.closest('button');
          if (!b) return;
          e.preventDefault();
          e.stopPropagation();
          e.stopImmediatePropagation();
          b.closest('tr')?.remove();
          renumerar();
          recalc();
          updateBtn();
        }, true);

        if (!body.querySelector('tr')) addRow();
        else {
          renumerar();
          recalc();
        }
        updateBtn();
      });
    }

    // 3) LISTAS: Materiales, Actividades, Partidas
    let materiales = [];

    function actualizarListaMateriales() {
      const lista = $('#materiales-list');
      if (!lista) return;
      lista.innerHTML = '';
      materiales.forEach((m, i) => {
        const li = document.createElement('li');
        li.className = 'list-group-item d-flex justify-content-between align-items-center';
        li.innerHTML = `
        ${esc(m.nombre)} - ${esc(m.cantidad)} ${esc(m.unidad)}
        <button type="button" class="btn btn-sm btn-danger" onclick="eliminarMaterial(${i})">Eliminar</button>
      `;
        lista.appendChild(li);
      });
    }

    function agregarMaterial() {
      const nombre = $('#material_nombre')?.value?.trim();
      const cantidad = $('#material_cantidad')?.value?.trim();
      const unidad = $('#material_unidad')?.value?.trim();
      if (nombre && cantidad && unidad) {
        materiales.push({
          concepto: nombre,
          nombre,
          cantidad,
          unidad
        });
        actualizarListaMateriales();
        if ($('#material_nombre')) $('#material_nombre').value = '';
        if ($('#material_cantidad')) $('#material_cantidad').value = '';
        if ($('#material_unidad')) $('#material_unidad').value = '';
      } else {
        alert('Por favor, complete todos los campos del material.');
      }
    }

    function eliminarMaterial(index) {
      materiales.splice(index, 1);
      actualizarListaMateriales();
    }
    window.agregarMaterial = agregarMaterial;
    window.eliminarMaterial = eliminarMaterial;

    // Actividades
    let actividades = [];
    let nextActivityId = 1;

    function obtenerNombreActividad(id) {
      const a = actividades.find(x => String(x.id) === String(id));
      return a ? a.nombre : 'Desconocido';
    }

    function actualizarDependencias() {
      const sel = $('#actividad_dependencia');
      if (!sel) return;
      sel.innerHTML = '<option value="">Ninguna</option>';
      actividades.forEach(a => {
        const opt = document.createElement('option');
        opt.value = a.id;
        opt.textContent = a.nombre;
        sel.appendChild(opt);
      });
    }

    function actualizarListaActividades() {
      const lista = $('#actividades-list');
      if (!lista) return;
      lista.innerHTML = '';
      actividades.forEach((a, i) => {
        const li = document.createElement('li');
        li.className = 'list-group-item';
        li.innerHTML = `
        <strong>${esc(a.nombre)}</strong> - Duración: ${esc(a.duracion)} días
        <br>Responsable: ${esc(a.responsable)}
        ${a.dependencia ? `<br>Depende de: ${esc(obtenerNombreActividad(a.dependencia))}` : ''}
        <button type="button" class="btn btn-sm btn-danger float-end" onclick="eliminarActividad(${i})">Eliminar</button>
      `;
        lista.appendChild(li);
      });
    }

    function agregarActividad() {
      const nombre = $('#actividad_nombre')?.value?.trim();
      const duracion = $('#actividad_duracion')?.value?.trim();
      const dependencia = $('#actividad_dependencia')?.value ?? '';
      const responsable = $('#actividad_responsable')?.value?.trim();
      if (nombre && duracion && responsable) {
        actividades.push({
          id: nextActivityId++,
          nombre,
          duracion,
          dependencia,
          responsable
        });
        actualizarListaActividades();
        actualizarDependencias();
        if ($('#actividad_nombre')) $('#actividad_nombre').value = '';
        if ($('#actividad_duracion')) $('#actividad_duracion').value = '';
        if ($('#actividad_responsable')) $('#actividad_responsable').value = '';
      } else {
        alert('Por favor, complete los campos obligatorios de la actividad.');
      }
    }

    function eliminarActividad(index) {
      const idEliminado = actividades[index]?.id;
      actividades.splice(index, 1);
      actividades.forEach(a => {
        if (String(a.dependencia) === String(idEliminado)) a.dependencia = '';
      });
      actualizarListaActividades();
      actualizarDependencias();
    }
    window.agregarActividad = agregarActividad;
    window.eliminarActividad = eliminarActividad;

    // Partidas presupuestarias
    let partidas = [];

    function actualizarListaPartidas() {
      const tbody = $('#partidas-list');
      if (!tbody) return;
      tbody.innerHTML = '';
      let total = 0;
      partidas.forEach((p, i) => {
        total += p.subtotal;
        const tr = document.createElement('tr');
        tr.innerHTML = `
        <td>${esc(p.concepto)}</td>
        <td>${esc(p.cantidad)}</td>
        <td>$${Number(p.costo).toFixed(2)}</td>
        <td>$${Number(p.subtotal).toFixed(2)}</td>
        <td><button type="button" class="btn btn-sm btn-danger" onclick="eliminarPartida(${i})">Eliminar</button></td>
      `;
        tbody.appendChild(tr);
      });
      const totalEl = $('#presupuesto-total');
      if (totalEl) totalEl.textContent = `$${total.toFixed(2)}`;
    }

    function agregarPartida() {
      const concepto = $('#partida_concepto')?.value?.trim();
      const cantidad = parseFloat($('#partida_cantidad')?.value ?? '');
      const costo = parseFloat($('#partida_costo')?.value ?? '');
      if (concepto && !isNaN(cantidad) && !isNaN(costo)) {
        partidas.push({
          concepto,
          cantidad,
          costo,
          subtotal: cantidad * costo
        });
        actualizarListaPartidas();
        if ($('#partida_concepto')) $('#partida_concepto').value = '';
        if ($('#partida_cantidad')) $('#partida_cantidad').value = '1';
        if ($('#partida_costo')) $('#partida_costo').value = '';
      } else {
        alert('Por favor, complete todos los campos de la partida presupuestaria.');
      }
    }

    function eliminarPartida(index) {
      partidas.splice(index, 1);
      actualizarListaPartidas();
    }
    window.agregarPartida = agregarPartida;
    window.eliminarPartida = eliminarPartida;

    // 7) Estado visual Aprobado / Rechazado / Pendiente
    (function() {
      const status = document.getElementById('approval-status');
      if (!status) return;
      const inputs = document.querySelectorAll('input[name="aprobado"]');

      function apply() {
        const v = document.querySelector('input[name="aprobado"]:checked')?.value;
        if (v === 'SI') {
          status.textContent = 'Aprobado';
          status.style.background = '#22c55e';
        } else if (v === 'NO') {
          status.textContent = 'Rechazado';
          status.style.background = '#ef4444';
        } else {
          status.textContent = 'Pendiente';
          status.style.background = '#94a3b8';
        }
      }
      inputs.forEach(r => r.addEventListener('change', apply));
      apply();
    })();

    // 8) Mostrar/ocultar el campo de “Otro” (solicitud vía)
    (function() {
      const chk = document.getElementById('sol_via_otro');
      const txt = document.getElementById('sol_via_otro_text');
      if (!chk || !txt) return;

      function sync() {
        const on = chk.checked;
        txt.style.display = on ? 'inline-block' : 'none';
        if (!on) txt.value = '';
      }
      const cleanChk = chk.cloneNode(true);
      chk.parentNode.replaceChild(cleanChk, chk);
      cleanChk.addEventListener('change', sync);
      sync();
    })();

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initItemsManagers);
    } else {
      initItemsManagers();
    }
  })();

  (() => {
    if (window.__tipoClienteOtroInit) return;
    window.__tipoClienteOtroInit = true;

    const wrap = document.getElementById('cli_otro_wrap');
    const input = wrap?.querySelector('input[name="tipo_cliente_otro"]');
    const rOtro = document.getElementById('cli_otro');
    const radios = document.querySelectorAll('input[name="tipo_cliente"]');

    if (!wrap || !input || !rOtro || radios.length === 0) return;

    const sync = () => {
      const show = rOtro.checked;
      wrap.style.display = show ? 'block' : 'none';
      if (show) {
        input.focus();
      } else {
        input.value = '';
      }
    };

    radios.forEach(r => r.addEventListener('change', sync, {
      passive: true
    }));
    sync();
  })();

  (() => {
    if (window.__solicitudViaOtroInit) return;
    window.__solicitudViaOtroInit = true;

    const chk = document.getElementById('sol_via_otro');
    const txt = document.getElementById('sol_via_otro_text');
    if (!chk || !txt) return;

    const sync = () => {
      const on = chk.checked;
      txt.style.display = on ? 'inline-block' : 'none';
      if (on) {
        txt.style.maxWidth = txt.style.maxWidth || '240px';
        txt.focus();
      } else {
        txt.value = '';
      }
    };

    sync();

    chk.addEventListener('change', sync, {
      passive: true
    });
  })();


  // Boton pdf circulo
  (function() {
    const fab = document.getElementById('pdf-fab');
    if (!fab) return;

    const triggerEl =
      document.querySelector('.pdf-button') ||
      document.querySelector('.header-container');

    let threshold = 0;

    function computeThreshold() {
      if (!triggerEl) {
        threshold = 100;
        return;
      }
      const rect = triggerEl.getBoundingClientRect();
      threshold = window.scrollY + rect.bottom;
    }

    function onScroll() {
      const show = window.scrollY > threshold;
      fab.classList.toggle('show', show);
    }

    computeThreshold();
    onScroll();

    window.addEventListener('scroll', onScroll, {
      passive: true
    });
    window.addEventListener('resize', () => {
      computeThreshold();
      onScroll();
    });
  })();
</script>

<style>
  :root {
    --primary-color: #2c3e50;
    --primary-dark: #1a2530;
    --accent-color: #3498db;
    --warning-color: #e67e22;
    --danger-color: #e74c3c;
    --success-color: #2ecc71;
    --light-bg: #f8f9fa;
    --border-radius: 10px;
    --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    --transition: all 0.3s ease;
    --ink: #111827;
    --muted: #64748b;
    --line: #d1d5db;
    --line-dark: #111827;
    --accent: #16a34a;
    --brand: #0ea5e9;
    --bg: #f5f7fb;
    --primary-gradient: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
    --card-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);

    --s1: 6px;
    --s2: 10px;
    --s3: 16px;
    --s4: 24px;
    --s5: 32px;
    --s6: 48px;
  }

  /*  CSS DEL MODAL  */
  .btn-primary-custom {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    border: none;
    color: white;
    padding: 0.6rem 1.5rem;
    font-weight: 500;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(44, 62, 80, 0.2);
    transition: var(--transition);
  }

  .btn-primary-custom:hover {
    background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-color) 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(44, 62, 80, 0.25);
    color: white;
  }

  .modal-content {
    border-radius: var(--border-radius);
    border: none;
    box-shadow: var(--box-shadow);
    overflow: hidden;
  }

  .modal-header-custom {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    color: white;
    border-bottom: none;
    padding: 1.2rem 1.5rem;
  }

  .modal-title {
    font-weight: 600;
    font-size: 1.25rem;
  }

  .btn-close-white {
    filter: invert(1) grayscale(100%) brightness(200%);
  }

  .modal-body {
    padding: 1.5rem;
  }

  .modal-footer-custom {
    border-top: 1px solid rgba(0, 0, 0, 0.08);
    background-color: var(--light-bg);
    padding: 1.2rem 1.5rem;
  }

  .admin-badge {
    background-color: rgba(231, 76, 60, 0.1);
    color: var(--danger-color);
    padding: 0.5rem 0.8rem;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    margin-bottom: 1rem;
    border: 1px solid rgba(231, 76, 60, 0.2);
  }

  .selection-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    flex-wrap: wrap;
  }

  .selection-header .form-check-all {
    display: flex;
    align-items: center;
    gap: .5rem;
  }

  .selection-header .form-check-all .form-check-input {
    margin: 0;
  }

  .selection-header .form-check-all .form-check-label {
    margin: 0;
    white-space: nowrap;
  }

  .selection-header .selected-count {
    white-space: nowrap;
    font-weight: 600;
    color: #6c757d;
  }

  @media (max-width:576px) {
    .selection-header {
      gap: .5rem;
    }
  }

  /* En una línea */
  .value-input-container {
    display: flex;
    align-items: center;
    gap: .75rem;
  }

  .value-input-container>label {
    margin: 0;
    white-space: nowrap;
    font-weight: 600;
  }

  .value-input-wrapper {
    display: flex;
    align-items: center;
    gap: .5rem;
  }

  .value-input-wrapper .form-control {
    width: 140px;
    flex: 0 0 auto;
    padding: .45rem .6rem;
  }

  .value-input-wrapper small {
    white-space: nowrap;
    color: #6c757d;
  }


  @media (max-width:576px) {
    .value-input-container {
      flex-wrap: wrap;
    }

    .value-input-wrapper small {
      white-space: normal;
    }
  }

  .modal .form-label {
    font-weight: 600;
    color: var(--primary-dark);
    margin-bottom: 0.5rem;
  }

  .modal .form-control {
    border-radius: 6px;
    border: 1px solid #ddd;
    padding: 0.6rem 0.75rem;
    transition: var(--transition);
  }

  .modal .form-control:focus {
    border-color: var(--accent-color);
    box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.15);
  }

  .modal .form-check-input {
    width: 1.1em;
    height: 1.1em;
    margin-top: 0.2em;
    border-radius: 4px;
    border: 1px solid #ced4da;
    transition: var(--transition);
  }

  .modal .form-check-input:checked {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
  }

  .modal .form-check-input:focus {
    box-shadow: 0 0 0 0.25rem rgba(44, 62, 80, 0.15);
  }

  .counters-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 0.8rem;
    margin: 1.2rem 0;
  }

  .counter-item {
    background-color: var(--light-bg);
    border-radius: 8px;
    padding: 0.9rem;
    transition: var(--transition);
    border: 1px solid transparent;
  }

  .counter-item:hover {
    background-color: #e9ecef;
    border-color: #dee2e6;
    transform: translateY(-2px);
  }

  .modal .btn {
    border-radius: 8px;
    padding: 0.5rem 1.2rem;
    font-weight: 500;
    transition: var(--transition);
  }

  .modal .btn-outline-secondary {
    border-color: #6c757d;
    color: #6c757d;
  }

  .modal .btn-outline-secondary:hover {
    background-color: #6c757d;
    border-color: #6c757d;
    color: #fff;
  }

  .btn-warning-custom {
    background: linear-gradient(135deg, var(--warning-color) 0%, #d35400 100%);
    border: none;
    color: white;
    box-shadow: 0 4px 6px rgba(230, 126, 34, 0.2);
  }

  .btn-warning-custom:hover {
    background: linear-gradient(135deg, #d35400 0%, var(--warning-color) 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(230, 126, 34, 0.25);
    color: white;
  }

  .btn-danger-custom {
    background: linear-gradient(135deg, var(--danger-color) 0%, #c0392b 100%);
    border: none;
    color: white;
    box-shadow: 0 4px 6px rgba(231, 76, 60, 0.2);
  }

  .btn-danger-custom:hover {
    background: linear-gradient(135deg, #c0392b 0%, var(--danger-color) 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(231, 76, 60, .25);
    color: white;
  }

  .result-container {
    border-radius: 8px;
    padding: 1rem;
    margin-top: 1.2rem;
    font-size: 0.9rem;
    display: none;
    transition: var(--transition);
  }

  .result-success {
    background-color: rgba(46, 204, 113, .1);
    border-left: 4px solid var(--success-color);
    color: #27ae60;
    display: block;
  }

  .result-error {
    background-color: rgba(231, 76, 60, .1);
    border-left: 4px solid var(--danger-color);
    color: #c0392b;
    display: block;
  }

  .result-warning {
    background-color: rgba(241, 196, 15, .1);
    border-left: 4px solid #f1c40f;
    color: #d35400;
    display: block;
  }

  .result-info {
    background-color: rgba(52, 152, 219, .1);
    border-left: 4px solid var(--accent-color);
    color: #2980b9;
    display: block;
  }

  #selected-count {
    font-weight: 600;
    color: var(--primary-color);
  }

  @media (max-width: 768px) {
    .modal-dialog-custom {
      margin: 1rem auto;
    }

    .modal-body {
      padding: 1.2rem;
    }

    .counters-grid {
      grid-template-columns: 1fr;
    }

    .modal-header-custom,
    .modal-footer-custom {
      padding: 1rem;
    }

    .modal .btn {
      width: 100%;
      margin-bottom: .5rem;
    }

    .modal-footer-custom {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }

    .modal-footer-custom .btn {
      flex: 1;
      margin: .25rem;
      min-width: 120px;
      width: auto;
    }
  }

  .modal-body::-webkit-scrollbar {
    width: 8px;
  }

  .modal-body::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
  }

  .modal-body::-webkit-scrollbar-thumb {
    background: #c4c4c4;
    border-radius: 10px;
  }

  .modal-body::-webkit-scrollbar-thumb:hover {
    background: #a0a0a0;
  }


  /* Estilos generales */
  .card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 18px;
    box-shadow: var(--card-shadow);
    overflow: hidden;
    margin-top: var(--s3);
  }

  .card>header {
    background: var(--primary-gradient);
    color: #fff;
    padding: var(--s3) var(--s4);
    border-bottom: 1px solid #e2e8f0;
  }

  .card>header h2 {
    margin: 0;
    font-weight: 700;
    font-size: 1.4rem;
    display: flex;
    align-items: center;
    gap: var(--s2);
  }

  .card>div {
    padding: clamp(12px, 2.5vw, var(--s4));
  }

  label {
    display: block;
    font-size: .875rem;
    font-weight: 600;
    color: #475569;
    margin-bottom: var(--s1);
  }

  input,
  select,
  textarea {
    width: 100%;
    border: 1px solid #cbd5e1;
    border-radius: 10px;
    padding: 12px 16px;
    font-size: 1rem;
    transition: all .2s ease;
    background: #fff;
    min-height: 38px;
  }

  input:focus,
  select:focus,
  textarea:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, .15);
  }

  input[type="radio"],
  input[type="checkbox"] {
    width: 16px;
    height: 16px;
  }

  input[type="date"] {
    min-width: 180px;
  }

  .btn {
    appearance: none;
    border: none;
    background: var(--primary-gradient);
    color: #fff;
    padding: 12px 20px;
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all .2s ease;
    display: inline-flex;
    align-items: center;
    gap: var(--s1);
    box-shadow: 0 4px 6px rgba(0, 0, 0, .1);
  }

  .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, .15);
  }

  .btn.secondary {
    background: #f1f5f9;
    color: #475569;
    border: 1px solid #e2e8f0;
  }

  .btn.secondary:hover {
    background: #e2e8f0;
  }

  .btn.pdf {
    background-color: #dc3545;
    color: #fff;
    border: none;
    padding: 8px 15px;
    border-radius: 4px;
    margin-top: 15px;
    cursor: pointer;
  }

  .btn.pdf:hover {
    background-color: #bb2d3b;
  }

  /* Sistema de rejilla */
  .grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: var(--s3);
  }

  .grid-2 {
    grid-template-columns: 1fr 1fr;
  }

  .grid-3 {
    grid-template-columns: 1fr 1fr 1fr;
  }

  .row {
    display: flex;
    gap: var(--s2);
    align-items: center;
    flex-wrap: wrap;
  }

  @media (min-width:700px) {
    .grid:not(.grid-2):not(.grid-3) {
      grid-template-columns: 1fr 1fr;
    }
  }

  @media (max-width:1024px) {
    .grid-3 {
      grid-template-columns: 1fr 1fr;
    }
  }

  @media (max-width:768px) {

    .grid,
    .grid-2,
    .grid-3 {
      grid-template-columns: 1fr !important;
    }

    .row {
      gap: 8px;
    }
  }

  /* Form checks */
  .form-check {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: var(--s1);
  }

  .form-check input[type="checkbox"],
  .form-check input[type="radio"] {
    width: auto;
    margin: 0;
  }

  .form-check-label {
    font-size: .95rem;
    color: #334155;
    cursor: pointer;
    margin: 0;
  }

  /* Tabs */
  .nav-tabs .nav-link {
    color: #475569;
    font-weight: 600;
    padding: 12px 20px;
    border-radius: 8px 8px 0 0;
  }

  .nav-tabs .nav-link.active {
    background: var(--primary-gradient);
    color: #fff;
    border: none;
  }

  .tab-content {
    padding: var(--s4);
    border: 1px solid #dee2e6;
    border-top: none;
    border-radius: 0 0 8px 8px;
  }

  .tab-pane {
    display: none;
  }

  .tab-pane.active {
    display: block;
  }

  /* Secciones/acciones */
  .control-section {
    margin-top: var(--s4);
    padding-top: var(--s3);
    border-top: 1px solid #e2e8f0;
  }

  .section-title {
    font-weight: 700;
    font-size: 1.1rem;
    margin-bottom: var(--s3);
    color: #1e293b;
    display: flex;
    align-items: center;
    gap: var(--s1);
  }

  .navigation-buttons {
    display: flex;
    justify-content: space-between;
    margin-top: var(--s4);
    padding-top: var(--s3);
    border-top: 1px solid #e2e8f0;
    gap: 10px;
    flex-wrap: wrap;
  }

  .navigation-buttons .btn {
    flex: 1 1 auto;
  }

  /* Evaluación */
  .evaluation-container {
    display: grid;
    grid-template-columns: 1fr;
    gap: var(--s3);
    margin-top: var(--s3);
  }

  .evaluation-group {
    background: #f8fafc;
    border-radius: 12px;
    padding: var(--s3);
    border: 1px solid #e2e8f0;
  }

  .evaluation-group h4 {
    margin: 0 0 var(--s2);
    font-size: 1rem;
    color: #334155;
    padding-bottom: var(--s1);
    border-bottom: 1px dashed #cbd5e1;
  }

  .evaluation-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--s1) 0;
    border-bottom: 1px solid #f1f5f9;
  }

  .evaluation-item:last-child {
    border-bottom: none;
  }

  .evaluation-item label {
    flex: 1;
    margin-bottom: 0;
    font-weight: 500;
    font-size: .9rem;
  }

  .radio-group {
    display: flex;
    gap: var(--s2);
  }

  .radio-option {
    display: flex;
    align-items: center;
    gap: 4px;
  }

  .radio-option input {
    width: auto;
  }

  .radio-option label {
    font-size: .85rem;
    font-weight: normal;
    margin-bottom: 0;
  }

  @media (min-width:900px) {
    .evaluation-container {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media (max-width:640px) {
    .evaluation-item {
      flex-direction: column;
      align-items: flex-start;
      gap: var(--s1);
    }

    .radio-group {
      width: 100%;
      justify-content: space-between;
    }
  }

  .approval-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 12px;
  }

  .approval-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
    border-bottom: 1px dashed #e5e7eb;
    padding-bottom: 8px;
    gap: 8px;
    flex-wrap: wrap;
  }

  .approval-header h4 {
    margin: 0;
    color: #0f172a;
    font-weight: 700;
    font-size: 1rem;
  }

  .status-indicator {
    padding: .3rem .7rem;
    border-radius: 999px;
    font-size: .78rem;
    font-weight: 700;
    background: #94a3b8;
    color: #fff;
    text-transform: uppercase;
    letter-spacing: .4px;
  }

  .approval-row {
    display: flex;
    justify-content: center;
  }

  .visually-hidden {
    position: absolute !important;
    width: 1px;
    height: 1px;
    margin: -1px;
    padding: 0;
    overflow: hidden;
    clip: rect(0 0 0 0);
    white-space: nowrap;
    border: 0;
  }

  .switch {
    position: relative;
    display: inline-grid;
    grid-template-columns: 1fr 1fr;
    width: 240px;
    height: 48px;
    border: 1px solid #e5e7eb;
    border-radius: 999px;
    background: #f8fafc;
    overflow: hidden;
  }

  .switch-seg {
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .45rem;
    font-weight: 600;
    color: #334155;
    cursor: pointer;
    user-select: none;
    transition: color .2s ease;
  }

  .switch-slider {
    position: absolute;
    top: 3px;
    left: 3px;
    width: calc(50% - 6px);
    height: 42px;
    border-radius: 999px;
    background: #22c55e;
    box-shadow: 0 6px 12px rgba(34, 197, 94, .25);
    transition: transform .28s cubic-bezier(.2, .8, .2, 1), background .2s ease, box-shadow .2s ease;
    z-index: 1;
    pointer-events: none;
  }

  #aprobado_si:checked~.switch .switch-slider {
    transform: translateX(0);
    background: #22c55e;
  }

  #aprobado_no:checked~.switch .switch-slider {
    transform: translateX(100%);
    background: #ef4444;
    box-shadow: 0 6px 12px rgba(239, 68, 68, .25);
  }

  #aprobado_si:checked~.switch .si {
    color: #166534;
  }

  #aprobado_si:checked~.switch .no {
    color: #334155;
  }

  #aprobado_no:checked~.switch .si {
    color: #334155;
  }

  #aprobado_no:checked~.switch .no {
    color: #b91c1c;
  }

  .switch-seg:hover {
    color: #0f172a;
  }

  @media (max-width:480px) {
    .switch {
      width: 100%;
      max-width: 360px;
      height: 44px;
    }

    .switch-slider {
      height: 38px;
      top: 3px;
    }
  }

  /* Solicitud */
  .soli-h3 {
    font-weight: 700;
    font-size: 1.1rem;
    margin: var(--s4) 0 var(--s2);
    color: var(--ink);
    padding-bottom: var(--s1);
    border-bottom: 1px solid var(--line);
  }

  .soli-wrap {
    margin-bottom: var(--s4);
  }

  .soli-checks {
    display: flex;
    flex-wrap: wrap;
    gap: var(--s3);
    margin-bottom: var(--s2);
  }

  .soli-check-col {
    flex: 1;
    min-width: 250px;
  }

  .soli-check-col label {
    display: flex;
    align-items: center;
    margin-bottom: var(--s2);
    font-weight: 500;
  }

  .soli-check-col input[type="checkbox"] {
    width: auto;
    margin-right: var(--s1);
  }

  .soli-row {
    display: flex;
    flex-wrap: wrap;
    gap: var(--s3);
    margin-bottom: var(--s2);
  }

  .soli-group {
    flex: 1;
    min-width: 250px;
  }

  .soli-textarea {
    min-height: 120px;
    resize: vertical;
  }

  .soli-table {
    width: 100%;
    border-collapse: collapse;
    display: table;
  }

  .soli-table th {
    text-align: left;
    padding: var(--s2);
    background-color: var(--bg);
    border-bottom: 1px solid var(--line);
  }

  .soli-table td {
    padding: var(--s3);
    vertical-align: top;
  }

  .soli-actions {
    display: flex;
    justify-content: flex-end;
    gap: var(--s2);
    margin-top: var(--s4);
    padding-top: var(--s3);
    border-top: 1px solid var(--line);
  }

  .muted {
    display: block;
    font-size: .75rem;
    color: var(--muted);
    margin-top: 4px;
  }

  .soli-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 12px;
  }

  .soli-col {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .soli-otro {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
  }

  #sol_via_otro_text {
    display: none;
    max-width: 260px;
  }

  @media (max-width:768px) {

    .soli-check-col,
    .soli-group {
      min-width: 100%;
    }

    .soli-table {
      display: block;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
    }

    .soli-grid {
      grid-template-columns: 1fr;
    }
  }

  /* Cotización */
  .cot-wrap {
    max-width: 1100px;
    margin: 0 auto;
  }

  .fieldset {
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    overflow: hidden;
    margin: 14px 0;
  }

  .legend {
    background: #f3f4f6;
    border-bottom: 1px solid #cbd5e1;
    text-align: center;
    font-weight: 800;
    letter-spacing: .2px;
    padding: 8px 10px;
  }

  .box {
    padding: 10px;
  }

  .row-grid {
    display: grid;
    gap: 10px;
  }

  .row-grid.c2 {
    grid-template-columns: 1fr 1fr;
  }

  .row-grid.c3 {
    grid-template-columns: 1fr 1fr 1fr;
  }

  .row-grid.auto-3 {
    grid-template-columns: 1fr 160px 200px;
  }

  .row-grid>.fg {
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .control {
    height: 38px;
    padding: 8px 10px;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    outline: 0;
  }

  .control:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, .15);
  }

  .chk {
    display: grid;
    grid-template-columns: 18px 1fr;
    align-items: center;
    gap: 8px;
  }

  .chk input {
    width: 18px;
    height: 18px;
    margin: 0;
  }

  .items {
    width: 100%;
    border-collapse: collapse;
    display: table;
  }

  .items th,
  .items td {
    border: 1px solid #cbd5e1;
    padding: 8px;
    vertical-align: middle;
  }

  .items thead th {
    background: #eef2ff;
    text-align: center;
    font-weight: 800;
  }

  .items tfoot td {
    text-align: right;
    font-weight: 800;
  }

  .items input[type="text"],
  .items input[type="number"] {
    width: 100%;
    height: 34px;
    padding: 6px 8px;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
  }

  .btnbar {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    align-items: center;
    gap: 12px;
    margin-top: 12px;
  }

  .btn-left {
    justify-self: start;
  }

  .btn-center {
    justify-self: center;
  }

  .btn-right {
    justify-self: end;
  }

  .sig {
    height: 40px;
    border: 1px dashed #a3abb6;
    border-radius: 6px;
  }

  @media (max-width:860px) {

    .row-grid.c2,
    .row-grid.c3,
    .row-grid.auto-3 {
      grid-template-columns: 1fr;
    }

    .btnbar {
      grid-template-columns: 1fr;
    }

    .btn-left,
    .btn-center,
    .btn-right {
      justify-self: stretch;
    }
  }

  /* Servicios */
  .servicio-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(220px, 1fr));
    gap: var(--s2);
  }

  .servicio-item {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: .95rem;
    color: #334155;
    cursor: pointer;
    transition: color .2s ease-in-out;
    white-space: normal;
  }

  .servicio-item input[type="checkbox"] {
    width: 18px;
    height: 18px;
    accent-color: #0ea5e9;
  }

  @media (min-width:600px) {
    #f_servicios {
      grid-template-columns: repeat(2, minmax(200px, 1fr));
    }
  }

  @media (max-width:768px) {
    .servicio-grid {
      grid-template-columns: 1fr;
    }
  }

  /* Formulario 5 (Validación) */
  .vd-block {
    border: 1px solid #e5e7eb;
    border-radius: .5rem;
    padding: 1rem;
    margin-bottom: 1rem;
  }

  .vd-title {
    font-weight: 700;
    text-transform: uppercase;
    font-size: .9rem;
    margin-bottom: .5rem;
  }

  .vd-label {
    font-weight: 600;
    font-size: .9rem;
    margin-bottom: .25rem;
  }

  .vd-matrix {
    width: 100%;
    border-collapse: collapse;
    display: table;
  }

  .vd-matrix th,
  .vd-matrix td {
    border: 1px solid #e5e7eb;
    padding: .45rem .5rem;
  }

  .vd-matrix th {
    background: #f8fafc;
    font-weight: 700;
    text-align: center;
  }

  .vd-matrix td[colspan] {
    text-align: left;
  }

  .vd-num,
  .vd-si,
  .vd-no,
  .vd-na {
    width: 60px;
    text-align: center;
  }

  .vd-form-check-inline .form-check-input {
    margin-top: 0;
  }

  .vd-row {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 12px;
  }

  @media (min-width:768px) {
    .vd-row {
      grid-template-columns: 1fr 1fr 1fr;
    }
  }

  @media (max-width:768px) {
    .vd-row {
      grid-template-columns: 1fr;
    }

    .vd-matrix {
      display: block;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
    }
  }

  /* Formulario 6 (Validación 3D) */
  .v3d-block {
    border: 1px solid #d1d5db;
    border-radius: .5rem;
    padding: 12px 14px;
    margin-bottom: 14px;
    background: #fff;
  }

  .v3d-title {
    font-weight: 700;
    text-transform: uppercase;
    font-size: .95rem;
    margin-bottom: 8px;
  }

  .v3d-matrix {
    width: 100%;
    border-collapse: collapse;
    display: table;
  }

  .v3d-matrix th,
  .v3d-matrix td {
    border: 1px solid #d1d5db;
    padding: .45rem .5rem;
    vertical-align: middle;
  }

  .v3d-matrix thead th {
    background: #f3f4f6;
  }

  .v3d-num,
  .v3d-si,
  .v3d-no,
  .v3d-na {
    width: 60px;
    text-align: center;
  }

  .v3d-matrix input[type="radio"] {
    width: 16px;
    height: 16px;
    cursor: pointer;
  }

  @media (max-width:768px) {
    .v3d-matrix {
      display: block;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
    }
  }

  /* Formulario 7 (Control Técnico) */
  .ct-wrap {
    --ct-gap: .65rem;
    --ct-border: #d1d5db;
    --ct-muted: #475569;
    --ct-radius: .5rem;
  }

  .ct-wrap .ct-grid {
    display: grid;
    gap: var(--ct-gap);
  }

  .ct-wrap .ct-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--ct-gap);
  }

  .ct-wrap .ct-3col {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: var(--ct-gap);
  }

  .ct-wrap .ct-label {
    font-size: .9rem;
    font-weight: 600;
    margin-bottom: .25rem;
    color: #0f172a;
  }

  .ct-wrap .ct-card {
    border: 1px solid var(--ct-border);
    border-radius: var(--ct-radius);
    padding: 1rem;
  }

  .ct-wrap .ct-title {
    font-weight: 800;
    font-size: 1rem;
    margin-bottom: .5rem;
  }

  .ct-wrap .ct-muted {
    color: var(--ct-muted);
    font-size: .85rem;
  }

  .ct-table-wrap {
    border: 1px solid var(--ct-border);
    border-radius: var(--ct-radius);
    overflow: hidden;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }

  .ct-table {
    width: 100%;
    border-collapse: collapse;
    font-size: .92rem;
    min-width: 720px;
  }

  .ct-table th,
  .ct-table td {
    border: 1px solid var(--ct-border);
    padding: .5rem;
  }

  .ct-table thead th {
    background: #f8fafc;
    font-weight: 700;
    text-align: center;
  }

  .ct-table .ct-center {
    text-align: center;
  }

  .ct-table input[type="text"],
  .ct-table input[type="number"] {
    width: 100%;
    border: 0;
    outline: none;
    padding: .25rem .35rem;
    background: transparent;
  }

  .ct-inline-checks {
    display: flex;
    gap: 1rem;
    align-items: center;
  }

  .ct-actions {
    text-align: center;
    margin-top: 1rem;
  }

  .ct-actions .btn {
    padding: .6rem 1.1rem;
    border-radius: .6rem;
  }

  @media (max-width:900px) {

    .ct-wrap .ct-row,
    .ct-wrap .ct-3col {
      grid-template-columns: 1fr;
    }
  }

  /* Formulario 8 (Inspección y Servicio) */
  .isv-wrap {
    border: 1px solid #d1d5db;
    border-radius: .5rem;
    overflow: hidden;
    background: #fff;
  }

  .isv-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
  }

  .isv-block {
    border-top: 1px solid #e5e7eb;
    padding: 12px 14px;
  }

  .isv-block:first-child {
    border-top: none;
  }

  .isv-label {
    display: block;
    font-weight: 700;
    margin-bottom: .25rem;
    font-size: .9rem;
  }

  .isv-title {
    font-weight: 800;
    text-transform: uppercase;
    font-size: .92rem;
    margin-bottom: .25rem;
  }

  .isv-field {
    width: 100%;
  }

  .isv-service {
    display: grid;
    grid-template-columns: repeat(2, minmax(220px, 1fr));
    gap: 8px 16px;
    margin-top: 6px;
  }

  .isv-check {
    display: inline-flex;
    align-items: center;
    gap: 8px;
  }

  .isv-check input[type="checkbox"] {
    width: 16px;
    height: 16px;
    accent-color: #0d6efd;
  }

  .isv-area,
  .isv-area-obsv {
    min-height: 120px;
  }

  .isv-area {
    min-height: 150px;
  }

  .isv-firmas {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
  }

  .isv-bar {
    background: linear-gradient(90deg, #101828, #1f2937);
    color: #fff;
    padding: 10px 14px;
    border-bottom: 1px solid #0f172a;
    font-weight: 800;
    border-top-left-radius: .5rem;
    border-top-right-radius: .5rem;
  }

  @media (max-width:900px) {

    .isv-row,
    .isv-service,
    .isv-firmas {
      grid-template-columns: 1fr;
    }
  }

  /* Formulario 9 (Escaneo) */
  .esc-block {
    border: 1px solid #d1d5db;
    border-radius: .5rem;
    margin-bottom: 1rem;
    padding: 12px;
    background: #fff;
  }

  .esc-title {
    font-weight: 700;
    margin-bottom: .5rem;
    font-size: .95rem;
  }

  .esc-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
  }

  .esc-checks {
    display: grid;
    grid-template-columns: repeat(2, minmax(220px, 1fr));
    gap: 6px 16px;
  }

  .esc-check {
    display: inline-flex;
    align-items: center;
    gap: 8px;
  }

  .esc-check input[type="checkbox"] {
    width: 16px;
    height: 16px;
    accent-color: #0d6efd;
  }

  .esc-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: .5rem;
    font-size: .9rem;
    display: table;
  }

  .esc-table th,
  .esc-table td {
    border: 1px solid #ccc;
    padding: 6px;
    text-align: center;
  }

  .esc-table th {
    background: #f3f4f6;
    text-align: center;
  }

  .esc-label {
    font-weight: 600;
    margin-bottom: .25rem;
    font-size: .9rem;
  }

  .esc-textarea {
    min-height: 100px;
  }

  @media (max-width:768px) {

    .esc-row,
    .esc-checks {
      grid-template-columns: 1fr;
    }

    .esc-table {
      display: block;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
    }
  }

  /* Utilidades y PDF */
  .mt-12 {
    margin-top: 12px;
  }

  .list-group {
    margin-top: 10px;
  }

  .pdf-container {
    padding: 20px;
    background: #fff;
  }

  .pdf-header {
    text-align: center;
    margin-bottom: 20px;
    border-bottom: 2px solid #333;
    padding-bottom: 10px;
  }

  /* Patch responsive */
  @media (max-width:480px) {
    :root {
      --s3: 14px;
      --s4: 20px;
    }

    body {
      padding: var(--s3);
    }

    .card>header h2 {
      font-size: 1.15rem;
    }

    label {
      font-size: .84rem;
    }

    input,
    select,
    textarea {
      padding: 10px 12px;
      font-size: .95rem;
    }
  }

  /* Botón flotante PDF */
  #pdf-fab {
    position: fixed;
    right: 24px;
    bottom: 96px;
    opacity: 0;
    transform: translateY(10px) scale(.9);
    pointer-events: none;
    transition: opacity .2s ease, transform .2s ease;
    z-index: 1100;
  }

  #pdf-fab.show {
    opacity: 1;
    transform: translateY(0) scale(1);
    pointer-events: auto;
  }

  .btn-fab {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
    color: #fff;
    box-shadow: 0 10px 25px rgba(0, 0, 0, .18);
    text-decoration: none;
  }

  .btn-fab:hover {
    color: #111;
    transform: translateY(-2px);
    box-shadow: 0 14px 28px rgba(0, 0, 0, .22);
  }

  #pdf-fab i {
    font-size: 1.1rem;
  }

  @media (max-width:576px) {
    #pdf-fab {
      right: 16px;
      bottom: 84px;
    }

    .btn-fab {
      width: 48px;
      height: 48px;
    }

    #pdf-fab i {
      font-size: 1rem;
    }
  }

  /* HEADER de página */
  #hdr {
    background: linear-gradient(90deg, #2c3e50 0%, #1a1a2e 100%);
    color: #fff;
    padding: 2.5rem 0;
    margin-bottom: 2.5rem;
    border-radius: 0 0 20px 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, .12);
    position: relative;
    overflow: hidden;
    margin-top: 20px;
  }

  /* Título y subtítulo (mismo look que .page-title / .page-subtitle) */
  #hdr-ttl {
    font-weight: 700;
    letter-spacing: .5px;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, .2);
    margin-bottom: .5rem;
  }

  #hdr-sub {
    font-weight: 300;
    opacity: .9;
    font-size: 1.1rem;
  }

  /* Botón PDF (mismo look que .pdf-button) */
  #hdr-pdf {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    background: #fff;
    color: #111;
    text-decoration: none;
    border: none;
    border-radius: 10px;
    padding: .7rem 1.5rem;
    font-weight: 600;
    box-shadow: 0 6px 16px rgba(0, 0, 0, .18);
    transition: all .3s ease;
  }

  #hdr-pdf:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 22px rgba(0, 0, 0, .22);
    color: #111;
  }

  /* Ajustes responsivos (opcional) */
  @media (max-width:768px) {
    #hdr {
      padding: 2rem 0;
    }

    #hdr-ttl {
      font-size: 1.8rem;
    }
  }

  .page-title {
    font-weight: 700;
    letter-spacing: .5px;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, .2);
    margin-bottom: .5rem;
  }

  .page-subtitle {
    font-weight: 300;
    opacity: .9;
    font-size: 1.1rem;
  }

  .header-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
  }

  .header-actions {
    position: absolute;
    right: 24px;
    bottom: 18px;
    display: inline-flex;
  }

  .pdf-button {
    background: #fff;
    border: none;
    border-radius: 10px;
    padding: .7rem 1.5rem;
    font-weight: 600;
    transition: all .3s ease;
    box-shadow: 0 6px 16px rgba(0, 0, 0, .18);
    color: #111;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: .5rem;
  }

  .pdf-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 22px rgba(0, 0, 0, .22);
    color: #111;
  }

  @media (max-width:992px) {

    .header-container,
    .gradient-header {
      padding: 2rem 0;
    }

    .header-actions {
      right: 16px;
      bottom: 14px;
    }
  }

  @media (max-width:768px) {
    .page-title {
      font-size: 1.8rem;
    }

    .header-inner {
      flex-direction: column;
      align-items: flex-start;
    }

    .header-actions {
      position: static;
      margin-top: .75rem;
      align-self: center;
    }
  }
</style>