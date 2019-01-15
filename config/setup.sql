------Project's queries------
CREATE TABLE rates(
  id serial NOT NULL,
  date date,
  currency integer DEFAULT 0,
  rate double precision DEFAULT 0,
  CONSTRAINT rates_pkey PRIMARY KEY (id)
)WITH OIDS;

CREATE TABLE rates_local(
  id serial NOT NULL,
  date date,
  curr_id integer,
  rate double precision DEFAULT 0,
  CONSTRAINT rates_local_pkey PRIMARY KEY (id)
)WITH OIDS;

-- DROP TABLE entities;
CREATE TABLE entities(
  id serial NOT NULL,
  user_id integer NOT NULL DEFAULT 0,
  name text DEFAULT ''::text,
  date timestamp DEFAULT now(),
  active boolean default true,
  descr text DEFAULT ''::text,
  surname text DEFAULT ''::text,
  salutation text DEFAULT ''::text,
  type_id integer NOT NULL DEFAULT 0,
  physical boolean default false,
  email text DEFAULT ''::text,
  mobile text DEFAULT ''::text,
  tel text DEFAULT ''::text,
  address text DEFAULT ''::text,
  passport text DEFAULT ''::text,
  country_id integer NOT NULL DEFAULT 0,
  birth_date date DEFAULT null,
  CONSTRAINT entities_pkey PRIMARY KEY (id)
)WITH OIDS;

CREATE TABLE templates(
  id serial NOT NULL,
  user_id integer NOT NULL DEFAULT 0,
  name text DEFAULT ''::text,
  date timestamp DEFAULT now(),
  active boolean default true,
  descr text DEFAULT ''::text,
  template text DEFAULT ''::text,
  CONSTRAINT templates_pkey PRIMARY KEY (id)
)WITH OIDS;

CREATE TABLE consent_lists( --recepients, list of emails
  id serial NOT NULL,
  user_id integer NOT NULL DEFAULT 0,
  name text DEFAULT ''::text,
  date timestamp DEFAULT now(),
  active boolean default true,
  descr text DEFAULT ''::text,
  json_list text DEFAULT ''::text,
  ids_list text DEFAULT ''::text,
  CONSTRAINT consent_lists_pkey PRIMARY KEY (id)
)WITH OIDS;

CREATE TABLE questions(
  id serial NOT NULL,
  user_id integer NOT NULL DEFAULT 0,
  name text DEFAULT ''::text,
  date timestamp DEFAULT now(),
  active boolean default true,
  descr text DEFAULT ''::text,
  text text DEFAULT ''::text,
  CONSTRAINT questions_pkey PRIMARY KEY (id)
)WITH OIDS;

CREATE TABLE sessions(
  id serial NOT NULL,
  user_id integer NOT NULL DEFAULT 0,
  name text DEFAULT ''::text,
  date timestamp DEFAULT now(),
  active boolean default true,
  descr text DEFAULT ''::text,
  from_id integer NOT NULL DEFAULT 0,
  template_id integer NOT NULL DEFAULT 0,
  list_id integer NOT NULL DEFAULT 0,
  CONSTRAINT sessions_pkey PRIMARY KEY (id)
)WITH OIDS;

CREATE TABLE consents(
  id serial NOT NULL,
  user_id integer NOT NULL DEFAULT 0,
  name text DEFAULT ''::text,
  date timestamp DEFAULT now(),
  active boolean default true,
  descr text DEFAULT ''::text,
  session_id integer NOT NULL DEFAULT 0,
  from_id integer NOT NULL DEFAULT 0,
  to_id integer NOT NULL DEFAULT 0,
  by_email boolean default false,
  by_mobile boolean default false,
  consent_date timestamp DEFAULT null,
  sent_date date DEFAULT null,
  display_date date DEFAULT null,
  submit_date date DEFAULT null,
  exp_date date DEFAULT null,
  revoked boolean DEFAULT false,
  revoke_date date DEFAULT null,
  uuid text DEFAULT ''::text UNIQUE,
  consent_ip text DEFAULT ''::text,
  revoke_ip text DEFAULT ''::text,
  CONSTRAINT consents_pkey PRIMARY KEY (id)
)WITH OIDS;

