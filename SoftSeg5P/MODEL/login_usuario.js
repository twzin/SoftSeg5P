/* -------------------------------------------------
   MODEL/login_usuario.js
   Envia usuário e senha em TEXTO PURO
   Recebe JSON  { loginExiste: true/false }
------------------------------------------------- */

/* --- função principal --- */
async function login() {
    const usuario = document.getElementById("usuario").value.trim();
    const senha   = document.getElementById("senha").value;

    if (!usuario || !senha) {
        alert("Preencha usuário e senha.");
        return;
    }

    /* monta JSON simples */
    const corpo = JSON.stringify({ user: usuario, senha: senha });

    try {
        const resp = await fetch("../CONTROLLER/login_user.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: corpo
        });

        const json = await resp.json();   // { loginExiste:true/false }

        if (json.loginExiste) {
            window.location.href = "perfil.html";
        } else {
            document.getElementById("senha_invalida").innerText = "Usuário ou senha inválidos.";
        }
    } catch (err) {
        console.error(err);
        alert("Erro ao realizar login.");
    }
}
