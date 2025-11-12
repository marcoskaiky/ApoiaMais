import os
import pandas as pd
import mysql.connector
from dotenv import load_dotenv
import streamlit as st
import plotly.express as px
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

st.title("Apoia+ Dashboards")
with st.container():
    col1, col2, col3, col4 = st.columns(4)
    col1.metric("👥 Doadores", int(total_doadores.iloc[0]["qt"]))
    col2.metric("📦 Itens Cadastrados", int(total_itens.iloc[0]["qt"]))
    col3.metric("🎁 Doações Registradas", int(total_doacoes.iloc[0]["qt"]))
    col4.metric("📊 Itens Recebidos (total)", int(itens_recebidos.iloc[0]["qt"]))

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
   
    st.markdown(
        """
        <div style='background: #0066FF; 
                    padding: 15px; 
                    border-radius: 10px; 
                    margin-bottom: 10px;'>
            <h3 style='color: white; margin: 0; display: flex; align-items: center; gap: 10px;'>
                 Estoque por Item (comparativo com mínimo)
            </h3>
        </div>
        """,
        unsafe_allow_html=True
    )
    
 
    df_estoque["status"] = df_estoque.apply(
        lambda row: "Crítico" if row["saldo_vs_min"] < 0 else "Normal", axis=1
    )
    
    
    color_map = {
        "Crítico": "#FF6B6B",
        "Normal": "#51CF66"
    }
    
    fig_estoque = px.bar(
        df_estoque,
        x="nome",
        y="quantidade",
        color="status",
        color_discrete_map=color_map,
        labels={"nome": "Item", "quantidade": "Quantidade em estoque", "status": "Status"},
        title="",
        hover_data=["estoque_minimo", "saldo_vs_min"],
        text="quantidade"
    )

    
    fig_estoque.update_traces(
        texttemplate='%{text:.0f}',
        textposition='outside',
        hovertemplate='<b>%{x}</b><br>' +
                      'Quantidade: %{y:.0f} unidades<br>' +
                      'Mínimo: %{customdata[0]:.0f} unidades<br>' +
                      'Diferença: %{customdata[1]:+.0f} unidades<extra></extra>',
        marker=dict(
            line=dict(width=2, color='rgba(0,0,0,0.2)'),
            opacity=0.85
        )
    )

    
    minimos_unicos = df_estoque["estoque_minimo"].unique()
    for minimo in minimos_unicos:
        fig_estoque.add_hline(
            y=minimo, 
            line_dash="dashdot",
            line_color="#FF4757",
            line_width=2.5,
            opacity=0.6,
            annotation_text=f"Mín: {minimo:.0f}",
            annotation_position="right",
            annotation_font_size=11,
            annotation_font_color="#FF4757",
            annotation_bgcolor="rgba(255, 255, 255, 0.8)",
            annotation_bordercolor="#FF4757"
        )

    fig_estoque.update_layout(
        showlegend=True,
        legend=dict(
            orientation="h",
            yanchor="bottom",
            y=1.02,
            xanchor="right",
            x=1,
            title_text="",
            font=dict(size=12)
        ),
        xaxis=dict(
            title="Item",
            title_font=dict(size=14, color="#2f3542"),
            tickfont=dict(size=11, color="#57606f"),
            gridcolor="rgba(128, 128, 128, 0.1)",
            showgrid=True
        ),
        yaxis=dict(
            title="Quantidade em estoque",
            title_font=dict(size=14, color="#2f3542"),
            tickfont=dict(size=11, color="#57606f"),
            gridcolor="rgba(128, 128, 128, 0.2)",
            showgrid=True,
            zeroline=True,
            zerolinecolor="rgba(128, 128, 128, 0.3)"
        ),
        plot_bgcolor="rgba(255, 255, 255, 0.9)",
        paper_bgcolor="rgba(255, 255, 255, 0)",
        template="plotly_white",
        height=500,
        margin=dict(l=10, r=10, t=60, b=50),
        hovermode='closest',
        transition={'duration': 500}
    )

    st.plotly_chart(fig_estoque, use_container_width=True)

