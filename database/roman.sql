#
# @author GDev
# This is a table to recording the requests for numeral transcoding.
#

CREATE TABLE roman_numerals_converted
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    `integer` INT NOT NULL,
    `numeral` VARCHAR(10)
) ;
