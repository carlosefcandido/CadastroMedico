// Aguarda até que todo o DOM seja carregado
document.addEventListener('DOMContentLoaded', function() {
    // Seleciona o formulário pelo seu ID
    const form = document.getElementById('cadastroForm');

    // Adiciona um listener para o evento de submit do formulário
    form.addEventListener('submit', function(event) {
        // Impede o comportamento padrão de envio do formulário
        event.preventDefault();

        // Valida os campos do formulário; se a validação for bem-sucedida, submete o formulário
        if (validateForm()) {
            form.submit();
        }
    });

    // Função para validar os campos do formulário
    function validateForm() {
        // Seleciona o valor de cada campo usando o ID correspondente
        const nome = document.getElementById('nome').value;
        const cpf = document.getElementById('cpf').value;
        const rg = document.getElementById('rg').value;
        const dataNascimento = document.getElementById('data_nascimento').value;
        const telefone = document.getElementById('telefone').value;
        const email = document.getElementById('email').value;
        const endereco = document.getElementById('endereco').value;
        const crm = document.getElementById('numero_crm').value;
        const estadoCRM = document.getElementById('estado_crm').value;
        const especialidades = document.getElementById('especialidades').value;

        // Verifica se algum dos campos obrigatórios está vazio
        if (!nome || !cpf || !rg || !dataNascimento || !telefone || !email || !endereco || !crm || !estadoCRM || !especialidades) {
            // Se algum campo obrigatório estiver vazio, exibe um alerta para o usuário
            alert('Por favor, preencha todos os campos obrigatórios.');
            return false;
        }

        // Se todas as validações passarem, retorna true para permitir o envio do formulário
        return true;
    }
});