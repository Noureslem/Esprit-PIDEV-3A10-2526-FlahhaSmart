# 🧪 Guide de Test du Module Rotation des Cultures

## ✅ Checklist de Validation

### 1. Vérifier les Routes
```bash
php bin/console debug:router | grep rotation
```

Résultat attendu:
```
app_rotation_index       GET    /rotation
app_rotation_analyser    POST   /rotation/analyser
app_rotation_api         POST   /rotation/api
```

### 2. Vérifier la Syntaxe PHP
```bash
php -l src/Service/RotationCultureService.php
php -l src/Controller/RotationController.php
php -l src/Model/*.php
```

Résultat attendu: **No syntax errors detected**

### 3. Vérifier le Cache
```bash
php bin/console cache:clear
```

Résultat attendu:
```
✓ Cache for the "dev" environment (debug=true) was successfully cleared
```

### 4. Tester l'Accès Web
```
http://localhost:8000/rotation
```

Résultat attendu:
- Status HTTP 200
- Page affichée avec formulaire et zone résultats

### 5. Tester l'API POST

#### Via cURL
```bash
curl -X POST http://localhost:8000/rotation/analyser \
  -H "Content-Type: application/json" \
  -d '{
    "surface": 2.5,
    "type_sol": "limoneux",
    "azote": 6,
    "phosphore": 5,
    "potassium": 7,
    "ph": 6.5,
    "duree_plan": 5
  }'
```

#### Via PowerShell
```powershell
$json = @"
{
  "surface": 2.5,
  "type_sol": "limoneux",
  "azote": 6,
  "phosphore": 5,
  "potassium": 7,
  "ph": 6.5,
  "duree_plan": 5
}
"@

$response = Invoke-WebRequest -Uri "http://localhost:8000/rotation/analyser" `
  -Method POST `
  -Body $json `
  -ContentType "application/json" `
  -UseBasicParsing

$response.Content | ConvertFrom-Json | ConvertTo-Json -Depth 5
```

Résultat attendu:
```json
{
  "success": true,
  "recommendations": [...],
  "plan": {...},
  "resume": {...}
}
```

---

## 🧬 Scénarios de Test

### Test 1: Sol Normal
```json
{
  "surface": 2,
  "type_sol": "limoneux",
  "azote": 5,
  "phosphore": 5,
  "potassium": 5,
  "ph": 6.5
}
```

**Attentes:**
- ✓ Recommandations variées (céréales, légumes, légumineuses)
- ✓ Scores entre 70-100
- ✓ Plan diversifié

### Test 2: Sol Épuisé
```json
{
  "surface": 1,
  "type_sol": "sableux",
  "azote": 2,
  "phosphore": 2,
  "potassium": 2,
  "ph": 5.5
}
```

**Attentes:**
- ✓ Jachère très recommandée
- ✓ Légumineuses en bonne position
- ✓ Scores plus bas globalement

### Test 3: Sol Riche
```json
{
  "surface": 5,
  "type_sol": "argileux",
  "azote": 9,
  "phosphore": 9,
  "potassium": 9,
  "ph": 6.8
}
```

**Attentes:**
- ✓ Démandeuses (tomate, betterave) en top
- ✓ Scores élevés (80-100)
- ✓ Plan dense

### Test 4: Historique Récurrent
```json
{
  "surface": 3,
  "type_sol": "limoneux",
  "derniere_culture": "ble",
  "avant_derniere_culture": "ble",
  "azote": 4,
  "phosphore": 5,
  "potassium": 5,
  "ph": 6.5
}
```

**Attentes:**
- ✓ Blé pénalisé
- ✓ Légumineuses recommandées (rupture)
- ✓ Pas de répétition excessive

### Test 5: Longue Période (10 ans)
```json
{
  "surface": 2,
  "type_sol": "limoneux",
  "azote": 5,
  "phosphore": 5,
  "potassium": 5,
  "ph": 6.5,
  "duree_plan": 10
}
```

**Attentes:**
- ✓ Plan de 10 années
- ✓ Bonne diversité
- ✓ Pas de répétitions
- ✓ Score plan équilibré

---

