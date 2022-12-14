-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2022 at 03:29 PM
-- Server version: 8.0.29
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `infonete`
--

-- --------------------------------------------------------

--
-- Table structure for table `compra`
--

CREATE TABLE `compra` (
  `id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `edicion_id` int NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contenido`
--

CREATE TABLE `contenido` (
  `id` int NOT NULL,
  `titulo` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `subtitulo` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `contenido` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `multimedia` int NOT NULL,
  `estado` int NOT NULL,
  `contenidista` int NOT NULL,
  `latitud` double NOT NULL,
  `longitud` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contenido`
--

INSERT INTO `contenido` (`id`, `titulo`, `subtitulo`, `contenido`, `multimedia`, `estado`, `contenidista`, `latitud`, `longitud`) VALUES
(11, 'El entrenamiento de la Selección Argentina: ovación a Messi y el probable equipo para el último amistoso previo al Mundial de Qatar 2022', 'El capitán fue el más solicitado por los miles de fanáticos que estuvieron en la práctica abierta en Abu Dhabi. El miércoles, los dirigidos por Lionel Scaloni juegan ante Emiratos Árabes Unidos. Mirá ', 'La Selección Argentina empezó el Mundial. Lionel Scaloni reunió a los 14 jugadores con los que contaba para el entrenamiento a puertas abiertas en la asfixiante atmósfera de Abu Dhabi y ahí, en el círculo central del estadio Al-Nahyan, dio inicio a los ensayos mundialistas. En primera fila, escuchando atentamente, estaba el capitán Lionel Messi, que arribó en la mañana de este lunes (la madrugada de la Argentina) luego de jugar el domingo con el París Saint-Germain y que trataba de concentrarse en medio de las ovaciones que el fascinado público emiratí le regalaba sin parar.\r\n\r\nLa Scaloneta, o gran parte de ella, ya se mueve al compás de la Copa del Mundo. Después de tanto esperar. Después de tanto clavo cortado por los lesionados. Después del lamento por la baja de Giovani Lo Celso. Al fin el conjunto nacional se reencuentra en suelo árabe para comenzar a transitar el camino más soñado.', 50, 2, 3, 0, -58.56189638603293),
(12, 'Habló la ex presidenta', 'El mismo día en que el fiscal Luciani cerró la acusación en su contra, la ex presidenta lo compartió en redes sociales, donde volvió a atacar a la magistrada: \"Ni sabe ni quiere investigar\".', '<p>A trav&eacute;s de un duro escrito difundido en sus redes sociales minutos desp&uacute;es de que el fiscal Diego Luciani terminara su &uacute;ltima intervenci&oacute;n en el juicio en el que ella est&aacute; acusada por corrupci&oacute;n, Cristina Kirchner recus&oacute; este lunes a la jueza Mar&iacute;a Eugenia Capuchetti por la supuesta \"inacci&oacute;n\" en la investigaci&oacute;n de la causa abierta tras la tentativa de homicidio del pasado 1&deg; de septiembre en la puerta de su departamento en Recoleta. Desde su cuenta de la red social Twitter, la vicepresidenta confirm&oacute; la presentaci&oacute;n realizada este lunes por sus abogados y comparti&oacute; el escrito en el que detallaron las presuntas anomal&iacute;as que consideraron que fueron cometidas en el marco de la investigaci&oacute;n.</p>', 51, 2, 3, -34.672194718138634, -58.56713205803),
(13, 'Más presión sobre las reservas: el Central vendió US$ 100 millones y perdió más de US$ 860 millones en el mes', 'Se trata del segundo registro de ventas más alto del año. La demanda de dólares no cede, a pesar de los mayores controles', 'El Banco Central continúa con su posición vendedora en el mercado de cambios, como una manera de evitar un salto del dólar oficial, ante una demanda que no logra ceder. Luego de haber vendido más de US$ 500 millones la semana pasada, el organismo se desprendió este lunes de US$ 100 millones, con lo que acumula ventas por US$ 863 millones en lo que va del mes.\r\n\r\nEs una marca alta, si se toma en cuenta que en todo noviembre del año pasado, el organismo vendió US$ 900 millones, en un mes que suele ser deficitario para el Central. Pero incluso, en aquel momento, el cepo era mucho mas laxo que el que rige en la actualidad.', 52, 2, 3, -34.67491234593611, -58.56009394157492),
(14, 'La dueña del corazon de Tinelli', 'Guillermina Valdés es la dueña del corazón de Marcelo Tinelli', 'Guillermina Valdés nació en Necochea y fue modelo top de la agencia Dotto a fines de los `90.', 53, 2, 3, -34.66754285551055, -58.55938638242221),
(15, 'Tini Stoessel no irá al Mundial de Qatar 2022: los motivos de su decisión', 'La cantante confirmó que no irá a alentar a la Selección argentina en la Copa del Mundo.', 'El domingo 20 de noviembre a las 13 horas, nuestro país podrá empezar a vivir el Mundial de Qatar 2022. La apertura promete ser impactante, por lo que nadie se la quiere perder. Sin embargo, salió a la luz que Tini Stoessel es una de las figuras que no viajará a alentar a la Selección argentina en la Copa del Mundo.\r\n\r\nTini Stoessel finalmente no acompañará físicamente a su pareja, Rodrigo De Paul, en los partidos que dispute nuestra Selección en Qatar. Lo cierto, es que la intérprete de \"Carne y Hueso\" tiene compromisos laborales que le impedirán ser parte de la fiesta mundial del fútbol.\r\nSi bien, desde un principio la cantante aseguró que no tenía certeza de poder ir, dejó en claro en más de una entrevista que su padre, Alejandro Stoessel y su hermano Francisco, sí viajarán a Qatar para ver en vivo los partidos de Argentina.\r\nHasta el momento, no se sabe si los compromisos laborales que tiene Tini le impedirán ser parte del todo el Mundial o sólo se trata de la primera etapa que comprende los tres partidos que jugará la Selección en octavos de final.', 54, 2, 3, -34.6760413925435, -58.55660787530407),
(16, 'Tini Stoessel y Rodrigo DePaul', 'Tini Stoessel le dedicó un mensaje a Rodrigo De Paul tras la confirmación de la lista de convocados de Scaloni', 'El viernes por la tarde, Lionel Scaloni anunció la lista de futbolistas convocados para el Mundial de Qatar 2022. Rodrigo De Paul fue uno de los elegidos del director técnico, por lo que Tini Stoessel lo felicitó a través de sus redes.\r\n\r\nDesde su cuenta oficial de Twitter, Tini expresó: \"Estoy tan orgullosa de vos. Te felicito desde lo más profundo de mi corazón\". Por su parte, la pareja de la artista respondió: \"Te amo Titi\". De esa forma pusieron punto final a los rumores de crisis entre ellos.', 55, 2, 3, -34.6720179150474, -58.56660715051159),
(17, 'Sofía Jujuy Jiménez reveló su estado sentimental actual: \"No me juzguen\"', 'La modelo dio detalles de su situación en las redes.', 'Sofía Jujuy Jiménez suele mantener contacto constantemente con sus miles de seguidores. Y, desde que se separó de su última pareja, Bautista Bello, siempre le preguntan por alguna posible relación en puerta.\r\n\r\nSin embargo en esta ocasión, la influencer sacó el tema sola y reveló en que momento de su vida está. \r\n\r\nSofía Jujuy Jiménez primero publicó una foto en sus Historias de Instagram con una remera que decía: \"No sé si enamorarme o irme de after\". Y escribió: \"(Estado actual)\". Luego, abrió una encuesta con dos opciones: \"Yo / Estoy en unísima\". Abajo, agregó: \"No me juzguen\". \r\n\r\nFinalmente, en una tercera Historia, la ex de Juan Martín Del Potro señaló: \"Dejaré que la vida me lo responda solita, ¡besis! Que tengan lindo domingo\".\r\n\r\nDe esta manera, Sofía Jujuy Jiménez dejó en claro que no tiene ningún apuro en definir su futuro sentimental.\r\n\r\n', 56, 2, 3, -34.67600609945935, -58.570126208739126),
(18, 'Qatar 2022: el torneo de truco que armaron los jugadores de la Selección', 'Se filtró la competencia que organizaron los jugadores para pasar sus días en Doha; con quién jugará Lionel Messi', 'En paralelo a la competencia mundialista, los jugadores de la selección argentina libraran otra competencia dentro de la Universidad de Qatar, la sede donde pasan sus días en Doha. Los futbolistas definieron un competitivo torneo de truco con un pozo en dólares.\r\n\r\nDel torneo de truco no solo participan los jugadores. También están anotados el cuerpo técnico, el staff de asistentes y los dirigentes de la Asociación de Fútbol Argentino (AFA). De hecho, el entrenador Lionel Scaloni, y el mandamás del fútbol local, Claudio “Chiqui” Tapia” forman parte del juego.\r\n\r\nPara el certamen interno, se armaron 16 tríos como parte de un esquema que inicia en los octavos de final. Cada llave se juega al mejor de tres partidos a 30 puntos. Cada participante coloca US$100 para el pozo. El trío ganador se llevará, además, US$1200 dólares para cada integrante (US$3600 en total). En tanto, el trío derrotado embolsará US$400 por cabeza.\r\n\r\nLa señal ESPN, que mostró momentos de la intimidad de la Selección, dio cuenta de los equipos armados así como también de los cruces previstos. Hubo un sorteo que protagonizó Rodrigo De Paul, para determinar cómo se llevará el certamen.\r\nLionel Messi jugará justamente con Rodrigo De Paul y Leandro Paredes. En la primera llave se enfrentarán contra Gonzalo Montiel, Exequiel Palacios y Franco Armani.\r\n\r\nHay varios partidos que se destacan. Scaloni, que juega con sus ayudantes, Walter Samuel y Roberto Ayala, se enfrentará a un trío compuesto por el personal de la AFA. A su vez, los arqueros Emiliano “Dibu” Martínez y Gerónimo Rulli, junto al mediocampista Guido Rodríguez, se enfrentarán a los preparadores físicos.\r\n\r\nLos tríos, especialmente entre los jugadores, se armaron por distintas razones como afinidad, posiciones en el campo de juego, y conocimiento. Así, Ángel Di María jugará con Paulo Dybala y Nicolás Otamendi. Los recién llegados Ángel Correa y Thiago Almada se juntaron con Alejandro “Papu” Gómez.\r\n\r\nEn tanto, Lisandro Martínez hará equipo con Cristián “Cuti” Romero y Nahuel Molina. Por otro lado, Enzo Fernández jugará con Alexis Mac Allister y Julián Álvarez. Por último, Lautaro Martínez se acopló con Nicolás Tagliafico y Juan Foyth.\r\n\r\nDado que son 26 los jugadores, Germán Pezzella y Marcos “Huevo” Acuña, inicialmente, no participarían.', 57, 2, 3, -34.67582963542862, -58.55858198113903),
(19, 'Homicidio e interna sindical. Analizan las cámaras para saber hacia dónde huyeron los asesinos del chofer del exdiputado', 'La Fiscalía busca al sicario que le acertó entre seis y siete disparos a Mauricio Cordara cuando llegaba a la ciudad bonaerense de Colón con los hijos de PAblo Ansaloni, secretario general de la Obra ', 'Los investigadores del homicidio de Mauricio Cordara, chofer del exdiputado nacional y actual secretario general de la Obra Social del Personal Rural de la República Argentina (Osprera), Pablo Ansaloni, acribillado a balazos cuando llegaba a una vivienda del partido bonaerense de Colón, analizan las imágenes de cámaras de seguridad para establecer el recorrido del vehículo en el que huyeron su atacante y un cómplice.\r\n\r\nLa fiscal Magdalena Brandt, titular de la Unidad Funcional de Instrucción (UFI) N°1 descentralizada en Colón, del Departamento Judicial Pergamino, lleva adelante la investigación del homicidio de Cordara, que tenía 45 años y fue atacado el viernes, pasadas las 17, cuando llegó desde Buenos Aires en un Volkswagen Vento con los hijos de Ansaloni, a los que había retirado del colegio. Un hombre que llevaba una gorra se acercó rápidamente y le disparó a Cordara nueve tiros cuando sacaba las mochilas del baúl.\r\nSegún explicaron fuentes judiciales a Télam, la fiscal Brandt analiza las cámaras de seguridad de la zona para determinar por dónde huyó el vehículo en el que se trasladaban el atacante y un cómplice.\r\n\r\n“Hay una testigo que le escuchó decir al cómplice ‘vamos, vamos, vamos’ después del ataque, por lo que ya sabemos por qué calle escaparon”, aseguró a Télam un investigador.\r\n\r\nSi bien en un primer momento los pesquisas creyeron que los sospechosos huyeron en un Fiat Punto, con el avance de la investigación se determinó que el vehículo utilizado fue un Fiat Palio nuevo, con una patente adulterada.\r\n\r\n“Llevaba la patente de un auto robado en Esteban Echeverría, una localidad de la zona sur del Gran Buenos Aires”, agregó el pesquisa.', 58, 2, 3, -34.67198967877885, -58.57124200768932),
(20, 'Axel Kicillof cruzó a Martín Guzmán por sus dichos sobre el rol de Cristina Kirchner en el acuerdo con el FMI', 'El exgobernador cuestionó la negociación alcanzada con el organismo de crédito; qué dijo sobre su salida', 'Axel Kicillof cruzó este domingo al exministro de Economía, Martín Guzmán, quien objetó en una entrevista reciente el rol de Cristina Kirchner en la negociación con el Fondo Monetario Internacional. “Fue lamentable. No me gustó nada”, replicó el gobernador bonaerense sobre esas expresiones.\r\n\r\nGuzmán había apuntado contra el papel de la vicepresidenta y los problemas internos en la coalición oficialista en la negociación para restructurar la deuda por US$45.000 millones. “Cristina se corrió y eso tuvo implicancias para toda la gestión que vino después”, sostuvo en declaraciones a FM Neura.\r\nKicillof le respondió este domingo. Opinó que “las negociaciones estuvieron mal encaradas desde el principio”. “Este acuerdo es malo. Probablemente todo acuerdo con el FMI sea malo. Pero se trató de mostrar lo contrario”, consignó Radio a 10 el mandatario provincial.\r\n\r\nEl gobernador y exministro de Economía (2013-2015) admitió que no escuchó el reportaje completo que concedió el discípulo de Joseph Stiglitz, expresó que vio fragmentos de la entrevista, pero aún así manifestó su desagrado con el contenido y lo calificó como “lamentable”. “No me gustó nada”, dijo.\r\n\r\n“Al haberse tratado de un préstamo político, habría que haberse plantado”, reprochó Kicillof, quien señaló, en ese sentido, que no correspondía “la apelación a las reglas usuales” del Fondo Monetario Internacional.\r\n\r\nEl mandatario provincial sostuvo que “hubo ciertos puntos sobe los que se trabajó y no se logró avanzar” y mencionó “el plazo” para cancelar la deuda “y la sobretasa”, que ahora el Gobierno vuelve a insistir con discutir en medio de la negociación.\r\n\r\n“Nuestro gobierno no puede parar a decirse esto se puede solucionar, porque eso es precisamente el problema. Hasta que no conseguís recursos para sacarte al Fondo Monetario de encima no se soluciona anda”, ahondó.\r\n\r\nA su vez, Kicillof cuestionó la forma elegida por Guzmán, una carta a través de Twitter, para renunciar al gobierno de Alberto Fernández y recalcó que fue “un hecho que produjo una inestabilidad enorme”. “No sé si voluntaria o involuntariamente. Dijo que era para evitar una corrida mayor, pero indudablemente no lo logró”, achacó.', 59, 2, 3, -34.676747245413495, -58.55828157372936),
(21, 'De Susana Giménez en familia a los campeones del 86, quiénes son los famosos que viajaron a Qatar para alentar a la Selección', 'Actrices, periodistas y exfutbolistas entre otras celebrities posaron en el aeropuerto de Ezeiza antes de emprender vuelo al Mundial', 'Cerca de 40.000 argentinos llegarán a Qatar durante el mes del Mundial, según estimó el embajador en Doha, Guillermo Nicolás, y entre tantos fanáticos también dirán presente varias figuras del espectáculo, de la política y del deporte.\r\n\r\nSusana Giménez es una de las figuras locales que pisará suelo árabe junto a su familia. Dueña de un carisma y glamour inigualables, la diva argentina vistió un conjunto de calzas, camisa y zapatillas que completó, por supuesto, con sus gafas de sol y su clásica sonrisa radiante.\r\n\r\n', 60, 2, 3, -34.676359027469886, -58.55853906579479),
(22, '¿A propósito? Laura Pausini causa indignación por poner filtro a foto con Yalitza Aparicio', 'La cantante compartió una foto que ha provocado muchos comentarios en su contra.', 'Laura Pausini consiguió fama internacional gracias a su talento artístico, por lo que no es raro verla en importantes eventos, como lo fue la ceremonia de los Latin Grammy, en donde junto a Thalía y Luis Fonsi se desempeñó como presentadora, pero en los últimos días ha dado mucho de qué hablar por una historia que compartió en sus redes sociales, pues aseguran que intentó opacar a Yalitza Aparicio.  \r\n\r\nLa italiana fue una de las presentadoras del evento que se realizó en Las Vegas, Nevada, pero además participó en un show musical junto a sus compañeros y a lo largo de toda la ceremonia tuvo la oportunidad de compartir tiempo con celebridades de talla internacional.  \r\n\r\nAunque las fotos de Laura Pausini junto a otras celebridades no tuvieron nada fuera de lo común, una de las imágenes que ella compartió en sus historias fue la que causó controversia, ya que en ella se le puede ver posando junto a la nominada al Oscar, Yalitza Aparicio.  \r\n\r\nPara postear la fotografía en sus historias de Instagram, Laura Pausini agregó un filtro que le iluminó el rostro haciéndola lucir radiante, pero el efecto que agregó a la imagen dejó a Yalitza Aparicio bajo la sombra.  ', 61, 2, 3, -34.67548376393298, -58.56823793359264),
(23, 'Qatar 2022: así arrancó la fiesta futbolera en ceremonia de inauguración', 'Jungkook, de BTS, mascotas mundialistas y bailarines le dan vida a la apertura de la Copa del Mundo.', '¡El día llegó! Con un espectáculo lleno de luces, música, colores y mucha nostalgia arrancó este domingo la esperada Copa del Mundo en Qatar 2022.\r\n\r\nEn medio de la expectativa, la cita mundialista abrió el telón con una estampa mística de la cultura de Medio Oriente que arrancó la fiesta del futbol, en la que Jungkook, de BTS, fue el encargado de poner el ambiente en la ceremonia de inauguración y acaparó las miradas con su tema ‘Dreamers’, la canción oficial del Mundial.\r\n\r\nDurante la inauguración, se hizo repaso de las canciones y las mascotas de mundiales pasados que hicieron eco de nostalgia y la pasión por el futbol, entre ellos ‘La Copa De La Vida’, de Ricky Martin y ‘Waka Waka’ de Shakira.\r\n\r\nLa ceremonia que se extendió durante 35 minutos terminó con un espectacular show de fuegos artificiales y la adrenalina ante el partido de futbol inaugural Qatar-Ecuador, con el que empezaría la gran justa deportiva al rodar el balón.\r\n\r\n¿Qué te pareció la ceremonia del Mundial?', 63, 2, 3, -34.67152378999853, -58.55596414514049),
(24, 'My Chemical Romance reúne un séquito de emos y conquista el Corona Capital', 'Gerard Way y compañía no decepcionaron a sus fans mexicanos.', 'La luz del día no fue impedimento para que los emos se dejaran ver con su peculiar vestimenta negra. Al final, la mayoría de los asistentes a la primera jornada del festival Corona Capital querían ver a My Chemical Romance.\r\n\r\nClásicos como “Teenagers”, “I’m Not Okay”, “Helena” o “Welcome to the Black Parade”, se convirtieron en recuerdos que invadieron a los fans que no se fueron decepcionados y es que lejos del espectáculo visual que la banda dio, lo que representa su música para toda una generación fue medular.\r\n\r\nEntre las ovaciones del público, Gerard dijo una que otra palabra de agradecimiento, se le veía contento, disfrutando de su encuentro con una masa que esperó casi 15 años para corear esos temas que hoy son memorias en los treintañeros.\r\n\r\nY aunque el final fue un tanto gris, eso no opacó todo lo demás, no hubo quejas de My Chemical Romance, cada una de las interpretaciones estuvo a pedir de boca y quienes estuvieron ahí habrán conectado con su adolescente rebelde, ese que se sentía incomprendido y que cantaba “I’m Not Okay”.', 64, 2, 3, -34.67092377764416, -58.55798116631969),
(25, 'El entrenamiento de la Selección Argentina: ovación a Messi y el probable equipo para el último amistoso previo al Mundial de Qatar 2022', 'El capitán fue el más solicitado por los miles de fanáticos que estuvieron en la práctica abierta en Abu Dhabi. El miércoles, los dirigidos por Lionel Scaloni juegan ante Emiratos Árabes Unidos. Mirá ', '<p>La Selecci&oacute;n Argentina empez&oacute; el Mundial. Lionel Scaloni reuni&oacute; a los 14 jugadores con los que contaba para el entrenamiento a puertas abiertas en la asfixiante atm&oacute;sfera de Abu Dhabi y ah&iacute;, en el c&iacute;rculo central del estadio Al-Nahyan, dio inicio a los ensayos mundialistas. En primera fila, escuchando atentamente, estaba el capit&aacute;n Lionel Messi, que arrib&oacute; en la ma&ntilde;ana de este lunes (la madrugada de la Argentina) luego de jugar el domingo con el Par&iacute;s Saint-Germain y que trataba de concentrarse en medio de las ovaciones que el fascinado p&uacute;blico emirat&iacute; le regalaba sin parar.</p>\r\n<p>La Scaloneta, o gran parte de ella, ya se mueve al comp&aacute;s de la Copa del Mundo. Despu&eacute;s de tanto esperar. Despu&eacute;s de tanto clavo cortado por los lesionados. Despu&eacute;s del lamento por la baja de Giovani Lo Celso. Al fin el conjunto nacional se reencuentra en suelo &aacute;rabe para comenzar a transitar el camino m&aacute;s so&ntilde;ado.</p>', 65, 2, 3, 25.435238327551378, 50.969054419090284);

-- --------------------------------------------------------

--
-- Table structure for table `contenido_multimedia`
--

CREATE TABLE `contenido_multimedia` (
  `id` int NOT NULL,
  `imagen1` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `imagen2` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `imagen3` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `audio` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `video` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contenido_multimedia`
--

INSERT INTO `contenido_multimedia` (`id`, `imagen1`, `imagen2`, `imagen3`, `audio`, `video`, `url`) VALUES
(50, 'rWTrXTFaz_1256x620__2.jpg', '', '', '', '', ''),
(51, '-0t4QxOpB_1256x620__1.jpg', NULL, '', '', '', ''),
(52, 'wEQ-_71H7_1256x620__1.jpg', '', '', '', '', ''),
(53, 'carasNoticia1.webp', '', '', '', '', ''),
(54, 'carasNoticia2.webp', '', '', '', '', ''),
(55, 'carasNoticia3.jpg', '', '', '', '', ''),
(56, 'carasNoticia4.webp', '', '', '', '', ''),
(57, 'lanacion1.webp', '', '', '', '', ''),
(58, 'lanacion2.webp', '', '', '', '', ''),
(59, 'lanacion3.webp', '', '', '', '', ''),
(60, 'lanacion4.webp', '', '', '', '', ''),
(61, 'pronto1.jpg', '', '', '', '', ''),
(62, 'pronto2.jpg', '', '', '', '', ''),
(63, 'pronto3.jpg', '', '', '', '', ''),
(64, 'pronto4.jpg', '', '', '', '', ''),
(65, 'messi-festejo-aregntina-mexico.jpg', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `edicion`
--

CREATE TABLE `edicion` (
  `id` int NOT NULL,
  `edicion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `precio` double NOT NULL,
  `producto` int NOT NULL,
  `portada` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `alta` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `edicion`
--

INSERT INTO `edicion` (`id`, `edicion`, `precio`, `producto`, `portada`, `fecha`, `alta`) VALUES
(1, 'Edicion 1 -  Clarín', 700, 1, 'edicion123232.jpg', '2022-11-26 11:22:20', 1),
(2, 'Edicion 2 - Clarín', 900, 1, 'edicion45434.jpg', '2022-11-27 11:00:00', 1),
(3, 'Edicion 3 - Clarín', 400, 1, 'edicion12232443.jpg', '2022-11-26 11:22:20', 1),
(4, 'Edicion 1 - La Nación', 450, 2, 'nacion.750.jpg', '2022-11-27 11:23:17', 1),
(5, 'Edicion 2 - La Nación', 250, 2, 'CANqr6uU8AAjcsk.jpg', '2022-11-13 11:22:20', 1),
(6, 'Edicion 3 - La Nación', 580, 2, 'nacion.7450 (1).jpg', '2022-11-13 11:22:20', 1),
(7, 'Edicion 1 - Pronto', 500, 3, '62aa1caa563bc.png', '2022-11-13 11:22:20', 1),
(8, 'Edicion 2 - Pronto', 660, 3, '62aa8c7361a7d.jpeg', '2022-11-13 11:22:20', 1),
(9, 'Edicion 3 - Pronto', 990, 3, '62e395a6a9ecb.png', '2022-11-13 11:22:20', 1),
(11, 'Edición 4 - Clarín', 500, 1, 'clarin50.jpg', '2022-11-21 00:57:33', 1),
(12, 'Edición 4 - La Nación', 600, 2, 'lanacion50.jpeg', '2022-11-21 00:59:29', 1),
(13, 'Edición 4 - Pronto', 1500, 3, 'pronto50.jpg', '2022-11-21 01:00:46', 1),
(14, 'Edición 1 - Caras', 1500, 4, 'caras1.jpg', '2022-11-21 01:04:08', 1),
(15, 'Edición 2 - Caras', 1500, 4, 'caras2.png', '2022-11-28 01:04:26', 1),
(16, 'Edición 3 - Caras', 1500, 4, 'caras3.jpg', '2022-11-28 01:04:43', 1),
(17, 'Edición 4 - Caras', 1500, 4, 'caras4.webp', '2022-11-21 01:04:57', 1),
(18, 'Edición 1 - Página 12', 500, 6, 'pagina12-1.jpg', '2022-11-21 02:20:40', 1),
(19, 'Edición 2 - Página 12', 500, 6, 'pagina12-2.jpg', '2022-11-21 02:21:10', 1),
(20, 'Edición 3 - Página 12', 500, 6, 'pagina12-3.jpg', '2022-11-21 02:21:38', 1),
(21, 'Edición 4 - Página 12', 500, 6, 'pagina12-4.webp', '2022-11-21 02:22:15', 1),
(22, 'Edición 1 - Olé', 500, 7, 'ole1.jpg', '2022-11-21 02:25:11', 1),
(23, 'Edición 2 - Olé', 500, 7, 'ole2.jpg', '2022-11-21 02:25:32', 1),
(24, 'Edición 3 - Olé', 500, 7, 'ole3.jpg', '2022-11-21 02:25:48', 1),
(25, 'Edición 4 - Olé', 500, 7, 'ole4.webp', '2022-11-21 02:26:03', 1),
(26, 'Edición 1 - La Prensa', 500, 8, 'laprensa1.jpg', '2022-11-21 02:28:30', 1),
(27, 'Edición 2 - La Prensa', 500, 8, 'laprensa2.jpg', '2022-11-21 02:28:48', 1),
(28, 'Edición 3 - La Prensa', 500, 8, 'laprensa3.jpg', '2022-11-21 02:29:01', 1),
(29, 'Edición 4 - La Prensa', 500, 8, 'laprensa4.jpg', '2022-11-21 02:29:12', 1),
(30, 'Edición 1 - Infobae', 500, 5, 'infobae1.jpg', '2022-11-21 02:32:37', 1),
(31, 'Edición 2 - Infobae', 500, 5, 'infobae2.jpg', '2022-11-21 02:32:53', 1),
(32, 'Edición 3 - Infobae', 500, 5, 'infobae3.jpg', '2022-11-21 02:33:05', 1),
(33, 'Edición 4 - Infobae', 500, 5, 'infobae4.jpg', '2022-11-21 02:33:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `edicion_seccion`
--

CREATE TABLE `edicion_seccion` (
  `edicion` int NOT NULL,
  `seccion` int NOT NULL,
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `edicion_seccion`
--

INSERT INTO `edicion_seccion` (`edicion`, `seccion`, `id`) VALUES
(1, 1, 1),
(1, 2, 2),
(1, 3, 3),
(1, 4, 4),
(2, 5, 21),
(2, 2, 22),
(3, 1, 23),
(11, 6, 24),
(4, 5, 25),
(5, 3, 27),
(6, 6, 28),
(6, 1, 29),
(12, 2, 30),
(12, 3, 31),
(12, 1, 32),
(11, 5, 33),
(11, 2, 34),
(5, 4, 35),
(5, 2, 36),
(4, 6, 37),
(7, 5, 38),
(7, 3, 39),
(8, 3, 40),
(8, 4, 41),
(9, 5, 42),
(9, 6, 43),
(13, 3, 44),
(13, 1, 45),
(14, 6, 46),
(14, 3, 47),
(15, 5, 48),
(15, 6, 49),
(16, 4, 50),
(16, 2, 51),
(17, 6, 52),
(17, 3, 53);

-- --------------------------------------------------------

--
-- Table structure for table `edicion_seccion_noticia`
--

CREATE TABLE `edicion_seccion_noticia` (
  `edicion` int NOT NULL,
  `seccion` int NOT NULL,
  `noticia` int NOT NULL,
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `edicion_seccion_noticia`
--

INSERT INTO `edicion_seccion_noticia` (`edicion`, `seccion`, `noticia`, `id`) VALUES
(1, 1, 25, 18),
(1, 4, 13, 20),
(1, 2, 12, 21),
(1, 3, 21, 22),
(2, 5, 24, 23),
(2, 2, 20, 24),
(3, 1, 11, 25),
(11, 6, 23, 26),
(4, 5, 24, 27),
(5, 3, 15, 28),
(6, 1, 23, 29),
(6, 6, 22, 30),
(12, 1, 11, 31),
(12, 2, 15, 32),
(12, 3, 19, 33),
(11, 5, 16, 34),
(11, 2, 13, 35),
(5, 2, 20, 36),
(5, 4, 13, 37),
(4, 6, 17, 38),
(7, 5, 21, 39),
(7, 3, 18, 40),
(8, 3, 21, 41),
(8, 4, 20, 42),
(9, 6, 14, 43),
(9, 5, 22, 44),
(13, 3, 21, 45),
(13, 1, 25, 46),
(14, 6, 18, 47),
(14, 3, 24, 48),
(15, 6, 22, 49),
(15, 5, 23, 50),
(16, 4, 13, 51),
(16, 2, 20, 52),
(17, 3, 19, 53),
(17, 6, 17, 54);

-- --------------------------------------------------------

--
-- Table structure for table `estado`
--

CREATE TABLE `estado` (
  `id` int NOT NULL,
  `descripcion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estado`
--

INSERT INTO `estado` (`id`, `descripcion`) VALUES
(1, 'Sin publicar'),
(2, 'Publicado'),
(3, 'Revision'),
(4, 'Dado de baja');

-- --------------------------------------------------------

--
-- Table structure for table `passwords`
--

CREATE TABLE `passwords` (
  `id` int NOT NULL,
  `clave` char(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `verificado` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `vencimiento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passwords`
--

INSERT INTO `passwords` (`id`, `clave`, `verificado`, `vencimiento`) VALUES
(2, '$2y$10$LQWyrRzlLRVhjns.uks84.tmBn/ZL5.S6zxNx7w6d0G1u5yFYADlG', '', '0000-00-00 00:00:00'),
(3, '$2y$10$9ijihR7KDJRXDrAVUfnrHOx7zOXAhF.SQZ2qMiUXLZgN2TAVpZbqS', '', '0000-00-00 00:00:00'),
(4, '$2y$10$Y4lCjNjDoFVOPsrEXuUxPOlAH1bL5oFQpaagFdq9ED.GzxLQZj7BS', '', '0000-00-00 00:00:00'),
(5, '$2y$10$TXIFTVBwjdLZe5tH4ooOSuWLGzxJKSwPz5EIwM5/dl4RjeByPpLbe', '', '0000-00-00 00:00:00'),
(6, '$2y$10$1AowJacGb8KioQ15IMHU0OK1gHDMEAFRarDfn4e.0GMv9oHc70/zO', '', '0000-00-00 00:00:00'),
(41, '$2y$10$5ahlcnL/UAq2QSSZJWIFUOroZnla6vfGZ4JWVNwknF7I0FKRhkvtC', '', '0000-00-00 00:00:00'),
(42, '$2y$10$RfHQKKj61BHf7oJSCbo11eNRI44ThtUV0Is1UtwTl6TLwXR.wPw7m', '', '0000-00-00 00:00:00'),
(43, '$2y$10$pvfNycqGDSAEZK7hd210ze/TS5bAZW920i.9nBSPnp13Yz45AKP8e', '', '0000-00-00 00:00:00'),
(44, '$2y$10$0Jg/m6P.fPeZCEi69ILGTeFEVs4kvlmRE3Z8Pcy5kNpAbDAw1oyEG', '', '0000-00-00 00:00:00'),
(45, '$2y$10$M6aTjd4nOx5jR1adWgx4cu55SGmw3of0A57xqEaVe16WySF4Q2GEa', '', '0000-00-00 00:00:00'),
(46, '$2y$10$V1ebipygrJafK4zjdQ6wEOBrOi1PT3rLZG3oXsXrMgA7PmSJdEXFq', '', '0000-00-00 00:00:00'),
(47, '$2y$10$iYoNrA.9kgoNroq4MhhTt.Q5tcuIDXdzrgCUmKjCKrucR84/3vMz6', '', '0000-00-00 00:00:00'),
(48, '$2y$10$RPX7iJzYqRXn0QbPmi7FeeRdvl80xrNvKc8bWZAaVf.qTQIm4a7W.', '', '0000-00-00 00:00:00'),
(49, '$2y$10$o/V3BI0dBSQYZRWHzMiTv.EuPPm8Y7mNFR5ceiyTvPRzTWIpjp3.e', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `id` int NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tipo` int NOT NULL,
  `portada` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `precio` int NOT NULL,
  `alta` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `tipo`, `portada`, `precio`, `alta`) VALUES
(1, 'Clarín', 1, 'clarin.jpg', 500, 1),
(2, 'La nación', 1, 'lanacion.jpg', 500, 1),
(3, 'Pronto', 2, 'pronto.png', 400, 1),
(4, 'Caras', 2, 'caras.jpg', 0, 1),
(5, 'Infobae', 1, 'infobae.jpg', 500, 0),
(6, 'Página 12', 1, 'pagina12.jpg', 400, 0),
(7, 'Olé', 1, 'ole.jpg', 300, 0),
(8, 'La prensa', 1, 'laprensa.jpg', 400, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reportes_editor`
--

CREATE TABLE `reportes_editor` (
  `id` int NOT NULL,
  `contenido` int NOT NULL,
  `id_contenidista` int NOT NULL,
  `id_editor` int NOT NULL,
  `comentarios` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `estado` int NOT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int NOT NULL,
  `descripcion` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `descripcion`) VALUES
(1, 'lector'),
(2, 'contenidista'),
(3, 'editor'),
(4, 'administrador');

-- --------------------------------------------------------

--
-- Table structure for table `seccion`
--

CREATE TABLE `seccion` (
  `id` int NOT NULL,
  `descripcion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seccion`
--

INSERT INTO `seccion` (`id`, `descripcion`) VALUES
(1, 'Deportes'),
(2, 'Política'),
(3, 'Sociedad'),
(4, 'Economía'),
(5, 'Cultura'),
(6, 'Espectáculo');

-- --------------------------------------------------------

--
-- Table structure for table `suscripcion`
--

CREATE TABLE `suscripcion` (
  `id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `producto_id` int NOT NULL,
  `fechaAdquirido` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaVencimiento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tipo`
--

CREATE TABLE `tipo` (
  `id` int NOT NULL,
  `descripcion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tipo`
--

INSERT INTO `tipo` (`id`, `descripcion`) VALUES
(1, 'diario'),
(2, 'revista');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` int NOT NULL,
  `estado` int NOT NULL DEFAULT '0',
  `role` int NOT NULL,
  `latitud` double NOT NULL,
  `longitud` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `mail`, `password`, `estado`, `role`, `latitud`, `longitud`) VALUES
(1, 'admin', 'admin@admin', 2, 1, 4, 0, 0),
(2, 'usuario', 'usuario@usuario.com', 3, 1, 1, 0, 0),
(3, 'contenidista', 'contenidista@contenidista.com', 4, 1, 2, 0, 0),
(4, 'editor', 'editor@editor', 5, 1, 3, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `usuario` (`usuario_id`),
  ADD KEY `edicion` (`edicion_id`);

--
-- Indexes for table `contenido`
--
ALTER TABLE `contenido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imagen` (`multimedia`),
  ADD KEY `estado` (`estado`),
  ADD KEY `contenidista` (`contenidista`);

--
-- Indexes for table `contenido_multimedia`
--
ALTER TABLE `contenido_multimedia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edicion`
--
ALTER TABLE `edicion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto` (`producto`);

--
-- Indexes for table `edicion_seccion`
--
ALTER TABLE `edicion_seccion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `edicion` (`edicion`),
  ADD KEY `seccion` (`seccion`);

--
-- Indexes for table `edicion_seccion_noticia`
--
ALTER TABLE `edicion_seccion_noticia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_edicion` (`edicion`),
  ADD KEY `fk_seccion` (`seccion`),
  ADD KEY `fk_noticia` (`noticia`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passwords`
--
ALTER TABLE `passwords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo` (`tipo`);

--
-- Indexes for table `reportes_editor`
--
ALTER TABLE `reportes_editor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_contenidista` (`id_contenidista`),
  ADD KEY `id_editor` (`id_editor`),
  ADD KEY `contenido` (`contenido`),
  ADD KEY `estado` (`estado`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suscripcion`
--
ALTER TABLE `suscripcion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indexes for table `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password` (`password`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `contenido`
--
ALTER TABLE `contenido`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `contenido_multimedia`
--
ALTER TABLE `contenido_multimedia`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `edicion`
--
ALTER TABLE `edicion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `edicion_seccion`
--
ALTER TABLE `edicion_seccion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `edicion_seccion_noticia`
--
ALTER TABLE `edicion_seccion_noticia`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `passwords`
--
ALTER TABLE `passwords`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reportes_editor`
--
ALTER TABLE `reportes_editor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seccion`
--
ALTER TABLE `seccion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `suscripcion`
--
ALTER TABLE `suscripcion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `edicion` FOREIGN KEY (`edicion_id`) REFERENCES `edicion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contenido`
--
ALTER TABLE `contenido`
  ADD CONSTRAINT `contenido_ibfk_1` FOREIGN KEY (`multimedia`) REFERENCES `contenido_multimedia` (`id`),
  ADD CONSTRAINT `contenido_ibfk_2` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`),
  ADD CONSTRAINT `contenido_ibfk_3` FOREIGN KEY (`contenidista`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `edicion`
--
ALTER TABLE `edicion`
  ADD CONSTRAINT `edicion_ibfk_1` FOREIGN KEY (`producto`) REFERENCES `producto` (`id`);

--
-- Constraints for table `edicion_seccion`
--
ALTER TABLE `edicion_seccion`
  ADD CONSTRAINT `edicion_seccion_ibfk_1` FOREIGN KEY (`edicion`) REFERENCES `edicion` (`id`),
  ADD CONSTRAINT `edicion_seccion_ibfk_2` FOREIGN KEY (`seccion`) REFERENCES `seccion` (`id`);

--
-- Constraints for table `edicion_seccion_noticia`
--
ALTER TABLE `edicion_seccion_noticia`
  ADD CONSTRAINT `fk_edicion` FOREIGN KEY (`edicion`) REFERENCES `edicion` (`id`),
  ADD CONSTRAINT `fk_noticia` FOREIGN KEY (`noticia`) REFERENCES `contenido` (`id`),
  ADD CONSTRAINT `fk_seccion` FOREIGN KEY (`seccion`) REFERENCES `seccion` (`id`);

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `tipo` (`id`);

--
-- Constraints for table `reportes_editor`
--
ALTER TABLE `reportes_editor`
  ADD CONSTRAINT `reportes_editor_ibfk_1` FOREIGN KEY (`id_contenidista`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `reportes_editor_ibfk_2` FOREIGN KEY (`id_editor`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `reportes_editor_ibfk_3` FOREIGN KEY (`contenido`) REFERENCES `contenido` (`id`),
  ADD CONSTRAINT `reportes_editor_ibfk_4` FOREIGN KEY (`estado`) REFERENCES `estado` (`id`);

--
-- Constraints for table `suscripcion`
--
ALTER TABLE `suscripcion`
  ADD CONSTRAINT `producto_id` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`password`) REFERENCES `passwords` (`id`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`role`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
