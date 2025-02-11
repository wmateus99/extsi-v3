// Função para verificar o progresso da barra com base na quantidade de caracteres
function verificarProgresso(id) {
    const textarea = document.getElementById(id);
    const progress = document.getElementById("progress-" + id); // Atualizado para usar o novo padrão de ID
    const resposta = textarea.value;

    // Calculando a porcentagem
    const porcentagem = Math.min((resposta.length / 120) * 100, 100);
    progress.value = porcentagem;

    // Verificando se a quantidade de caracteres é suficiente para habilitar o botão
    verificarBotaoEnvio();
}

// Função para verificar se todas as respostas têm o mínimo de 120 caracteres
function verificarBotaoEnvio() {
    const respostas = document.querySelectorAll("textarea");
    let podeEnviar = true;

    respostas.forEach((resposta) => {
        if (resposta.value.length < 120) {
            podeEnviar = false;
        }
    });

    const botao = document.getElementById("submit");
    botao.disabled = !podeEnviar;
}