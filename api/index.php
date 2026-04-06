<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Web Application | PHP + MySQL</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* ВСЕ ВАШИ СТИЛИ ОСТАЮТСЯ ТЕМИ ЖЕ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            color: #f1f5f9;
        }

        .navbar {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            border-bottom: 1px solid rgba(59, 130, 246, 0.3);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #60a5fa, #a78bfa);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        .logo i {
            background: none;
            color: #3b82f6;
            font-size: 1.8rem;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .nav-links a {
            color: #cbd5e1;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
            padding: 0.5rem 0;
            position: relative;
            cursor: pointer;
        }

        .nav-links a:hover, .nav-links a.active {
            color: #60a5fa;
        }

        .nav-links a.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: #3b82f6;
            border-radius: 2px;
        }

        .logout-btn {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid #ef4444;
            color: #fca5a5;
            padding: 0.4rem 1rem;
            border-radius: 2rem;
            transition: 0.2s;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #ef4444;
            color: white;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1.5rem;
            min-height: calc(100vh - 80px);
        }

        .card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(8px);
            border-radius: 1.5rem;
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.3);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #e2e8f0;
        }

        .form-control {
            width: 100%;
            background: rgba(15, 23, 42, 0.8);
            border: 1.5px solid #334155;
            border-radius: 0.75rem;
            padding: 0.8rem 1rem;
            font-size: 1rem;
            color: #f1f5f9;
            transition: all 0.2s;
            outline: none;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .btn {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 0.75rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            width: 100%;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px #1e3a8a;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #475569, #334155);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(15, 23, 42, 0.6);
            border-radius: 1rem;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid rgba(59, 130, 246, 0.2);
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            background: rgba(59, 130, 246, 0.1);
        }

        .stat-card i {
            font-size: 2.5rem;
            color: #3b82f6;
            margin-bottom: 0.5rem;
        }

        .stat-card h3 {
            font-size: 2rem;
            margin: 0.5rem 0;
        }

        .welcome-banner {
            background: linear-gradient(135deg, #1e293b, #0f172a);
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border-left: 4px solid #3b82f6;
        }

        .dashboard-section {
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.3rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #60a5fa;
        }

        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1rem;
        }

        .project-card {
            background: rgba(15, 23, 42, 0.6);
            border-radius: 1rem;
            padding: 1.2rem;
            border: 1px solid rgba(59, 130, 246, 0.2);
            transition: all 0.3s;
        }

        .project-card:hover {
            transform: translateY(-3px);
            border-color: #3b82f6;
        }

        .project-card h4 {
            color: #60a5fa;
            margin-bottom: 0.5rem;
        }

        .project-status {
            display: inline-block;
            padding: 0.2rem 0.8rem;
            border-radius: 2rem;
            font-size: 0.75rem;
            margin-top: 0.5rem;
        }

        .status-completed {
            background: rgba(34, 197, 94, 0.2);
            color: #4ade80;
        }

        .status-in_progress {
            background: rgba(59, 130, 246, 0.2);
            color: #60a5fa;
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.2);
            color: #fbbf24;
        }

        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.8rem;
            background: rgba(15, 23, 42, 0.4);
            border-radius: 0.8rem;
            transition: 0.3s;
        }

        .activity-item:hover {
            background: rgba(59, 130, 246, 0.1);
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            background: rgba(59, 130, 246, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .activity-icon i {
            color: #60a5fa;
        }

        .activity-details {
            flex: 1;
        }

        .activity-time {
            font-size: 0.7rem;
            color: #94a3b8;
        }

        .skill-bar {
            margin-bottom: 1rem;
        }

        .skill-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.3rem;
            font-size: 0.85rem;
        }

        .progress-bar {
            background: rgba(255, 255, 255, 0.1);
            height: 6px;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            height: 100%;
            border-radius: 10px;
            transition: width 1s ease;
        }

        .two-columns {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .alert {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.2);
            border: 1px solid #22c55e;
            color: #4ade80;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid #ef4444;
            color: #f87171;
        }

        .alert-info {
            background: rgba(59, 130, 246, 0.2);
            border: 1px solid #3b82f6;
            color: #93c5fd;
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                text-align: center;
            }
            .nav-links {
                justify-content: center;
            }
            .container {
                padding: 1rem;
            }
            .card {
                padding: 1.5rem;
            }
            .two-columns {
                grid-template-columns: 1fr;
            }
        }

        .page {
            display: none;
        }
        .page.active-page {
            display: block;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="logo">
        <i class="fas fa-database"></i>
        <span>WebApp PHP</span>
    </div>
    <div class="nav-links" id="navLinks">
        <a data-page="home" class="nav-link active">🏠 Home</a>
        <a data-page="register" class="nav-link" id="registerNav">📝 Register</a>
        <a data-page="login" class="nav-link" id="loginNav">🔐 Login</a>
        <a data-page="dashboard" class="nav-link" id="dashboardNav" style="display: none;">📊 Dashboard</a>
        <button id="logoutBtnNav" class="logout-btn" style="display: none;"><i class="fas fa-sign-out-alt"></i> Logout</button>
    </div>
</nav>

<main class="container">
    <!-- HOME PAGE -->
    <div id="homePage" class="page active-page">
        <div class="card">
            <h1><i class="fas fa-home"></i> Welcome to WebApp with PHP + MySQL</h1>
            <p style="margin-top: 1rem; font-size: 1.1rem; color: #cbd5e1;">
                Modern web application with PHP backend, MySQL database, and full authentication system.
            </p>
            <div style="display: flex; gap: 1rem; margin-top: 2rem; flex-wrap: wrap;">
                <button class="btn" onclick="navigateTo('register')"><i class="fas fa-user-plus"></i> Create Account</button>
                <button class="btn btn-secondary" onclick="navigateTo('login')"><i class="fas fa-sign-in-alt"></i> Login</button>
            </div>
            <div style="margin-top: 2rem; padding-top: 1rem; border-top: 1px solid #334155;">
                <h3>✨ Features:</h3>
                <ul style="margin-top: 0.5rem; margin-left: 1.5rem; color: #94a3b8;">
                    <li>✅ PHP Backend with MySQL database</li>
                    <li>✅ Secure session management</li>
                    <li>✅ Password hashing (bcrypt)</li>
                    <li>✅ Responsive design</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- REGISTRATION PAGE -->
    <div id="registerPage" class="page">
        <div class="card" style="max-width: 500px; margin: 0 auto;">
            <h2 style="text-align: center; margin-bottom: 1.5rem;"><i class="fas fa-user-plus"></i> Registration</h2>
            <form id="registerForm">
                <div class="form-group">
                    <label><i class="fas fa-user"></i> Username</label>
                    <input type="text" id="regUsername" class="form-control" placeholder="Enter username" required>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" id="regEmail" class="form-control" placeholder="example@mail.com" required>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-lock"></i> Password</label>
                    <input type="password" id="regPassword" class="form-control" placeholder="At least 4 characters" required>
                </div>
                <button type="submit" class="btn">Register</button>
            </form>
            <div id="registerMessage" class="alert" style="margin-top: 1rem; display: none;"></div>
            <p style="text-align: center; margin-top: 1rem;">Already have an account? <a href="#" onclick="navigateTo('login'); return false;" style="color: #60a5fa;">Login</a></p>
        </div>
    </div>

    <!-- LOGIN PAGE -->
    <div id="loginPage" class="page">
        <div class="card" style="max-width: 500px; margin: 0 auto;">
            <h2 style="text-align: center; margin-bottom: 1.5rem;"><i class="fas fa-sign-in-alt"></i> Login</h2>
            <form id="loginForm">
                <div class="form-group">
                    <label><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" id="loginEmail" class="form-control" placeholder="example@mail.com" required>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-lock"></i> Password</label>
                    <input type="password" id="loginPassword" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
            <div id="loginMessage" class="alert" style="margin-top: 1rem; display: none;"></div>
            <p style="text-align: center; margin-top: 1rem;">Don't have an account? <a href="#" onclick="navigateTo('register'); return false;" style="color: #60a5fa;">Register</a></p>
        </div>
    </div>

    <!-- DASHBOARD PAGE -->
    <div id="dashboardPage" class="page">
        <div class="welcome-banner" id="dashboardWelcome">
            <h2><i class="fas fa-chart-line"></i> Control Panel</h2>
            <p id="userGreeting" style="margin-top: 0.5rem;">Loading...</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <i class="fas fa-code"></i>
                <h3 id="projectsCount">0</h3>
                <p>Total Projects</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-users"></i>
                <h3 id="clientsCount">0</h3>
                <p>Happy Clients</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-certificate"></i>
                <h3 id="certificatesCount">0</h3>
                <p>Certificates</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-trophy"></i>
                <h3 id="awardsCount">0</h3>
                <p>Awards Won</p>
            </div>
        </div>

        <div class="dashboard-section">
            <div class="section-title">
                <i class="fas fa-project-diagram"></i>
                <span>Recent Projects</span>
            </div>
            <div class="projects-grid" id="projectsGrid"></div>
        </div>

        <div class="two-columns">
            <div class="card">
                <div class="section-title">
                    <i class="fas fa-chart-simple"></i>
                    <span>Skills Progress</span>
                </div>
                <div id="skillsProgress">
                    <div class="skill-bar">
                        <div class="skill-info"><span>HTML5/CSS3</span><span id="htmlSkill">0%</span></div>
                        <div class="progress-bar"><div class="progress-fill" id="htmlFill" style="width: 0%"></div></div>
                    </div>
                    <div class="skill-bar">
                        <div class="skill-info"><span>JavaScript</span><span id="jsSkill">0%</span></div>
                        <div class="progress-bar"><div class="progress-fill" id="jsFill" style="width: 0%"></div></div>
                    </div>
                    <div class="skill-bar">
                        <div class="skill-info"><span>React.js</span><span id="reactSkill">0%</span></div>
                        <div class="progress-bar"><div class="progress-fill" id="reactFill" style="width: 0%"></div></div>
                    </div>
                    <div class="skill-bar">
                        <div class="skill-info"><span>PHP/MySQL</span><span id="phpSkill">0%</span></div>
                        <div class="progress-bar"><div class="progress-fill" id="phpFill" style="width: 0%"></div></div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="section-title">
                    <i class="fas fa-clock"></i>
                    <span>Recent Activity</span>
                </div>
                <div class="activity-list" id="activityList"></div>
            </div>
        </div>

        <div class="card" style="margin-top: 1.5rem;">
            <div class="section-title">
                <i class="fas fa-info-circle"></i>
                <span>Profile Information</span>
            </div>
            <div id="profileInfo" style="margin-top: 1rem;">
                <p><strong>Email:</strong> <span id="profileEmail">-</span></p>
                <p><strong>Username:</strong> <span id="profileUsername">-</span></p>
                <p><strong>Status:</strong> <span style="color: #4ade80;">Active ✓</span></p>
            </div>
        </div>
    </div>
</main>

<script>
    let currentUser = null;

    // API Functions
    async function apiRequest(url, method, data = null) {
        const options = {
            method: method,
            headers: { 'Content-Type': 'application/json' }
        };
        if (data) options.body = JSON.stringify(data);
        
        try {
            const response = await fetch(url, options);
            return await response.json();
        } catch (error) {
            console.error('API Error:', error);
            return { success: false, message: 'Network error' };
        }
    }

    // Check session on load
    async function checkSession() {
        const result = await apiRequest('api/check_session.php', 'GET');
        if (result.logged_in) {
            currentUser = result.user;
            updateNavVisibility(true);
            navigateTo('dashboard');
            loadDashboardData();
        } else {
            updateNavVisibility(false);
            navigateTo('home');
        }
    }

    function updateNavVisibility(isLoggedIn) {
        const registerNav = document.getElementById('registerNav');
        const loginNav = document.getElementById('loginNav');
        const dashboardNav = document.getElementById('dashboardNav');
        const logoutBtn = document.getElementById('logoutBtnNav');

        if (isLoggedIn) {
            registerNav.style.display = 'none';
            loginNav.style.display = 'none';
            dashboardNav.style.display = 'inline-block';
            logoutBtn.style.display = 'inline-block';
        } else {
            registerNav.style.display = 'inline-block';
            loginNav.style.display = 'inline-block';
            dashboardNav.style.display = 'none';
            logoutBtn.style.display = 'none';
        }
    }

    function showDashboardUI() {
        if (currentUser) {
            document.getElementById('userGreeting').innerHTML = `<i class="fas fa-hand-peace"></i> Welcome back, <strong>${currentUser.username}</strong>! Here's your activity overview.`;
            document.getElementById('profileEmail').innerText = currentUser.email;
            document.getElementById('profileUsername').innerText = currentUser.username;
        }
    }

    async function loadDashboardData() {
        const result = await apiRequest('api/get_dashboard_data.php', 'GET');
        if (result.success) {
            // Animate statistics
            animateNumber('projectsCount', result.stats.total_projects);
            animateNumber('clientsCount', result.stats.happy_clients);
            animateNumber('certificatesCount', result.stats.certificates);
            animateNumber('awardsCount', result.stats.awards);

            // Load projects
            const projectsGrid = document.getElementById('projectsGrid');
            projectsGrid.innerHTML = result.projects.map(project => `
                <div class="project-card">
                    <h4><i class="fas fa-folder-open"></i> ${project.name}</h4>
                    <p style="font-size: 0.85rem; color: #94a3b8;">${project.description}</p>
                    <span class="project-status status-${project.status}">
                        ${project.status === 'completed' ? '✅ Completed' : project.status === 'in_progress' ? '🔄 In Progress' : '⏳ Pending'}
                    </span>
                </div>
            `).join('');

            // Load activities
            const activityList = document.getElementById('activityList');
            activityList.innerHTML = result.activities.map(activity => `
                <div class="activity-item">
                    <div class="activity-icon"><i class="${activity.icon}"></i></div>
                    <div class="activity-details">
                        <p><strong>${activity.action}</strong> - ${activity.detail}</p>
                        <span class="activity-time">🕒 ${activity.time}</span>
                    </div>
                </div>
            `).join('');

            // Animate skills
            animateSkills();
        }
    }

    function animateNumber(elementId, targetNumber) {
        const element
