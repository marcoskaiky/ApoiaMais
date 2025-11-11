import os
import pandas as pd
import mysql.connector
from dotenv import load_dotenv
import streamlit as st
import altair as alt
from datetime import date

load_dotenv(dotenv_path="C:\\ApoiaMais\\.env")

st.set_page_config(page_title="Apoia+ - Visão Geral", layout="wide")



port = os.getenv("DB_PORT")
db_config = {
	"host": os.getenv("DB_HOST"),
	"user": os.getenv("DB_USERNAME"),
	"password": os.getenv("DB_PASSWORD"),
	"database": os.getenv("DB_DATABASE"),
	"port": int(port) if port else 3306,
}

def get_connection():
	try:
		return mysql.connector.connect(**db_config)
	except Exception as e:
		st.error(f"Erro na conexão: {e}")
		st.stop()


def query_df(sql: str, params: tuple | None = None) -> pd.DataFrame:
	conn = get_connection()
	try:
		return pd.read_sql(sql, conn, params=params)
	finally:
		conn.close()


total_doadores = query_df("SELECT COUNT(*) AS qt FROM doadors")
total_itens = query_df("SELECT COUNT(*) AS qt FROM items")
total_doacoes = query_df("SELECT COUNT(*) AS qt FROM receber_doacaos")
itens_recebidos = query_df("SELECT COALESCE(SUM(quantidade),0) AS qt FROM receber_doacao_items")

st.title("Apoia+ • Visão Geral")
with st.container():
	col1, col2, col3, col4 = st.columns(4)
	col1.metric("Doadores", int(total_doadores.iloc[0]["qt"]))
	col2.metric("Itens Cadastrados", int(total_itens.iloc[0]["qt"]))
	col3.metric("Doações Registradas", int(total_doacoes.iloc[0]["qt"]))
	col4.metric("Itens Recebidos (total)", int(itens_recebidos.iloc[0]["qt"]))

st.markdown("---")


estoque_sql = """
SELECT
	i.id,
	i.nome,
	i.estoque_minimo,
	COALESCE(SUM(rdi.quantidade), 0) AS quantidade
FROM items i
LEFT JOIN receber_doacao_items rdi ON rdi.item_id = i.id
GROUP BY i.id, i.nome, i.estoque_minimo
"""
df_estoque = query_df(estoque_sql)
df_estoque["saldo_vs_min"] = df_estoque["quantidade"] - df_estoque["estoque_minimo"]

colA, colB = st.columns([2, 1])
with colA:
	st.subheader("Estoque por Item (comparativo com mínimo)")
	bar = alt.Chart(df_estoque).mark_bar().encode(
		x=alt.X("nome:N", sort="-y", title="Item"),
		y=alt.Y("quantidade:Q", title="Em estoque"),
		color=alt.condition(alt.datum.saldo_vs_min < 0, alt.value("#d9534f"), alt.value("#1f77b4")),
		tooltip=["nome", "quantidade", "estoque_minimo", "saldo_vs_min"]
	).properties(height=400)
	line_min = alt.Chart(df_estoque).mark_rule(color="#f0ad4e").encode(y="estoque_minimo:Q")
	st.altair_chart(bar + line_min, use_container_width=True)
with colB:
	st.subheader("Abaixo do mínimo")
	abaixo = df_estoque[df_estoque["saldo_vs_min"] < 0].sort_values("saldo_vs_min")
	if abaixo.empty:
		st.success("Nenhum item abaixo do mínimo.")
	else:
		st.dataframe(abaixo[["nome", "quantidade", "estoque_minimo", "saldo_vs_min"]], use_container_width=True, height=400)

st.markdown("---")


top_itens_sql = """
SELECT i.nome, COALESCE(SUM(rdi.quantidade),0) AS total
FROM items i
LEFT JOIN receber_doacao_items rdi ON rdi.item_id = i.id
GROUP BY i.id, i.nome
ORDER BY total DESC
LIMIT 15
"""
df_top = query_df(top_itens_sql)


