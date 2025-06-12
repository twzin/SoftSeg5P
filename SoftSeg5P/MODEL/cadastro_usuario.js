/* -------------------------------------------------
   MODEL/cadastro_usuario.js
   Envia usuário, e-mail, senha e biografia
   e recebe resposta JSON do PHP.
------------------------------------------------- */

/* === Regex de validação === */
const REGEX_EMAIL  = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const REGEX_MAIUSC = /[A-Z]/;
const REGEX_MINUSC = /[a-z]/;
const REGEX_NUM    = /\d/;
const REGEX_ESPEC  = /[@$!%*?&]/;

/* === Checklist dinâmico === */
const senhaInput = document.getElementById("senha");
senhaInput.addEventListener("input", e => atualizaChecklist(e.target.value));

function atualizaChecklist(s) {
    document.getElementById("comprimento").style.color = s.length >= 8 ? "#b2ffc8" : "#ffaaaa";
    document.getElementById("maiuscula").style.color  = REGEX_MAIUSC.test(s) ? "#b2ffc8" : "#ffaaaa";
    document.getElementById("minuscula").style.color  = REGEX_MINUSC.test(s) ? "#b2ffc8" : "#ffaaaa";
    document.getElementById("numero").style.color     = REGEX_NUM.test(s)    ? "#b2ffc8" : "#ffaaaa";
    document.getElementById("caractere").style.color  = REGEX_ESPEC.test(s)  ? "#b2ffc8" : "#ffaaaa";
}

/* === Função principal === */
async function cadastrar() {
    const usuario   = document.getElementById("usuario").value.trim();
    const email     = document.getElementById("email").value.trim();
    const senha     = senhaInput.value;
    const biografia = document.getElementById("biografia").value.trim();

    // Validações rápidas
    if (!usuario || !email || !senha) {
        alert("Preencha todos os campos obrigatórios.");
        return;
    }
    if (!REGEX_EMAIL.test(email)) {
        alert("E-mail inválido.");
        return;
    }
    if (
        senha.length < 8 ||
        !REGEX_MAIUSC.test(senha) ||
        !REGEX_MINUSC.test(senha) ||
        !REGEX_NUM.test(senha) ||
        !REGEX_ESPEC.test(senha)
    ) {
        alert("A senha não atende aos requisitos mínimos.");
        return;
    }

    // Monta FormData
    const fd = new FormData();
    fd.append("usuario",   usuario);
    fd.append("email",     email);
    fd.append("senha",     senha);
    fd.append("biografia", biografia);

    try {
        const resp = await fetch("../CONTROLLER/cadastra_user.php", {
            method: "POST",
            body: fd
        });
        const json = await resp.json();   // PHP devolve JSON

        const msgDiv = document.getElementById("mensagemCadastro");
        msgDiv.style.display = "block";
        msgDiv.innerText = json.msg;

        if (json.ok) {
            document.getElementById("formCadastro").reset();
            atualizaChecklist("");
        }
    } catch (err) {
        console.error(err);
        alert("Erro ao cadastrar usuário.");
    }
}
