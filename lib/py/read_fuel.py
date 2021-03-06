#!/usr/bin/python
import psycopg2
from configparser import ConfigParser
import datetime


def get_amount():
    """ query data from the material movement table """
    conn = None
    try:
        params = config()
        conn = psycopg2.connect(**params)
        cur = conn.cursor()

        area_value={};
        area_header={};
        cur.execute("SELECT month \
        ,to_char(hsb/ntrb,'0.00') \
        ,hsd \
        ,hsb \
        ,ntrd \
        ,ntrb \
        FROM vw_tta_cps_fuel_R01 \
        WHERE CURRENT_DATE BETWEEN start_date AND end_date")
        rowcount=cur.rowcount
        print("The number of row: ", rowcount)
        row = cur.fetchone()
        counter=0
        item={}

        if rowcount>0:
            f=open('../../data_fuel.csv','w')
            f.write('Fuel/USD,\n')

        while row is not None:
            f.write('IDR/USD,'+str(row[5])+'\n')
            f.write('IDR/Liter,'+str(row[3])+'\n')
            f.write('USD/Liter,'+str(row[1])+'\n')

            row = cur.fetchone()

        if rowcount>0:
            f.close()
        cur.close()

        print(str(datetime.datetime.now())+' '+str(rowcount)+' row updated')
    except (Exception, psycopg2.DatabaseError) as error:
        print(str(datetime.datetime.now())+' '+str(error))
    finally:
        if conn is not None:
            conn.close()

def config(filename='database.ini', section='postgresql'):
    # create a parser
    parser = ConfigParser()
    # read config file
    parser.read(filename)

    # get section, default to postgresql
    db = {}
    if parser.has_section(section):
        params = parser.items(section)
        for param in params:
            db[param[0]] = param[1]
    else:
        raise Exception('Section {0} not found in the {1} file'.format(section, filename))

    return db

if __name__ == '__main__':
    get_amount()
