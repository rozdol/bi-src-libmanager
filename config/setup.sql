------Project's queries------


-- DROP TABLE entities;
CREATE TABLE entities(
  id serial NOT NULL,
  name text DEFAULT ''::text,
  date timestamp DEFAULT now(),
  active boolean default true,
  descr text DEFAULT ''::text,
  surname text DEFAULT ''::text,
  salutation text DEFAULT ''::text,
  type_id integer NOT NULL DEFAULT 0,
  physical boolean DEFAULT false,
  email text DEFAULT ''::text,
  mobile text DEFAULT ''::text,
  tel text DEFAULT ''::text,
  address text DEFAULT ''::text,
  passport text DEFAULT ''::text,
  country_id integer NOT NULL DEFAULT 0,
  birth_date date DEFAULT null,
  CONSTRAINT entities_pkey PRIMARY KEY (id)
)WITH OIDS;

-- DROP TABLE books;
CREATE TABLE books(
  id serial NOT NULL,
  name text DEFAULT ''::text,
  date timestamp DEFAULT now(),
  isbn text DEFAULT ''::text,
  link text DEFAULT ''::text,
  active boolean DEFAULT true,
  descr text DEFAULT ''::text,
  CONSTRAINT books_pkey PRIMARY KEY (id)
)WITH OIDS;

-- DROP TABLE books_transactions;
CREATE TABLE books_transactions(
  id serial NOT NULL,
  name text DEFAULT ''::text,
  date timestamp DEFAULT now(),
  user_id integer NOT NULL DEFAULT 0,
  entity_id integer NOT NULL DEFAULT 0,
  type_id integer NOT NULL DEFAULT 0,
  book_id integer NOT NULL DEFAULT 0,
  date_from timestamp DEFAULT now(),
  date_to timestamp DEFAULT now() + INTERVAL '1 month',
  rating integer DEFAULT null,
  active boolean DEFAULT true,
  descr text DEFAULT ''::text,
  CONSTRAINT books_transactions_pkey PRIMARY KEY (id)
)WITH OIDS;

-- DROP TABLE alerts_history;
CREATE TABLE alerts_history(
  id serial NOT NULL,
  name text DEFAULT ''::text,
  date timestamp DEFAULT now(),
  user_id integer NOT NULL DEFAULT 0,
  entity_id integer NOT NULL DEFAULT 0,
  books_transaction_id integer NOT NULL DEFAULT 0,
  type_id integer NOT NULL DEFAULT 0,
  active boolean DEFAULT true,
  descr text DEFAULT ''::text,
  text text DEFAULT ''::text,
  CONSTRAINT alerts_history_pkey PRIMARY KEY (id)
)WITH OIDS;


alter table books_transactions add constraint fk_books_transactions_books foreign key (book_id) references books (id) on delete cascade on update cascade;
alter table books_transactions add constraint fk_books_transactions_users foreign key (user_id) references users (id) on delete cascade on update cascade;
alter table books_transactions add constraint fk_books_transactions_entities foreign key (entity_id) references entities (id) on delete cascade on update cascade;

alter table alerts_history add constraint fk_alerts_history_users foreign key (user_id) references users (id) on delete cascade on update cascade;
alter table alerts_history add constraint fk_alerts_history_intities foreign key (entity_id) references entities (id) on delete cascade on update cascade;
alter table alerts_history add constraint fk_alerts_history_books_transaction foreign key (books_transaction_id) references books_transactions (id) on delete cascade on update cascade;