## 🧩 Test de l'Interface

### Test Formulaire
1. ✓ Remplir surface (ex: 3)
2. ✓ Changer sliders (N, P, K)
3. ✓ Vérifier mise à jour temps réel
4. ✓ Sélectionner cultures précédentes
5. ✓ Cliquer "Analyser"

### Test AJAX
1. ✓ Loader "Analyse en cours..." s'affiche
2. ✓ Pas de rechargement page
3. ✓ Résultats apparaissent en 100-300ms
4. ✓ Zone résultats remise à jour

### Test Résultats
1. ✓ Résumé parcelle affiché
2. ✓ Barres nutriments colorées
3. ✓ Top 5 recommandations listées
4. ✓ Timeline du plan visible
5. ✓ Scores s'affichent correctement

### Test Responsive
1. ✓ Desktop: 2 colonnes côte à côte
2. ✓ Tablet: 1 colonne empilée
3. ✓ Mobile: layout optimisé
4. ✓ Scroll fluide

### Test Réinitialisation
1. ✓ Cliquer "Réinitialiser"
2. ✓ Formulaire vide
3. ✓ Résultats supprimés
4. ✓ Message "Remplissez le formulaire"

---

## 🐛 Checklist Débogade

### Si API retourne erreur

❌ **Erreur 400 (Bad Request)**
- Valider JSON (doubles guillemets)
- Vérifier plages valeurs:
  - surface > 0
  - azote/phosphore/potassium entre 0-10
  - ph entre 4-8

❌ **Erreur 500 (Server Error)**
- Vérifier cache: `php bin/console cache:clear`
- Vérifier syntaxe PHP des nouveaux fichiers
- Vérifier logs Symfony

### Si page ne charge pas

❌ **HTTP 404**
- Vérifier route: `php bin/console debug:router`
- Vérifier nom controller/action exact

❌ **HTTP 500 Template**
- Vérifier chemin template: `templates/rotation/index.html.twig`
- Vérifier variables passées au template
- Vérifier syntaxe Twig ({{ }} vs {# #})

### Si résultats bizarres

❌ **Scores tous à 0**
- Vérifier que sol n'est pas complètement incompatible
- Tester avec `type_sol: "limoneux"` qui accepte tout

❌ **Aucune recommandation**
- Vérifier qu'au moins 1 culture existe
- Vérifier que `phScore` n'est pas trop mauvais

❌ **Plan linéaire (même culture)**
- C'est normal si seule 1 culture compatible
- Tester scénario avec plus de possibilités

---

## 📊 Données de Test Prêtes

Voir fichier: `rotation_example.json`

Tous les cas sont couverts:
- ✓ Sol moyen
- ✓ Historiqu bon
- ✓ Nutriments équilibré

---

## ✨ Test de Performance

### Temps de Réponse
```bash
# Mesurer avec curl
curl -w "Temps: %{time_total}s\n" -X POST http://localhost:8000/rotation/analyser \
  -H "Content-Type: application/json" \
  -d @rotation_example.json -o /dev/null -s
```

**Objectif:** < 300ms

### Utilisation Mémoire
```bash
# Via PHP
php -r "
  require 'vendor/autoload.php';
  memory_get_usage();
"
```

**Objectif:** < 2MB

---

## 🎯 Validation Complète

- [ ] Routes enregistrées
- [ ] Syntaxe PHP OK
- [ ] Cache actualisé
- [ ] Page web accessible
- [ ] Formulaire charge
- [ ] Sliders fonctionnent
- [ ] AJAX envoie données
- [ ] API retourne JSON
- [ ] Recommandations affichées
- [ ] Plan timeline visible
- [ ] Résumé clair
- [ ] Responsive OK
- [ ] Réinitialisation OK
- [ ] Temps réponse bon
- [ ] Pas d'erreurs console JS
- [ ] Pas d'erreurs serveur
- [ ] Documentation lisible
- [ ] Code clean

---

## ✅ Succès!

Si tous les tests passent, le module est:
✅ Validé
✅ Fonctionnel
✅ Prêt production
✅ Bien documenté

---

**Date Test:** Mars 2026
**Version:** 1.0
