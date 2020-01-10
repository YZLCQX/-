#2020.1.6
#清除过期cookie
import time
import pymysql

t = int(time.time()) - 1800

my = pymysql.connect(
        host = '127.0.0.1',user = 'root',passwd = '',
        port = 3306,db = 'web_user_info_data',charset = 'utf8'
)

sql = my.cursor()

s = "delete from web_cookie_table where time < "+str(t)
print (s)

sql.execute(s)  #查询数据
my.commit()
res = sql.fetchall()    #获取结果
print(res)
sql.close()     #关闭游标
my.close()
print (t)