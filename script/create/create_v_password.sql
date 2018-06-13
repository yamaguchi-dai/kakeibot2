-- Project Name : KakeiBot2
-- Date/Time    : 2018/04/08 22:10:16
-- Author       : dai.yamaguchi
-- RDBMS Type   : PostgreSQL
-- Application  : A5:SQL Mk-2

-- パスワード
drop table if exists V_PASSWORD cascade;

create table V_PASSWORD (
  user_id varchar(25) not null
  , password varchar(25) not null
  , created_at varchar(14) not null
  , updated_at varchar(14) not null
) ;

comment on table V_PASSWORD is 'パスワード';
comment on column V_PASSWORD.user_id is 'ユーザーID';
comment on column V_PASSWORD.password is 'パスワード';
comment on column V_PASSWORD.created_at is '作成日';
comment on column V_PASSWORD.updated_at is '更新日';

