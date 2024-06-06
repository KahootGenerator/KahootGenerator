/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de cr�ation :  04/06/2024 17:06:08                      */
/*==============================================================*/

create database if not exists `kahoot-generator`;

use `kahoot-generator`;

/*==============================================================*/


/*==============================================================*/
/* Table : answer                                               */
/*==============================================================*/
create table `answer`
(
   id            varchar(13) not null,
   id_question          varchar(13) not null,
   libelle       varchar(75) not null,
   correct              bool not null,
   primary key (id)
)Engine = InnoDB;

/*==============================================================*/
/* Table : difficulty                                           */
/*==============================================================*/
create table `difficulty`
(
   id        int not null Auto_increment,
   libelle   varchar(50) not null,
   primary key (id)
)Engine = InnoDB;

INSERT INTO `difficulty`(libelle) VALUES ('Facile'), ('Moyen'), ('Difficile'), ('Croissant'), ('Décroissant'), ('Aléatoire');

/*==============================================================*/
/* Table : kahoot                                               */
/*==============================================================*/
create table `kahoot`
(
   id            varchar(13) not null,
   id_user              varchar(13) not null,
   id_difficulty        int not null,
   id_language          int not null,
   title         varchar(20) not null,
   theme         varchar(100) not null,
   date                 date not null,
   primary key (id)
)Engine = InnoDB;

/*==============================================================*/
/* Table : language                                             */
/*==============================================================*/
create table `language`
(
   id          int not null Auto_increment,
   libelle     varchar(50) not null,
   primary key (id)
)Engine = InnoDB;

INSERT INTO `language`(libelle) VALUES ('Français'), ('Anglais');

/*==============================================================*/
/* Table : question                                             */
/*==============================================================*/
create table `question`
(
   id          varchar(13) not null,
   id_kahoot            varchar(13) not null,
   id_time              int not null,
   question             varchar(120) not null,
   primary key (id)
)Engine = InnoDB;

/*==============================================================*/
/* Table : time                                                 */
/*==============================================================*/
create table `time`
(
   id              int not null Auto_increment,
   seconds         int not null,
   primary key (id)
)Engine = InnoDB;

INSERT INTO `time`(seconds) VALUES (5), (10), (20), (30), (60), (90), (120), (240);

/*==============================================================*/
/* Table : user                                                 */
/*==============================================================*/
create table `user`
(
   id              varchar(13) not null,
   username             varchar(20) not null,
   password             varchar(255) not null,
   primary key (id)
)Engine = InnoDB;

alter table `answer` add constraint FK_INCLUDE foreign key (id_question)
      references `question` (id) on delete cascade on update restrict;

alter table `kahoot` add constraint FK_DEFINES foreign key (id_difficulty)
      references `difficulty` (id) on delete cascade on update restrict;

alter table `kahoot` add constraint FK_GENERATE foreign key (id_user)
      references `user` (id) on delete cascade on update restrict;

alter table `kahoot` add constraint FK_IS foreign key (id_language)
      references `language` (id) on delete cascade on update restrict;

alter table `question` add constraint FK_CONTENTS foreign key (id_kahoot)
      references `kahoot` (id) on delete cascade on update restrict;

alter table `question` add constraint FK_DURATE foreign key (id_time)
      references `time` (id) on delete cascade on update restrict;

