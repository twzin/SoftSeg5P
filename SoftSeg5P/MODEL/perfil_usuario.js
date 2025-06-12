document.addEventListener("DOMContentLoaded", () => {
    fetch("../CONTROLLER/user_session.php")
        .then(resp => {
            if (resp.status === 401) {
                window.location.href = "login.html";   // não logado → login
                return null;
            }
            return resp.json();
        })
        .then(data => {
            if (!data) return;                         // já redirecionou
            document.getElementById("perfilUsuario").textContent = data.user;
            document.getElementById("perfilEmail").textContent  = data.email;
            document.getElementById("perfilBio").textContent    = data.biografia;
        })
        .catch(err => {
            console.error("Erro ao buscar perfil:", err);
            alert("Erro ao carregar perfil.");
        });
});
