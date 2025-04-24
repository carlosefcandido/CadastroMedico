# Cadastro Médico

Este projeto é um sistema de cadastro médico que permite a criação, leitura, atualização e exclusão de registros médicos. A aplicação é desenvolvida utilizando HTML, CSS e JavaScript para o front-end e PHP para o back-end, com um banco de dados MySQL.

## Estrutura do Projeto

A organização foi aprimorada para separar melhor as responsabilidades. Agora, a pasta `src` está subdividida da seguinte forma:

```
CadastroMedico
├── public                      # Arquivos públicos e interface do usuário
│   ├── index.php               # Página inicial da aplicação
│   ├── cadastroPaciente.php    # Formulário para cadastro de pacientes
│   ├── cadastroMedico.php      # Formulário para cadastro de registros médicos
│   ├── footer.php              # Rodapé
│   ├── header.php              # Cabeçalho
│   ├── readMedico.php          # Página para listagem dos registros médicos
│   ├── readPaciente.php        # Página para listagem dos pacientes
│   ├── formUpdateMedico.php    # Formulário para atualização dos registros médicos
├── assets                      # Recursos estáticos (CSS, JavaScript, imagens)
│   ├── css
│   │   └── style.css           # Estilos para as páginas HTML
│   └── js
│       └── script.js           # Funcionalidades em JavaScript
├── src                         # Lógica de back-end e acesso ao banco de dados
│   ├── db.php                  # Conexão com o banco de dados MySQL
│   ├── medico                  # Funcionalidades específicas dos registros médicos
│   │   ├── createMedico.php     # Lógica para inserir novos registros médicos
│   │   ├── deleteMedico.php     # Lógica para deletar registros médicos
│   │   ├── medico_functions.php # Funções CRUD para os médicos
│   │   └── updateMedico.php     # Lógica para atualizar registros médicos
│   ├── paciente                # Funcionalidades relacionadas aos pacientes
│   │   ├── createPaciente.php   # Lógica para inserir novos registros de pacientes
│   │   ├── deletePaciente.php   # Lógica para deletar registros de pacientes
│   │   ├── pacienteFunctions.php# Funções CRUD para os pacientes
│   │   └── updatePaciente.php   # Lógica para atualizar registros de pacientes
│   └── evolucao                  # Funcionalidades específicas as evoluções
├── sql                         # Scripts SQL para configuração do banco de dados
│   └── database.sql            # Script para criação das tabelas necessárias
├── index.php                   # Página que redireciona para a página inicial da aplicação
└── README.md                   # Documentação do projeto
```

Essa estrutura facilita a separação entre a camada de apresentação (pasta **public**), a lógica de negócio e o acesso aos dados (pasta **src**) e os scripts de configuração do banco (pasta **sql**). Adapte essa organização conforme as necessidades futuras do projeto.

## Instruções de Configuração

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/carlosefcandido/CadastroMedico
   ```

2. **Configure o Banco de Dados:**
   - Acesse o MySQL e execute o script contido em `sql/database.sql` para criar as tabelas necessárias.

3. **Configuração do PHP:**
   - Edite o arquivo `src/db.php` para definir as configurações de conexão com o banco de dados.

4. **Configuração do Servidor:**
   - Em um ambiente Windows, você pode utilizar o WAMP ou XAMPP para executar o servidor local.

## Uso

- **Página Inicial:**  
  Acesse `seudominio/index.php` para visualizar a página inicial.

- **Cadastro:**  
  Utilize `public/cadastro.php` para cadastrar novos registros médicos.

- **Listagem/Atualização/Exclusão:**  
  Acesse `public/read.php` para visualizar os registros médicos e utilize as ações de editar ou excluir conforme necessário. Para editar, será aberto o formulário `public/update_form.php`.

## Contribuições

Contribuições são bem-vindas! Se você deseja contribuir com melhorias ou correções, sinta-se à vontade para abrir uma issue ou enviar um pull request.

## Licença

Este projeto está licenciado sob a MIT License. Consulte o arquivo [LICENSE](LICENSE) para mais detalhes.