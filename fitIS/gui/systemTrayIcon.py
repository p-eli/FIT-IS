#!/usr/bin/python3
__author__ = 'Jakub Pelikan'
from PyQt4 import QtGui
from fitIS.gui.rightClickMenu import RightClickMenu
from fitIS.gui.courseData import CourseData
from fitIS.gui.sendNotify import SendNotify

class SystemTrayIcon(QtGui.QSystemTrayIcon):
    """
    SystemTrayIcon is instance of QSystemTrayIcon. Add application icon to system tray.
    @author Jakub Pelikan
    @version 1.0
    @package fitIS.gui
    """
    ## The constructor
    # @param setting Application setting.
    def __init__(self, setting, parent=None):
        QtGui.QSystemTrayIcon.__init__(self, parent)
        self.setting = setting
        self.setting['trayIcon'] = self
        self.initTray()
        self.notify = SendNotify(self.setting)
        self.show()

    ## Initialize tray icon
    def initTray(self):
        self.setIcon(QtGui.QIcon(self.setting['userSetting'].getImage('logo', self.setting['path'])))
        self.rightClick = RightClickMenu(self.setting)
        self.setContextMenu(self.rightClick)
        self.activated.connect(self.clickAction)

    ## Initialize click Action
    def clickAction(self, value):
        if value == self.Trigger:
            self.thread = CourseData(self.setting,self.notify, True)
            self.thread.notifySend.connect(self.notify.sendMessage)
            self.thread.start()