CREATE TABLE consent_items(
  id serial NOT NULL,
  name text DEFAULT ''::text,
  active boolean default true,
  descr text DEFAULT ''::text,
  consent_id integer NOT NULL DEFAULT 0,
  question_id integer NOT NULL DEFAULT 0,
  text text DEFAULT ''::text,
  notes text DEFAULT ''::text,
  accepted boolean DEFAULT false,
  rejected boolean DEFAULT false,
  date timestamp DEFAULT now(),
  consent_date timestamp DEFAULT null,
  exp_date date DEFAULT null,
  revoked boolean DEFAULT false,
  revoke_date date DEFAULT null,
  CONSTRAINT consent_items_pkey PRIMARY KEY (id)
)WITH OIDS;

CREATE TABLE question2template(
  id serial NOT NULL,
  name text DEFAULT ''::text,
  active boolean default true,
  template_id integer NOT NULL DEFAULT 0,
  question_id integer NOT NULL DEFAULT 0,
  CONSTRAINT question2template_pkey PRIMARY KEY (id)
)WITH OIDS;

--DROP TABLE cashflow;
CREATE TABLE cashflow(
  id serial NOT NULL,
  user_id integer NOT NULL DEFAULT 0,
  name text DEFAULT ''::text,
  date timestamp DEFAULT now(),
  active boolean default true,
  descr text DEFAULT ''::text,
  currency_id integer NOT NULL DEFAULT 0,
  type_id integer NOT NULL DEFAULT 0,
  units integer DEFAULT 0,
  amount numeric DEFAULT 0,
  amount_eur numeric DEFAULT 0,
  amount_usd numeric DEFAULT 0,
  payment_id integer NOT NULL DEFAULT 0,
  consent_id integer NOT NULL DEFAULT 0,
  CONSTRAINT cashflow_pkey PRIMARY KEY (id)
)WITH OIDS;



CREATE TABLE products(
  id serial NOT NULL,
  name text DEFAULT ''::text,
  date timestamp DEFAULT now(),
  active boolean default true,
  descr text DEFAULT ''::text,
  image text DEFAULT ''::text,
  currency_id integer NOT NULL DEFAULT 601,
  type_id integer NOT NULL DEFAULT 0,
  units integer DEFAULT 0,
  qty integer DEFAULT 0,
  price numeric DEFAULT 0,
  CONSTRAINT products_pkey PRIMARY KEY (id)
)WITH OIDS;

CREATE TABLE payments(
  id serial NOT NULL,
  user_id integer NOT NULL DEFAULT 0,
  name text DEFAULT ''::text,
  date timestamp DEFAULT now(),
  active boolean default true,
  descr text DEFAULT ''::text,
  item_number text DEFAULT ''::text,
  txn_id text DEFAULT ''::text,
  currency_id integer NOT NULL DEFAULT 601,
  status_id integer NOT NULL DEFAULT 0,
  status text DEFAULT ''::text,
  product_id integer NOT NULL DEFAULT 0,
  amount numeric DEFAULT 0,
  amount_eur numeric DEFAULT 0,
  amount_usd numeric DEFAULT 0,

  transaction_subject text DEFAULT ''::text,
  txn_type text DEFAULT ''::text,
  payment_date text DEFAULT ''::text,
  last_name text DEFAULT ''::text,
  residence_country text DEFAULT ''::text,
  pending_reason text DEFAULT ''::text,
  item_name text DEFAULT ''::text,
  payment_gross text DEFAULT ''::text,
  mc_currency text DEFAULT ''::text,
  business text DEFAULT ''::text,
  payment_type text DEFAULT ''::text,
  protection_eligibility text DEFAULT ''::text,
  verify_sign text DEFAULT ''::text,
  payer_status text DEFAULT ''::text,
  test_ipn text DEFAULT ''::text,
  payer_email text DEFAULT ''::text,
  quantity text DEFAULT ''::text,
  receiver_email text DEFAULT ''::text,
  first_name text DEFAULT ''::text,
  payer_id text DEFAULT ''::text,
  receiver_id text DEFAULT ''::text,
  handling_amount text DEFAULT ''::text,
  payment_status text DEFAULT ''::text,
  mc_gross text DEFAULT ''::text,
  custom text DEFAULT ''::text,
  charset text DEFAULT ''::text,
  notify_version text DEFAULT ''::text,
  ipn_track_id text DEFAULT ''::text,
    CONSTRAINT payments_pkey PRIMARY KEY (id)
)WITH OIDS;






