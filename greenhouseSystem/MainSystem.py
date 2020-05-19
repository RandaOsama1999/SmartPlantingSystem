import serial
import numpy as np
import argparse
import cv2
import matplotlib.pyplot as plt
from datetime import datetime
import pytz
import mysql.connector
from ClassFrame import Frame
import runSvm
from ClassLand import Land
import Preprocessing
from ClassResults import results
from ClassSensor import sensor
from ClassLed import Ledsystem

Arduino_Serial = serial.Serial('COM3', 9600)
Arduino_Serial2 = serial.Serial('COM4', 9600)

value = 0
Land_ID = 1
stage = 1
LED_ID = 0

land = Land()
plantid, landownerid = land.getLandowner()
plantname = land.getPlant(plantid)
threshold_percentage = land.getTrainingThreshold(plantid)
HourtobeOpened, HourtobeClosed = land.getTimer(plantid)
current_time = datetime.now(pytz.timezone('Africa/Cairo'))
print(plantname)
print("date and time =", current_time)
print("The time is now: = %s:%s:%s" % (current_time.hour, current_time.minute, current_time.second))
time2 = current_time.minute
hour = current_time.hour
mins = current_time.minute
sec = current_time.second
time = 0

while True:
    while (hour >= 16 and hour <= 16) and (mins >= 0 and mins <= 20):
        if time == time2 + 1:
            frame = Frame()
            img = frame.Mainfunc()
            # img =CaptureCameraFrames.Main()
            # img = cv2.imread('dataset\\29.jpg')  # dataset\\29.jpg  dataset\\31.jpg   dataset\\32.jpg   1.jpg  With.jpg
            classificationresponse = runSvm.runsvm(img)
            ratio_green, ratio_red = Preprocessing.convertRGBtoHSV(img)

            if np.round(ratio_green * 100, 2) >= threshold_percentage * 100 and classificationresponse == "Tomatoes":
                print("Change Blue/Green Light to Red light")
                value = 1
                stage = 2
                # Arduino_Serial.write('1'.encode())
            elif np.round(ratio_red * 100, 2) >= threshold_percentage * 100:
                print("Keep Red light")
                value = 1
                stage = 3
                # Arduino_Serial.write('1'.encode())
            else:
                print("Keep Blue/Green light")
                value = 2
                stage = 1
                # Arduino_Serial.write('0'.encode())
            res=results()
            res.inserttestingthreshold(datetime, stage, ratio_red)
            sens=sensor()
            sens.insertsensorreadings(Arduino_Serial2, datetime, landownerid)
            # cv2.waitKey(0)
            # if cv2.waitKey(0):
            # Arduino_Serial.write('2'.encode())
            current_time = datetime.now(pytz.timezone('Africa/Cairo'))
            time2 = current_time.minute
        current_time = datetime.now(pytz.timezone('Africa/Cairo'))
        hour = current_time.hour
        mins = current_time.minute
        time = current_time.minute
        sec = current_time.second
    led = Ledsystem()
    led.insertledData(datetime, value, plantid)

    if value == 1:
        print("R")
        Arduino_Serial.write('1'.encode())  # red led turn on
    elif value == 2:
        print("BG")
        Arduino_Serial.write('0'.encode())  # Blue & Green led turn on

    current_time = datetime.now(pytz.timezone('Africa/Cairo'))
    hour = current_time.hour
    mins = current_time.minute
    time = current_time.minute
    sec = current_time.second
