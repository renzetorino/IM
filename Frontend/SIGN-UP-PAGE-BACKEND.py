import mysql.connector
from flask import Flask, render_template, request, redirect, url_for
from werkzeug.security import generate_password_hash, check_password_hash

app = Flask(__name__)

database = mysql.connector.connect(
    host="localhost",
    user="root",
    password="!Rt2394646",
    database="safehousepup"
)

def web():
    return render_template('SIGN UP PAGE.html')

def signup():
    if request.method == 'POST':
        username = request.form['username']
        email = request.form['email']
        firstname = request.form['firstname']
        lastname = request.form['lastname']
        address = request.form['Address']
        password = request.form['password']
        confirm_password = request.form['confirm_password']

        if password != confirm_password:
            return "Passwords do not match"

        hashed_password = generate_password_hash(password)

        cursor = database.cursor()

        try:
            cursor.execute("INSERT INTO USER_INFO(Username, Email, FIRSTNAME, LASTNAME, Address, Password) VALUES(%s, %s, %s, %s, %s, %s)",
                           (username, email, firstname, lastname, address, hashed_password))
            database.commit()
        except mysql.connector.Error as err:
            return f"Error: {err}"
        finally:
            cursor.close()

        return redirect(url_for('web'))

if __name__ == '__main__':
    app.run(debug=True)
