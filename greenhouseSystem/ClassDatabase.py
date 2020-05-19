import mysql.connector

class sql:
    def connect(self):
        db = mysql.connector.connect(host='localhost',
                                     port=3306,
                                   database='smartplanting',
                                   user='root',
                                   password='')
        cursor = db.cursor()
        return db,cursor
