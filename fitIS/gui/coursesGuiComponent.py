#!/usr/bin/python3
__author__ = 'Jakub Pelikan'
from PyQt4.QtGui import QLabel,QWidget,QFrame


class ButtonLabel(QLabel):
    """
    ButtonLabel is instance of QLabel. Which show or hide subWidget on mouseReleaseEvent.
    @author Jakub Pelikan
    @version 1.0
    @package fitIS.gui
    """
    ## The constructor
    # @param textShow Text which is show when subWidget is hide.
    # @param showWidget SubWidget which is show or hide on mouseReleaseEvent.
    # @param textHide Text which is show when subWidget is show.
    def __init__(self, textShow, showWidget=None, textHide=None):
        QLabel.__init__(self)
        self.setText(str(textShow))
        self.showWidget = showWidget
        self.textShow = textShow
        self.textHide = textHide
        self.setObjectName('alRight')

    ## Metod set Show Widget
    # @param showWidget SubWidget which is show or hide on mouseReleaseEvent.
    def setShowWidget(self,showWidget):
        self.showWidget = showWidget

    ## Override mouseReleaseEvent method
    # @param QMouseEvent Mouse event.
    def mouseReleaseEvent(self, QMouseEvent):
        if self.showWidget!= None:
            if self.showWidget.isVisible():
                if self.textHide != None:
                    self.setText(self.textShow)
                self.showWidget.hide()
            else:
                if self.textHide != None:
                    self.setText(self.textHide)
                self.showWidget.show()


class CallMetodButton(QLabel):
    """
    ButtonLabel is instance of QLabel. Which call metod on mouseReleaseEvent.
    @author Jakub Pelikan
    @version 1.0
    @package fitIS.gui
    """
    ## The constructor
    # @param text Text which is show on Label.
    # @param callMethod Metod which is call on mouseReleaseEvent.
    # @param objName Name of label.
    def __init__(self, text, callMethod, objName=None):
        QLabel.__init__(self)
        self.setText(str(text))
        self.callMethod = callMethod
        self.setObjectName(objName)

    ## Override mouseReleaseEvent metod
    # @param QMouseEvent Mouse event.
    def mouseReleaseEvent(self, QMouseEvent):
        self.callMethod()


class ClickWidget(QWidget):
    """
    ClickWidget is instance of QWidget. Which show or hide subWidget on mouseReleaseEvent.
    @author Jakub Pelikan
    @version 1.0
    @package fitIS.gui
    """
    ## The constructor
    # @param setting Application setting.
    # @param styleName Name of Widget.
    # @param styleNameOnShow Name of widget when is subWidget show.
    # @param styleWidget Widget which name is set.
    # @param detailCoursesWidget Widget which is show or hide on mouseReleaseEvent.
    def __init__(self, setting ,styleName, styleNameOnShow, styleWidget=None, detailCoursesWidget=None):
        QWidget.__init__(self)
        self.setting = setting
        self.detailCoursesWidget = detailCoursesWidget
        if styleWidget == None:
            styleWidget = self
        self.styleWidget = [styleWidget, styleName, styleNameOnShow]
        self.styleWidget[0].setObjectName(self.styleWidget[1])
        self.styleWidget[0].setStyleSheet(self.setting['style'])

    ## Override mouseReleaseEvent method
    # @param QMouseEvent Mouse event.
    def mouseReleaseEvent(self, event):
        if self.detailCoursesWidget !=None:
            if self.detailCoursesWidget.isVisible():
                if self.styleWidget != None:
                    self.styleWidget[0].setObjectName(self.styleWidget[1])
                    self.styleWidget[0].setStyleSheet(self.setting['style'])
                self.detailCoursesWidget.hide()
            else:
                if self.styleWidget != None:
                    self.styleWidget[0].setObjectName(self.styleWidget[2])
                    self.styleWidget[0].setStyleSheet(self.setting['style'])
                self.detailCoursesWidget.show()


class VerticalSeparator(QFrame):
    """
    VerticalSeparator is instance of QFrame. That is used as vertical separator.
    @author Jakub Pelikan
    @version 1.0
    @package fitIS.gui
    """
    ## The constructor
    # @param objName Name of label.
    def __init__(self,objName=None):
        QFrame.__init__(self)
        self.setFrameShape(QFrame.VLine)
        if objName != None:
            self.setObjectName(objName)


class HorizontalSeparator(QFrame):
    """
    HorizontalSeparator is instance of QFrame. That is used as horizontal separator.
    @author Jakub Pelikan
    @version 1.0
    @package fitIS.gui
    """
    ## The constructor
    # @param objName Name of label.
    def __init__(self,objName=None):
        QFrame.__init__(self)
        self.setFrameShape(QFrame.HLine)
        if objName != None:
            self.setObjectName(objName)