USE capston4_wins

SELECT * FROM member

SELECT * FROM profile

SELECT DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW()) - TO_DAYS(birthdate)), '%Y') as age FROM profile

SELECT as age FROM profile


DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(birthdate, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(birthdate, '00-%m-%d')) 

DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(birthdate)), '%Y')+0 AS age FROM people;

SELECT DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(birthdate, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(birthdate, '00-%m-%d')) AS age FROM profile
