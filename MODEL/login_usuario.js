function login(){

    var form= document.getElementById("formLogin");
    var dados = new FormData(form);
    var senha = dados.get("senha");
    var user = dados.get("usuario")

      if (!senha || !user) {
        return;
    }

    var senhaHash = CryptoJS.SHA256(senha).toString();
    dados.set("senha", senhaHash);
    

    async function verificaLogin(user, senhaHash) {
        return fetch("../CONTROLLER/login_user.php", {
            method: "POST",
            body: JSON.stringify({ user: user, senha: senhaHash })
        }).then(response => response.json());
    }

     verificaLogin(user, senhaHash).then(response => {
        if (!response.loginExiste) {
            console.log("not exists");
            return;
        } else {
            console.log("exists");
            window.location = ("../VIEW/pagi_inicial.php");
            
        }
    });

}