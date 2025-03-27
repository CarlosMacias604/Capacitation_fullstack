//var vs let vs const
let edad = 40;

if(true){
    let edad = 10;
    console.log(edad);
}

console.log(edad);   

const arrayNumero = [1,2,3];
arrayNumero.push(4);
console.log(arrayNumero);

const persona = {
    nombre: "carlos",
    edad: 20
}

persona.nombre = "Juan";
console.log(persona);