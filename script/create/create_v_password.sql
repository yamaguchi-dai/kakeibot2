-- Project Name : KakeiBot2
-- Date/Time    : 2018/04/08 22:10:16
-- Author       : dai.yamaguchi
-- RDBMS Type   : PostgreSQL
-- Application  : A5:SQL Mk-2

-- �p�X���[�h
drop table if exists V_PASSWORD cascade;

create table V_PASSWORD (
  user_id varchar(25) not null
  , password varchar(25) not null
  , created_at varchar(14) not null
  , updated_at varchar(14) not null
) ;

comment on table V_PASSWORD is '�p�X���[�h';
comment on column V_PASSWORD.user_id is '���[�U�[ID';
comment on column V_PASSWORD.password is '�p�X���[�h';
comment on column V_PASSWORD.created_at is '�쐬��';
comment on column V_PASSWORD.updated_at is '�X�V��';

