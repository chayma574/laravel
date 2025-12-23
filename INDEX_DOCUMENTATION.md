# 📚 Index de Documentation Complète - API Formation

Bienvenue dans la documentation de l'**API REST Formation**.
Ceci est une API REST complète et prête pour la production, dédiée à la gestion de cours en ligne, construite avec **Laravel 12** et authentification **JWT**.

## 🚀 Démarrage Rapide

Nouveau dans ce projet ? Commencez ici :
*   📘 **Lisez [PROJECT_REPORT.md](PROJECT_REPORT.md)** - Aperçu global du projet et rapport de développement.
*   📗 **Suivez [README.md](README.md)** - Guide d'installation et configuration.
*   📙 **Consultez [DOCUMENTATION.md](DOCUMENTATION.md)** - Référence API détaillée et Architecture.

### Identifiants de test (Seeded)
*   **Admin** : `admin@example.com` / `password`
*   **Formateur** : `formateur@example.com` / `password`
*   **Étudiant** : `student@example.com` / `password`
*   **Serveur** : `http://localhost:8000/`

---

## 📖 Fichiers de Documentation

### 1. [PROJECT_REPORT.md](PROJECT_REPORT.md)
*   **Contenu** : Objectifs du projet, résumé de l'implémentation, décisions techniques clés (JWT, RBAC), et état final.
*   **À lire pour** : Comprendre le contexte du projet et le travail réalisé.

### 2. [README.md](README.md)
*   **Contenu** : Instructions d'installation, configuration de l'environnement, setup de la base de données, et guide de démarrage rapide.
*   **À lire pour** : Installer, configurer et lancer le projet sur votre machine.

### 3. [DOCUMENTATION.md](DOCUMENTATION.md)
*   **Contenu** : Documentation technique approfondie, schéma de base de données, architecture détaillée, et référence complète de tous les endpoints API.
*   **À lire pour** : Une compréhension exhaustive du système et pour le développement frontend.

---

## 🧪 Ressources de Test

### `walkthrough.md` (dans les artifacts)
*   **Contenu** : Guide pas-à-pas pour tester l'API manuellement.
*   **Utilisation** : Suivre les étapes pour simuler un flux utilisateur complet.

### Script de Test Automatisé
*   Un script PowerShell a été utilisé pour vérifier le flux complet (Login -> Création Cours -> Inscription).

---

## 🗂️ Structure du Projet

### Répertoires Clés
**Controllers** :
*   `AuthController.php` - Logique d'authentification (Login, Register, JWT).
*   `FormationController.php` - Gestion des cours (CRUD Formateur).
*   `InscriptionController.php` - Gestion des inscriptions (Étudiants).

**Models** :
*   `User.php` - Utilisateur avec implémentation JWT et rôles.
*   `Formation.php` - Cours avec relation Formateur.
*   `Inscription.php` - Inscription avec relations User et Formation.

**Routes** :
*   `api.php` - Définition de toutes les routes API protégées et publiques.

---

## ✅ Fonctionnalités Complètes

*   **Authentification** : ✅ Inscription, ✅ Login JWT, ✅ Refresh token, ✅ Logout, ✅ Profil utilisateur.
*   **Gestion Cours** : ✅ Liste cours (public), ✅ Détails cours, ✅ Créer (Formateur), ✅ Modifier/Supprimer (Formateur propriétaire).
*   **Inscriptions** : ✅ S'inscrire à un cours (Étudiant), ✅ Voir mes inscriptions, ✅ Annuler inscription.
*   **Sécurité** : ✅ JWT, ✅ Hash mot de passe, ✅ Validation strictes, ✅ Middleware `auth:api`, ✅ Vérification des rôles.

---

## 🔧 Tâches Courantes

```bash
php artisan serve                    # Lancer le serveur
php artisan migrate:fresh --seed     # Réinitialiser la BDD avec données de test
php artisan route:list               # Voir la liste des routes
php artisan jwt:secret               # Générer la clé JWT
```

---

## 📝 Référence Rapide Endpoints API

### Publics (Sans Auth)
*   `POST /api/register`
*   `POST /api/login`
*   `GET /api/formations`
*   `GET /api/formations/{id}`

### Protégés (Token Requis)
*   `GET /api/me`
*   `POST /api/logout`
*   `POST /api/refresh`
*   **Formateur** : `POST /api/formations`, `PUT/DELETE /api/formations/{id}`
*   **Étudiant** : `GET /api/inscriptions`, `POST /api/inscriptions`, `DELETE /api/inscriptions/{id}`

---

## 🎯 Prochaines Étapes
1.  Suivez **README.md** pour l'installation.
2.  Utilisez **Postman** ou le script de test pour vérifier l'API.
3.  Développez le **Frontend** (React/Vue/Angular) en consommant ces endpoints.

---
**Projet** : Formation REST API | **Version** : 1.0.0 | **Framework** : Laravel 12 | **Statut** : ✅ Production Ready | **Date** : Décembre 2025
**Documentation organisée et prête pour évaluation ! 🚀**
