DROP DATABASE FINICNIC;
CREATE DATABASE IF NOT EXISTS FINICNIC;
USE FINICNIC;

CREATE TABLE IF NOT EXISTS user_info(
    user_name VARCHAR(20) NOT NULL,
    /* 조회 토큰 */
    inquiry_token varchar(100),
    /* 출금 토큰 */
    withdraw_token varchar(100),
    /* 입금 토큰 */
    deposit_token varchar(100),
    PRIMARY KEY (user_name)
);

CREATE TABLE IF NOT EXISTS user_account(
    user_name VARCHAR(20) NOT NULL,
    account_fin_number varchar(50) NOT NULL,
    bank_code VARCHAR(20),
    account_number varchar(50)
);

CREATE TABLE IF NOT EXISTS bank_info(
    bank_code VARCHAR(20),
    bank_name VARCHAR(20),
    PRIMARY KEY (bank_code)
);

CREATE TABLE IF NOT EXISTS room_info(
    roomName VARCHAR(20) NOT NULL,
    roomPrice INTEGER NOT NULL,
    roomPeople INTEGER NOT NULL,
    roomType VARCHAR(20) NOT NULL,
    roomRatio VARCHAR(100),
    PRIMARY KEY (roomName)
);

INSERT INTO bank_info VALUES
(002,"산업은행"),(003,"기업은행"),(004,"KB국민은행"),
(007,"수협은행"),(011,"NH농협은행"),(020,"우리은행"),
(023,"SC제일은행"),(027,"씨티은행"),(088,"신한은행");
