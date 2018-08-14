<!-- Si no Admin -->
                    <?php if (!empty($this->session->userdata('loginUsuario'))) { ?>
                        <div class="row">

                            <div class="col-xs-3 col-sm-3 col-md-3 col-md-offset-3 col-xs-offset-3 col-sm-offset-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="puede_editar" id="puede_editar" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Permisos de Edici&oacute;n</label>
                                </div>
                                <br>
                            </div>

                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="puede_consultar" id="puede_consultar" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Permisos de Consulta</label>
                                </div>
                                <br>
                            </div>

                        </div>
                    <?php } ?><?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

