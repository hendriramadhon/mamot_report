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
        raw={}
        raw['plan']={}
        raw['actual']={}

        cur.execute("SELECT slc.*,plc.amount as amount_plan,ppm.amount as price \
        ,to_char((slc.amount*ppm.amount)/aco.amount_actual_coal,'999.999') as cost_actual \
        , to_char((plc.amount*ppm.amount)/aco.amount_actual_coal,'999.999') as cost_plan \
        ,aco.amount_actual_coal \
        FROM vw_tta_cps_sum_land_clearing_now AS slc \
        LEFT JOIN vw_tta_cps_price_per_month AS ppm \
        ON slc.int_month=ppm.month \
        AND slc.year_id=ppm.year_id \
        LEFT JOIN vw_tta_cps_plan_land_clearing AS plc \
        ON slc.periode_month_id=plc.periode_month_id \
        AND slc.land_clearing_location_id=plc.land_clearing_location_id \
        LEFT JOIN vw_tta_cps_sr_all_per_month_plan_actual as aco \
        ON aco.int_month=slc.int_month \
        WHERE ppm.jenis_price=10 \
        AND aco.plan_id=1")
        rowcount=cur.rowcount
        print("The number of row: ", rowcount)
        row = cur.fetchone()
        counter=0
        item={}

        if rowcount>0:
            f=open('../../data_cost_per_ton.csv','w')
            f.write('AREA,PLAN,ACTUAL\n')
            while row is not None:
                #print(row)
                raw["plan"]=row[11]
                raw["actual"]=row[10]
                f.write(str('RAW')+','+str(raw["plan"])+','+str(raw["actual"])+"\n")

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
