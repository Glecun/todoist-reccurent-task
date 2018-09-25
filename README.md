# todoist-reccurent-task
Add custom recurrent task to your todoist

## Prerequisites
Replace the following lines:
```
in TodoistDao.php
$token = "[YOUR_TOKEN]";
$toProject = '[YOUR_PROJECT]';
 
in TaskDao.php
$this->bdd = pg_connect("host=[HOST] user=[USER] password=[PASSWORD] dbname=[DBNAME]");
 
in MailService.php
$to = "[YOUR-MAIL]";
```

This project works with a postgresql db in order to save ids of your tasks
```
CREATE TABLE public.tasks (
    id integer NOT NULL,
    name character varying,
    comment character varying,
    valid boolean,
    tempo integer,
    lastid double precision,
    date date
);

```