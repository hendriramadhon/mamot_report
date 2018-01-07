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
        bulan={}
        bulan[1]='Januari'
        bulan[2]='Februari'
        bulan[3]='Maret'
        bulan[4]='April'
        bulan[5]='Mei'
        bulan[6]='Juni'
        bulan[7]='Juli'
        bulan[8]='Agustus'
        bulan[9]='September'
        bulan[10]='Oktober'
        bulan[11]='November'
        bulan[12]='Desember'

        plan=init_plan()
        actual=init_actual()

        params = config()
        conn = psycopg2.connect(**params)
        cur = conn.cursor()

        #OB
        cur.execute("SELECT int_month,amount_actual,amount_plan \
        FROM vw_tta_cps_mm_per_month_plan_actual \
        WHERE \
        l1_parent='1' \
        AND \
        year='2017' \
        AND \
        plan_id='1'")
        rowcount=cur.rowcount
        print("The number of row: ", rowcount)
        row = cur.fetchone()

        if rowcount>0:
            f=open('../../data_coal.csv','w')
            f.write('month,plan,actual\n')

        while row is not None:
            #print(row)
            #f.write(bulan[row[0]]+','+str(row[2])+','+str(row[1])+'\n')
            actual[bulan[row[0]]]=row[1]
            plan[bulan[row[0]]]=row[2]
            row = cur.fetchone()

        for b in bulan:
            month=bulan[b]
            f.write(str(month)+','+str(plan[month])+','+str(actual[month])+'\n')
            #print(str(b))

        if rowcount>0:
            f.close()

        plan=init_plan()
        actual=init_actual()

        #OB YTD
        cur.execute("SELECT int_month \
        , amount_actual \
        , sum(amount_actual) OVER (ORDER BY int_month) AS ytd_amount_actual \
        , amount_plan \
        , sum(amount_plan) OVER (ORDER BY int_month) AS ytd_amount_plan \
        FROM vw_tta_cps_mm_per_month_plan_actual \
        WHERE l1_parent=2 AND plan_id=1")
        rowcount=cur.rowcount
        print("The number of row: ", rowcount)
        row = cur.fetchone()

        if rowcount>0:
            f=open('../../data_ob_ytd_2017.csv','w')
            f.write('month,plan_ytd,actual_ytd\n')

        while row is not None:
            #print(row)
            #f.write(bulan[row[0]]+','+str(row[2])+','+str(row[1])+'\n')
            actual[bulan[row[0]]]=row[2]
            plan[bulan[row[0]]]=row[4]
            row = cur.fetchone()

        for b in bulan:
            month=bulan[b]
            f.write(str(month)+','+str(plan[month])+','+str(actual[month])+'\n')
            #print(str(b))

        if rowcount>0:
            f.close()

        plan=init_plan()
        actual=init_actual()

        #COAL YTD
        cur.execute("SELECT int_month \
        , amount_actual \
        , sum(amount_actual) OVER (ORDER BY int_month) AS ytd_amount_actual \
        , amount_plan \
        , sum(amount_plan) OVER (ORDER BY int_month) AS ytd_amount_plan \
        FROM vw_tta_cps_mm_per_month_plan_actual \
        WHERE l1_parent=1 AND plan_id=1")
        rowcount=cur.rowcount
        print("The number of row: ", rowcount)
        row = cur.fetchone()

        if rowcount>0:
            f=open('../../data_coal_ytd_2017.csv','w')
            f.write('month,plan_ytd,actual_ytd\n')

        while row is not None:
            #print(row)
            #f.write(bulan[row[0]]+','+str(row[2])+','+str(row[1])+'\n')
            actual[bulan[row[0]]]=row[2]
            plan[bulan[row[0]]]=row[4]
            row = cur.fetchone()

        for b in bulan:
            month=bulan[b]
            f.write(str(month)+','+str(plan[month])+','+str(actual[month])+'\n')
            #print(str(b))

        if rowcount>0:
            f.close()

        plan=init_plan()
        actual=init_actual()

        #COAL
        cur.execute("SELECT int_month,amount_actual,amount_plan \
        FROM vw_tta_cps_mm_per_month_plan_actual \
        WHERE \
        l1_parent='2' \
        AND \
        year='2017' \
        AND \
        plan_id='1'")
        rowcount=cur.rowcount
        print("The number of row: ", rowcount)
        row = cur.fetchone()

        if rowcount>0:
            f=open('../../data.csv','w')
            f.write('month,plan,actual\n')

        while row is not None:
            #print(row)
            #f.write(bulan[row[0]]+','+str(row[2])+','+str(row[1])+'\n')
            actual[bulan[row[0]]]=row[1]
            plan[bulan[row[0]]]=row[2]
            row = cur.fetchone()

        for b in bulan:
            month=bulan[b]
            f.write(str(month)+','+str(plan[month])+','+str(actual[month])+'\n')
            #print(str(b))

        if rowcount>0:
            f.close()

        plan=init_plan()
        actual=init_actual()
        #SR INCLUDE INFRA
        cur.execute("SELECT int_month \
        ,month \
        ,sr_all_actual \
        ,sr_all_plan \
        FROM vw_tta_cps_sr_all_per_month_plan_actual WHERE plan_id=1")
        rowcount=cur.rowcount
        print("The number of row: ", rowcount)
        row = cur.fetchone()

        if rowcount>0:
            f=open('../../data_sr_all_2017.csv','w')
            f.write('month,sr_plan,sr_actual\n')

        while row is not None:
            #print(row)
            #f.write(bulan[row[0]]+','+str(row[2])+','+str(row[1])+'\n')
            actual[bulan[row[0]]]=row[2]
            plan[bulan[row[0]]]=row[3]
            row = cur.fetchone()

        for b in bulan:
            month=bulan[b]
            f.write(str(month)+','+str(plan[month])+','+str(actual[month])+'\n')
            #print(str(b))

        if rowcount>0:
            f.close()

        plan=init_plan()
        actual=init_actual()

        #SR INCLUDE INFRA YTD
        cur.execute("SELECT int_month \
        ,month \
        ,actual_ytd \
        ,plan_ytd \
        FROM vw_tta_cps_sr_all_per_month_plan_actual WHERE plan_id=1")
        rowcount=cur.rowcount
        print("The number of row: ", rowcount)
        row = cur.fetchone()

        if rowcount>0:
            f=open('../../data_sr_all_ytd_2017.csv','w')
            f.write('month,plan_ytd,actual_ytd\n')

        while row is not None:
            #print(row)
            #f.write(bulan[row[0]]+','+str(row[2])+','+str(row[1])+'\n')
            actual[bulan[row[0]]]=row[2]
            plan[bulan[row[0]]]=row[3]
            row = cur.fetchone()

        for b in bulan:
            month=bulan[b]
            f.write(str(month)+','+str(plan[month])+','+str(actual[month])+'\n')
            #print(str(b))

        if rowcount>0:
            f.close()

        plan=init_plan()
        actual=init_actual()
        #SR EXCLUDE INFRA
        cur.execute("SELECT int_month \
        ,month \
        ,sr_actual \
        ,sr_plan \
        FROM vw_tta_cps_sr_ex_infra_per_month_plan_R01_actual")
        rowcount=cur.rowcount
        print("The number of row: ", rowcount)
        row = cur.fetchone()

        if rowcount>0:
            f=open('../../data_sr_ex_infra_2017.csv','w')
            f.write('month,sr_plan,sr_actual\n')

        while row is not None:
            #print(row)
            #f.write(bulan[row[0]]+','+str(row[2])+','+str(row[1])+'\n')
            actual[bulan[row[0]]]=row[2]
            plan[bulan[row[0]]]=row[3]
            row = cur.fetchone()

        for b in bulan:
            month=bulan[b]
            f.write(str(month)+','+str(plan[month])+','+str(actual[month])+'\n')
            #print(str(b))

        if rowcount>0:
            f.close()

        plan=init_plan()
        actual=init_actual()
        #SR EXCLUDE INFRA YTD
        cur.execute("SELECT int_month \
        ,month \
        ,actual_ytd \
        ,plan_ytd \
        FROM vw_tta_cps_sr_ex_infra_per_month_plan_R01_actual")
        rowcount=cur.rowcount
        print("The number of row: ", rowcount)
        row = cur.fetchone()

        if rowcount>0:
            f=open('../../data_sr_ex_infra_ytd_2017.csv','w')
            f.write('month,plan_ytd,actual_ytd\n')

        while row is not None:
            #print(row)
            #f.write(bulan[row[0]]+','+str(row[2])+','+str(row[1])+'\n')
            actual[bulan[row[0]]]=row[2]
            plan[bulan[row[0]]]=row[3]
            row = cur.fetchone()

        for b in bulan:
            month=bulan[b]
            if plan[month] is None:
                fplan=0
            else:
                fplan=plan[month]
            if actual[month] is None:
                factual=0
            else:
                factual=actual[month]
            f.write(str(month)+','+str(fplan)+','+str(factual)+'\n')
            #print(str(b))

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
