document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("formPost");
    const mensagem = document.getElementById("mensagem");

    form.addEventListener("submit", async function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        try {
            const response = await fetch("../CONTROLLER/cria_post.php", {
                method: "POST",
                body: formData,
            });

            const result = await response.json();

            if (result.success) {
                mensagem.innerText = "Post criado com sucesso!";
                mensagem.style.color = "green";
                form.reset();
            } else {
                mensagem.innerText = "Erro: " + result.message;
                mensagem.style.color = "red";
            }
        } catch (error) {
            mensagem.innerText = "Erro na requisição.";
            mensagem.style.color = "red";
        }
    });
});
