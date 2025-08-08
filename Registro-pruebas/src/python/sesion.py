from flask import Flask, request, render_template_string
import mysql.connector
from werkzeug.security import generate_password_hash

app = Flask(__name__)

@app.route('/registrar', methods=['POST'])
def registrar():
    nombre_usuario = request.form.get('nombre_usuario')
    edad_usuario = request.form.get('edad_usuario')
    correo = request.form.get('correo')
    contrasena = request.form.get('contrasena')

    if not all([nombre_usuario, edad_usuario, correo, contrasena]):
        return "❌ Faltan datos del formulario."

    contrasena_hash = generate_password_hash(contrasena)

    try:
        conn = mysql.connector.connect(
            host="localhost",
            user="root",
            password="",
            database="sesionUser"
        )
        cursor = conn.cursor()
        sql = "INSERT INTO userRegistrados (nombre_usuario, edad_usuario, correo, contrasena) VALUES (%s, %s, %s, %s)"
        cursor.execute(sql, (nombre_usuario, edad_usuario, correo, contrasena_hash))
        conn.commit()
        cursor.close()
        conn.close()
        return "✅ Usuario creado correctamente."
    except Exception as e:
        return f"❌ Error: {e}"

if __name__ == '__main__':
    app.run(debug=True)