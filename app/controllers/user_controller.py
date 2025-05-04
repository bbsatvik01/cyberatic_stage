from flask import Blueprint, render_template, request, redirect, url_for, flash
from flask_login import login_user, logout_user, login_required, current_user
from app.services.user_service import authenticate
from app.extensions import login_manager
from app.models.user_model import User

user_bp = Blueprint('user', __name__, url_prefix='/user')

@user_bp.route('/login', methods=['GET','POST'])
def login():
    if request.method == 'POST':
        email = request.form['email']
        pw = request.form['password']
        user = authenticate(email, pw)
        if user:
            login_user(user)
            return redirect(url_for('user.dashboard'))
        flash('Invalid credentials', 'danger')
    return render_template('login.html')

@user_bp.route('/logout')
@login_required
def logout():
    logout_user()
    return redirect(url_for('user.login'))

@user_bp.route('/dashboard')
@login_required
def dashboard():
    return render_template('dashboard.html', user=current_user)

@login_manager.user_loader
def load_user(user_id):
    return User.query.get(int(user_id))
