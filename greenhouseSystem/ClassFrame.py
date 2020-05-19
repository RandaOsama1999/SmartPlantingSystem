import cv2
import mysql.connector
from datetime import datetime
import pytz
from ClassDatabase import sql

class Frame:
    Land_ID = 1

    def insertBLOB(self,photo, imageid):
        database=sql()
        con,cursor=database.connect()
        print("Inserting BLOB into python_employee table")
        try:
            mySql_insert_query = """INSERT INTO frame (Frame,Time) VALUES ( %s, %s)"""
            Time = datetime.now(pytz.timezone('Africa/Cairo'))
            # Convert data into tuple format
            insert_blob_tuple = (photo, Time)
            result = cursor.execute(mySql_insert_query, insert_blob_tuple)
            frameid = cursor.lastrowid
            con.commit()

            cursor2 = con.cursor()
            mySql_insert_query_Images = """INSERT INTO  images_frames (Image_Id,Frame_Id,Land_ID) VALUES ( %s, %s, %s) """
            insert_blob_Images = (imageid, frameid, Frame.Land_ID)
            result_images = cursor2.execute(mySql_insert_query_Images, insert_blob_Images)
            print(" Added in Table Image-Frames", result_images)
            con.commit()

            print("Image and file inserted successfully as a BLOB into frame table", result)


        except mysql.connector.Error as error:
            print("Failed inserting BLOB data into MySQL table {}".format(error))


        finally:
            if (con.is_connected()):
                cursor.close()
                con.close()
                print("MySQL connection is closed")

    def Mainfunc(self):
        imageid = self.Images_Table()
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
                self.insertBLOB(a, imageid)

                # Break the loop
            else:
                break
        cap.release()
        return frame
        # Timer(60, Main).start()

    def Images_Table(self):
        try:
            database = sql()
            con, cursor = database.connect()
            mySql_insert_query_Images = """INSERT INTO  images (Name) VALUES (%s) """

            d = datetime.today()
            date = d.strftime("%d-%Y")
            time = d.strftime('%H:%M')

            # Convert data into tuple format
            Name = date + "+" + time
            insert_blob_Images = (Name,)
            result_images = cursor.execute(mySql_insert_query_Images, insert_blob_Images)
            imageid = cursor.lastrowid
            con.commit()

            print(" Added in Table Image", result_images)
            return imageid

        except mysql.connector.Error as error:
            print("Failed inserting BLOB data into MySQL TableImage {}".format(error))

        finally:
            if (con.is_connected()):
                cursor.close()
                con.close()
                print("MySQL connection is closed")
