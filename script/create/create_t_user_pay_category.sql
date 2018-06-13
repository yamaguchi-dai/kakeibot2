-- Project Name : KakeiBot2
-- Date/Time    : 2018/04/08 22:11:21
-- Author       : dai.yamaguchi
-- RDBMS Type   : PostgreSQL
-- Application  : A5:SQL Mk-2

-- ユーザー支払いカテゴリ
drop table if exists T_USER_PAY_CATEGORY cascade;

create table T_USER_PAY_CATEGORY (
  id varchar(10) not null
  , line_id varchar(256) not null
  , name varchar(256) not null
  , created_at varchar(14) not null
  , updated_at varchar(14) not null
  , constraint T_USER_PAY_CATEGORY_PKC primary key (id)
) ;

comment on table T_USER_PAY_CATEGORY is 'ユーザー支払いカテゴリ';
comment on column T_USER_PAY_CATEGORY.id is 'ID:カテゴリーマスタと被らないように注意';
comment on column T_USER_PAY_CATEGORY.line_id is 'LINEID';
comment on column T_USER_PAY_CATEGORY.name is 'カテゴリ名称';
comment on column T_USER_PAY_CATEGORY.created_at is '作成日';
comment on column T_USER_PAY_CATEGORY.updated_at is '更新日';

