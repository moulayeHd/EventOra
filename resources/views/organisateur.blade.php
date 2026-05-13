<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventSphere - Espace Organisateur</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/globals.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body class="org-body">

    <div class="org-container">
        <aside class="org-sidebar">
            <div class="logo">
                <div class="logo-icon"></div>
                <span>EventSphere</span>
            </div>
            
            <nav class="org-nav">
                <p class="nav-label">MON ESPACE</p>
                <a href="#" class="nav-link active" onclick="naviguer('overview', event)">🏠 Vue d'ensemble</a>
                <a href="#" class="nav-link" onclick="naviguer('events', event)">📅 Mes Événements</a>
                <a href="#" class="nav-link" onclick="naviguer('tickets', event)">🎫 Billetterie</a>
                <a href="#" class="nav-link" onclick="naviguer('attendees', event)">👥 Participants</a>
                <a href="#" class="nav-link" onclick="naviguer('analytics', event)">📈 Analyses</a>
                <a href="#" class="nav-link" onclick="naviguer('venue', event)">📍 Lieux</a>
                <a href="#" class="nav-link" onclick="naviguer('settings', event)">⚙️ Paramètres</a>
            </nav>
        </aside>

        <div class="org-content">
            <header class="org-header">
                <div class="header-title">
                    <h2 id="current-title">Vue d'ensemble</h2>
                </div>
                <div class="header-actions">
                    <button class="btn-primary">+ Nouvel Événement</button>
                    <button class="btn-icon">🔔</button>
                    <div class="user-profile">
                        <span>Sasha R.</span>
                        <div class="avatar-small"></div>
                    </div>
                </div>
            </header>

            <main class="org-main-view">
                <section id="page-overview" class="org-section">
                    <p class="welcome">Bienvenue dans votre gestionnaire, Sasha.</p>
                    <div class="stats-row">
                        <div class="stat-card">
                            <span class="icon">📅</span>
                            <div class="val">6</div>
                            <div class="label">Événements totaux</div>
                        </div>
                        <div class="stat-card">
                            <span class="icon">🎫</span>
                            <div class="val">8,440</div>
                            <div class="label">Billets vendus</div>
                        </div>
                        <div class="stat-card">
                            <span class="icon">💰</span>
                            <div class="val">15,420 €</div>
                            <div class="label">Revenus (30j)</div>
                        </div>
                    </div>

                    <div class="chart-container">
                        <h3>Évolution des ventes</h3>
                        <canvas id="mainChart"></canvas>
                    </div>
                </section>

                <section id="page-events" class="org-section" style="display:none;">
                    <h3>Mes Événements</h3>
                    </section>
                
                </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function naviguer(id, e) {
            e.preventDefault();
            document.querySelectorAll('.org-section').forEach(s => s.style.display = 'none');
            document.getElementById('page-' + id).style.display = 'block';
            document.getElementById('current-title').innerText = e.currentTarget.innerText.trim();
            document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
            e.currentTarget.classList.add('active');

            if(id === 'overview') { drawChart(); }
        }

        function drawChart() {
            const canvas = document.getElementById('mainChart');
            if(!canvas) return;
            const ctx = canvas.getContext('2d');
            if(window.myChart) { window.myChart.destroy(); }
            window.myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                    datasets: [{
                        label: 'Ventes',
                        data: [5, 10, 8, 15, 20, 25, 22],
                        borderColor: '#22d3ee',
                        backgroundColor: 'rgba(34, 211, 238, 0.1)',
                        fill: true,
                        tension: 0.4
                    }]
                }
            });
        }
        window.onload = drawChart;
    </script>
</body>
</html>