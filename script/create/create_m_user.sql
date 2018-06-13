-- Project Name : KakeiBot2
-- Date/Time    : 2018/04/08 22:10:52
-- Author       : dai.yamaguchi
-- RDBMS Type   : PostgreSQL
-- Application  : A5:SQL Mk-2

-- ユーザーマスタ
drop table if exists M_USER cascade;

create table M_USER (
  id varchar(256)
  , user_id varchar(25)
  , line_id varchar(256) not null
  , created_at varchar(14) not null
  , updated_at varchar(14) not null
  , constraint M_USER_PKC primary key (id)
) ;

comment on table M_USER is 'ユーザーマスタ';
comment on column M_USER.id is 'ID';
comment on column M_USER.user_id is 'ユーザーID';
comment on column M_USER.line_id is 'LINEID';
comment on column M_USER.created_at is '作成日';
comment on column M_USER.updated_at is '更新日';

