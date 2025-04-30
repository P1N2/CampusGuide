/*==============================================================*/
/* Nom de SGBD :  Sybase SQL Anywhere 11                        */
/* Date de création :  29/04/2025 17:27:15                      */
/*==============================================================*/


if exists(select 1 from sys.sysforeignkey where role='FK_ASSOCIAT_ASSOCIATI_USER') then
    alter table ASSOCIATION_5
       delete foreign key FK_ASSOCIAT_ASSOCIATI_USER
end if;

if exists(select 1 from sys.sysforeignkey where role='FK_ASSOCIAT_ASSOCIATI_UNIVERSI') then
    alter table ASSOCIATION_5
       delete foreign key FK_ASSOCIAT_ASSOCIATI_UNIVERSI
end if;

if exists(select 1 from sys.sysforeignkey where role='FK_AVIS_ASSOCIATI_USER') then
    alter table AVIS
       delete foreign key FK_AVIS_ASSOCIATI_USER
end if;

if exists(select 1 from sys.sysforeignkey where role='FK_AVIS_ASSOCIATI_UNIVERSI') then
    alter table AVIS
       delete foreign key FK_AVIS_ASSOCIATI_UNIVERSI
end if;

if exists(select 1 from sys.sysforeignkey where role='FK_PROPOSE_PROPOSE_UNIVERSI') then
    alter table PROPOSE
       delete foreign key FK_PROPOSE_PROPOSE_UNIVERSI
end if;

if exists(select 1 from sys.sysforeignkey where role='FK_PROPOSE_PROPOSE2_FIELD') then
    alter table PROPOSE
       delete foreign key FK_PROPOSE_PROPOSE2_FIELD
end if;

if exists(select 1 from sys.sysforeignkey where role='FK_QUIZ_RES_FAIT_USER') then
    alter table QUIZ_RESULT
       delete foreign key FK_QUIZ_RES_FAIT_USER
end if;

if exists(select 1 from sys.sysforeignkey where role='FK_SEARCH_H_RECHERCHE_USER') then
    alter table SEARCH_HISTORY
       delete foreign key FK_SEARCH_H_RECHERCHE_USER
end if;

if exists(
   select 1 from sys.sysindex i, sys.systable t
   where i.table_id=t.table_id 
     and i.index_name='ASSOCIATION_8_FK'
     and t.table_name='ASSOCIATION_5'
) then
   drop index ASSOCIATION_5.ASSOCIATION_8_FK
end if;

if exists(
   select 1 from sys.sysindex i, sys.systable t
   where i.table_id=t.table_id 
     and i.index_name='ASSOCIATION_5_FK'
     and t.table_name='ASSOCIATION_5'
) then
   drop index ASSOCIATION_5.ASSOCIATION_5_FK
end if;

if exists(
   select 1 from sys.sysindex i, sys.systable t
   where i.table_id=t.table_id 
     and i.index_name='ASSOCIATION_5_PK'
     and t.table_name='ASSOCIATION_5'
) then
   drop index ASSOCIATION_5.ASSOCIATION_5_PK
end if;

if exists(
   select 1 from sys.systable 
   where table_name='ASSOCIATION_5'
     and table_type in ('BASE', 'GBL TEMP')
) then
    drop table ASSOCIATION_5
end if;

if exists(
   select 1 from sys.sysindex i, sys.systable t
   where i.table_id=t.table_id 
     and i.index_name='ASSOCIATION_7_FK'
     and t.table_name='AVIS'
) then
   drop index AVIS.ASSOCIATION_7_FK
end if;

if exists(
   select 1 from sys.sysindex i, sys.systable t
   where i.table_id=t.table_id 
     and i.index_name='ASSOCIATION_6_FK'
     and t.table_name='AVIS'
) then
   drop index AVIS.ASSOCIATION_6_FK
end if;

if exists(
   select 1 from sys.sysindex i, sys.systable t
   where i.table_id=t.table_id 
     and i.index_name='AVIS_PK'
     and t.table_name='AVIS'
) then
   drop index AVIS.AVIS_PK
end if;

