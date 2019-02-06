USE JOTUN;

INSERT INTO `pedidos`(`NOMBRE`, `CORREO`, `TELEFONO`, `COMENTARIO`, `FECHA`, `FECHA_ENTREGA`, `ESTADO`) VALUES ('Mikel Ferreiro','mikelferreiroguridi@gmail.com','666666666','Que este preparado a primera hora ¡Por favor!','2019-01-23','2019-01-31','P');
INSERT INTO `pedidos`(`NOMBRE`, `CORREO`, `TELEFONO`, `COMENTARIO`, `FECHA`, `FECHA_ENTREGA`, `ESTADO`) VALUES ('Luis Daniel Barraguesh','danibarra@gmail.com','666666666','Salsas a parte plis','2019-01-23','2019-01-31','P');
INSERT INTO `pedidos`(`NOMBRE`, `CORREO`, `TELEFONO`, `FECHA`, `FECHA_ENTREGA`, `ESTADO`) VALUES ('Alexsandro Ruiz','alexruiz@gmail.com','666666666','2019-01-20','2019-02-01','P');

INSERT INTO `pedidos`(`NOMBRE`, `CORREO`, `TELEFONO`, `FECHA`, `FECHA_ENTREGA`, `ESTADO`) VALUES ('Jorge','soyjorge@gmail.com','666666666','2019-01-02','2019-01-31','A');
INSERT INTO `pedidos`(`NOMBRE`, `CORREO`, `TELEFONO`, `COMENTARIO`, `FECHA`, `FECHA_ENTREGA`, `ESTADO`) VALUES ('Marcos','marcoss@gmail.com','666666666','Sin salsas','2019-01-25','2019-02-01','A');
INSERT INTO `pedidos`(`NOMBRE`, `CORREO`, `TELEFONO`, `FECHA`, `FECHA_ENTREGA`, `ESTADO`) VALUES ('Ana','anaana@gmail.com','666666666','2019-01-23','2019-01-31','A');

INSERT INTO `pedidos`(`NOMBRE`, `CORREO`, `TELEFONO`, `COMENTARIO`, `FECHA`, `FECHA_ENTREGA`, `ESTADO`) VALUES ('Marta','martatata@gmail.com','666666666','Las pencas sin queso','2019-01-25','2019-02-08','N');
INSERT INTO `pedidos`(`NOMBRE`, `CORREO`, `TELEFONO`, `FECHA`, `FECHA_ENTREGA`, `ESTADO`) VALUES ('Mikel','mklmikel@gmail.com','666666666','2019-01-25','2019-02-08','N');
INSERT INTO `pedidos`(`NOMBRE`, `CORREO`, `TELEFONO`, `FECHA`, `FECHA_ENTREGA`, `ESTADO`) VALUES ('Jon','jojo@gmail.com','666666666','2019-01-25','2019-02-08','N');

INSERT INTO `pedidos`(`NOMBRE`, `CORREO`, `TELEFONO`, `COMENTARIO`, `FECHA`, `FECHA_ENTREGA`, `ESTADO`) VALUES ('Fernando','ffernan@gmail.com','666666666','Meted cubiertos','2019-01-29','2019-06-08','R');
INSERT INTO `pedidos`(`NOMBRE`, `CORREO`, `TELEFONO`, `FECHA`, `FECHA_ENTREGA`, `ESTADO`) VALUES ('Eneko','enek@gmail.com','666666666','2019-01-02','2019-01-17','E');
INSERT INTO `pedidos`(`NOMBRE`, `CORREO`, `TELEFONO`, `COMENTARIO`, `FECHA`, `FECHA_ENTREGA`, `ESTADO`) VALUES ('Carlos','carloscar@gmail.com','666666666','Una barra de pan también','2019-01-05','2019-01-18','E');


INSERT INTO `productos_por_pedido`(`ID_PEDIDO`, `ID_PRODUCTO`, `CANTIDAD`) VALUES (1,1,6);
INSERT INTO `productos_por_pedido`(`ID_PEDIDO`, `ID_PRODUCTO`, `CANTIDAD`) VALUES (1,17,2);
INSERT INTO `productos_por_pedido`(`ID_PEDIDO`, `ID_PRODUCTO`, `CANTIDAD`) VALUES (1,45,20);

INSERT INTO `productos_por_pedido`(`ID_PEDIDO`, `ID_PRODUCTO`, `CANTIDAD`) VALUES (2,34,2);
INSERT INTO `productos_por_pedido`(`ID_PEDIDO`, `ID_PRODUCTO`, `CANTIDAD`) VALUES (2,38,4);

INSERT INTO `productos_por_pedido`(`ID_PEDIDO`, `ID_PRODUCTO`, `CANTIDAD`) VALUES (3,22,20);

INSERT INTO `productos_por_pedido`(`ID_PEDIDO`, `ID_PRODUCTO`, `CANTIDAD`) VALUES (4,12,3);
INSERT INTO `productos_por_pedido`(`ID_PEDIDO`, `ID_PRODUCTO`, `CANTIDAD`) VALUES (4,59,4);

INSERT INTO `productos_por_pedido`(`ID_PEDIDO`, `ID_PRODUCTO`, `CANTIDAD`) VALUES (5,2,4);
INSERT INTO `productos_por_pedido`(`ID_PEDIDO`, `ID_PRODUCTO`, `CANTIDAD`) VALUES (5,5,2);
INSERT INTO `productos_por_pedido`(`ID_PEDIDO`, `ID_PRODUCTO`, `CANTIDAD`) VALUES (5,8,5);
INSERT INTO `productos_por_pedido`(`ID_PEDIDO`, `ID_PRODUCTO`, `CANTIDAD`) VALUES (5,14,2);
INSERT INTO `productos_por_pedido`(`ID_PEDIDO`, `ID_PRODUCTO`, `CANTIDAD`) VALUES (5,33,2);

INSERT INTO `productos_por_pedido`(`ID_PEDIDO`, `ID_PRODUCTO`, `CANTIDAD`) VALUES (6,10,4);
INSERT INTO `productos_por_pedido`(`ID_PEDIDO`, `ID_PRODUCTO`, `CANTIDAD`) VALUES (6,47,1);

INSERT INTO `productos_por_pedido`(`ID_PEDIDO`, `ID_PRODUCTO`, `CANTIDAD`) VALUES (7,7,2);
INSERT INTO `productos_por_pedido`(`ID_PEDIDO`, `ID_PRODUCTO`, `CANTIDAD`) VALUES (7,9,2);
INSERT INTO `productos_por_pedido`(`ID_PEDIDO`, `ID_PRODUCTO`, `CANTIDAD`) VALUES (7,39,1);

INSERT INTO `productos_por_pedido`(`ID_PEDIDO`, `ID_PRODUCTO`, `CANTIDAD`) VALUES (8,55,6);
INSERT INTO `productos_por_pedido`(`ID_PEDIDO`, `ID_PRODUCTO`, `CANTIDAD`) VALUES (8,52,8);

INSERT INTO `productos_por_pedido`(`ID_PEDIDO`, `ID_PRODUCTO`, `CANTIDAD`) VALUES (9,1,5);
INSERT INTO `productos_por_pedido`(`ID_PEDIDO`, `ID_PRODUCTO`, `CANTIDAD`) VALUES (9,51,2);

