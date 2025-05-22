function cadastrar(){

    var form = document.getElementById("formCadastro");
    var dados = new FormData(form);
    var senha = dados.get("senha");
    var email = dados.get("email");
    dados.get("usuario");
    

    const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!regexEmail.test(email)){
        return;
    }

    if (!senha) {
        return;
    }

    const regexSenhaForte = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/; 
    // Pede uma senha com pelo menos 8 caracteres, incluindo uma letra minúscula, uma letra maiúscula
    // um dígito e um caractere especial

    if (!regexSenhaForte.test(senha)){
        return;
    }

    if (senha) {
        var senhaHash = CryptoJS.SHA256(senha).toString();
        dados.set("senha", senhaHash);
    }

    fetch("../CONTROLLER/cadastra_user.php", {
        method: "POST",
        body: dados 
    });
}