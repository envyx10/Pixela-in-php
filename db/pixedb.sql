-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 01-12-2024 a las 18:48:06
-- Versión del servidor: 11.5.2-MariaDB-ubu2404
-- Versión de PHP: 8.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pixeladb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resenias`
--

CREATE TABLE `resenias` (
  `id_resenia` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `serie_id` int(11) NOT NULL,
  `resenia` text NOT NULL,
  `puntuacion` tinyint(4) NOT NULL CHECK (`puntuacion` >= 1 and `puntuacion` <= 5),
  `fecha_resenia` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `serie_id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `sinopsis` text DEFAULT NULL,
  `anio_estreno` varchar(4) DEFAULT NULL,
  `puntuacion` decimal(3,1) DEFAULT NULL,
  `imagen_url` varchar(255) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `series`
--

INSERT INTO `series` (`id`, `serie_id`, `titulo`, `sinopsis`, `anio_estreno`, `puntuacion`, `imagen_url`, `fecha_registro`) VALUES
(12, 250308, 'Earth Abides', '', '2024', 8.5, 'https://image.tmdb.org/t/p/w1280/s0RSMjbOm7TVvFoAavotSvuQ5xL.jpg', '2024-12-01 11:12:53'),
(13, 277414, 'Rekaman Terlarang', '', '2024', 0.0, 'https://image.tmdb.org/t/p/w1280/41MrZENGRsQXJdnnxg0KeiKcW0N.jpg', '2024-12-01 11:12:53'),
(14, 219971, 'The Agency (La agencia)', '', '2024', 8.4, 'https://image.tmdb.org/t/p/w1280/j0fFZIksd4nu8bNLGLq8GJ4KXFA.jpg', '2024-12-01 11:12:53'),
(15, 222766, 'Chacal', '', '2024', 8.1, 'https://image.tmdb.org/t/p/w1280/faqXSU7eXffSxtyIX4EGyCITQpQ.jpg', '2024-12-01 11:12:53'),
(16, 73982, 'Día y Noche', 'Un detective participa en la investigación de un brutal asesinato en masa en el que el principal sospechoso es nada menos que su hermano gemelo.', '2017', 8.3, 'https://image.tmdb.org/t/p/w1280/v2DKSpCC3fIQi1OE6pYilWDJH99.jpg', '2024-12-01 11:12:53'),
(17, 211039, 'Senna', 'El brasileño Ayrton Senna, apasionado de los coches desde niño, se convirtió en una leyenda deportiva... hasta que una tragedia truncó sus sueños y cambió la F1 para siempre.', '2024', 7.8, 'https://image.tmdb.org/t/p/w1280/zuAYVhC7vnKk9jsEuJQqJPB93Pm.jpg', '2024-12-01 11:12:53'),
(18, 94605, 'Arcane', 'Con las dispares ciudades de Piltover y Zaun como telón de fondo, dos hermanas luchan en bandos opuestos de una guerra entre tecnologías mágicas y creencias enfrentadas.', '2021', 8.8, 'https://image.tmdb.org/t/p/w1280/abf8tHznhSvl9BAElD2cQeRr7do.jpg', '2024-12-01 11:12:53'),
(19, 125988, 'Silo', 'En un futuro ruinoso y tóxico, existe una comunidad en un gigantesco silo subterráneo que alcanza cientos de pisos de profundidad. Allí, las personas viven en una sociedad llena de normas que creen que están destinadas a protegerlas.', '2023', 8.2, 'https://image.tmdb.org/t/p/w1280/ak7NFISSaROyoWjSOIjamhpt1LB.jpg', '2024-12-01 11:12:53'),
(20, 113962, 'Operaciones Especiales: Lioness', 'Cruz Manuelos, una joven infante de marina ruda pero apasionada, es reclutada para unirse al Equipo Lioness Engagement de la CIA para ayudar a acabar con una organización terrorista desde adentro. Joe, el jefe de estación del programa Lioness, tiene la tarea de capacitar, administrar y liderar a sus agentes encubiertos.', '2023', 8.0, 'https://image.tmdb.org/t/p/w1280/d0r0rxI9UjMVvD5Krc5oET2O0gU.jpg', '2024-12-01 11:12:53'),
(21, 226649, '옥씨부인전', '', '2024', 5.0, 'https://image.tmdb.org/t/p/w1280/g5vriJY8b7JLna3qYv2ksWFRR4.jpg', '2024-12-01 11:12:53'),
(22, 157741, 'Landman', 'Ambientada en las prósperas ciudades en auge del oeste de Texas, matones y multimillonarios buscan fortuna en las plataformas petrolíferas.', '2024', 8.0, 'https://image.tmdb.org/t/p/w1280/hGbYOuUVoxfXa96pmNLFJ9a7U5T.jpg', '2024-12-01 11:12:53'),
(23, 230777, 'Una maleta', 'Una agencia de servicios matrimoniales secretos queda al descubierto cuando aparece un baúl en la orilla de un lago, revelando el extraño matrimonio de una pareja.', '2024', 8.2, 'https://image.tmdb.org/t/p/w1280/c8QkpkrFadUBumJAnsI4zJOXPnn.jpg', '2024-12-01 11:12:53'),
(24, 220056, 'La locura', 'Después de tropezarse con un cadáver en las profundidades de un bosque de las Pocono, un tertuliano es incriminado por el asesinato de un famoso supremacista blanco.', '2024', 7.5, 'https://image.tmdb.org/t/p/w1280/q9GEONSrEYz8nUAqsFXRRu9GYtO.jpg', '2024-12-01 11:12:53'),
(25, 253905, 'Cuando el teléfono suena', 'Un político en ascenso y su esposa muda ven cómo su tenso matrimonio se desmorona tras la llamada de un secuestrador pone sus vidas patas arriba.', '2024', 6.8, 'https://image.tmdb.org/t/p/w1280/7yi1CR6FVmaO1D4e5manW1WUPL0.jpg', '2024-12-01 11:12:53'),
(26, 37854, 'One Piece', 'Riqueza, fama, poder... un hombre había obtenido todo en este mundo, era el Rey de los Piratas Gold Roger. Antes de morir sus últimas palabras inspiraron al mundo a aventurarse al mar: \"¿Mi tesoro? Si lo queréis es vuestro... lo he escondido todo en ese lugar\". Y así dio comienzo lo que se conoce como la Gran Era de la Piratería, lanzando a cientos de piratas al mar para encontrar el gran tesoro One Piece. Esta serie relata las aventuras y desventuras de uno de esos piratas, Monkey D. Luffy, quien accidentalmente de pequeño, comió una Fruta del Diablo (Akuma no Mi en japonés), en particular una Gomu Gomu no Mi que hizo que su cuerpo ganara las propiedades físicas de la goma, convirtiéndose en el hombre de goma. Luffy, después de dicho suceso, decide que se convertirá en el próximo Rey de los Piratas y para ello, deberá encontrar el \"One Piece\".', '1999', 8.7, 'https://image.tmdb.org/t/p/w1280/6nyfkXDGngwY6PCW58n7CHQ2aMt.jpg', '2024-12-01 11:12:53'),
(27, 236356, '가족계획', '', '2024', 6.0, 'https://image.tmdb.org/t/p/w1280/4CYqtTAlGyg2GPz3Q5csNsasBqv.jpg', '2024-12-01 11:12:53'),
(28, 97825, 'Kara no Kyoukai', 'Cuando una serie de suicidios da comienzo en Tokio, la joven Shiki debe ponerse manos a la obra para desenmascarar lo que podría estar detrás de estos misteriosos incidentes', '2013', 7.4, 'https://image.tmdb.org/t/p/w1280/62XZ6ukhRRSZkuKJ6ghry1vI1p9.jpg', '2024-12-01 11:12:53'),
(29, 7842, 'El Show de Tom y Jerry', 'El gato Tom y el ratón Jerry, el dúo más famoso, regresa para experimentar nuevas aventuras y enfrentarse en nuevas batallas.', '1975', 7.7, 'https://image.tmdb.org/t/p/w1280/qO0aveHUNqKciN9hO5EvBQGtZ3d.jpg', '2024-12-01 11:12:53'),
(30, 124364, 'FROM', 'Desvela el misterio de un pueblo de pesadilla en el centro de Norteamérica que atrapa a todos los que entran. Mientras los residentes involuntarios luchan por mantener una sensación de normalidad y buscan una salida, también deben sobrevivir a las amenazas del bosque circundante, incluidas las aterradoras criaturas que salen cuando se pone el sol.', '2022', 8.2, 'https://image.tmdb.org/t/p/w1280/cjXLrg4R7FRPFafvuQ3SSznQOd9.jpg', '2024-12-01 11:12:53'),
(31, 71446, 'La casa de papel', 'Un enigmático personaje llamado el Profesor planea algo grande: llevar a cabo el mayor atraco de la historia. Para ello recluta una banda de ocho personas que reúnen un único requisito, ninguno tiene nada que perder. Cinco meses de reclusión memorizando cada paso, cada detalle, cada probabilidad… y por fin, once días de encierro en la Fábrica Nacional de Moneda, rodeados de cuerpos de policía y con decenas de rehenes en su poder para saber si su apuesta suicida será todo o nada.', '2017', 8.2, 'https://image.tmdb.org/t/p/w1280/z01Dc0Ly2GmCpLe6Scx4d3dPP1S.jpg', '2024-12-01 11:26:49'),
(32, 73586, 'Yellowstone', 'John Dutton (Costner) es el propietario del rancho más grande de Estados Unidos. Él y sus hijos entablarán una lucha sin cuartel contra una reserva india y contra el Gobierno federal de Estados Unidos que intenta expandir el parque nacional contiguo a la propiedad de los Dutton.', '2018', 8.2, 'https://image.tmdb.org/t/p/w1280/s4QRRYc1V2e68Qy9Wel9MI8fhRP.jpg', '2024-12-01 12:20:59'),
(33, 233971, '我是刑警', '', '2024', 9.0, 'https://image.tmdb.org/t/p/w1280/b45ALi57pCGfucKOXLeWR0Sc2QB.jpg', '2024-12-01 12:20:59'),
(34, 274955, 'Asaf', 'Un padre lidia con su divorcio mientras se enreda en el mundo del crimen organizado. Con la vida de su hijo en juego, ¿cuál será su próxima jugada?', '2024', 6.0, 'https://image.tmdb.org/t/p/w1280/zlBMoPwyGOalN0Bu8H6ylsfaYHf.jpg', '2024-12-01 12:20:59'),
(35, 153312, 'Tulsa King', 'Justo después de ser liberado de prisión después de 25 años, el capo de la mafia de Nueva York, Dwight \"El General\" Manfredi, es exiliado sin contemplaciones por su jefe para instalarse en Tulsa, Oklahoma. Al darse cuenta de que su familia de la mafia puede no tener sus mejores intereses en mente, Dwight construye lentamente una \"tripulación\" a partir de un grupo de personajes inverosímiles, para ayudarlo a establecer un nuevo imperio criminal en un lugar que para él bien podría ser otro planeta.', '2022', 8.4, 'https://image.tmdb.org/t/p/w1280/yzRnj5GMZEjiW9xTGkz8cVNyzH9.jpg', '2024-12-01 12:20:59'),
(36, 30984, 'Bleach', 'La serie narra las aventuras de Ichigo Kurosaki, un adolescente que tiene la facultad de interactuar con los espíritus. Una noche, Ichigo se encuentra con una shinigami —personificación japonesa del Dios de la muerte— llamada Rukia Kuchiki, quien se sorprende que pueda verla. Sin embargo, su conversación es interrumpida por la aparición de un hollow, un espíritu maligno. Después de que Rukia fuera gravemente herida al tratar de proteger a Ichigo, esta intenta traspasarle parte de sus poderes a Ichigo para que pueda enfrentarse al hollow en igualdad de condiciones. No obstante, Ichigo sin darse cuenta los absorbe casi por completo y logra vencer con facilidad al espíritu.', '2004', 8.4, 'https://image.tmdb.org/t/p/w1280/7bSQNQuhHeInFMfzMwevfCiqcTm.jpg', '2024-12-01 12:20:59'),
(37, 1668, 'Friends', 'Las aventuras de seis jóvenes neoyorquinos unidos por una divertida amistad. Entre el amor, el trabajo y la familia, comparten sus alegrías y preocupaciones en el Central Perk, su café favorito.', '1994', 8.4, 'https://image.tmdb.org/t/p/w1280/rkKCSlr8OH5tbKEdgwtzvEiemrl.jpg', '2024-12-01 12:20:59'),
(38, 456, 'Los Simpson', 'El día a día de una peculiar familia formada por Homer, Marge, Bart, Maggie y Lisa Simpson y otros divertidos personajes de la localidad norteamericana de Springfield. Homer, el padre, es un desastroso inspector de seguridad de una central nuclear. Marge, la madre, es un ama de casa acostumbrada a soportar a su peculiar familia. Bart, de diez años, intenta divertirse con travesuras de todo tipo. Lisa es la más inteligente de la familia, y Maggie, la más pequeña, es un bebé que todavía no habla, pero que juega un importante papel.', '1989', 8.0, 'https://image.tmdb.org/t/p/w1280/vH0Mghb0lNJ5k7EpDwI7iJV7qaO.jpg', '2024-12-01 12:20:59'),
(39, 214160, 'Found', 'En un año determinado, más de 600.000 personas son reportadas como desaparecidas en los EE. UU. De estos casos reportados, más de la mitad de las personas desaparecidas son personas de color, que el sistema ignora con demasiada facilidad. Gabi Mosely, una ex persona desaparecida, ahora se especializa en relaciones públicas y dirige un equipo de gestión de crisis que busca a estas personas desaparecidas. Pero sin que nadie lo sepa, Mosely esconde su propio oscuro secreto.', '2023', 7.1, 'https://image.tmdb.org/t/p/w1280/6dlObWzbcSqpTGWsz7EburK2UcG.jpg', '2024-12-01 12:20:59'),
(40, 1425, 'House of Cards', 'El implacable y manipulador congresista Francis Underwood (Kevin Spacey), con la complicidad de su calculadora mujer (Robin Wright), maneja con gran destreza los hilos de poder en Washington. Su intención es ocupar la Secretaría de Estado del nuevo gobierno. Sabe muy bien que los medios de comunicación son vitales para conseguir su propósito, por lo que decide convertirse en la \"garganta profunda\" de la joven y ambiciosa periodista Zoe Barnes (Kate Mara), a la que ofrece exclusivas para desestabilizar y hundir a sus adversarios políticos. Nueva adaptación de la novela homónima de Michael Dobbs, en la que se basó una miniserie británica de 1990.', '2013', 8.0, 'https://image.tmdb.org/t/p/w1280/hKWxWjFwnMvkWQawbhvC0Y7ygQ8.jpg', '2024-12-01 12:27:38'),
(41, 65942, 'Re:ZERO -Starting Life in Another World-', 'Subaru Natsuki es un estudiante corriente de preparatoria que conoce a una hermosa chica de pelo plateado de otro mundo que lo rescata. Para devolverle el favor decide quedarse con ella, pero el destino con el que carga la muchacha es mucho más pesado de lo que Subaru puede imaginar. Los enemigos atacan sin descanso, uno tras otro, hasta que finalmente mueren tanto él como la chica. Subaru no quiere que la chica resulte herida, con lo que jura acabar con cualquier enemigo, con cualquier destino que le aguarde, siempre por protegerla.', '2016', 7.8, 'https://image.tmdb.org/t/p/w1280/kLJonmVSDWyLKs7iVq7MaFqTn5V.jpg', '2024-12-01 12:27:38'),
(42, 258463, '蜀锦人家', '', '2024', 7.0, 'https://image.tmdb.org/t/p/w1280/hJvOkMEJLDFQxAQuMcYlu4Pw7fK.jpg', '2024-12-01 12:27:38'),
(43, 95479, 'Jujutsu Kaisen', 'Dificultades, arrepentimiento, vergüenza… Los sentimientos negativos de los humanos se convierten en Maldiciones que nos acechan en nuestra vida diaria. Las Maldiciones campan a sus anchas por todo el mundo, y pueden llevar a las personas a sufrir terribles desgracias e incluso dirigirlas a su muerte. Y lo que es peor: solo una Maldición puede exorcizar otra Maldición.', '2020', 8.6, 'https://image.tmdb.org/t/p/w1280/coMNNwjHY4BZTqMIsklanMf2Wp7.jpg', '2024-12-01 12:27:38'),
(44, 46260, 'Naruto', 'Naruto es un joven aprendiz de ninja marginado y temido en la Villa Oculta de la Hoja tanto por su carácter hiperactivo y gamberro como por el terrible poder sellado en su interior. Acompañado por el intenso Sasuke y la ingeniosa Sakura, Naruto comienza su aprendizaje decidido a convertirse en maestro Hokage, la más alta distinción entre los ninjas, para ganarse el reconocimiento de los suyos.', '2002', 8.4, 'https://image.tmdb.org/t/p/w1280/oOkvQ1anSMvdYbUGGf7NAnfwHUt.jpg', '2024-12-01 12:27:38'),
(45, 131041, 'BLUELOCK', 'Yoichi es un joven al que acaban de eliminar junto a su equipo. De pronto recibe una carta donde lo convocan para participar en un extraño experimento sobre fútbol.', '2022', 8.1, 'https://image.tmdb.org/t/p/w1280/Ah8WcTBGZ3PzPqwjpV93C05COgA.jpg', '2024-12-01 12:27:38'),
(46, 218631, 'Gangnam, bajos fondos', 'Cuando una escort de un club de Gangnam desaparece, el inspector Kang Dongwoo decide regresar para investigar el caso. Junto con la fiscal Min Seojin, desentrañará una red de conexiones y secretos detrás del caso.', '2024', 7.3, 'https://image.tmdb.org/t/p/w1280/mP8iPfEt8pfL87y7r3AVO37ASkm.jpg', '2024-12-01 12:27:38'),
(47, 203737, 'Oshi no Ko', 'Ai Hoshino, de dieciséis años, es una ídolo talentosa y hermosa que es adorada por sus fans. Ella es la personificación de una joven doncella pura. Pero no es oro todo lo que reluce. Gorou Amemiya es un ginecólogo rural y un gran admirador de Ai. Entonces, cuando la ídolo embarazada aparece en su hospital, está más que desconcertado. Gorou le promete un parto seguro. Poco sabe él, un encuentro con una figura misteriosa resultaría en su muerte prematura, o eso pensó. Al abrir los ojos en el regazo de su amado ídolo, Gorou descubre que ha renacido como Aquamarine Hoshino, ¡el hijo recién nacido de Ai! Con su mundo al revés, Gorou pronto descubre que el mundo del espectáculo está lleno de espinas, donde el talento no siempre genera éxito. ¿Conseguirá proteger la sonrisa de Ai que tanto quiere con la ayuda de un excéntrico e inesperado aliado?', '2023', 8.4, 'https://image.tmdb.org/t/p/w1280/ozJvrtYnLDz0wpOTx61Qs5t3ZEJ.jpg', '2024-12-01 12:39:02'),
(48, 202879, 'Star Wars: Tripulación perdida', 'Se centrará en un grupo de niños perdidos en la galaxia que intentan encontrar su camino a casa en la era de la Nueva República.', '2024', 9.0, 'https://image.tmdb.org/t/p/w1280/6WK3oVHXnAbQgwvUcqLYlRp8Bvq.jpg', '2024-12-01 12:39:02'),
(49, 277897, '奔跑吧·茶马古道篇', '', '2024', 8.0, 'https://image.tmdb.org/t/p/w1280/vmslJKZM8PHooiqYAzaSroM2UIk.jpg', '2024-12-01 12:39:02'),
(50, 42509, 'Steins;Gate', 'Okabe Rintarou es un joven que se define  a sí mismo como científico loco. Juntos con sus amigos Mayuri y Daru, forma parte el “Laboratorio de Dispositivos del Futuro” una especie de laboratorio clandestino en un pequeño apartamento. Okabe y Mayuri acuden a una conferencia sobre viajes temporales cuando se topan con lo que parece ser un asesinato. Okabe huye espantado mientras avisa a Daru del crimen cuando, de repente, Okabe cambia el pasado evitando el asesinato. ¿Cómo lo ha hecho? ¿Qué consecuencias tendrá este cambio?', '2011', 8.4, 'https://image.tmdb.org/t/p/w1280/6iysgZr6Upm5RlAlVFo5f4D9euu.jpg', '2024-12-01 12:39:02'),
(51, 1399, 'Juego de tronos', 'En una tierra donde los veranos duran décadas y los inviernos pueden durar toda una vida, los problemas acechan. Desde las maquinaciones del sur a las salvajes tierras del este, pasando por el helado norte y el milenario muro que protege el reino de las fuerzas tenebrosas, dos poderosas familias mantienen un enfrentamiento letal por gobernar los Siete Reinos de Poniente. Mientras la traición, la lujuria y las fuerzas sobrenaturales sacuden los pilares de los reinos, la sangrienta batalla por el trono de Hierro tendrá consecuencias imprevistas y trascendentales. El invierno se acerca. Que empiece \'Juego de tronos\'.', '2011', 8.5, 'https://image.tmdb.org/t/p/w1280/z9gCSwIObDOD2BEtmUwfasar3xs.jpg', '2024-12-01 13:27:36'),
(52, 194764, 'El Pingüino', 'Sigue la lucha de Oswald “Oz” Cobb por hacerse con el control de Gotham. Con la ciudad destrozada después del colapso de los diques, Oz busca llenar el vacío de poder que dejó la muerte de Carmine Falcone y darle a su madre Francis la vida que siempre le prometió. Pero antes Oz tendrá que enfrentarse a sus enemigos, incluidos los hijos de Falcone: Sofia y Alberto; la familia Maroni, dirigida por su patriarca encarcelado, Salvatore Maroni; y la propia reputación desmoralizadora de Oz como El Pingüino.', '2024', 8.5, 'https://image.tmdb.org/t/p/w1280/mW2qLgX1Z336obi5rWKQFaKw98n.jpg', '2024-12-01 13:27:36'),
(53, 205050, 'Shangri-La Frontier', '\"¿Cuándo fue la última vez que jugué a un juego que no fuera una mierda?\" Este es un mundo en el futuro cercano donde los juegos que usan pantallas se consideran retro, y muchos juegos de realidad virtual no llegan a un mínimo de calidad: son los llamados \"juegos de mierda\". A los que dedican sus vidas a completar estos juegos se les llama \"cazadores de juegos de mierda\", y Rakuro Hizutome es uno de ellos. El juego que ha elegido empezar a continuación es Shangri-La Frontier, un juego que goza de una gran crítica y más de 30 millones de jugadores. ¡La mejor historia de aventuras escrita por el jugador más fuerte de \"juegos de mierda\" está a punto de comenzar!', '2023', 8.0, 'https://image.tmdb.org/t/p/w1280/5CFYv4WYLZXizAyRwRhP0vZLNx.jpg', '2024-12-01 15:15:27'),
(54, 93405, 'El juego del calamar', 'Cientos de personas con problemas de dinero aceptan una invitación rarísima para competir en juegos infantiles. Dentro los esperan un tentador premio y desafíos letales.', '2021', 7.8, 'https://image.tmdb.org/t/p/w1280/74qMRUy0lwkBBi39vsQVerIDkHj.jpg', '2024-12-01 16:08:36'),
(55, 56570, 'Outlander', 'Sigue la historia de Claire Randall, una enfermera de combate casada en los años 40, que misteriosamente es arrastrada atrás en el tiempo hasta 1743, donde se lanza de inmediato a un mundo desconocido, viéndose amenazada su propia vida. Cuando se ve obligada a casarse con Jamie Fraser, un joven guerrero escocés caballeroso y romántico, Claire comienza un pasional triángulo entre dos hombres muy diferentes con dos vidas irreconciliables.', '2014', 8.2, 'https://image.tmdb.org/t/p/w1280/b1hYWp0qDbTSL7XE3dXbN70K83D.jpg', '2024-12-01 16:56:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `correo_electronico` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `correo_electronico`, `contrasena`, `fecha_registro`) VALUES
(4, 'pablo', 'pablo@example.com', '$2y$10$0SACO9GnATh/wHUB.udLfu0WMfe3cr8mBO6QA5epYM/DPofJEkDR2', '2024-11-29 20:51:35'),
(5, 'ruyi', 'ruyi@gmail.com', '$2y$10$82ddvO118oyswbvK/xx6uOU9kFSJrdni6oAzpEOVmWvEWKpe3BKWW', '2024-11-29 21:06:26'),
(6, 'elle', 'guapita@gmail.com', '$2y$10$Qsg/qCnEu.KtGx2pZG3/TucAq5fErH2.jAWb3YVsbxTb4VcJVn05K', '2024-11-30 21:49:09'),
(7, 'JF', 'jf@gmail.com', '$2y$10$iXej710IyxvvfJZDDtTV4uplFstcQDAdFA.tdVAsTcYQZAu6Wedw6', '2024-12-01 16:54:52');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `resenias`
--
ALTER TABLE `resenias`
  ADD PRIMARY KEY (`id_resenia`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `serie_id` (`serie_id`);

--
-- Indices de la tabla `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serie_id` (`serie_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo_electronico` (`correo_electronico`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `resenias`
--
ALTER TABLE `resenias`
  MODIFY `id_resenia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `resenias`
--
ALTER TABLE `resenias`
  ADD CONSTRAINT `resenias_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `resenias_ibfk_2` FOREIGN KEY (`serie_id`) REFERENCES `series` (`serie_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
