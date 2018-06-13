-- Project Name : KakeiBot2
-- Date/Time    : 2018/04/08 22:09:02
-- Author       : dai.yamaguchi
-- RDBMS Type   : PostgreSQL
-- Application  : A5:SQL Mk-2

-- �����^�C���p�X���[�h
drop table if exists V_ONETIME_PASS cascade;

create table V_ONETIME_PASS (
  id varchar(256) not null
  , onetime_password character varying(256) not null
  , line_id varchar(256) not null
  , use_flag varchar(1) not null
  , created_at varchar(14) not null
  , updated_at varchar(14) not null
  , constraint V_ONETIME_PASS_PKC primary key (id)
) ;

comment on table V_ONETIME_PASS is '�����^�C���p�X���[�h';
comment on column V_ONETIME_PASS.id is 'ID';
comment on column V_ONETIME_PASS.onetime_password is '�����^�C���g�[�N��';
comment on column V_ONETIME_PASS.line_id is 'LINEID';
comment on column V_ONETIME_PASS.use_flag is '�L���t���O:0:�g�p�ς�1:�g�p�\';
comment on column V_ONETIME_PASS.created_at is '�쐬��';
comment on column V_ONETIME_PASS.updated_at is '�X�V��';

