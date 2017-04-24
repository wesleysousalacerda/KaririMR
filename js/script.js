$(document).ready(function () {
    CarregarCategorias();

    $("#btnBuscar").click(function () {
        
        var termo = $("#txtBusca").val();
        var categoria = $("#slBusca").val();
        if (termo.length >= 1 && categoria >=1) {
            document.location.href = "?pagina=categoria&cat=" + categoria + "&termo=" + termo;
        }else{
            termo = null;
            document.location.href = "?pagina=categoria&cat=" + categoria;
        }
    });

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

        if (data[i].Subcategoria == null) {
            categoria.push(data[i]);
        } else {
            subCategoria.push(data[i]);
        }
    }

    var slBusca = document.getElementById("slBusca");

    var optionDefault = document.createElement("option");
    optionDefault.setAttribute("selected", "selected");
    optionDefault.innerText = "Categoria: ";

    slBusca.appendChild(optionDefault);

    for (var i = 0; i < categoria.length; i++) {
        var optgroup = document.createElement("optgroup");
        optgroup.label = categoria[i].Nome;

        for (var j = 0; j < subCategoria.length; j++) {
            if (subCategoria[j].Subcategoria == categoria[i].Cod) {
                var option = document.createElement("option");
                option.innerHTML = subCategoria[j].Nome;
                option.setAttribute("value", subCategoria[j].Cod);
                optgroup.appendChild(option);
            }
        }

        slBusca.appendChild(optgroup);
    }


}

