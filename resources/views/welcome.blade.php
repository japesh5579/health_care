<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexus Health API Engine</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #0b0f19;
            --surface: rgba(255, 255, 255, 0.03);
            --surface-hover: rgba(255, 255, 255, 0.08);
            --surface-border: rgba(255, 255, 255, 0.1);
            --primary: #3b82f6;
            --primary-glow: rgba(59, 130, 246, 0.5);
            --success: #10b981;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            min-height: 100vh;
            overflow-x: hidden;
            display: flex;
            position: relative;
        }

        /* Animated Glowing Orbs Background */
        .ambient-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.4;
            z-index: -1;
            animation: float 20s infinite alternate cubic-bezier(0.5, 0, 0.5, 1);
        }
        .orb-1 { top: -10%; left: -10%; width: 50vw; height: 50vw; background: radial-gradient(circle, #3b82f633, transparent 70%); }
        .orb-2 { bottom: -20%; right: -10%; width: 60vw; height: 60vw; background: radial-gradient(circle, #8b5cf633, transparent 70%); animation-delay: -5s; }
        .orb-3 { top: 40%; left: 40%; width: 40vw; height: 40vw; background: radial-gradient(circle, #10b98122, transparent 70%); animation-delay: -10s; }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(5%, 5%) scale(1.1); }
        }

        /* Glassmorphism Containers */
        .glass-panel {
            background: var(--surface);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--surface-border);
            border-radius: 24px;
            padding: 24px;
            transition: all 0.3s ease;
        }
        .glass-panel:hover {
            border-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
            transform: translateY(-2px);
        }

        /* Layout */
        .sidebar {
            width: 280px;
            padding: 32px 24px;
            border-right: 1px solid var(--surface-border);
            display: flex;
            flex-direction: column;
            gap: 40px;
            background: rgba(11, 15, 25, 0.7);
            backdrop-filter: blur(20px);
            z-index: 10;
        }

        .brand {
            font-size: 24px;
            font-weight: 700;
            background: linear-gradient(to right, #3b82f6, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-links {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        
        .nav-link {
            padding: 12px 16px;
            border-radius: 12px;
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .nav-link:hover, .nav-link.active {
            background: var(--surface-hover);
            color: var(--text-main);
        }
        .nav-link.active::after {
            content: '';
            width: 8px;
            height: 8px;
            background: var(--primary);
            border-radius: 50%;
            box-shadow: 0 0 8px var(--primary);
        }

        .main-content {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            gap: 32px;
            overflow-y: auto;
            max-height: 100vh;
        }

        .header-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
        }

        .stat-card {
            display: flex;
            flex-direction: column;
            gap: 8px;
            position: relative;
            overflow: hidden;
        }
        .stat-card::after {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 40px; height: 40px;
            background: var(--primary-glow);
            filter: blur(20px);
            border-radius: 50%;
        }

        .stat-title { color: var(--text-muted); font-size: 14px; font-weight: 500; }
        .stat-value { font-size: 36px; font-weight: 700; }

        .grid-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--surface-border); border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--text-muted); }

        /* Lists */
        .data-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            max-height: 400px;
            overflow-y: auto;
        }
        .data-list.full-height {
            max-height: 70vh;
        }

        .list-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 12px;
            border: 1px solid transparent;
            transition: all 0.2s;
        }
        .list-item:hover {
            background: var(--surface-hover);
            border-color: var(--surface-border);
            transform: translateX(4px);
        }

        .item-info h4 { font-weight: 500; margin-bottom: 4px; }
        .item-info span { font-size: 13px; color: var(--text-muted); }

        .badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            background: rgba(59, 130, 246, 0.1);
            color: #60a5fa;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .badge.completed { background: rgba(16, 185, 129, 0.1); color: #34d399; border-color: rgba(16, 185, 129, 0.2); }
        .badge.cancelled { background: rgba(239, 68, 68, 0.1); color: #f87171; border-color: rgba(239, 68, 68, 0.2); }

        /* Loader */
        .loader {
            width: 24px;
            height: 24px;
            border: 3px solid var(--surface-border);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: auto;
        }
        @keyframes spin { 100% { transform: rotate(360deg); } }

        /* Form */
        .input-group { margin-bottom: 16px; }
        .input-group label { display: block; margin-bottom: 8px; font-size: 14px; color: var(--text-muted); }
        .form-control {
            width: 100%;
            background: rgba(0,0,0,0.2);
            border: 1px solid var(--surface-border);
            color: #fff;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.2s;
        }
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }
        .btn-primary {
            width: 100%;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }

        /* View Switching Logic */
        .view-section {
            display: none;
            animation: fadeIn 0.4s ease;
        }
        .view-section.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 1024px) {
            .grid-layout { grid-template-columns: 1fr; }
        }
        @media (max-width: 768px) {
            body { flex-direction: column; }
            .sidebar { width: 100%; border-right: none; border-bottom: 1px solid var(--surface-border); padding: 20px; }
            .main-content { padding: 20px; }
        }
    </style>
