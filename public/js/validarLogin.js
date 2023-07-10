const emailInput = document.getElementById('email'),
      loginBoton = document.getElementById('boton-login'),
      alertaCorreo = document.getElementById('alerta-correo'),
      alertaConvenio = document.getElementById('alerta-convenio');

const validarEmail = () => {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if(emailInput.value.trim() === '') return {valido : false, error: "Complete este espacio"};

  if (!emailRegex.test(emailInput.value)) return {valido : false, error : 'Escriba un correo válido'};

  return {valido : true, error : ''};
};

const validarConvenio = () => {
  if(document.getElementById('convenio').value.trim() === '') return {valido : false, error: "Complete este espacio"};

  return {valido : true, error : ''};
};

loginBoton.addEventListener('click', ev =>{

  if(validarEmail().valido && validarConvenio.valido){
    alertaCorreo.textContent = '';
    alertaConvenio.textContent = '';
  }else {
    ev.preventDefault();
    alertaCorreo.textContent = validarEmail().error;
    alertaConvenio.textContent = validarConvenio().error;
  };
});