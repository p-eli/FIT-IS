#!/usr/bin/python3
__author__ = 'Jakub Pelikan'
from fitIS.gui.userSetting import UserSetting
from fitIS.gui.systemTrayIcon import SystemTrayIcon
from fitIS.gui.language import Languge
from fitIS.gui.willcomeGui import WillcomeGui

from PyQt4 import QtGui
import os


class Gui():
    """
    The Head class through which is run GUI application.
    @author Jakub Pelikan
    @version 1.0
    @package fitIS.gui
    """
    ## The constructor
    def __init__(self):
        self.setting = {'userSetting':UserSetting(), 'path':self.getPath(), 'style':None, 'language':None}
        app = QtGui.QApplication(['FIT IS'])
        self.screenResolution = app.desktop().screenGeometry()
        if not os.path.exists(self.setting['userSetting'].saveFile['path']):
            os.makedirs(self.setting['userSetting'].saveFile['path'])
        if not self.setting['userSetting'].saveFile['fileName'] in os.listdir(self.setting['userSetting'].saveFile['path']):
            self.runWillcome()
        else:
            self.runSystemTray()
        app.exec_()

    ## Method which show Willcome window
    def runWillcome(self):
        self.setting['language'] = Languge(self.setting)
        self.setScreenResolution()
        self.openColorSchema()
        self.trayIconGui = WillcomeGui(self.setting, self)

    ## Method which add application icon to System tray.
    def runSystemTray(self):
        self.setting['userSetting'] = self.setting['userSetting'].load()
        self.setScreenResolution()
        self.setting['userSetting'].path = self.setting['path']
        self.setting['language'] = Languge(self.setting)
        self.openColorSchema()
        self.trayIconGui = SystemTrayIcon(self.setting)

    ## Open file with .qss color schema.
    def openColorSchema(self):
        with open(os.path.join(self.setting['path'],self.setting['userSetting'].getColorSchema()),"r", encoding='utf-8') as style:
            self.setting['style'] = style.read()

    ## Method return package location.
    def getPath(self):
        root = __file__
        if os.path.islink(root):
            root = os.path.realpath(root)
        return(os.path.dirname (os.path.abspath (root)))

    ## Method add to application setting screen resolution.
    def setScreenResolution(self):
        self.setting['userSetting'].resolution['width'] = self.screenResolution.width()
        self.setting['userSetting'].resolution['height'] = self.screenResolution.height()