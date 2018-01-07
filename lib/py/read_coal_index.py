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
        jenis_value={};
        jenis_index={};
        tas={};
        cur.execute("SELECT DISTINCT coalesce(jc.name,'') \
        FROM vw_cps_last_3_day dy \
        LEFT JOIN tta_coal_prod_stat_coal_index AS ci \
        ON dy.generate_series=ci.date \
        LEFT JOIN tta_coal_prod_stat_jenis_coal_index AS jc \
        ON ci.jenis=jc.id \
        WHERE coalesce(jc.name,'') <> '' \
        limit 3 ")
        rowcount=cur.rowcount
        print("The number of row: ", rowcount)
        row = cur.fetchone()
        counter=0
        item={}

        if rowcount>0:
            f=open('../../data_coal_index.csv','w')
            f.write('date,')
            while row is not None:
                #print(row)
                jenis_index[counter]=row[0]
                f.write(jenis_index[counter])
                counter+=1
                if counter<rowcount:
                    f.write(",")
                row = cur.fetchone()
            f.write("\n")

        cur.execute("SELECT dy.generate_series::date date,coalesce(jc.name,'') \
        ,coalesce(ci.coal_index,0) coal_index \
        FROM vw_cps_last_3_day dy \
        LEFT JOIN tta_coal_prod_stat_coal_index AS ci \
        ON dy.generate_series=ci.date \
        LEFT JOIN tta_coal_prod_stat_jenis_coal_index AS jc \
        ON ci.jenis=jc.id \
        limit 3 ")
        rowcount=cur.rowcount
        print("The number of row: ", rowcount)
        row = cur.fetchone()

        if rowcount>0:
            while row is not None:
                #f.write(str(row[3])+',')
                date=str(row[0])
                jenis=str(row[1])
                val=str(row[2])
                if date not in item:
                    item_2={}
                    for ah in jenis_index:
                        item_2[jenis_index[ah]]="0"
                    item[date]=item_2
                else:
                    item_2=item[date]
                item_2[jenis]=val
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
