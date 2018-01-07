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
        sr={}
        sr["plan"]={}
        sr["actual"]={}
        sr["achievement"]={}
        cg={}
        cg["plan"]={}
        cg["actual"]={}
        cg["achievement"]={}
        cur.execute("SELECT pm.start_date \
        ,pm.end_date \
        ,to_char(pa.sr_all_actual,'0.00') \
        ,to_char(pa.sr_all_plan,'0.00') \
        ,(pa.sr_all_actual/pa.sr_all_plan)*100 sr_achievement \
        ,pa.amount_actual_coal \
        ,pa.amount_plan_coal \
        ,(pa.amount_actual_coal/pa.amount_plan_coal)*100 cg_achievement \
        FROM tta_coal_prod_stat_periode_month AS pm \
        LEFT JOIN tta_coal_prod_stat_month AS mo \
        ON pm.month_id=mo.id \
        LEFT JOIN vw_tta_cps_sr_all_per_month_plan_actual AS pa \
        ON pa.int_month=mo.month \
        WHERE CURRENT_DATE BETWEEN pm.start_date AND pm.end_date")
        rowcount=cur.rowcount
        print("The number of row: ", rowcount)
        row = cur.fetchone()
        counter=0
        item={}

        if rowcount>0:
            f=open('../../data_operational_ach.csv','w')
            f.write('PLAN,ACTUAL,ACHIEVEMENT\n')
            while row is not None:
                #print(row)
                sr["plan"]=row[3]
                sr["actual"]=row[2]
                sr["achievement"]=row[4]
                f.write(str("SR,SR,SR"+"\n"))
                f.write(str(sr["plan"])+","+str(sr["actual"])+","+str(sr["achievement"])+"\n")
                cg["plan"]=row[6]
                cg["actual"]=row[5]
                cg["achievement"]=row[7]
                f.write(str("Coal Getting,Coal Getting,Coal Getting"+"\n"))
                f.write(str(cg["plan"])+","+str(cg["actual"])+","+str(cg["achievement"])+"\n")

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
