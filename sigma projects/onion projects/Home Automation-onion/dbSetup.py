import sqlite3

try:
    conn = sqlite3.connect("mydb.db")
    cur = conn.cursor()
    cur.execute("CREATE TABLE dataTable_losant ("
                "id INTEGER PRIMARY KEY AUTOINCREMENT, new_state TEXT(5), timestamp INTEGER)")

    conn.commit()
    cur.close()
    conn.close()
    print("Table Successfully Created!")
except Exception as e:
    print("An error occurred!\n",
          "Reason : ",e)
