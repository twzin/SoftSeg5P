function login() {
    var form = document.getElementById("formLogin");
    var dados = new FormData(form);
    var senha = dados.get("senha");
    var user = dados.get("usuario");

    var senhaHash = CryptoJS.SHA256(senha).toString();
    dados.set("senha", senhaHash);

    // 🔧 Corrigido: Pega o elemento da mensagem
    var mensagemLoginDiv = document.getElementById("mensagemLogin");

    async function verificaLogin(user, senhaHash) {
        return fetch("../CONTROLLER/login_user.php", {
            method: "POST",
            body: JSON.stringify({ user: user, senha: senhaHash })
        }).then(response => response.json());
    }

    verificaLogin(user, senhaHash).then(response => {
        if (!response.loginExiste) {
            mensagemLoginDiv.style.color = "red";
            mensagemLoginDiv.textContent = "Usuário ou senha inválidos.";
            mensagemLoginDiv.style.display = "block";
            return;
        } else {
            mensagemLoginDiv.style.color = "green";
            mensagemLoginDiv.textContent = "Login com sucesso! Redirecionando...";
            mensagemLoginDiv.style.display = "block";

            setTimeout(() => {
                window.location = ("../VIEW/pagi_inicial.php");
            }, 2000);
        }
    });
}