if exists(
   select 1 from sys.systable 
   where table_name='AVIS'
     and table_type in ('BASE', 'GBL TEMP')
) then
    drop table AVIS
end if;

if exists(
   select 1 from sys.sysindex i, sys.systable t
   where i.table_id=t.table_id 
     and i.index_name='FIELD_PK'
     and t.table_name='FIELD'
) then
   drop index FIELD.FIELD_PK
end if;

if exists(
   select 1 from sys.systable 
   where table_name='FIELD'
     and table_type in ('BASE', 'GBL TEMP')
) then
    drop table FIELD
end if;

if exists(
   select 1 from sys.sysindex i, sys.systable t
   where i.table_id=t.table_id 
     and i.index_name='PROPOSE2_FK'
     and t.table_name='PROPOSE'
) then
   drop index PROPOSE.PROPOSE2_FK
end if;

if exists(
   select 1 from sys.sysindex i, sys.systable t
   where i.table_id=t.table_id 
     and i.index_name='PROPOSE_FK'
     and t.table_name='PROPOSE'
) then
   drop index PROPOSE.PROPOSE_FK
end if;

if exists(
   select 1 from sys.sysindex i, sys.systable t
   where i.table_id=t.table_id 
     and i.index_name='PROPOSE_PK'
     and t.table_name='PROPOSE'
) then
   drop index PROPOSE.PROPOSE_PK
end if;

if exists(
   select 1 from sys.systable 
   where table_name='PROPOSE'
     and table_type in ('BASE', 'GBL TEMP')
) then
    drop table PROPOSE
end if;

if exists(
   select 1 from sys.sysindex i, sys.systable t
   where i.table_id=t.table_id 
     and i.index_name='FAIT_FK'
     and t.table_name='QUIZ_RESULT'
) then
   drop index QUIZ_RESULT.FAIT_FK
end if;

if exists(
   select 1 from sys.sysindex i, sys.systable t
   where i.table_id=t.table_id 
     and i.index_name='QUIZ_RESULT_PK'
     and t.table_name='QUIZ_RESULT'
) then
   drop index QUIZ_RESULT.QUIZ_RESULT_PK
end if;

if exists(
   select 1 from sys.systable 
   where table_name='QUIZ_RESULT'
     and table_type in ('BASE', 'GBL TEMP')
) then
    drop table QUIZ_RESULT
end if;

if exists(
   select 1 from sys.sysindex i, sys.systable t
   where i.table_id=t.table_id 
     and i.index_name='RECHERCHE_FK'
     and t.table_name='SEARCH_HISTORY'
) then
   drop index SEARCH_HISTORY.RECHERCHE_FK
end if;

if exists(
   select 1 from sys.sysindex i, sys.systable t
   where i.table_id=t.table_id 
     and i.index_name='SEARCH_HISTORY_PK'
     and t.table_name='SEARCH_HISTORY'
) then
   drop index SEARCH_HISTORY.SEARCH_HISTORY_PK
end if;

if exists(
   select 1 from sys.systable 
   where table_name='SEARCH_HISTORY'
     and table_type in ('BASE', 'GBL TEMP')
) then
    drop table SEARCH_HISTORY
end if;

if exists(
   select 1 from sys.sysindex i, sys.systable t
   where i.table_id=t.table_id 
     and i.index_name='UNIVERSITY_PK'
     and t.table_name='UNIVERSITY'
) then
   drop index UNIVERSITY.UNIVERSITY_PK
end if;

if exists(
   select 1 from sys.systable 
   where table_name='UNIVERSITY'
     and table_type in ('BASE', 'GBL TEMP')
) then
    drop table UNIVERSITY
end if;

if exists(
   select 1 from sys.sysindex i, sys.systable t
   where i.table_id=t.table_id 
     and i.index_name='USER_PK'
     and t.table_name='USER'
) then
   drop index "USER".USER_PK
end if;

if exists(
   select 1 from sys.systable 
   where table_name='USER'
     and table_type in ('BASE', 'GBL TEMP')
) then
    drop table "USER"
end if;

