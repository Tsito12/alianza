<!DOCTYPE html>
<html lang="es-Mx">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{asset('css/visitaDomiciliar.css')}}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
  <title>Saci-Alianza</title>
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://kit.fontawesome.com/56eee1d2a7.js" crossorigin="anonymous"></script>
</head>
<body>
  <header>
    <div class="iKcRBf">
      <img src="{{asset('img/SacimexLigoBlanco.png')}}">
    </div>
    <button id="session-button" class="OmErIE">
      <img src="{{asset('img/BotonSesion.png')}}">
    </button>
    <div id="session-options" class="lmhoLI">
      <p>programador.desarrollo@opcionessacimex.com</p>
      <p>00-DEMO</p>
      <a class="TIELDW">Cerrar sesión</a>
    </div>
  </header>
  <div id="close-menu" class="tereIN"></div>
  <section>
    <div class="eowNgz">
      <button id="menu-button-1" class="menu-button JDDzRY">Datos del cliente</button>
      <button id="menu-button-2" class="menu-button LicxeC">Datos laborales</button>
      <button id="menu-button-3" class="menu-button LicxeC">Datos del cónyuge</button>
      <button id="menu-button-4" class="menu-button LicxeC">Referencias personales</button>
      <button id="menu-button-5" class="menu-button LicxeC">PLD</button>
    </div>
    <form>
      <div id="client-section" class="IMaNtA">
        <div class="VPkfBr">
          <label for="name_client-section" class="nDvBVt">Nombre(s):</label>
          <input id="name_client-section" class="darMiL" type="text" required/>
        </div>
        <div class="VPkfBr">
          <label for="lastname_client-section" class="nDvBVt">Apellidos:</label>
          <input id="lastname_client-section" class="darMiL" type="text" required/>
        </div>
        <div class="VPkfBr">
          <label for="birthdate_client-section" class="nDvBVt">Fecha de nacimiento:</label>
          <input id="birthdate_client-section" class="darMiL" type="date" required/>
        </div>
        <div class="dOmxUh">
          <label for="civil-status_client-section" class="nDvBVt">Estado civil:</label>
          <select id="civil-status_client-section" class="MbIanG">
            <option value="Soltero">Soltero</option>
            <option value="Casado">Casado</option>
            <option value="Divorciado">Divorciado</option>
            <option value="Unión libre">Unión libre</option>
          </select>
        </div>
        <div class="VPkfBr">
          <label for="entity-birth_client-section" class="nDvBVt">Entidad de nacimiento:</label>
          <input id="entity-birth_client-section" class="darMiL" type="text" required/>
        </div>
        <div class="dOmxUh">
          <label for="country-birth_client-section" class="nDvBVt">País de nacimiento:</label>
          <select id="country-birth_client-section" class="MbIanG" disabled>
            <option value="México">México</option>
          </select>
        </div>
        <div class="dOmxUh">
          <label class="nDvBVt">Sexo:</label>
          <div class="nWbxQe">
            <div class="CvIbEI">
              <input id="gender-f_client-section" name="gender" type="radio" value="F"/>
              <label for="gender-f_client-section" class="nDvBVt">F</label>
            </div>
            <div class="CvIbEI">
              <input id="gender-m_client-section" name="gender" type="radio" value="M"/>
              <label for="gender-m_client-section" class="nDvBVt">M</label>
            </div>
          </div>
        </div>
        <div class="VPkfBr">
          <label for="scholarship_client-section" class="nDvBVt">Escolaridad:</label>
          <select id="scholarship_client-section" class="MbIanG">
            <option value="Primaria">Primaria</option>
            <option value="Secundaria">Secundaria</option>
            <option value="Bachillerato">Bachillerato</option>
            <option value="Licenciatura">Licenciatura</option>
          </select>
        </div>
        <div class="VPkfBr">
          <label for="housing_client-section" class="nDvBVt">Tipo de vivienda:</label>
          <select id="housing_client-section" class="MbIanG">
            <option value="Primaria">Propia</option>
            <option value="Rentada">Rentada</option>
            <option value="Familiar">Familiar</option>
            <option value="Prestada">Prestada</option>
          </select>
        </div>
        <div class="JkSHKc">
          <label for="age_client-section" class="nDvBVt">Edad:</label>
          <input id="age_client-section" class="darMiL" type="number" required/>
        </div>
        <div class="VPkfBr">
          <label for="street_client-section" class="nDvBVt">Calle:</label>
           <input id="street_client-section" class="darMiL" type="text" required/>
        </div>
        <div class="JkSHKc">
          <label for="outdoor-number_client-section" class="nDvBVt">No. Ext:</label>
           <input id="outdoor-number_client-section" class="darMiL" type="text"/>
        </div>
        <div class="JkSHKc">
          <label for="internal-number_client-section" class="nDvBVt">No. Int:</label>
           <input id="internal-number_client-section" class="darMiL" type="text" required/>
        </div>
        <div class="VPkfBr">
          <label for="colony_client-section" class="nDvBVt">Colonia:</label>
           <input id="colony_client-section" class="darMiL" type="text" required/>
        </div>
        <div class="VPkfBr">
          <label for="municipality_client-section" class="nDvBVt">Alcaldía/Municipio:</label>
           <input id="municipality_client-section" class="darMiL" type="text" required/>
        </div>
        <div class="dOmxUh">
          <label for="entity-residence_client-section" class="nDvBVt">Entidad de residencia:</label>
          <select id="entity-residence_client-section" class="MbIanG" disabled>
            <option value="Oaxaca">Oaxaca</option>
          </select>
        </div>
        <div class="dOmxUh">
          <label for="country-residence_client-section" class="nDvBVt">País de residencia:</label>
          <select id="country-residence_client-section" class="MbIanG" disabled>
            <option value="México">México</option>
          </select>
        </div>
        <div class="dOmxUh">
          <label for="nationality_client-section" class="nDvBVt">Nacionalidad:</label>
          <select id="nationality_client-section" class="MbIanG" disabled>
            <option value="Mexicana">Mexicana</option>
          </select>
        </div>
        <div class="VPkfBr">
          <label for="phone-number_client-section" class="nDvBVt">Teléfono:</label>
          <input id="phone-number_client-section" class="darMiL" type="number" required/>
        </div>
        <div class="VPkfBr">
          <label for="email_client-section" class="nDvBVt">Correo electrónico:</label>
          <input id="email_client-section" class="darMiL" type="text" required/>
        </div>
        <button id="next-button_client-section" class="XiNesP">
          <span>Siguiente</span>
          <i class="fa-solid fa-arrow-right"></i>
        </button>
      </div>
      <div id="labor-section" class="meNtIC">
        <div class="VPkfBr">
          <label for="occupation_labor-section" class="nDvBVt">Ocupación:</label>
          <input id="occupation_labor-section" class="darMiL" type="text" required/>
        </div>
        <div class="dOmxUh">
          <label class="nDvBVt">Tipo de contrato:</label>
          <div class="nWbxQe">
            <div class="CvIbEI">
              <input id="contract-confianza_labor-section" name="contract" type="radio" value="Confianza"/>
              <label for="contract-confianza_labor-section" class="nDvBVt">Confianza</label>
            </div>
            <div class="CvIbEI">
              <input id="contract-base_labor-section" name="contract" type="radio" value="Base"/>
              <label for="contract-base_labor-section" class="nDvBVt">Base</label>
            </div>
          </div>
        </div>
        <div class="JkSHKc">
          <label for="contract-age_labor-section" class="nDvBVt">Antigüedad:</label>
          <input id="contract-age_labor-section" class="darMiL" type="text" required/>
        </div>
        <div class="VPkfBr">
          <label for="workplace_labor-section" class="nDvBVt">Centro de trabajo:</label>
          <input id="workplace_labor-section" class="darMiL" type="text" required/>
        </div>
        <div class="VPkfBr">
          <label for="adress_labor-section" class="nDvBVt">Domicilio:</label>
          <input id="adress_labor-section" class="darMiL" type="text" required/>
        </div>
        <button id="next-button_labor-section" class="XiNesP">
          <span>Siguiente</span>
          <i class="fa-solid fa-arrow-right"></i>
        </button>
      </div>
      <div id="spouse-section" class="meNtIC">
        <div class="VPkfBr">
          <label for="full-name_spouse-section" class="nDvBVt">Nombre completo:</label>
          <input id="full-name_spouse-section" class="darMiL" type="text" disabled/>
        </div>
        <div class="VPkfBr">
          <label for="matrimonial-regime_spouse-section" class="nDvBVt">Régimen matrimonial:</label>
          <select id="matrimonial-regime_spouse-section" class="MbIanG" disabled>
            <option value="Bienes mancomunados">Bienes mancomunados</option>
            <option value="Unión Libre">Unión Libre</option>
            <option value="Bienes separados">Bienes separados</option>
          </select>
        </div>
        <div class="VPkfBr">
          <label for="birthdate_spouse-section" class="nDvBVt">Fecha de nacimiento:</label>
          <input id="birthdate_spouse-section" class="darMiL" type="date" disabled/>
        </div>
        <div class="VPkfBr">
          <label for="phone-number_spouse-section" class="nDvBVt">Teléfono:</label>
          <input id="phone-number_spouse-section" class="darMiL" type="tel" disabled/>
        </div>
        <div class="VPkfBr">
          <label for="comercial-activity_spouse-section" class="nDvBVt">Actividad comercial:</label>
          <input id="comercial-activity_spouse-section" class="darMiL" type="text" disabled/>
        </div>
        <div class="VPkfBr">
          <label for="housing_spouse-section" class="nDvBVt">Tipo de vivienda:</label>
          <select id="housing_spouse-section" class="MbIanG" disabled>
            <option value="Primaria">Propia</option>
            <option value="Rentada">Rentada</option>
            <option value="Familiar">Familiar</option>
            <option value="Prestada">Prestada</option>
          </select>
        </div>
        <div class="VPkfBr">
          <label for="home-value_spouse-section" class="nDvBVt">Valor vivienda:</label>
          <input id="home-value_spouse-section" class="darMiL" type="number"/>
        </div>
        <div class="VPkfBr">
          <label for="economic-dependents_spouse-section" class="nDvBVt">Dependientes económicos:</label>
          <input id="economic-dependents_spouse-section" class="darMiL" type="text"/>
        </div>
        <button id="next-button_spouse-section" class="XiNesP">
          <span>Siguiente</span>
          <i class="fa-solid fa-arrow-right"></i>
        </button>
      </div>
      <div id="references-section" class="DIONfu">
        <h2 class="llQbZl">Referencia 1:</h2>
        <div class="LjmOwP">
          <div class="VPkfBr">
            <label for="full-name_reference-1_references-section" class="nDvBVt">Nombre completo:</label>
            <input id="full-name_reference-1_references-section" class="darMiL" type="text" required/>
          </div>
          <div class="VPkfBr">
            <label for="adress_reference-1_references-section" class="nDvBVt">Domicilio:</label>
            <input id="adress_reference-1_references-section" class="darMiL" type="text" required/>
          </div>
          <div class="VPkfBr">
            <label for="phone-number_reference-1_references-section" class="nDvBVt">Teléfono:</label>
            <input id="phone-number_reference-1_references-section" class="darMiL" type="text" required/>
          </div>
          <div class="VPkfBr">
            <label for="relationship_reference-1_references-section" class="nDvBVt">Tipo de relación:</label>
            <input id="relationship_reference-1_references-section" class="darMiL" type="text" required/>
          </div>
        </div>
        <h2 class="llQbZl">Referencia 2:</h2>
        <div class="LjmOwP">
          <div class="VPkfBr">
            <label for="full-name_reference-2_references-section" class="nDvBVt">Nombre completo:</label>
            <input id="full-name_reference-2_references-section" class="darMiL" type="text" required/>
          </div>
          <div class="VPkfBr">
            <label for="adress_reference-2_references-section" class="nDvBVt">Domicilio:</label>
            <input id="adress_reference-2_references-section" class="darMiL" type="text" required/>
          </div>
          <div class="VPkfBr">
            <label for="phone-number_reference-2_references-section" class="nDvBVt">Teléfono:</label>
            <input id="phone-number_reference-2_references-section" class="darMiL" type="text" required/>
          </div>
          <div class="VPkfBr">
            <label for="relationship_reference-2_references-section" class="nDvBVt">Tipo de relación:</label>
            <input id="relationship_reference-2_references-section" class="darMiL" type="text" required/>
          </div>
        </div>
        <h2 class="llQbZl">Beneficiario:</h2>
        <div class="LjmOwP">
          <div class="VPkfBr">
            <label for="full-name_beneficiary_references-section" class="nDvBVt">Nombre completo:</label>
            <input id="full-name_beneficiary_references-section" class="darMiL" type="text" required/>
          </div>
          <div class="VPkfBr">
            <label for="birthdate_beneficiary_references-section" class="nDvBVt">Fecha de nacimiento:</label>
            <input id="birthdate_beneficiary_references-section" class="darMiL" type="date" required/>
          </div>
          <div class="VPkfBr">
            <label for="destination_beneficiary_references-section" class="nDvBVt">Destino:</label>
            <select id="destination_beneficiary_references-section" class="MbIanG">
              <option value="Comercial">Comercial</option>
              <option value="Consumo">Consumo</option>
              <option value="Vivienda">Vivienda</option>
            </select>
          </div>
          <div class="VPkfBr">
            <label for="project_beneficiary_references-section" class="nDvBVt">Proyecto:</label>
            <input id="project_beneficiary_references-section" class="darMiL" type="text" required/>
          </div>
          <div class="JkSHKc">
            <label for="amount_beneficiary_references-section" class="nDvBVt">Monto:</label>
            <input id="amount_beneficiary_references-section" class="darMiL" type="number" required/>
          </div>
          <div class="VPkfBr">
            <label for="term_beneficiary_references-section" class="nDvBVt">Plazo (meses):</label>
            <input id="term_beneficiary_references-section" class="darMiL" type="number" required/>
          </div>
          <div class="JkSHKc">
            <label for="salary_beneficiary_references-section" class="nDvBVt">Sueldo:</label>
            <input id="salary_beneficiary_references-section" class="darMiL" type="number" required/>
          </div>
          <div class="JkSHKc">
            <label for="bills_beneficiary_references-section" class="nDvBVt">Gastos:</label>
            <input id="bills_beneficiary_references-section" class="darMiL" type="number" required/>
          </div>
        </div>
        <button id="next-button_references-section" class="XiNesP">
          <span>Siguiente</span>
          <i class="fa-solid fa-arrow-right"></i>
        </button>
      </div>
      <div id="pld-section" class="meNtIC">
        <div class="dOmxUh">
          <label class="nDvBVt">¿Declara que actúa por cuenta propia?</label>
          <div class="nWbxQe">
            <div class="CvIbEI">
              <input id="pld-1-si_pld-section" name="pld-1" type="radio" value="si"/>
              <label class="nDvBVt" for="pld-1-si_pld-section">Sí</label>
            </div>
            <div class="CvIbEI">
              <input id="pld-1-no_pld-section" name="pld-1" type="radio" value="no"/>
              <label class="nDvBVt" for="pld-1-no_pld-section">No</label>
            </div>
          </div>
        </div>
        <div class="dOmxUh">
          <label class="nDvBVt">¿Actúa a nombre de un tercero?</label>
          <div class="nWbxQe">
            <div class="CvIbEI">
              <input id="pld-2-si_pld-section" name="pld-2" type="radio" value="si"/>
              <label class="nDvBVt" for="pld-2-si_pld-section">Sí</label>
            </div>
            <div class="CvIbEI">
              <input id="pld-2-no_pld-section" name="pld-2" type="radio" value="no"/>
              <label class="nDvBVt" for="pld-2-no_pld-section">No</label>
            </div>
          </div>
        </div>
        <div class="dOmxUh">
          <label class="nDvBVt">¿Declara que un tercero pagará la totalidad o parcialidad del crédito?</label>
          <div class="nWbxQe">
            <div class="CvIbEI">
              <input id="pld-3-si_pld-section" name="pld-3" type="radio" value="si"/>
              <label class="nDvBVt" for="pld-3-si_pld-section">Sí</label>
            </div>
            <div class="CvIbEI">
              <input id="pld-3-no_pld-section" name="pld-3" type="radio" value="no"/>
              <label class="nDvBVt" for="pld-3-no_pld-section">No</label>
            </div>
          </div>
        </div>
        <div class="NcuPhr">
          <label class="nDvBVt">¿Usted desempeña o ha desempeñado funciones públicas destacadas de un país extranjero o en 
            territorio nacional, considerando entre otros, a los jefes de estados o partidos políticos?</label>
          <div class="nWbxQe">
            <div class="CvIbEI">
              <input id="pld-4-si_pld-section" name="pld-4" type="radio" value="si"/>
              <label class="nDvBVt" for="pld-4-si_pld-section">Sí</label>
            </div>
            <div class="CvIbEI">
              <input id="pld-4-no_pld-section" name="pld-4" type="radio" value="no"/>
              <label class="nDvBVt" for="pld-4-no_pld-section">No</label>
            </div>
          </div>
        </div>
        <div class="VPkfBr">
          <label for="pld-4-text_pld-section" class="nDvBVt">En caso afirmativo: Nombre Completo:</label>
          <input id="pld-4-text_pld-section" class="darMiL" type="text"/>
        </div>
        <div class="NcuPhr">
          <label class="nDvBVt">¿Tiene algún familiar que desempeña o ha desempeñado funciones públicas destacadas de un país 
            extranjero o en territorio nacional, considerando entre otros, a los jefes de estados o partidos políticos?</label>
          <div class="nWbxQe">
            <div class="CvIbEI">
              <input id="pld-5-si_pld-section" name="pld-5" type="radio" value="si"/>
              <label class="nDvBVt" for="pld-5-si_pld-section">Sí</label>
            </div>
            <div class="CvIbEI">
              <input id="pld-5-no_pld-section" name="pld-5" type="radio" value="no"/>
              <label class="nDvBVt" for="pld-5-no_pld-section">No</label>
            </div>
          </div>
        </div>
        <div class="VPkfBr">
          <label for="pld-5-text_pld-section" class="nDvBVt">En caso afirmativo: Nombre Completo:</label>
          <input id="pld-5-text_pld-section" class="darMiL" type="text"/>
        </div>
        <button id="send-button" class="XiNesP">
          <span>Enviar</span>
          <i class="fa-solid fa-arrow-up-from-bracket"></i>
        </button>
      </div>
    </form>
  </section>
</body>
<script src="{{asset('js/changeSection.js')}}"></script>
<script src="{{asset('js/changeButtonColor.js')}}"></script>
<script src="{{asset('js/verifyInputData.js')}}"></script>
<script src="{{asset('js/userButton.js')}}"></script>
<script src="{{asset('js/handleCivilStatusSelect.js')}}"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    changeButtonColor();
  });
</script>
</html>