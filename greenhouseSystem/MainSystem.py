import serial
import numpy as np
import argparse
import cv2
import matplotlib.pyplot as plt
from datetime import datetime
import pytz
import mysql.connector
import CaptureCameraFrames
import runSvm

Arduino_Serial = serial.Serial('COM4',9600)
value=0
Land_ID=1
stage=1
plantid=0
landownerid=0
LED_ID=0
try:
    mySQLConnection = mysql.connector.connect(host='localhost',
                                              database='smartplanting',
                                              user='root',
                                              password='')
    cursor = mySQLConnection.cursor(buffered=True)
    sql_select_query = """select * from land where ID = %s"""
    cursor.execute(sql_select_query, (Land_ID,))
    record = cursor.fetchall()
    plant_ID = 0
    for row in record:
        #print("PlantId = ", row[7], "\n")
        landowner_ID = row[1]
        plant_ID = row[7]
        plantid=plant_ID
        landownerid=landowner_ID
    sql_select_query = """select * from plant where ID = %s"""
    cursor.execute(sql_select_query, (plant_ID,))
    record = cursor.fetchall()
    for row in record:
        #print("Plant = ", row[1], "\n")
        PlantName=row[1]
    sql_select_query = """select * from training_threshold where Plant_ID = %s"""
    cursor.execute(sql_select_query, (plant_ID,))
    record = cursor.fetchall()
    for row in record:
        threshold_percentage = row[3]
    sql_select_query = """select * from timer where Plant_ID = %s"""
    cursor.execute(sql_select_query, (plant_ID,))
    record = cursor.fetchall()
    for row in record:
        HourtobeOpened = row[2]
        HourtobeClosed= row[3]
except mysql.connector.Error as error:
    print("Failed to get record from MySQL table: {}".format(error))
finally:
    if (mySQLConnection.is_connected()):
        cursor.close()
        mySQLConnection.close()
current_time = datetime.now(pytz.timezone('Africa/Cairo'))
print("date and time =", current_time)
print ("The time is now: = %s:%s:%s" % (current_time.hour, current_time.minute, current_time.second))
time2=current_time.minute
hour= current_time.hour
mins = current_time.minute
sec=current_time.second
time=0