/*==============================================================*/
/* Table : ASSOCIATION_5                                        */
/*==============================================================*/
create table ASSOCIATION_5 
(
   ID                   integer                        not null,
   ID_UNI               integer                        not null,
   CREATED_AT           timestamp                      null,
   constraint PK_ASSOCIATION_5 primary key clustered (ID, ID_UNI)
);

/*==============================================================*/
/* Index : ASSOCIATION_5_PK                                     */
/*==============================================================*/
create unique clustered index ASSOCIATION_5_PK on ASSOCIATION_5 (
ID ASC,
ID_UNI ASC
);

/*==============================================================*/
/* Index : ASSOCIATION_5_FK                                     */
/*==============================================================*/
create index ASSOCIATION_5_FK on ASSOCIATION_5 (
ID ASC
);

/*==============================================================*/
/* Index : ASSOCIATION_8_FK                                     */
/*==============================================================*/
create index ASSOCIATION_8_FK on ASSOCIATION_5 (
ID_UNI ASC
);

/*==============================================================*/
/* Table : AVIS                                                 */
/*==============================================================*/
create table AVIS 
(
   ID_AV                integer                        not null,
   ID                   integer                        not null,
   ID_UNI               integer                        not null,
   COMMENTAIRE          long varchar                   null,
   NOTE                 float                          null,
   CREATED_AT           timestamp                      null,
   constraint PK_AVIS primary key (ID_AV)
);

/*==============================================================*/
/* Index : AVIS_PK                                              */
/*==============================================================*/
create unique index AVIS_PK on AVIS (
ID_AV ASC
);

/*==============================================================*/
/* Index : ASSOCIATION_6_FK                                     */
/*==============================================================*/
create index ASSOCIATION_6_FK on AVIS (
ID ASC
);

/*==============================================================*/
/* Index : ASSOCIATION_7_FK                                     */
/*==============================================================*/
create index ASSOCIATION_7_FK on AVIS (
ID_UNI ASC
);

/*==============================================================*/
/* Table : FIELD                                                */
/*==============================================================*/
create table FIELD 
(
   ID_FI                integer                        not null,
   NAME_FI              long varchar                   null,
   DESCRIPTION          long varchar                   null,
   CREATED_AT           timestamp                      null,
   UPDATED_AT           timestamp                      null,
   constraint PK_FIELD primary key (ID_FI)
);

/*==============================================================*/
/* Index : FIELD_PK                                             */
/*==============================================================*/
create unique index FIELD_PK on FIELD (
ID_FI ASC
);

/*==============================================================*/
/* Table : PROPOSE                                              */
/*==============================================================*/
create table PROPOSE 
(
   ID_UNI               integer                        not null,
   ID_FI                integer                        not null,
   constraint PK_PROPOSE primary key clustered (ID_UNI, ID_FI)
);

/*==============================================================*/
/* Index : PROPOSE_PK                                           */
/*==============================================================*/
create unique clustered index PROPOSE_PK on PROPOSE (
ID_UNI ASC,
ID_FI ASC
);

/*==============================================================*/
/* Index : PROPOSE_FK                                           */
/*==============================================================*/
create index PROPOSE_FK on PROPOSE (
ID_UNI ASC
);

/*==============================================================*/
/* Index : PROPOSE2_FK                                          */
/*==============================================================*/
create index PROPOSE2_FK on PROPOSE (
ID_FI ASC
);

/*==============================================================*/
/* Table : QUIZ_RESULT                                          */
/*==============================================================*/
create table QUIZ_RESULT 
(
   ID_Q                 integer                        not null,
   ID                   integer                        not null,
   RECO_FI              long varchar                   null,
   RECO_UNI             long varchar                   null,
   CREATED_AT           timestamp                      null,
   constraint PK_QUIZ_RESULT primary key (ID_Q),
   constraint AK_IDENTIFIANT_2_QUIZ_RES unique (ID_Q)
);

/*==============================================================*/
/* Index : QUIZ_RESULT_PK                                       */
/*==============================================================*/
create unique index QUIZ_RESULT_PK on QUIZ_RESULT (
ID_Q ASC
);

