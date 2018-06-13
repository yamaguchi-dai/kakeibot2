-- Project Name : KakeiBot2
-- Date/Time    : 2018/04/10 23:25:24
-- Author       : dai.yamaguchi
-- RDBMS Type   : PostgreSQL
-- Application  : A5:SQL Mk-2

-- x•¥‚¢
drop table if exists T_PAYMENT cascade;

create table T_PAYMENT (
  id varchar(256) not null
  , line_id varchar(256) not null
  , category_id varchar(4) not null
  , price varchar(10)
  , comment varchar(256)
  , created_at varchar(14) not null
  , updated_at varchar(14) not null
  , constraint T_PAYMENT_PKC primary key (id)
) ;

comment on table T_PAYMENT is 'x•¥‚¢';
comment on column T_PAYMENT.id is 'ID';
comment on column T_PAYMENT.line_id is 'LINEID';
comment on column T_PAYMENT.category_id is 'ƒJƒeƒSƒŠID';
comment on column T_PAYMENT.price is 'x•¥‚¢‹àŠz';
comment on column T_PAYMENT.comment is 'ƒRƒƒ“ƒg';
comment on column T_PAYMENT.created_at is 'ì¬“ú';
comment on column T_PAYMENT.updated_at is 'XV“ú';

