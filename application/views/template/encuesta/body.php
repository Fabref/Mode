<?php
$mensaje = $this->session->flashdata('mensaje');
$tipoMensaje = $this->session->flashdata('tipoMensaje');
?>

<div class="container-contact100">
    <div class="wrap-contact100">
        <?php
        $attributes = array('class' => 'contact100-form validate-form');
        echo form_open('Encuesta/index/grc/' . $campanya->id_campana . "/" . $campanya->url, $attributes);
        ?>
        <span class="contact100-form-title">
            Encuesta <?= $campanya->nombre ?>
        </span>

        <?php
        if (isset($tipoMensaje)) {
            if ($tipoMensaje == 1) {
                ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="alert alert-success alert-dismissable">
                            <label><i class="icon fa fa-check"></i><?= $mensaje ?></label>
                        </div>
                    </div>
                </div>
                <?php
            } else if ($tipoMensaje == 3) {
                ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="alert alert-warning alert-dismissable">
                            <label><i class="icon fa fa-warning"></i><?= $mensaje ?></label>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>

        <!-- Email -->
        <div class="wrap-input100 validate-input bg1" data-validate="E-Mail (example@example.com">
            <span class="label-input100">E-Mail *</span>
            <input class="input100" type="email" name="email" id="email" placeholder="Introduzca su E-Mail" required>
        </div>

        <!-- Tipo -->
        <div class="wrap-input100 bg1 rs1-wrap-input100">
            <span class="label-input100">Tipo</span>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="tipo" id="tipo" value="Persona">
                    Persona
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="tipo" id="tipo" value="Empresa">
                    Empresa
                </label>
            </div>
        </div>




        <!-- Genero -->
        <div class="wrap-input100 bg1 rs1-wrap-input100">
            <span class="label-input100">Genero</span>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="genero" id="genero" value="Hombre" disabled>
                    Hombre
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="genero" id="genero" value="Mujer" disabled>
                    Mujer
                </label>
            </div>
        </div>

        <!-- Nacionalidad -->
        <div class="wrap-input100 bg1 rs1-wrap-input100">
            <span class="label-input100">Nacionalidad</span>
            <input class="input100" type="text" name="nacionalidad" id="nacionalidad" placeholder="Nacionalidad">
        </div>

        <!-- Pais -->
        <div class="wrap-input100 bg1 rs1-wrap-input100">
            <span class="label-input100">Pais</span>
            <input class="input100" type="text" name="pais" id="pais" placeholder="Pais">
        </div>

        <!-- Localidad -->
        <div class="wrap-input100 bg1">
            <span class="label-input100">Localidad</span>
            <input class="input100" type="text" name="localidad" id="localidad" placeholder="Localidad">
        </div>

        <!-- Grupo de interés -->
        <div class="wrap-input100 input100-select bg1">
            <span class="label-input100">Grupo de Inter&eacute;s</span>
            <div>
                <select class="js-select2" name="grupoInteres" id="grupoInteres">
                    <option value="Empleado">Empleado</option>
                    <option value="Accionista">Accionista</option>
                    <option value="Cliente">Cliente</option>
                    <option value="Proveedores">Proveedores</option>
                    <option value="Administracion Publica">Administración Pública</option>
                    <option value="Medio Comunicacion">Medio Comunicación</option>
                    <option value="ONG">ONG</option>
                    <option value="Subcontrata">Subcontrata</option>
                    <option value="Universidad">Universidad</option>
                    <option value="Otro">Otro</option>
                </select>
                <div class="dropDownSelect2"></div>
            </div>
        </div>

        <!-- Otro -->
        <div class="wrap-input100 bg1">
            <span class="label-input100">Otro</span>
            <input class="input100" type="text" name="otro" id="otro" placeholder="Otro" disabled>
        </div>

        <!-- Numero de Empleados -->
        <div class="wrap-input100 input100-select bg1">
            <span class="label-input100">N&uacute;mero de empleados</span>
            <div>
                <select class="js-select2" name="numeroEmpleados" id="numeroEmpleados">
                    <option value="1 a 9">1 a 9</option>
                    <option value="10 a 49">10 a 49</option>
                    <option value="50 a 249">50 a 249</option>
                    <option value="250 a 999">250 a 999</option>
                    <option value=">=1000">>=1000</option>
                </select>
                <div class="dropDownSelect2"></div>
            </div>
        </div>

        <!-- Facturación -->
        <div class="wrap-input100 input100-select bg1">
            <span class="label-input100">Facturaci&oacute;n</span>
            <div>
                <select class="js-select2" name="facturacion" id="facturacion">
                    <option value="<100.000"><100.000</option>
                    <option value="100.000 a <1.000.000">100.000 a <1.000.000</option>
                    <option value="1.000.000 a <10.000.000">1.000.000 a <10.000.000</option>
                    <option value=">=10.000.000">>=10.000.000</option>
                </select>
                <div class="dropDownSelect2"></div>
            </div>
        </div>

        <span class="contact100-form-title">
            Preguntas
        </span>
        <!-- Items -->
        <?php
        if (sizeof($items) > 0) {
            foreach ($items as $item) {
                ?>


                <div class="wrap-input100 bg1">
                    <h4><?= $item->nombre ?></h4>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="<?php echo "IT_" . $item->id_item_variable; ?>" 
                                   id="<?php echo "IT_" . $item->id_item_variable; ?>" value="1"> 1
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="<?php echo "IT_" . $item->id_item_variable; ?>" 
                                   id="<?php echo "IT_" . $item->id_item_variable; ?>" value="2"> 2
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="<?php echo "IT_" . $item->id_item_variable; ?>" 
                                   id="<?php echo "IT_" . $item->id_item_variable; ?>" value="3"> 3
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="<?php echo "IT_" . $item->id_item_variable; ?>" 
                                   id="<?php echo "IT_" . $item->id_item_variable; ?>" value="4"> 4
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="<?php echo "IT_" . $item->id_item_variable; ?>" 
                                   id="<?php echo "IT_" . $item->id_item_variable; ?>" value="5"> 5
                        </label>
                    </div>
                </div>

                <?php
            }
        }
        ?>

        <div class="container-contact100-form-btn">
            <button class="contact100-form-btn" type="submit">
                <span>
                    Enviar
                    <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                </span>
            </button>
        </div>
        </form>
    </div>
</div>