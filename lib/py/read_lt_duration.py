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

        #tas
        area_value={};
        jenis_header={};
        tas={};
        cur.execute("SELECT DISTINCT jenis_id,jenis \
        FROM vw_tta_cps_sum_loss_time_duration \
        GROUP BY \
        jenis \
        ,jenis_id")
        rowcount=cur.rowcount
        print("The number of row: ", rowcount)
        row = cur.fetchone()
        counter=0
        item={}

        if rowcount>0:
            f=open('../../data_loss_time_duration.csv','w')
            while row is not None:
                #print(row)
                jenis_header[counter]=row[1]
                f.write(jenis_header[counter])
                counter+=1
                if counter<rowcount:
                    f.write(",")
                row = cur.fetchone()
            f.write("\n")

        cur.execute("SELECT jenis_id,jenis,SUM(duration) duration \
        FROM vw_tta_cps_sum_loss_time_duration \
        GROUP BY \
        jenis \
        ,jenis_id")
        rowcount=cur.rowcount
        print("The number of row: ", rowcount)
        row = cur.fetchone()

        if rowcount>0:
            while row is not None:
                #f.write(str(row[3])+',')
                duration=str(row[2])
                jenis=str(row[1])
                if jenis not in item:
                    item[jenis]=duration

                row = cur.fetchone()

        counter=0
        for i in item:
            f.write(item[i])
            if counter < len(item)-1:
                f.write(',')
            counter+=1
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
