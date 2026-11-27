# Louvor CELC — Sistema de Gestão do Ministério de Louvor
![MySQL](https://shields.io/badge/MySQL-lightgrey?logo=mysql&style=plastic&logoColor=white&labelColor=blue)
![PHP](https://img.shields.io/badge/PHP-777BB4?logo=php&logoColor=white)
![JavaScript](https://img.shields.io/badge/-JavaScript-333333?style=flat&logo=javascript)

## Sobre e Motivação do Projeto

O **Louvor CELC** é uma aplicação web desenvolvida como trabalho prático para a disciplina de **Desenvolvimento Back-end**. O projeto nasceu da necessidade real de organizar e centralizar a rotina do ministério de louvor da igreja (CELC), substituindo controles manuais e mensagens dispersas por um sistema único.

Na prática, o sistema resolve problemas recorrentes na organização dos cultos, como saber quem está escalado, qual função cada integrante vai exercer, quais músicas serão tocadas, em qual tonalidade e onde encontrar as cifras de referência, enquanto aplica na prática conceitos fundamentais de desenvolvimento server-side, modelagem relacional, segurança de sessão e manipulação de arquivos.


## Funcionalidades

* **Autenticação e Controle de Sessão:**
  * Tela de login com verificação segura de credenciais utilizando `password_hash` e `password_verify`.
  * Proteção de rotas internas por meio de middleware (`auth/verificar_login.php`), redirecionando usuários não autenticados.
  * Encerramento completo da sessão e limpeza de cookies via `logout.php`.
* **Gestão de Cultos (CRUD Completo):**
  * Criação, edição, listagem em cards e exclusão de cultos com data, horário e título.
  * Filtros de busca na tela inicial por nome do culto ou por integrante escalado.
  * Modal interativo para visualização rápida da escala completa, repertório e cifras do culto selecionado.
  * Operações transacionais no banco de dados (`beginTransaction`, `commit`, `rollBack`) garantindo integridade entre culto, repertório e escala.
* **Repertório e Upload Seguro de Cifras:**
  * Associação dinâmica de múltiplas músicas a um culto com seleção de tonalidade (`C`, `Dm`, `G#`, etc.).
  * Upload opcional de imagens de cifras com validação de tamanho máximo, verificação real de tipo MIME (`finfo`), checagem de integridade com `getimagesize`, geração de nomes aleatórios (`random_bytes`), bloqueio de execução de scripts na pasta de uploads (`.htaccess`) e remoção automática de arquivos antigos ao editar ou excluir.
* **Gestão de Membros:**
  * Cadastro, edição, listagem e exclusão de integrantes do ministério com atribuição de função/instrumento (Vocal, Violão, Guitarra, Teclado, Baixo, Bateria).
* **Catálogo de Músicas:**
  * Registro, edição e remoção de músicas com identificação da versão de referência.

## Ferramentas e Tecnologias Utilizadas

* **Back-end:** PHP 8+ (PDO com Prepared Statements e Transações)
* **Banco de Dados:** MySQL / MariaDB (modelagem relacional com 5 tabelas: `membros`, `musicas`, `cultos`, `repertorio` e `culto_membros`)
* **Front-end:**
  * HTML5 semântico
  * CSS3 modular orientado a classes e variáveis globais (`variables.css`, `navbar.css`, `login.css`, `cultos.css`, `membros.css`, `musicas.css`)
  * JavaScript Vanilla para adição/remoção dinâmica de campos nos formulários e controle do modal de cifras
* **Ambiente de Desenvolvimento:** XAMPP (Apache + MySQL) e Visual Studio Code

## Estrutura de Diretórios

```text
louvor-celc/
├── auth/
│   └── verificar_login.php    # Proteção das páginas restritas
├── config/
│   ├── conexao.php            # Conexão PDO com o MySQL
│   └── upload.php             # Validação e manipulação segura de imagens
├── css/                       # Folhas de estilo modulares separadas por domínio
├── cultos/                    # CRUD de cultos, repertório e escala
├── js/                        # Scripts de interação e manipulação do DOM
├── membros/                   # CRUD de integrantes do ministério
├── musicas/                   # CRUD do catálogo de músicas
├── uploads/cifras/            # Armazenamento das imagens de cifras enviadas
├── index.php                  # Painel principal de cultos
├── login.php                  # Autenticação de usuários
├── logout.php                 # Encerramento de sessão
├── membros.php                # Listagem de membros
└── musicas.php                # Listagem de músicas
