
+----+--------+------------+-------+
| id | type   | date       | value |
+----+--------+------------+-------+
| 1  | photo  | 2015-02-02 | 1240  |
+----+--------+------------+-------+
| 2  | image  | 2015-02-02 | 5609  |
+----+--------+------------+-------+
...
+----+--------+------------+-------+
| 50 | photo  | 2015-02-01 | 1190  |
+----+--------+------------+-------+
| 51 | review | 2015-02-02 | 3600  |
+----+--------+------------+-------+



SELECT * FROM (SELECT * FROM t1  ORDER BY date DESC) t GROUP BY type

//Если необходимо получить самые первые данные для type то можно просто поменять ORDER BY date [ASC]