series_sql = """
SELECT
	DATE_FORMAT(rd.created_at, '%Y-%m') AS mes,
	SUM(COALESCE(rdi.quantidade,0)) AS itens,
	COUNT(DISTINCT rd.id) AS doacoes
FROM receber_doacaos rd
LEFT JOIN receber_doacao_items rdi ON rdi.receber_doacao_id = rd.id
GROUP BY mes
ORDER BY mes
"""
df_series = query_df(series_sql)

col1, col2 = st.columns(2)
with col1:
	st.subheader("Itens mais doados")
	st.altair_chart(
		alt.Chart(df_top).mark_bar(color="#1f77b4").encode(
			x=alt.X("total:Q", title="Quantidade"),
			y=alt.Y("nome:N", sort="-x", title="Item"),
			tooltip=["nome", "total"]
		).properties(height=400),
		use_container_width=True
	)
with col2:
	st.subheader("Evolução mensal")
	base = alt.Chart(df_series).encode(x=alt.X("mes:N", title="Mês"))
	area = base.mark_area(color="#1f77b4", opacity=0.25).encode(y=alt.Y("itens:Q", title="Itens"))
	line = base.mark_line(color="#1f77b4").encode(y="itens:Q")
	bars = base.mark_bar(color="#5cb85c", opacity=0.5).encode(y=alt.Y("doacoes:Q", title="Doações"))
	st.altair_chart((area + line) | bars, use_container_width=True)

st.markdown("---")


validade_sql = """
SELECT
	i.nome,
	rdi.validade,
	SUM(rdi.quantidade) AS quantidade
FROM receber_doacao_items rdi
JOIN items i ON i.id = rdi.item_id
WHERE rdi.validade IS NOT NULL
GROUP BY i.nome, rdi.validade
HAVING rdi.validade BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 60 DAY)
ORDER BY rdi.validade ASC
"""
df_validade = query_df(validade_sql)

colv1, colv2 = st.columns([1, 1])
with colv1:
	st.subheader("Itens próximos da validade (≤ 60 dias)")
	if df_validade.empty:
		st.info("Nenhum item próximo da validade.")
	else:
		df_validade_fmt = df_validade.copy()
		df_validade_fmt["validade"] = pd.to_datetime(df_validade_fmt["validade"]).dt.date
		st.dataframe(df_validade_fmt, use_container_width=True, height=300)
with colv2:
	st.subheader("Distribuição por data de validade")
	if df_validade.empty:
		st.empty()
	else:
		st.altair_chart(
			alt.Chart(df_validade).mark_bar(color="#f0ad4e").encode(
				x=alt.X("yearmonth(validade):T", title="Mês de validade"),
				y=alt.Y("sum(quantidade):Q", title="Quantidade"),
				tooltip=[alt.Tooltip("yearmonth(validade):T", title="Mês"), alt.Tooltip("sum(quantidade):Q", title="Quantidade")]
			).properties(height=300),
			use_container_width=True
		)

st.markdown("---")


campanha_sql = """
SELECT tc.nome AS campanha, SUM(COALESCE(rdi.quantidade,0)) AS total
FROM tipo_campanhas tc
LEFT JOIN receber_doacaos rd ON rd.campanha_id = tc.id
LEFT JOIN receber_doacao_items rdi ON rdi.receber_doacao_id = rd.id
GROUP BY tc.id, tc.nome
ORDER BY total DESC
"""
df_camp = query_df(campanha_sql)
st.subheader("Doações por campanha")
if df_camp.empty:
	st.info("Sem dados de campanha.")
else:
	st.altair_chart(
		alt.Chart(df_camp).mark_bar(color="#6f42c1").encode(
			x=alt.X("campanha:N", sort="-y", title="Campanha"),
			y=alt.Y("total:Q", title="Quantidade"),
			tooltip=["campanha", "total"]
		).properties(height=350),
		use_container_width=True
	)

st.caption(f"Atualizado em {date.today().strftime('%d/%m/%Y')} • Dados do MySQL")