</head>
<body>
    <div class="ambient-orb orb-1"></div>
    <div class="ambient-orb orb-2"></div>
    <div class="ambient-orb orb-3"></div>

    <aside class="sidebar">
        <div class="brand">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="url(#paint0_linear)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                <defs>
                    <linearGradient id="paint0_linear" x1="2" y1="12" x2="22" y2="12" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#3b82f6"/>
                        <stop offset="1" stop-color="#8b5cf6"/>
                    </linearGradient>
                </defs>
            </svg>
            Nexus Health
        </div>
        <nav class="nav-links">
            <a class="nav-link active" onclick="switchTab('dashboard', this)">Dashboard</a>
            <a class="nav-link" onclick="switchTab('patients', this)">Patients Archive</a>
            <a class="nav-link" onclick="switchTab('doctors', this)">Medical Staff</a>
            <a class="nav-link" onclick="switchTab('appointments', this)">Appointments</a>
        </nav>

        <div class="glass-panel" style="margin-top: auto; border: 1px solid rgba(59, 130, 246, 0.3); background: rgba(59, 130, 246, 0.05);">
            <h4 style="font-size: 14px; margin-bottom: 8px;">REST API Interface</h4>
            <p style="font-size: 12px; color: var(--text-muted); line-height: 1.5;">Responses are automatically parsing raw JSON data directly from the dynamic Laravel API routes.</p>
        </div>
    </aside>

    <main class="main-content">
        <!-- GLOBAL STATS -->
        <div class="header-stats">
            <div class="glass-panel stat-card">
                <span class="stat-title">Registered Patients</span>
                <span class="stat-value" id="stat-patients"><div class="loader"></div></span>
            </div>
            <div class="glass-panel stat-card">
                <span class="stat-title">Total Active Doctors</span>
                <span class="stat-value" id="stat-doctors"><div class="loader"></div></span>
            </div>
            <div class="glass-panel stat-card">
                <span class="stat-title">Total Appointments</span>
                <span class="stat-value" id="stat-appointments"><div class="loader"></div></span>
            </div>
        </div>

        <!-- MAIN DASHBOARD VIEW -->
        <section id="view-dashboard" class="view-section active">
            <div class="grid-layout">
                <div class="glass-panel">
                    <div class="section-title">
                        Upcoming Appointments
                        <span style="font-size: 13px; font-weight: 400; color: var(--text-muted);">Real-time Live Sync</span>
                    </div>
                    <div class="data-list" id="appointments-list-dashboard">
                        <div class="loader" style="margin-top: 40px;"></div>
                    </div>
                </div>

                <div class="glass-panel">
                    <div class="section-title">Quick Register</div>
                    <div style="margin-bottom: 24px;">
                        <p style="font-size: 13px; color: var(--text-muted);">Test the <code>POST /api/patients</code> route by dynamically creating a record.</p>
                    </div>
                    
                    <form id="createPatientForm">
                        <div class="input-group">
                            <label>Patient Full Name</label>
                            <input type="text" id="p_name" class="form-control" autocomplete="off" placeholder="e.g. Jane Doe" required>
                        </div>
                        <div class="input-group">
                            <label>Email Address</label>
                            <input type="email" id="p_email" class="form-control" autocomplete="off" placeholder="jane@example.com" required>
                        </div>
                        <button type="submit" class="btn-primary" id="submitBtn">Create Patient Record</button>
                        <div id="form-msg" style="margin-top: 12px; font-size: 13px; color: #34d399; text-align: center; display: none;">User Created! JSON response OK.</div>
                    </form>
                </div>
            </div>
        </section>

        <!-- PATIENTS ARCHIVE VIEW -->
        <section id="view-patients" class="view-section">
            <div class="glass-panel">
                <div class="section-title">
                    Patient Directory
                    <span style="font-size: 13px; font-weight: 400; color: var(--text-muted);">Fetched from GET /api/patients</span>
                </div>
                <div class="data-list full-height" id="patients-list-full">
                    <div class="loader" style="margin-top: 40px;"></div>
                </div>
            </div>
        </section>

        <!-- DOCTORS VIEW -->
        <section id="view-doctors" class="view-section">
            <div class="glass-panel">
                <div class="section-title">
                    Medical Staff
                    <span style="font-size: 13px; font-weight: 400; color: var(--text-muted);">Fetched from GET /api/doctors</span>
                </div>
                <div class="data-list full-height" id="doctors-list-full">
                    <div class="loader" style="margin-top: 40px;"></div>
                </div>
            </div>
        </section>
        
        <!-- APPOINTMENTS VIEW -->
        <section id="view-appointments" class="view-section">
            <div class="glass-panel">
                <div class="section-title">
                    Master Appointments Log
                    <span style="font-size: 13px; font-weight: 400; color: var(--text-muted);">Fetched from GET /api/appointments</span>
                </div>
                <div class="data-list full-height" id="appointments-list-full">
                    <div class="loader" style="margin-top: 40px;"></div>
                </div>
            </div>
        </section>

    </main>

    <script>
        // API Base configuration - Using relative path to support production domains dynamically
        const API = '/api';

        // Custom Cache
        let globalData = { doctors: [], patients: [], appointments: [] };

        // View Switcher logic
        function switchTab(tabId, element) {
            // Update Active Link UI
            document.querySelectorAll('.nav-link').forEach(el => el.classList.remove('active'));
            element.classList.add('active');

            // Hide all sections, show active
            document.querySelectorAll('.view-section').forEach(el => el.classList.remove('active'));
            document.getElementById(`view-${tabId}`).classList.add('active');

            // Optionally call fetchStats if we want aggressive refreshing on tab click
            // fetchStats();
        }

        // Global Fetch 
        async function fetchStats() {
            try {
                const [docRes, patRes, appRes] = await Promise.all([
                    fetch(`${API}/doctors`),
                    fetch(`${API}/patients`),
                    fetch(`${API}/appointments`)
                ]);

                const doctors = await docRes.json();
                const patients = await patRes.json();
                const appointments = await appRes.json();

                globalData.doctors = doctors.data;
                globalData.patients = patients.data;
                globalData.appointments = appointments.data;

                // Update Stats Header
                document.getElementById('stat-doctors').innerText = doctors.total || doctors.data.length || 0;
                document.getElementById('stat-patients').innerText = patients.total || patients.data.length || 0;
                document.getElementById('stat-appointments').innerText = appointments.total || appointments.data.length || 0;

                // Render UI Lists
                renderDoctors(doctors.data);
                renderPatients(patients.data);
                renderAppointments(appointments.data);

            } catch (error) {
                console.error("API Error", error);
            }
        }

        // Render Functions
        function renderDoctors(data) {
            const list = document.getElementById('doctors-list-full');
            list.innerHTML = '';
            if(!data || data.length === 0) { list.innerHTML = '<p class="loader-fallback">No doctors found.</p>'; return; }

            data.forEach(doc => {
                list.innerHTML += `
                    <div class="list-item">
                        <div class="item-info">
                            <h4>${doc.name}</h4>
                            <span>${doc.specialization} • ID: ${doc.id}</span>
                        </div>
                    </div>
                `;
            });
        }

        function renderPatients(data) {
            const list = document.getElementById('patients-list-full');
            list.innerHTML = '';
            if(!data || data.length === 0) { list.innerHTML = '<p class="loader-fallback">No patients found.</p>'; return; }

            // Ensure the latest added patients show at the top by reversing array
            const sortedData = [...data].reverse();

            sortedData.forEach(pat => {
                list.innerHTML += `
                    <div class="list-item">
                        <div class="item-info">
                            <h4>${pat.name}</h4>
                            <span>Email: ${pat.email}</span>
                        </div>
                        <span style="font-size:12px; color:var(--text-muted)">ID: ${pat.id}</span>
                    </div>
                `;
            });
        }

        function renderAppointments(data) {
            const listDash = document.getElementById('appointments-list-dashboard');
            const listFull = document.getElementById('appointments-list-full');
            listDash.innerHTML = ''; listFull.innerHTML = '';

            if(!data || data.length === 0) { 
                listDash.innerHTML = '<p class="loader-fallback">No appointments found.</p>'; 
                listFull.innerHTML = '<p class="loader-fallback">No appointments found.</p>'; 
                return; 
            }

            data.forEach((app, index) => {
                const dateObj = new Date(app.appointment_date);
                const prettyDate = dateObj.toLocaleDateString('en-US', { month: 'short', day: 'numeric', hour: '2-digit', minute:'2-digit' });
                
                const html = `
                    <div class="list-item">
                        <div class="item-info">
                            <h4>Patient: ${app.patient ? app.patient.name : 'ID ' + app.patient_id}</h4>
                            <span>With ${app.doctor ? app.doctor.name : 'Doctor'} • ${prettyDate}</span>
                        </div>
                        <span class="badge ${app.status}">${app.status.toUpperCase()}</span>
                    </div>
                `;
                
                // Show only last 5 on dashboard
                if (index < 5) listDash.innerHTML += html;
                listFull.innerHTML += html;
            });
        }

        // Form Submit Event using POST /api/patients
        document.getElementById('createPatientForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = document.getElementById('submitBtn');
            const msg = document.getElementById('form-msg');
            
            const payload = {
                name: document.getElementById('p_name').value,
                email: document.getElementById('p_email').value
            };

            btn.innerText = "Processing...";
            btn.style.opacity = "0.7";

            try {
                const response = await fetch(`${API}/patients`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                if (response.ok) {
                    msg.style.display = 'block';
                    setTimeout(() => msg.style.display = 'none', 3000);
                    document.getElementById('createPatientForm').reset();
                    // Live refresh the entire dashboard so the new patient appears instantly in the lists.
                    fetchStats();
                } else {
                    const errorData = await response.json();
                    alert("Error: " + (errorData.message || "Invalid Input. Ensure email is unique."));
                }
            } catch (err) {
                console.error(err);
                alert("Network error occurred connecting to API.");
            } finally {
                btn.innerText = "Create Patient Record";
                btn.style.opacity = "1";
            }
        });

        // Initialize on Load
        document.addEventListener('DOMContentLoaded', fetchStats);
    </script>
</body>
</html>
