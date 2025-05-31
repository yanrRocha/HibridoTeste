# Teste #1 - Meta Tag em Multi-site

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
