from app.models.user_model import User

def find_by_email(email):
    return User.query.filter_by(email=email).first()

def authenticate(email, password):
    user = find_by_email(email)
    if user and user.check_password(password):
        return user
    return None
