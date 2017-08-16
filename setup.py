#!/usr/bin/python3
__author__ = 'Jakub Pelikan'
from setuptools import setup
import sys

def getDataFiles():
    if sys.platform == 'linux':
       return [('/usr/share/applications', ['postinst/fitIS.desktop']),('/usr/share/pixmaps/', ['postinst/fitIS.png'])]
    else:
        return []

setup(
    name='wis',
    version='1.0',
    description='Fit information system',
    long_description='-',
    url='-',
    author='Jakub Pelikan',
    author_email='xpelik14@stud.fit.vutbr.cz',
    keywords=['wis', 'fit', 'vutbr'],
    include_package_data=True,
    packages=['fitIS','fitIS.gui','fitIS.xmlParser'],
    classifiers=[
			'Programming Language :: Python :: 3 :: Only'
			'Operating System :: OS Independent'
			'Development Status :: 3 - Alpha'
			'License :: OSI Approved :: GNU General Public License v3 (GPLv3)'
			],
    entry_points = {
        'gui_scripts': [
            'wis = fitIS.__main__:main'
        ]
    },
    install_requires=['pbkdf2', 'Crypto','httplib2','pyCrypto'],
    data_files= getDataFiles(),
)