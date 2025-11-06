import os
import pandas as pd
import mysql.connector
from dotenv import load_dotenv
import streamlit as st

load_dotenv(dotenv_path="C:\\ApoiaMais\\.env")

port = os.getenv("DB_PORT")
db_config = {
    "host": os.getenv("DB_HOST"),
    "user": os.getenv("DB_USERNAME"),
    "password": os.getenv("DB_PASSWORD"),
    "database": os.getenv("DB_DATABASE"),
    "port": int(port) if port else 3306,  
}

try:
    conn = mysql.connector.connect(**db_config)
    st.success("Conectado ao banco com sucesso! ")
except Exception as e:
    st.error(f"Erro na conexão: {e}")
    st.stop()

query = "SELECT name FROM users;"  

df = pd.read_sql(query, conn)

st.title("Dashboard - ApoiaMais")
st.subheader("Lista de Nomes dos Usuários")
st.dataframe(df)

conn.close()