#!/usr/bin/python3
__author__ = 'Jakub Pelikan'
from PyQt4 import QtGui, QtCore
from fitIS.gui.coursesGuiComponent import ClickWidget, CallMetodButton, VerticalSeparator, HorizontalSeparator
import os
import re


class SettingGui(QtGui.QMainWindow):
    """
    SettingGui is instance of QMainWindow. Show application setting.
    @author Jakub Pelikán
    @version 1.0
    @package fitIS.gui
    """
    ## The constructor
    # @param setting Application setting.
    def __init__(self, setting, parent=None):
        QtGui.QMainWindow.__init__(self, parent)
        self.setting = setting
        self._ = self.setting['language'].gettext
        self.initWindow()
        self.initSetting()
        self.show()

    ## Initialize setting window
    def initWindow(self):
        self.setWindowIcon(QtGui.QIcon(self.setting['userSetting'].getImage('logo', self.setting['path'])))
        self.setWindowTitle(self._('SettingWindowsTitle'))
        self.setGeometry(self.setting['userSetting'].resolution['width']/3,self.setting['userSetting'].resolution['height']/8,1*self.setting['userSetting'].resolution['width']/3,3*self.setting['userSetting'].resolution['height']/4)
        self.setMinimumSize(450,600)
        self.setStyleSheet(self.setting['style'])

        scroollArea = QtGui.QScrollArea(self)
        scroollArea.setWidgetResizable(True)

        mainWidget = QtGui.QWidget()
        mainWidget.setObjectName('settingMainWidget')
        scroollArea.setWidget(mainWidget)

        settingWidget = QtGui.QWidget()
        settingWidget.setObjectName('mainWidget')

        settingLayout = QtGui.QGridLayout(settingWidget)
        widget = QtGui.QWidget()
        widget.setObjectName('borderWidget')
        settingLayout.addWidget(widget)
        layout = QtGui.QGridLayout(widget)

        layout.addWidget(scroollArea,0,0,10,1)
        layout.addWidget(self.initCloseSaveButton(),10,0,1,1)

        self.setCentralWidget(settingWidget)
        self.settingVBoxLayout = QtGui.QVBoxLayout(mainWidget)

    ## Initialize setting item
    def initSetting(self):
        self.settingVBoxLayout.addWidget(self.createWidget(self._('Username and password'),self.initUsernamePassword()))
        self.settingVBoxLayout.addWidget(HorizontalSeparator('whiteSeparator'))
        self.settingVBoxLayout.addWidget(self.createWidget(self._('AutoCheck'),self.initAutoCheck()))
        self.settingVBoxLayout.addWidget(HorizontalSeparator('whiteSeparator'))
        self.settingVBoxLayout.addWidget(self.createWidget(self._('Certificat choice'),self.initCert()))
        self.settingVBoxLayout.addWidget(HorizontalSeparator('whiteSeparator'))
        self.settingVBoxLayout.addWidget(self.createWidget(self._('Language'),self.languageWidget()))
        self.settingVBoxLayout.addWidget(HorizontalSeparator('whiteSeparator'))
        self.settingVBoxLayout.addWidget(self.createWidget(self._('Color schema'),self.colorWidget()))

    ## Initialize Username and Password widget
    def initUsernamePassword(self):
        userNamePasswordWidget = QtGui.QWidget()
        userNamePasswordWidget.setObjectName('userNamePasswordWidget')
        userNamePasswordGridLayout = QtGui.QGridLayout(userNamePasswordWidget)

        loginLabel = QtGui.QLabel(self._('Username'))
        loginLabel.setObjectName('userNamePasswordTitle')
        userNamePasswordGridLayout.addWidget(loginLabel,0,0,1,1)

        self.usernameLineEdit = QtGui.QLineEdit()
        self.usernameLineEdit.setObjectName('userNamePasswordValue')
        self.usernameLineEdit.setText(self.setting['userSetting'].username)
        userNamePasswordGridLayout.addWidget(self.usernameLineEdit,0,1,1,2)

        userNamePasswordGridLayout.addWidget(HorizontalSeparator('greySeparator'),1,0,1,3)

        passwordLabel = QtGui.QLabel(self._('Password'))
        passwordLabel.setObjectName('userNamePasswordTitle')
        userNamePasswordGridLayout.addWidget(passwordLabel,2,0,1,1)

        self.passwordLineEdit = QtGui.QLineEdit()
        self.passwordLineEdit.setObjectName('userNamePasswordValue')
        self.passwordLineEdit.setText(self.setting['userSetting'].password)
        self.passwordLineEdit.setEchoMode(QtGui.QLineEdit.Password)
        userNamePasswordGridLayout.addWidget(self.passwordLineEdit,2,1,1,2)
        return(userNamePasswordWidget)

    ## Initialize autoCheck widget
    def initAutoCheck(self):
        widget = QtGui.QWidget()
        widget.setObjectName('userNamePasswordWidget')
        gridLayout = QtGui.QGridLayout(widget)

        loginLabel = QtGui.QLabel(self._('AutoCheck'))
        loginLabel.setObjectName('userNamePasswordTitle')
        gridLayout.addWidget(loginLabel,0,0,1,1)

        self.autoCheck = self.setting['userSetting'].autoCheck['on']
        self.autoCheckButton = QtGui.QLabel()
        if self.autoCheck:
            self.autoCheckButton = QtGui.QLabel(self._('ON'))
        else:
            self.autoCheckButton = QtGui.QLabel(self._('OFF'))
        self.autoCheckButton.installEventFilter(self)
        self.autoCheckButton.setObjectName('userNamePasswordValue')
        gridLayout.addWidget(self.autoCheckButton,0,1,1,2)

        gridLayout.addWidget(HorizontalSeparator('greySeparator'),1,0,1,3)

        passwordLabel = QtGui.QLabel(self._('Refresh time'))
        passwordLabel.setObjectName('userNamePasswordTitle')
        gridLayout.addWidget(passwordLabel,2,0,1,1)
        gridLayout.addWidget(self.timeSlider(),2,1,1,2)
        return(widget)

    ## Initialize time Slider
    def timeSlider(self):
        sliderWidget = QtGui.QWidget()
        sliderHBoxLayout = QtGui.QHBoxLayout(sliderWidget)
        sliderStartLabel = QtGui.QLabel(self._('1'))
        sliderStartLabel.setObjectName('qSliderValue')
        sliderHBoxLayout.addWidget(sliderStartLabel)

        self.autoCheckSlider = QtGui.QSlider(QtCore.Qt.Horizontal)
        self.autoCheckSlider.setFocusPolicy(QtCore.Qt.NoFocus)
        self.autoCheckSlider.setRange(1,300)
        self.autoCheckSlider.setValue(self.setting['userSetting'].autoCheck['time'])
        self.autoCheckSlider.valueChanged[int].connect(self.checkTime)
        sliderHBoxLayout.addWidget(self.autoCheckSlider)

        sliderEndLabel = QtGui.QLabel(self._('300 [min]'))
        sliderEndLabel.setObjectName('qSliderValue')
        sliderHBoxLayout.addWidget(sliderEndLabel)
        return(sliderWidget)

    ## Initialize autoCheck button
    def autoCheckToggle(self):
        if self.autoCheck:
            self.autoCheckButton.setText(self._('OFF'))
            self.autoCheck = False
        else:
            self.autoCheckButton.setText(self._('ON'))
            self.autoCheck = True

    ## Show set Check time value as tooltip
    def checkTime(self):
        QtGui.QToolTip.showText(QtGui.QCursor().pos(),str(self.autoCheckSlider.value()))

    ## Initialize Certificat widget
    def initCert(self):
        widget = QtGui.QWidget()
        widget.setObjectName('userNamePasswordWidget')
        gridLayout = QtGui.QGridLayout(widget)

        loginLabel = QtGui.QLabel(self._('Default Certification'))
        loginLabel.setObjectName('userNamePasswordTitle')
        gridLayout.addWidget(loginLabel,0,0,1,1)

        self.defaultCert = self.setting['userSetting'].cert['default']
        if self.defaultCert:
            self.defaultCertButton = QtGui.QLabel(self._('YES'))
        else:
            self.defaultCertButton = QtGui.QLabel(self._('NO'))
        self.defaultCertButton.installEventFilter(self)
        self.defaultCertButton.setObjectName('userNamePasswordValue')
        gridLayout.addWidget(self.defaultCertButton,0,1,1,2)

        gridLayout.addWidget(HorizontalSeparator('greySeparator'),1,0,1,3)

        passwordLabel = QtGui.QLabel(self._('My Cert.'))
        passwordLabel.setObjectName('userNamePasswordTitle')
        gridLayout.addWidget(passwordLabel,2,0,1,1)

        self.certLineEdit = QtGui.QLabel(self._('Choose File'))
        self.certLineEdit.installEventFilter(self)
        self.certLineEdit.setObjectName('userNamePasswordValue')
        gridLayout.addWidget(self.certLineEdit,2,1,1,2)
        return(widget)

    ## Initialize ON or OFF default cert
    def defaultCertToggle(self):
        if self.defaultCert:
            self.defaultCertButton.setText(self._('NO'))
            self.defaultCert = False
        else:
            self.defaultCertButton.setText(self._('YES'))
            self.defaultCert = True

    ## Initialize open file cert dialog
    def openFileDialog(self):
        file = QtGui.QFileDialog.getOpenFileName()
        if file != '':
            self.certLineEdit.setText(file)

    ## Initialize language Widget
    def languageWidget(self):
        widget = QtGui.QWidget()
        widget.setObjectName('userNamePasswordWidget')
        gridLayout = QtGui.QGridLayout(widget)

        loginLabel = QtGui.QLabel(self._('Language'))
        loginLabel.setObjectName('userNamePasswordTitle')
        gridLayout.addWidget(loginLabel,0,0,1,1)

        self.languageComboBox = QtGui.QComboBox()
        language = os.listdir(os.path.join(self.setting['path'],self.setting['userSetting'].language['path']))
        self.languageComboBox.addItems(language)
        self.languageComboBox.setCurrentIndex(language.index(self.setting['userSetting'].language['name']+'_'+self.setting['userSetting'].language['shortcut']))
        gridLayout.addWidget(self.languageComboBox,0,1,1,2)
        return (widget)

    ## Initialize color Widget
    def colorWidget(self):
        colorWidgets = QtGui.QWidget()
        colorVBoxLayout = QtGui.QVBoxLayout(colorWidgets)
        self.colorScheme = {}
        for colorScheme in os.listdir(os.path.join(self.setting['path'],self.setting['userSetting'].colorSchema['path'])):
            with open(os.path.join(self.setting['path'],self.setting['userSetting'].colorSchema['path'],colorScheme),"r") as styleFile:
                style = styleFile.read()
            colorName  = re.sub('\.css','',colorScheme)

            radioButton = QtGui.QRadioButton(self._('Use schema')+': '+colorName)
            radioButton.setObjectName('gradientWidget')
            radioButton.setStyleSheet(style)
            radioButton.setObjectName('gradientWidget')
            radioButton.connect(radioButton, QtCore.SIGNAL('toggled(bool)'),self.colorChange)

            colorVBoxLayout.addWidget(radioButton)
            self.colorScheme[colorScheme] = radioButton

        self.styleMenuCheckBox = QtGui.QCheckBox(self._('settingStyledTrayMenu'),self)
        self.styleMenuCheckBox.setChecked(self.setting['userSetting'].trayMenu['style'])
        colorVBoxLayout.addWidget(self.styleMenuCheckBox)
        self.colorScheme[self.setting['userSetting'].colorSchema['schema']+self.setting['userSetting'].colorSchema['type']].setChecked(True)
        return (colorWidgets)

    ## Used set color scheme to setting
    def colorChange(self):
        for key in self.colorScheme.keys():
            if self.colorScheme[key].isChecked():
                with open(os.path.join(self.setting['path'],self.setting['userSetting'].colorSchema['path'],key),"r") as style:
                    style = style.read()
                    self.setStyleSheet(style)
                break

    ## Initialize Close and Save button Widget
    def initCloseSaveButton(self):
        settingWidget = QtGui.QWidget()
        settingWidget.setObjectName('buttonWidget')
        settingVBoxLayout = QtGui.QVBoxLayout(settingWidget)

        buttonWidget = QtGui.QWidget()
        settingVBoxLayout.addWidget(buttonWidget)

        buttonHBoxLayout = QtGui.QHBoxLayout(buttonWidget)
        saveButton = CallMetodButton(self._('Save'),self.saveButtonAction, 'settingButton')
        buttonHBoxLayout.addWidget(saveButton)

        buttonHBoxLayout.addWidget(VerticalSeparator('whiteSeparator'))
        closeButton = CallMetodButton(self._('CloseButton'),self.hide, 'settingButton')
        buttonHBoxLayout.addWidget(closeButton)
        return(settingWidget)

    ## Save button Action
    def saveButtonAction(self):
        self.setting['userSetting'].username = self.usernameLineEdit.text()
        self.setting['userSetting'].password = self.passwordLineEdit.text()
        self.setting['userSetting'].autoCheck['on'] = self.autoCheck
        self.setting['userSetting'].autoCheck['time'] = self.autoCheckSlider.value()
        self.setting['userSetting'].cert['default'] = self.defaultCert
        if self.defaultCert:
            self.setting['userSetting'].cert['location'] = self.setting['userSetting'].cert['defaultLocation']
        else:
            cert = self.certLineEdit.text()
            if os.path.isfile(cert):
                self.setting['userSetting'].cert['location'] = cert
        for key in self.colorScheme.keys():
            if self.colorScheme[key].isChecked():
                self.setting['userSetting'].colorSchema['schema'] = re.sub(self.setting['userSetting'].colorSchema['type'],'',key)
                with open(os.path.join(self.setting['path'],self.setting['userSetting'].getColorSchema()),"r") as style:
                    self.setting['style'] = style.read()
                    self.parent().setStyleSheet(self.setting['style'])
                break
        self.setting['userSetting'].trayMenu['style'] = self.styleMenuCheckBox.isChecked()

        language = self.languageComboBox.currentText().split('_')

        self.setting['userSetting'].language['name'] = language[0]
        self.setting['userSetting'].language['shortcut'] = language[1]
        self.setting['userSetting'].save()
        self.setting['language'].update(self.setting)
        saveMessage = QtGui.QMessageBox()
        saveMessage.question(self, self._('Save Complete'), self._('Save Complete'),'OK')

    ## Create style Widget
    # @param title Title of widget.
    # @param addWid SubWidget which is show on button click.
    def createWidget(self, title, addWid):
        addWid.hide()
        courseBarWidget1 = QtGui.QWidget()
        coursesLayout = QtGui.QVBoxLayout(courseBarWidget1)
        courseBarWidget = ClickWidget(self.setting,'mainWidgetItem','mainWidgetItemShow',courseBarWidget1,addWid)
        coursesLayout.addWidget(courseBarWidget)
        coursesLayout.addWidget(addWid)
        courseHBoxLayout = QtGui.QHBoxLayout(courseBarWidget)
        titleLabel = QtGui.QLabel()
        titleLabel.setObjectName('settingItem')
        titleLabel.setText(title)
        courseHBoxLayout.addWidget(titleLabel)
        return(courseBarWidget1)

    ## Override close window event.
    # @param event Event which close window.
    def closeEvent(self, event):
        event.ignore()
        self.hide()

    ## Override event Filter
    # @param object Object which rise event.
    # @param event Event which is rise.
    def eventFilter(self, object, event):
        if event.type() == QtCore.QEvent.MouseButtonRelease:
            if object == self.autoCheckButton:
                self.autoCheckToggle()
            elif object == self.defaultCertButton:
                self.defaultCertToggle()
            elif object == self.certLineEdit:
                self.openFileDialog()
        return False