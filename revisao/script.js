// Seleciona todos os botões de "Ver Curso"
document.querySelectorAll('.curso-card button').forEach(button => {
    button.addEventListener('click', () => {
        // Obtém o link do atributo data-link do card do curso
        const link = button.closest('.curso-card').getAttribute('data-link');
        
        // Redireciona para o link especificado
        window.location.href = link;
    });
});
