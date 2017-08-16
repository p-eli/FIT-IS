#!/usr/bin/python3
__author__ = 'Jakub Pelikan'
import pickle
from pbkdf2 import PBKDF2
from Crypto.Cipher import AES
import os


class UserSetting():
    """
    UserSetting contain default and individual user setting.
    @author Jakub Pelikan
    @version 1.0
    @package fitIS.gui
    """
    ## The constructor
    def __init__(self):
        self.salt = os.urandom(8)
        self.passphrase = os.urandom(32)
        self.username = 'username'
        self.__password = self.encrypt('password')
        self.setting = { 'xdsUrl':None, 'xsdFile':os.path.join('xml','rules.xsd'),'xmlUrl':'https://wis.fit.vutbr.cz/FIT/st/get-coursesx.php'}
        self.cert = {'location':os.path.join('cert','cacert.crt'), 'default':True, 'defaultLocation':os.path.join('cert','cacert.crt')}
        self.autoCheck = {'on':True, 'time':10}
        self.courses = []
        self.sem = {'type':['Z','L'], 'show':'L'}
        self.xmlFile = None
        self.language = {'name':'Czech', 'shortcut':'cs','path':'lang', 'fileName':'lang'}
        self.colorSchema = {'path':'style', 'schema':'Teal', 'type':'.qss'}
        self.saveFile = {'path':os.path.join(os.path.expanduser("~"),'.wis'), 'fileName':'userSetting'}
        self.resolution = {'width':1280,'height':720}
        self.image = {'path':   'image','logo':'icon.png','logoWillcome':os.path.join('willcome','logo.png') , 'trayWillcome':os.path.join('willcome','trayWillcome.png'), 'leftClickWilcome':os.path.join('willcome','leftClickWilcome.png'), 'rightClickWilcome':os.path.join('willcome','rightClickWilcome.png'), 'showWilcome':os.path.join('willcome','showWilcome.png'),'settingWilcome':os.path.join('willcome','settingWilcome.png'), 'settingIcon':os.path.join('icon','setting.png'),'checkedIcon':os.path.join('icon','checked.png'),'uncheckedIcon':os.path.join('icon','unchecked.png'),'exitIcon':os.path.join('icon','exit.png'),'showIcon':os.path.join('icon','show.png'), 'refreshIcon':os.path.join('icon','refresh.png'), 'moreIcon':os.path.join('icon','more.png'),'lessIcon':os.path.join('icon','less.png')}
        self.willcomeImage = {'path':os.path.join('image','willcome')}
        self.trayMenu = {'style':False}
        self.testAccount = {'username':'xlogin00', 'password':'password', 'testXmlFile':os.path.join('xml','test.xml')}

    ## Method return actual language
    def getLanguage(self):
        return(self.language['name']+'_'+self.language['shortcut'])

    ## Method return image path
    # @param image Name of image
    # @param path Path of package folder
    def getImage(self,image,path = None):
        if path != None:
            return (os.path.join(path,self.image['path'],self.image[image]))
        return (os.path.join(self.image['path'],self.image[image]))

    ## Method return color Schema
    def getColorSchema(self):
        return (os.path.join(self.colorSchema['path'],self.colorSchema['schema']+self.colorSchema['type']))

    ## Property password
    @property
    def password(self):
        return self.decrypt(self.__password)

    @password.setter
    def password(self, passwd):
        self.__password = self.encrypt(passwd)

    ## Method save user setting as serialized object
    def save(self):
        with open(os.path.join(self.saveFile['path'],self.saveFile['fileName']), 'wb') as file:
            pickle.dump(self,file)

    ## Method load user setting from serialized object
    def load(self):
        try:
            with open(os.path.join(self.saveFile['path'],self.saveFile['fileName']), 'rb') as file:
                return pickle.load(file)
        except FileNotFoundError:
            return self

    ## Method encrypt password
    # @param password Password to encrypt
    def encrypt(self,password):
        iv = os.urandom(16)
        key = PBKDF2(self.passphrase, self.salt).read(32)
        cipher = AES.new(key, AES.MODE_CBC, iv)
        return iv + cipher.encrypt(password + ' '*(16 - (len(password) % 16)))

    ##Method decrypt password
    # @param ciphertext Crypted password
    def decrypt(self, ciphertext):
        key = PBKDF2(self.passphrase, self.salt).read(32)
        initVector = ciphertext[:16]
        ciphertext = ciphertext[16:]
        cipher = AES.new(key, AES.MODE_CBC, initVector)
        return cipher.decrypt(ciphertext).decode("utf-8").replace(' ','')