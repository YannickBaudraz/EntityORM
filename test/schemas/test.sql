create
    or replace schema entity_orm_tests collate utf8_general_ci;

create
    or replace table entity_orm_tests.users_test
(
    id         int auto_increment primary key,
    first_name varchar(45)  not null,
    last_name  varchar(45)  not null,
    email      varchar(255) not null,
    ip_address varchar(15)  not null,
    constraint email_UNIQUE
        unique (email)
);

insert into entity_orm_tests.users_test (id, first_name, last_name, email, ip_address)
values (1, 'Obidiah', 'Beig', 'obeig0@phpbb.com', '171.95.176.82'),
       (2, 'Ryley', 'Vaughan-Hughes', 'rvaughanhughes1@angelfire.com', '108.225.12.193'),
       (3, 'Chad', 'Bardell', 'cbardell2@auda.org.au', '253.127.34.56'),
       (4, 'Tory', 'Chaffey', 'tchaffey3@flavors.me', '237.152.85.190'),
       (5, 'Arri', 'Bradnam', 'abradnam4@amazon.co.jp', '136.230.212.172'),
       (6, 'Ingrim', 'Bracey', 'ibracey5@wufoo.com', '203.97.95.7'),
       (7, 'Raine', 'Laugherane', 'rlaugherane6@pen.io', '156.186.54.200'),
       (8, 'Benny', 'Rubinovici', 'brubinovici7@cmu.edu', '197.111.183.93'),
       (9, 'Quintilla', 'Baulch', 'qbaulch8@prweb.com', '108.27.144.61'),
       (10, 'Harri', 'Addess', 'haddess9@unc.edu', '126.82.223.159'),
       (11, 'Grannie', 'Hartland', 'ghartlanda@aboutads.info', '158.239.125.227'),
       (12, 'Gregor', 'Pauli', 'gpaulib@csmonitor.com', '122.88.122.26'),
       (13, 'Dennison', 'Bartocci', 'dbartoccic@pcworld.com', '153.232.242.149'),
       (14, 'Malorie', 'Gillis', 'mgillisd@last.fm', '127.98.110.252'),
       (15, 'Auguste', 'Josofovitz', 'ajosofovitze@buzzfeed.com', '141.43.195.109'),
       (16, 'Bonita', 'Barthrop', 'bbarthropf@mozilla.com', '48.97.129.25'),
       (17, 'Gerladina', 'Gelland', 'ggellandg@independent.co.uk', '43.200.117.205'),
       (18, 'Marika', 'Mainds', 'mmaindsh@youtu.be', '89.167.110.23'),
       (19, 'Ferdinande', 'O'' Sullivan', 'fosullivani@accuweather.com', '115.107.139.43'),
       (20, 'Magdalena', 'Wainer', 'mwainerj@mozilla.org', '252.45.38.35'),
       (21, 'Sigismundo', 'Whitfeld', 'swhitfeldk@feedburner.com', '40.120.154.143'),
       (22, 'Melisenda', 'Pyecroft', 'mpyecroftl@msn.com', '235.159.141.36'),
       (23, 'Kennie', 'Shrawley', 'kshrawleym@archive.org', '16.214.158.247'),
       (24, 'Sybila', 'McKeefry', 'smckeefryn@webnode.com', '166.119.96.72'),
       (25, 'Kaycee', 'Gerardet', 'kgerardeto@apple.com', '222.135.134.46'),
       (26, 'Genni', 'Warke', 'gwarkep@networkadvertising.org', '26.124.93.64'),
       (27, 'Jo-anne', 'Lenz', 'jlenzq@domainmarket.com', '126.197.248.216'),
       (28, 'Margit', 'Golby', 'mgolbyr@is.gd', '217.132.156.176'),
       (29, 'Mick', 'Waterstone', 'mwaterstones@wisc.edu', '235.48.154.156'),
       (30, 'Meridith', 'Alessandrini', 'malessandrinit@tripadvisor.com', '237.123.159.88'),
       (31, 'Cherice', 'Jacqueminet', 'cjacqueminetu@earthlink.net', '199.200.109.74'),
       (32, 'Fara', 'Bryer', 'fbryerv@businesswire.com', '99.168.95.255'),
       (33, 'Kirbie', 'Pestridge', 'kpestridgew@amazon.com', '24.92.93.197'),
       (34, 'Aaren', 'Algie', 'aalgiex@princeton.edu', '75.32.60.108'),
       (35, 'Wakefield', 'Kneal', 'wknealy@indiatimes.com', '19.119.213.177'),
       (36, 'Rubie', 'Yegorovnin', 'ryegorovninz@nhs.uk', '9.6.157.132'),
       (37, 'Olav', 'Luna', 'oluna10@google.es', '190.82.136.46'),
       (38, 'Ardella', 'Fairy', 'afairy11@fotki.com', '28.104.45.141'),
       (39, 'Joyann', 'Batsford', 'jbatsford12@google.it', '87.28.184.70'),
       (40, 'Reinhard', 'Baynham', 'rbaynham13@go.com', '9.68.210.88'),
       (41, 'Jermayne', 'Glowinski', 'jglowinski14@zimbio.com', '63.162.137.126'),
       (42, 'Lorie', 'Northrop', 'lnorthrop15@imageshack.us', '30.65.114.48'),
       (43, 'Marlyn', 'Igo', 'migo16@phoca.cz', '226.35.126.111'),
       (44, 'Con', 'Larkin', 'clarkin17@webmd.com', '219.156.222.168'),
       (45, 'Jerrie', 'Lemary', 'jlemary18@hibu.com', '133.176.240.12'),
       (46, 'Claudianus', 'O''Dooghaine', 'codooghaine19@nifty.com', '31.16.5.171'),
       (47, 'Sallee', 'Puddle', 'spuddle1a@chronoengine.com', '112.21.249.80'),
       (48, 'Daisi', 'Stair', 'dstair1b@cyberchimps.com', '211.25.137.233'),
       (49, 'Josephine', 'Drabble', 'jdrabble1c@nationalgeographic.com', '228.245.207.56'),
       (50, 'Klement', 'Attyeo', 'kattyeo1d@jiathis.com', '114.58.136.116');

