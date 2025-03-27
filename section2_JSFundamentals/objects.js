//Objects
const mascota ={
    nombre: 'Tom',
    edad: 10,
    vivo: true,
    dueños: ['Maria','Jose']
};

console.log(mascota);
console.log(mascota.nombre);
console.log(mascota.dueños[0])

mascota.id = 1;

const {dueños} = mascota;
console.log(dueños[1]);

//Destruvturing objects

const web = {
    nombre: 'google',
    links:{
        primary:{
            googleUrl: 'www.google.com'
        },
        secondary:{
            youtubeUrl: 'www.youtube.com'
        }
    },
    streaming:{
        twitch: 'www.twitch.com'
    }
};

const {links} = web;
const {youtubeUrl} = links.secondary;

console.log(youtubeUrl);