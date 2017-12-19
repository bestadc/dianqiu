/*
Navicat MySQL Data Transfer

Source Server         : wuzhibin.cn
Source Server Version : 50173
Source Host           : sdm359768304.my3w.com:3306
Source Database       : sdm359768304_db

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2017-12-19 10:10:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pub_order_setmeal
-- ----------------------------
DROP TABLE IF EXISTS `pub_order_setmeal`;
CREATE TABLE `pub_order_setmeal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `order_id` varchar(32) NOT NULL,
  `setmeal_id` int(11) unsigned NOT NULL,
  `type_id` int(11) NOT NULL COMMENT '产品类型ID',
  `remodel` tinyint(1) NOT NULL DEFAULT '0' COMMENT '充值模式(0：流量1：时长)',
  `money` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '套餐金额',
  `flow` int(11) NOT NULL COMMENT '套餐流量/时长',
  `describe` varchar(255) NOT NULL COMMENT '套餐描述',
  `goods_num` int(11) unsigned NOT NULL COMMENT '商品的购买总数量',
  `goods_price` decimal(15,2) unsigned NOT NULL COMMENT '商品的购买总金额',
  `created_at` int(11) unsigned DEFAULT NULL COMMENT '订单创建时间',
  `updated_at` int(11) unsigned DEFAULT NULL COMMENT '订单修改时间',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`(11))
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pub_order_setmeal
-- ----------------------------
INSERT INTO `pub_order_setmeal` VALUES ('8', '20171216151340720112016317641317', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513407201', null);
INSERT INTO `pub_order_setmeal` VALUES ('9', '20171216151341046412366446781281', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513410464', null);
INSERT INTO `pub_order_setmeal` VALUES ('10', '20171216151341064513982794231133', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513410645', null);
INSERT INTO `pub_order_setmeal` VALUES ('11', '20171216151341170712520724721219', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513411707', null);
INSERT INTO `pub_order_setmeal` VALUES ('12', '20171216151341179113020728201338', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513411791', null);
INSERT INTO `pub_order_setmeal` VALUES ('13', '20171216151341184013769198721379', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513411840', null);
INSERT INTO `pub_order_setmeal` VALUES ('14', '20171216151341208713497202951355', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513412087', null);
INSERT INTO `pub_order_setmeal` VALUES ('15', '20171216151341349013343258261376', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513413490', null);
INSERT INTO `pub_order_setmeal` VALUES ('16', '20171216151341349413444911741129', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513413494', null);
INSERT INTO `pub_order_setmeal` VALUES ('17', '20171216151341354713307633751402', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513413547', null);
INSERT INTO `pub_order_setmeal` VALUES ('18', '20171216151341360614013567551118', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513413606', null);
INSERT INTO `pub_order_setmeal` VALUES ('19', '20171216151341370513916951361155', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513413705', null);
INSERT INTO `pub_order_setmeal` VALUES ('20', '20171216151341373113390899871123', '2', '0', '0', '0.00', '0', '', '1', '20000.00', '1513413731', null);
INSERT INTO `pub_order_setmeal` VALUES ('21', '20171216151341393512947499581375', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513413935', null);
INSERT INTO `pub_order_setmeal` VALUES ('22', '20171216151341399813622077381136', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513413998', null);
INSERT INTO `pub_order_setmeal` VALUES ('23', '20171216151341403111910415891388', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513414031', null);
INSERT INTO `pub_order_setmeal` VALUES ('24', '20171216151341410212040997751210', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513414102', null);
INSERT INTO `pub_order_setmeal` VALUES ('25', '20171216151341416212459119071353', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513414162', null);
INSERT INTO `pub_order_setmeal` VALUES ('26', '20171216151341416513004652871293', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513414165', null);
INSERT INTO `pub_order_setmeal` VALUES ('27', '20171216151341416513812735411243', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513414165', null);
INSERT INTO `pub_order_setmeal` VALUES ('28', '20171216151341416512957975981302', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513414165', null);
INSERT INTO `pub_order_setmeal` VALUES ('29', '20171216151341416611489874181368', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513414166', null);
INSERT INTO `pub_order_setmeal` VALUES ('30', '20171216151341418813453628361308', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513414188', null);
INSERT INTO `pub_order_setmeal` VALUES ('31', '20171216151341444011250858311114', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513414440', null);
INSERT INTO `pub_order_setmeal` VALUES ('32', '20171216151341445114007973171216', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513414451', null);
INSERT INTO `pub_order_setmeal` VALUES ('33', '20171216151341473712824060431288', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513414737', null);
INSERT INTO `pub_order_setmeal` VALUES ('34', '20171216151341474112724181131324', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513414741', null);
INSERT INTO `pub_order_setmeal` VALUES ('35', '20171216151341474312976822381362', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513414743', null);
INSERT INTO `pub_order_setmeal` VALUES ('36', '20171216151341474413601151611117', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513414744', null);
INSERT INTO `pub_order_setmeal` VALUES ('37', '20171216151341474612086273211256', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513414746', null);
INSERT INTO `pub_order_setmeal` VALUES ('38', '20171216151341474813210651971221', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513414748', null);
INSERT INTO `pub_order_setmeal` VALUES ('39', '20171216151341476012512276541126', '2', '0', '0', '0.00', '0', '', '1', '20000.00', '1513414760', null);
INSERT INTO `pub_order_setmeal` VALUES ('40', '20171216151341481911827554331395', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513414819', null);
INSERT INTO `pub_order_setmeal` VALUES ('41', '20171216151341485912297463991156', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513414859', null);
INSERT INTO `pub_order_setmeal` VALUES ('42', '20171216151341504214057892401395', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513415042', null);
INSERT INTO `pub_order_setmeal` VALUES ('43', '20171216151341506613345129331390', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513415066', null);
INSERT INTO `pub_order_setmeal` VALUES ('44', '20171216151341531912900528821244', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513415319', null);
INSERT INTO `pub_order_setmeal` VALUES ('45', '20171216151341541412480112781186', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513415414', null);
INSERT INTO `pub_order_setmeal` VALUES ('46', '20171216151341576911297395611285', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513415769', null);
INSERT INTO `pub_order_setmeal` VALUES ('47', '20171217151348002191902529699139', '3', '0', '0', '0.00', '0', '', '1', '30000.00', '1513480021', null);
INSERT INTO `pub_order_setmeal` VALUES ('48', '20171217151348029968228046189658', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513480299', null);
INSERT INTO `pub_order_setmeal` VALUES ('49', '20171217151348053751476270245351', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513480537', null);
INSERT INTO `pub_order_setmeal` VALUES ('50', '20171217151348057535505036633852', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513480575', null);
INSERT INTO `pub_order_setmeal` VALUES ('51', '20171217151348130961903032165246', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513481309', null);
INSERT INTO `pub_order_setmeal` VALUES ('52', '20171217151348134315972994107557', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513481343', null);
INSERT INTO `pub_order_setmeal` VALUES ('53', '20171217151348156764925358157174', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513481567', null);
INSERT INTO `pub_order_setmeal` VALUES ('54', '20171217151348163413328348558783', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513481634', null);
INSERT INTO `pub_order_setmeal` VALUES ('55', '20171217151348165199124436863397', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513481651', null);
INSERT INTO `pub_order_setmeal` VALUES ('56', '20171217151348447733985628514333', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513484477', null);
INSERT INTO `pub_order_setmeal` VALUES ('57', '20171217151348450725471473898109', '2', '0', '0', '0.00', '0', '', '1', '20000.00', '1513484507', null);
INSERT INTO `pub_order_setmeal` VALUES ('58', '20171218151358209168492480497564', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513582091', null);
INSERT INTO `pub_order_setmeal` VALUES ('59', '20171218151358256877202603596365', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513582568', null);
INSERT INTO `pub_order_setmeal` VALUES ('60', '20171218151358259165368440252871', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513582591', null);
INSERT INTO `pub_order_setmeal` VALUES ('61', '20171218151358266575850088525632', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513582665', null);
INSERT INTO `pub_order_setmeal` VALUES ('62', '20171218151358275412997826518244', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513582754', null);
INSERT INTO `pub_order_setmeal` VALUES ('63', '20171218151358279651403610694390', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513582796', null);
INSERT INTO `pub_order_setmeal` VALUES ('64', '20171218151358282553870427355446', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513582825', null);
INSERT INTO `pub_order_setmeal` VALUES ('65', '20171218151358286838076034395227', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513582868', null);
INSERT INTO `pub_order_setmeal` VALUES ('66', '20171218151358291858365181665481', '3', '0', '0', '0.00', '0', '', '1', '30000.00', '1513582918', null);
INSERT INTO `pub_order_setmeal` VALUES ('67', '20171218151358328986195159247511', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513583289', null);
INSERT INTO `pub_order_setmeal` VALUES ('68', '20171218151358388752734952837635', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513583887', null);
INSERT INTO `pub_order_setmeal` VALUES ('69', '20171218151358390459990469987807', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513583904', null);
INSERT INTO `pub_order_setmeal` VALUES ('70', '20171218151358664066544059959087', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513586640', null);
INSERT INTO `pub_order_setmeal` VALUES ('71', '20171218151358676432645322588034', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513586764', null);
INSERT INTO `pub_order_setmeal` VALUES ('72', '20171218151358678139602600458994', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513586781', null);
INSERT INTO `pub_order_setmeal` VALUES ('73', '20171218151358683085660356737233', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513586830', null);
INSERT INTO `pub_order_setmeal` VALUES ('74', '20171218151358700141696531655975', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513587001', null);
INSERT INTO `pub_order_setmeal` VALUES ('75', '20171218151358702175259031973207', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513587021', null);
INSERT INTO `pub_order_setmeal` VALUES ('76', '20171218151358765862313546948266', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513587658', null);
INSERT INTO `pub_order_setmeal` VALUES ('77', '20171218151358766176755677035215', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513587661', null);
INSERT INTO `pub_order_setmeal` VALUES ('78', '20171218151358766353372994804295', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513587663', null);
INSERT INTO `pub_order_setmeal` VALUES ('79', '20171218151358769942446049092055', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513587699', null);
INSERT INTO `pub_order_setmeal` VALUES ('80', '20171218151358774641435478838027', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513587746', null);
INSERT INTO `pub_order_setmeal` VALUES ('81', '20171218151358786727178759043722', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513587867', null);
INSERT INTO `pub_order_setmeal` VALUES ('82', '20171218151358787095006673531445', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513587870', null);
INSERT INTO `pub_order_setmeal` VALUES ('83', '20171218151358787392764639484652', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513587873', null);
INSERT INTO `pub_order_setmeal` VALUES ('84', '20171218151358790211435871523281', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513587902', null);
INSERT INTO `pub_order_setmeal` VALUES ('85', '20171218151358798964511049829645', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513587989', null);
INSERT INTO `pub_order_setmeal` VALUES ('86', '20171218151358802624639474147414', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513588026', null);
INSERT INTO `pub_order_setmeal` VALUES ('87', '20171218151358804231649901758719', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513588042', null);
INSERT INTO `pub_order_setmeal` VALUES ('88', '20171218151358820218063290871126', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513588202', null);
INSERT INTO `pub_order_setmeal` VALUES ('89', '20171218151358821374980543342145', '2', '0', '0', '0.00', '0', '', '1', '20000.00', '1513588213', null);
INSERT INTO `pub_order_setmeal` VALUES ('90', '20171218151358822291330193475702', '3', '0', '0', '0.00', '0', '', '1', '30000.00', '1513588222', null);
INSERT INTO `pub_order_setmeal` VALUES ('91', '20171218151358833931461385343841', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513588339', null);
INSERT INTO `pub_order_setmeal` VALUES ('92', '20171218151358859293763556287171', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513588592', null);
INSERT INTO `pub_order_setmeal` VALUES ('93', '20171218151358859765399181719572', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513588597', null);
INSERT INTO `pub_order_setmeal` VALUES ('94', '20171218151358859965266442673109', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513588599', null);
INSERT INTO `pub_order_setmeal` VALUES ('95', '20171218151358860065335291296536', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513588600', null);
INSERT INTO `pub_order_setmeal` VALUES ('96', '20171218151358860165980276464981', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513588601', null);
INSERT INTO `pub_order_setmeal` VALUES ('97', '20171218151358860464773194692491', '2', '0', '0', '0.00', '0', '', '1', '20000.00', '1513588604', null);
INSERT INTO `pub_order_setmeal` VALUES ('98', '20171218151358861765782087876141', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513588617', null);
INSERT INTO `pub_order_setmeal` VALUES ('99', '20171218151358867569479283777778', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513588675', null);
INSERT INTO `pub_order_setmeal` VALUES ('100', '20171218151358867977093592909857', '2', '0', '0', '0.00', '0', '', '1', '20000.00', '1513588679', null);
INSERT INTO `pub_order_setmeal` VALUES ('101', '20171218151358924095550229279604', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513589240', null);
INSERT INTO `pub_order_setmeal` VALUES ('102', '20171218151358924778930376677173', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513589247', null);
INSERT INTO `pub_order_setmeal` VALUES ('103', '20171218151358925531111835195285', '2', '0', '0', '0.00', '0', '', '1', '20000.00', '1513589255', null);
INSERT INTO `pub_order_setmeal` VALUES ('104', '20171218151358926231043398252242', '3', '0', '0', '0.00', '0', '', '1', '30000.00', '1513589262', null);
INSERT INTO `pub_order_setmeal` VALUES ('105', '20171218151358938161857982108008', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513589381', null);
INSERT INTO `pub_order_setmeal` VALUES ('106', '20171218151358941143269919727211', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513589411', null);
INSERT INTO `pub_order_setmeal` VALUES ('107', '20171218151358964259864975559297', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513589642', null);
INSERT INTO `pub_order_setmeal` VALUES ('108', '20171218151358965781964684731882', '2', '0', '0', '0.00', '0', '', '1', '20000.00', '1513589657', null);
INSERT INTO `pub_order_setmeal` VALUES ('109', '20171218151358966786393422346423', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513589667', null);
INSERT INTO `pub_order_setmeal` VALUES ('110', '20171218151359770050635625258859', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513597700', null);
INSERT INTO `pub_order_setmeal` VALUES ('111', '20171218151359774120641676414039', '2', '0', '0', '0.00', '0', '', '1', '20000.00', '1513597741', null);
INSERT INTO `pub_order_setmeal` VALUES ('112', '20171219151364155433648852345407', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513641554', null);
INSERT INTO `pub_order_setmeal` VALUES ('113', '20171219151364500565245355253237', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513645005', null);
INSERT INTO `pub_order_setmeal` VALUES ('114', '20171219151364650751965394571482', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513646507', null);
INSERT INTO `pub_order_setmeal` VALUES ('115', '20171219151364696440204896363882', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513646964', null);
INSERT INTO `pub_order_setmeal` VALUES ('116', '20171219151364750211773018575374', '1', '0', '0', '0.00', '0', '', '1', '10000.00', '1513647502', null);
