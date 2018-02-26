CREATE TABLE "events" (
"id" INTEGER PRIMARY KEY AUTOINCREMENT,
"name" TEXT,
"start" TEXT,
"stop" TEXT,
"organiser" TEXT,
"location" TEXT,
"description" TEXT
);

CREATE TABLE "projects" ( 
"id" INTEGER PRIMARY KEY AUTOINCREMENT,
"name" TEXT,
"description" TEXT,
"active" BOOLEAN
);

CREATE TABLE "projectmembers" (
"projectid" INTEGER,
"name" TEXT,
"uname" TEXT,
"mail" TEXT,
"role" TEXT,
"lead" BOOLEAN DEFAULT 0,
"owner" BOOLEAN DEFAULT 0
);

CREATE TABLE "users" (
"uname" TEXT,
"groups" INT DEFAULT 0
);

CREATE TABLE "motd" (
"title" TEXT,
"content" TEXT
);

INSERT INTO users (uname, groups)
VALUES ("min_test_bruker", 1);
