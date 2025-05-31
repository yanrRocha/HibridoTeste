# Teste #1 - Meta Tag em Multi-site ( MetaTagMultiSite )

Tags: Back

O cliente tem uma configuração multi-site com algumas páginas CMS que são
compartilhadas entre diferentes sites, porém isso está causando problemas de
conteúdo duplicado e afetando seus rankings de SEO, para resolver isso, precisamos
criar um novo módulo que fará o seguinte:

1. Adicione um bloco ao head
2. O bloco deve ser capaz de identificar o ID da página CMS e verificar se a
   página é usada em múltiplas store-views

3. Nesse caso, deve adicionar uma Meta Tag hreflang ao head para cada
   store-view que a página esteja ativa
4. As Meta Tag’s devem exibir o idioma da loja (exemplo: en-gb, en-us, pt-br,
   etc...)

A estrutura da Meta Tag é a seguinte:
```
<link rel="alternate" hreflang="<?= $storeLanguage ?>" href="<?= $baseUrl . $cmsPageUrl ?>">
```

## O resultado esperado

Existem três store-views configuradas na instalação Magento, uma para o Brasil,
outra para os EUA e outra para a Inglaterra, o idioma do Brasil está definido como
pt-br, o dos EUA está definido como en-us e o da Inglaterra como en-gb, todos
configurados como o idioma padrão da store-view.
As URL’s base estão configuradas igualmente (exemplo: https://www.hibrido.com.br/)
e a configuração de adicionar o código das store-views na URL está habilitada,
exemplos abaixo:

- Brasil: https://www.hibrido.com.br/pt-br/
- EUA: https://www.hibrido.com.br/en-us/
- Inglaterra: https://www.hibrido.com.br/en-gb/

Em uma página CMS de Sobre Nós que está atribuída nas três store-views e que possuí a URL Key about-us, quando essa
página for carregada, o novo bloco no cabeçalho deverá adicionar as seguintes Meta Tags:

```
<link rel="alternate" hreflang="pr-br" href="https://www.hibrido.com.br/pt-br/about-us/">
<link rel="alternate" hreflang="en-us" href="https://www.hibrido.com.br/en-us/about-us/">
<link rel="alternate" hreflang="en-gb" href="https://www.hibrido.com.br/en-gb/about-us/">
```

Detalhe que o conteúdo da página será sempre o mesmo (e não é importante para o teste).

Você precisa ter certeza de que o código funcionará com qualquer número de lojas
dentro de uma loja Magento, desde que a loja tenha um idioma personalizado
definido e adicione uma Meta Tag para cada uma das lojas às quais a página CMS
está atribuída.

# Instalação

Copie e cole a vendor dentro da app/code do seu projeto Magento 2 e rode os comandos abaixo.

```
bin/magento setup:upgrade 
bin/magento setup:di:compile 
bin/magento cache:clean
```

## Como usar

Ao acessar o painel administrativo do Magento 2 vá até:

```
Stores > Configuration > HIBRIDO > Metatag
```

Aqui você poderá alterar se a função está ativa ou não.

Podendo optar por alterar de forma individual cada store, trocando o "Scope".


>É IMPORTANTE RESSALTAR QUE PODE SE FAZER NECESSARIO A LIMPEZA DOS CACHES SEMPRE QUE A CONFIGURAÇÃO FOR ALTERADA.


# Tarefa #2 - Trocando a cor dos botões ( ChangeButtonColor )

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
