<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User: rootu
 * Date: 2018-08-24
 */
class ReportModel
{
    public function getClientCodeSecret($dealerName)
    {
        $activityIdConf = array(
            '南通东方鼎辰汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_NTA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'NTA',
            ),
            '南通新捷汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_NTB',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'NTB',
            ),
            '淮安宝铁龙汽车销售有限公司'       => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HAA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'HAA',
            ),
            '连云港润捷汽车销售有限公司'       => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_LNA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'LNA',
            ),
            '江苏世贸泰信汽车贸易有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_NJA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'NJA',
            ),
            '南京中捷汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_NJB',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'NJB',
            ),
            '南京永达路捷汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_NJC',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'NJC',
            ),
            '江苏世贸泰信捷路汽车销售服务有限公司'  => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_NJD',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'NJD',
            ),
            '宿迁润凯汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SQA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'SQA',
            ),
            '泰州宝汇汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_THA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'THA',
            ),
            '徐州捷润汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_XZA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'XZA',
            ),
            '盐城东昌宝达汽车服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_YGA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'YGA',
            ),
            '扬州天华汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_YZA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'YZA',
            ),
            '昆山永达路捷汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_JSA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'JSA',
            ),
            '常熟永达路捷汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_JSB',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'JSB',
            ),
            '苏州中捷汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SUB',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'SUB',
            ),
            '张家港中捷汽车销售服务有限公司'     => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SUC',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'SUC',
            ),
            '宜兴路德行汽车有限公司'         => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_WXC',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'WXC',
            ),
            '镇江中捷汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_ZJA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'ZJA',
            ),
            '蚌埠瑞英行汽车销售服务有限公司'     => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_BBA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'BBA',
            ),
            '阜阳中源骏杰汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_FYA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'FYA',
            ),
            '安徽骏虎汽车销售有限公司'        => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HFA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'HFA',
            ),
            '安徽永达和捷汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HFB',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'HFB',
            ),
            '杭州路德行汽车有限公司'         => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HZC',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'HZC',
            ),
            '杭州运通和乔汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HZD',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'HZD',
            ),
            '浙江路德行汽车有限公司'         => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HZE',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'HZE',
            ),
            '湖州永达路宝汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HZF',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'HZF',
            ),
            '芜湖恒信路伟汽车销售有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_WUA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'WUA',
            ),
            '衢州恒龙汽车有限公司'          => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_QHA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'QHA',
            ),
            '温州东昌实业有限公司'          => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_WZA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'WZA',
            ),
            '温州欧龙汽车销售有限公司'        => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_WZB',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'WZB',
            ),
            '温州永达路捷汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_WZD',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'WZD',
            ),
            '瑞安市永达路捷汽车销售服务有限公司'   => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_WZE',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'WZE',
            ),
            '温州新力虎汽车销售服务有限公司'     => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_WZF',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'WZF',
            ),
            '苍南中瑞汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_WZG',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'WZG',
            ),
            '丽水东昌汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_LHA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'LHA',
            ),
            '宁波丰颐汽车销售有限公司'        => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_NBA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'NBA',
            ),
            '宁波天华汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_NBB',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'NBB',
            ),
            '宁波颐泽汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_NBE',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'NBE',
            ),
            '宁波永达路捷汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_NBF',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'NBF',
            ),
            '慈溪路德行汽车有限公司'         => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_NBC',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'NBC',
            ),
            '绍兴力虎汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SXA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'SXA',
            ),
            '绍兴路德行汽车有限公司'         => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SXB',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'SXB',
            ),
            '诸暨宝利德汽车有限公司'         => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SXC',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'SXC',
            ),
            '台州中通汽车销售有限公司'        => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_TZA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'TZA',
            ),
            '台州国鸿汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_TZB',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'TZB',
            ),
            '保定威神汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HBC',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'HBC',
            ),
            '保定路捷汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HBJ',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'HBJ',
            ),
            '秦皇岛世之捷汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HBD',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'HBD',
            ),
            '沧州威神汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HBE',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'HBE',
            ),
            '邯郸威虎汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HBF',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'HBF',
            ),
            '廊坊市路泽汽车销售服务有限公司'     => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HBK',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'HBK',
            ),
            '邢台傲龙汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HBO',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'HBO',
            ),
            '吉林市康顺捷路汽车销售服务有限公司'   => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_JLA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'JLA',
            ),
            '鄂尔多斯市惠通陆华汽车销售服务有限公司' => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_MGC',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'MGC',
            ),
            '包头市路泽汽车销售服务有限公司'     => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_MGD',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'MGD',
            ),
            '内蒙古惠通陆华汽车销售有限公司'     => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_MGA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'MGA',
            ),
            '内蒙古顺驰路捷汽车销售服务有限公司'   => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_MGF',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'MGF',
            ),
            '鞍山尊荣捷路汽车贸易有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_ASA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'ASA',
            ),
            '黑龙江尊荣捷路汽车贸易有限公司'     => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HRA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'HRA',
            ),
            '尊荣亿方集团黑龙江汽车贸易有限公司'   => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HRB',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'HRB',
            ),
            '哈尔滨路捷汽车销售服务有限公司'     => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HRD',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'HRD',
            ),
            '大庆尊荣捷路汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HRC',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'HRC',
            ),
            '锦州尊荣捷路汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_JZA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'JZA',
            ),
            '辽宁尊荣亿方汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SYA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'SYA',
            ),
            '沈阳尊荣路捷汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SYB',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'SYB',
            ),
            '沈阳中升仕豪汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SYC',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'SYC',
            ),
            '营口中升仕豪汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_YKA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'YKA',
            ),
            '长治市顺驰路捷汽车销售服务有限公司'   => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_CHA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'CHA',
            ),
            '大同市御东路华汽车贸易有限公司'     => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_DTA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'DTA',
            ),
            '河南通孚祥汽车销售服务有限公司'     => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HNA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'HNA',
            ),
            '郑州永达和谐汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HNB',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'HNB',
            ),
            '河南新通孚祥汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HND',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'HND',
            ),
            '郑州恒信路伟汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HNL',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'HNL',
            ),
            '平顶山通孚祥汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HNE',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'HNE',
            ),
            '新乡通孚祥汽车销售服务有限公司'     => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HNF',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'HNF',
            ),
            '洛阳新通孚祥汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HNM',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'HNM',
            ),
            '运城大昌汽车贸易有限公司'        => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_YUA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'YUA',
            ),
            '临汾尧都路华汽车销售有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_LFB',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'LFB',
            ),
            '济南中升仕豪汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_JNE',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'JNE',
            ),
            '山东百事佳路豹汽车销售服务有限公司'   => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SDC',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'SDC',
            ),
            '临沂力虎汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_LYA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'LYA',
            ),
            '东营天华汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SDD',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'SDD',
            ),
            '济宁恒吉汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SDE',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'SDE',
            ),
            '泰安力虎汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SDF',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'SDF',
            ),
            '德州吉星汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SDG',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'SDG',
            ),
            '枣庄力虎汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SDH',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'SDH',
            ),
            '菏泽路达汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SDI',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'SDI',
            ),
            '潍坊中升仕豪汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_WFA',
                'client_code'   => 'jdxn4YjSQrbqVc3jg1',
                'client_secret' => '28173B3B1F7BE154203188E2B35F319C',
                'dealer_code'   => 'SDI',
            ),
            '淄博宝信汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_ZBA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
            ),
            '青岛中升杰豪汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_QDA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'QDA',
            ),
            '青岛中升仕豪汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_QDB',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'QDB',
            ),
            '青岛唯圆达汽车销售服务有限公司'     => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_QDH',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'QDH',
            ),
            '威海路泽汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SDB',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'SDB',
            ),
            '天津惠通陆华汽车销售有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_TJB',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'TJB',
            ),
            '天津燕鹏捷汽车销售服务有限公司'     => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_TJC',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'TJC',
            ),
            '天津申隆汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_TJD',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'TJD',
            ),
            '天津中进捷旺汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_TJE',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'TJE',
            ),
            '烟台润捷汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_YTA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'YTA',
            ),
            '烟台中升仕豪汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_YTB',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'YTB',
            ),
            '惠州惠通陆华汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_GDA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'GDA',
            ),
            '佛山市庆丰豹虎汽车销售服务有限公司'   => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_GDB',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'GDB',
            ),
            '佛山市庆丰路畅汽车销售服务有限公司'   => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_GDE',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'GDE',
            ),
            '佛山市顺德区广顺汽车有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SDA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'SDA',
            ),
            '清远庆丰奥达汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_GDJ',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'GDJ',
            ),
            '东莞寮步中汽南方汽车销售服务有限公司'  => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_DGA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'DGA',
            ),
            '东莞鸿粤锐虎汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_DGB',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'DGB',
            ),
            '东莞鸿粤驿虎汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_DGC',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'DGC',
            ),
            '东莞惠通陆华汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_DGD',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'DGD',
            ),
            '湛江港昌汽车服务有限公司'        => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_GDK',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'GDK',
            ),
            '海南中汽南方汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HKA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'HKA',
            ),
            '深圳市中汽南方机电设备有限公司'     => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SZA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'SZA',
            ),
            '天津汽车工业销售深圳南方有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SZB',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'SZB',
            ),
            '深圳市路豹汽车销售有限公司'       => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SZC',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'SZC',
            ),
            '深圳申隆汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SZD',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'SZD',
            ),
            '深圳路捷汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SZE',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'SZE',
            ),
            '汕头市路杰汽车销售服务有限公司'     => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_GDC',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'GDC',
            ),
            '肇庆恒信路伟汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_GDH',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'GDH',
            ),
            '揭阳路泽汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_GDI',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'GDI',
            ),
            '赣州恒信路伟汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_GHA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'GHA',
            ),
            '景德镇路德行汽车有限公司'        => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_JDA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'JDA',
            ),
            '江门市南菱元吉汽车有限公司'       => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_JMA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'JMA',
            ),
            '九江捷路汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_JUA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'JUA',
            ),
            '上饶市路泽汽车销售服务有限公司'     => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SRB',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'SRB',
            ),
            '珠海中汽南方捷路汽车销售服务有限公司'  => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_ZHA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'ZHA',
            ),
            '柳州中升仕豪汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_GXA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'GXA',
            ),
            '桂林长久世达汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_GXB',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'GXB',
            ),
            '十堰恒信路伟汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SNA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'SNA',
            ),
            '武汉捷路汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_WHB',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'WHB',
            ),
            '武汉康顺捷路汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_WHC',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'WHC',
            ),
            '武汉佳路捷汽车销售服务有限公司'     => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_WHD',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'WHD',
            ),
            '武汉路泽汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_WHE',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'WHE',
            ),
            '襄阳捷路汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_XYA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'XYA',
            ),
            '宜昌路顺汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_YHA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'YHA',
            ),
            '常德天元汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_CGA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'CGA',
            ),
            '郴州市鹏峰汽车有限公司'         => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_CUA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'CUA',
            ),
            '怀化恒信路伟汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HHA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'HHA',
            ),
            '衡阳路泽汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_HYA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'HYA',
            ),
            '娄底路德行汽车有限公司'         => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_LDA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'LDA',
            ),
            '湘潭湘路捷汽车销售服务有限公司'     => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_XTA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'XTA',
            ),
            '岳阳恒信路伟汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_YYA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'YYA',
            ),
            '株洲市兰天天程汽车销售有限公司'     => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_ZZA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'ZZA',
            ),
            '龙岩富海鸿汽车贸易有限公司'       => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_FJA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'FJA',
            ),
            '漳州永达路捷汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_FJB',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'FJB',
            ),
            '莆田市路德汽车销售服务有限公司'     => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_FZD',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'FZD',
            ),
            '晋江富海鸿汽车贸易有限公司'       => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_QZA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'QZA',
            ),
            '泉州捷众汽车有限公司'          => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_QZB',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'QZB',
            ),
            '三明新成功路捷汽车有限公司'       => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SMA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'SMA',
            ),
            '厦门新成功路捷汽车有限公司'       => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_XMA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'XMA',
            ),
            '厦门新成功英翔汽车有限公司'       => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_XMB',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'XMB',
            ),
            '厦门捷路汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_XMC',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'XMC',
            ),
            '乐山南菱汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_LSA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'LSA',
            ),
            '绵阳路威汽车销售有限公司'        => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_MYA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'MYA',
            ),
            '攀枝花跃鹿汽车销售服务有限公司'     => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SCA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'SCA',
            ),
            '德阳南菱港宏汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SCC',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'SCC',
            ),
            '眉山捷路汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SCD',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'SCD',
            ),
            '宝鸡威凯汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_BAA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'BAA',
            ),
            '榆林庞大宏伟汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_XAC',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'XAC',
            ),
            '陕西天华汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_XAD',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'XAD',
            ),
            '西安运通瑞捷汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_XAF',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'XAF',
            ),
            '西安中升仕豪汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_XAI',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'XAI',
            ),
            '陕西惠通陆华汽车销售有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_XAK',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'XAK',
            ),
            '西安惠通陆华汽车销售有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_XAM',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'XAM',
            ),
            '重庆惠通陆华汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_CQB',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'CQB',
            ),
            '重庆惠通嘉华汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_CQC',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'CQC',
            ),
            '重庆商社起航汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_CQF',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'CQF',
            ),
            '重庆运通汇捷汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_CQG',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'CQG',
            ),
            '泸州惠通陆华汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SCB',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'SCB',
            ),
            '南充永达路捷汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SCE',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'SCE',
            ),
            '达州市奥捷汽车销售服务有限公司'     => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_SCF',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'SCF',
            ),
            '遵义通源捷胜汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_ZYA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'ZYA',
            ),
            '曲靖市中致远路威汽车销售服务有限公司'  => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_QJA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'QJA',
            ),
            '大理路捷汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_YND',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'YND',
            ),
            '新疆惠通陆华汽车销售有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_XJA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'XJA',
            ),
            '乌鲁木齐汇嘉路捷汽车销售服务有限公司'  => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_XJB',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'XJB',
            ),
            '青海捷路汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Dealer_Onsite_XNA',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'XNA',
            ),
            '宁夏路捷汽车贸易有限公司'        => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Yinchuan',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'YCA',
            ),
            '银川顺驰路捷汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Yinchuan',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'YCD',
            ),
            //新增
            '北京惠通陆华汽车服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Beijing',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'BJA',
            ),
            '北京兰德陆华汽车销售有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Beijing',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'BJB',
            ),
            '北京德万隆经贸有限公司'         => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Beijing',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'BJD',
            ),
            '北京燕英捷燕顺捷汽车销售服务有限公司'  => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Beijing',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'BJI',
            ),
            '北京运通兴捷汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Beijing',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'BJK',
            ),
            '北京长久世达汽车销售有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Beijing',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'BJL',
            ),
            '北京运通嘉捷汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Beijing',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'BJM',
            ),
            '北京中进捷旺汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Beijing',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'BJN',
            ),
            '北京长久世捷汽车销售有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Beijing',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'BJO',
            ),
            '上海永达路捷汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Shanghai',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'SHG',
            ),
            '上海信杰汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Shanghai',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'SHI',
            ),
            '上海捷润汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Shanghai',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'SHJ',
            ),
            '上海天华汽车销售有限公司'        => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Shanghai',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'SHK',
            ),
            '上海永达路胜汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Shanghai',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'SHL',
            ),
            '上海真北天华汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Shanghai',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'SHM',
            ),
            '上海松江恒骏汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Shanghai',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'SHQ',
            ),
            '广东中汽南方汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Guangzhou',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'GZA',
            ),
            '广州鸿粤锐虎汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Guangzhou',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'GZC',
            ),
            '广东惠通陆华汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Guangzhou',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'GZD',
            ),
            '广东鸿粤锐虎汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Guangzhou',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'GZF',
            ),
            '广州中升仕豪汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Guangzhou',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'GZG',
            ),
            '广州市南菱博虎汽车销售服务有限公司'   => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Guangzhou',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'GZH',
            ),
            '成都惠通陆华汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Chengdu',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'CDB',
            ),
            '成都运通博捷汽车销售有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Chengdu',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'CDC',
            ),
            '成都合力创汽车销售服务有限公司'     => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Chengdu',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'CDD',
            ),
            '成都中升仕豪汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Chengdu',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'CDE',
            ),
            '成都运通晟捷汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Central_Invitation_Chengdu',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'CDH',
            ),
            '吉林陆捷汽车贸易有限公司-SRAT'   => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Changchun',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'CCA',
            ),
            '长春陆捷汽车贸易有限公司'        => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Changchun',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'CCB',
            ),
            '山西路华汽车销售有限公司'        => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Taiyuan',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'TYB',
            ),
            '山西顺驰路捷汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Taiyuan',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'TYC',
            ),
            '尊荣亿方集团大连捷路汽车贸易有限公司'  => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Dalian',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'DLA',
            ),
            '大连尊荣捷路汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Dalian',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'DLC',
            ),
            '大连中升仕豪汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Dalian',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'DLD',
            ),
            '河北惠通陆华汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Shijiazhuang',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'HBA',
            ),
            '河北奥菱汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Shijiazhuang',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'HBI',
            ),
            '唐山惠通陆华汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Tangshan',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'HBB',
            ),
            '唐山中进捷旺汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Tangshan',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'HBG',
            ),
            '赤峰长久世达汽车销售有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Chifeng',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'MGG',
            ),
            '无锡中升仕豪汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Wuxi',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'WXA',
            ),
            '无锡天华汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Wuxi',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'WXB',
            ),
            '义乌市东昌汽车销售服务有限公司'     => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Jinhua',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'JHA',
            ),
            '金华恒龙汽车有限公司'          => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Jinhua',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'JHB',
            ),
            '金华英豪汽车有限公司'          => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Jinhua',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'JHC',
            ),
            '常州路捷汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Changzhou',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'CZA',
            ),
            '常州力虎汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Changzhou',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'CZB',
            ),
            '嘉兴天华汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Jiaxing',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'JXA',
            ),
            '海宁路德行汽车有限公司'         => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Jiaxing',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'JXB',
            ),
            '海宁路德行汽车有限公司'         => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Jiaxing',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'JXB',
            ),
            '中山市长久世达汽车销售服务有限公司'   => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Zhongshan',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'GDD',
            ),
            '湖南中汽南方星沙汽车销售服务有限公司'  => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Changsha',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'CSA',
            ),
            '长沙中升仕豪汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Changsha',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'CSB',
            ),
            '长沙恒信路伟汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Changsha',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'CSC',
            ),
            '长沙路德行汽车有限公司'         => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Changsha',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'CSD',
            ),
            '江西长久世达汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Nanchang',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'NCA',
            ),
            '南昌路凯汽车销售服务有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Nanchang',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'NCB',
            ),
            '广西鸿达易通汽车销售服务有限责任公司'  => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Nanning',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'NNB',
            ),
            '广西长久世达汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Nanning',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'NNC',
            ),
            '福建中汽南方汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Fuzhou',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'FZA',
            ),
            '福州捷众汽车有限公司'          => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Fuzhou',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'FZB',
            ),
            '贵州亨特惠通汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Guiyang',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'GYB',
            ),
            '贵州通源捷胜汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Guiyang',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'GYD',
            ),
            '云南路捷汽车销售有限公司'        => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Kunming',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'KMA',
            ),
            '广汇云南路威汽车销售服务有限公司'    => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Kunming',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'KMB',
            ),
            '云南英茂路旗汽车贸易有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Kunming',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'KMD',
            ),
            '昆明中升仕豪汽车销售有限公司'      => array(
                'activity_name' => 'JA_FY18_AOP_Regional_Onsite_Kunming',
                'client_code'   => 'jdxxyHHqybdGqUktLb',
                'client_secret' => '2B29582B68DF2AC3BD823BE005842359',
                'dealer_code'   => 'KME',
            ),
        );

        if (isset($activityIdConf[$dealerName])) {
            return $activityIdConf[$dealerName];
        } else {
            return array();
        }
    }

    /**
     * 获取车型列表
     * @return mixed
     */
    public function getModel($signDealer)
    {
        # 获取配置信息
        $signDealer = trim($signDealer);
        $config = $this->getClientCodeSecret($signDealer);
        if (empty($config)) {
            return array();
        }

        # 获取activity_id  & client_code
        $postData['client_code'] = $config['client_code'];
        $postData['client_secret'] = $config['client_secret'];
        $postData['activity_id'] = $config['activity_name'];
        $postData['timestamp'] = time();
        $postData['nonce_str'] = $this->createNonceStr(12);
        $postData['brand_id'] = 1;
        ksort($postData);
        $tmpStr = '';
        foreach ($postData as $v) {
            if (!is_array($v) && $v) {
                $tmpStr .= $v;
            }
        }

        $authCode = sha1($tmpStr);
        $url = REPORT_MODEL_URL . "?signature=" . $authCode;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 60);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //disable https check
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        if ($postData) {
            curl_setopt($curl, CURLOPT_POST, 1);
            $post_data = http_build_query($postData);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        }
        $retJson = curl_exec($curl);
        if (false === $retJson) {
            curl_close($curl);
            logError('获取车型错误：', PATH_LOG_ERROR, 'report_error', $curl);
            //throw new Exception(curl_error($curl));
        }
        curl_close($curl);

        $retArr = json_decode($retJson, true);
        if (empty($retArr) || $retArr['code'] != 200) {
            logError('获取车型失败：', PATH_LOG_ERROR, 'report_error', $retArr);
        }
        return $retArr;
    }

    /**
     * 留资上报
     * @param  string client_code            Y 密钥标识
     * @param  int    timestamp              Y UNIX时间戳
     * @param  string nonce_str              Y 10-16位随机数
     * @param  int    kmi_id                 Y 不重复的id
     * @param  string lead_source            Y 线索来源，区分大小写 JDX 代表 jaguar
     * @param  string name                   Y 姓名
     * @param  string salutation             N 称谓               Mr. 男 Ms. 女
     * @param  int    mobile                 Y 手机号
     * @param  string email                  N 邮箱
     * @param  string creation_time          Y 创建时间            2018-08-26 13:20:00
     * @param  int    model_id               Y 车型接口返回的id
     * @param  string nameplate_of_interest  Y 感兴趣的车型         JAXJ
     * @param  string request_type           Y 请求类型            KMI  其他类型（非试驾）
     * @param  bool   accept_privacy         Y 同意隐私条款         TRUE 同意  FALSE 不同意
     * @param  $postData
     * @author rootu
     */
    public function reportOwner($postData, $signDealer = '')
    {
        # 获取配置信息
        $signDealer = trim($signDealer);
        $config = $this->getClientCodeSecret($signDealer);
        $client_code = CLIENT_CODE;
        $secret = CLIENT_SECRET;
        if (!empty($config)) {
            $postData['client_code'] = $config['client_code'];
            $postData['client_secret'] = $config['client_secret'];
        } else {
            $postData['client_code'] = $client_code;
            $postData['client_secret'] = $secret;
        }

        $postData['activity_id'] = ACTIVITY_ID;
        if (isset($config['dealer_code'])) {
            $postData['preferred_dealer_code'] = $config['dealer_code'];  //首选经销商
        }
        $postData['leads_source'] = LEADS_SOURCE;
        $postData['request_type'] = REQUEST_TYPE;
        $postData['campaign_id'] = CAMPAIGN_ID;
        $postData['need_lms'] = 1;
        $postData['accept_privacy'] = 'true';
        $postData['timestamp'] = time();
        $postData['sub_channel'] = get_cookie('source');
        $postData['nonce_str'] = $this->createNonceStr(12);


        //JLR 潜客信息记录接口文档
        ksort($postData);
        //return json_encode($postData);exit;
        $tmpStr = '';
        foreach ($postData as $v) {
            if (!is_array($v) && $v) {
                $tmpStr .= $v;
            }
        }

        $authCode = sha1($tmpStr);
        $url = REPORT_MODEL_URL . "?signature=" . $authCode;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 60);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //disable https check
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        if ($postData) {
            curl_setopt($curl, CURLOPT_POST, 1);
            $post_data = http_build_query($postData);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        }
        $retJson = curl_exec($curl);

        $retArr = json_decode($retJson, true);
        $postData['status'] = $retArr;
        if (false === $retJson) {
            $postData['status'] = $retArr;
            curl_close($curl);
            log_file('error1', $retJson);
            //logError('上报错误：', '404', 'report_error', $curl);
            //throw new Exception(curl_error($curl));
            //return false;
        }
        // curl_close($curl);

        if (empty($retArr) || $retArr['code'] != 200) {
            log_file('error2', $retArr);
            //logError('上报失败：', '404', 'report_error', $retArr + $postData);
            //return false;
        }

        return json_encode($postData);
    }

    /**
     * 生成nonce_str
     * @param  int $length
     * @return string
     * @author rootu
     */
    public function createNonceStr($length = 16)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

}
