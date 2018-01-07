#!/usr/bin/python
import psycopg2
from configparser import ConfigParser
import datetime

def init_plan():
    plan={}
    plan['Januari']=0
    plan['Februari']=0
    plan['Maret']=0
    plan['April']=0
    plan['Mei']=0
    plan['Juni']=0
    plan['Juli']=0
    plan['Agustus']=0
    plan['September']=0
    plan['Oktober']=0
    plan['November']=0
    plan['Desember']=0
    return plan
def init_actual():
    actual={}
    actual['Januari']=0
    actual['Februari']=0
    actual['Maret']=0
    actual['April']=0
    actual['Mei']=0
    actual['Juni']=0
    actual['Juli']=0
    actual['Agustus']=0
    actual['September']=0
    actual['Oktober']=0
    actual['November']=0
    actual['Desember']=0
    return actual

def get_amount():
    """ query data from the material movement table """
    conn = None
    try:
        params = config()
        conn = psycopg2.connect(**params)
        cur = conn.cursor()

        #tas
        area_value={};
        area_header={};
        tas={};
        cur.execute("SELECT DISTINCT area_id,area \
        FROM vw_tta_cps_tas tas \
        LEFT JOIN tta_coal_prod_stat_periode_month as mon \
        ON tas.periode_month_id=mon.id \
        WHERE \
        CURRENT_DATE BETWEEN mon.start_date AND mon.end_date")
        rowcount=cur.rowcount
        print("The number of row: ", rowcount)
        row = cur.fetchone()
        counter=0
        item={}

        if rowcount>0:
            f=open('../../data_tas.csv','w')
            f.write('date,')
            while row is not None:
                #print(row)
                area_header[counter]=row[1]
                f.write(area_header[counter])
                counter+=1
                if counter<rowcount:
                    f.write(",")
                row = cur.fetchone()
            f.write("\n")

        cur.execute("SELECT tas,area_id,area,date \
        FROM vw_tta_cps_tas tas \
        LEFT JOIN tta_coal_prod_stat_periode_month as mon \
        ON tas.periode_month_id=mon.id \
        WHERE \
        CURRENT_DATE BETWEEN mon.start_date AND mon.end_date")
        rowcount=cur.rowcount
        print("The number of row: ", rowcount)
        row = cur.fetchone()

        if rowcount>0:
            while row is not None:
                #f.write(str(row[3])+',')
                date=str(row[3])
                area=str(row[2])
                val=str(row[0])
                if date not in item:
                    item_2={}
                    for ah in area_header:
                        item_2[area_header[ah]]="0"
                    item[date]=item_2
                else:
                    item_2=item[date]
                item_2[area]=val
                row = cur.fetchone()

        for i in item:
            f.write(i+',')
            counter=0
            for idx in item[i]:
                tmp=item[i]
                f.write(tmp[idx])
                if counter < len(item[i])-1:
                    f.write(',')
                counter+=1
            f.write("\n")
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
