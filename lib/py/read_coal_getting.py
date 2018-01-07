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
        cur.execute("SELECT l3d.generate_series::date \
        ,coalesce(coa.amount,0) AS coal \
        ,coalesce(obu.amount,0) AS ob \
         FROM vw_cps_last_3_day AS l3d \
        LEFT JOIN vw_tta_cps_cg_per_day coa \
        ON l3d.generate_series=coa.date_movement \
        LEFT JOIN vw_tta_cps_ob_per_day obu \
        ON l3d.generate_series=obu.date_movement \
        limit 3 ")
        rowcount=cur.rowcount
        print("The number of row: ", rowcount)
        row = cur.fetchone()
        counter=0
        item={}

        if rowcount>0:
            f=open('../../data_coal_getting.csv','w')
            f.write("Date,Coal,OB\n")

        while row is not None:
            f.write(str(row[0])+',')
            f.write(str(row[1])+',')
            f.write(str(row[2])+'\n')

            row = cur.fetchone()

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
