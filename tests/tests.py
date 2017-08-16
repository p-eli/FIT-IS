#!/usr/bin/python3
__author__ = 'Jakub Pelikan'
from fitIS.xmlParser.xmlValidatorParser import XmlValidatorParser
import os
import re
import sys

class bcolors:
    OKGREEN = '\033[92m'
    FAIL = '\033[91m'
    ENDC = '\033[0m'

if __name__ == "__main__":
    testTrue = os.listdir('./true/')
    testFalse = os.listdir('./false/')
    for x in testTrue:
        file = open('./true/'+x, 'r')
        data = file.read()
        file.close()
        data = data.split('***')
        try:
            sys.stdout = None
            result = XmlValidatorParser(re.sub('\n+', '',data[2]),re.sub('\n+', '',data[1]))
           # result = XmlValidatorParser(re.sub('\n+', '',data[2]),re.sub('\n+', '',data[1]))
            sys.stdout = sys.__stdout__
            print("TRUE test "+x+bcolors.OKGREEN +" : PASS"+ bcolors.ENDC)
          #  if str(result.root.returnChildTree()) == re.sub('\n+', '',data[3]):
       #         print("TRUE test "+x+bcolors.OKGREEN +" : PASS"+ bcolors.ENDC)
        #    else:
              #  print("TRUE test "+x+bcolors.FAIL +" : FAIL VALUE"+ bcolors.ENDC)
        except:
            sys.stdout = sys.__stdout__
            print("TRUE test "+x+bcolors.FAIL +" : FAIL"+ bcolors.ENDC)

    for x in testFalse:
        file = open('./false/'+x, 'r')
        data = file.read()
        file.close()
        data = data.split('***')
        try:
            sys.stdout = None
            XmlValidatorParser(re.sub('\n+', '',data[2]),re.sub('\n+', '',data[1]))
            sys.stdout = sys.__stdout__
            print("FALSE test "+x+bcolors.FAIL +" : FAIL"+ bcolors.ENDC)
        except:
            sys.stdout = sys.__stdout__
            print("FALSE test "+x+bcolors.OKGREEN +" : PASS"+ bcolors.ENDC)