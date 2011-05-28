CREATE TABLE "contact_us" (
  "id" int(11) NOT NULL,
  "name" varchar(128) NOT NULL,
  "phone" varchar(16) NOT NULL,
  "email_address" varchar(128) NOT NULL,
  "message" varchar(4096) NOT NULL,
  "date_created" datetime NOT NULL,
  PRIMARY KEY ("id")
);

INSERT INTO "contact_us" VALUES (1,'Some One','','some.one.com','','0000-00-00 00:00:00');

CREATE TABLE "meet20110224" (
  "id" int(11) NOT NULL,
  "name" varchar(128) NOT NULL,
  "email" varchar(128) NOT NULL,
  "date_created" datetime NOT NULL,
  PRIMARY KEY ("id")
);

INSERT INTO "meet20110224" VALUES (1,'test','test@gtcode.com','2011-02-17 22:09:42');

CREATE TABLE "trucks" (
  "id" int(11) NOT NULL,
  "twitter_id" varchar(256) NOT NULL,
  "twitter_username" varchar(64) NOT NULL,
  "menu" varchar(32768) NOT NULL,
  "photo" varchar(128) NOT NULL,
  "created" datetime NOT NULL,
  "modified" datetime NOT NULL,
  PRIMARY KEY ("id"),
  UNIQUE KEY "twitter_id" ("twitter_id")
);

INSERT INTO "trucks" VALUES (1,'31953','ryankanno','<p><u><strong>HELLO!</strong></u></p>',' test','2011-05-21 12:00:00','2011-05-23 17:24:41');

CREATE TABLE "trucks_tweets" (
  "id" int(11) NOT NULL,
  "truck_id" int(11) NOT NULL,
  "tweet" varchar(160) NOT NULL,
  "geo_lat" float NOT NULL,
  "geo_long" float NOT NULL,
  "created" datetime NOT NULL,
  "modified" datetime NOT NULL,
  PRIMARY KEY ("id"),
  KEY "truck_id_created" ("truck_id","created"),
  KEY "truck_id" ("truck_id"),
  CONSTRAINT "trucks_tweets_ibfk_1" FOREIGN KEY ("truck_id") REFERENCES "trucks" ("id") ON UPDATE CASCADE
);
