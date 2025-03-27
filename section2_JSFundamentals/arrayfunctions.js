//functions and arrayfunctions

function sumar (num){
    console.log(num);
};
sumar(10);

const sumar2 = (num1,num2) => {
    return(num2+num1);
};

const resultArrayFunction = sumar2(10,20);  
console.log(resultArrayFunction);

const mensaje = nombre => "Hola " + nombre;

const resultMensaje = mensaje('Carlos');
console.log(resultMensaje);

const sumar3 = (num = 5) => {
    console.log(num + 3);
}

sumar3(0);