/*==============================================================*/
/* Index : FAIT_FK                                              */
/*==============================================================*/
create index FAIT_FK on QUIZ_RESULT (
ID ASC
);

/*==============================================================*/
/* Table : SEARCH_HISTORY                                       */
/*==============================================================*/
create table SEARCH_HISTORY 
(
   ID_S                 integer                        not null,
   ID                   integer                        not null,
   RATING               integer                        null,
   CREATED_AT           timestamp                      null,
   constraint PK_SEARCH_HISTORY primary key (ID_S)
);

/*==============================================================*/
/* Index : SEARCH_HISTORY_PK                                    */
/*==============================================================*/
create unique index SEARCH_HISTORY_PK on SEARCH_HISTORY (
ID_S ASC
);

/*==============================================================*/
/* Index : RECHERCHE_FK                                         */
/*==============================================================*/
create index RECHERCHE_FK on SEARCH_HISTORY (
ID ASC
);

/*==============================================================*/
/* Table : UNIVERSITY                                           */
/*==============================================================*/
create table UNIVERSITY 
(
   ID_UNI               integer                        not null,
   NAME_UNI             long varchar                   null,
   DESCRIPTION          long varchar                   null,
   HISTORY              long varchar                   null,
   LOCATION             long varchar                   null,
   TUITION_FEE          decimal                        null,
   NOTE                 float                          null,
   MEDIA_URL            char(50)                       null,
   APPLICATION_LINK     char(50)                       null,
   CREATED_AT           timestamp                      null,
   UPDATED_AT           timestamp                      null,
   PDF_URL              char(20)                       null,
   constraint PK_UNIVERSITY primary key (ID_UNI)
);

/*==============================================================*/
/* Index : UNIVERSITY_PK                                        */
/*==============================================================*/
create unique index UNIVERSITY_PK on UNIVERSITY (
ID_UNI ASC
);

/*==============================================================*/
/* Table : "USER"                                               */
/*==============================================================*/
create table "USER" 
(
   ID                   integer                        not null,
   NAME                 long varchar                   null,
   EMAIL                long varchar                   null,
   PASSWORD             long varchar                   null,
   CREATED_AT           timestamp                      null,
   UPDATED_AT           timestamp                      null,
   constraint PK_USER primary key (ID),
   constraint AK_IDENTIFIANT_2_USER unique (ID)
);

/*==============================================================*/
/* Index : USER_PK                                              */
/*==============================================================*/
create unique index USER_PK on "USER" (
ID ASC
);

alter table ASSOCIATION_5
   add constraint FK_ASSOCIAT_ASSOCIATI_USER foreign key (ID)
      references "USER" (ID)
      on update restrict
      on delete restrict;

alter table ASSOCIATION_5
   add constraint FK_ASSOCIAT_ASSOCIATI_UNIVERSI foreign key (ID_UNI)
      references UNIVERSITY (ID_UNI)
      on update restrict
      on delete restrict;

alter table AVIS
   add constraint FK_AVIS_ASSOCIATI_USER foreign key (ID)
      references "USER" (ID)
      on update restrict
      on delete restrict;

alter table AVIS
   add constraint FK_AVIS_ASSOCIATI_UNIVERSI foreign key (ID_UNI)
      references UNIVERSITY (ID_UNI)
      on update restrict
      on delete restrict;

alter table PROPOSE
   add constraint FK_PROPOSE_PROPOSE_UNIVERSI foreign key (ID_UNI)
      references UNIVERSITY (ID_UNI)
      on update restrict
      on delete restrict;

alter table PROPOSE
   add constraint FK_PROPOSE_PROPOSE2_FIELD foreign key (ID_FI)
      references FIELD (ID_FI)
      on update restrict
      on delete restrict;

alter table QUIZ_RESULT
   add constraint FK_QUIZ_RES_FAIT_USER foreign key (ID)
      references "USER" (ID)
      on update restrict
      on delete restrict;

alter table SEARCH_HISTORY
   add constraint FK_SEARCH_H_RECHERCHE_USER foreign key (ID)
      references "USER" (ID)
      on update restrict
      on delete restrict;

