# -*- coding:utf-8 -*-
import ctypes
import threading
import os
import socket
import json
import httplib
import urllib2
import urllib
import uuid
import zipfile
import base64
import sys
import hashlib
import datetime
import time
import subprocess
import xml.dom.minidom
from biplist import *


def commom_log(filename, content , write_type='wb'):
    try:
        f = open(filename , write_type)
        f.write(content);
        f.close()
    except:
        print('happen an exception when write file')
        return ""

def getInfoPlist(random_filename):
    try:
        zf       = zipfile.ZipFile(random_filename, "r")
        nList    = zf.namelist()
        type_val = 0
        BundleId = ''
        CFBundleShortVersionString = ''
        CFBundleVersion = ''
        MinimumOSVersion = ''
        CFBundleSDKVersionString=''
        for f in nList:
            if f.rfind('Info.plist') != -1:
                f_arr = f.split("/")
                if len(f_arr) == 3:
                    if(f_arr[2] == 'Info.plist'):
                        info     = zf.read(f)
                        plist    = readPlistFromString(info)
                        BundleId = plist['CFBundleIdentifier']

                        if plist.has_key('CFBundleShortVersionString'):
                            CFBundleShortVersionString = plist['CFBundleShortVersionString']
                        else:
                            CFBundleShortVersionString = ''
                        if plist.has_key('CFBundleVersion'):
                            CFBundleVersion = plist['CFBundleVersion']
                        else:
                            CFBundleVersion = ''
                        if plist.has_key('MinimumOSVersion'):
                            MinimumOSVersion = plist['MinimumOSVersion']
                        else:
                            MinimumOSVersion = ''
            elif f.rfind('sdk_version.plist') != -1:
                info     = zf.read(f)
                plist    = readPlistFromString(info)
                if plist.has_key('sdk_version'):
                    CFBundleSDKVersionString = plist['sdk_version']

        return {"bundleid": BundleId, "version" : CFBundleShortVersionString,
                "bundleVersion" : CFBundleVersion,
                "minimum_os_version" : MinimumOSVersion,
                'sdk_version':CFBundleSDKVersionString}
		
    except:
        return '','','',''

if len(sys.argv) <=1 :
    print "-1"
else:
    random_filename = sys.argv[1]
    if os.path.exists(random_filename):
        BundleId = getInfoPlist(random_filename)
        print json.dumps(BundleId)
    else:
        print "-2"