DROP SCHEMA IF EXISTS lbaw2285 CASCADE ;
CREATE SCHEMA lbaw2285;

set search_path = lbaw2285;

DROP TABLE IF EXISTS Member CASCADE;
DROP TYPE IF EXISTS TransactionType CASCADE;
DROP TABLE IF EXISTS Transaction CASCADE;
DROP TABLE IF EXISTS Paypal CASCADE;
DROP TABLE IF EXISTS Bid CASCADE;
DROP TABLE IF EXISTS BankTransfer CASCADE;
DROP TABLE IF EXISTS Auction CASCADE;
DROP TABLE IF EXISTS Image CASCADE;
DROP TABLE IF EXISTS Category CASCADE;
DROP TABLE IF EXISTS Model CASCADE;
DROP TABLE IF EXISTS Brand CASCADE;
DROP TABLE IF EXISTS Notification CASCADE;
DROP TABLE IF EXISTS Comment CASCADE;
DROP TABLE IF EXISTS ReportAuction CASCADE;
DROP TABLE IF EXISTS FollowAuction CASCADE;
DROP TABLE IF EXISTS MemberNotification CASCADE;


CREATE TYPE TransactionType AS ENUM ('Withdraw','Deposit');


CREATE TABLE Member (
	id serial NOT NULL,
	name text NOT NULL,
	email text NOT NULL,
	password text NOT NULL,
	rating float NOT NULL DEFAULT 0,
	credits integer NOT NULL DEFAULT 0,
	address text,
	account_creation timestamptz NOT NULL DEFAULT CURRENT_TIMESTAMP,
	is_admin boolean NOT NULL DEFAULT FALSE,
	CONSTRAINT Member_pk PRIMARY KEY (id),
	CONSTRAINT PositiveRating CHECK (rating  >= 0),
	CONSTRAINT PositiveCredits CHECK (credits >= 0)
);


CREATE TABLE Transaction (
	id serial NOT NULL,
	value integer NOT NULL,
	type TransactionType NOT NULL,
	id_Member integer,
	CONSTRAINT Transaction_pk PRIMARY KEY (id),
	CONSTRAINT PositiveValue CHECK (value >=0)
);


ALTER TABLE Transaction DROP CONSTRAINT IF EXISTS Member_fk CASCADE;
ALTER TABLE Transaction ADD CONSTRAINT Member_fk FOREIGN KEY (id_Member)
REFERENCES Member (id) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --


CREATE TABLE Paypal (
	approved boolean NOT NULL DEFAULT TRUE,
	email text NOT NULL,
-- 	id integer NOT NULL,
-- 	value integer NOT NULL,
-- 	type TransactionType NOT NULL,
-- 	id_Member integer,
	CONSTRAINT Paypal_pk PRIMARY KEY (id)
)
 INHERITS(Transaction);



CREATE TABLE BankTransfer (
	approved boolean DEFAULT FALSE,
-- 	id integer NOT NULL,
-- 	value integer NOT NULL,
-- 	type TransactionType NOT NULL,
-- 	id_Member integer,
	CONSTRAINT BankTransfer_pk PRIMARY KEY (id)
)
 INHERITS(Transaction);



CREATE TABLE Bid (
	id serial NOT NULL,
	date timestamptz NOT NULL DEFAULT CURRENT_TIMESTAMP,
	value integer NOT NULL,
	id_Member integer,
	id_Auction integer,
	CONSTRAINT Bid_pk PRIMARY KEY (id)
);



CREATE TABLE Auction (
	id serial NOT NULL,
	starting_bid integer NOT NULL,
	number_bids integer NOT NULL DEFAULT 0,
	start_date timestamptz,
	creation_date timestamptz NOT NULL DEFAULT CURRENT_TIMESTAMP,
	end_date timestamptz,
	approved boolean DEFAULT FALSE,
	description text NOT NULL,
	views integer NOT NULL DEFAULT 0,
	duration integer NOT NULL,
	year integer NOT NULL,
	mileage integer NOT NULL,
	displacement integer NOT NULL,
	rating integer,
	vin text NOT NULL,
	power integer NOT NULL,
	color text NOT NULL,
	active boolean NOT NULL DEFAULT FALSE,
	id_Member integer,
	id_Model integer,
	id_Category integer,
	CONSTRAINT Auction_pk PRIMARY KEY (id),
	CONSTRAINT PositiveStartingBid CHECK (starting_bid >=0),
	CONSTRAINT PositiveViews CHECK (views >=0),
	CONSTRAINT PositiveYear CHECK (year >=0),
	CONSTRAINT PositiveMileage CHECK (mileage >= 0),
	CONSTRAINT CheckDates CHECK (end_date > start_date),
	CONSTRAINT CheckVIN CHECK (char_length(vin) = 17),
	CONSTRAINT PositivePower CHECK (power  >= 0)
);


CREATE TABLE Image (
	id serial NOT NULL,
	path text NOT NULL,
	id_Auction integer,
	CONSTRAINT Image_pk PRIMARY KEY (id)
);


