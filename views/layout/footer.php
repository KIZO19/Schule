<footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
        Version 1.0.0
    </div>
    <?php $footerSchoolName = $_SESSION['selected_ecole_name'] ?? $_SESSION['ecole_name'] ?? 'SMSys'; ?>
    <strong>© <?= date('Y') ?> <?= htmlspecialchars($footerSchoolName) ?>.</strong> Tous droits réservés. Développé pour le suivi scolaire et la gestion des familles.
</footer>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJ+Y3DmFzMSKDTqzISQBej6G8q4U+7kw+v9EE=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2LcRccM80ILdY4g/s2kW7B1NqI0Ffjjk+N5I9IJyH2" crossorigin="anonymous"></script>
<script src="<?= BASE_URL ?>/public/assets/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	(function(){
		const body = document.body;
		const btn = document.getElementById('theme-toggle-btn');
		const icon = document.getElementById('theme-toggle-icon');

		function applyTheme(theme) {
			if (theme === 'dark') {
				body.classList.add('dark-mode');
				if(icon) { icon.className = 'fas fa-sun'; }
				if(btn) btn.setAttribute('aria-pressed','true');
			} else {
				body.classList.remove('dark-mode');
				if(icon) { icon.className = 'fas fa-moon'; }
				if(btn) btn.setAttribute('aria-pressed','false');
			}
		}

		// Determine initial theme: user preference -> localStorage -> system
		let stored = null;
		try { stored = localStorage.getItem('theme'); } catch(e) { stored = null; }

		if (stored) {
			applyTheme(stored);
		} else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
			applyTheme('dark');
		}

		if (btn) {
			btn.addEventListener('click', function(){
				const isDark = body.classList.contains('dark-mode');
				const next = isDark ? 'light' : 'dark';
				applyTheme(next);
				try { localStorage.setItem('theme', next); } catch(e){}
			});
		}
	})();
</script>
<script>
// Minimal chart example using Chart.js if present
if (typeof Chart !== 'undefined'){
	const ctx = document.getElementById('gradesChart');
	if (ctx){
		new Chart(ctx, {
			type: 'line',
			data: {
				labels: ['Jan','Feb','Mar','Apr','May','Jun'],
				datasets: [{
					label: 'Moyenne',
					data: [12, 15, 10, 18, 16, 19],
					borderColor: '#1e90ff',
					backgroundColor: 'rgba(30,144,255,0.15)'
				}]
			},
			options: { responsive:true, maintainAspectRatio:false }
		});
	}
}
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function(e){
                e.preventDefault();
                document.body.classList.toggle('sidebar-open');
            });
        }
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function(){
                document.body.classList.remove('sidebar-open');
            });
        }
    });
</script>
</body>
</html>