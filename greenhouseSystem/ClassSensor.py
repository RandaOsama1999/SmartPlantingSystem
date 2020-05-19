import mysql.connector
from ClassDatabase import sql

class sensor:
    Land_ID=1
    def insertsensorreadings(self,Arduino_Serial,datetime,landownerid):
        database = sql()
        con, cursor = database.connect()
        sensorlist = []
        sensordata = Arduino_Serial.readline()
        sensordata = sensordata.decode('utf-8')
        sensorlist = sensordata.split(" ")
        print(sensorlist[0])
        print(sensorlist[1])
        if (int(sensorlist[0]) > 20):
            print("1 fan on")
            d = datetime.today()
            date = d.strftime("%Y-%m-%d %H:%M:%S")
            try:
                mySql_insert_query = """INSERT INTO notification (user_ID,content_ID,land_ID,DateTime) VALUES ( %s, %s,%s, %s)"""
                insert_blob_tuple = (landownerid, 4, sensor.Land_ID, date)
                result = cursor.execute(mySql_insert_query, insert_blob_tuple)
                con.commit()
            except mysql.connector.Error as error:
                print("Failed".format(error))
        elif (int(sensorlist[0]) > 26):
            print("2 fans on")
            d = datetime.today()
            date = d.strftime("%Y-%m-%d %H:%M:%S")
            try:
                mySql_insert_query = """INSERT INTO notification (user_ID,content_ID,land_ID,DateTime) VALUES ( %s, %s,%s, %s)"""
                insert_blob_tuple = (landownerid, 5, sensor.Land_ID, date)
                result = cursor.execute(mySql_insert_query, insert_blob_tuple)
                con.commit()
            except mysql.connector.Error as error:
                print("Failed".format(error))

        if (int(sensorlist[1]) < 600):
            print("Plant needs water")
            d = datetime.today()
            date = d.strftime("%Y-%m-%d %H:%M:%S")
            try:
                mySql_insert_query = """INSERT INTO notification (user_ID,content_ID,land_ID,DateTime) VALUES ( %s, %s,%s, %s)"""
                insert_blob_tuple = (landownerid, 1, sensor.Land_ID, date)
                result = cursor.execute(mySql_insert_query, insert_blob_tuple)
                con.commit()
            except mysql.connector.Error as error:
                print("Failed".format(error))

        try:
            sql_select_query = "select * from sensors"
            cursor.execute(sql_select_query)
            record = cursor.fetchall()
            d = datetime.today()
            date = d.strftime("%Y-%m-%d %H:%M:%S")
            incremental = 0
            for row in record:
                cursor = con.cursor()
                mySql_insert_query = """INSERT INTO sensor_readings (Land_ID,Sensor_ID,Reading,DateTime) VALUES ( %s, %s,%s, %s)"""
                insert_blob_tuple = (sensor.Land_ID, row[0], sensorlist[incremental], date)
                # print(row[0])
                # print(sensorlist[incremental])
                # print(date)
                result = cursor.execute(mySql_insert_query, insert_blob_tuple)
                con.commit()
                incremental = incremental + 1
        except mysql.connector.Error as error:
            print("Failed".format(error))
        finally:
            if (con.is_connected()):
                cursor.close()
                con.close()