# aplicacao-web-aws

Esse repositório apresenta 2 arquivos em php onde os 2 são exemplos de uma aplicação web com códigos de front-end como algumas caixas de input e um botão de "Add Data" integrados com um banco de dados capaz de realizar as manipulações Create e Read, do CRUD, por meio dos endpoints GET e POST.

O arquivo _Employee.php_ é um código tirado diretamente do tutorial da aws sobre integração do banco de dados no RDS com a EC2, ele serviu como uma inspiração e uma boa base. Nele é possível fazer o cadastro de funcionarios inserindo apenas os dados "Nome" e "Endereço".

Já o arquivo _Movies.php_ foi desenvolvido por mim, onde é possível fazer o cadastro de filmes inserindo dados como "Nome do filme", "Ator principal", "Custo do filme" e "Avaliação". A estrutura de cada um dos dados disponiveis pode ser separada como:

**NAME** - text (VARCHAR) <br>
**ACTOR** - text (VARCHAR) <br>
**BUDGE** - number (INT) <br>
**RATE** - radio: 'Good' ou 'Bad' (ENUM)

**Link do vídeo com explicação mais detalhada sobre o funcionamento e demonstração da aplicação:** https://drive.google.com/file/d/1c1st9CZ8nvK1emv5DiGWX8pn8046Tw5Y/view?usp=sharing
