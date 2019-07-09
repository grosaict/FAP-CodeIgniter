$(document).ready(function() {

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#rua").html("");
        $("#complemento").val("");
        $("#bairro").html("");
        $("#cidade").html("");
        $("#uf").html("");
        $("#form-message").show();
        $("#allow-submit").hide();
    }
    
    //Quando o campo cep perde o foco.
    $("#cep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {
            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep) && (cep > 90000000 && cep < 91999999)) { //Faixa de POA = 90000000 a 91999999

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#rua").html("...");
                $("#complemento").val("...");
                $("#bairro").html("...");
                $("#cidade").html("...");
                $("#uf").html("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#rua").html(dados.logradouro);
                        $("#complemento").val(dados.complemento);
                        $("#bairro").html(dados.bairro);
                        $("#cidade").html(dados.localidade);
                        $("#uf").html(dados.uf);
                        $("#form-message").hide();
                        $("#allow-submit").show();
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido ou de fora de Porto Alegre.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
});