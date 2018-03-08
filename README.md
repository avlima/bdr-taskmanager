# laravel-dragdrop-taskmanager-rest-api
TODO List Drag and Drop REST API

## Instalação

1 - Banco de dados:

Copie o arquivo `bdr_taskmanager.sql` e execute-o para montar a estrutura de banco.
O arquivo `.env` na raiz do projeto, define os dados de conexão, por tanto edite os dados de conexão de acordo com suas credenciais.

2 - Dependencias do framework

Uma das observações da avaliação era: Frameworks e bibliotecas utilizados para solução devem estar inclusos no repositório.
<br>
Por tanto não há necessidade de rodar composer, as dependências já estou no commit.


3 - Iniciando PHP Built-in web server:

Na raiz do projeto execute:
```bash
php -S 127.0.0.1:8000 -t public/
```

ou

```bash
php -S 0.0.0.0:8000 -t public/
```

Outra opção é configurar o projeto no Apache, porem não descrevo aqui pois a configuração varia entre ambientes utilizados com S.O.

##Copyright and license

Code and documentation copyright (c) 2018, Code released under the New BSD license.
