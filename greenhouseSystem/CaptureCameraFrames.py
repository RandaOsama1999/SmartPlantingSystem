import mysql.connector
import cv2
from datetime import datetime
import pytz
from threading import Timer
from mysql.connector import Error
Land_ID=1

def insertBLOB(photo,imageid):
    print("Inserting BLOB into python_employee table")
    try:
        connection1 = mysql.connector.connect(host='localhost',
                                              database='smartplanting',
                                              user='root',
                                              password='')

        cursor = connection1.cursor()
        mySql_insert_query = """INSERT INTO frame (Frame,Time) VALUES ( %s, %s)"""
        Time = datetime.now(pytz.timezone('Africa/Cairo'))
        # Convert data into tuple format
        insert_blob_tuple = (photo, Time)
        result = cursor.execute(mySql_insert_query, insert_blob_tuple)
        frameid=cursor.lastrowid
        connection1.commit()

        cursor2 = connection1.cursor()
        mySql_insert_query_Images = """INSERT INTO  images_frames (Image_Id,Frame_Id,Land_ID) VALUES ( %s, %s, %s) """
        insert_blob_Images = (imageid, frameid, Land_ID)
        result_images = cursor2.execute(mySql_insert_query_Images, insert_blob_Images)
        print(" Added in Table Image-Frames", result_images)
        connection1.commit()

        print("Image and file inserted successfully as a BLOB into frame table", result)


    except mysql.connector.Error as error:
        print("Failed inserting BLOB data into MySQL table {}".format(error))


    finally:
        if (connection1.is_connected()):
            cursor.close()
            connection1.close()
            print("MySQL connection is closed")


def Main():
    imageid=Images_Table()
    cap = cv2.VideoCapture(0)

    if (cap.isOpened() == False):
        print("Error opening video stream or file")

    def ndarray2str(a):
        a = a.tostring()
        return a

    while (cap.isOpened()):
        # Capture frame-by-frame
        ret, frame = cap.read()
        fc = 0
        ret = True
        frameCount = 7
        while (fc < frameCount and ret):
            # Display the resulting frame
            print(fc)
            fc += 1
            a = ndarray2str(frame)
            insertBLOB(a,imageid)

            # Break the loop
        else:
            break
    cap.release()
    return frame
    #Timer(60, Main).start()


def Images_Table():
    try:
        connection = mysql.connector.connect(host='localhost',
                                             database='smartplanting',
                                             user='root',
                                             password='')

        cursor2 = connection.cursor()
        mySql_insert_query_Images = """INSERT INTO  images (Name) VALUES (%s) """

        d = datetime.today()
        date = d.strftime("%d-%Y")
        time = d.strftime('%H:%M')

        # Convert data into tuple format
        Name = date + "+" + time
        insert_blob_Images = (Name,)
        result_images = cursor2.execute(mySql_insert_query_Images, insert_blob_Images)
        imageid=cursor2.lastrowid
        connection.commit()

        print(" Added in Table Image", result_images)
        return imageid

    except mysql.connector.Error as error:
        print("Failed inserting BLOB data into MySQL TableImage {}".format(error))

    finally:
        if (connection.is_connected()):
            cursor2.close()
            connection.close()
            print("MySQL connection is closed")

#Main()
cv2.waitKey(0)
cv2.destroyAllWindows()