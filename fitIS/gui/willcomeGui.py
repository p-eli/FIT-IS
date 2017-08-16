#!/usr/bin/python3
__author__ = 'Jakub Pelikan'
from PyQt4 import QtGui, QtCore
from fitIS.gui.coursesGuiComponent import CallMetodButton,HorizontalSeparator,VerticalSeparator
from fitIS.gui.courseData import CourseData
import os
import locale
import re
from fitIS.gui.language import Languge


class WillcomeGui(QtGui.QMainWindow):
    """
    WillcomeGui is instance of QMainWindow. Its Screen which is show on first start of application.
    There is compose of login Widget and short application guide.
    @author Jakub Pelikán
    @version 1.0
    @package fitIS.gui
    """
    ## The constructor
    # @param setting Application setting.
    # @param parentObject ParentObject is parent element.
    def __init__(self, setting, parentObject):
        QtGui.QMainWindow.__init__(self, None)
        self.parentObject = parentObject
        self.setting = setting
        self.thread = None
        self.loginStatus = False
        self.initLanguage()
        self._ = self.setting['language'].gettext
        self.step = 0
        self.initWindow()
        self.show()

    ## Initialize application language by system language
    def initLanguage(self):
        language = os.listdir(os.path.join(self.setting['path'],self.setting['userSetting'].language['path']))
        systemLanguage = locale.getdefaultlocale()
        for x in language:
            lang = x.split('_')
            if lang[1] in systemLanguage[0]:
                self.setting['userSetting'].language['name'] = lang[0]
                self.setting['userSetting'].language['shortcut'] = lang[1]
                break
        self.setting['language'] = Languge(self.setting)

    ## Inicialize window
    def initWindow(self):
        self.setWindowIcon(QtGui.QIcon(self.setting['userSetting'].getImage('logo', self.setting['path'])))
        self.setWindowTitle(self._('WillcomeWindowTitle'))
        self.setGeometry(self.setting['userSetting'].resolution['width']/3,self.setting['userSetting'].resolution['height']/8,1*self.setting['userSetting'].resolution['width']/3,3*self.setting['userSetting'].resolution['height']/4)
        self.setStyleSheet(self.setting['style'])
        self.scroollArea = QtGui.QScrollArea(self)
        self.scroollArea.setWidgetResizable(True)
        self.mainWidget = QtGui.QWidget(self.scroollArea)
        self.mainWidget.setObjectName('mainWillcomeWidget')
        self.scroollArea.setWidget(self.mainWidget)
        self.setCentralWidget(self.scroollArea)
        self.willcomeVBoxLayout = QtGui.QVBoxLayout(self.mainWidget)
        self.willcomeVBoxLayout.addWidget(self.initloginWidget())

    ## Pass metod
    def noneMetod(self):
        pass

    ## Initialize login Widget
    def initloginWidget(self):
        self.loginWidget = QtGui.QWidget()
        self.loginWidget.installEventFilter(self)
        self.loginWidget.setObjectName('willcomeWidget')
        loginVBoxLayout = QtGui.QVBoxLayout(self.loginWidget)
        loginVBoxLayout.addStretch(1)
        loginTitleLabel = QtGui.QLabel()
        loginTitleLabel.setText(self._('loginTitle'))
        loginTitleLabel.setObjectName('titleWillcomeWidget')
        loginVBoxLayout.addWidget(loginTitleLabel)

        loginVBoxLayout.addStretch(2)
        self.logo = QtGui.QLabel()
        self.image = QtGui.QPixmap(self.setting['userSetting'].getImage('logoWillcome', self.setting['path']))
        self.logo.setPixmap(self.image)
        loginVBoxLayout.addWidget(self.logo)

        loginVBoxLayout.addStretch(4)

        userNamePasswordWidget = QtGui.QWidget()
        userNamePasswordWidget.setObjectName('userNamePasswordWidget')
        loginVBoxLayout.addWidget(userNamePasswordWidget)
        userNamePasswordGridLayout = QtGui.QGridLayout(userNamePasswordWidget)

        loginLable = QtGui.QLabel(self._('Username'))
        loginLable.setObjectName('userNamePasswordTitle')
        userNamePasswordGridLayout.addWidget(loginLable,0,0,1,1)

        self.login = QtGui.QLineEdit()
        self.login.setObjectName('userNamePasswordValue')
        self.login.setText(self._('UsernameExample'))
        self.login.installEventFilter(self)
        userNamePasswordGridLayout.addWidget(self.login,0,1,1,2)

        userNamePasswordGridLayout.addWidget(HorizontalSeparator('greySeparator'),1,0,1,3)

        passwordLable = QtGui.QLabel(self._('Password'))
        passwordLable.setObjectName('userNamePasswordTitle')
        userNamePasswordGridLayout.addWidget(passwordLable,2,0,1,1)

        self.password = QtGui.QLineEdit()
        self.password.setObjectName('userNamePasswordValue')
        self.password.setText(self._('PasswordExample'))
        self.password.installEventFilter(self)
        userNamePasswordGridLayout.addWidget(self.password,2,1,1,2)

        loginVBoxLayout.addStretch(2)

        loginButton = CallMetodButton(self._('SignIn'),self.signInAction, 'signInButton')
        loginVBoxLayout.addWidget(loginButton)
        loginVBoxLayout.addStretch(1)
        return(self.loginWidget)

    # Method implement signIn action
    def signInAction(self):
        if self.thread == None:
            self.setting['userSetting'].username = self.login.text()
            self.setting['userSetting'].password = self.password.text()
            self.thread = CourseData(self.setting)
            self.thread.success.connect(self.loginSuccess)
            self.thread.loginFailed.connect(self.loginFailed)
            self.thread.connectionFailed.connect(self.connectFailed)
            self.thread.start()

    # Login success Method
    def loginSuccess(self):
        self.setting['userSetting'].save()
        self.loginStatus = True
        self.loginWidget.hide()
        self.initWillcomeWidget()

    ## Login Failed Method
    def loginFailed(self):
        failMessage = QtGui.QMessageBox()
        failMessage.question(self, self._('Loggin Failed'), self._("Loggin Failed,\n pleas check your username and Password"),self._('OK'))
        self.thread = None

    ## Connect Failed Method
    def connectFailed(self):
        failMessage = QtGui.QMessageBox()
        failMessage.question(self, self._('ConnectionError'), self._('ConnectionError'),self._('OK'))
        self.thread = None

    ## Initialize Image willcome guide
    def initImage(self):
        imageFile = os.listdir(os.path.join(self.setting['path'],self.setting['userSetting'].willcomeImage['path']))
        self.imageList = {}
        for image in imageFile:
            if re.search('\d_',image):
                item = image.split('_')
                self.imageList[int(item[0])] = QtGui.QPixmap(os.path.join(self.setting['path'],self.setting['userSetting'].willcomeImage['path'],image))

    ## Initialize Wilcome guide Widget
    def initWillcomeWidget(self):
        self.initImage()
        willcomeWidget = QtGui.QWidget()
        self.willcomeVBoxLayout.addWidget(willcomeWidget)
        willcomeLayout = QtGui.QGridLayout(willcomeWidget)
        willcomeLayout.setSpacing(10)
        willcomeWidget.setObjectName('willcomeWidget')

        self.titleLabel  = QtGui.QLabel()
        self.titleLabel.setObjectName('titleWillcomeWidget')
        willcomeLayout.addWidget(self.titleLabel,1,0,1,0)

        textWidget = QtGui.QWidget()
        textLayout = QtGui.QVBoxLayout(textWidget)
        textWidget.setObjectName('mainWidgetSubItem')
        self.imageLabel = QtGui.QLabel()
        textLayout.addWidget(self.imageLabel)
        willcomeLayout.addWidget(textWidget,2,0,6,0)
        willcomeLayout.addWidget(self.initButton(),9,0,1,0)
        self.actualizeWidget()

    ## Inicialize button Widget
    def initButton(self):
        self.buttonWidget = QtGui.QWidget()
        self.buttonWidget.setObjectName('buttonWidget')
        buttonHBoxLayout = QtGui.QHBoxLayout(self.buttonWidget)

        self.backButton = CallMetodButton(self._('backButton'),self.noneMetod, 'settingButtonNoEnabled')
        buttonHBoxLayout.addWidget(self.backButton)
        buttonHBoxLayout.addWidget(VerticalSeparator('whiteSeparator'))

        self.nextButton = CallMetodButton(self._('nextButton'),self.nextAction, 'settingButton')
        buttonHBoxLayout.addWidget(self.nextButton)
        buttonHBoxLayout.addWidget(VerticalSeparator('whiteSeparator'))

        self.skipButton = CallMetodButton(self._('skipButton'),self.skipAction, 'settingButton')
        buttonHBoxLayout.addWidget(self.skipButton)
        return (self.buttonWidget)

    ## Back button Action
    def backAction(self):
        if self.step == 1:
            self.backButton.callMethod = self.noneMetod
            self.backButton.setObjectName('settingButtonNoEnabled')
            self.backButton.setStyleSheet(self.setting['style'])
        if self.step == len(self.imageList)-1:
            self.nextButton.callMethod = self.nextAction
            self.skipButton.callMethod = self.skipAction
            self.skipButton.setText(self._('skipButton'))
            self.nextButton.setObjectName('settingButton')
            self.nextButton.setStyleSheet(self.setting['style'])
        self.step -=1
        self.actualizeWidget()

    ## Next button action
    def nextAction(self):
        self.step +=1
        self.nextStep()
        self.actualizeWidget()

    ## Skip button action
    def skipAction(self):
        self.step = len(self.imageList)-1
        self.nextStep()
        self.actualizeWidget()

    ## Next next step method
    def nextStep(self):
        self.backButton.callMethod = self.backAction
        self.backButton.setObjectName('settingButton')
        self.backButton.setStyleSheet(self.setting['style'])
        if self.step >= len(self.imageList)-1:

            self.nextButton.callMethod = self.noneMetod
            self.nextButton.setObjectName('settingButtonNoEnabled')
            self.nextButton.setStyleSheet(self.setting['style'])

            self.skipButton.callMethod = self.closeWidget
            self.skipButton.setText(self._('finishButton'))

    ## Actualize willcome guide widget
    def actualizeWidget(self):
        self.titleLabel.setText(self._('willcomeStep'+str(self.step)))
        self.imageLabel.setPixmap(self.imageList[self.step].scaled(self.imageLabel.size().width()*0.8,self.imageLabel.size().width()*0.8, QtCore.Qt.KeepAspectRatio,QtCore.Qt.SmoothTransformation))

    ## Override event Filter
    # @param object Object which rise event.
    # @param event Event which is rise.
    def eventFilter(self, object, event):
        if event.type() == QtCore.QEvent.FocusIn:
            if object == self.login:
                if self.login.text() == self._('UsernameExample'):
                    self.login.setText('')
            elif object == self.password:
                if self.password.text() == self._('PasswordExample'):
                    self.password.setText('')
                    self.password.setEchoMode(QtGui.QLineEdit.Password)
        elif event.type() == QtCore.QEvent.FocusOut:
            if object == self.login:
                if self.login.text() == '':
                    self.login.setText(self._('UsernameExample'))
            elif object == self.password:
                if self.password.text() == '':
                    self.password.setText(self._('PasswordExample'))
                    self.password.setEchoMode(QtGui.QLineEdit.Normal)
        elif event.type() == QtCore.QEvent.Resize:
            if object == self.loginWidget:
                self.logo.setPixmap(self.image.scaled(self.loginWidget.size().width()/2.5,self.loginWidget.size().width()/2.5, QtCore.Qt.KeepAspectRatio,QtCore.Qt.SmoothTransformation))
        elif event.type() == QtCore.QEvent.KeyPress and event.text() == chr(13) and object == self.password:
            self.signInAction()
        return False

    ## Close window event.
    def closeWidget(self):
        self.hide()
        self.parentObject.runSystemTray()

    ## Override close window event.
    # @param event Event which close window.
    def closeEvent(self, event):
        if not self.loginStatus:
            event.ignore()
            exit()
        else:
            event.ignore()
            self.closeWidget()

