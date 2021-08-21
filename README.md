# チーム「ワイハリマ」
### メンバー
* [yuta1024](https://github.com/yuta1024)
* [nhirokinet](https://github.com/nhirokinet)
* [tyabuki](https://github.com/tyabuki)

### 過去
* ISUCON7
    - [nhirokinet/isubata](https://github.com/nhirokinet/isubata)
* ISUCON8
    - [yuta1024/isucon8](https://github.com/yuta1024/isucon8)
    - [yuta1024/isucon8-infra](https://github.com/yuta1024/isucon8-infra)
* ISUCON9
    - [yuta1024/isucon9](https://github.com/yuta1024/isucon9)
* ISUCON10
    - [tyabuki/isucon10](https://github.com/tyabuki/isucon10)
* ISUCON11
    - [yuta1024/isucon11](https://github.com/yuta1024/isucon11)

# isucon11
ISUCON11 qualifying repository of ワイハリマ 🌴 team

### score
```
#36253	26656	FINISHED	2021-08-21 18:41:21.913	a minute - [latest] weight=5
#35981	24481	FINISHED	2021-08-21 18:39:30.430	a minute - weight=5
#35518	24231	FINISHED	2021-08-21 18:36:02.677	a minute - weight=6
#35280	25453	FINISHED	2021-08-21 18:34:22.800	a minute - weight=4
#35016	29189	FINISHED	2021-08-21 18:32:28.922	a minute - [best] weight=5
```

![portal isucon net_contestant_benchmark_jobs(a)](https://user-images.githubusercontent.com/7386418/130318332-4a2bfc72-bc80-465a-a685-0831e8965669.png)






### db
```sql
MariaDB [(none)]> create user 'isucon'@'%' identified by 'isucon';
Query OK, 0 rows affected (0.000 sec)

MariaDB [(none)]> grant all on *.* to 'isucon'@'%';
Query OK, 0 rows affected (0.000 sec)

MariaDB [(none)]> select * from mysql.user;
+-----------+--------+-------------------------------------------+-------------+-------------+-------------+-------------+-------------+-----------+-------------+---------------+--------------+-----------+------------+-----------------+------------+------------+--------------+------------+-----------------------+------------------+--------------+-----------------+------------------+------------------+----------------+---------------------+--------------------+------------------+------------+--------------+------------------------+---------------------+----------+------------+-------------+--------------+---------------+-------------+-----------------+----------------------+-------------+-----------------------+------------------+---------+--------------+--------------------+
| Host      | User   | Password                                  | Select_priv | Insert_priv | Update_priv | Delete_priv | Create_priv | Drop_priv | Reload_priv | Shutdown_priv | Process_priv | File_priv | Grant_priv | References_priv | Index_priv | Alter_priv | Show_db_priv | Super_priv | Create_tmp_table_priv | Lock_tables_priv | Execute_priv | Repl_slave_priv | Repl_client_priv | Create_view_priv | Show_view_priv | Create_routine_priv | Alter_routine_priv | Create_user_priv | Event_priv | Trigger_priv | Create_tablespace_priv | Delete_history_priv | ssl_type | ssl_cipher | x509_issuer | x509_subject | max_questions | max_updates | max_connections | max_user_connections | plugin      | authentication_string | password_expired | is_role | default_role | max_statement_time |
+-----------+--------+-------------------------------------------+-------------+-------------+-------------+-------------+-------------+-----------+-------------+---------------+--------------+-----------+------------+-----------------+------------+------------+--------------+------------+-----------------------+------------------+--------------+-----------------+------------------+------------------+----------------+---------------------+--------------------+------------------+------------+--------------+------------------------+---------------------+----------+------------+-------------+--------------+---------------+-------------+-----------------+----------------------+-------------+-----------------------+------------------+---------+--------------+--------------------+
| localhost | root   |                                           | Y           | Y           | Y           | Y           | Y           | Y         | Y           | Y             | Y            | Y         | Y          | Y               | Y          | Y          | Y            | Y          | Y                     | Y                | Y            | Y               | Y                | Y                | Y              | Y                   | Y                  | Y                | Y          | Y            | Y                      | Y                   |          |            |             |              |             0 |           0 |               0 |                    0 | unix_socket |                       | N                | N       |              |           0.000000 |
| localhost | isucon | *95F1650F5864E64F256415711A6767087C3D0ECB | Y           | Y           | Y           | Y           | Y           | Y         | Y           | Y             | Y            | Y         | Y          | Y               | Y          | Y          | Y            | Y          | Y                     | Y                | Y            | Y               | Y                | Y                | Y              | Y                   | Y                  | Y                | Y          | Y            | Y                      | Y                   |          |            |             |              |             0 |           0 |               0 |                    0 |             |                       | N                | N       |              |           0.000000 |
| %         | isucon | *95F1650F5864E64F256415711A6767087C3D0ECB | Y           | Y           | Y           | Y           | Y           | Y         | Y           | Y             | Y            | Y         | N          | Y               | Y          | Y          | Y            | Y          | Y                     | Y                | Y            | Y               | Y                | Y                | Y              | Y                   | Y                  | Y                | Y          | Y            | Y                      | Y                   |          |            |             |              |             0 |           0 |               0 |                    0 |             |                       | N                | N       |              |           0.000000 |
+-----------+--------+-------------------------------------------+-------------+-------------+-------------+-------------+-------------+-----------+-------------+---------------+--------------+-----------+------------+-----------------+------------+------------+--------------+------------+-----------------------+------------------+--------------+-----------------+------------------+------------------+----------------+---------------------+--------------------+------------------+------------+--------------+------------------------+---------------------+----------+------------+-------------+--------------+---------------+-------------+-----------------+----------------------+-------------+-----------------------+------------------+---------+--------------+--------------------+
3 rows in set (0.000 sec)
```
