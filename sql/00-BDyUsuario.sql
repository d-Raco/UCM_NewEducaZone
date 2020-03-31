CREATE DATABASE IF NOT EXISTS `centros_educativos` DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

CREATE USER IF NOT EXISTS 'administrador'@'%' IDENTIFIED BY 'administrador';
GRANT ALL PRIVILEGES ON `centros_educativos`.* TO 'administrador'@'%';

CREATE USER IF NOT EXISTS 'administrador'@'localhost' IDENTIFIED BY 'administrador';
GRANT ALL PRIVILEGES ON `centros_educativos`.* TO 'administrador'@'localhost';
