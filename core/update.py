#!/usr/bin/env python
# -*- coding: utf-8 -*-

import urllib    # used for getting Launchpad page
import os        # used for some files manipulations
import datatime  # used for getting the date
import sys       # used for shutting down the script
import shutil    # used for backup

from datetime import datetime




"""------------------------------------
   ----- VARIOUS VARIABLES ------------
   ---------------------------------"""

url              = 'https://launchpad.net/elementary/+milestone/freya-beta2' # URL of the Launchpad page you want
data_file        = 'data.csv'                                                # name of you data file
data_backup_file = 'data_backup.csv'                                         # name of your backup file
temp_file        = 'temp.del'                                                # name of temp file
bugs_line        = 500                                                       # max line of url page source code where bugs count can be found
date             = datetime.utcnow().strftime("%d/%m/%y")                    # the date (UTC)




"""------------------------------------
   ----- LET'S START ------------------
   ---------------------------------"""


# Check if today's datas are here, if true -> let's end the script

if date in open(data_file).read():
    print('no update needed')
    sys.exit()


# Get Launchpad page

response = urllib.urlopen(url)
data     = response.read()
response.close()


# Write data to temp file.

ff = open(temp_file, "w")
ff.write(data)
ff.close()


# Find number of bugs

b_new           = 0
b_incomp        = 0
b_conf          = 0
b_inprog        = 0
b_triaged       = 0
b_fix_committed = 0
b_fix_released  = 0


temp = open(temp_file, "r")
for i, line in enumerate(temp):

        # New bugs.
        if 'span class="statusNEW">' in line and i < bugs_line:
                a = temp.next()
                b = a.split('<strong>')
                c = b[1].split('</strong>')
                b_new = int(c[0])

        # Incomplete bugs.
        if 'span class="statusINCOMPLETE">' in line and i < bugs_line:
                a = temp.next()
                b = a.split('<strong>')
                c = b[1].split('</strong>')
                b_incomp = int(c[0])

        # Confirmed bugs.
        if 'span class="statusCONFIRMED">' in line and i < bugs_line:
                a = temp.next()
                b = a.split('<strong>')
                c = b[1].split('</strong>')
                b_conf = int(c[0])

        # Triaged bugs.
        if 'span class="statusTRIAGED">' in line and i < bugs_line:
                a = temp.next()
                b = a.split('<strong>')
                c = b[1].split('</strong>')
                b_triaged = int(c[0])

        # In progress bugs.
        if 'span class="statusINPROGRESS">' in line and i < bugs_line:
                a = temp.next()
                b = a.split('<strong>')
                c = b[1].split('</strong>')
                b_inprog = int(c[0])

        # In progress bugs.
        if 'span class="statusFIXCOMMITTED">' in line and i < bugs_line:
                a = temp.next()
                b = a.split('<strong>')
                c = b[1].split('</strong>')
                b_fix_committed = int(c[0])

        # In progress bugs.
        if 'span class="statusFIXRELEASED">' in line and i < bugs_line:
                a = temp.next()
                b = a.split('<strong>')
                c = b[1].split('</strong>')
                b_fix_released = int(c[0])


# Delete temp file

os.remove(temp_file)


# Backing up data.csv

shutil.copy2(data_file, data_backup_file)


# Print bugs in .csv file

input = str(date) + ", " + str(b_new) + ', ' + str(b_incomp) + ', ' + str(b_conf) + ', ' + str(b_triaged)  + ', ' + str(b_inprog) + ', ' + str(b_fix_committed) + ', ' + str(b_fix_released)

with open(data_file, 'a') as file:
    file.write('\n' + input)
    print (data_file + ' updated')

# I guess it's the end
