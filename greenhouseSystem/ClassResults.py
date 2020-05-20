import mysql.connector
from ClassDatabase import sql

class results:
    Land_ID = 1

    def inserttestingthreshold(self, datetime,stage,ratio_green):
        database = sql()
        con, cursor = database.connect()
        try:
            sql_select_query = "select * from testing_threshold"
            cursor.execute(sql_select_query)
            record = cursor.fetchall()
            d = datetime.today()
            date = d.strftime("%Y-%m-%d")
            if cursor.rowcount == 0:
                cursor = con.cursor()
                mySql_insert_query = """INSERT INTO testing_threshold (Land_ID,Stage_ID,Percentage,Date) VALUES ( %s, %s,%s, %s)"""
                insert_blob_tuple = (results.Land_ID, stage, ratio_green, date)
                result = cursor.execute(mySql_insert_query, insert_blob_tuple)
                con.commit()
            else:
                no = 0
                for row in record:
                    # print("PlantId = ", row[7], "\n")
                    Date = row[4]
                    landid = row[1]
                    Date2 = Date.strftime("%Y-%m-%d")
                    if Date2 == date and landid == results.Land_ID:
                        print("No")
                        no = 0
                    else:
                        no = no + 1
                if (no != 0):
                    cursor = con.cursor()
                    mySql_insert_query = """INSERT INTO testing_threshold (Land_ID,Stage_ID,Percentage,Date) VALUES ( %s, %s,%s, %s)"""
                    insert_blob_tuple = (results.Land_ID, stage, ratio_green, date)
                    result = cursor.execute(mySql_insert_query, insert_blob_tuple)
                    con.commit()
        except mysql.connector.Error as error:
            print("Failed".format(error))
        finally:
            if (con.is_connected()):
                cursor.close()
                con.close()