CREATE TABLE Category (
	id serial NOT NULL,
	name text NOT NULL,
	CONSTRAINT Category_pk PRIMARY KEY (id)
);



CREATE TABLE Model (
	id serial NOT NULL,
	name text NOT NULL,
	id_Brand integer,
	CONSTRAINT Model_pk PRIMARY KEY (id)
);



CREATE TABLE Brand (
	id serial NOT NULL,
	name text,
	CONSTRAINT Brand_pk PRIMARY KEY (id)
);



CREATE TABLE Notification (
	id serial NOT NULL,
	send_date timestamptz NOT NULL DEFAULT CURRENT_TIMESTAMP,
	id_Bid integer,
	id_Auction integer,
	id_Comment integer,
	seen boolean NOT NULL DEFAULT FALSE,
	CONSTRAINT Notification_pk PRIMARY KEY (id)
);



CREATE TABLE Comment (
	id serial NOT NULL,
	post_date timestamptz NOT NULL DEFAULT CURRENT_TIMESTAMP,
	content text NOT NULL,
	likes integer NOT NULL DEFAULT 0,
	id_Auction integer,
	id_Member integer,
	id_Member1 integer,
	id_Comment integer,
	CONSTRAINT Comment_pk PRIMARY KEY (id)
);

ALTER TABLE Bid DROP CONSTRAINT IF EXISTS Member_fk CASCADE;
ALTER TABLE Bid ADD CONSTRAINT Member_fk FOREIGN KEY (id_Member)
REFERENCES Member (id) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE Auction DROP CONSTRAINT IF EXISTS Member_fk CASCADE;
ALTER TABLE Auction ADD CONSTRAINT Member_fk FOREIGN KEY (id_Member)
REFERENCES Member (id) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;


ALTER TABLE Bid DROP CONSTRAINT IF EXISTS Auction_fk CASCADE;
ALTER TABLE Bid ADD CONSTRAINT Auction_fk FOREIGN KEY (id_Auction)
REFERENCES Auction (id) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE Auction DROP CONSTRAINT IF EXISTS Model_fk CASCADE;
ALTER TABLE Auction ADD CONSTRAINT Model_fk FOREIGN KEY (id_Model)
REFERENCES Model (id) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE Model DROP CONSTRAINT IF EXISTS Brand_fk CASCADE;
ALTER TABLE Model ADD CONSTRAINT Brand_fk FOREIGN KEY (id_Brand)
REFERENCES Brand (id) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE Auction DROP CONSTRAINT IF EXISTS Category_fk CASCADE;
ALTER TABLE Auction ADD CONSTRAINT Category_fk FOREIGN KEY (id_Category)
REFERENCES Category (id) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE Image DROP CONSTRAINT IF EXISTS Auction_fk CASCADE;
ALTER TABLE Image ADD CONSTRAINT Auction_fk FOREIGN KEY (id_Auction)
REFERENCES Auction (id) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE Comment DROP CONSTRAINT IF EXISTS Auction_fk CASCADE;
ALTER TABLE Comment ADD CONSTRAINT Auction_fk FOREIGN KEY (id_Auction)
REFERENCES Auction (id) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;



CREATE TABLE ReportAuction (
	id_Member integer NOT NULL,
	id_Auction integer NOT NULL,
	date timestamptz NOT NULL DEFAULT CURRENT_TIMESTAMP,
	description text NOT NULL,
	solved boolean NOT NULL DEFAULT FALSE,
	CONSTRAINT ReportAuction_pk PRIMARY KEY (id_Member,id_Auction)
);

ALTER TABLE ReportAuction DROP CONSTRAINT IF EXISTS Member_fk CASCADE;
ALTER TABLE ReportAuction ADD CONSTRAINT Member_fk FOREIGN KEY (id_Member)
REFERENCES Member (id) MATCH FULL
ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE ReportAuction DROP CONSTRAINT IF EXISTS Auction_fk CASCADE;
ALTER TABLE ReportAuction ADD CONSTRAINT Auction_fk FOREIGN KEY (id_Auction)
REFERENCES Auction (id) MATCH FULL
ON DELETE RESTRICT ON UPDATE CASCADE;


CREATE TABLE FollowAuction (
	id_Member integer NOT NULL,
	id_Auction integer NOT NULL,
	date timestamptz NOT NULL DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT FollowAuction_pk PRIMARY KEY (id_Member,id_Auction)
);

