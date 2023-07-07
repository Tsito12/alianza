const inputTotalQuincena = document.getElementById('quincena');
const inputMontoDisponible = document.getElementById('disponible');
const inputPagoMaximo = document.getElementById('pago-maximo');
const inputPagoMinimo = document.getElementById('pago-minimo');
const inputRange = document.getElementById('range');
const inputNumberRange = document.getElementById('number-range');
const botonMas = document.getElementById('boton-mas');
const botonMenos = document.getElementById('boton-menos');
const inputMeses = document.getElementById('meses');

var intervaloID;

const calcularMaximo = (min, max) => {

    while(min <= max){
        min += 50;
    };

    min -= 50;

    return min;
};

const calcularMontos = (disponible) => {
    const pagoMinimo = Math.trunc(disponible * .1);
    const minimoRedondeado = Math.ceil(pagoMinimo/10) * 10;
    const pagoMaximo = Math.trunc(disponible * .4);
    
    inputPagoMinimo.value = pagoMinimo;
    inputPagoMaximo.value = pagoMaximo;
    inputRange.min = minimoRedondeado;
    inputRange.max = calcularMaximo(minimoRedondeado, pagoMaximo);
    inputRange.value = (parseInt(inputRange.max) + parseInt(inputRange.min)) / 2;
    inputNumberRange.value = inputRange.value;
};

const actualizarMontos = () => {

    const quincena = parseInt(inputTotalQuincena.value);
    const disponible = parseInt(inputMontoDisponible.value);

    if(quincena && disponible){

        if(quincena >= disponible){
            alertaDisponible.textContent = '';

            calcularMontos(disponible);
        };

        if(quincena < disponible){
            alertaDisponible.textContent = `Según los datos. El monto no puede ser mayor a $ ${quincena}.00`;
        };
    };
};

const actualizarValores = () => {
    inputNumberRange.value = inputRange.value;
};

const sumar = () => {
    if(parseInt(inputMeses.value) < 24) inputMeses.value++;

    if(parseInt(inputMeses.value) === 24) botonMas.classList.add('gris');
    if(parseInt(inputMeses.value) !== 3) botonMenos.classList.remove('gris');
};

const restar = () => {
    if(parseInt(inputMeses.value) > 3) inputMeses.value--;

    if(parseInt(inputMeses.value) === 3) botonMenos.classList.add('gris');
    if(parseInt(inputMeses.value) !== 24) botonMas.classList.remove('gris');
};

const manejarMouseDown = callback => {
    callback();

    intervaloID = setInterval(callback, 200);
};

const manejarMouseUp = () => {
    clearInterval(intervaloID);
};

botonMas.addEventListener('mousedown', () => manejarMouseDown(sumar));
botonMas.addEventListener('mouseup', manejarMouseUp);
botonMas.addEventListener('mouseleave', manejarMouseUp);
botonMenos.addEventListener('mousedown', () => manejarMouseDown(restar));
botonMenos.addEventListener('mouseup', manejarMouseUp);
botonMenos.addEventListener('mouseleave', manejarMouseUp);
inputTotalQuincena.addEventListener('keyup', actualizarMontos);
inputMontoDisponible.addEventListener('keyup', actualizarMontos);
inputRange.addEventListener('input', actualizarValores);