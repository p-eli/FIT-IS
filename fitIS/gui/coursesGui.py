#!/usr/bin/python3
__author__ = 'Jakub Pelikan'
from PyQt4 import QtGui, QtCore
from fitIS.gui.coursesGuiComponent import ClickWidget, ButtonLabel, VerticalSeparator, HorizontalSeparator, CallMetodButton
from fitIS.gui.courseData import CourseData
from fitIS.gui.sendNotify import SendNotify


class CoursesGui(QtGui.QMainWindow):
    """
    CoursesGui is instance of QMainWindow. Show information from FIT IS.
    @author Jakub Pelikan
    @version 1.0
    @package fitIS.gui
    """
    ## The constructor
    # @param setting Application setting.
    def __init__(self, setting):
        QtGui.QMainWindow.__init__(self, None)
        self.setting = setting
        self._ = self.setting['language'].gettext
        self.notify = SendNotify(self.setting)
        self.initWindow()
        self.initCourseWidget()
        self.refreshWindow()
        self.show()

    ## Start refresh window
    def refreshWindow(self):
        self.refreshButton.setText(self._('refreshingButton'))
        self.thread = CourseData(self.setting,self.notify)
        self.thread.notifySend.connect(self.notify.sendMessage)
        self.thread.success.connect(self.initCourseWidget)
        self.thread.start()

    ## Init QMainWindow
    def initWindow(self):
        self.setGeometry(self.setting['userSetting'].resolution['width']/8,self.setting['userSetting'].resolution['height']/8,3*self.setting['userSetting'].resolution['width']/4,3*self.setting['userSetting'].resolution['height']/4)
        self.setMinimumSize(600,450)
        self.setStyleSheet(self.setting['style'])
        self.setWindowIcon(QtGui.QIcon(self.setting['userSetting'].getImage('logo', self.setting['path'])))
        self.setWindowTitle(self._('ShowWindowTitle'))

    ## Init Course QWidget
    def initCourseWidget(self):
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
        layout.addWidget(self.initButton(),10,0,1,1)

        self.setCentralWidget(settingWidget)
        self.courseVBoxLayout = QtGui.QVBoxLayout(mainWidget)
        self.addCourse()

    ## Init Button QWidget
    def initButton(self):
        settingWidget = QtGui.QWidget()
        settingWidget.setObjectName('buttonWidget')
        settingVBoxLayout = QtGui.QVBoxLayout(settingWidget)

        buttonWidget = QtGui.QWidget()
        settingVBoxLayout.addWidget(buttonWidget)

        buttonHBoxLayout = QtGui.QHBoxLayout(buttonWidget)

        self.semButton = QtGui.QLabel()
        self.semButton.setObjectName('cursesButton')
        self.initTerm()
        self.semButton.installEventFilter(self)
        buttonHBoxLayout.addWidget(self.semButton)

        buttonHBoxLayout.addWidget(VerticalSeparator('whiteSeparator'))
        self.refreshButton = QtGui.QLabel(self._('refreshButton'))
        self.refreshButton.setObjectName('cursesButton')
        self.refreshButton.installEventFilter(self)
        buttonHBoxLayout.addWidget(self.refreshButton)

        buttonHBoxLayout.addWidget(VerticalSeparator('whiteSeparator'))
        self.closeButton = QtGui.QLabel(self._('CloseButton'))
        self.closeButton.setObjectName('cursesButton')
        self.closeButton.installEventFilter(self)

        buttonHBoxLayout.addWidget(self.closeButton)
        return(settingWidget)

    ## Init Term button
    def initTerm(self):
        if self.setting['userSetting'].sem['show'] == 'L':
            self.semButton.setText(self._("summerTermButton"))
        else:
           self.semButton.setText(self._("winterTermButton"))

    ## Add course to courses Widget
    def addCourse(self):
        for courses in self.setting['userSetting'].courses:
            if courses.attribute['sem'] == self.setting['userSetting'].sem['show']:
                self.courseVBoxLayout.addWidget(self.courseBar(courses))
                self.courseVBoxLayout.addWidget(HorizontalSeparator('whiteSeparator'))

    ## Initialize course bar
    # @param course Tree with course data.
    def courseBar(self,course):
        detailCoursesWidget = self.initDetailCurses(course)
        courseBarWidget1 = QtGui.QWidget()
        coursesLayout = QtGui.QVBoxLayout(courseBarWidget1)
        courseBarWidget = ClickWidget(self.setting,'mainWidgetItem','mainWidgetItemShow',courseBarWidget1,detailCoursesWidget)
        coursesLayout.addWidget(courseBarWidget)
        coursesLayout.addWidget(detailCoursesWidget)
        courseHBoxLayout = QtGui.QHBoxLayout(courseBarWidget)
        courseAccr = None
        courseExamination = None
        try:
            for child in course.child:
                if courseAccr !=None and courseExamination !=None:
                    break
                if child.tag == 'accreditation':
                    courseAccr = child.attribute['status']
                elif child.tag == 'examination':
                    courseExamination = child.attribute['grade']
            self.initCourse(courseHBoxLayout, course.attribute['abbrv'],self._('abbrv'), True, True)
            self.initCourse(courseHBoxLayout, course.attribute['type'],self._('type'), True)
            self.initCourse(courseHBoxLayout, course.attribute['completion'],self._('cpl'), True)
            self.initCourse(courseHBoxLayout, course.attribute['points'],self._('points'), True)
            self.initCourse(courseHBoxLayout, courseAccr,self._('accr'), True)
            self.initCourse(courseHBoxLayout, courseExamination,self._('grade'), True)
            self.initCourse(courseHBoxLayout, course.attribute['credits'],self._('credits'), False)
        except:
            pass
        return(courseBarWidget1)

    ## Initialize course Widget
    # @param courseHBoxLayout HBoxLayout with course information.
    # @param text Text of information Label.
    # @param title Title of information Label.
    # @param separator Add seperator after information Label.
    # @param titleItem Is information Label title of course.
    def initCourse(self,courseHBoxLayout, text, title, separator, titleItem=False):
        startWidget = QtGui.QWidget()
        startLayout = QtGui.QGridLayout(startWidget)
        subTitle = QtGui.QLabel(title)
        subTitle.setObjectName('courseHintItem')
        if text == None:
            value = QtGui.QLabel('-')
        else:
            value = QtGui.QLabel(text)
        if titleItem:
            value.setObjectName('abbrv')
        else:
            value.setObjectName('courseItem')
            startLayout.addWidget(subTitle,0,0,0,1)
        startLayout.addWidget(value,0,0,0,3)
        courseHBoxLayout.addWidget(startWidget)
        if separator:
            courseHBoxLayout.addWidget(VerticalSeparator('orangeSeparator'))

    ## Initialize detail information about course
    # @param course Tree with course data.
    def initDetailCurses(self, course):
        detailCoursesWidget = QtGui.QWidget()
        detailCoursesWidget.setObjectName('mainWidgetSubItem')
        courseVBoxLayout = QtGui.QVBoxLayout(detailCoursesWidget)
        try:
            self.setCourseTitle(course, courseVBoxLayout)
            self.setCourseItem(course, courseVBoxLayout)
        except:
            pass
        detailCoursesWidget.hide()
        return(detailCoursesWidget)

    ## Set course title to detail info.
    # @param course Tree with course data.
    # @param courseVBoxLayout VBoxLayout with detail courses info.
    def setCourseTitle(self, course, courseVBoxLayout):
        for item in course.child:
            cond = True
            if item.tag == 'title':
                if item.attribute['lang'] != self.setting['userSetting'].language['shortcut']:
                    for item_check in course.child:
                        if item_check.tag == 'title' and item_check.attribute['lang'] == self.setting['userSetting'].language['shortcut']:
                            cond = False
                if cond:
                    courseName = QtGui.QLabel(item.text)
                    courseName.setObjectName('courseName')
                    courseVBoxLayout.addWidget(courseName)
                    courseVBoxLayout.addWidget(HorizontalSeparator('blackSeparator'))
                    break

    ## Switch between type of item in courses detail info.
    # @param course Tree with course data.
    # @param courseVBoxLayout VBoxLayout with detail courses info.
    def setCourseItem(self,course, courseVBoxLayout):
        for child in course.child:
            if child.tag == 'item':
                if child.attribute['type'] == 'select':
                    self.courseItemSelect(courseVBoxLayout, child)
                elif child.attribute['type'] == 'single':
                    self.courseItemSingle(courseVBoxLayout,  child)
                elif child.attribute['type'] == 'accr':
                    self.courseItemAccr(courseVBoxLayout, child)
                elif child.attribute['type'] == 'multi':
                    self.courseItemMulti(courseVBoxLayout, child)


    ## Detail courses info item Select.
    # @param item Tree with course data.
    # @param courseVBoxLayout VBoxLayout with detail courses info.
    def courseItemSelect(self,courseVBoxLayout, item):
        variantWidgetTop = QtGui.QWidget()
        variantWidgetTop.setObjectName('courseItemSelect')
        variantLayoutTop = QtGui.QVBoxLayout(variantWidgetTop)

        titleWidget = QtGui.QWidget()
        titleHBoxLayout = QtGui.QHBoxLayout(titleWidget)
        titleHBoxLayout.setContentsMargins(0, 0, 0, 0)
        variantWidget = QtGui.QWidget()
        variantLayout = QtGui.QVBoxLayout(variantWidget)

        variantLayoutTop.addWidget(titleWidget)
        variantLayoutTop.addWidget(HorizontalSeparator('greySeparator'))

        showWariantWidget = QtGui.QWidget()
        showWariantLayout = QtGui.QGridLayout(showWariantWidget)

        variantLabel = QtGui.QLabel(self._('NonRegistred'))
        showWariantLayout.addWidget(variantLabel,1,0,1,1)
        showWariant = ButtonLabel(self._('showMore')+"  <img src="+self.setting['userSetting'].getImage('moreIcon', self.setting['path'])+" height=\"18\" >",variantWidget,self._('showLess')+"  <img src="+self.setting['userSetting'].getImage('lessIcon', self.setting['path'])+" height=\"18\" >")
        showWariant.setTextFormat(QtCore.Qt.RichText)
        showWariantLayout.addWidget(showWariant,1,0,1,1)

        variantLayoutTop.addWidget(showWariantWidget)
        variantLayoutTop.addWidget(variantWidget)
        courseVBoxLayout.addWidget(variantWidgetTop)

        variantWidget.hide()
        variantLayout.addWidget(HorizontalSeparator('orangeSeparator'))
        maxPoint = ''
        for subItem in item.child:
            cond = True
            if subItem.tag == 'title':
                if subItem.attribute['lang'] != self.setting['userSetting'].language['shortcut']:
                    for item_check in item.child:
                        if item_check.tag == 'title' and item_check.attribute['lang'] == self.setting['userSetting'].language['shortcut']:
                            cond = False
                if cond:
                    title = QtGui.QLabel(subItem.text)
                    title.setObjectName('itemName')
                    titleHBoxLayout.addWidget(title)
                    titleHBoxLayout.addWidget(VerticalSeparator('greySeparator'))
                    if 'start' in item.attribute:
                        titleHBoxLayout.addWidget(self.createMenuItem(self._('start'),self.parseDate(item.attribute['start'])))
                    else:
                        titleHBoxLayout.addWidget(self.createMenuItem(self._('start'),'-'))
                    titleHBoxLayout.addWidget(VerticalSeparator('greySeparator'))
                    if 'end' in item.attribute:
                        titleHBoxLayout.addWidget(self.createMenuItem(self._('end'),self.parseDate(item.attribute['end'])))
                    else:
                        titleHBoxLayout.addWidget(self.createMenuItem(self._('end'),'-'))
                    if 'max' in item.attribute:
                        maxPoint = item.attribute['max']
                    else:
                        maxPoint = '-'
            elif subItem.tag == 'variant':
                variant = self.detailCursesVariant(subItem,titleHBoxLayout,'select',variantLabel,maxPoint)
                variantLayout.addWidget(variant)

    ## Detail courses info item Single.
    # @param item Tree with course data.
    # @param courseVBoxLayout VBoxLayout with detail courses info.
    def courseItemSingle(self, courseVBoxLayout, item):
        titleWidget = QtGui.QWidget()
        titleWidget.setObjectName('courseItemSingle')
        titleHBoxLayout = QtGui.QHBoxLayout(titleWidget)
        courseVBoxLayout.addWidget(titleWidget)
        maxPoint = ''
        for subItem in item.child:
            cond = True
            if subItem.tag == 'title':
                if subItem.attribute['lang'] != self.setting['userSetting'].language['shortcut']:
                    for item_check in item.child:
                        if item_check.tag == 'title' and item_check.attribute['lang'] == self.setting['userSetting'].language['shortcut']:
                            cond = False
                if cond:
                    title = QtGui.QLabel(subItem.text)
                    title.setObjectName('itemName')
                    titleHBoxLayout.addWidget(title)
                    titleHBoxLayout.addWidget(VerticalSeparator('greySeparator'))
                    if 'start' in item.attribute:
                        titleHBoxLayout.addWidget(self.createMenuItem(self._('start'),self.parseDate(item.attribute['start'])))
                    else:
                        titleHBoxLayout.addWidget(self.createMenuItem(self._('start'),'-'))
                    titleHBoxLayout.addWidget(VerticalSeparator('greySeparator'))
                    if 'end' in item.attribute:
                        titleHBoxLayout.addWidget(self.createMenuItem(self._('end'),self.parseDate(item.attribute['end'])))
                    else:
                        titleHBoxLayout.addWidget(self.createMenuItem(self._('end'),'-'))
                    if 'max' in item.attribute:
                        maxPoint = self.parseDate(item.attribute['max'])
                    else:
                        maxPoint = '-'

            elif subItem.tag == 'entry':
                titleHBoxLayout.addWidget(VerticalSeparator('greySeparator'))
                if 'points' in subItem.attribute:
                    titleHBoxLayout.addWidget(self.createMenuItem(self._('points'),subItem.attribute['points']+'/'+maxPoint))
                else:
                    titleHBoxLayout.addWidget(self.createMenuItem(self._('points'),'-'+'/'+maxPoint))
                break

    ## Detail courses info item Accreditation.
    # @param item Tree with course data.
    # @param courseVBoxLayout VBoxLayout with detail courses info.
    def courseItemAccr(self, courseVBoxLayout, item):
        titleWidget = QtGui.QWidget()
        titleWidget.setObjectName('courseItemAccr')
        titleHBoxLayout = QtGui.QHBoxLayout(titleWidget)
        courseVBoxLayout.addWidget(titleWidget)
        for subItem in item.child:
            cond = True
            if subItem.tag == 'title':
                if subItem.attribute['lang'] != self.setting['userSetting'].language['shortcut']:
                    for item_check in item.child:
                        if item_check.tag == 'title' and item_check.attribute['lang'] == self.setting['userSetting'].language['shortcut']:
                            cond = False
                if cond:
                    title = QtGui.QLabel(subItem.text)
                    title.setObjectName('itemName')
                    titleHBoxLayout.addWidget(title)
                    titleHBoxLayout.addWidget(VerticalSeparator('greySeparator'))
                    if 'start' in item.attribute:
                        titleHBoxLayout.addWidget(self.createMenuItem(self._('start'),self.parseDate(item.attribute['start'])))
                    else:
                        titleHBoxLayout.addWidget(self.createMenuItem(self._('start'),'-'))
                    titleHBoxLayout.addWidget(VerticalSeparator('greySeparator'))
                    if 'min' in item.attribute:
                        titleHBoxLayout.addWidget(self.createMenuItem(self._('min'),self.parseDate(item.attribute['min'])))
                    else:
                        titleHBoxLayout.addWidget(self.createMenuItem(self._('min'),'-'))

    ## Create Menu with detail item info.
    # @param title Title of detail item.
    # @param text Text of detail item.
    def createMenuItem(self,title, text):
        startWidget = QtGui.QWidget()
        startLayout = QtGui.QGridLayout(startWidget)
        subTitle = QtGui.QLabel(title)
        subTitle.setObjectName('hintItem')
        value = QtGui.QLabel(text)
        startLayout.addWidget(subTitle,0,0,0,1)
        startLayout.addWidget(value,0,0,0,3)
        return(startWidget)

    ## Detail courses info item Multi.
    # @param item Tree with course data.
    # @param courseVBoxLayout VBoxLayout with detail courses info.
    def courseItemMulti(self,courseVBoxLayout, item):
        variantWidgetTop = QtGui.QWidget()
        variantWidgetTop.setObjectName('courseItemMulti')
        variantLayoutTop = QtGui.QVBoxLayout(variantWidgetTop)
        titleWidget = QtGui.QWidget()
        titleHBoxLayout = QtGui.QHBoxLayout(titleWidget)
        titleHBoxLayout.setContentsMargins(0, 0, 0, 0)

        variantWidget = QtGui.QWidget()
        variantLayout = QtGui.QVBoxLayout(variantWidget)

        variantLayoutTop.addWidget(titleWidget)
        variantLayoutTop.addWidget(HorizontalSeparator('greySeparator'))
        showWariantWidget = QtGui.QWidget()
        showWariantLayout = QtGui.QGridLayout(showWariantWidget)
        variantLabel = QtGui.QLabel(self._('NonRegistred'))
        showWariantLayout.addWidget(variantLabel,1,0,1,1)
        showWariant = ButtonLabel(self._('showMore')+"  <img src="+self.setting['userSetting'].getImage('moreIcon', self.setting['path'])+" height=\"18\" >",variantWidget,self._('showLess')+"  <img src="+self.setting['userSetting'].getImage('lessIcon', self.setting['path'])+" height=\"18\" >")
        showWariant.setTextFormat(QtCore.Qt.RichText)
        showWariantLayout.addWidget(showWariant,1,0,1,1)
        variantLayoutTop.addWidget(showWariantWidget)
        variantLayoutTop.addWidget(variantWidget)
        courseVBoxLayout.addWidget(variantWidgetTop)

        variantWidget.hide()
        variantLayout.addWidget(HorizontalSeparator('orangeSeparator'))
        for subItem in item.child:
            cond = True
            if subItem.tag == 'title':
                if subItem.attribute['lang'] != self.setting['userSetting'].language['shortcut']:
                    for item_check in item.child:
                        if item_check.tag == 'title' and item_check.attribute['lang'] == self.setting['userSetting'].language['shortcut']:
                            cond = False
                if cond:
                    title = QtGui.QLabel(subItem.text)
                    title.setObjectName('itemName')
                    titleHBoxLayout.addWidget(title)
                    titleHBoxLayout.addWidget(VerticalSeparator('greySeparator'))
                    if 'min' in item.attribute:
                        titleHBoxLayout.addWidget(self.createMenuItem(self._('min'),self.parseDate(item.attribute['min'])))
                    else:
                        titleHBoxLayout.addWidget(self.createMenuItem(self._('min'),'-'))
                    if 'max' in item.attribute:
                        maxPoint = self.parseDate(item.attribute['max'])
                    else:
                        maxPoint = '-'
            elif subItem.tag == 'variant':
                variant = self.detailCursesVariant(subItem,titleHBoxLayout, 'multi', variantLabel, maxPoint)
                variantLayout.addWidget(variant)

    ## Detail courses info Multi or Select initialize detail Variant item.
    # @param item Tree with course data.
    # @param titleHBoxLayout HBoxLayout with Multi or Select item.
    # @param type Type of Variant item, Multi or Select.
    # @param variantLabel Label where is name of choice variant.
    # @param maxPoint Max point of Multi item.
    def detailCursesVariant(self, item, titleHBoxLayout=None, type=None, variantLabel=None, maxPoint='-'):
        variantWiget = QtGui.QWidget()
        variantWiget.setObjectName('detailCursesVariantWidget')
        variantQVBoxLayout = QtGui.QVBoxLayout(variantWiget)
        subtitleWidget = QtGui.QWidget()
        subtitleHBoxLayout = QtGui.QHBoxLayout(subtitleWidget)
        variantQVBoxLayout.addWidget(subtitleWidget)
        title = None
        for subItem in item.child:
            cond = True
            if subItem.tag == 'title':
                if subItem.attribute['lang'] != self.setting['userSetting'].language['shortcut']:
                    for item_check in item.child:
                        if item_check.tag == 'title' and item_check.attribute['lang'] == self.setting['userSetting'].language['shortcut']:
                            cond = False
                if cond:
                    title = subItem.text
                    subtitleHBoxLayout.addWidget(QtGui.QLabel(subItem.text))
            elif subItem.tag == 'entry':
                variantWiget.setObjectName('detailCursesVariantWidgetEntry')
                if variantLabel != None:
                    variantLabel.setText(str(title))
                if type == 'select':
                    titleHBoxLayout.addWidget(VerticalSeparator('greySeparator'))
                    if 'points' in subItem.attribute:
                        titleHBoxLayout.addWidget(self.createMenuItem(self._('points'),self.parseDate(subItem.attribute['points'])+'/'+maxPoint))
                    else:
                        titleHBoxLayout.addWidget(self.createMenuItem(self._('points'),'-'+'/'+maxPoint))
                elif type == 'multi':
                    subtitleHBoxLayout.addWidget(VerticalSeparator('greySeparator'))
                    titleHBoxLayout.addWidget(VerticalSeparator('greySeparator'))
                    if 'points' in subItem.attribute:
                        titleHBoxLayout.addWidget(self.createMenuItem(self._('points'),self.parseDate(subItem.attribute['points'])+'/'+maxPoint))
                        subtitleHBoxLayout.addWidget(self.createMenuItem(self._('points'),self.parseDate(subItem.attribute['points'])+'/'+maxPoint))
                    else:
                        titleHBoxLayout.addWidget(self.createMenuItem(self._('points'),'-'+'/'+maxPoint))
                        subtitleHBoxLayout.addWidget(self.createMenuItem(self._('points'),'-')+'/'+maxPoint)
        return (variantWiget)

    ## Parse date metod.
    # @param date Date which is parsing.
    def parseDate(self, date):
        data = date.split('-')
        if len(data) != 3:
            return date
        return(data[2]+'.'+data[1]+'.')

    ## Override close window event.
    # @param event Event which close window.
    def closeEvent(self, event):
        event.ignore()
        self.hide()

    ## Override event Filter
    # @param object Object which rise event.
    # @param event Event which is rise.
    def eventFilter(self, object, event):
        if event.type() == QtCore.QEvent.Enter:
            if object == self.semButton:
                if self.setting['userSetting'].sem['show'] != 'L':
                    self.semButton.setText(self._("summerTermButton"))
                else:
                    self.semButton.setText(self._("winterTermButton"))
        elif event.type() == QtCore.QEvent.Leave:
            if object == self.semButton:
                self.initTerm()
        elif event.type() == QtCore.QEvent.MouseButtonPress:
            if object == self.semButton:
                if self.setting['userSetting'].sem['show'] == 'L':
                    self.setting['userSetting'].sem['show'] = 'Z'
                else:
                    self.setting['userSetting'].sem['show'] = 'L'
                self.setting['userSetting'].save()
                self.initCourseWidget()
            if object == self.refreshButton:

                self.refreshWindow()
            if object == self.closeButton:
                self.hide()
        return False