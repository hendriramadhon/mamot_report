#!/bin/sh

python /var/www/html/test/lib/py/read.py >> /var/www/html/test/lib/py/log
python /var/www/html/test/lib/py/read_lt_duration.py >> /var/www/html/test/lib/py/log_lt_duration
python /var/www/html/test/lib/py/read_lt.py >> /var/www/html/test/lib/py/log_lt
python /var/www/html/test/lib/py/read_rain_fall.py >> /var/www/html/test/lib/py/log_rain_fall
python /var/www/html/test/lib/py/read_coal_getting.py >> /var/www/html/test/lib/py/log_coal_getting
python /var/www/html/test/lib/py/read_coal_index.py >> /var/www/html/test/lib/py/log_coal_index
python /var/www/html/test/lib/py/read_operational_achievement.py >> /var/www/html/test/lib/py/log_opr
python /var/www/html/test/lib/py/read_cost_per_ton.py >> /var/www/html/test/lib/py/log_cpt
