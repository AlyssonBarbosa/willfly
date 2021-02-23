$(document).ready(function () {
    $('#valor').mask("#.##0,00", {
        reverse: true
    });

    $('#cep').mask("00000-000", {
        reverse: true
    });

    $('#fees').mask("0,0", {
        reverse: true
    });

    function message(icon, title, text){
        Swal.fire({
            icon: icon,
            title: title,
            text: text,        
        })
    }

    $("#formu").submit(function () {
        var cont = 0;
        $('#register').prop('disabled', true);
        $("#loading").show();

        
        $("#formu input").each(function () {    
            
            if($(this).attr("id") !== 'instructions' && $(this).attr("id") !== 'fees' && $(this).attr("id") !== undefined){
                console.log($(this).attr("id"))  
                if ($(this).val() == "") {
                    cont++;
                }
            }            
            
        });        
        if (cont !== 0) {            
            $("#loading").hide();
            $("#billing").click();
            $('#register').prop('disabled', false);      
            message('error','Ops...','Um erro aconteceu!');
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
