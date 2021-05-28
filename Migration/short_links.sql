SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for short_links
-- ----------------------------
DROP TABLE IF EXISTS `short_links`;
CREATE TABLE `short_links` (
  `token` char(6) NOT NULL,
  `original_link` varchar(255) NOT NULL,
  `date_create` date NOT NULL,
  PRIMARY KEY (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SET FOREIGN_KEY_CHECKS=1;
