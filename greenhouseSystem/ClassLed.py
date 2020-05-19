import mysql.connector
from ClassDatabase import sql

class Ledsystem:
    Land_ID=1
    def insertledData(self,datetime,value,plantid):
        database = sql()
        con, cursor = database.connect()
        try:
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
                            cursor = con.cursor()
                            mySql_insert_query = """INSERT INTO  ledsystem (LED_ID,Land_ID,Date,opened) VALUES ( %s, %s,%s, %s)"""
                            insert_blob_tuple = (LED_ID, Ledsystem.Land_ID, date, 1)
                            result = cursor.execute(mySql_insert_query, insert_blob_tuple)
                            con.commit()
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
                            cursor = con.cursor()
                            mySql_insert_query = """INSERT INTO  ledsystem (LED_ID,Land_ID,Date,opened) VALUES ( %s, %s,%s, %s)"""
                            insert_blob_tuple = (LED_ID, Ledsystem.Land_ID, date, 1)
                            result = cursor.execute(mySql_insert_query, insert_blob_tuple)
                            con.commit()
            else:
                no2 = 0
                for row in record:
                    Date = row[3]
                    landid = row[2]
                    Date2 = Date.strftime("%Y-%m-%d")
                    if Date2 == date and landid == Ledsystem.Land_ID:
                        print("No")
                        no2 = 0
                    else:
                        no2 = no2 + 1
                if (no2 != 0):
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
                                cursor = con.cursor()
                                mySql_insert_query = """INSERT INTO  ledsystem (LED_ID,Land_ID,Date,opened) VALUES ( %s, %s,%s, %s)"""
                                insert_blob_tuple = (LED_ID, Ledsystem.Land_ID, date, 1)
                                result = cursor.execute(mySql_insert_query, insert_blob_tuple)
                                con.commit()
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
                                cursor = con.cursor()
                                mySql_insert_query = """INSERT INTO  ledsystem (LED_ID,Land_ID,Date,opened) VALUES ( %s, %s,%s, %s)"""
                                insert_blob_tuple = (LED_ID, Ledsystem.Land_ID, date, 1)
                                result = cursor.execute(mySql_insert_query, insert_blob_tuple)
                                con.commit()

        except mysql.connector.Error as error:
            print("Failed".format(error))
        finally:
            if (con.is_connected()):
                cursor.close()
                con.close()