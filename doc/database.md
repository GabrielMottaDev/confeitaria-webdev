## 📄Arquivo
[Faça o download do banco de dados de exemplo][database]

## 🛠️Criação de tabelas
```sql
CREATE TABLE `contatos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `lojas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `img_dir` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `func_1` varchar(32) NOT NULL,
  `func_2` varchar(32) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `whatsapp` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `img_dir` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `featured` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto_id` int(11) NOT NULL,
  `loja_id` int(11) NOT NULL,
  `status` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` varchar(16) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(16) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `pedidos_loja_id` FOREIGN KEY (`loja_id`) REFERENCES `lojas` (`id`),
  CONSTRAINT `pedidos_produto_id` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`)
);
```

## 🔧Inicialização/Dados para teste
```sql
INSERT INTO `contatos` (`id`, `name`, `email`, `phone`, `subject`, `message`) VALUES
(1, 'Gabriel Motta', 'gabrielmottadev@gmail.com', '21900000000', 'elogio', 'Este é um elogio'),
(2, 'Gabriel Motta', 'gabrielmottadev@gmail.com', '21980000000', 'reclamação', 'Esta é uma reclamação');

INSERT INTO `lojas` (`id`, `name`, `img_dir`, `address`, `func_1`, `func_2`, `phone`, `whatsapp`) VALUES
(1, 'Barra Shopping - Rio de Janeiro', 'rsrc/img/lojas/barra-shopping.webp', 'Av. das Américas, 4666, Loja 485, 2º Piso - Barra da Tijuca, Rio de Janeiro - RJ, 22640-102', '10h às 23h', '12h às 22h', '2124318182', '2124318182'),
(2, 'Rio Sul - Rio de Janeiro', 'rsrc/img/lojas/riosul.webp', 'Rua Lauro Müller, 116, Loja 235, 1º Piso - Botafogo, Rio de Janeiro - RJ, 22290-160', '10h às 23h', '12h às 22h', '2124318182', '2124318182'),
(3, 'JK Iguatemi - São Paulo', 'rsrc/img/lojas/jk-iguatemi.webp', 'Av. Pres. Juscelino Kubitschek, 2041, Loja 368, 2º Piso - Vila Olímpia, São Paulo - SP, 04543-011', '10h às 23h', '12h às 22h', '2124318182', '2124318182');

INSERT INTO `produtos` (`id`, `name`, `img_dir`, `description`, `price`, `featured`) VALUES
(1, 'Red Velvet', 'rsrc/img/produtos/redvelvet.jpeg', 'Massa vermelha a base de chocolate + 3 camadas de recheio de buttercream (creme manteiga) + coberta com chantilly, farelos de massa vermelha e uma fina camada de massa vermelha na laterais. *Torta Premium serve até 10 fatias.', '85.00', 1),
(2, 'Mousse de Chocolate', 'rsrc/img/produtos/mousse.jpeg', 'Massa de chocolate com recheio de creme de chocolate ao leite e cobertura de chocolate, morangos inteiros para decorar. *Torta Especial serve até 20 fatias.', '85.00', 1),
(3, 'Chocolate Premium', 'rsrc/img/produtos/chocolate.jpeg', 'Massa de chocolate, recheio de creme de avelã com pedaços de avelã e cobertura de brigadeiro com raspas de chocolate. *Torta Premium serve até 20 fatias. ', '75.00', 1),
(4, 'Red Velvet 2', 'rsrc/img/produtos/redvelvet.jpeg', 'Massa vermelha a base de chocolate + 3 camadas de recheio de buttercream (creme manteiga) + coberta com chantilly, farelos de massa vermelha e uma fina camada de massa vermelha na laterais. *Torta Premium serve até 10 fatias.', '85.00', 0),
(5, 'Mousse de Chocolate 2', 'rsrc/img/produtos/mousse.jpeg', 'Massa de chocolate com recheio de creme de chocolate ao leite e cobertura de chocolate, morangos inteiros para decorar. *Torta Especial serve até 20 fatias.', '85.00', 0),
(6, 'Chocolate Premium 2', 'rsrc/img/produtos/chocolate.jpeg', 'Massa de chocolate, recheio de creme de avelã com pedaços de avelã e cobertura de brigadeiro com raspas de chocolate. *Torta Premium serve até 20 fatias. ', '75.00', 0);

INSERT INTO `pedidos` (`id`, `produto_id`, `loja_id`, `status`, `password`, `code`, `name`, `email`, `phone`) VALUES
(1, 1, 1, 'Aguardando retirada', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '65289858', 'Gabriel Motta', 'gabrielmottadev@gmail.com', '21980000000');
```

[database]:https://github.com/GabrielMottaDev/confeitaria-webdev/tree/master/doc/confeitaria.sql