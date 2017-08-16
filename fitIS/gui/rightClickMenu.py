#!/usr/bin/python3
__author__ = 'Jakub Pelikan'
from PyQt4 import QtGui,QtCore
from fitIS.gui.settingGui import SettingGui
from fitIS.gui.coursesGui import CoursesGui
from fitIS.gui.courseData import CourseData
from fitIS.gui.coursesGuiComponent import HorizontalSeparator
from fitIS.gui.sendNotify import SendNotify


class RightClickMenu(QtGui.QMenu):
    """
    Language class enable use more language.
    @author Jakub Pelikan
    @version 1.0
    @package fitIS.gui
    """
    ## The constructor
    # @param setting Application setting.
    def __init__(self, setting, parent=None):
        QtGui.QMenu.__init__(self,'menu', parent)
        self.setting = setting
        self._ = self.setting['language'].gettext
        self.notify = SendNotify(self.setting)
        self.thread = None
        if self.setting['userSetting'].trayMenu['style']:
            self.initMenu()
        else:
            self.initStandartMenu()
        self.threadInterval = None

    ## Initialize standard menu in system style.
    def initStandartMenu(self):
        #CHECKCHANGE BUTTON
        self.checkChangeButton = QtGui.QAction(QtGui.QIcon(self.setting['userSetting'].getImage('refreshIcon', self.setting['path'])),self._('checkChangeButton'),self)
        self.checkChangeButton.setIconVisibleInMenu(True)
        self.checkChangeButton.triggered.connect(self.checkChange)
        self.addAction(self.checkChangeButton)
        self.addSeparator()

        #AUTOCHECK BUTTON
        self.autoCheckButton = QtGui.QAction(self)
        self.initAutoCheckStandart()
        self.autoCheckButton.setIconVisibleInMenu(True)
        self.autoCheckButton.triggered.connect(self.autoChangeOnOffStandart)
        self.addAction(self.autoCheckButton)

        #SHOW BUTTON
        self.addSeparator()
        self.showButton = QtGui.QAction(QtGui.QIcon(self.setting['userSetting'].getImage('showIcon', self.setting['path'])),self._('ShowButton'),self)
        self.showButton.setIconVisibleInMenu(True)
        self.showButton.triggered.connect(self.showCourses)
        self.addAction(self.showButton)

        #SETTING BUTTON
        self.settingButton = QtGui.QAction(QtGui.QIcon(self.setting['userSetting'].getImage('settingIcon', self.setting['path'])),self._('SettingButton'),self)
        self.settingButton.setIconVisibleInMenu(True)
        self.settingButton.triggered.connect(self.showSetting)
        self.addAction(self.settingButton)

        #EXIT BUTTON
        self.addSeparator()
        self.closeButton = QtGui.QAction(QtGui.QIcon(self.setting['userSetting'].getImage('exitIcon', self.setting['path'])),self._('CloseButton'),self)
        self.closeButton.setIconVisibleInMenu(True)
        self.closeButton.triggered.connect(self.exitAction)
        self.addAction(self.closeButton)

    def checkChange(self):
        self.thread = CourseData(self.setting,self.notify, True)
        self.thread.notifySend.connect(self.notify.sendMessage)
        self.thread.start()

    ## Initialize menu in style which is define qss file.
    def initMenu(self):
        self.click = False
        self.setStyleSheet(self.setting['style'])
        self.setObjectName('leftClickMenu')

        #AUTOCHECK BUTTON
        autoCheckWidget = QtGui.QWidget()
        autoCheckWidget.setObjectName('leftClickMenuButton')
        layout = QtGui.QHBoxLayout(autoCheckWidget)
        self.autoCheckButton = QtGui.QLabel()
        self.autoCheckButton.setObjectName('leftClickMenuFont')
        self.initAutoCheck()
        self.autoCheckButton.installEventFilter(self)
        layout.addWidget(self.autoCheckButton)
        action = QtGui.QWidgetAction(self)
        action.setDefaultWidget(autoCheckWidget)
        self.addAction(action)

        separatorWidget = QtGui.QWidget()
        layout = QtGui.QHBoxLayout(separatorWidget)
        layout.addWidget(HorizontalSeparator('orangeSeparator'))
        action = QtGui.QWidgetAction(self)
        action.setDefaultWidget(separatorWidget)
        self.addAction(action)

        #SHOW BUTTON
        showWidget = QtGui.QWidget()
        showWidget.setObjectName('leftClickMenuButton')
        layout = QtGui.QHBoxLayout(showWidget)
        self.showButton = QtGui.QLabel()
        self.showButton.setObjectName('leftClickMenuFont')
        self.showButton.setTextFormat(QtCore.Qt.RichText)
        self.showButton.setText("<img src="+self.setting['userSetting'].getImage('showIcon', self.setting['path'])+" height=\"18\" >  "+self._('ShowButton'))
        self.showButton.installEventFilter(self)
        layout.addWidget(self.showButton)
        action = QtGui.QWidgetAction(self)
        action.setDefaultWidget(showWidget)
        self.addAction(action)

        separatorWidget = QtGui.QWidget()
        layout = QtGui.QHBoxLayout(separatorWidget)
        layout.addWidget(HorizontalSeparator())
        action = QtGui.QWidgetAction(self)
        action.setDefaultWidget(separatorWidget)
        self.addAction(action)

        #SETTING BUTTON
        settingWidget = QtGui.QWidget()
        settingWidget.setObjectName('leftClickMenuButton')
        layout = QtGui.QVBoxLayout(settingWidget)
        self.settingButton = QtGui.QLabel()
        self.settingButton.setObjectName('leftClickMenuFont')
        self.settingButton.setTextFormat(QtCore.Qt.RichText)
        self.settingButton.setText("<img src="+self.setting['userSetting'].getImage('settingIcon', self.setting['path'])+" height=\"18\" >  "+self._('SettingButton'))
        self.settingButton.installEventFilter(self)
        layout.addWidget(self.settingButton)

        action = QtGui.QWidgetAction(self)
        action.setDefaultWidget(settingWidget)
        self.addAction(action)

        separatorWidget = QtGui.QWidget()
        layout = QtGui.QHBoxLayout(separatorWidget)
        layout.addWidget(HorizontalSeparator())
        action = QtGui.QWidgetAction(self)
        action.setDefaultWidget(separatorWidget)
        self.addAction(action)

        #EXIT BUTTON
        exitWidget = QtGui.QWidget()
        exitWidget.setObjectName('leftClickMenuButton')
        layout = QtGui.QHBoxLayout(exitWidget)
        self.closeButton = QtGui.QLabel()
        self.closeButton.setObjectName('leftClickMenuFont')
        self.closeButton.setTextFormat(QtCore.Qt.RichText)
        self.closeButton.setText("<img src="+self.setting['userSetting'].getImage('exitIcon', self.setting['path'])+" height=\"18\" >  "+self._('CloseButton'))
        self.closeButton.installEventFilter(self)
        layout.addWidget(self.closeButton)
        action = QtGui.QWidgetAction(self)
        action.setDefaultWidget(exitWidget)
        self.addAction(action)

    ## Override exit Action method.
    def exitAction(self):
        self.autoCheckStop()
        exit()

    ## Initialize GUI class CoursesGui
    def showCourses(self):
        self.coursesGui = CoursesGui(self.setting)

    ## Initialize GUI class SettingGui
    def showSetting(self):
        self.settingGui = SettingGui(self.setting, self)

    ## Start automatic check changes in system and set timer
    def autoCheckStart(self):
        self.autoCheckThreadStart()
        self.threadInterval = QtCore.QTimer(self)
        self.threadInterval.timeout.connect(self.autoCheckThreadStart)
        self.threadInterval.start(self.setting['userSetting'].autoCheck['time']*60000)

    ## Start automatic check changes thread
    def autoCheckThreadStart(self):
        if self.thread == None or self.thread.isFinished():
            self.thread = CourseData(self.setting,self.notify)
            self.thread.notifySend.connect(self.notify.sendMessage)
            self.thread.start()

    ## Stop automatic check changes
    def autoCheckStop(self):
        if self.threadInterval != None:
            self.threadInterval.stop()
            self.threadInterval = None

    ## Start autocheck button On.
    def setAutocheckButtonOn(self):
        icon = QtGui.QIcon()
        icon.addPixmap(QtGui.QPixmap(self.setting['userSetting'].getImage('checkedIcon', self.setting['path'])), QtGui.QIcon.Normal)
        icon.addPixmap(QtGui.QPixmap(self.setting['userSetting'].getImage('uncheckedIcon', self.setting['path'])), QtGui.QIcon.Active)
        self.autoCheckButton.setIcon(icon)
        self.autoCheckButton.setText(self._('autoCheckOn'))

    ## Start autocheck button Off
    def setAutocheckButtonOff(self):
        icon = QtGui.QIcon()
        icon.addPixmap(QtGui.QPixmap(self.setting['userSetting'].getImage('uncheckedIcon', self.setting['path'])), QtGui.QIcon.Normal)
        icon.addPixmap(QtGui.QPixmap(self.setting['userSetting'].getImage('checkedIcon', self.setting['path'])), QtGui.QIcon.Active)
        self.autoCheckButton.setIcon(icon)
        self.autoCheckButton.setText(self._('autoCheckOff'))

    ## Initialize autoCheck button in default system style
    def initAutoCheckStandart(self):
        if self.setting['userSetting'].autoCheck['on']:
            self.setAutocheckButtonOn()
            self.autoCheckStart()
        else:
            self.setAutocheckButtonOff()

    ##  Change auto check buton in default system style between on and off
    def autoChangeOnOffStandart(self):
        if self.setting['userSetting'].autoCheck['on']:
            self.autoCheckStop()
            self.setting['userSetting'].autoCheck['on'] = False
            self.setAutocheckButtonOff()
        else:
            self.autoCheckStart()
            self.setting['userSetting'].autoCheck['on'] = True
            self.setAutocheckButtonOn()
        self.setting['userSetting'].save()

    ##  Initialize autoCheck button in style which is define qss file
    def initAutoCheck(self):
        if self.setting['userSetting'].autoCheck['on']:
            self.autoCheckStat = True
            self.autoCheckStart()
            self.autoCheckButton.setTextFormat(QtCore.Qt.RichText)
            self.autoCheckButton.setText("<img src="+self.setting['userSetting'].getImage('checkedIcon', self.setting['path'])+" height=\"18\" >  "+self._('autoCheckOn'))
        else:
            self.autoCheckStat = False
            self.autoCheckButton.setTextFormat(QtCore.Qt.RichText)
            self.autoCheckButton.setText("<img src="+self.setting['userSetting'].getImage('uncheckedIcon', self.setting['path'])+" height=\"18\" >  "+self._('autoCheckOff'))

    ##  Method change text in autoCheck button in style which is define qss file when mouse enter
    def autoCheckToogleText(self, leave=False):
        if self.autoCheckStat:
            self.autoCheckStat = False
            if leave:
                self.autoCheckButton.setText("<img src="+self.setting['userSetting'].getImage('uncheckedIcon', self.setting['path'])+" height=\"18\" >  "+self._('autoCheckOff'))
            else:
                self.autoCheckButton.setText("<img src="+self.setting['userSetting'].getImage('uncheckedIcon', self.setting['path'])+" height=\"18\" >  "+self._('autoCheckStop'))
        else:
            self.autoCheckStat = True
            if leave:
                self.autoCheckButton.setText("<img src="+self.setting['userSetting'].getImage('checkedIcon', self.setting['path'])+" height=\"18\" >  "+self._('autoCheckOn'))
            else:
                self.autoCheckButton.setText("<img src="+self.setting['userSetting'].getImage('checkedIcon', self.setting['path'])+" height=\"18\" >  "+self._('autoCheckStart'))

    ##  Change auto check button in style which is define qss file between on and off
    def autoChangeOnOff(self):
        if self.setting['userSetting'].autoCheck['on']:
            self.autoCheckStop()
            self.setting['userSetting'].autoCheck['on'] = False
        else:
            self.autoCheckStart()
            self.setting['userSetting'].autoCheck['on'] = True
            self.autoCheckButton.setText("<img src="+self.setting['userSetting'].getImage('checkedIcon', self.setting['path'])+" height=\"18\" >  "+self._('autoCheckOn'))
        self.setting['userSetting'].save()

    ## Override event Filter
    # @param object Object which rise event.
    # @param event Event which is rise.
    def eventFilter(self, object, event):
        if event.type() == QtCore.QEvent.Enter:
            if object == self.autoCheckButton:
                self.autoCheckToogleText()
        elif event.type() == QtCore.QEvent.Leave:
            if object == self.autoCheckButton:
                if self.click:
                    self.click = False
                else:
                    self.autoCheckToogleText(True)
        elif event.type() == QtCore.QEvent.MouseButtonPress:
            if object == self.autoCheckButton:
                if self.click:
                    self.autoCheckToogleText()
                self.click = True
                self.autoChangeOnOff()
            elif object == self.settingButton:
                self.showSetting()
            elif object == self.showButton:
                self.showCourses()
            elif object == self.closeButton:
                self.exitAction()
        return False