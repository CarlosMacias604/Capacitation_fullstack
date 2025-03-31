//fetch
var nameMove = '';
var namePokemon = '';
fetch('https://pokeapi.co/api/v2/pokemon/')
    .then(res => res.json())
    .then(data => {
        //console.log(data.results);
        //data.results.forEach(element => {
            //const {name} = element;
            //console.log(name);
            //const {url} = element;
            //console.log(url);
            //console.log(element);
        //});
        const result0 = data.results[0];
        namePokemon = result0.name;
        const {url} = result0;
        console.log(namePokemon);
        fetch(url)
            .then(res => res.json())
            .then(data => {
                //console.log(data.moves[0]);
                const resultMove0 = data.moves[0];
                nameMove = resultMove0.move.name;
                console.log(`El primer movimiento de ${namePokemon} es: ${nameMove}`);
            });
    })
    .catch(error => console.log(error));

//async await

const obtenerPokemones = async () => {
    try{
        const res = await fetch('https://pokeapi.co/api/v2/pokemon/');
        const data = await res.json();
        console.log(data.results);
        //use map to get the names of the pokemons
        //const arrayNames = data.results.map(poke => poke.name)
        //use filter to get the name of the pokemon charmander
        const arrayNames = data.results.filter(poke => poke.name === 'charmander')
        console.log(arrayNames);
    }catch (error){
        console.log(error);
    }
}

obtenerPokemones();