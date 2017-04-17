$(document).ready(function () {
    CarregarCategorias();
    
});
function CarregarCategorias() {
    $.ajax({
        url: "Action/CategoriaAction.php?req=1",
        data: {},
        dataType: "JSON",
        contentType: "application/json",
        type: "GET",
        success: function (retorno) {
            MontarSelectCategoria(retorno);
        },
        error: function (erro) {
            console.log(erro);
        }
    });
}

function MontarSelectCategoria(data) {
    var categoria = [];
    var subCategoria = [];
    
    for (var i = 0; i < data.length; i++) {
        
        if(data[i].Subcatecoria !=null){
            categoria = data [i];
        }else{
            subCategoria = data[i];
        }
    }
    
    console.log(subCategoria);
}

