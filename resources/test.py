from flask import Flask, render_template, request, redirect, url_for, session
from flask_mysqldb import MySQL
import mysql.connector

app = Flask(__name__,folder="components")
app.secret_key = "chocolate beauty"

app.config['ENV'] = 'development'
app.config['DEBUG'] = True
app.config["MYSQL_HOST"]="localhost"
app.config["MYSQL_USER"]="root"
app.config["MYSQL_PASSWORD"]=""
app.config["MYSQL_DB"]="financial_advisor"