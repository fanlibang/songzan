# -*- coding:utf-8 -*-
import traceback

__author__ = "yangsw"

import sys 
import os
import json
import re
import zipfile
from xml.dom import minidom
from axmlparserpy import axmlprinter


# ==============================================================================
APK_XML_NAME        = "AndroidManifest.xml"

# ==============================================================================
appInfo_pattern_str = "<manifest.*?versionCode=\"([^\"]*?)\".*?versionName=\"([^\"]*?)\".*?package=\"([^\"]*?)\""
appInfoPattern      = re.compile(appInfo_pattern_str)

# ==============================================================================


def get_app_info(appPath):
    """
    """
    try:
        with zipfile.ZipFile(appPath, "r") as zf:
            # 从info.plist中获取MinimumOSVersion信息
            infolist = zf.infolist()
            for zipinfo in infolist:
                if zipinfo.filename.find(APK_XML_NAME) >= 0:
                    # print zipinfo.filename
                    data    = zf.read(zipinfo.filename)
                    xmldata = axmlprinter.AXMLPrinter(data)
                    xmlTxt  = minidom.parseString(xmldata.getBuff()).toxml()
                    appInfo = appInfoPattern.findall(xmlTxt)
                    # print appInfo
                    if len(appInfo) == 0:
                        # print u"Failed to get APK info!"
                        return None
                    return appInfo[0]
            
            # print u"Not find the %s file !" % APK_XML_NAME
            return None
            # if data:
    except:
        print traceback.format_exc()
        # print u"Failed to get APK info!"
        return None


def get_app_info2(appPath):
    """
    """
    try:
        zf = zipfile.ZipFile(appPath, "r")
        # 从info.plist中获取MinimumOSVersion信息
        infolist = zf.infolist()
        for zipinfo in infolist:
            if zipinfo.filename.find(APK_XML_NAME) >= 0:
                # print zipinfo.filename
                data    = zf.read(zipinfo.filename)
                xmldata = axmlprinter.AXMLPrinter(data)
                xmlTxt  = minidom.parseString(xmldata.getBuff()).toxml()
                appInfo = appInfoPattern.findall(xmlTxt)
                # print appInfo
                if len(appInfo) == 0:
                    # print u"Failed to get APK info!"
                    return None
                return appInfo[0]

        # print u"Not find the %s file !" % APK_XML_NAME
        return None
        # if data:
    except:
        print traceback.format_exc()
        # print u"Failed to get APK info!"
        return None

if __name__ == "__main__":    
    if len(sys.argv) != 2:
        print "Invalid parameter !"
        # print ""
        exit(0)

    filename = sys.argv[1]
    # filename = "xy-1.0.7.0.apk"
    if not os.path.exists(filename):
        print "The file %s is not exist !" % (filename)
        # print ""
        exit(0)
    #ret = get_app_info(filename)
    ret_info = get_app_info2(filename)
    if ret_info:
        data = {"versioncode": ret_info[0], "version" : ret_info[1], "packagename" : ret_info[2]}
        print json.dumps(data)
    else:
        print "ret_info is None"