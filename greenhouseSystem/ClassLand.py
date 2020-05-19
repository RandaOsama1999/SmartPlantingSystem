import mysql.connector
from ClassDatabase import sql

class Land:
    Land_ID = 1
    def getLand(self):
        database = sql()
        con, cursor = database.connect()
        try:
            sql_select_query = """select * from land where ID = %s"""
            cursor.execute(sql_select_query, (Land.Land_ID,))
            record = cursor.fetchall()
            plant_ID = 0
            for row in record:
                # print("PlantId = ", row[7], "\n")
                landowner_ID = row[1]
                plant_ID = row[7]
                self.getPlant(plant_ID)
        except mysql.connector.Error as error:
            print("Failed to get record from MySQL table: {}".format(error))
        finally:
            if (con.is_connected()):
                cursor.close()
                con.close()

    def getLandowner(self):
        database = sql()
        con, cursor = database.connect()
        landowner_ID=0
        plant_ID = 0
        try:
            sql_select_query = """select * from land where ID = %s"""
            cursor.execute(sql_select_query, (Land.Land_ID,))
            record = cursor.fetchall()
            for row in record:
                # print("PlantId = ", row[7], "\n")
                landowner_ID = row[1]
                plant_ID = row[7]
                self.getPlant(plant_ID)
        except mysql.connector.Error as error:
            print("Failed to get record from MySQL table: {}".format(error))
        finally:
            if (con.is_connected()):
                cursor.close()
                con.close()
        return plant_ID,landowner_ID

    def getPlant(self,plantid):
        database = sql()
        con, cursor = database.connect()
        PlantName=""
        try:
            sql_select_query = """select * from plant where ID = %s"""
            cursor.execute(sql_select_query, (plantid,))
            record = cursor.fetchall()
            for row in record:
                # print("Plant = ", row[1], "\n")
                PlantName = row[1]
        except mysql.connector.Error as error:
            print("Failed to get record from MySQL table: {}".format(error))
        finally:
            if (con.is_connected()):
                cursor.close()
                con.close()
        return PlantName

    def getTrainingThreshold(self,plantid):
        database = sql()
        con, cursor = database.connect()
        threshold_percentage=0
        try:
            sql_select_query = """select * from training_threshold where Plant_ID = %s"""
            cursor.execute(sql_select_query, (plantid,))
            record = cursor.fetchall()
            for row in record:
                threshold_percentage = row[3]
        except mysql.connector.Error as error:
            print("Failed to get record from MySQL table: {}".format(error))
        finally:
            if (con.is_connected()):
                cursor.close()
                con.close()
        return threshold_percentage

    def getTimer(self,plantid):
        database = sql()
        con, cursor = database.connect()
        HourtobeOpened=0
        HourtobeClosed=0
        try:
            sql_select_query = """select * from timer where Plant_ID = %s"""
            cursor.execute(sql_select_query, (plantid,))
            record = cursor.fetchall()
            for row in record:
                HourtobeOpened = row[2]
                HourtobeClosed = row[3]
        except mysql.connector.Error as error:
            print("Failed to get record from MySQL table: {}".format(error))
        finally:
            if (con.is_connected()):
                cursor.close()
                con.close()
        return HourtobeOpened,HourtobeClosed