while True:
    while (hour>=HourtobeOpened and hour<=HourtobeClosed):
        if time==time2+1:
            img =CaptureCameraFrames.Main()
            #img = cv2.imread('dataset\\29.jpg')  # dataset\\29.jpg  dataset\\31.jpg   dataset\\32.jpg   1.jpg  With.jpg
            classificationresponse=runSvm.runsvm(img)

            lower = np.array((36, 40, 40), dtype="uint8")
            upper = np.array((75, 255, 255), dtype="uint8")
            image = cv2.cvtColor(img, cv2.COLOR_BGR2HSV)
            Value = 0
            mask = cv2.inRange(image, lower, upper)
            output = cv2.bitwise_and(image, image, mask=mask)

            # print(Value)
            # print(cv2.countNonZero(mask)/img.size)
            ratio_green = cv2.countNonZero(mask) / (mask.size)
            print('green pixel percentage:', np.round(ratio_green * 100, 2))

            # cv2.imshow("1", mask)

            #cv2.imshow("images", np.hstack([img, output]))

            hsv = cv2.cvtColor(img, cv2.COLOR_BGR2HSV)

            # lower yellow
            lower_yellow = np.array([0, 150, 200], dtype="uint8")
            upper_yellow = np.array([100, 255, 255], dtype="uint8")

            # lower red
            lower_red = np.array([0, 150, 50])
            upper_red = np.array([16, 255, 255])

            mask_red = cv2.inRange(hsv, lower_red, upper_red)
            res_red = cv2.bitwise_and(img, img, mask=mask_red)

            mask_yellow = cv2.inRange(hsv, lower_yellow, upper_yellow)
            res_yellow = cv2.bitwise_and(img, img, mask=mask_yellow)

            final_mask = mask_red + mask_yellow
            final_result = cv2.bitwise_and(img, img, mask=final_mask)

            ratio_red = cv2.countNonZero(final_mask) / (final_mask.size)
            print('red pixel percentage:', np.round(ratio_red * 100, 2))

            # cv2.imshow("2", maskmerge)

            #cv2.imshow("images2", np.hstack([img, final_result]))

            #calling GreenTomatoFeatureExtractionKNN.py file

            #plt.imshow(mask, cmap='gray')  # this colormap will display in black / white
            #plt.show()

            if np.round(ratio_green * 100, 2) >= threshold_percentage*100 and classificationresponse=="Tomatoes":
                print("Change Blue/Green Light to Red light")
                value=1
                stage=2
                #Arduino_Serial.write('1'.encode())
            elif np.round(ratio_red * 100, 2) >= threshold_percentage*100:
                print("Keep Red light")
                value=1
                stage=3
                #Arduino_Serial.write('1'.encode())
            else:
                print("Keep Blue/Green light")
                value=2
                stage=1
                #Arduino_Serial.write('0'.encode())
            try:
                mySQLConnection2 = mysql.connector.connect(host='localhost',
                                                          database='smartplanting',
                                                          user='root',
                                                          password='')
                cursor = mySQLConnection2.cursor(buffered=True)
                sql_select_query = "select * from testing_threshold"
                cursor.execute(sql_select_query)
                record = cursor.fetchall()
                d = datetime.today()
                date = d.strftime("%Y-%m-%d")
                if cursor.rowcount == 0:
                    cursor = mySQLConnection2.cursor()
                    mySql_insert_query = """INSERT INTO testing_threshold (Land_ID,Stage_ID,Percentage,Date) VALUES ( %s, %s,%s, %s)"""
                    insert_blob_tuple = (Land_ID, stage, ratio_red, date)
                    result = cursor.execute(mySql_insert_query, insert_blob_tuple)
                    mySQLConnection2.commit()
                else:
                    no=0
                    for row in record:
                        # print("PlantId = ", row[7], "\n")
                        Date = row[4]
                        landid=row[1]
                        Date2=Date.strftime("%Y-%m-%d")
                        if Date2==date and landid==Land_ID:
                            print("No")
                            no=0
                        else:
                            no=no+1
                    if(no!=0):
                        cursor = mySQLConnection2.cursor()
                        mySql_insert_query = """INSERT INTO testing_threshold (Land_ID,Stage_ID,Percentage,Date) VALUES ( %s, %s,%s, %s)"""
                        insert_blob_tuple = (Land_ID, stage, ratio_red, date)
                        result = cursor.execute(mySql_insert_query, insert_blob_tuple)
                        mySQLConnection2.commit()
            except mysql.connector.Error as error:
                print("Failed".format(error))
            finally:
                if (mySQLConnection2.is_connected()):
                    cursor.close()
                    mySQLConnection2.close()
            sensorlist = []
            sensordata = Arduino_Serial.readline()
            sensordata = sensordata.decode('utf-8')
            sensorlist = sensordata.split(" ")
            print(sensorlist[0])
            print(sensorlist[1])
            if (int(sensorlist[0]) > 20):
                print("1 fan on")
            elif (int(sensorlist[0]) > 26):
                print("2 fans on")

            if (int(sensorlist[1]) < 600):
                print("Plant needs water")
                d = datetime.today()
                date = d.strftime("%Y-%m-%d %H:%M:%S")
                try:
                    mySQLConnection2 = mysql.connector.connect(host='localhost',
                                                               database='smartplanting',
                                                               user='root',
                                                               password='')
                    cursor = mySQLConnection2.cursor()
                    mySql_insert_query = """INSERT INTO notification (user_ID,content_ID,land_ID,DateTime) VALUES ( %s, %s,%s, %s)"""
                    insert_blob_tuple = (landownerid, 1, Land_ID, date)
                    result = cursor.execute(mySql_insert_query, insert_blob_tuple)
                    mySQLConnection2.commit()
                except mysql.connector.Error as error:
                    print("Failed".format(error))
                finally:
                    if (mySQLConnection2.is_connected()):
                        cursor.close()
                        mySQLConnection2.close()
            try:
                mySQLConnection2 = mysql.connector.connect(host='localhost',
                                                          database='smartplanting',
                                                          user='root',
                                                          password='')
                cursor = mySQLConnection2.cursor(buffered=True)
                sql_select_query = "select * from sensors"
                cursor.execute(sql_select_query)
                record = cursor.fetchall()
                d = datetime.today()
                date = d.strftime("%Y-%m-%d %H:%M:%S")
                incremental=0
                for row in record:
                    cursor = mySQLConnection2.cursor()
                    mySql_insert_query = """INSERT INTO sensor_readings (Land_ID,Sensor_ID,Reading,DateTime) VALUES ( %s, %s,%s, %s)"""
                    insert_blob_tuple = (Land_ID, row[0], sensorlist[incremental], date)
                    # print(row[0])
                    # print(sensorlist[incremental])
                    # print(date)
                    result = cursor.execute(mySql_insert_query, insert_blob_tuple)
                    mySQLConnection2.commit()
                    incremental=incremental+1
            except mysql.connector.Error as error:
                print("Failed".format(error))
            finally:
                if (mySQLConnection2.is_connected()):
                    cursor.close()
                    mySQLConnection2.close()
            #cv2.waitKey(0)
            #if cv2.waitKey(0):
                #Arduino_Serial.write('2'.encode())
            current_time = datetime.now(pytz.timezone('Africa/Cairo'))
            time2 = current_time.minute
        current_time = datetime.now(pytz.timezone('Africa/Cairo'))
        hour = current_time.hour
        mins = current_time.minute
        time = current_time.minute
        sec = current_time.second

    try:
        mySQLConnection2 = mysql.connector.connect(host='localhost',
                                                   database='smartplanting',
                                                   user='root',
                                                   password='')
        cursor = mySQLConnection2.cursor(buffered=True)
        sql_select_query = "select * from ledsystem"
        cursor.execute(sql_select_query)
        record = cursor.fetchall()
        d = datetime.today()
        date = d.strftime("%Y-%m-%d")
        if cursor.rowcount == 0:
            if (value == 1):
                sql_select_query = """select * from plantneededled where Plant_ID = %s"""
                cursor.execute(sql_select_query, (plantid,))
                record = cursor.fetchall()
                d = datetime.today()
                date = d.strftime("%Y-%m-%d")
                for row in record:
                    # print("PlantId = ", row[7], "\n")
                    LED_ID = row[3]
                    Stage_ID = row[1]
                    if (Stage_ID == 2):
                        cursor = mySQLConnection2.cursor()
                        mySql_insert_query = """INSERT INTO  ledsystem (LED_ID,Land_ID,Date,opened) VALUES ( %s, %s,%s, %s)"""
                        insert_blob_tuple = (LED_ID, Land_ID, date, 1)
                        result = cursor.execute(mySql_insert_query, insert_blob_tuple)
                        mySQLConnection2.commit()
            elif (value == 2):
                sql_select_query = """select * from plantneededled where Plant_ID = %s"""
                cursor.execute(sql_select_query, (plantid,))
                record = cursor.fetchall()
                d = datetime.today()
                date = d.strftime("%Y-%m-%d")
                for row in record:
                    # print("PlantId = ", row[7], "\n")
                    LED_ID = row[3]
                    Stage_ID = row[1]
                    if (Stage_ID == 1):
                        cursor = mySQLConnection2.cursor()
                        mySql_insert_query = """INSERT INTO  ledsystem (LED_ID,Land_ID,Date,opened) VALUES ( %s, %s,%s, %s)"""
                        insert_blob_tuple = (LED_ID, Land_ID, date, 1)
                        result = cursor.execute(mySql_insert_query, insert_blob_tuple)
                        mySQLConnection2.commit()
        else:
            no2=0
            for row in record:
                Date = row[3]
                landid = row[2]
                Date2 = Date.strftime("%Y-%m-%d")
                if Date2 == date and landid == Land_ID:
                    print("No")
                    no2=0
                else:
                    no2=no2+1
            if(no2!=0):
                if(value==1):
                    sql_select_query = """select * from plantneededled where Plant_ID = %s"""
                    cursor.execute(sql_select_query, (plantid,))
                    record = cursor.fetchall()
                    d = datetime.today()
                    date = d.strftime("%Y-%m-%d")
                    for row in record:
                        # print("PlantId = ", row[7], "\n")
                        LED_ID = row[3]
                        Stage_ID=row[1]
                        if(Stage_ID==2):
                            cursor = mySQLConnection2.cursor()
                            mySql_insert_query = """INSERT INTO  ledsystem (LED_ID,Land_ID,Date,opened) VALUES ( %s, %s,%s, %s)"""
                            insert_blob_tuple = (LED_ID, Land_ID, date, 1)
                            result = cursor.execute(mySql_insert_query, insert_blob_tuple)
                            mySQLConnection2.commit()
                elif(value==2):
                    sql_select_query = """select * from plantneededled where Plant_ID = %s"""
                    cursor.execute(sql_select_query, (plantid,))
                    record = cursor.fetchall()
                    d = datetime.today()
                    date = d.strftime("%Y-%m-%d")
                    for row in record:
                        # print("PlantId = ", row[7], "\n")
                        LED_ID = row[3]
                        Stage_ID = row[1]
                        if (Stage_ID == 1):
                            cursor = mySQLConnection2.cursor()
                            mySql_insert_query = """INSERT INTO  ledsystem (LED_ID,Land_ID,Date,opened) VALUES ( %s, %s,%s, %s)"""
                            insert_blob_tuple = (LED_ID, Land_ID, date, 1)
                            result = cursor.execute(mySql_insert_query, insert_blob_tuple)
                            mySQLConnection2.commit()

    except mysql.connector.Error as error:
        print("Failed".format(error))
    finally:
        if (mySQLConnection2.is_connected()):
            cursor.close()
            mySQLConnection2.close()
    if value==1:
        print("R")
        #Arduino_Serial.write('1'.encode()) #red led turn on
    elif value==2:
        print("BG")
        #Arduino_Serial.write('0'.encode()) #Blue & Green led turn on


    current_time = datetime.now(pytz.timezone('Africa/Cairo'))
    hour = current_time.hour
    mins = current_time.minute
    time = current_time.minute
    sec = current_time.second