CREATE TABLE IF NOT EXISTS `applier` (
                                       `applier_id` int(11) NOT NULL AUTO_INCREMENT,
                                       `name` varchar(50) NOT NULL,
                                       `surname` varchar(255) NOT NULL,
                                       `age` int(10) NOT NULL,
                                       `teacher_name` varchar(50) NOT NULL,
                                       `comment` varchar(50) NOT NULL,
                                       PRIMARY KEY (`applier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;