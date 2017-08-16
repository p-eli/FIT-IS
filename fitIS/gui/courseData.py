#!/usr/bin/python3
__author__ = 'Jakub Pelikan'
import httplib2
from fitIS.xmlParser.xmlValidatorParser import XmlValidatorParser
from PyQt4 import QtCore
import os


class CourseData(QtCore.QThread):
    """
    CourseData is instance of QThread. Download data from FIT IS and check changes.
    @author Jakub Pelikan
    @version 1.0
    @package fitIS.gui
    """
    success = QtCore.pyqtSignal()
    loginFailed = QtCore.pyqtSignal()
    connectionFailed = QtCore.pyqtSignal()
    notifySend = QtCore.pyqtSignal()
    wakeUp = QtCore.pyqtSignal()

    ## The constructor
    # @param setting Application setting.
    # @param notify Class that Send notify message.
    # @param notifyNoChanges Define if send message when isn't changes in system.
    def __init__(self, setting,notify=None, notifyNoChanges=False):
        QtCore.QThread.__init__(self,None)
        self.notifyNoChanges = notifyNoChanges
        self.setting = setting
        self._ = self.setting['language'].gettext
        if not 'xsdFile' in self.setting:
            self.openXsdFile()
        self.xmlFile = None
        self.cond = True
        if not 'trayIcon' in self.setting:
            self.notify = None
        else:
            self.notify = notify

    ## Method open Xsd file
    def openXsdFile(self):
        with open(os.path.join(self.setting['path'],self.setting['userSetting'].setting['xsdFile']),"r", encoding='utf-8') as file:
            self.setting['xsdFile'] = file.read()

    ## Open XML document for testing account
    def openXmlFile(self):
        with open(os.path.join(self.setting['path'],self.setting['userSetting'].testAccount['testXmlFile']),"r", encoding='utf-8') as file:
            self.xmlFile = file.read()

    ## Method download XML file from Information system
    def download(self):
        h=httplib2.Http(ca_certs = os.path.join(self.setting['path'],self.setting['userSetting'].cert['location']), timeout=60)
        h.add_credentials(self.setting['userSetting'].username, self.setting['userSetting'].password)
        try:
            resp, content = h.request(self.setting['userSetting'].setting['xmlUrl'], "POST", body="foobar")
        except httplib2.HttpLib2Error:
            if self.notify != None:
                self.notify.setMessage(self._("wis"),self._('ConnectionError'))
                self.notifySend.emit()
            self.connectionFailed.emit()
            self.cond = False
            return
        except FileNotFoundError:
            self.loginFailed.emit()
            self.cond = False
            return
        if 'status' in resp and resp['status'] == '200':
            self.xmlFile = content.decode('utf-8')
        elif 'status' in resp and resp['status'] == '401':
            if self.notify != None:
                self.notify.setMessage(self._("wis"),self._('loginFailed'))
                self.notifySend.emit()
            self.loginFailed.emit()
            self.cond = False
            return
        else:
            if self.notify != None:
                self.notify.setMessage(self._("wis"),self._('ConnectionError'))
                self.notifySend.emit()
            self.connectionFailed.emit()
            self.cond = False
            return

    ## Override run method
    def run(self):
        if self.setting['userSetting'].username == self.setting['userSetting'].testAccount['username'] and self.setting['userSetting'].password == self.setting['userSetting'].testAccount['password']:
            self.openXmlFile()
        else:
            self.download()
        if self.cond:
            try:
                self.checkChange()
            except:
                pass

    ## Method search changes in download data
    def checkChange(self):
        if self.notify != None:
            cond = True
            if self.xmlFile != self.setting['userSetting'].xmlFile:
                try:
                    pars = XmlValidatorParser(self.xmlFile,self.setting['xsdFile'])
                    root = pars.root
                except Exception as e:
                    if self.notify != None and len(e.args) != 0:
                        self.notify.setMessage(self._("wis"),format(str(e.args[0])))
                        self.notifySend.emit()
                        self.connectionFailed.emit()
                    return
                if self.setting['userSetting'].courses == []:
                    cond = False
                else:
                    for x in root.child:
                        for y in self.setting['userSetting'].courses:
                                if y.attribute['abbrv'] == x.attribute['abbrv']:
                                    if not self.compareChange(x,y):
                                        cond = False
                                    break
                if len(root.child) != len(self.setting['userSetting'].courses):
                    cond = False
                if not cond:
                    self.setting['userSetting'].courses = root.child
                    self.setting['userSetting'].save()
                else:
                    if self.setting['userSetting'].xmlFile == None and self.notifyNoChanges:
                        self.notify.setMessage(self._("wis"), self._("noChanges"))
                        self.notifySend.emit()
                self.setting['userSetting'].xmlFile = self.xmlFile
            else:
                if self.notifyNoChanges:
                        self.notify.setMessage(self._("wis"), self._("noChanges"))
                        self.notifySend.emit()
        self.success.emit()

    ## Method find changes in courses and create notify message text
    # @param courses New download courses with changes.
    # @param coursesOld Old courses.
    def compareChange(self, courses, coursesOld):
        diff = []
        for x in courses.attribute:
            if courses.attribute[x] != coursesOld.attribute[x]:
                diff.append(x)
        diff1 = []
        for x in courses.child:
            if x.tag == 'accreditation':
                for y in coursesOld.child:
                    if y.tag == 'accreditation':
                        if x.attribute['status'] != y.attribute['status']:
                            diff1.append(['status',x.attribute['status'],y.attribute['status']])
                        break
                break
        for x in courses.child:
            if x.tag == 'examination':
                for y in coursesOld.child:
                    if y.tag == 'examination':
                        if x.attribute['grade'] != y.attribute['grade']:
                            diff1.append(['examination',x.attribute['grade'],y.attribute['grade']])
                        break
                break
        if diff != [] or diff1 != []:
            msg = '\t'
            for x in diff1:
                msg = msg + x[0] + ' : ' + x[2] + ' --> ' + x[1] + '\n\t'
            for x in diff:
                msg = msg + x + ' : ' + coursesOld.attribute[x] + ' --> ' + courses.attribute[x] + '\n\t'
            self.notify.setMessage(courses.attribute['abbrv'], msg)
            self.notifySend.emit()
            return False
        return True