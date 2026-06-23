import os
import subprocess
import time
from datetime import datetime

def run_git_backup():
    maintenant = datetime.now().strftime("%d/%m/%Y à %H:%M:%S")
    print(f"🚀 [{maintenant}] Lancement de la sauvegarde automatique Git...")

    try:
        # 1. git add .
        subprocess.run(["git", "add", "."], check=True)

        # 2. Préparation du message de commit
        message = f"Auto-commit du {maintenant}"

        # 3. git commit -m "..."
        subprocess.run(["git", "commit", "-m", message], stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL)

        # 4. git push origin main
        subprocess.run(["git", "push", "origin", "main"], check=True)
        
        print(f"✅ [{maintenant}] Sauvegarde terminée et poussée sur GitHub.\n")

    except subprocess.CalledProcessError as e:
        print(f"❌ Erreur lors de l'exécution d'une commande Git (aucun changement ou problème réseau) : {e}\n")
    except Exception as e:
        print(f"❌ Une erreur imprévue est survenue : {e}\n")

if __name__ == "__main__":
    print("⏳ Script de sauvegarde Git en arrière-plan démarré (Intervalle : 5 minutes).")
    print("Pour l'arrêter, ferme cette fenêtre ou fais Ctrl+C.\n")
    
    # Exécution immédiate au premier lancement
    run_git_backup()
    
    # Boucle infinie qui se déclenche toutes les 5 minutes
    while True:
        time.sleep(300) # 300 secondes = 5 minutes ⏱️
        run_git_backup()