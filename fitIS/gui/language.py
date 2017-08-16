#!/usr/bin/python3
__author__ = 'Jakub Pelikan'
import gettext
import os


class Languge():
    """
    Language class enable use more language.
    @author Jakub Pelikan
    @version 1.0
    @package fitIS.gui
    """
    ## The constructor
    # @param setting Application setting.
    def __init__(self, setting):
        self.setting = setting
        self.setLanguage()

    ## Method set actual language
    def setLanguage(self):
        self.language = gettext.translation(self.setting['userSetting'].language['fileName'], os.path.join(self.setting['path'],self.setting['userSetting'].language['path']), fallback=True, languages=[self.setting['userSetting'].getLanguage()])
        self.gettext = self.language.gettext

    ## Method update actual language
    # @param setting Application setting.
    def update(self, setting):
        self.setting = setting
        self.setLanguage()