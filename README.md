# Nyfelps-site

Site criado para a entrega do trabalho A2 da matéria de Desenvolvimento de Sistemas do curso de Análise e Desenvolvimento de Sistemas da Universidade Positivo.

O site foi desenvolvido por Felipe Muniz da Rosa e Nycolas Polatto Roberto.

O trabalho foi Orientado pelo professor Andre Luis Jeller Selleti.

O tema escolhido foi "Cadastro de jogos favoritos".

Ementa do trabalho:

"Você e sua dupla foram contratados para desenvolver um pequeno sistema para um cliente que deseja um catálogo online dinâmico.
Esse sistema deve permitir que qualquer visitante visualize os itens cadastrados (filmes, livros, produtos, receitas, etc.) e, opcionalmente, aplique filtros simples de navegação (como por gênero, tipo, categoria).
Além disso, o cliente deseja uma área restrita do site, acessível apenas para usuários logados, onde funcionalidades extras podem ser oferecidas."

A proposta foi descrita pelo professor, e deve conter:

  - Uma página inicial (index.php) que mostre os itens do catálogo percorrendo um array e exibindo
cada item com imagem, título e categoria. Cada item deve conter um botão "Ver mais" que leve a
uma página de detalhes passando um identificador via GET.
  - Uma página de detalhes (detalhes.php) que exiba informações completas sobre o item clicado.
  - Uma página de filtro (filtrar.php) com um formulário GET que permita filtrar os itens por
categoria ou tipo.
  - Uma página de login (login.php) com um formulário POST validando nome de usuário e senha
fixos (armazenados com hash). Se os dados forem válidos, uma sessão deve ser iniciada.
  - Uma página protegida (protegido.php) acessível apenas para usuários logados. Se não houver
sessão ativa, redirecionar para o login.
  - Dentro da página protegida, o usuário deve poder cadastrar um novo item via formulário POST.
Esse novo item deve ser armazenado na sessão e imediatamente incluído na listagem principal
(index).


Para sua avaliação e atribuição de nota, o site deve, além de ser funcional, preencher os seguintes requisitos:

  - Criação e uso de variáveis e arrays associativos para armazenar os itens do catálogo.
  - Uso de estruturas condicionais (if, else, switch) e laços de repetição (for, foreach) para
gerar conteúdo dinâmico.
  - Criação de funções reutilizáveis com parâmetros e retorno.
  - Recebimento de dados por GET e POST, manipulação de strings e arrays.
  - Uso de include ou require para organizar o projeto.
  - Controle de sessão e autenticação com password_hash() e password_verify().
