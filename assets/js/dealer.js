window.dealer = (function($, dealer) {
    var originData = [{
        "dms_code": "BJA",
        "dealer_name": "北京惠通陆华汽车服务有限公司",
        "dealer_abbr": "惠通陆华四惠店",
        "province_id": 3,
        "province_name": "北京",
        "city_id": 17,
        "city_name": "北京"
    },
        {
            "dms_code": "BJB",
            "dealer_name": "北京兰德陆华汽车销售有限公司",
            "dealer_abbr": "兰德陆华",
            "province_id": 3,
            "province_name": "北京",
            "city_id": 17,
            "city_name": "北京"
        },
        {
            "dms_code": "BJD",
            "dealer_name": "北京中汽南方捷豹路虎4S店",
            "dealer_abbr": "北京中汽南方",
            "province_id": 3,
            "province_name": "北京",
            "city_id": 17,
            "city_name": "北京"
        },
        {
            "dms_code": "BJI",
            "dealer_name": "北京燕英捷燕顺捷汽车销售服务有限公司",
            "dealer_abbr": "北京燕英捷燕顺捷",
            "province_id": 3,
            "province_name": "北京",
            "city_id": 17,
            "city_name": "北京"
        },
        {
            "dms_code": "BJK",
            "dealer_name": "北京运通兴捷汽车销售服务有限公司",
            "dealer_abbr": "北京运通兴捷",
            "province_id": 3,
            "province_name": "北京",
            "city_id": 17,
            "city_name": "北京"
        },
        {
            "dms_code": "BJL",
            "dealer_name": "北京长久世达汽车销售有限公司",
            "dealer_abbr": "长久世达",
            "province_id": 3,
            "province_name": "北京",
            "city_id": 17,
            "city_name": "北京"
        },
        {
            "dms_code": "BJM",
            "dealer_name": "北京运通嘉捷汽车销售服务有限公司",
            "dealer_abbr": "北京运通嘉捷",
            "province_id": 3,
            "province_name": "北京",
            "city_id": 17,
            "city_name": "北京"
        },
        {
            "dms_code": "BJN",
            "dealer_name": "北京中进捷旺汽车销售服务有限公司",
            "dealer_abbr": "北京中进捷旺",
            "province_id": 3,
            "province_name": "北京",
            "city_id": 17,
            "city_name": "北京"
        },
        {
            "dms_code": "BJO",
            "dealer_name": "北京长久世捷汽车销售有限公司",
            "dealer_abbr": "长久世捷",
            "province_id": 3,
            "province_name": "北京",
            "city_id": 17,
            "city_name": "北京"
        },
        {
            "dms_code": "CQB",
            "dealer_name": "重庆惠通陆华汽车销售服务有限公司",
            "dealer_abbr": "重庆惠通陆华高九路4S中心",
            "province_id": 4,
            "province_name": "重庆",
            "city_id": 52,
            "city_name": "重庆"
        },
        {
            "dms_code": "CQC",
            "dealer_name": " 重庆惠通嘉华汽车销售服务有限公司",
            "dealer_abbr": "重庆惠通陆华汽博4S中心",
            "province_id": 4,
            "province_name": "重庆",
            "city_id": 52,
            "city_name": "重庆"
        },
        {
            "dms_code": "CQG",
            "dealer_name": "重庆运通汇捷汽车销售服务有限公司",
            "dealer_abbr": "重庆运通汇捷",
            "province_id": 4,
            "province_name": "重庆",
            "city_id": 52,
            "city_name": "重庆"
        },
        {
            "dms_code": "CQF",
            "dealer_name": "重庆商社起航汽车销售服务有限公司\t\t",
            "dealer_abbr": "重庆商社起航",
            "province_id": 4,
            "province_name": "重庆",
            "city_id": 52,
            "city_name": "重庆"
        },
        {
            "dms_code": "SHG",
            "dealer_name": "上海永达路捷汽车销售服务有限公司",
            "dealer_abbr": "上海永达路捷",
            "province_id": 26,
            "province_name": "上海",
            "city_id": 396,
            "city_name": "上海"
        },
        {
            "dms_code": "SHI",
            "dealer_name": "上海信杰汽车销售服务有限公司",
            "dealer_abbr": "上海信杰",
            "province_id": 26,
            "province_name": "上海",
            "city_id": 396,
            "city_name": "上海"
        },
        {
            "dms_code": "SHJ",
            "dealer_name": "上海捷润汽车销售服务有限公司",
            "dealer_abbr": "上海捷润",
            "province_id": 26,
            "province_name": "上海",
            "city_id": 396,
            "city_name": "上海"
        },
        {
            "dms_code": "SHK",
            "dealer_name": "上海天华汽车销售有限公司",
            "dealer_abbr": "上海天华汽车",
            "province_id": 26,
            "province_name": "上海",
            "city_id": 396,
            "city_name": "上海"
        },
        {
            "dms_code": "SHL",
            "dealer_name": "上海永达路胜汽车销售服务有限公司",
            "dealer_abbr": "上海永达路胜",
            "province_id": 26,
            "province_name": "上海",
            "city_id": 396,
            "city_name": "上海"
        },
        {
            "dms_code": "SHQ",
            "dealer_name": "上海松江恒骏汽车销售服务有限公司",
            "dealer_abbr": "松江恒骏",
            "province_id": 26,
            "province_name": "上海",
            "city_id": 396,
            "city_name": "上海"
        },
        {
            "dms_code": "TJB",
            "dealer_name": "天津惠通陆华汽车销售有限公司",
            "dealer_abbr": "天津惠通陆华",
            "province_id": 29,
            "province_name": "天津",
            "city_id": 433,
            "city_name": "天津"
        },
        {
            "dms_code": "TJC",
            "dealer_name": "天津燕鹏捷汽车销售服务有限公司",
            "dealer_abbr": "天津燕鹏捷",
            "province_id": 29,
            "province_name": "天津",
            "city_id": 433,
            "city_name": "天津"
        },
        {
            "dms_code": "TJD",
            "dealer_name": "天津申隆汽车销售服务有限公司",
            "dealer_abbr": "天津申隆",
            "province_id": 29,
            "province_name": "天津",
            "city_id": 433,
            "city_name": "天津"
        },
        {
            "dms_code": "TJE",
            "dealer_name": "天津中进捷旺汽车销售服务有限公司",
            "dealer_abbr": "天津中进捷旺",
            "province_id": 29,
            "province_name": "天津",
            "city_id": 433,
            "city_name": "天津"
        },
        {
            "dms_code": "FYA",
            "dealer_name": "阜阳中源骏杰汽车销售服务有限公司",
            "dealer_abbr": "阜阳骏杰店",
            "province_id": 1,
            "province_name": "安徽",
            "city_id": 110,
            "city_name": "阜阳"
        },
        {
            "dms_code": "HFA",
            "dealer_name": "安徽骏虎汽车销售有限公司",
            "dealer_abbr": NaN,
            "province_id": 1,
            "province_name": "安徽",
            "city_id": 151,
            "city_name": "合肥"
        },
        {
            "dms_code": "HFB",
            "dealer_name": "安徽永达和捷汽车销售服务有限公司",
            "dealer_abbr": "安徽永达和捷",
            "province_id": 1,
            "province_name": "安徽",
            "city_id": 151,
            "city_name": "合肥"
        },
        {
            "dms_code": "WUA",
            "dealer_name": "芜湖恒信路伟汽车销售有限公司",
            "dealer_abbr": "芜湖恒信路伟",
            "province_id": 1,
            "province_name": "安徽",
            "city_id": 466,
            "city_name": "芜湖"
        },
        {
            "dms_code": "BBA",
            "dealer_name": "蚌埠瑞英行汽车销售服务有限公司",
            "dealer_abbr": "蚌埠瑞英行",
            "province_id": 1,
            "province_name": "安徽",
            "city_id": 12,
            "city_name": "蚌埠"
        },
        {
            "dms_code": "FJA",
            "dealer_name": "龙岩富海鸿汽车贸易有限公司",
            "dealer_abbr": "龙岩富海鸿捷豹路虎4S店",
            "province_id": 5,
            "province_name": "福建",
            "city_id": 298,
            "city_name": "龙岩"
        },
        {
            "dms_code": "FJB",
            "dealer_name": "漳州永达路捷汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 5,
            "province_name": "福建",
            "city_id": 603,
            "city_name": "漳州"
        },
        {
            "dms_code": "FZA",
            "dealer_name": "福建中汽南方汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 5,
            "province_name": "福建",
            "city_id": 112,
            "city_name": "福州"
        },
        {
            "dms_code": "FZB",
            "dealer_name": "福州捷众汽车有限公司",
            "dealer_abbr": NaN,
            "province_id": 5,
            "province_name": "福建",
            "city_id": 112,
            "city_name": "福州"
        },
        {
            "dms_code": "FZD",
            "dealer_name": "莆田市路德汽车销售服务有限公司",
            "dealer_abbr": "莆田市路德",
            "province_id": 5,
            "province_name": "福建",
            "city_id": 338,
            "city_name": "莆田"
        },
        {
            "dms_code": "QZA",
            "dealer_name": "晋江富海鸿汽车贸易有限公司",
            "dealer_abbr": NaN,
            "province_id": 5,
            "province_name": "福建",
            "city_id": 347,
            "city_name": "泉州"
        },
        {
            "dms_code": "QZB",
            "dealer_name": "泉州捷众汽车有限公司",
            "dealer_abbr": NaN,
            "province_id": 5,
            "province_name": "福建",
            "city_id": 347,
            "city_name": "泉州"
        },
        {
            "dms_code": "SMA",
            "dealer_name": "三明新成功路捷汽车有限公司",
            "dealer_abbr": NaN,
            "province_id": 5,
            "province_name": "福建",
            "city_id": 385,
            "city_name": "三明"
        },
        {
            "dms_code": "XMA",
            "dealer_name": "厦门新成功路捷汽车有限公司",
            "dealer_abbr": NaN,
            "province_id": 5,
            "province_name": "福建",
            "city_id": 498,
            "city_name": "厦门"
        },
        {
            "dms_code": "XMB",
            "dealer_name": "厦门新成功英翔汽车有限公司",
            "dealer_abbr": "厦门新成功英翔",
            "province_id": 5,
            "province_name": "福建",
            "city_id": 498,
            "city_name": "厦门"
        },
        {
            "dms_code": "XMC",
            "dealer_name": "厦门捷路汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 5,
            "province_name": "福建",
            "city_id": 498,
            "city_name": "厦门"
        },
        {
            "dms_code": "LZB",
            "dealer_name": "甘肃路捷汽车销售有限责任公司 ",
            "dealer_abbr": NaN,
            "province_id": 7,
            "province_name": "甘肃",
            "city_id": 285,
            "city_name": "兰州"
        },
        {
            "dms_code": "LZC",
            "dealer_name": "甘肃通瑞汽车贸易有限公司",
            "dealer_abbr": NaN,
            "province_id": 7,
            "province_name": "甘肃",
            "city_id": 285,
            "city_name": "兰州"
        },
        {
            "dms_code": "DGA",
            "dealer_name": "东莞寮步中汽南方汽车销售服务有限公司 ",
            "dealer_abbr": "东莞寮步捷豹路虎",
            "province_id": 6,
            "province_name": "广东",
            "city_id": 70,
            "city_name": "东莞"
        },
        {
            "dms_code": "DGB",
            "dealer_name": "东莞鸿粤锐虎汽车销售服务有限公司 ",
            "dealer_abbr": "东莞鸿粤锐虎汽车销售服务有限公司 ",
            "province_id": 6,
            "province_name": "广东",
            "city_id": 70,
            "city_name": "东莞"
        },
        {
            "dms_code": "DGC",
            "dealer_name": "东莞鸿粤驿虎汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 6,
            "province_name": "广东",
            "city_id": 70,
            "city_name": "东莞"
        },
        {
            "dms_code": "DGD",
            "dealer_name": "东莞惠通陆华汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 6,
            "province_name": "广东",
            "city_id": 70,
            "city_name": "东莞"
        },
        {
            "dms_code": "GDA",
            "dealer_name": "惠州惠通陆华汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 6,
            "province_name": "广东",
            "city_id": 191,
            "city_name": "惠州"
        },
        {
            "dms_code": "GDB",
            "dealer_name": "佛山市庆丰豹虎汽车销售服务有限公司 ",
            "dealer_abbr": "佛山庆丰豹虎4S中心",
            "province_id": 6,
            "province_name": "广东",
            "city_id": 107,
            "city_name": "佛山"
        },
        {
            "dms_code": "GDC",
            "dealer_name": "汕头市路杰汽车销售服务有限公司 ",
            "dealer_abbr": NaN,
            "province_id": 6,
            "province_name": "广东",
            "city_id": 401,
            "city_name": "汕头"
        },
        {
            "dms_code": "GDD",
            "dealer_name": "中山市长久世达汽车销售服务有限公司 ",
            "dealer_abbr": NaN,
            "province_id": 6,
            "province_name": "广东",
            "city_id": 592,
            "city_name": "中山"
        },
        {
            "dms_code": "GDE",
            "dealer_name": "佛山市庆丰路畅汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 6,
            "province_name": "广东",
            "city_id": 107,
            "city_name": "佛山"
        },
        {
            "dms_code": "GDH",
            "dealer_name": "肇庆恒信路伟汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 6,
            "province_name": "广东",
            "city_id": 589,
            "city_name": "肇庆"
        },
        {
            "dms_code": "GDI",
            "dealer_name": "揭阳路泽汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 6,
            "province_name": "广东",
            "city_id": 233,
            "city_name": "揭阳"
        },
        {
            "dms_code": "GDJ",
            "dealer_name": "清远庆丰奥达汽车销售服务有限公司",
            "dealer_abbr": "清远庆丰奥达",
            "province_id": 6,
            "province_name": "广东",
            "city_id": 363,
            "city_name": "清远"
        },
        {
            "dms_code": "GZA",
            "dealer_name": "广东中汽南方汽车销售服务有限公司 ",
            "dealer_abbr": NaN,
            "province_id": 6,
            "province_name": "广东",
            "city_id": 136,
            "city_name": "广州"
        },
        {
            "dms_code": "GZC",
            "dealer_name": "广州鸿粤锐虎汽车销售服务有限公司 ",
            "dealer_abbr": NaN,
            "province_id": 6,
            "province_name": "广东",
            "city_id": 136,
            "city_name": "广州"
        },
        {
            "dms_code": "GZD",
            "dealer_name": "广东惠通陆华汽车销售有限公司 ",
            "dealer_abbr": NaN,
            "province_id": 6,
            "province_name": "广东",
            "city_id": 136,
            "city_name": "广州"
        },
        {
            "dms_code": "GZF",
            "dealer_name": "广东鸿粤锐虎汽车销售服务有限公司 ",
            "dealer_abbr": NaN,
            "province_id": 6,
            "province_name": "广东",
            "city_id": 136,
            "city_name": "广州"
        },
        {
            "dms_code": "GZH",
            "dealer_name": "广州市南菱博虎汽车销售服务有限公司",
            "dealer_abbr": "广州南菱博虎",
            "province_id": 6,
            "province_name": "广东",
            "city_id": 136,
            "city_name": "广州"
        },
        {
            "dms_code": "JMA",
            "dealer_name": "江门市南菱元吉汽车有限公司",
            "dealer_abbr": NaN,
            "province_id": 6,
            "province_name": "广东",
            "city_id": 128,
            "city_name": "江门"
        },
        {
            "dms_code": "SDA",
            "dealer_name": "佛山市顺德区广顺汽车有限公司",
            "dealer_abbr": "佛山顺德广顺",
            "province_id": 6,
            "province_name": "广东",
            "city_id": 107,
            "city_name": "佛山"
        },
        {
            "dms_code": "SZA",
            "dealer_name": "深圳市中汽南方机电设备有限公司 ",
            "dealer_abbr": "深圳中汽南方",
            "province_id": 6,
            "province_name": "广东",
            "city_id": 423,
            "city_name": "深圳"
        },
        {
            "dms_code": "SZB",
            "dealer_name": "天津汽车工业销售深圳南方有限公司 ",
            "dealer_abbr": NaN,
            "province_id": 6,
            "province_name": "广东",
            "city_id": 423,
            "city_name": "深圳"
        },
        {
            "dms_code": "SZC",
            "dealer_name": "深圳市路豹汽车销售有限公司",
            "dealer_abbr": NaN,
            "province_id": 6,
            "province_name": "广东",
            "city_id": 423,
            "city_name": "深圳"
        },
        {
            "dms_code": "SZD",
            "dealer_name": "深圳申隆汽车销售服务有限公司 ",
            "dealer_abbr": NaN,
            "province_id": 6,
            "province_name": "广东",
            "city_id": 423,
            "city_name": "深圳"
        },
        {
            "dms_code": "SZE",
            "dealer_name": "深圳路捷汽车销售服务有限公司",
            "dealer_abbr": "深圳路捷",
            "province_id": 6,
            "province_name": "广东",
            "city_id": 423,
            "city_name": "深圳"
        },
        {
            "dms_code": "ZHA",
            "dealer_name": "珠海中汽南方捷路汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 6,
            "province_name": "广东",
            "city_id": 578,
            "city_name": "珠海"
        },
        {
            "dms_code": "GZG",
            "dealer_name": "广州中升仕豪汽车销售服务有限公司\t\t",
            "dealer_abbr": "广州中升仕豪",
            "province_id": 6,
            "province_name": "广东",
            "city_id": 136,
            "city_name": "广州"
        },
        {
            "dms_code": "GXA",
            "dealer_name": "柳州中升仕豪汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 8,
            "province_name": "广西",
            "city_id": 302,
            "city_name": "柳州"
        },
        {
            "dms_code": "GXB",
            "dealer_name": "桂林长久世达汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 8,
            "province_name": "广西",
            "city_id": 123,
            "city_name": "桂林"
        },
        {
            "dms_code": "NNB",
            "dealer_name": "广西鸿达易通汽车销售服务有限责任公司 ",
            "dealer_abbr": NaN,
            "province_id": 8,
            "province_name": "广西",
            "city_id": 326,
            "city_name": "南宁"
        },
        {
            "dms_code": "NNC",
            "dealer_name": "广西长久世达汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 8,
            "province_name": "广西",
            "city_id": 326,
            "city_name": "南宁"
        },
        {
            "dms_code": "GYB",
            "dealer_name": "贵州亨特惠通汽车销售服务有限公司 ",
            "dealer_abbr": NaN,
            "province_id": 9,
            "province_name": "贵州",
            "city_id": 132,
            "city_name": "贵阳"
        },
        {
            "dms_code": "GYD",
            "dealer_name": "贵州通源捷胜汽车销售服务有限公司",
            "dealer_abbr": "贵州通源捷豹路虎",
            "province_id": 9,
            "province_name": "贵州",
            "city_id": 132,
            "city_name": "贵阳"
        },
        {
            "dms_code": "ZYA",
            "dealer_name": "遵义通源捷胜汽车销售服务有限公司",
            "dealer_abbr": "遵义通源捷胜",
            "province_id": 9,
            "province_name": "贵州",
            "city_id": 599,
            "city_name": "遵义"
        },
        {
            "dms_code": "HKA",
            "dealer_name": "海南中汽南方汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 14,
            "province_name": "海南",
            "city_id": 161,
            "city_name": "海口"
        },
        {
            "dms_code": "HBA",
            "dealer_name": "河北惠通陆华汽车销售服务有限公司",
            "dealer_abbr": "河北惠通陆华",
            "province_id": 10,
            "province_name": "河北",
            "city_id": 382,
            "city_name": "石家庄"
        },
        {
            "dms_code": "HBB",
            "dealer_name": "唐山惠通陆华汽车销售服务有限公司",
            "dealer_abbr": "唐山惠通陆华",
            "province_id": 10,
            "province_name": "河北",
            "city_id": 442,
            "city_name": "唐山"
        },
        {
            "dms_code": "HBC",
            "dealer_name": "保定威神汽车销售服务有限公司",
            "dealer_abbr": "保定威神",
            "province_id": 10,
            "province_name": "河北",
            "city_id": 23,
            "city_name": "保定"
        },
        {
            "dms_code": "HBD",
            "dealer_name": "秦皇岛世之捷汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 10,
            "province_name": "河北",
            "city_id": 352,
            "city_name": "秦皇岛"
        },
        {
            "dms_code": "HBE",
            "dealer_name": "沧州威神汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 10,
            "province_name": "河北",
            "city_id": 261,
            "city_name": "廊坊"
        },
        {
            "dms_code": "HBF",
            "dealer_name": "邯郸威虎汽车销售服务有限公司",
            "dealer_abbr": "邯郸威虎捷豹路虎4S店",
            "province_id": 10,
            "province_name": "河北",
            "city_id": 138,
            "city_name": "邯郸"
        },
        {
            "dms_code": "HBG",
            "dealer_name": "唐山中进捷旺汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 10,
            "province_name": "河北",
            "city_id": 442,
            "city_name": "唐山"
        },
        {
            "dms_code": "HBI",
            "dealer_name": "河北奥菱汽车销售服务有限公司",
            "dealer_abbr": "河北奥菱",
            "province_id": 10,
            "province_name": "河北",
            "city_id": 382,
            "city_name": "石家庄"
        },
        {
            "dms_code": "HBK",
            "dealer_name": "廊坊市路泽汽车销售服务有限公司",
            "dealer_abbr": "廊坊市路泽汽车销售服务有限公司",
            "province_id": 10,
            "province_name": "河北",
            "city_id": 261,
            "city_name": "廊坊"
        },
        {
            "dms_code": "HBJ",
            "dealer_name": "保定路捷汽车销售服务有限公司\t\t",
            "dealer_abbr": "保定路捷",
            "province_id": 10,
            "province_name": "河北",
            "city_id": 23,
            "city_name": "保定"
        },
        {
            "dms_code": "HBO",
            "dealer_name": "邢台傲龙汽车销售服务有限公司",
            "dealer_abbr": "邢台傲龙",
            "province_id": 10,
            "province_name": "河北",
            "city_id": 512,
            "city_name": "邢台"
        },
        {
            "dms_code": "HNA",
            "dealer_name": "河南通孚祥汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 15,
            "province_name": "河南",
            "city_id": 604,
            "city_name": "郑州"
        },
        {
            "dms_code": "HNB",
            "dealer_name": "郑州永达和谐汽车销售服务有限公司",
            "dealer_abbr": "郑州永达和谐",
            "province_id": 15,
            "province_name": "河南",
            "city_id": 604,
            "city_name": "郑州"
        },
        {
            "dms_code": "HND",
            "dealer_name": "河南新通孚祥汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 15,
            "province_name": "河南",
            "city_id": 604,
            "city_name": "郑州"
        },
        {
            "dms_code": "HNF",
            "dealer_name": "新乡通孚祥汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 15,
            "province_name": "河南",
            "city_id": 515,
            "city_name": "新乡"
        },
        {
            "dms_code": "HNL",
            "dealer_name": "郑州恒信路伟汽车销售服务有限公司",
            "dealer_abbr": "郑州恒信路伟",
            "province_id": 15,
            "province_name": "河南",
            "city_id": 604,
            "city_name": "郑州"
        },
        {
            "dms_code": "HNE",
            "dealer_name": "平顶山通孚祥汽车销售服务有限公司\t\t",
            "dealer_abbr": "平顶山通孚祥",
            "province_id": 15,
            "province_name": "河南",
            "city_id": 332,
            "city_name": "平顶山"
        },
        {
            "dms_code": "HNM",
            "dealer_name": "洛阳新通孚祥汽车销售服务有限公司\t\t",
            "dealer_abbr": "洛阳新通孚祥",
            "province_id": 15,
            "province_name": "河南",
            "city_id": 300,
            "city_name": "洛阳"
        },
        {
            "dms_code": "HRA",
            "dealer_name": "黑龙江尊荣捷路汽车贸易有限公司",
            "dealer_abbr": NaN,
            "province_id": 13,
            "province_name": "黑龙江",
            "city_id": 144,
            "city_name": "哈尔滨"
        },
        {
            "dms_code": "HRB",
            "dealer_name": "尊荣亿方集团黑龙江汽车贸易有限公司",
            "dealer_abbr": NaN,
            "province_id": 13,
            "province_name": "黑龙江",
            "city_id": 144,
            "city_name": "哈尔滨"
        },
        {
            "dms_code": "HRC",
            "dealer_name": "大庆尊荣捷路汽车销售服务有限公司",
            "dealer_abbr": "大庆尊荣捷路",
            "province_id": 13,
            "province_name": "黑龙江",
            "city_id": 78,
            "city_name": "大庆"
        },
        {
            "dms_code": "HRD",
            "dealer_name": "哈尔滨路捷汽车销售服务有限公司",
            "dealer_abbr": "哈尔滨永达捷豹路虎4S中心",
            "province_id": 13,
            "province_name": "黑龙江",
            "city_id": 144,
            "city_name": "哈尔滨"
        },
        {
            "dms_code": "SNA",
            "dealer_name": "十堰恒信路伟汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 11,
            "province_name": "湖北",
            "city_id": 409,
            "city_name": "十堰"
        },
        {
            "dms_code": "WHB",
            "dealer_name": "武汉捷路汽车销售服务有限公司 ",
            "dealer_abbr": "武汉捷路",
            "province_id": 11,
            "province_name": "湖北",
            "city_id": 469,
            "city_name": "武汉"
        },
        {
            "dms_code": "WHC",
            "dealer_name": "武汉康顺捷路汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 11,
            "province_name": "湖北",
            "city_id": 469,
            "city_name": "武汉"
        },
        {
            "dms_code": "WHD",
            "dealer_name": "武汉佳路捷汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 11,
            "province_name": "湖北",
            "city_id": 469,
            "city_name": "武汉"
        },
        {
            "dms_code": "WHE",
            "dealer_name": "武汉路泽汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 11,
            "province_name": "湖北",
            "city_id": 469,
            "city_name": "武汉"
        },
        {
            "dms_code": "XYA",
            "dealer_name": "襄阳捷路汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 11,
            "province_name": "湖北",
            "city_id": 490,
            "city_name": "襄樊"
        },
        {
            "dms_code": "YHA",
            "dealer_name": "宜昌路顺汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 11,
            "province_name": "湖北",
            "city_id": 535,
            "city_name": "宜昌"
        },
        {
            "dms_code": "CGA",
            "dealer_name": "常德天元汽车销售服务有限公司",
            "dealer_abbr": "常德天元",
            "province_id": 16,
            "province_name": "湖南",
            "city_id": 41,
            "city_name": "常德"
        },
        {
            "dms_code": "CSA",
            "dealer_name": "湖南中汽南方星沙汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 16,
            "province_name": "湖南",
            "city_id": 55,
            "city_name": "长沙"
        },
        {
            "dms_code": "CSB",
            "dealer_name": "长沙中升仕豪汽车销售服务有限公司",
            "dealer_abbr": "长沙中升仕豪",
            "province_id": 16,
            "province_name": "湖南",
            "city_id": 55,
            "city_name": "长沙"
        },
        {
            "dms_code": "CSD",
            "dealer_name": "长沙路德行汽车有限公司",
            "dealer_abbr": NaN,
            "province_id": 16,
            "province_name": "湖南",
            "city_id": 55,
            "city_name": "长沙"
        },
        {
            "dms_code": "CUA",
            "dealer_name": "郴州市鹏峰汽车有限公司",
            "dealer_abbr": "郴州市鹏峰汽车有限公司",
            "province_id": 16,
            "province_name": "湖南",
            "city_id": 64,
            "city_name": "郴州"
        },
        {
            "dms_code": "HYA",
            "dealer_name": "衡阳路泽汽车销售服务有限公司",
            "dealer_abbr": "衡阳路泽",
            "province_id": 16,
            "province_name": "湖南",
            "city_id": 183,
            "city_name": "衡阳"
        },
        {
            "dms_code": "LDA",
            "dealer_name": "娄底路德行汽车有限公司",
            "dealer_abbr": NaN,
            "province_id": 16,
            "province_name": "湖南",
            "city_id": 258,
            "city_name": "娄底"
        },
        {
            "dms_code": "XTA",
            "dealer_name": "湘潭湘路捷汽车销售服务有限公司",
            "dealer_abbr": "湘潭湘路捷",
            "province_id": 16,
            "province_name": "湖南",
            "city_id": 510,
            "city_name": "湘潭"
        },
        {
            "dms_code": "YYA",
            "dealer_name": "岳阳恒信路伟汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 16,
            "province_name": "湖南",
            "city_id": 565,
            "city_name": "岳阳"
        },
        {
            "dms_code": "ZZA",
            "dealer_name": "株洲市兰天天程汽车销售有限公司",
            "dealer_abbr": "株洲兰天天程",
            "province_id": 16,
            "province_name": "湖南",
            "city_id": 600,
            "city_name": "株洲"
        },
        {
            "dms_code": "CSC",
            "dealer_name": "长沙恒信路伟汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 16,
            "province_name": "湖南",
            "city_id": 55,
            "city_name": "长沙"
        },
        {
            "dms_code": "HHA",
            "dealer_name": "怀化恒信路伟汽车销售服务有限公司\t\t",
            "dealer_abbr": "怀化恒信路伟",
            "province_id": 16,
            "province_name": "湖南",
            "city_id": 157,
            "city_name": "怀化"
        },
        {
            "dms_code": "CCA",
            "dealer_name": "吉林陆捷汽车贸易有限公司",
            "dealer_abbr": NaN,
            "province_id": 17,
            "province_name": "吉林",
            "city_id": 39,
            "city_name": "长春"
        },
        {
            "dms_code": "CCB",
            "dealer_name": "长春陆捷汽车贸易有限公司",
            "dealer_abbr": "长春陆捷",
            "province_id": 17,
            "province_name": "吉林",
            "city_id": 39,
            "city_name": "长春"
        },
        {
            "dms_code": "JLA",
            "dealer_name": "吉林市康顺捷路汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 17,
            "province_name": "吉林",
            "city_id": 205,
            "city_name": "吉林"
        },
        {
            "dms_code": "CZA",
            "dealer_name": "常州路捷汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 18,
            "province_name": "江苏",
            "city_id": 63,
            "city_name": "常州"
        },
        {
            "dms_code": "CZB",
            "dealer_name": "常州力虎汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 18,
            "province_name": "江苏",
            "city_id": 63,
            "city_name": "常州"
        },
        {
            "dms_code": "HAA",
            "dealer_name": "淮安宝铁龙汽车销售有限公司",
            "dealer_abbr": NaN,
            "province_id": 18,
            "province_name": "江苏",
            "city_id": 137,
            "city_name": "淮安"
        },
        {
            "dms_code": "JSA",
            "dealer_name": "昆山永达路捷汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 18,
            "province_name": "江苏",
            "city_id": 221,
            "city_name": "昆山"
        },
        {
            "dms_code": "JSB",
            "dealer_name": "常熟永达路捷汽车销售服务有限公司",
            "dealer_abbr": "常熟永达路捷",
            "province_id": 18,
            "province_name": "江苏",
            "city_id": 421,
            "city_name": "苏州"
        },
        {
            "dms_code": "LNA",
            "dealer_name": "连云港润捷汽车销售有限公司",
            "dealer_abbr": NaN,
            "province_id": 18,
            "province_name": "江苏",
            "city_id": 295,
            "city_name": "连云港"
        },
        {
            "dms_code": "NJA",
            "dealer_name": "江苏世贸泰信汽车贸易有限公司",
            "dealer_abbr": "江苏世贸泰信",
            "province_id": 18,
            "province_name": "江苏",
            "city_id": 323,
            "city_name": "南京"
        },
        {
            "dms_code": "NJB",
            "dealer_name": "南京中捷汽车销售服务有限公司",
            "dealer_abbr": "南京中捷",
            "province_id": 18,
            "province_name": "江苏",
            "city_id": 323,
            "city_name": "南京"
        },
        {
            "dms_code": "NJC",
            "dealer_name": "南京永达路捷汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 18,
            "province_name": "江苏",
            "city_id": 323,
            "city_name": "南京"
        },
        {
            "dms_code": "NJD",
            "dealer_name": "江苏世贸泰信捷路汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 18,
            "province_name": "江苏",
            "city_id": 323,
            "city_name": "南京"
        },
        {
            "dms_code": "NTA",
            "dealer_name": "南通东方鼎辰汽车销售服务有限公司",
            "dealer_abbr": "南通东方鼎辰汽车销售服务有限公司",
            "province_id": 18,
            "province_name": "江苏",
            "city_id": 329,
            "city_name": "南通"
        },
        {
            "dms_code": "NTB",
            "dealer_name": "南通新捷汽车销售服务有限公司",
            "dealer_abbr": "南通新捷",
            "province_id": 18,
            "province_name": "江苏",
            "city_id": 329,
            "city_name": "南通"
        },
        {
            "dms_code": "SQA",
            "dealer_name": "宿迁润凯汽车销售服务有限公司",
            "dealer_abbr": "宿迁润凯",
            "province_id": 18,
            "province_name": "江苏",
            "city_id": 389,
            "city_name": "宿迁"
        },
        {
            "dms_code": "SUB",
            "dealer_name": "苏州中捷汽车销售服务有限公司",
            "dealer_abbr": "苏州中捷",
            "province_id": 18,
            "province_name": "江苏",
            "city_id": 421,
            "city_name": "苏州"
        },
        {
            "dms_code": "SUC",
            "dealer_name": "张家港中捷汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 18,
            "province_name": "江苏",
            "city_id": 421,
            "city_name": "苏州"
        },
        {
            "dms_code": "THA",
            "dealer_name": "泰州宝汇汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 18,
            "province_name": "江苏",
            "city_id": 454,
            "city_name": "泰州"
        },
        {
            "dms_code": "WXA",
            "dealer_name": "无锡中升仕豪汽车销售服务有限公司",
            "dealer_abbr": "无锡中升仕豪",
            "province_id": 18,
            "province_name": "江苏",
            "city_id": 480,
            "city_name": "无锡"
        },
        {
            "dms_code": "WXB",
            "dealer_name": "无锡天华汽车销售服务有限公司",
            "dealer_abbr": "无锡天华",
            "province_id": 18,
            "province_name": "江苏",
            "city_id": 480,
            "city_name": "无锡"
        },
        {
            "dms_code": "WXC",
            "dealer_name": "宜兴路德行汽车有限公司",
            "dealer_abbr": "宜兴路德行",
            "province_id": 18,
            "province_name": "江苏",
            "city_id": 480,
            "city_name": "无锡"
        },
        {
            "dms_code": "XZA",
            "dealer_name": "徐州捷润汽车销售服务有限公司",
            "dealer_abbr": "徐州捷润",
            "province_id": 18,
            "province_name": "江苏",
            "city_id": 508,
            "city_name": "徐州"
        },
        {
            "dms_code": "YGA",
            "dealer_name": "盐城东昌宝达汽车服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 18,
            "province_name": "江苏",
            "city_id": 531,
            "city_name": "盐城"
        },
        {
            "dms_code": "YZA",
            "dealer_name": "扬州天华汽车销售服务有限公司",
            "dealer_abbr": "扬州天华",
            "province_id": 18,
            "province_name": "江苏",
            "city_id": 554,
            "city_name": "扬州"
        },
        {
            "dms_code": "ZJA",
            "dealer_name": "镇江中捷汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 18,
            "province_name": "江苏",
            "city_id": 591,
            "city_name": "镇江"
        },
        {
            "dms_code": "GHA",
            "dealer_name": "赣州恒信路伟汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 19,
            "province_name": "江西",
            "city_id": 134,
            "city_name": "赣州"
        },
        {
            "dms_code": "JDA",
            "dealer_name": "景德镇路德行汽车有限公司",
            "dealer_abbr": NaN,
            "province_id": 19,
            "province_name": "江西",
            "city_id": 239,
            "city_name": "景德镇"
        },
        {
            "dms_code": "JUA",
            "dealer_name": "九江捷路汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 19,
            "province_name": "江西",
            "city_id": 204,
            "city_name": "九江"
        },
        {
            "dms_code": "NCA",
            "dealer_name": "江西长久世达汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 19,
            "province_name": "江西",
            "city_id": 315,
            "city_name": "南昌"
        },
        {
            "dms_code": "NCB",
            "dealer_name": "南昌路凯汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 19,
            "province_name": "江西",
            "city_id": 315,
            "city_name": "南昌"
        },
        {
            "dms_code": "SRB",
            "dealer_name": "江西上饶路泽汽车销售有限公司",
            "dealer_abbr": NaN,
            "province_id": 19,
            "province_name": "江西",
            "city_id": 391,
            "city_name": "上饶"
        },
        {
            "dms_code": "ASA",
            "dealer_name": "鞍山尊荣捷路汽车贸易有限公司",
            "dealer_abbr": NaN,
            "province_id": 20,
            "province_name": "辽宁",
            "city_id": 8,
            "city_name": "鞍山"
        },
        {
            "dms_code": "DLA",
            "dealer_name": "尊荣亿方集团大连捷路汽车贸易有限公司",
            "dealer_abbr": "大连尊荣",
            "province_id": 20,
            "province_name": "辽宁",
            "city_id": 75,
            "city_name": "大连"
        },
        {
            "dms_code": "DLC",
            "dealer_name": "大连尊荣捷路汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 20,
            "province_name": "辽宁",
            "city_id": 75,
            "city_name": "大连"
        },
        {
            "dms_code": "DLD",
            "dealer_name": "大连中升仕豪汽车销售服务有限公司",
            "dealer_abbr": "大连中升仕豪",
            "province_id": 20,
            "province_name": "辽宁",
            "city_id": 75,
            "city_name": "大连"
        },
        {
            "dms_code": "JZA",
            "dealer_name": "锦州尊荣捷路汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 20,
            "province_name": "辽宁",
            "city_id": 238,
            "city_name": "锦州"
        },
        {
            "dms_code": "SYA",
            "dealer_name": "辽宁尊荣亿方汽车销售服务有限公司",
            "dealer_abbr": "辽宁尊荣亿方",
            "province_id": 20,
            "province_name": "辽宁",
            "city_id": 412,
            "city_name": "沈阳"
        },
        {
            "dms_code": "SYB",
            "dealer_name": "沈阳尊荣路捷汽车销售服务有限公司",
            "dealer_abbr": "沈阳尊荣路捷汽车销售服务有限公司",
            "province_id": 20,
            "province_name": "辽宁",
            "city_id": 412,
            "city_name": "沈阳"
        },
        {
            "dms_code": "SYC",
            "dealer_name": "沈阳中升仕豪汽车销售服务有限公司",
            "dealer_abbr": "沈阳中升仕豪",
            "province_id": 20,
            "province_name": "辽宁",
            "city_id": 412,
            "city_name": "沈阳"
        },
        {
            "dms_code": "YKA",
            "dealer_name": "营口中升仕豪汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 20,
            "province_name": "辽宁",
            "city_id": 545,
            "city_name": "营口"
        },
        {
            "dms_code": "MGA",
            "dealer_name": "内蒙古惠通陆华汽车销售有限公司",
            "dealer_abbr": "内蒙古惠通陆华",
            "province_id": 21,
            "province_name": "内蒙古",
            "city_id": 156,
            "city_name": "呼和浩特"
        },
        {
            "dms_code": "MGC",
            "dealer_name": "鄂尔多斯市惠通陆华汽车销售服务有限公司",
            "dealer_abbr": "鄂尔多斯市惠通陆华",
            "province_id": 21,
            "province_name": "内蒙古",
            "city_id": 648,
            "city_name": "鄂尔多斯"
        },
        {
            "dms_code": "MGD",
            "dealer_name": "包头市路泽汽车销售服务有限公司",
            "dealer_abbr": "包头路泽",
            "province_id": 21,
            "province_name": "内蒙古",
            "city_id": 27,
            "city_name": "包头"
        },
        {
            "dms_code": "MGE",
            "dealer_name": "乌海惠通陆华汽车销售服务有限公司",
            "dealer_abbr": "乌海惠通陆华",
            "province_id": 21,
            "province_name": "内蒙古",
            "city_id": 210,
            "city_name": "乌海"
        },
        {
            "dms_code": "MGF",
            "dealer_name": "内蒙古顺驰路捷汽车销售服务有限公司",
            "dealer_abbr": "呼和浩特顺驰路捷",
            "province_id": 21,
            "province_name": "内蒙古",
            "city_id": 156,
            "city_name": "呼和浩特"
        },
        {
            "dms_code": "MGG",
            "dealer_name": "赤峰长久世达汽车销售有限公司",
            "dealer_abbr": "赤峰长久世达汽车销售有限公司",
            "province_id": 21,
            "province_name": "内蒙古",
            "city_id": 42,
            "city_name": "赤峰"
        },
        {
            "dms_code": "YCA",
            "dealer_name": "宁夏路捷汽车贸易有限公司",
            "dealer_abbr": NaN,
            "province_id": 22,
            "province_name": "宁夏",
            "city_id": 536,
            "city_name": "银川"
        },
        {
            "dms_code": "YCD",
            "dealer_name": "银川顺驰路捷汽车销售服务有限公司",
            "dealer_abbr": "新丰泰路捷",
            "province_id": 22,
            "province_name": "宁夏",
            "city_id": 536,
            "city_name": "银川"
        },
        {
            "dms_code": "XNA",
            "dealer_name": "青海捷路汽车销售服务有限公司",
            "dealer_abbr": "青海捷路",
            "province_id": 23,
            "province_name": "青海",
            "city_id": 501,
            "city_name": "西宁"
        },
        {
            "dms_code": "BAA",
            "dealer_name": "宝鸡威凯汽车销售服务有限公司",
            "dealer_abbr": "宝鸡威凯",
            "province_id": 27,
            "province_name": "陕西",
            "city_id": 20,
            "city_name": "宝鸡"
        },
        {
            "dms_code": "XAC",
            "dealer_name": "榆林庞大宏伟汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 27,
            "province_name": "陕西",
            "city_id": 548,
            "city_name": "榆林"
        },
        {
            "dms_code": "XAD",
            "dealer_name": "陕西天华汽车销售服务有限公司",
            "dealer_abbr": "陕西天华",
            "province_id": 27,
            "province_name": "陕西",
            "city_id": 485,
            "city_name": "西安"
        },
        {
            "dms_code": "XAF",
            "dealer_name": "西安运通瑞捷汽车销售服务有限公司",
            "dealer_abbr": "西安运通瑞捷",
            "province_id": 27,
            "province_name": "陕西",
            "city_id": 485,
            "city_name": "西安"
        },
        {
            "dms_code": "XAI",
            "dealer_name": "西安中升仕豪汽车销售服务有限公司",
            "dealer_abbr": "西安中升仕豪",
            "province_id": 27,
            "province_name": "陕西",
            "city_id": 485,
            "city_name": "西安"
        },
        {
            "dms_code": "XAK",
            "dealer_name": "陕西惠通陆华汽车销售有限公司",
            "dealer_abbr": "陕西惠通陆华",
            "province_id": 27,
            "province_name": "陕西",
            "city_id": 485,
            "city_name": "西安"
        },
        {
            "dms_code": "XAM",
            "dealer_name": "西安惠通陆华汽车销售有限公司",
            "dealer_abbr": "西安惠通陆华",
            "province_id": 27,
            "province_name": "陕西",
            "city_id": 485,
            "city_name": "西安"
        },
        {
            "dms_code": "JNE",
            "dealer_name": "济南中升仕豪汽车销售服务有限公司",
            "dealer_abbr": "济南中升仕豪",
            "province_id": 25,
            "province_name": "山东",
            "city_id": 213,
            "city_name": "济南"
        },
        {
            "dms_code": "LYA",
            "dealer_name": "临沂力虎汽车销售服务有限公司",
            "dealer_abbr": "临沂力虎",
            "province_id": 25,
            "province_name": "山东",
            "city_id": 296,
            "city_name": "临沂"
        },
        {
            "dms_code": "QDA",
            "dealer_name": "青岛中升杰豪汽车销售服务有限公司",
            "dealer_abbr": "青岛中升杰豪",
            "province_id": 25,
            "province_name": "山东",
            "city_id": 349,
            "city_name": "青岛"
        },
        {
            "dms_code": "QDB",
            "dealer_name": "青岛中升仕豪汽车销售服务有限公司",
            "dealer_abbr": "青岛中升仕豪",
            "province_id": 25,
            "province_name": "山东",
            "city_id": 349,
            "city_name": "青岛"
        },
        {
            "dms_code": "SDB",
            "dealer_name": "威海路泽汽车销售服务有限公司",
            "dealer_abbr": "威海路泽",
            "province_id": 25,
            "province_name": "山东",
            "city_id": 468,
            "city_name": "威海"
        },
        {
            "dms_code": "SDC",
            "dealer_name": "山东百事佳路豹汽车汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 25,
            "province_name": "山东",
            "city_id": 213,
            "city_name": "济南"
        },
        {
            "dms_code": "SDD",
            "dealer_name": "东营天华汽车销售服务有限公司",
            "dealer_abbr": "东营天华捷豹路虎4S店",
            "province_id": 25,
            "province_name": "山东",
            "city_id": 89,
            "city_name": "东营"
        },
        {
            "dms_code": "SDE",
            "dealer_name": "济宁恒吉汽车销售服务有限公司",
            "dealer_abbr": "济宁恒吉捷豹路虎4S店",
            "province_id": 25,
            "province_name": "山东",
            "city_id": 212,
            "city_name": "济宁"
        },
        {
            "dms_code": "SDF",
            "dealer_name": "泰安力虎汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 25,
            "province_name": "山东",
            "city_id": 425,
            "city_name": "泰安"
        },
        {
            "dms_code": "SDH",
            "dealer_name": "枣庄力虎汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 25,
            "province_name": "山东",
            "city_id": 601,
            "city_name": "枣庄"
        },
        {
            "dms_code": "SDI",
            "dealer_name": "菏泽路达汽车销售服务有限公司",
            "dealer_abbr": "菏泽路达",
            "province_id": 25,
            "province_name": "山东",
            "city_id": 187,
            "city_name": "菏泽"
        },
        {
            "dms_code": "WFA",
            "dealer_name": "潍坊中升仕豪汽车销售服务有限公司",
            "dealer_abbr": "潍坊中升仕豪",
            "province_id": 25,
            "province_name": "山东",
            "city_id": 465,
            "city_name": "潍坊"
        },
        {
            "dms_code": "YTA",
            "dealer_name": "烟台润捷汽车销售服务有限公司",
            "dealer_abbr": "烟台润捷",
            "province_id": 25,
            "province_name": "山东",
            "city_id": 557,
            "city_name": "烟台"
        },
        {
            "dms_code": "ZBA",
            "dealer_name": "淄博宝信汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 25,
            "province_name": "山东",
            "city_id": 570,
            "city_name": "淄博"
        },
        {
            "dms_code": "QDH",
            "dealer_name": "青岛唯圆达汽车销售服务有限公司\t\t",
            "dealer_abbr": "青岛唯圆达",
            "province_id": 25,
            "province_name": "山东",
            "city_id": 349,
            "city_name": "青岛"
        },
        {
            "dms_code": "SDG",
            "dealer_name": "德州吉星汽车销售服务有限公司",
            "dealer_abbr": "捷豹路虎德州吉星4S中心",
            "province_id": 25,
            "province_name": "山东",
            "city_id": 92,
            "city_name": "德州"
        },
        {
            "dms_code": "YTB",
            "dealer_name": "烟台中升仕豪汽车销售服务有限公司\t\t",
            "dealer_abbr": "烟台中升仕豪",
            "province_id": 25,
            "province_name": "山东",
            "city_id": 557,
            "city_name": "烟台"
        },
        {
            "dms_code": "CHA",
            "dealer_name": "长治市顺驰路捷汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 28,
            "province_name": "山西",
            "city_id": 61,
            "city_name": "长治"
        },
        {
            "dms_code": "DTA",
            "dealer_name": "大同市御东路华汽车贸易有限公司",
            "dealer_abbr": NaN,
            "province_id": 28,
            "province_name": "山西",
            "city_id": 82,
            "city_name": "大同"
        },
        {
            "dms_code": "LFB",
            "dealer_name": "临汾尧都路华汽车销售有限公司",
            "dealer_abbr": NaN,
            "province_id": 28,
            "province_name": "山西",
            "city_id": 278,
            "city_name": "临汾"
        },
        {
            "dms_code": "TYB",
            "dealer_name": "山西路华汽车销售有限公司",
            "dealer_abbr": NaN,
            "province_id": 28,
            "province_name": "山西",
            "city_id": 452,
            "city_name": "太原"
        },
        {
            "dms_code": "TYC",
            "dealer_name": "山西顺驰路捷汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 28,
            "province_name": "山西",
            "city_id": 452,
            "city_name": "太原"
        },
        {
            "dms_code": "YUA",
            "dealer_name": "运城大昌汽车贸易有限公司",
            "dealer_abbr": NaN,
            "province_id": 28,
            "province_name": "山西",
            "city_id": 542,
            "city_name": "运城"
        },
        {
            "dms_code": "CDB",
            "dealer_name": "成都惠通陆华汽车销售服务有限公司",
            "dealer_abbr": "成都惠通陆华",
            "province_id": 24,
            "province_name": "四川",
            "city_id": 40,
            "city_name": "成都"
        },
        {
            "dms_code": "CDC",
            "dealer_name": "成都运通博捷汽车销售有限公司 ",
            "dealer_abbr": "成都运通博捷",
            "province_id": 24,
            "province_name": "四川",
            "city_id": 40,
            "city_name": "成都"
        },
        {
            "dms_code": "CDD",
            "dealer_name": "成都合力创汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 24,
            "province_name": "四川",
            "city_id": 40,
            "city_name": "成都"
        },
        {
            "dms_code": "CDE",
            "dealer_name": "成都中升仕豪汽车销售服务有限公司",
            "dealer_abbr": "成都中升仕豪",
            "province_id": 24,
            "province_name": "四川",
            "city_id": 40,
            "city_name": "成都"
        },
        {
            "dms_code": "LSA",
            "dealer_name": "乐山南菱汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 24,
            "province_name": "四川",
            "city_id": 283,
            "city_name": "乐山"
        },
        {
            "dms_code": "MYA",
            "dealer_name": "绵阳路威汽车销售有限公司 ",
            "dealer_abbr": "绵阳路威",
            "province_id": 24,
            "province_name": "四川",
            "city_id": 310,
            "city_name": "绵阳"
        },
        {
            "dms_code": "SCA",
            "dealer_name": "攀枝花跃鹿汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 24,
            "province_name": "四川",
            "city_id": 348,
            "city_name": "攀枝花"
        },
        {
            "dms_code": "SCB",
            "dealer_name": "泸州惠通陆华汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 24,
            "province_name": "四川",
            "city_id": 630,
            "city_name": "四川省其他"
        },
        {
            "dms_code": "SCC",
            "dealer_name": "德阳南菱港宏汽车销售服务有限公司",
            "dealer_abbr": "德阳南菱港宏",
            "province_id": 24,
            "province_name": "四川",
            "city_id": 85,
            "city_name": "德阳"
        },
        {
            "dms_code": "SCE",
            "dealer_name": "南充永达路捷汽车销售服务有限公司",
            "dealer_abbr": "南充永达路捷",
            "province_id": 24,
            "province_name": "四川",
            "city_id": 316,
            "city_name": "南充"
        },
        {
            "dms_code": "CDH",
            "dealer_name": "成都运通晟捷汽车销售服务有限公司\t\t",
            "dealer_abbr": "成都运通晟捷",
            "province_id": 24,
            "province_name": "四川",
            "city_id": 40,
            "city_name": "成都"
        },
        {
            "dms_code": "SCD",
            "dealer_name": "眉山捷路汽车销售服务有限公司",
            "dealer_abbr": "眉山捷路",
            "province_id": 24,
            "province_name": "四川",
            "city_id": 307,
            "city_name": "眉山"
        },
        {
            "dms_code": "SCF",
            "dealer_name": "达州市奥捷汽车销售服务有限公司",
            "dealer_abbr": "达州奥捷",
            "province_id": 24,
            "province_name": "四川",
            "city_id": 649,
            "city_name": "达州"
        },
        {
            "dms_code": "TBA",
            "dealer_name": "西藏通孚祥汽车销售服务有限公司",
            "dealer_abbr": "西藏通孚祥",
            "province_id": 32,
            "province_name": "西藏",
            "city_id": 284,
            "city_name": "拉萨"
        },
        {
            "dms_code": "XJA",
            "dealer_name": "新疆惠通陆华汽车销售有限公司",
            "dealer_abbr": "新疆惠通陆华",
            "province_id": 31,
            "province_name": "新疆",
            "city_id": 458,
            "city_name": "乌鲁木齐"
        },
        {
            "dms_code": "XJB",
            "dealer_name": "乌鲁木齐汇嘉路捷汽车销售服务有限公司",
            "dealer_abbr": "汇嘉路捷",
            "province_id": 31,
            "province_name": "新疆",
            "city_id": 458,
            "city_name": "乌鲁木齐"
        },
        {
            "dms_code": "KMA",
            "dealer_name": "云南路捷汽车销售有限公司",
            "dealer_abbr": "云南路捷",
            "province_id": 33,
            "province_name": "云南",
            "city_id": 245,
            "city_name": "昆明"
        },
        {
            "dms_code": "KMB",
            "dealer_name": "云南中致远路威汽车销售服务有限公司",
            "dealer_abbr": "云南中致远路威",
            "province_id": 33,
            "province_name": "云南",
            "city_id": 245,
            "city_name": "昆明"
        },
        {
            "dms_code": "KMD",
            "dealer_name": "云南英茂路旗汽车贸易有限公司",
            "dealer_abbr": NaN,
            "province_id": 33,
            "province_name": "云南",
            "city_id": 245,
            "city_name": "昆明"
        },
        {
            "dms_code": "QJA",
            "dealer_name": "曲靖市中致远路威汽车销售服务有限公司",
            "dealer_abbr": "曲靖路威",
            "province_id": 33,
            "province_name": "云南",
            "city_id": 361,
            "city_name": "曲靖"
        },
        {
            "dms_code": "YND",
            "dealer_name": "大理路捷汽车销售服务有限公司",
            "dealer_abbr": "大理路捷",
            "province_id": 33,
            "province_name": "云南",
            "city_id": 76,
            "city_name": "大理"
        },
        {
            "dms_code": "KME",
            "dealer_name": "昆明中升仕豪汽车销售服务有限公司",
            "dealer_abbr": "昆明中升仕豪",
            "province_id": 33,
            "province_name": "云南",
            "city_id": 245,
            "city_name": "昆明"
        },
        {
            "dms_code": "HZC",
            "dealer_name": "杭州路德行汽车有限公司",
            "dealer_abbr": "杭州路德行",
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 190,
            "city_name": "杭州"
        },
        {
            "dms_code": "HZD",
            "dealer_name": "杭州运通和乔汽车销售服务有限公司",
            "dealer_abbr": "杭州运通和乔",
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 190,
            "city_name": "杭州"
        },
        {
            "dms_code": "HZE",
            "dealer_name": "浙江路德行汽车有限公司",
            "dealer_abbr": "浙江路德行",
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 190,
            "city_name": "杭州"
        },
        {
            "dms_code": "HZF",
            "dealer_name": "湖州永达路宝汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 186,
            "city_name": "湖州"
        },
        {
            "dms_code": "JHA",
            "dealer_name": "义乌市东昌汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 200,
            "city_name": "金华"
        },
        {
            "dms_code": "JHB",
            "dealer_name": "金华恒龙汽车有限公司",
            "dealer_abbr": NaN,
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 200,
            "city_name": "金华"
        },
        {
            "dms_code": "JHC",
            "dealer_name": "金华英豪汽车有限公司",
            "dealer_abbr": NaN,
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 200,
            "city_name": "金华"
        },
        {
            "dms_code": "JXA",
            "dealer_name": "嘉兴天华汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 225,
            "city_name": "嘉兴"
        },
        {
            "dms_code": "JXB",
            "dealer_name": "海宁路德行汽车有限公司",
            "dealer_abbr": "海宁路德行",
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 172,
            "city_name": "海宁"
        },
        {
            "dms_code": "LHA",
            "dealer_name": "丽水东昌汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 277,
            "city_name": "丽水"
        },
        {
            "dms_code": "NBA",
            "dealer_name": "宁波丰颐汽车销售有限公司",
            "dealer_abbr": "宁波丰颐",
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 314,
            "city_name": "宁波"
        },
        {
            "dms_code": "NBB",
            "dealer_name": "宁波天华汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 314,
            "city_name": "宁波"
        },
        {
            "dms_code": "NBC",
            "dealer_name": "慈溪路德行汽车有限公司",
            "dealer_abbr": "宝利德路德行捷豹路虎慈溪体验中心",
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 57,
            "city_name": "慈溪"
        },
        {
            "dms_code": "NBF",
            "dealer_name": "宁波永达路捷汽车销售服务有限公司",
            "dealer_abbr": "宁波永达路捷",
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 314,
            "city_name": "宁波"
        },
        {
            "dms_code": "QHA",
            "dealer_name": "衢州恒龙汽车有限公司",
            "dealer_abbr": NaN,
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 365,
            "city_name": "衢州"
        },
        {
            "dms_code": "SXA",
            "dealer_name": "绍兴力虎汽车销售服务有限公司",
            "dealer_abbr": "绍兴力虎",
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 397,
            "city_name": "绍兴"
        },
        {
            "dms_code": "SXB",
            "dealer_name": "绍兴路德行汽车有限公司 ",
            "dealer_abbr": "绍兴路德行汽车有限公司 ",
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 397,
            "city_name": "绍兴"
        },
        {
            "dms_code": "SXC",
            "dealer_name": "诸暨宝利德汽车有限公司",
            "dealer_abbr": "诸暨宝利德",
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 397,
            "city_name": "绍兴"
        },
        {
            "dms_code": "TZA",
            "dealer_name": "台州中通汽车销售有限公司",
            "dealer_abbr": "台州中通",
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 453,
            "city_name": "台州"
        },
        {
            "dms_code": "TZB",
            "dealer_name": "台州国鸿汽车销售服务有限公司",
            "dealer_abbr": "台州国鸿",
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 453,
            "city_name": "台州"
        },
        {
            "dms_code": "WZA",
            "dealer_name": "温州东昌实业有限公司",
            "dealer_abbr": "温州东昌实业",
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 483,
            "city_name": "温州"
        },
        {
            "dms_code": "WZB",
            "dealer_name": "温州欧龙汽车销售有限公司",
            "dealer_abbr": NaN,
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 483,
            "city_name": "温州"
        },
        {
            "dms_code": "WZD",
            "dealer_name": "温州永达路捷汽车销售服务有限公司",
            "dealer_abbr": "温州永达路捷",
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 483,
            "city_name": "温州"
        },
        {
            "dms_code": "WZE",
            "dealer_name": "瑞安市永达路捷汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 483,
            "city_name": "温州"
        },
        {
            "dms_code": "WZF",
            "dealer_name": "温州新力虎汽车销售服务有限公司",
            "dealer_abbr": NaN,
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 483,
            "city_name": "温州"
        },
        {
            "dms_code": "WZG",
            "dealer_name": "苍南中瑞汽车销售服务有限公司",
            "dealer_abbr": "苍南中瑞",
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 483,
            "city_name": "温州"
        },
        {
            "dms_code": "NBE",
            "dealer_name": "宁波颐泽汽车销售服务有限公司\t\t",
            "dealer_abbr": "宁波颐泽",
            "province_id": 34,
            "province_name": "浙江",
            "city_id": 564,
            "city_name": "余姚"
        },
        {
            "dms_code": "SHM",
            "dealer_name": "上海真北天华汽车销售服务有限公司",
            "dealer_abbr": "上海真北天华",
            "province_id": 26,
            "province_name": "上海",
            "city_id": 396,
            "city_name": "上海"
        },
        {
            "dms_code": "GDK",
            "dealer_name": "湛江港昌汽车服务有限公司",
            "dealer_abbr": "湛江港昌",
            "province_id": 6,
            "province_name": "广东",
            "city_id": 585,
            "city_name": "湛江"
        }
    ]

    var dealerdata = {}

    originData.forEach(function(e, i) {
        if (!dealerdata.hasOwnProperty(e.province_id)) {
            dealerdata[e.province_id] = {}
            dealerdata[e.province_id]['ProvinceName'] = e.province_name
        }
        if (!dealerdata[e.province_id].hasOwnProperty(e.city_id)) {
            dealerdata[e.province_id][e.city_id] = {}
            dealerdata[e.province_id][e.city_id]['CityName'] = e.city_name
        }
        if (!dealerdata[e.province_id][e.city_id].hasOwnProperty('Dealers')) {
            dealerdata[e.province_id][e.city_id]['Dealers'] = []
        }
        dealerdata[e.province_id][e.city_id]['Dealers'].push({
            Name: e.dealer_name,
            Code: e.dms_code
        })
    })

    function dealerLinkage(provinceName, cityName, dealerName) {
        var $provinces = $('select[name=' + provinceName + ']');
        var $cities = $('select[name=' + cityName + ']');
        var $dealers = $('select[name=' + dealerName + ']');

        $provinces.empty().append($('<option>', {
            text: '省份',
            value: ''
        }));
        $cities.empty().append($('<option>', {
            text: '城市',
            value: ''
        }));

        dealerName && $dealers.empty().append($('<option>', {
            text: '经销商',
            value: ''
        }));

        $.each(dealerdata, function(k, v) {
            $provinces.append($('<option>', {
                value: k,
                text: v.ProvinceName
            }));
	    delete v.ProvinceName
        });

        $provinces.change(function() {
            var cities = dealerdata[this.value]

            $cities.empty().append($('<option>', {
                text: '城市',
                value: ''
            }));
            cities && $.each(cities, function(k, v) {
                $cities.append($('<option>', {
                    value: k,
                    text: v.CityName
                }));
            });
            $cities.change();

            if (dealerName) {
                $dealers.empty().append($('<option>', {
                    text: '经销商',
                    value: ''
                }));
                $dealers.change();
            }
        });

        if (dealerName) {
            $cities.change(function() {
                var dealers = dealerdata[$provinces.val()] && dealerdata[$provinces.val()][this.value] && dealerdata[$provinces.val()][this.value]['Dealers']

                $dealers.empty().append($('<option>', {
                    text: '经销商',
                    value: ''
                }));

                $.each(dealers, function(k, v) {
                    $dealers.append($('<option>', {
                        value: v.Code,
                        text: v.Name
                    }));
                });

                $dealers.change();
            });

        }
    }

    dealer.dealerLinkage = dealerLinkage

    return dealer
})(jQuery, window.dealer || {})
