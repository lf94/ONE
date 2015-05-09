DROP TABLE IF EXISTS "Comment";
CREATE TABLE "Comment" (
  "idComment" integer,
  "idUser" integer NOT NULL,
  "Message" mediumtext NOT NULL,
  "idPost" integer NOT NULL,
  PRIMARY KEY ("idComment")
  CONSTRAINT "fk_Comment_User" FOREIGN KEY ("idUser") REFERENCES "User" ("idUser"),
  CONSTRAINT "fk_Comment_Post" FOREIGN KEY ("idPost") REFERENCES "Post" ("idPost")
);

DROP TABLE IF EXISTS "Post";
CREATE TABLE "Post" (
  "idPost" integer,
  "idUser" integer NOT NULL,
  "Title" varchar(255) NOT NULL,
  "Message" mediumtext NOT NULL,
  PRIMARY KEY ("idPost")
  CONSTRAINT "fk_Post_User" FOREIGN KEY ("idUser") REFERENCES "User" ("idUser")
);

DROP TABLE IF EXISTS "User";
CREATE TABLE "User" (
  "idUser" integer,
  "Name" varchar(255) NOT NULL,
  "ProfilePictureURL" varchar(255) DEFAULT NULL,
  PRIMARY KEY ("idUser")
);

INSERT INTO "User" VALUES(1, "Bob", "");
INSERT INTO "Post" VALUES(1, 1, "Hello", "Hello I am Bob");
INSERT INTO "Comment" VALUES(NULL, 1, "Hey Bob I'm me.", 1);
