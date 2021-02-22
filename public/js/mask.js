$(document).ready(function () {
    $('#valor').mask("#.##0,00", {
        reverse: true
    });

    $('#cep').mask("00000-000", {
        reverse: true
    });

    $('#fees').mask("#00.00", {
        reverse: true
    });

    $("#formu").submit(function () {
        var cont = 0;
        $('#register').prop('disabled', true);

        $("#formu input").each(function () {
            if ($(this).val() == "") {
                cont++;
            }
        });
        if (cont !== 0) {            
            console.log('erro')
            document.getElementById("erro_request").style.display = 'block';
            document.getElementById("erro_request").innerText = 'Por favor preencha todos os campos obrigatórios!';
            $('#register').prop('disabled', false);      
        }
    });


    var options = {
        onKeyPress: function (cpf, ev, el, op) {
            var masks = ['000.000.000-000', '00.000.000/0000-00'];
            $('#cpf_cnpj').mask((cpf.length > 14) ? masks[1] : masks[0], op);
        }
    }
    $('#cpf_cnpj').length > 11 ? $('#cpf_cnpj').mask('00.000.000/0000-00', options) : $('#cpf_cnpj').mask('000.000.000-00#', options);
});
