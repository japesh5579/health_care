<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexus Health Pro | API Engine</title>
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
            overflow: hidden;
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
        }
        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.03);
            color: #fff;
            transform: translateX(4px);
        }
        .nav-item.active {
            background-color: var(--primary-soft);
            color: var(--primary);
        }
        .nav-item i { width: 20px; height: 20px; }

        .sidebar-footer {
            padding: 0 24px;
        }
        .pro-card {
            background: linear-gradient(135deg, #1e293b, #0f172a);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 20px;
            text-align: center;
        }
        .pro-card p { font-size: 12px; color: var(--text-dim); margin-bottom: 12px; line-height: 1.5; }

        /* --- MAIN CONTENT --- */
        .main-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            position: relative;
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
        .page-title p { color: var(--text-dim); font-size: 14px; margin-top: 4px; }

        .content-body {
            padding: 40px;
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* --- CARDS & GRIDS --- */
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
            display: flex;
            flex-direction: column;
            gap: 16px;
            transition: all 0.3s ease;
        }
        .stat-card:hover { border-color: rgba(59, 130, 246, 0.3); transform: translateY(-4px); }
        .stat-header { display: flex; align-items: center; justify-content: space-between; }
        .stat-icon { width: 48px; height: 48px; border-radius: 14px; display: flex; align-items: center; justify-content: center; }
        .stat-icon.blue { background: rgba(59, 130, 246, 0.1); color: #60a5fa; }
        .stat-icon.green { background: rgba(16, 185, 129, 0.1); color: #34d399; }
        .stat-icon.purple { background: rgba(139, 92, 246, 0.1); color: #a78bfa; }
        .stat-label { font-size: 15px; font-weight: 500; color: var(--text-dim); }
        .stat-value { font-size: 32px; font-weight: 800; font-family: var(--outfit); color: #fff; }

        .card-container {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 28px;
            padding: 32px;
            margin-bottom: 24px;
        }
        .card-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        .card-title h3 { font-size: 18px; font-weight: 700; color: #fff; }

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
        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, #1e293b, #334155);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--text-dim);
            font-size: 14px;
        }
        .info h4 { font-size: 15px; font-weight: 600; color: #fff; margin-bottom: 2px; }
        .info p { font-size: 13px; color: var(--text-dim); }
        
        .status-pill {
            padding: 6px 14px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-pill.pending { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
        .status-pill.completed { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        .status-pill.cancelled { background: rgba(239, 68, 68, 0.1); color: var(--danger); }

        /* --- FORM --- */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .field { display: flex; flex-direction: column; gap: 8px; }
        .field label { font-size: 14px; font-weight: 600; color: var(--text-dim); margin-left: 4px; }
        .input-box {
            background: #06080f;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 14px 18px;
            color: #fff;
            font-family: inherit;
            font-size: 15px;
            transition: border-color 0.2s;
        }
        .input-box:focus { outline: none; border-color: var(--primary); }
        .btn-submit {
            grid-column: span 2;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: #fff;
            border: none;
            padding: 16px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(59, 130, 246, 0.4); }

        /* --- COMPONENTS --- */
        .badge-count {
            background: var(--primary);
            color: #fff;
            padding: 2px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 800;
        }

        /* Views Switching */
        .view-section { display: none; animation: slideUp 0.4s ease-out; }
        .view-section.active { display: block; }
        @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        /* TOAST */
        #toast-container { position: fixed; bottom: 40px; right: 40px; z-index: 9999; }
        .toast {
            background: #1e293b;
            border: 1px solid var(--border);
            padding: 16px 24px;
            border-radius: 18px;
            color: #fff;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 12px 32px rgba(0,0,0,0.5);
            animation: slideIn 0.3s ease;
        }
        @keyframes slideIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }

        /* SKELETON LOADER */
        .skeleton { height: 16px; background: rgba(255,255,255,0.05); border-radius: 4px; position: relative; overflow: hidden; }
        .skeleton::after {
            content: "";
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.05), transparent);
            animation: shimmer 1.5s infinite;
        }
        @keyframes shimmer { 0% { transform: translateX(-100%); } 100% { transform: translateX(100%); } }

        @media (max-width: 1100px) { .form-grid { grid-template-columns: 1fr; } .btn-submit { grid-column: span 1; } }
    </style>
</head>
<body>
    <div class="mesh-bg"></div>
    <div id="toast-container"></div>

    <aside class="sidebar">
        <div class="brand">
            <i data-lucide="activity" style="color: var(--primary)"></i>
            Nexus<span>Health</span>
        </div>

        <nav class="nav-menu">
            <div class="nav-item active" onclick="switchView('dashboard', this)">
                <i data-lucide="layout-grid"></i> Dashboard
            </div>
            <div class="nav-item" onclick="switchView('patients', this)">
                <i data-lucide="users"></i> Patients
            </div>
            <div class="nav-item" onclick="switchView('staff', this)">
                <i data-lucide="shield-plus"></i> Staff members
            </div>
            <div class="nav-item" onclick="switchView('appointments', this)">
                <i data-lucide="calendar"></i> Appointments
            </div>
        </nav>

        <div class="sidebar-footer">
            <div class="pro-card">
                <p>Advanced Production API Engine V1.10</p>
                <div style="display: flex; justify-content: center; gap: 8px;">
                    <div style="width: 8px; height: 8px; border-radius: 50%; background: var(--success)"></div>
                    <span style="font-size: 11px; font-weight: 700; color: var(--success)">LIVE SYSTEM</span>
                </div>
            </div>
        </div>
    </aside>

    <main class="main-container">
        <header class="top-bar">
            <div class="page-title">
                <h1 id="view-title">Health Overview</h1>
                <p id="view-subtitle">Monitor and manage medical operations in real-time.</p>
            </div>
            <div style="display: flex; gap: 16px;">
                <div class="nav-item" style="margin: 0; padding: 10px;"><i data-lucide="search"></i></div>
                <div class="nav-item" style="margin: 0; padding: 10px;"><i data-lucide="bell"></i></div>
            </div>
        </header>

        <div class="content-body">
            
            <!-- STATS ROW -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-label">Total Patients</span>
                        <div class="stat-icon purple"><i data-lucide="users"></i></div>
                    </div>
                    <div class="stat-value" id="stat-patients">...</div>
                    <p style="font-size: 12px; color: var(--success)">+12% from last month</p>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-label">Active Doctors</span>
                        <div class="stat-icon blue"><i data-lucide="user-plus"></i></div>
                    </div>
                    <div class="stat-value" id="stat-doctors">...</div>
                    <p style="font-size: 12px; color: var(--text-dim)">Currently on duty</p>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-label">Appointments</span>
                        <div class="stat-icon green"><i data-lucide="calendar-check"></i></div>
                    </div>
                    <div class="stat-value" id="stat-appointments">...</div>
                    <p style="font-size: 12px; color: var(--warning)">8 pending verification</p>
                </div>
            </div>

            <!-- DASHBOARD VIEW -->
            <section id="view-dashboard" class="view-section active">
                <div style="display: grid; grid-template-columns: 1.6fr 1fr; gap: 32px;">
                    <div class="card-container">
                        <div class="card-title">
                            <h3>Real-time Activity</h3>
                            <span class="badge-count" id="count-recent">...</span>
                        </div>
                        <div id="dashboard-recent-list" class="data-list">
                            <div class="skeleton" style="margin: 10px 0; height: 60px;"></div>
                            <div class="skeleton" style="margin: 10px 0; height: 60px;"></div>
                        </div>
                    </div>

                    <div class="card-container">
                        <div class="card-title"><h3>Register Patient</h3></div>
                        <form id="patientForm" class="form-grid">
                            <div class="field">
                                <label>Full Name</label>
                                <input type="text" id="f-name" class="input-box" placeholder="e.g. Liam Johnson" required>
                            </div>
                            <div class="field">
                                <label>Email Address</label>
                                <input type="email" id="f-email" class="input-box" placeholder="liam@provider.com" required>
                            </div>
                            <button type="submit" id="submit-btn" class="btn-submit">Register Record</button>
                        </form>
                    </div>
                </div>
            </section>

            <!-- PATIENTS VIEW -->
            <section id="view-patients" class="view-section">
                <div class="card-container">
                    <div class="card-title">
                        <h3>Patient Master Archive</h3>
                        <div style="display: flex; gap: 10px;">
                            <button class="nav-item" style="padding: 8px 16px; font-size: 12px;"><i data-lucide="filter"></i> Filter</button>
                        </div>
                    </div>
                    <div id="patients-full-list" class="data-list"></div>
                </div>
            </section>

            <!-- STAFF VIEW -->
            <section id="view-staff" class="view-section">
                <div class="card-container">
                    <div class="card-title"><h3>Qualified Specialists</h3></div>
                    <div id="staff-full-list" class="data-list"></div>
                </div>
            </section>

            <!-- APPOINTMENTS VIEW -->
            <section id="view-appointments" class="view-section">
                <div class="card-container">
                    <div class="card-title"><h3>Comprehensive Appointment Logs</h3></div>
                    <div id="appointments-full-list" class="data-list"></div>
                </div>
            </section>

        </div>
    </main>

    <script>
        // API Base configuration
        const API = '/api';

        // --- View Switching ---
        function switchView(id, el) {
            document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
            el.classList.add('active');
            
            document.querySelectorAll('.view-section').forEach(s => s.classList.remove('active'));
            document.getElementById(`view-${id}`).classList.add('active');

            const titles = {
                dashboard: { h: 'Health Overview', p: 'Monitor real-time system metrics.' },
                patients: { h: 'Patient Directory', p: 'Manage and search patient records.' },
                staff: { h: 'Staff Register', p: 'View duty medical professionals.' },
                appointments: { h: 'Appointment Calendar', p: 'Complete history of scheduled clinic time.' }
            };
            document.getElementById('view-title').innerText = titles[id].h;
            document.getElementById('view-subtitle').innerText = titles[id].p;
        }

        // --- Data Handling ---
        async function loadAllData() {
            try {
                const [pRes, dRes, aRes] = await Promise.all([
                    fetch(`${API}/patients`),
                    fetch(`${API}/doctors`),
                    fetch(`${API}/appointments`)
                ]);

                const patients = (await pRes.json()).data || [];
                const doctors = (await dRes.json()).data || [];
                const appointments = (await aRes.json()).data || [];

                // Stats
                document.getElementById('stat-patients').innerText = patients.length;
                document.getElementById('stat-doctors').innerText = doctors.length;
                document.getElementById('stat-appointments').innerText = appointments.length;
                document.getElementById('count-recent').innerText = Math.min(appointments.length, 5);

                renderDashboard(appointments, doctors);
                renderPatients(patients);
                renderStaff(doctors);
                renderAppointments(appointments);

                lucide.createIcons();
            } catch (err) {
                console.error("API Failure", err);
            }
        }

        function renderDashboard(appointments, doctors) {
            const list = document.getElementById('dashboard-recent-list');
            list.innerHTML = '';
            
            appointments.slice(0, 5).forEach(app => {
                const date = new Date(app.appointment_date).toLocaleDateString('en-US', { month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' });
                list.innerHTML += `
                    <div class="list-row">
                        <div class="avatar">${app.patient ? app.patient.name.charAt(0) : '?'}</div>
                        <div class="info">
                            <h4>${app.patient ? app.patient.name : 'Unknown Patient'}</h4>
                            <p>Assigned to ${app.doctor ? app.doctor.name : 'Unassigned'} • ${date}</p>
                        </div>
                        <div class="status-pill ${app.status}">${app.status}</div>
                    </div>
                `;
            });
        }

        function renderPatients(data) {
            const list = document.getElementById('patients-full-list');
            list.innerHTML = '';
            data.forEach(p => {
                list.innerHTML += `
                    <div class="list-row" style="grid-template-columns: 48px 1fr auto">
                        <div class="avatar" style="background: var(--primary-soft); color: var(--primary)">${p.name.charAt(0)}</div>
                        <div class="info">
                            <h4>${p.name}</h4>
                            <p>${p.email}</p>
                        </div>
                        <div class="status-pill" style="background: rgba(255,255,255,0.05); color: #fff">PAT-${p.id}</div>
                    </div>
                `;
            });
        }

        function renderStaff(data) {
            const list = document.getElementById('staff-full-list');
            list.innerHTML = '';
            data.forEach(d => {
                list.innerHTML += `
                    <div class="list-row" style="grid-template-columns: 48px 1fr auto">
                        <div class="avatar" style="background: rgba(16, 185, 129, 0.1); color: var(--success)">MD</div>
                        <div class="info">
                            <h4>${d.name}</h4>
                            <p>${d.specialization}</p>
                        </div>
                        <div style="color: var(--text-dim); font-size: 13px; font-weight: 700">ONLINE</div>
                    </div>
                `;
            });
        }

        function renderAppointments(data) {
            const list = document.getElementById('appointments-full-list');
            list.innerHTML = '';
            data.forEach(app => {
                const date = new Date(app.appointment_date).toLocaleDateString();
                list.innerHTML += `
                    <div class="list-row">
                        <div class="avatar" style="background: rgba(139, 92, 246, 0.1); color: #a78bfa">CAL</div>
                        <div class="info">
                            <h4>Appt #${app.id}</h4>
                            <p>${app.patient ? app.patient.name : 'N/A'} with ${app.doctor ? app.doctor.name : 'N/A'} • Scheduled for ${date}</p>
                        </div>
                        <div class="status-pill ${app.status}">${app.status}</div>
                    </div>
                `;
            });
        }

        // --- Notification ---
        function showToast(msg) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = 'toast';
            toast.innerHTML = `<i data-lucide="check-circle" style="color: var(--success)"></i> ${msg}`;
            container.appendChild(toast);
            lucide.createIcons();
            setTimeout(() => toast.remove(), 4000);
        }

        // --- Form Submission ---
        document.getElementById('patientForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = document.getElementById('submit-btn');
            const data = {
                name: document.getElementById('f-name').value,
                email: document.getElementById('f-email').value
            };

            btn.disabled = true;
            btn.innerText = 'Communicating with API...';

            try {
                const res = await fetch(`${API}/patients`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify(data)
                });

                if (res.ok) {
                    showToast('Patient records updated successfully.');
                    document.getElementById('patientForm').reset();
                    loadAllData();
                } else {
                    const error = await res.json();
                    alert(error.message || "Email must be unique.");
                }
            } catch (err) {
                alert("API connection failed.");
            } finally {
                btn.disabled = false;
                btn.innerText = 'Register Record';
            }
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            loadAllData();
            // Refresh icons one last time
            setTimeout(() => lucide.createIcons(), 1000);
        });
    </script>
</body>
</html>
