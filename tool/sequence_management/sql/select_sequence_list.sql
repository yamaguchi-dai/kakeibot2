select
*,
nextval(name::varchar)
FROM
(
SELECT c.relname as name FROM pg_class c LEFT join pg_user u ON c.relowner = u.usesysid WHERE c.relkind = 'S'
) as tmp;