ALTER TABLE FollowAuction DROP CONSTRAINT IF EXISTS Member_fk CASCADE;
ALTER TABLE FollowAuction ADD CONSTRAINT Member_fk FOREIGN KEY (id_Member)
REFERENCES Member (id) MATCH FULL
ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE FollowAuction DROP CONSTRAINT IF EXISTS Auction_fk CASCADE;
ALTER TABLE FollowAuction ADD CONSTRAINT Auction_fk FOREIGN KEY (id_Auction)
REFERENCES Auction (id) MATCH FULL
ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE Notification DROP CONSTRAINT IF EXISTS Bid_fk CASCADE;
ALTER TABLE Notification ADD CONSTRAINT Bid_fk FOREIGN KEY (id_Bid)
REFERENCES Bid (id) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE Notification DROP CONSTRAINT IF EXISTS Auction_fk CASCADE;
ALTER TABLE Notification ADD CONSTRAINT Auction_fk FOREIGN KEY (id_Auction)
REFERENCES Auction (id) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE Notification DROP CONSTRAINT IF EXISTS Comment_fk CASCADE;
ALTER TABLE Notification ADD CONSTRAINT Comment_fk FOREIGN KEY (id_Comment)
REFERENCES Comment (id) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE Comment DROP CONSTRAINT IF EXISTS Member_fk CASCADE;
ALTER TABLE Comment ADD CONSTRAINT Member_fk FOREIGN KEY (id_Member)
REFERENCES Member (id) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE Comment DROP CONSTRAINT IF EXISTS Comment_uq CASCADE;
ALTER TABLE Comment ADD CONSTRAINT Comment_uq UNIQUE (id_Member);

ALTER TABLE Comment DROP CONSTRAINT IF EXISTS Member_fk1 CASCADE;
ALTER TABLE Comment ADD CONSTRAINT Member_fk1 FOREIGN KEY (id_Member1)
REFERENCES Member (id) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE Comment DROP CONSTRAINT IF EXISTS Comment_fk CASCADE;
ALTER TABLE Comment ADD CONSTRAINT Comment_fk FOREIGN KEY (id_Comment)
REFERENCES Comment (id) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;

CREATE TABLE MemberNotification (
	id_Notification integer NOT NULL,
	id_Member integer NOT NULL,
	CONSTRAINT MemberNotification_pk PRIMARY KEY (id_Notification,id_Member)
);

ALTER TABLE MemberNotification DROP CONSTRAINT IF EXISTS Notification_fk CASCADE;
ALTER TABLE MemberNotification ADD CONSTRAINT Notification_fk FOREIGN KEY (id_Notification)
REFERENCES Notification (id) MATCH FULL
ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE MemberNotification DROP CONSTRAINT IF EXISTS Member_fk CASCADE;
ALTER TABLE MemberNotification ADD CONSTRAINT Member_fk FOREIGN KEY (id_Member)
REFERENCES Member (id) MATCH FULL
ON DELETE RESTRICT ON UPDATE CASCADE;

----------- INDEXES --------------
CREATE INDEX auctionOwnerIdx ON Auction USING hash (id_Member);
CREATE INDEX auctionEndIdx ON Auction (end_date);
CREATE INDEX auctionViewsIdx ON Auction USING btree (views);

-- Add column to Auction to store content of model, description and brand.
-- ALTER TABLE Auction ADD COLUMN search TEXT;

-- UPDATE Auction SET search =
-- CONCAT(A.description, ' ', A.color, ' ', M.name, '', B.name)
-- FROM Auction A
-- INNER JOIN Model M ON M.id = A.id_Model
-- INNER JOIN Brand B ON M.id_Brand = B.id
-- where Auction.id = A.id;

-- Add column to Auction to store computed ts_vectors.
ALTER TABLE Auction
ADD COLUMN tsvectors TSVECTOR;
-- UPDATE Auction SET tsvectors = to_tsvector('english', search);

-- Create a function to automatically update ts_vectors.
CREATE FUNCTION auction_search_update() RETURNS TRIGGER AS $$
BEGIN
 IF TG_OP = 'INSERT' THEN
        NEW.tsvectors := to_tsvector('english', CONCAT(NEW.description, ' ', NEW.color, ' ', M.name, ' ', B.name))
        FROM Model M
        INNER JOIN Brand B ON M.id_Brand = B.id
        where NEW.id_model = M.id;
 END IF;
 IF TG_OP = 'UPDATE' THEN
         IF (NEW.description <> OLD.description OR NEW.color <> OLD.color) THEN
            NEW.tsvectors := to_tsvector('english', CONCAT(NEW.description, ' ', NEW.color, ' ', M.name, ' ', B.name))
            FROM Auction A
            INNER JOIN Model M ON M.id = A.id_Model
            INNER JOIN Brand B ON M.id_Brand = B.id
            where A.id = NEW.id;
         END IF;
 END IF;
 RETURN NEW;
END $$
LANGUAGE plpgsql;

-- Create a trigger before insert or update on work.
CREATE TRIGGER auction_search_update
 BEFORE INSERT OR UPDATE ON Auction
 FOR EACH ROW
 EXECUTE PROCEDURE auction_search_update();

-- Finally, create a GIN index for ts_vectors.
CREATE INDEX auctionIdxSearch ON Auction USING GIN (tsvectors);

-- CREATE EXTENSION pg_trgm;
-- CREATE INDEX memberIdxNameEmail ON Member using GIN ((name || ' ' || email) gin_trgm_ops);

