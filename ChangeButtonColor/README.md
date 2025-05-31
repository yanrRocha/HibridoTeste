# Tarefa #2 - Trocando a cor dos botões

Tags: Back, Front

Um cliente deseja alterar a cor de seus botões diariamente para atrair mais clientes e
encontrar o botão perfeito para sua loja, porém, eles não querem criar um ticket com
o time de atendimento diariamente para realizar essa mudança, logo devem ser
capazes de mudar tudo sem nenhum conhecimento de desenvolvimento em
Magento.

Você precisa criar um comando de console Magento, que receberá um HEX color e o
ID de uma store-view como parâmetros, com isso você precisa modificar a cor de
todos os botões da visualização da store-view selecionada para a cor fornecida.

## O resultado esperado

Desejamos que no final do teste, tenhamos um módulo instalado que permitirá ao
cliente executar o comando:

```
./bin/magento color:change 000000 1
```
Depois de executar este comando no modo developer, todos os botões na
visualização da store-view de ID 1 devem estar na cor Preto, é uma boa ideia verificar
se o cliente não digitará uma loja inexistente ou então um formato errado de cor.


# Instalação

Copie e cole a vendor dentro da app/code do seu projeto Magento 2 e rode os comandos abaixo.

```
bin/magento setup:upgrade 
bin/magento setup:di:compile 
bin/magento cache:clean
```

## Como usar

Existem duas maneiras de serem efetuadas as trocas das cores dos botões.

### Primeiro: CLI command

Através do comando:

```
bin/magento color:change 000000 1
```
Será possível efetuar a troca da cor do botão onde:

1. O primeiro argumento define a cor, devendo ser um HEXADECIMAL.
2. O segundo argumento define o store, devendo ser um store existente.

Além de trocar a cor do botão, o usuário pode também desativar esta mudança.

Utilizando o comando:
```
bin/magento color:change:disable 1
```

Será possível desativar a troca da cor do botão onde:

1. O primeiro argumento define o store, devendo ser um store existente.


### Segundo: Configuração pelo painel do admin

Ao acessar o painel administrativo do Magento 2 vá até:

```
Stores > Configuration > HIBRIDO > Button Color
```

Aqui você poderá alterar se a função está ativa ou não e definir a cor.

Podendo optar por alterar de forma individual cada store, trocando o "Scope".

E deve ser utilizado o colopicker para selecionar a cor, para não ter problemas em inserir uma cor inválida.

>É IMPORTANTE RESSALTAR QUE PODE SE FAZER NECESSARIO A LIMPEZA DOS CACHES SEMPRE QUE A CONFIGURAÇÃO FOR ALTERADA.
