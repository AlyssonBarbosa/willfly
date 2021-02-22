function limpa_formulário_cep() {
    //Limpa valores do formulário de cep.
    document.getElementById('rua').value = ("");
    document.getElementById('cidade').value = ("");
    document.getElementById('uf').value = ("");
}

function show() {
    let cpf_cnpj = document.getElementById('cpf_cnpj');

    if (cpf_cnpj.value.length == 14) {
        console.log(cpf_cnpj.length)
        console.log(document.getElementById('cpf_cnpj').setAttribute('data-inputmask', "'mask': '99.999/9799.99', 'greedy' : false"))
    } else {
        console.log(cpf_cnpj.length)
    }

}

function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('rua').value = (conteudo.logradouro) + ', ' + (conteudo.bairro);
        document.getElementById('cidade').value = (conteudo.localidade);
        document.getElementById('uf').value = (conteudo.uf);
        document.getElementById('erro_cep').style.display = 'none';
    } //end if.
    else {
        //CEP não Encontrado.
        limpa_formulário_cep();
        document.getElementById('erro_cep').style.display = 'block';
        document.getElementById('erro_cep').innerText = 'Cep não encontrado';
    }
}


function pesquisacep(valor) {

    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if (validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('rua').value = "...";
            document.getElementById('cidade').value = "...";
            document.getElementById('uf').value = "...";


            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);

        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep();
            document.getElementById("erro_cep").style.display = 'block';
            document.getElementById("erro_cep").innerText = 'Formato cep invalido';
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
};
