
var map = null;



/*esta funcao carrega o mapa*/
function loadMapScenario() {
    const mapa = document.getElementById("mapa");
    /*cria um objeto de mapa da microsoft e adiciona a div que ira conter o mapa*/
    map = new Microsoft.Maps.Map(document.getElementById("mapa"));
}

//funcao que roda quando o usuario clica enter no input sem escolher uma sugestao