with colB:

    st.markdown(
        """
        <div style='background: #0066FF; 
                    padding: 15px; 
                    border-radius: 10px; 
                    margin-bottom: 10px;'>
            <h3 style='color: white; margin: 0; display: flex; align-items: center; gap: 10px;'>
                 Abaixo do mínimo
            </h3>
        </div>
        """,
        unsafe_allow_html=True
    )
    
    abaixo = df_estoque[df_estoque["saldo_vs_min"] < 0].sort_values("saldo_vs_min")
    
    if abaixo.empty:
        st.markdown(
            """
            <div style='background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%); 
                        padding: 30px; 
                        border-radius: 15px; 
                        text-align: center;
                        box-shadow: 0 4px 6px rgba(0,0,0,0.1);'>
                <h2 style='color: white; margin: 0; font-size: 48px;'>✅</h2>
                <p style='color: white; margin: 10px 0 0 0; font-size: 16px; font-weight: bold;'>
                    Nenhum item abaixo do mínimo!
                </p>
            </div>
            """,
            unsafe_allow_html=True
        )
    else:
       
        for idx, row in abaixo.iterrows():
            percentual_faltante = abs(row["saldo_vs_min"]) / row["estoque_minimo"] * 100
            severity = "crítico" if percentual_faltante > 50 else "atenção"
            bg_color = "#FF6B6B" if severity == "crítico" else "#FFA500"
            
            st.markdown(
                f"""
                <div style='background: {bg_color}; 
                            padding: 15px; 
                            border-radius: 10px; 
                            margin-bottom: 10px;
                            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                            border-left: 5px solid rgba(255,255,255,0.5);'>
                    <div style='display: flex; justify-content: space-between; align-items: center;'>
                        <h4 style='color: white; margin: 0; font-size: 16px;'>{row['nome']}</h4>
                        <span style='background: rgba(255,255,255,0.3); 
                                     padding: 5px 10px; 
                                     border-radius: 20px; 
                                     color: white; 
                                     font-weight: bold;
                                     font-size: 12px;'>
                            {severity.upper()}
                        </span>
                    </div>
                    <div style='margin-top: 10px; display: grid; grid-template-columns: 1fr 1fr; gap: 10px;'>
                        <div>
                            <p style='color: rgba(255,255,255,0.9); margin: 5px 0; font-size: 12px;'>Quantidade</p>
                            <p style='color: white; margin: 0; font-size: 20px; font-weight: bold;'>
                                {int(row['quantidade'])}
                            </p>
                        </div>
                        <div>
                            <p style='color: rgba(255,255,255,0.9); margin: 5px 0; font-size: 12px;'>Mínimo</p>
                            <p style='color: white; margin: 0; font-size: 20px; font-weight: bold;'>
                                {int(row['estoque_minimo'])}
                            </p>
                        </div>
                    </div>
                    <div style='margin-top: 10px;'>
                        <p style='color: rgba(255,255,255,0.9); margin: 5px 0; font-size: 12px;'>Faltam</p>
                        <p style='color: white; margin: 0; font-size: 18px; font-weight: bold;'>
                            {int(abs(row['saldo_vs_min']))} unidades ({percentual_faltante:.0f}%)
                        </p>
                    </div>
                    <div style='margin-top: 10px; background: rgba(255,255,255,0.2); border-radius: 5px; height: 8px; overflow: hidden;'>
                        <div style='background: white; 
                                    height: 100%; 
                                    width: {min(100, (row['quantidade'] / row['estoque_minimo']) * 100)}%; 
                                    transition: width 0.3s ease;'>
                        </div>
                    </div>
                </div>
                """,
                unsafe_allow_html=True
            )

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
    st.subheader("🏆 Itens mais doados")
    fig_top = px.bar(
        df_top,
        x="total",
        y="nome",
        orientation="h",
        color="total",
        color_continuous_scale="Blues",
        labels={"total": "Quantidade", "nome": "Item"}
    )
    fig_top.update_layout(template="plotly_white", height=400)
    st.plotly_chart(fig_top, use_container_width=True)

with col2:
    st.subheader("📈 Evolução mensal")
    fig_series = px.line(
        df_series,
        x="mes",
        y="itens",
        markers=True,
        title="Evolução de Itens e Doações"
    )
    fig_series.add_bar(x=df_series["mes"], y=df_series["doacoes"], name="Doações", marker_color="#5cb85c", opacity=0.5)
    fig_series.update_layout(template="plotly_white", height=400, legend_title_text="")
    st.plotly_chart(fig_series, use_container_width=True)

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

colv1, colv2 = st.columns(2)
with colv1:
    st.subheader("🕒 Itens próximos da validade (≤ 60 dias)")
    if df_validade.empty:
        st.info("Nenhum item próximo da validade.")
    else:
        df_validade_fmt = df_validade.copy()
        df_validade_fmt["validade"] = pd.to_datetime(df_validade_fmt["validade"]).dt.date
        st.dataframe(df_validade_fmt, use_container_width=True, height=300)

with colv2:
    st.subheader("📅 Distribuição por data de validade")
    if not df_validade.empty:
        df_validade["validade"] = pd.to_datetime(df_validade["validade"])
        fig_val = px.bar(
            df_validade,
            x="validade",
            y="quantidade",
            color="quantidade",
            color_continuous_scale="YlOrBr",
            labels={"validade": "Data de validade", "quantidade": "Quantidade"}
        )
        fig_val.update_layout(template="plotly_white", height=300)
        st.plotly_chart(fig_val, use_container_width=True)

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
st.subheader("🎯 Doações por campanha")
if df_camp.empty:
    st.info("Sem dados de campanha.")
else:
    fig_camp = px.bar(
        df_camp,
        x="campanha",
        y="total",
        color="total",
        color_continuous_scale="Purples",
        labels={"campanha": "Campanha", "total": "Quantidade"}
    )
    fig_camp.update_layout(template="plotly_white", height=350)
    st.plotly_chart(fig_camp, use_container_width=True)


st.caption(f"Atualizado em {date.today().strftime('%d/%m/%Y')} • Dados do MySQL")