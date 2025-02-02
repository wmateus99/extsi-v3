// Seleciona todos os botões de "Assistir Aula"
document.querySelectorAll('.aula-card button').forEach(button => {
    button.addEventListener('click', () => {
        // Obtém o link do atributo data-link do card da aula
        const link = button.closest('.aula-card').getAttribute('data-link');
        
        // Redireciona para o link especificado
        window.location.href = link;
    });
});
