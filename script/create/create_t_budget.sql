-- Project Name : KakeiBot2
-- Date/Time    : 2018/04/08 22:12:20
-- Author       : dai.yamaguchi
-- RDBMS Type   : PostgreSQL
-- Application  : A5:SQL Mk-2

-- —\Z
drop table if exists T_BUDGET cascade;

create table T_BUDGET (
  id varchar(256) not null
  , line_id varchar(256) not null
  , category_id varchar(10) not null
  , price varchar(256)
  , created_at varchar(14) not null
  , updated_at varchar(14) not null
  , constraint T_BUDGET_PKC primary key (id)
) ;

comment on table T_BUDGET is '—\Z';
comment on column T_BUDGET.id is 'ID';
comment on column T_BUDGET.line_id is 'LINEID';
comment on column T_BUDGET.category_id is 'ƒJƒeƒSƒŠID';
comment on column T_BUDGET.price is '—\Z‹àŠz';
comment on column T_BUDGET.created_at is 'ì¬“ú';
comment on column T_BUDGET.updated_at is 'XV“ú';