alter table entities add constraint fk_entities_users foreign key (user_id) references users (id) on delete cascade on update cascade;
alter table templates add constraint fk_templates_users foreign key (user_id) references users (id) on delete cascade on update cascade;
alter table consent_lists add constraint fk_consent_lists_users foreign key (user_id) references users (id) on delete cascade on update cascade;
alter table questions add constraint fk_questions_users foreign key (user_id) references users (id) on delete cascade on update cascade;

alter table sessions add constraint fk_sessions_users foreign key (user_id) references users (id) on delete cascade on update cascade;
alter table sessions add constraint fk_sessions_from foreign key (from_id) references entities (id) on delete cascade on update cascade;
alter table sessions add constraint fk_sessions_templates foreign key (template_id) references templates (id) on delete cascade on update cascade;
alter table sessions add constraint fk_sessions_lists foreign key (list_id) references consent_lists (id) on delete cascade on update cascade;

alter table consents add constraint fk_consents_users foreign key (user_id) references users (id) on delete cascade on update cascade;
alter table consents add constraint fk_consents_from_entities foreign key (from_id) references entities (id) on delete cascade on update cascade;
alter table consents add constraint fk_consents_to_entities foreign key (to_id) references entities (id) on delete cascade on update cascade;
alter table consents add constraint fk_consents_sessions foreign key (session_id) references sessions (id) on delete cascade on update cascade;
alter table consent_items add constraint fk_consent_items_consents foreign key (consent_id) references consents (id) on delete cascade on update cascade;
alter table consent_items add constraint fk_consent_items_questions foreign key (question_id) references questions (id) on delete cascade on update cascade;
alter table question2template add constraint fk_question2template_templates foreign key (template_id) references templates (id) on delete cascade on update cascade;
alter table question2template add constraint fk_question2template_questions foreign key (question_id) references questions (id) on delete cascade on update cascade;
alter table cashflow add constraint fk_cashflow_users foreign key (user_id) references users (id) on delete cascade on update cascade;



-- ALTER TABLE payments ADD column transaction_subject text DEFAULT ''::text;
-- ALTER TABLE payments ADD column txn_type text DEFAULT ''::text;
-- ALTER TABLE payments ADD column payment_date text DEFAULT ''::text;
-- ALTER TABLE payments ADD column last_name text DEFAULT ''::text;
-- ALTER TABLE payments ADD column residence_country text DEFAULT ''::text;
-- ALTER TABLE payments ADD column pending_reason text DEFAULT ''::text;
-- ALTER TABLE payments ADD column item_name text DEFAULT ''::text;
-- ALTER TABLE payments ADD column payment_gross text DEFAULT ''::text;
-- ALTER TABLE payments ADD column mc_currency text DEFAULT ''::text;
-- ALTER TABLE payments ADD column business text DEFAULT ''::text;
-- ALTER TABLE payments ADD column payment_type text DEFAULT ''::text;
-- ALTER TABLE payments ADD column protection_eligibility text DEFAULT ''::text;
-- ALTER TABLE payments ADD column verify_sign text DEFAULT ''::text;
-- ALTER TABLE payments ADD column payer_status text DEFAULT ''::text;
-- ALTER TABLE payments ADD column test_ipn text DEFAULT ''::text;
-- ALTER TABLE payments ADD column payer_email text DEFAULT ''::text;
-- ALTER TABLE payments ADD column quantity text DEFAULT ''::text;
-- ALTER TABLE payments ADD column receiver_email text DEFAULT ''::text;
-- ALTER TABLE payments ADD column first_name text DEFAULT ''::text;
-- ALTER TABLE payments ADD column payer_id text DEFAULT ''::text;
-- ALTER TABLE payments ADD column receiver_id text DEFAULT ''::text;
-- ALTER TABLE payments ADD column handling_amount text DEFAULT ''::text;
-- ALTER TABLE payments ADD column payment_status text DEFAULT ''::text;
-- ALTER TABLE payments ADD column mc_gross text DEFAULT ''::text;
-- ALTER TABLE payments ADD column custom text DEFAULT ''::text;
-- ALTER TABLE payments ADD column charset text DEFAULT ''::text;
-- ALTER TABLE payments ADD column notify_version text DEFAULT ''::text;
-- ALTER TABLE payments ADD column ipn_track_id text DEFAULT ''::text;

-- ALTER TABLE cashflow ADD column payment_id integer NOT NULL DEFAULT 0;
-- ALTER TABLE cashflow ADD column consent_id integer NOT NULL DEFAULT 0;
