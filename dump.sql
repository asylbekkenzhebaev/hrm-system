--
-- PostgreSQL database dump
--

-- Dumped from database version 15.3 (Ubuntu 15.3-1.pgdg22.04+1)
-- Dumped by pg_dump version 15.2 (Ubuntu 15.2-1.pgdg22.04+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: departments; Type: TABLE; Schema: public; Owner: sa
--

CREATE TABLE public.departments (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.departments OWNER TO sa;

--
-- Name: departments_id_seq; Type: SEQUENCE; Schema: public; Owner: sa
--

CREATE SEQUENCE public.departments_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.departments_id_seq OWNER TO sa;

--
-- Name: departments_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sa
--

ALTER SEQUENCE public.departments_id_seq OWNED BY public.departments.id;


--
-- Name: employees; Type: TABLE; Schema: public; Owner: sa
--

CREATE TABLE public.employees (
    id bigint NOT NULL,
    fio character varying(255) NOT NULL,
    birthday date NOT NULL,
    gender_id integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.employees OWNER TO sa;

--
-- Name: employees_id_seq; Type: SEQUENCE; Schema: public; Owner: sa
--

CREATE SEQUENCE public.employees_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.employees_id_seq OWNER TO sa;

--
-- Name: employees_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sa
--

ALTER SEQUENCE public.employees_id_seq OWNED BY public.employees.id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: sa
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO sa;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: sa
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.failed_jobs_id_seq OWNER TO sa;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sa
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: genders; Type: TABLE; Schema: public; Owner: sa
--

CREATE TABLE public.genders (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.genders OWNER TO sa;

--
-- Name: genders_id_seq; Type: SEQUENCE; Schema: public; Owner: sa
--

CREATE SEQUENCE public.genders_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.genders_id_seq OWNER TO sa;

--
-- Name: genders_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sa
--

ALTER SEQUENCE public.genders_id_seq OWNED BY public.genders.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: sa
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO sa;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: sa
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO sa;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sa
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: sa
--

CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_resets OWNER TO sa;

--
-- Name: personal_access_tokens; Type: TABLE; Schema: public; Owner: sa
--

CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.personal_access_tokens OWNER TO sa;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: sa
--

CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.personal_access_tokens_id_seq OWNER TO sa;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sa
--

ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;


--
-- Name: positions; Type: TABLE; Schema: public; Owner: sa
--

CREATE TABLE public.positions (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    department_id bigint NOT NULL,
    employee_id integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.positions OWNER TO sa;

--
-- Name: positions_id_seq; Type: SEQUENCE; Schema: public; Owner: sa
--

CREATE SEQUENCE public.positions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.positions_id_seq OWNER TO sa;

--
-- Name: positions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sa
--

ALTER SEQUENCE public.positions_id_seq OWNED BY public.positions.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: sa
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO sa;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: sa
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO sa;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sa
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: departments id; Type: DEFAULT; Schema: public; Owner: sa
--

ALTER TABLE ONLY public.departments ALTER COLUMN id SET DEFAULT nextval('public.departments_id_seq'::regclass);


--
-- Name: employees id; Type: DEFAULT; Schema: public; Owner: sa
--

ALTER TABLE ONLY public.employees ALTER COLUMN id SET DEFAULT nextval('public.employees_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: sa
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: genders id; Type: DEFAULT; Schema: public; Owner: sa
--

ALTER TABLE ONLY public.genders ALTER COLUMN id SET DEFAULT nextval('public.genders_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: sa
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: public; Owner: sa
--

ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);


--
-- Name: positions id; Type: DEFAULT; Schema: public; Owner: sa
--

ALTER TABLE ONLY public.positions ALTER COLUMN id SET DEFAULT nextval('public.positions_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: sa
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: departments; Type: TABLE DATA; Schema: public; Owner: sa
--

COPY public.departments (id, name, created_at, updated_at) FROM stdin;
1	Отдел финансов	2023-06-03 16:49:02	2023-06-03 16:49:02
2	Отдел администрации	2023-06-03 16:49:02	2023-06-03 16:49:02
3	Отдел ИТ	2023-06-03 16:49:02	2023-06-03 16:49:02
4	Отдел безопасности	2023-06-03 16:49:02	2023-06-03 16:49:02
\.


--
-- Data for Name: employees; Type: TABLE DATA; Schema: public; Owner: sa
--

COPY public.employees (id, fio, birthday, gender_id, created_at, updated_at) FROM stdin;
1	Эрлан Колбаев	2008-10-01	1	2023-06-03 16:49:02	2023-06-03 16:49:02
2	Артем Марченко	1972-08-30	1	2023-06-03 16:49:02	2023-06-03 16:49:02
3	Саидбек Халиков	2005-03-16	1	2023-06-03 16:49:02	2023-06-03 16:49:02
4	Алина Бактыбек кызы	2010-09-01	2	2023-06-03 16:49:02	2023-06-03 16:49:02
5	Бермет Салиева	1985-01-31	2	2023-06-03 16:49:02	2023-06-03 16:49:02
6	Дарья Зинина	2016-01-02	2	2023-06-03 16:49:02	2023-06-03 16:49:02
7	Манас Маматисаев	2007-01-19	2	2023-06-03 16:49:02	2023-06-03 16:49:02
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: sa
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: genders; Type: TABLE DATA; Schema: public; Owner: sa
--

COPY public.genders (id, name, created_at, updated_at) FROM stdin;
1	муж	2023-06-03 16:49:02	2023-06-03 16:49:02
2	жен	2023-06-03 16:49:02	2023-06-03 16:49:02
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: sa
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	2014_10_12_000000_create_users_table	1
2	2014_10_12_100000_create_password_resets_table	1
3	2019_08_19_000000_create_failed_jobs_table	1
4	2019_12_14_000001_create_personal_access_tokens_table	1
5	2023_06_02_092344_create_departments_table	1
6	2023_06_02_092410_create_genders_table	1
7	2023_06_02_092422_create_employees_table	1
8	2023_06_02_111146_create_positions_table	1
\.


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: sa
--

COPY public.password_resets (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: sa
--

COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, expires_at, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: positions; Type: TABLE DATA; Schema: public; Owner: sa
--

COPY public.positions (id, name, department_id, employee_id, created_at, updated_at) FROM stdin;
2	глав. бухгалтер	1	\N	2023-06-03 16:49:02	2023-06-03 16:49:02
4	кассир	1	\N	2023-06-03 16:49:02	2023-06-03 16:49:02
5	исполнитель менеджер	2	\N	2023-06-03 16:49:02	2023-06-03 16:49:02
6	управляющий менеджер	2	\N	2023-06-03 16:49:02	2023-06-03 16:49:02
8	веб программист	3	\N	2023-06-03 16:49:02	2023-06-03 16:49:02
9	веб программист	3	\N	2023-06-03 16:49:02	2023-06-03 16:49:02
13	охранник	4	\N	2023-06-03 16:49:02	2023-06-03 16:49:02
7	офис менеджер	2	1	2023-06-03 16:49:02	2023-06-03 16:49:02
1	фин. директор	1	2	2023-06-03 16:49:02	2023-06-03 16:49:02
14	охранник	4	3	2023-06-03 16:49:02	2023-06-03 16:49:02
12	руководитель	4	4	2023-06-03 16:49:02	2023-06-03 16:49:02
3	кассир	1	5	2023-06-03 16:49:02	2023-06-03 16:49:02
10	системный администратор	3	6	2023-06-03 16:49:02	2023-06-03 16:49:02
11	системный администратор	3	7	2023-06-03 16:49:02	2023-06-03 16:49:02
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: sa
--

COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) FROM stdin;
1	Admin	admin@admin.com	2023-06-03 16:49:02	$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi	wLxrNjSQMe	2023-06-03 16:49:02	2023-06-03 16:49:02
\.


--
-- Name: departments_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sa
--

SELECT pg_catalog.setval('public.departments_id_seq', 4, true);


--
-- Name: employees_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sa
--

SELECT pg_catalog.setval('public.employees_id_seq', 7, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sa
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: genders_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sa
--

SELECT pg_catalog.setval('public.genders_id_seq', 2, true);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sa
--

SELECT pg_catalog.setval('public.migrations_id_seq', 8, true);


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sa
--

SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);


--
-- Name: positions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sa
--

SELECT pg_catalog.setval('public.positions_id_seq', 14, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sa
--

SELECT pg_catalog.setval('public.users_id_seq', 1, true);


--
-- Name: departments departments_name_unique; Type: CONSTRAINT; Schema: public; Owner: sa
--

ALTER TABLE ONLY public.departments
    ADD CONSTRAINT departments_name_unique UNIQUE (name);


--
-- Name: departments departments_pkey; Type: CONSTRAINT; Schema: public; Owner: sa
--

ALTER TABLE ONLY public.departments
    ADD CONSTRAINT departments_pkey PRIMARY KEY (id);


--
-- Name: employees employees_pkey; Type: CONSTRAINT; Schema: public; Owner: sa
--

ALTER TABLE ONLY public.employees
    ADD CONSTRAINT employees_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: sa
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: sa
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: genders genders_name_unique; Type: CONSTRAINT; Schema: public; Owner: sa
--

ALTER TABLE ONLY public.genders
    ADD CONSTRAINT genders_name_unique UNIQUE (name);


--
-- Name: genders genders_pkey; Type: CONSTRAINT; Schema: public; Owner: sa
--

ALTER TABLE ONLY public.genders
    ADD CONSTRAINT genders_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: sa
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: sa
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: public; Owner: sa
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


--
-- Name: positions positions_pkey; Type: CONSTRAINT; Schema: public; Owner: sa
--

ALTER TABLE ONLY public.positions
    ADD CONSTRAINT positions_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: sa
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: sa
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: sa
--

CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);


--
-- Name: personal_access_tokens_tokenable_type_tokenable_id_index; Type: INDEX; Schema: public; Owner: sa
--

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);


--
-- Name: employees employees_gender_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sa
--

ALTER TABLE ONLY public.employees
    ADD CONSTRAINT employees_gender_id_foreign FOREIGN KEY (gender_id) REFERENCES public.genders(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: positions positions_department_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sa
--

ALTER TABLE ONLY public.positions
    ADD CONSTRAINT positions_department_id_foreign FOREIGN KEY (department_id) REFERENCES public.departments(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: positions positions_employee_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: sa
--

ALTER TABLE ONLY public.positions
    ADD CONSTRAINT positions_employee_id_foreign FOREIGN KEY (employee_id) REFERENCES public.employees(id) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- PostgreSQL database dump complete
--

