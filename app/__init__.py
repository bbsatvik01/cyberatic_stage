from flask import Flask
from .extensions import db, login_manager
from .controllers.user_controller import user_bp

def create_app():
    app = Flask(__name__, template_folder='templates', static_folder='static')
    app.config.from_object('config.DevConfig')

    db.init_app(app)
    login_manager.init_app(app)

    app.register_blueprint(user_bp)

    @app.route('/')
    def home():
        return '<p>Flask app is running. Go to <a href="/user/login">/user/login</a></p>'

    return app
