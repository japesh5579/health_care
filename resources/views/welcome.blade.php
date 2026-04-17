<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexus Health Pro | Clinical Engine</title>
    <!-- Premium Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --primary: #3b82f6;
            --primary-hover: #2563eb;
            --primary-soft: rgba(59, 130, 246, 0.1);
            --bg-base: #06080f;
            --bg-card: #0f121d;
            --bg-sidebar: #090b14;
            --border: rgba(255, 255, 255, 0.05);
            --text-main: #f1f5f9;
            --text-dim: #94a3b8;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --outfit: 'Outfit', sans-serif;
            --jakarta: 'Plus Jakarta Sans', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
        }

        body {
            background-color: var(--bg-base);
            color: var(--text-main);
            font-family: var(--jakarta);
            min-height: 100vh;
            display: flex;
            /* REMOVED overflow: hidden to allow scrolling */
        }

        /* --- BACKGROUND EFFECTS --- */
        .mesh-bg {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: -1;
            background: 
                radial-gradient(circle at 0% 0%, rgba(59, 130, 246, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 100% 100%, rgba(139, 92, 246, 0.08) 0%, transparent 50%);
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: 280px;
            background-color: var(--bg-sidebar);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            padding: 32px 0;
            height: 100vh;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .brand {
            padding: 0 32px 40px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: var(--outfit);
            font-weight: 800;
            font-size: 22px;
            letter-spacing: -0.5px;
            color: #fff;
        }
        .brand span {
            background: linear-gradient(135deg, #60a5fa, #a78bfa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-menu {
            flex: 1;
            padding: 0 16px;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            color: var(--text-dim);
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            border-radius: 14px;
            margin-bottom: 4px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
        }
        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.03);
            color: #fff;
        }
        .nav-item.active {
            background-color: var(--primary-soft);
            color: var(--primary);
        }
        .nav-item i { width: 20px; height: 20px; }

        /* --- MAIN CONTENT --- */
        .main-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            /* REMOVED max-height: 100vh to allow body scrolling */
        }

        .top-bar {
            padding: 24px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            background: rgba(6, 8, 15, 0.8);
            backdrop-filter: blur(12px);
            z-index: 50;
            border-bottom: 1px solid var(--border);
        }
        .page-title h1 { font-family: var(--outfit); font-size: 24px; font-weight: 700; color: #fff; }

        .content-body {
            padding: 40px;
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* --- AUTH OVERLAY --- */
        #auth-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.8);
            backdrop-filter: blur(20px);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.4s ease;
        }
        .auth-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            width: 440px;
            border-radius: 32px;
            padding: 48px;
            box-shadow: 0 32px 64px rgba(0,0,0,0.6);
        }
        .auth-tabs { display: flex; gap: 24px; margin-bottom: 32px; }
        .auth-tab { font-size: 18px; font-weight: 700; color: var(--text-dim); cursor: pointer; transition: color 0.2s; }
        .auth-tab.active { color: #fff; text-decoration: underline; text-underline-offset: 8px; }

        /* --- CARDS --- */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }
        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 28px;
        }
        .stat-value { font-size: 32px; font-weight: 800; font-family: var(--outfit); color: #fff; }

        .card-container {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 28px;
            padding: 32px;
            margin-bottom: 24px;
        }
        .card-title { font-size: 18px; font-weight: 700; color: #fff; margin-bottom: 24px; display: flex; align-items: center; justify-content: space-between; }

        /* --- LISTS --- */
        .data-list { display: flex; flex-direction: column; gap: 8px; }
        .list-row {
            display: grid;
            grid-template-columns: 48px 1fr auto;
            align-items: center;
            gap: 16px;
            padding: 16px;
            border-radius: 18px;
            transition: background 0.2s;
        }
        .list-row:hover { background: rgba(255, 255, 255, 0.02); }
        .avatar { width: 48px; height: 48px; border-radius: 12px; background: rgba(59, 130, 246, 0.1); color: var(--primary); display: flex; align-items: center; justify-content: center; font-weight: 700; }
        .status-pill { padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 800; text-transform: uppercase; }
        .status-pill.pending { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
        .status-pill.completed { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        .status-pill.cancelled { background: rgba(239, 68, 68, 0.1); color: var(--danger); }

        /* --- FORMS --- */
        .field { display: flex; flex-direction: column; gap: 8px; margin-bottom: 16px; }
        .field label { font-size: 14px; font-weight: 600; color: var(--text-dim); }
        .input-box { background: #06080f; border: 1px solid var(--border); border-radius: 14px; padding: 14px; color: #fff; font-size: 15px; }
        .btn-submit { background: var(--primary); color: #fff; border: none; padding: 14px; border-radius: 14px; font-weight: 700; cursor: pointer; transition: transform 0.2s; }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(59, 130, 246, 0.4); }

        .view-section { display: none; }
        .view-section.active { display: block; animation: slideUp 0.4s ease-out; }
        @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; } }

        #toast-container { position: fixed; bottom: 40px; right: 40px; z-index: 9999; }
    </style>
</head>
<body>
    <div class="mesh-bg"></div>
    <div id="toast-container"></div>

    <!-- AUTH OVERLAY -->
    <div id="auth-overlay">
        <div class="auth-card">
            <div class="auth-tabs">
                <div class="auth-tab active" id="tab-login" onclick="toggleAuth('login')">Login</div>
                <div class="auth-tab" id="tab-signup" onclick="toggleAuth('signup')">Sign Up</div>
            </div>
            
            <form id="authForm">
                <div id="signup-fields" style="display: none;">
                    <div class="field">
                        <label>Full Name</label>
                        <input type="text" id="a-name" class="input-box" placeholder="Your Name">
                    </div>
                </div>
                <div class="field">
                    <label>Email Address</label>
                    <input type="email" id="a-email" class="input-box" placeholder="admin@nexus.health" required>
                </div>
                <div class="field">
                    <label>Password</label>
                    <input type="password" id="a-password" class="input-box" placeholder="••••••••" required>
                </div>
                <div id="signup-confirm-fields" style="display: none;">
                    <div class="field">
                        <label>Confirm Password</label>
                        <input type="password" id="a-confirm" class="input-box" placeholder="••••••••">
                    </div>
                </div>
                <button type="submit" class="btn-submit" style="width: 100%; margin-top: 24px;">Authenticating...</button>
            </form>
        </div>
    </div>

    <aside class="sidebar">
        <div class="brand"><i data-lucide="activity"></i>Nexus<span>Health</span></div>
        <nav class="nav-menu">
            <div class="nav-item active" onclick="switchView('dashboard', this)"><i data-lucide="layout-grid"></i> Dashboard</div>
            <div class="nav-item" onclick="switchView('patients', this)"><i data-lucide="users"></i> Patients</div>
            <div class="nav-item" onclick="switchView('appointments', this)"><i data-lucide="calendar"></i> Appointments</div>
        </nav>
        <div style="padding: 0 16px; margin-top: auto;">
             <div class="nav-item" onclick="logout()" style="color: var(--danger)"><i data-lucide="log-out"></i> Logout</div>
        </div>
    </aside>

    <main class="main-container">
        <header class="top-bar">
            <div class="page-title"><h1 id="view-title">Health Overview</h1></div>
            <span id="user-display" style="font-size: 14px; font-weight: 600; color: var(--primary)"></span>
        </header>

        <div class="content-body">
            <div class="stats-grid">
                <div class="stat-card">
                    <div style="color: var(--text-dim); font-size: 14px;">Total Patients</div>
                    <div class="stat-value" id="stat-patients">...</div>
                </div>
                <div class="stat-card">
                    <div style="color: var(--text-dim); font-size: 14px;">Total Appointments</div>
                    <div class="stat-value" id="stat-appointments">...</div>
                </div>
                <div class="stat-card">
                    <div style="color: var(--text-dim); font-size: 14px;">Staff Members</div>
                    <div class="stat-value" id="stat-doctors">...</div>
                </div>
            </div>

            <section id="view-dashboard" class="view-section active">
                <div style="display: grid; grid-template-columns: 1.6fr 1fr; gap: 32px;">
                    <div class="card-container">
                        <div class="card-title">Recent Activity</div>
                        <div id="recent-list" class="data-list"></div>
                    </div>
                    <div class="card-container">
                        <div class="card-title">Quick Register</div>
                        <form id="patientForm">
                            <div class="field"><label>Patient Name</label><input type="text" id="p-name" class="input-box" required></div>
                            <div class="field"><label>Email</label><input type="email" id="p-email" class="input-box" required></div>
                            <button type="submit" class="btn-submit" style="width: 100%">Add Patient</button>
                        </form>
                    </div>
                </div>
            </section>

            <section id="view-patients" class="view-section">
                <div class="card-container">
                    <div class="card-title">Patient Directory</div>
                    <div id="patients-list" class="data-list"></div>
                </div>
            </section>

            <section id="view-appointments" class="view-section">
                <div style="display: grid; grid-template-columns: 1.6fr 1fr; gap: 32px;">
                    <div class="card-container">
                        <div class="card-title">Appointment Logs</div>
                        <div id="appointments-list" class="data-list"></div>
                    </div>
                    <div class="card-container">
                        <div class="card-title">Schedule New</div>
                        <form id="aptForm">
                            <div class="field"><label>Patient</label><select id="apt-patient" class="input-box" required></select></div>
                            <div class="field"><label>Doctor</label><select id="apt-doctor" class="input-box" required></select></div>
                            <div class="field"><label>Date & Time</label><input type="datetime-local" id="apt-date" class="input-box" required></div>
                            <button type="submit" class="btn-submit" style="width: 100%">Confirm Schedule</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script>
        const API = '/api';
        let state = { token: localStorage.getItem('token'), user: null, view: 'login' };

        async function api(path, method = 'GET', body = null) {
            const headers = { 'Content-Type': 'application/json', 'Accept': 'application/json' };
            if (state.token) headers['Authorization'] = `Bearer ${state.token}`;
            const res = await fetch(`${API}${path}`, { method, headers, body: body ? JSON.stringify(body) : null });
            if (res.status === 401) { logout(); throw new Error('Unauthorized'); }
            return res.json();
        }

        function toggleAuth(view) {
            state.view = view;
            document.getElementById('tab-login').classList.toggle('active', view === 'login');
            document.getElementById('tab-signup').classList.toggle('active', view === 'signup');
            document.getElementById('signup-fields').style.display = view === 'signup' ? 'block' : 'none';
            document.getElementById('signup-confirm-fields').style.display = view === 'signup' ? 'block' : 'none';
            document.querySelector('#authForm button').innerText = view === 'login' ? 'Login to Nexus' : 'Create Admin Account';
        }

        async function init() {
            if (!state.token) {
                document.getElementById('auth-overlay').style.display = 'flex';
                toggleAuth('login');
            } else {
                document.getElementById('auth-overlay').style.display = 'none';
                await loadData();
            }
            lucide.createIcons();
        }

        async function loadData() {
            try {
                const [pts, docs, apts, me] = await Promise.all([api('/patients'), api('/doctors'), api('/appointments'), api('/me')]);
                state.user = me;
                document.getElementById('user-display').innerText = `Admin: ${me.name}`;
                document.getElementById('stat-patients').innerText = pts.data.length;
                document.getElementById('stat-doctors').innerText = docs.data.length;
                document.getElementById('stat-appointments').innerText = apts.data.length;

                renderList('recent-list', apts.data.slice(0, 5), 'apt');
                renderList('patients-list', pts.data, 'pat');
                renderList('appointments-list', apts.data, 'apt');

                // Populate selects
                const pSel = document.getElementById('apt-patient'); pSel.innerHTML = pts.data.map(p => `<option value="${p.id}">${p.name}</option>`).join('');
                const dSel = document.getElementById('apt-doctor'); dSel.innerHTML = docs.data.map(d => `<option value="${d.id}">${d.name}</option>`).join('');
            } catch(e) {}
        }

        function renderList(id, data, type) {
            const el = document.getElementById(id); el.innerHTML = '';
            data.forEach(item => {
                const row = document.createElement('div'); row.className = 'list-row';
                if (type === 'apt') {
                    row.innerHTML = `<div class="avatar">${item.patient ? item.patient.name[0] : '?'}</div><div style="flex:1"><h4>Patient: ${item.patient ? item.patient.name : 'N/A'}</h4><p>Dr. ${item.doctor ? item.doctor.name : 'N/A'} • ${new Date(item.appointment_date).toLocaleDateString()}</p></div><div class="status-pill ${item.status}">${item.status}</div>`;
                } else {
                    row.innerHTML = `<div class="avatar" style="background:var(--primary-soft)">${item.name[0]}</div><div style="flex:1"><h4>${item.name}</h4><p>${item.email}</p></div><div style="font-size:12px; font-weight:700">PAT-${item.id}</div>`;
                }
                el.appendChild(row);
            });
        }

        document.getElementById('authForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = e.target.querySelector('button'); btn.disabled = true;
            const path = state.view === 'login' ? '/login' : '/register';
            const body = { email: document.getElementById('a-email').value, password: document.getElementById('a-password').value };
            if (state.view === 'signup') { body.name = document.getElementById('a-name').value; body.password_confirmation = document.getElementById('a-confirm').value; }
            
            try {
                const res = await api(path, 'POST', body);
                if (res.access_token) {
                    localStorage.setItem('token', res.access_token);
                    state.token = res.access_token;
                    showToast('Welcome back, Admin.');
                    init();
                } else { alert(res.message || 'Error occurred'); }
            } catch(e) { alert('Authentication Failed'); }
            btn.disabled = false;
        });

        document.getElementById('aptForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const body = { patient_id: document.getElementById('apt-patient').value, doctor_id: document.getElementById('apt-doctor').value, appointment_date: document.getElementById('apt-date').value };
            await api('/appointments', 'POST', body);
            showToast('New appointment confirmed.');
            loadData();
        });

        document.getElementById('patientForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const body = { name: document.getElementById('p-name').value, email: document.getElementById('p-email').value };
            await api('/patients', 'POST', body);
            showToast('Patient record added.');
            e.target.reset();
            loadData();
        });

        function switchView(id, el) {
            document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
            el.classList.add('active');
            document.querySelectorAll('.view-section').forEach(s => s.classList.remove('active'));
            document.getElementById(`view-${id}`).classList.add('active');
            document.getElementById('view-title').innerText = id.charAt(0).toUpperCase() + id.slice(1);
        }

        function logout() { localStorage.removeItem('token'); state.token = null; init(); }
        function showToast(m) { const t = document.createElement('div'); t.className = 'toast'; t.innerHTML = `<i data-lucide="check"></i> ${m}`; document.getElementById('toast-container').appendChild(t); lucide.createIcons(); setTimeout(() => t.remove(), 3000); }

        document.addEventListener('DOMContentLoaded', init);
    </script>
</body>
</html>
