from flask import Flask, render_template, request
import model as md
app = Flask(__name__)

@app.route("/")
def home():
    return render_template("index.html")

@app.route("/get")
def get_bot_response():
    userText = request.args.get('msg')
    answer=md.res(userText)
    return str(answer)


if __name__ == "__main__":
    app.run()
