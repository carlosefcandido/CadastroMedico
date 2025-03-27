# Cadastro Médico

Este projeto é um sistema de cadastro médico que permite a criação, leitura, atualização e exclusão de registros médicos. A aplicação é desenvolvida utilizando HTML, CSS e JavaScript para o front-end e PHP para o back-end, com um banco de dados MySQL.

## Estrutura do Projeto

```
CadastroMedico
├── public
│   ├── index.php         # Página inicial da aplicação
│   ├── cadastro.php      # Formulário para cadastro de registros médicos
│   ├── read.php          # Página para listagem e navegação dos registros médicos
│   ├── update_form.php   # Formulário para atualização dos registros médicos
│   └── assets            # Pasta contendo recursos estáticos
│       ├── css
│       │   └── style.css # Estilos para as páginas HTML
│       └── js
│           └── script.js # Funcionalidades em JavaScript
├── src
│   ├── config.php        # Configurações da aplicação PHP (opcional)
│   ├── db.php            # Conexão com o banco de dados MySQL
│   ├── create.php        # Lógica para inserir novos registros médicos
│   ├── read.php          # Lógica para recuperar registros médicos (backend)
│   ├── update.php        # Lógica para atualizar registros médicos existentes
│   └── delete.php        # Lógica para deletar registros médicos
├── sql
│   └── database.sql      # Script SQL para criação das tabelas do banco de dados
└── README.md             # Documentação do projeto
```

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