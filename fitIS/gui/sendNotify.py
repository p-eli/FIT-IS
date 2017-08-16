#!/usr/bin/python3
__author__ = 'Jakub Pelikan'
from platform import system
import os
from PyQt4 import QtGui


class SendNotify():
    """
    SendNotify class send notify. Notify information user about information system state.
    @author Jakub Pelikan
    @version 1.0
    @package fitIS.gui
    """
    ## The constructor
    # @param setting Application setting.
    def __init__(self, setting):
        self.setting = setting
        self._ = self.setting['language'].gettext
        self.platform = system()
        self.tray = self.setting['trayIcon']
        self.title = ''
        self.message = ''

    ## Method set text and title of notification
    # @param title Title of notification.
    # @param message Message of notification.
    def setMessage(self, title, message):
        self.title = title
        self.message = message

    ## Method send notification
    def sendMessage(self):
        if self.platform == 'Linux':
            stat = os.system("notify-send -u low \""+self.title+"\" \""+self.message+"\n\" --icon="+os.path.join(self.setting['path'],self.setting['userSetting'].getImage('logo')))
            if stat != 0:
                self.tray.showMessage( self.title, self.message, QtGui.QSystemTrayIcon.Information)
        else:
            self.tray.showMessage(self.title, self.message, QtGui.QSystemTrayIcon.Information)
