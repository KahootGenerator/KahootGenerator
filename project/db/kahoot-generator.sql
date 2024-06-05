/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de cr�ation :  04/06/2024 17:06:08                      */
/*==============================================================*/


drop table if exists `answer`;

drop table if exists `question`;

drop table if exists `kahoot`;

drop table if exists `difficulty`;

drop table if exists `language`;

drop table if exists `time`;

drop table if exists `user`;

/*==============================================================*/
/* Table : answer                                               */
/*==============================================================*/
create table `answer`
(
   id_answer            int not null Auto_increment,
   id_question          int not null,
   id_kahoot            int not null,
   libelle_answer       varchar(75) not null,
   correct              bool not null,
   primary key (id_answer)
)Engine = InnoDB;

/*==============================================================*/
/* Table : difficulty                                           */
/*==============================================================*/
create table `difficulty`
(
   id_difficulty        int not null Auto_increment,
   libelle_difficulty   varchar(50) not null,
   primary key (id_difficulty)
)Engine = InnoDB;

INSERT INTO `difficulty`(libelle_difficulty) VALUES ('Facile'), ('Moyen'), ('Difficile'), ('Croissant'), ('Décroissant'), ('Aléatoire');

/*==============================================================*/
/* Table : kahoot                                               */
/*==============================================================*/
create table `kahoot`
(
   id_kahoot            int not null Auto_increment,
   id_user              int not null,
   id_difficulty        int not null,
   id_language          int not null,
   title_kahoot         varchar(20) not null,
   theme_kahoot         varchar(100) not null,
   date                 date not null,
   primary key (id_kahoot)
)Engine = InnoDB;

/*==============================================================*/
/* Table : language                                             */
/*==============================================================*/
create table `language`
(
   id_language          int not null Auto_increment,
   libelle_language     varchar(50) not null,
   primary key (id_language)
)Engine = InnoDB;

INSERT INTO `language`(libelle_language) VALUES ('Français'), ('Anglais');

/*==============================================================*/
/* Table : question                                             */
/*==============================================================*/
create table `question`
(
   id_question          int not null Auto_increment,
   id_kahoot            int not null,
   id_time              int not null,
   question             varchar(120) not null,
   primary key (id_question, id_kahoot)
)Engine = InnoDB;

/*==============================================================*/
/* Table : time                                                 */
/*==============================================================*/
create table `time`
(
   id_time              int not null Auto_increment,
   time_seconds         int not null,
   primary key (id_time)
)Engine = InnoDB;

INSERT INTO `time`(time_seconds) VALUES (5), (10), (20), (30), (60), (90), (120), (240);

/*==============================================================*/
/* Table : user                                                 */
/*==============================================================*/
create table `user`
(
   id_user              int not null Auto_increment,
   username             varchar(20) not null,
   password             varchar(255) not null,
   primary key (id_user)
)Engine = InnoDB;

alter table `answer` add constraint FK_INCLUDE foreign key (id_question, id_kahoot)
      references `question` (id_question, id_kahoot) on delete cascade on update restrict;

alter table `kahoot` add constraint FK_DEFINES foreign key (id_difficulty)
      references `difficulty` (id_difficulty) on delete cascade on update restrict;

alter table `kahoot` add constraint FK_GENERATE foreign key (id_user)
      references `user` (id_user) on delete cascade on update restrict;

alter table `kahoot` add constraint FK_IS foreign key (id_language)
      references `language` (id_language) on delete cascade on update restrict;

alter table `question` add constraint FK_CONTENTS foreign key (id_kahoot)
      references `kahoot` (id_kahoot) on delete cascade on update restrict;

alter table `question` add constraint FK_DURATE foreign key (id_time)
      references `time` (id_time) on delete cascade on update restrict;

