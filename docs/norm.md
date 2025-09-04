# 🐘 Normes de code PHP – PSR & bonnes pratiques

Avoir un style de code cohérent dès le départ évite énormément de malentendus et de refactorisations inutiles.
En PHP, il existe des **standards officiels** appelés **PSR** (*PHP Standards Recommendations*), très utilisés par la communauté et adoptés par des frameworks comme **Laravel** ou **Symfony**.

---

## 📌 Normes principales à suivre en PHP

### 1. Structure générale (PSR-1 & PSR-12)

* **Encodage** : UTF-8 sans BOM
* **Balises PHP** : toujours `<?php ... ?>`, sauf `<?=` autorisé pour l’affichage
* **Un fichier = une classe** (si vous codez en orienté objet)
* **Nommage des fichiers** :

  * Classe → `MaClasse.php`
  * Interface → `MonInterface.php`
  * Trait → `MonTrait.php`

---

### 2. Nommage

* **Classes** → `PascalCase` → `UserController`, `DatabaseManager`
* **Méthodes** → `camelCase` → `getUser()`, `saveData()`
* **Variables** → `camelCase` → `$userName`, `$totalAmount`
* **Constantes** → `UPPER_SNAKE_CASE` → `MAX_ATTEMPTS`, `API_URL`
* **Namespaces** → `PascalCase` → `App\Controller`, `App\Service`

---

### 3. Indentation et style

* Indentation : **4 espaces** (jamais de tabulation)
* Accolades : sur la **même ligne**

```php
class UserController
{
    public function getUser($id)
    {
        return $id;
    }
}
```

* Espaces autour des opérateurs :

✅ `$total = $a + $b;`
❌ `$total=$a+$b;`

---

### 4. Bonnes pratiques de code

* **Toujours typer les arguments et retours** (PHP 7.4+)

```php
public function getUser(int $id): ?User
{
    return $this->users[$id] ?? null;
}
```

* Toujours préciser la **visibilité** : `public`, `private`, `protected`
* Éviter le **code spaghetti** → séparer en classes/services
* Respecter le **Single Responsibility Principle (SRP)** : une classe = une responsabilité

---

### 5. Commentaires & documentation

* Utiliser **PHPDoc** pour documenter méthodes et classes :

```php
/**
 * Récupère un utilisateur par son identifiant
 *
 * @param int $id
 * @return User|null
 */
public function getUser(int $id): ?User
{
    return $this->users[$id] ?? null;
}
```

---
