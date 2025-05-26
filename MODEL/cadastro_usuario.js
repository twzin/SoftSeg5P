function cadastrar(){

    var form = document.getElementById("formCadastro");
    var dados = new FormData(form);
    var senha = dados.get("senha");
    var email = dados.get("email");
    var user = dados.get("usuario");
    var mensagemCadastroDiv = document.getElementById("mensagemCadastro");

    

    const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!regexEmail.test(email)){
        mensagemCadastroDiv.style.color = "red";
        mensagemCadastroDiv.textContent = "E-mail inválido";
        mensagemCadastroDiv.style.display = "block";
        return;
    }

    if (!senha) {
        mensagemCadastroDiv.style.color = "red";
        mensagemCadastroDiv.textContent = "A senha não pode estar em branco";
        mensagemCadastroDiv.style.display = "block";
        return;
    }

    const regexSenhaForte = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/; 
    // Pede uma senha com pelo menos 8 caracteres, incluindo uma letra minúscula, uma letra maiúscula
    // um dígito e um caractere especial

    if (!regexSenhaForte.test(senha)){
        mensagemCadastroDiv.style.color = "red";
        mensagemCadastroDiv.textContent = "Senha inválida";
        mensagemCadastroDiv.style.display = "block";
        return;
    }

    if (senha) {
        var senhaHash = CryptoJS.SHA256(senha).toString();
        dados.set("senha", senhaHash);
    }


    var senhaHash = CryptoJS.SHA256(senha).toString();
    dados.set("senha", senhaHash);
    

    async function verificaCadastro(user, senhaHash) {
        return fetch("../CONTROLLER/cadastra_user.php", {
            method: "POST",
            body: JSON.stringify({ user: user, senha: senhaHash, email: email })
        }).then(response => response.json());
    }

     verificaCadastro(user, senhaHash).then(response => {
        if (!response.CadastroFeito) {
            return;
        } else {
            console.log("Cadastro feito com sucesso!");
            mensagemCadastroDiv.style.color = "green";
            mensagemCadastroDiv.textContent = "Cadastro feito com sucesso! Redirecionando...";
            mensagemCadastroDiv.style.display = "block";

            setTimeout(() => {
                window.location = ("../VIEW/login.html");
            }, 2000);
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    const senhaInput = document.getElementById("senha");

    senhaInput.addEventListener("input", function () {
        const senha = senhaInput.value;

        const comprimento = senha.length >= 8;
        const maiuscula = /[A-Z]/.test(senha);
        const minuscula = /[a-z]/.test(senha);
        const numero = /[0-9]/.test(senha);
        const caractere = /[@$!%*?&]/.test(senha);

        atualizarCor("comprimento", comprimento);
        atualizarCor("maiuscula", maiuscula);
        atualizarCor("minuscula", minuscula);
        atualizarCor("numero", numero);
        atualizarCor("caractere", caractere);
    });

    function atualizarCor(id, valido) {
        const item = document.getElementById(id);
        if (valido) {
            item.style.color = "green";
        } else {
            item.style.color = "red";
        }
    }
});
